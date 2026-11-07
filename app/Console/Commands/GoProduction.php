<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Support\EnvFile;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

/**
 * One-command switch from the shipped demo/local state into a real
 * production configuration.
 *
 *   php artisan app:go-production
 *
 * Rewrites .env (domain, HTTPS, cookies, logging, database, mail, payments),
 * rotates seeder staff passwords, prunes the demo customer, warms every
 * optimisation cache in a fresh PHP process and finishes with the
 * production-check audit. Every value can also be supplied as an option
 * for non-interactive automation:
 *
 *   php artisan app:go-production --domain=shop.example.com \
 *     --db=mysql --mail=smtp --payments=stripe --rotate-passwords --prune-demo
 */
class GoProduction extends Command
{
    protected $signature = 'app:go-production
                            {--domain= : Live domain, e.g. sephora.example.com (skips the domain question)}
                            {--key : Generate a fresh APP_KEY (invalidates every session)}
                            {--db= : Database engine: mysql or sqlite (default: ask)}
                            {--mail= : Mail transport: smtp or log (default: ask)}
                            {--payments= : Payments driver: stripe or fake (default: ask)}
                            {--rotate-passwords : Rotate seeder staff passwords without asking}
                            {--prune-demo : Remove the demo customer without asking}
                            {--skip-caches : Do not warm caches / re-run the audit (tests)}
                            {--env-file= : Env file to rewrite (default: .env; used by tests)}';

    protected $description = 'Switch this installation into production mode (interactive)';

    private EnvFile $env;

    private string $domain = '';

    /** Every key => value this command has written to the env file so far. */
    private array $written = [];

    public function handle(): int
    {
        $path = (string) ($this->option('env-file') ?: base_path('.env'));

        if (! is_file($path)) {
            $this->error("Env file not found: {$path}");

            return self::FAILURE;
        }

        $this->env = new EnvFile($path);
        $automated = $this->option('domain') !== null;

        $this->components->twoColumnDetail('<fg=cyan;options=bold>SEPHORA UAE — go-production</>', $path);
        $this->newLine();

        if ($this->env->get('APP_ENV') === 'production' && ! $automated) {
            if (! $this->confirm('APP_ENV is already production — re-run anyway?', false)) {
                return self::SUCCESS;
            }
        }

        // Safety net: keep the previous state next to the new one.
        $backup = $path.'.backup-'.date('Ymd-His');
        copy($path, $backup);
        $this->line("  <fg=gray>Backup written to {$backup}</>");
        $this->newLine();

        $this->applyCoreFlags();
        if ($this->domain === '') {
            $this->error('Aborted — nothing except the backup was changed.');

            return self::FAILURE;
        }
        $this->maybeRotateKey();
        $this->configureDatabase();
        $this->configureMail();
        $this->configurePayments();
        $this->rotateStaffPasswords();
        $this->pruneDemoCustomer();

        if ($this->option('skip-caches')) {
            return self::SUCCESS;
        }

        $this->warmCaches();

        return $this->finalAudit();
    }

    // ──────────────────────────────────────────────── Steps ──

    /** @return string the validated domain, or "" when invalid */
    private function applyCoreFlags(): string
    {
        $this->line('<fg=magenta;options=bold>Core production flags</>');

        $domain = (string) ($this->option('domain') ?? $this->ask('Live domain (e.g. sephora.example.com)'));
        $domain = strtolower(trim(preg_replace('#^https?://#i', '', rtrim($domain, '/')) ?: ''));

        if (! preg_match('/^[a-z0-9]([a-z0-9-]*[a-z0-9])?(\.[a-z0-9]([a-z0-9-]*[a-z0-9])?)+$/', $domain)) {
            $this->error("'{$domain}' is not a valid domain name.");

            return '';
        }

        $this->domain = $domain;

        $this->write([
            'APP_ENV' => 'production',
            'APP_DEBUG' => 'false',
            'APP_URL' => "https://{$domain}",
            'APP_FORCE_HTTPS' => 'true',
            'TRUSTED_PROXIES' => '127.0.0.1,::1',
            'SESSION_DOMAIN' => $domain,
            'SESSION_SECURE_COOKIE' => 'true',
            'LOG_CHANNEL' => 'daily',
            'LOG_LEVEL' => 'warning',
        ]);

        $this->components->twoColumnDetail('APP_URL', "https://{$domain}");
        $this->components->twoColumnDetail('APP_ENV / APP_DEBUG', 'production / false');
        $this->components->twoColumnDetail('HTTPS + secure cookies + HSTS', 'enabled');
        $this->components->twoColumnDetail('Logging', 'daily files, level=warning');
        $this->newLine();

        return $domain;
    }

    private function maybeRotateKey(): void
    {
        if (! $this->option('key') && ! $this->confirm('Generate a fresh APP_KEY? (logs everyone out)', false)) {
            return;
        }

        $this->write(['APP_KEY' => 'base64:'.base64_encode(random_bytes(32))]);
        $this->components->twoColumnDetail('APP_KEY', 'rotated (old sessions invalidated)');
        $this->newLine();
    }

    private function configureDatabase(): void
    {
        $this->line('<fg=magenta;options=bold>Database</>');

        $engine = (string) ($this->option('db') ?? $this->choice(
            'Database engine',
            ['mysql' => 'MySQL / MariaDB — recommended for launch', 'sqlite' => 'Keep SQLite (small/demo only)'],
            'mysql',
        ));

        if ($engine !== 'mysql') {
            $this->components->twoColumnDetail('DB_CONNECTION', 'sqlite (unchanged — production-check will flag this)');
            $this->newLine();

            return;
        }

        $host = $this->anticipate('DB host', ['127.0.0.1'], '127.0.0.1');
        $port = (string) $this->anticipate('DB port', ['3306'], '3306');
        $database = (string) $this->ask('DB name (must exist: CREATE DATABASE sephora_uae …)', 'sephora_uae');
        $username = (string) $this->ask('DB username', 'sephora_app');
        $password = (string) $this->secret('DB password (input hidden)');

        $this->write([
            'DB_CONNECTION' => 'mysql',
            'DB_HOST' => $host,
            'DB_PORT' => $port,
            'DB_DATABASE' => $database,
            'DB_USERNAME' => $username,
            'DB_PASSWORD' => $password,
        ]);
        $this->components->twoColumnDetail('DB_CONNECTION', "mysql → {$database}@{$host}:{$port}");

        if (! $this->testMysqlConnection($host, (int) $port, $database, $username, $password)) {
            $this->warn('Could not connect yet — create the database/user, then run:');
            $this->line('  php artisan migrate --force && php artisan db:seed --force');
            $this->newLine();

            return;
        }

        $this->components->twoColumnDetail('Connection', 'ok');

        if ($this->confirm('Run migrations on this database now?', true)) {
            $this->artisan('migrate', '--force') && $this->components->twoColumnDetail('Migrations', 'applied');

            if ($this->confirm('Seed catalogue, settings and staff? (fresh database)', true)) {
                $this->artisan('db:seed', '--force') && $this->components->twoColumnDetail('Seeders', 'applied');
            }
        }

        $this->newLine();
    }

    private function configureMail(): void
    {
        $this->line('<fg=magenta;options=bold>Mail</>');

        $transport = (string) ($this->option('mail') ?? $this->choice(
            'Transactional mail transport',
            ['smtp' => 'SMTP — required so customers receive order emails', 'log' => 'Keep log mailer (dev only)'],
            'smtp',
        ));

        if ($transport !== 'smtp') {
            $this->components->twoColumnDetail('MAIL_MAILER', 'log (unchanged — production-check will flag this)');
            $this->newLine();

            return;
        }

        $host = (string) $this->anticipate('SMTP host', ['smtp.your-provider.com'], 'smtp.your-provider.com');
        $port = (string) $this->anticipate('SMTP port (587 TLS / 465 SMTPS)', ['587', '465'], '587');
        $username = (string) $this->ask('SMTP username (e.g. no-reply@your-domain.com)');
        $password = (string) $this->secret('SMTP password (input hidden)');
        $encryption = $port === '465' ? 'smtps' : 'tls';
        $from = (string) $this->ask('From address for order emails', $username ?: 'no-reply@your-domain.com');

        if (! filter_var($from, FILTER_VALIDATE_EMAIL)) {
            $from = 'no-reply@your-domain.com';
        }

        $this->write([
            'MAIL_MAILER' => 'smtp',
            'MAIL_HOST' => $host,
            'MAIL_PORT' => $port,
            'MAIL_USERNAME' => $username,
            'MAIL_PASSWORD' => $password,
            'MAIL_ENCRYPTION' => $encryption,
            'MAIL_FROM_ADDRESS' => $from,
        ]);

        $this->components->twoColumnDetail('MAIL_MAILER', "smtp → {$host}:{$port} ({$encryption})");
        $this->components->twoColumnDetail('MAIL_FROM_ADDRESS', $from);
        $this->newLine();
    }

    private function configurePayments(): void
    {
        $this->line('<fg=magenta;options=bold>Payments</>');

        $driver = (string) ($this->option('payments') ?? $this->choice(
            'Payments driver',
            ['stripe' => 'Stripe live keys — real money', 'fake' => 'Keep fake driver (sandbox only)'],
            'stripe',
        ));

        if ($driver !== 'stripe') {
            $this->components->twoColumnDetail('PAYMENTS_DRIVER', 'fake (unchanged — production-check will flag this)');
            $this->newLine();

            return;
        }

        $secret = (string) $this->secret('STRIPE_SECRET (sk_live_…)');
        $webhook = (string) $this->secret('STRIPE_WEBHOOK_SECRET (whsec_… — from the Stripe dashboard)');

        if (! str_starts_with($secret, 'sk_')) {
            $this->warn('That does not look like a Stripe secret key (sk_…). Written anyway — double-check it.');
        }

        $this->write([
            'PAYMENTS_DRIVER' => 'stripe',
            'STRIPE_SECRET' => $secret,
            'STRIPE_WEBHOOK_SECRET' => $webhook,
        ]);

        $this->components->twoColumnDetail('PAYMENTS_DRIVER', 'stripe');
        $this->components->twoColumnDetail('Webhook endpoint', "https://{$this->domain}/payments/webhook/stripe");
        $this->newLine();
    }

    private function rotateStaffPasswords(): void
    {
        $this->line('<fg=magenta;options=bold>Staff accounts</>');

        $staff = User::query()
            ->whereIn('email', array_keys(ProductionCheck::SEEDER_PASSWORDS))
            ->where('role', '!=', 'customer')
            ->get()
            ->filter(fn (User $user) => Hash::check(
                ProductionCheck::SEEDER_PASSWORDS[$user->email] ?? '',
                $user->password,
            ));

        if ($staff->isEmpty()) {
            $this->components->twoColumnDetail('Seeder passwords', 'none found (already rotated)');

            return;
        }

        if (! $this->option('rotate-passwords') && ! $this->confirm(
            count($staff).' staff account(s) still use the shipped seeder password. Rotate them now?',
            true,
        )) {
            $this->warn('Launch is blocked by production-check until these are rotated.');

            return;
        }

        foreach ($staff as $user) {
            $password = Str::password(24);
            $user->forceFill(['password' => $password])->save();
            $this->components->twoColumnDetail("  {$user->email}", "<fg=yellow;options=bold>{$password}</>");
        }

        $this->warn('Store these passwords in a password manager now — they are shown only once.');
        $this->newLine();
    }

    private function pruneDemoCustomer(): void
    {
        $demo = User::query()->where('email', 'demo@sephora.test')->first();

        if ($demo === null) {
            return;
        }

        if (! $this->option('prune-demo') && ! $this->confirm('Remove the demo customer (demo@sephora.test)? Its orders are kept but anonymised.', true)) {
            return;
        }

        $demo->delete();
        $this->components->twoColumnDetail('Demo customer', 'removed');
        $this->newLine();
    }

    // ──────────────────────────────────────────────── Helpers ──

    /**
     * Warm every optimisation cache in a fresh PHP process so the new
     * .env values (not this process' stale config) are cached.
     */
    private function warmCaches(): void
    {
        $this->line('<fg=magenta;options=bold>Optimisation caches</>');

        foreach ([
            ['config:clear'],
            ['config:cache'],
            ['route:cache'],
            ['event:cache'],
            ['view:cache'],
        ] as $args) {
            $ok = $this->artisan(...$args);
            $this->components->twoColumnDetail($args[0], $ok ? '<fg=green>done</>' : '<fg=red>FAILED</>');
        }

        $this->newLine();
    }

    private function finalAudit(): int
    {
        $this->line('<fg=magenta;options=bold>Final audit (fresh process)</>');

        $process = $this->process('app:production-check');
        $process->run();
        $this->output->write($process->getOutput());

        return $process->isSuccessful() ? self::SUCCESS : self::FAILURE;
    }

    private function artisan(string ...$args): bool
    {
        return $this->process(...$args)->run() === 0;
    }

    private function process(string ...$args): Process
    {
        return new Process(
            [PHP_BINARY, base_path('artisan'), ...$args],
            base_path(),
            $this->written,
            null,
            300,
        );
    }

    /** Write values to the env file and remember them for child processes. */
    private function write(array $values): void
    {
        $this->env->setMany($values);
        $this->written = $values + $this->written;
    }

    /*
     * Why children need the written values injected explicitly:
     *
     * Symfony Process merges the PARENT environment into every child, and
     * this process was booted with the OLD .env values in it (Dotenv is
     * immutable — it never overrides existing variables). A naive child
     * would therefore still see APP_ENV=local / the OLD database, even
     * with a freshly rewritten .env file on disk. Passing the new values
     * in the env array makes them win in both layers: they are exported
     * to the child AND Symfony strips them from SYMFONY_DOTENV_VARS so
     * the child's own Dotenv keeps them.
     */

    /** Probe the configured MySQL server without switching the default connection. */
    private function testMysqlConnection(string $host, int $port, string $database, string $username, string $password): bool
    {
        try {
            config(['database.connections._goproduction_probe' => [
                'driver' => 'mysql',
                'host' => $host,
                'port' => $port,
                'database' => $database,
                'username' => $username,
                'password' => $password,
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
            ]]);

            DB::connection('_goproduction_probe')->select('select 1');
            DB::purge('_goproduction_probe');

            return true;
        } catch (\Throwable) {
            DB::purge('_goproduction_probe');

            return false;
        }
    }
}
