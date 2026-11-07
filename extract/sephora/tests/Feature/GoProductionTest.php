<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use App\Support\EnvFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * app:go-production — the one-command switch into production mode:
 * env rewriting, staff password rotation and demo-data pruning.
 */
class GoProductionTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    /** Copy the shipped .env.example into a sandbox the command may rewrite. */
    private function sandboxEnv(): string
    {
        $path = storage_path('framework/testing/go-production.env');
        @mkdir(dirname($path), 0777, true);
        copy(base_path('.env.example'), $path);

        return $path;
    }

    /**
     * @return array<string, bool|string>
     */
    private function commandOptions(string $path): array
    {
        return [
            '--domain' => 'sephora.example.com',
            '--db' => 'sqlite',
            '--mail' => 'log',
            '--payments' => 'fake',
            '--skip-caches' => true,
            '--env-file' => $path,
        ];
    }

    // ── EnvFile ──

    public function test_env_file_replaces_appends_and_uncomments(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'envfile');
        file_put_contents($path, "APP_ENV=local\n# DB_HOST=127.0.0.1\n");
        $env = new EnvFile($path);

        $env->set('APP_ENV', 'production');
        $env->set('DB_HOST', 'db.internal');
        $env->set('DB_PASSWORD', 'p@ss w0rd#1');

        $content = (string) file_get_contents($path);
        $this->assertStringContainsString('APP_ENV=production', $content);
        $this->assertStringNotContainsString('# DB_HOST=', $content);
        $this->assertStringContainsString('DB_HOST=db.internal', $content);
        $this->assertStringContainsString('DB_PASSWORD="p@ss w0rd#1"', $content);
        $this->assertSame('production', $env->get('APP_ENV'));
        unlink($path);
    }

    public function test_env_file_quotes_base64_keys_safely(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'envfile');
        file_put_contents($path, '');
        $env = new EnvFile($path);

        $key = 'base64:'.base64_encode(random_bytes(32));
        $env->set('APP_KEY', $key);

        $this->assertSame($key, $env->get('APP_KEY'));
        $this->assertStringContainsString('APP_KEY='.$key, (string) file_get_contents($path));
        unlink($path);
    }

    // ── Core production flags ──

    public function test_go_production_rewrites_the_env_file_for_launch(): void
    {
        $path = $this->sandboxEnv();

        $this->artisan('app:go-production', $this->commandOptions($path))
            ->expectsConfirmation('Generate a fresh APP_KEY? (logs everyone out)', 'no')
            ->assertSuccessful();

        $env = new EnvFile($path);
        $this->assertSame('production', $env->get('APP_ENV'));
        $this->assertSame('false', $env->get('APP_DEBUG'));
        $this->assertSame('https://sephora.example.com', $env->get('APP_URL'));
        $this->assertSame('true', $env->get('APP_FORCE_HTTPS'));
        $this->assertSame('127.0.0.1,::1', $env->get('TRUSTED_PROXIES'));
        $this->assertSame('sephora.example.com', $env->get('SESSION_DOMAIN'));
        $this->assertSame('true', $env->get('SESSION_SECURE_COOKIE'));
        $this->assertSame('daily', $env->get('LOG_CHANNEL'));
        $this->assertSame('warning', $env->get('LOG_LEVEL'));

        // A timestamped backup of the previous state is kept next to the file.
        $this->assertNotEmpty(glob($path.'.backup-*'));
    }

    public function test_go_production_rotates_the_app_key_when_asked(): void
    {
        $path = $this->sandboxEnv();
        $oldKey = (new EnvFile($path))->get('APP_KEY');

        $this->artisan('app:go-production', $this->commandOptions($path) + ['--key' => true])
            ->assertSuccessful();

        $newKey = (new EnvFile($path))->get('APP_KEY');
        $this->assertNotSame($oldKey, $newKey);
        $this->assertMatchesRegularExpression('/^base64:[A-Za-z0-9+\/]{43}=$/', (string) $newKey);
    }

    public function test_go_production_rejects_an_invalid_domain_and_changes_nothing(): void
    {
        $path = $this->sandboxEnv();

        $this->artisan('app:go-production', ['--domain' => 'not a domain!!'] + $this->commandOptions($path))
            ->expectsOutputToContain('not a valid domain')
            ->assertExitCode(1);

        $this->assertSame('local', (new EnvFile($path))->get('APP_ENV'), 'env must stay untouched');
    }

    // ── Account hardening ──

    public function test_go_production_rotates_seeder_staff_passwords(): void
    {
        $path = $this->sandboxEnv();
        $admin = User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@sephora.test',
            'password' => 'Sephora@Admin2024',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $this->artisan('app:go-production', $this->commandOptions($path) + ['--rotate-passwords' => true])
            ->expectsConfirmation('Generate a fresh APP_KEY? (logs everyone out)', 'no')
            ->expectsOutputToContain('shown only once')
            ->assertSuccessful();

        $this->assertFalse(Hash::check('Sephora@Admin2024', $admin->refresh()->password));
    }

    public function test_go_production_prunes_the_demo_customer_and_anonymises_their_orders(): void
    {
        $path = $this->sandboxEnv();
        $demo = User::query()->create([
            'name' => 'Demo Customer',
            'email' => 'demo@sephora.test',
            'password' => 'Sephora@Demo2024',
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        $product = $this->makeProduct();
        $order = Order::create([
            'user_id' => $demo->id,
            'order_number' => 'AE-260101-000001',
            'status' => 'completed',
            'payment_method' => 'card',
            'payment_status' => 'paid',
            'delivery_method' => 'standard',
            'customer_name' => 'Demo Customer',
            'customer_phone' => '+971500000000',
            'customer_email' => 'demo@sephora.test',
            'subtotal' => $product->price,
            'total' => $product->price,
        ]);

        $this->artisan('app:go-production', $this->commandOptions($path) + ['--prune-demo' => true])
            ->expectsConfirmation('Generate a fresh APP_KEY? (logs everyone out)', 'no')
            ->assertSuccessful();

        $this->assertDatabaseMissing('users', ['email' => 'demo@sephora.test']);
        // The order survives for bookkeeping, detached from the removed account.
        $this->assertSame($order->id, $order->refresh()->id);
        $this->assertNull($order->user_id);
    }

    public function test_go_production_without_demo_data_touches_no_users(): void
    {
        $path = $this->sandboxEnv();

        $this->artisan('app:go-production', $this->commandOptions($path))
            ->expectsConfirmation('Generate a fresh APP_KEY? (logs everyone out)', 'no')
            ->assertSuccessful();

        $this->assertSame(0, User::query()->count());
    }
}
