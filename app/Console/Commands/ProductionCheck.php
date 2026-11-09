<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Pre-launch readiness audit.
 *
 * Run on the production host once everything is configured:
 *
 *   php artisan app:production-check
 *
 * Verifies configuration, security posture, storage, queue health, mail,
 * payments and runtime settings. Exits non-zero when anything must be
 * fixed before go-live (use --strict to fail on warnings too) so it can
 * gate a deployment pipeline.
 */
class ProductionCheck extends Command
{
    protected $signature = 'app:production-check
                            {--strict : Treat warnings as failures}';

    protected $description = 'Audit the installation for production launch readiness';

    private int $failures = 0;

    private int $warnings = 0;

    /** Default passwords shipped by the seeders — must be rotated before launch. */
    public const SEEDER_PASSWORDS = [
        'admin@sephora.test' => 'Sephora@Admin2024',
        'manager@sephora.test' => 'Sephora@Manager2024',
        'support@sephora.test' => 'Sephora@Support2024',
        'demo@sephora.test' => 'Sephora@Demo2024',
    ];

    public function handle(): int
    {
        $this->components->twoColumnDetail('<fg=cyan;options=bold>SEPHORA UAE — production launch readiness audit</>', '');
        $this->newLine();

        $this->checkApplication();
        $this->checkHttpsAndProxies();
        $this->checkDatabase();
        $this->checkStorage();
        $this->checkQueueAndScheduler();
        $this->checkMail();
        $this->checkPayments();
        $this->checkAccounts();
        $this->checkRuntime();
        $this->checkCaches();

        $strict = (bool) $this->option('strict');
        $blocked = $this->failures > 0 || ($strict && $this->warnings > 0);

        $this->newLine();
        $this->components->twoColumnDetail(
            '<options=bold>Result</>',
            sprintf(
                '<fg=%s>%d failed, %d warnings</>',
                $blocked ? 'red' : ($this->warnings > 0 ? 'yellow' : 'green'),
                $this->failures,
                $this->warnings,
            ),
        );

        if ($blocked) {
            $this->line('<fg=red>Not ready to launch — resolve the items above, then re-run this command.</>');
        } else {
            $this->line('<fg=green>Ready to launch. 🚀</>');
        }

        return $blocked ? self::FAILURE : self::SUCCESS;
    }

    // ──────────────────────────────────────────────── Sections ──

    private function checkApplication(): void
    {
        $this->line('<fg=magenta;options=bold>Application</>');

        $this->passFail(config('app.env') === 'production', 'APP_ENV is production', 'APP_ENV is "'.config('app.env').'" — run this check on the production host');
        $this->passFail(! config('app.debug'), 'APP_DEBUG is off', 'APP_DEBUG=true leaks stack traces — set APP_DEBUG=false');

        $key = (string) config('app.key');
        $this->passFail(
            str_starts_with($key, 'base64:') && strlen($key) >= 51,
            'APP_KEY is set (base64, 32 bytes)',
            'APP_KEY missing or malformed — run php artisan key:generate',
        );

        $url = (string) config('app.url');
        $this->passFail(
            $url !== '' && ! str_contains($url, 'localhost') && str_starts_with($url, 'https://'),
            'APP_URL is a real https domain',
            "APP_URL is \"{$url}\" — set the live domain with https://",
        );

        $this->passFail(! app()->isDownForMaintenance(), 'Site is not in maintenance mode', 'Maintenance mode is ON — php artisan up before launch');
    }

    private function checkHttpsAndProxies(): void
    {
        $this->line('<fg=magenta;options=bold>HTTPS & proxies</>');

        $this->passFail((bool) config('app.force_https'), 'APP_FORCE_HTTPS enabled', 'Insecure requests will not redirect — set APP_FORCE_HTTPS=true');

        $proxies = config('app.trusted_proxies');
        $this->warnOk(
            is_string($proxies) && $proxies !== '',
            'TRUSTED_PROXIES configured (X-Forwarded-* honoured)',
            'TRUSTED_PROXIES is unset — client IPs and HTTPS detection will be wrong behind nginx/LB',
        );

        $this->warnOk(
            (bool) config('session.secure'),
            'SESSION_SECURE_COOKIE=true',
            'Session cookies are not restricted to https — set SESSION_SECURE_COOKIE=true',
        );

        $this->warnOk(
            (config('session.same_site') === 'lax'),
            'Session SameSite=lax (CSRF hardening)',
            'SESSION_SAME_SITE should be lax',
        );
    }

    private function checkDatabase(): void
    {
        $this->line('<fg=magenta;options=bold>Database</>');

        $connection = (string) config('database.default');
        $this->passFail(
            in_array($connection, ['mysql', 'pgsql'], true),
            "Production database driver is {$connection} (production-ready)",
            "DB_CONNECTION={$connection} — a real launch should run MySQL/MariaDB or PostgreSQL, not sqlite",
        );

        try {
            DB::select('select 1');
            $this->line('  <fg=green>✓</> Database connection works ('.$connection.')');
        } catch (\Throwable $e) {
            $this->recordFailure('Database connection failed: '.$e->getMessage());
        }
    }

    private function checkStorage(): void
    {
        $this->line('<fg=magenta;options=bold>Storage & paths</>');

        foreach (['storage/app', 'storage/framework', 'storage/logs', 'bootstrap/cache'] as $path) {
            $this->passFail(
                is_dir(base_path($path)) && is_writable(base_path($path)),
                "{$path}/ is writable",
                "{$path}/ is not writable by the PHP user (www-data)",
            );
        }

        $this->warnOk(
            is_link(public_path('storage')) || is_dir(public_path('storage')),
            'public/storage symlink exists (php artisan storage:link)',
            'Product image uploads will 404 — run php artisan storage:link',
        );
    }

    private function checkQueueAndScheduler(): void
    {
        $this->line('<fg=magenta;options=bold>Queue & scheduler</>');

        $queue = (string) config('queue.default');
        $this->warnOk(
            $queue !== 'sync',
            "Queue driver is {$queue} (worker-managed)",
            'QUEUE_CONNECTION=sync executes emails inside the request — use database/redis + a worker',
        );

        try {
            $backlog = (int) DB::table('jobs')->count();
            $this->warnOk(
                $backlog === 0,
                'No pending jobs in the queue',
                "Queue backlog is {$backlog} jobs — the worker may be down",
            );

            $failed = (int) DB::table('failed_jobs')->count();
            $this->warnOk(
                $failed === 0,
                'No failed jobs',
                "{$failed} failed jobs — inspect: php artisan queue:failed",
            );
        } catch (\Throwable) {
            $this->recordFailure('jobs/failed_jobs tables are missing — run php artisan migrate');
        }

        try {
            Artisan::call('schedule:list');
            $registered = substr_count(Artisan::output(), "\n");
            $this->warnOk(
                $registered > 4,
                "Scheduler has {$registered} entries registered",
                'No scheduled tasks — check routes/console.php and the cron entry',
            );
        } catch (\Throwable) {
            $this->recordFailure('Could not inspect the schedule.');
        }
    }

    private function checkMail(): void
    {
        $this->line('<fg=magenta;options=bold>Mail</>');

        $mailer = (string) config('mail.default');
        $this->passFail(
            $mailer !== '' && $mailer !== 'log' && $mailer !== 'array',
            "Transactional mailer is {$mailer}",
            "MAIL_MAILER={$mailer} — order emails will never reach customers; configure SMTP",
        );

        $from = (string) config('mail.from.address');
        $this->warnOk(
            $from !== '' && ! str_contains($from, 'example'),
            "From address is {$from}",
            'MAIL_FROM_ADDRESS is empty/example — outgoing mail will be rejected or junked',
        );
    }

    private function checkPayments(): void
    {
        $this->line('<fg=magenta;options=bold>Payments</>');

        $driver = (string) config('payments.driver');
        $this->passFail(
            $driver !== 'fake',
            "Payments driver is \"{$driver}\" (live)",
            'PAYMENTS_DRIVER=fake simulates payments — no real money will be captured',
        );

        if ($driver === 'stripe') {
            $secret = (string) config('payments.stripe.secret');
            $this->passFail(
                str_starts_with($secret, 'sk_live_') || str_starts_with($secret, 'sk_test_'),
                'STRIPE_SECRET is set',
                'STRIPE_SECRET is missing — checkout will fail',
            );

            $this->passFail(
                str_starts_with((string) config('payments.stripe.webhook_secret'), 'whsec_'),
                'STRIPE_WEBHOOK_SECRET is set',
                'STRIPE_WEBHOOK_SECRET is missing — payment webhooks will be rejected',
            );

            $this->warnOk(
                str_starts_with($secret, 'sk_live_'),
                'Stripe key is LIVE mode',
                'Stripe key is in TEST mode (sk_test_) — switch to live keys at launch',
            );
        }

        $zaincash = app(\App\Services\Payments\ZainCashGateway::class);
        if ($zaincash->isEnabled()) {
            $this->line('  <fg=cyan>ZainCash Payment Gateway</>');
            $mode = $zaincash->mode();
            $version = $zaincash->apiVersion();

            $this->warnOk(
                $mode === 'production',
                'ZainCash is in PRODUCTION mode',
                'ZainCash is in UAT/Sandbox mode — switch to production mode in Admin Settings at launch',
            );

            if ($version === 'v2') {
                $hasClientId = $zaincash->clientId() !== '';
                $hasClientSecret = $zaincash->clientSecret() !== '';

                $this->passFail(
                    $hasClientId && $hasClientSecret,
                    'ZainCash v2 Client ID & Secret configured',
                    'ZainCash v2 credentials missing — configure them in Admin Settings',
                );
            } else {
                $hasMerchantId = $zaincash->merchantId() !== '';
                $hasSecret = $zaincash->secret() !== '';

                $this->passFail(
                    $hasMerchantId && $hasSecret,
                    'ZainCash v1 Merchant ID & Secret configured',
                    'ZainCash v1 credentials missing — configure them in Admin Settings',
                );
            }
        }

        $tabby = app(\App\Services\Payments\TabbyGateway::class);
        if ($tabby->isEnabled()) {
            $this->line('  <fg=cyan>Tabby Pay Later Gateway</>');
            $hasSecret = $tabby->secretKey() !== '';
            $this->passFail(
                $hasSecret,
                'Tabby Secret Key configured',
                'Tabby Secret Key is missing — checkout will fail',
            );
        }

        $tamara = app(\App\Services\Payments\TamaraGateway::class);
        if ($tamara->isEnabled()) {
            $this->line('  <fg=cyan>Tamara Pay in 3 Gateway</>');
            $hasToken = $tamara->apiToken() !== '';
            $this->passFail(
                $hasToken,
                'Tamara API Token configured',
                'Tamara API Token is missing — checkout will fail',
            );
        }
    }

    private function checkAccounts(): void
    {
        $this->line('<fg=magenta;options=bold>Seeder & demo accounts</>');

        $found = 0;

        foreach (self::SEEDER_PASSWORDS as $email => $password) {
            $user = User::query()->where('email', $email)->first();

            if ($user === null) {
                continue;
            }

            if (Hash::check($password, $user->password)) {
                $found++;

                if ($email === 'demo@sephora.test') {
                    $this->recordWarning("Demo customer {$email} still exists with the default password — remove it before launch");
                } else {
                    $this->recordFailure("Staff {$email} still uses the seeder password — change it in /admin before launch");
                }
            }
        }

        if ($found === 0) {
            $this->line('  <fg=green>✓</> No account keeps a default seeder password');
        }
    }

    private function checkRuntime(): void
    {
        $this->line('<fg=magenta;options=bold>Runtime</>');

        $this->passFail(PHP_VERSION_ID >= 80300, 'PHP >= 8.3 ('.PHP_VERSION.')', 'PHP '.PHP_VERSION.' is below the required 8.3');

        $required = ['pdo_mysql', 'mbstring', 'dom', 'curl', 'fileinfo', 'gd', 'bcmath', 'zip', 'intl', 'openssl', 'tokenizer', 'ctype'];
        $missing = array_values(array_filter($required, fn ($ext) => ! extension_loaded($ext)));

        $this->passFail($missing === [], 'All required PHP extensions loaded', 'Missing extensions: '.implode(', ', $missing));

        $this->warnOk(
            function_exists('opcache_get_status') && (bool) (opcache_get_status(false) ?? false),
            'OPcache is enabled',
            'OPcache is off — enable it for production PHP-FPM performance',
        );
    }

    private function checkCaches(): void
    {
        $this->line('<fg=magenta;options=bold>Optimisation caches</>');

        $checks = [
            'config' => app()->configurationIsCached(),
            'routes' => app()->routesAreCached(),
            'events' => app()->eventsAreCached(),
        ];

        foreach ($checks as $name => $cached) {
            $this->warnOk($cached, ucfirst($name).' cache is warm', ucfirst($name).' cache is cold — run php artisan '.$name.':cache');
        }

        $compiled = count((array) glob(storage_path('framework/views/*.php')));
        $this->warnOk(
            $compiled > 10,
            "Blade views are pre-compiled ({$compiled} templates)",
            'Only '.$compiled.' compiled templates — run php artisan view:cache after deploy',
        );
    }

    // ──────────────────────────────────────────────── Helpers ──

    private function passFail(bool $ok, string $pass, string $fail): void
    {
        if ($ok) {
            $this->line("  <fg=green>✓</> {$pass}");
        } else {
            $this->recordFailure($fail);
        }
    }

    private function warnOk(bool $ok, string $pass, string $warn): void
    {
        if ($ok) {
            $this->line("  <fg=green>✓</> {$pass}");
        } else {
            $this->recordWarning($warn);
        }
    }

    private function recordFailure(string $message): void
    {
        $this->failures++;
        $this->line("  <fg=red>✗ FAIL</> {$message}");
    }

    private function recordWarning(string $message): void
    {
        $this->warnings++;
        $this->line("  <fg=yellow>! WARN</> {$message}");
    }
}
