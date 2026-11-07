<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\Process\Process;
use Tests\TestCase;

/**
 * Production hardening: HTTPS enforcement, HSTS, trusted proxies and the
 * pre-launch readiness audit command.
 */
class ProductionHardeningTest extends TestCase
{
    use RefreshDatabase;

    // ── ForceHttps middleware ──

    public function test_http_requests_are_redirected_when_force_https_is_enabled(): void
    {
        config(['app.force_https' => true]);

        $response = $this->call('GET', 'http://localhost/cart');

        $response->assertStatus(301);
        $this->assertSame('https://localhost/cart', $response->headers->get('Location'));
    }

    public function test_https_requests_pass_through_when_force_https_is_enabled(): void
    {
        config(['app.force_https' => true]);

        $this->get('https://localhost/')->assertOk();
    }

    public function test_no_redirect_when_force_https_is_disabled(): void
    {
        config(['app.force_https' => false]);

        $this->get('/')->assertOk();
    }

    // ── HSTS header ──

    public function test_hsts_header_is_sent_on_secure_responses(): void
    {
        $this->get('https://localhost/')->assertOk()
            ->assertHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
    }

    public function test_hsts_header_is_never_sent_over_plain_http(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $this->assertNull($response->headers->get('Strict-Transport-Security'));
    }

    // ── Trusted proxies ──

    public function test_forwarded_proto_from_a_trusted_proxy_is_honoured(): void
    {
        config(['app.trusted_proxies' => '10.0.0.1']);

        // Behind the proxy: request claims https via X-Forwarded-Proto.
        $response = $this->call('GET', 'http://localhost/', [], [], [], [
            'REMOTE_ADDR' => '10.0.0.1',
            'HTTP_X_FORWARDED_PROTO' => 'https',
        ]);

        // Secure per the proxy header → no redirect (force_https off) and HSTS applied.
        $response->assertOk();
        $response->assertHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
    }

    public function test_forwarded_proto_from_an_untrusted_ip_is_ignored(): void
    {
        config(['app.trusted_proxies' => '10.0.0.1']);

        $response = $this->call('GET', 'http://localhost/', [], [], [], [
            'REMOTE_ADDR' => '203.0.113.9', // attacker-controlled hop
            'HTTP_X_FORWARDED_PROTO' => 'https',
        ]);

        // Not secure → no HSTS header, proving the spoof was ignored.
        $this->assertNull($response->headers->get('Strict-Transport-Security'));
    }

    // ── URL generation under force_https ──

    public function test_urls_are_generated_with_https_when_forced(): void
    {
        // RefreshDatabase (setUp) boots the app before this method runs, so
        // the provider must be booted again to pick the flag up — this is
        // exactly what happens on a production boot with APP_FORCE_HTTPS=true.
        config(['app.force_https' => true]);
        (new AppServiceProvider($this->app))->boot();

        $this->assertStringStartsWith('https://', route('home'));
    }

    // ── Readiness audit command ──

    public function test_production_check_reports_failures_and_exits_non_zero(): void
    {
        // Default test env: sqlite, log mailer, fake payments, localhost URL.
        $this->artisan('app:production-check')
            ->expectsOutputToContain('production launch readiness audit')
            ->assertExitCode(1);
    }

    public function test_production_check_flags_default_seeder_passwords(): void
    {
        User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@sephora.test',
            'password' => 'Sephora@Admin2024',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $this->artisan('app:production-check')
            ->expectsOutputToContain('seeder password')
            ->assertExitCode(1);
    }

    public function test_production_check_strict_mode_elevates_warnings_to_failures(): void
    {
        // Any warning (e.g. cold caches in tests) must block under --strict.
        $this->artisan('app:production-check', ['--strict' => true])
            ->assertExitCode(1);
    }

    // ── Optimisation caches ──

    public function test_production_optimisation_caches_build_cleanly(): void
    {
        // `route:cache` serialises every route in a fresh process: a duplicate
        // route name (LogicException) or a closure route would abort a real
        // deployment, so this guards the launch path itself.
        foreach (['config:cache', 'route:cache', 'event:cache'] as $command) {
            $process = new Process(
                // Note: the space-separated form ("config cache") is not
                // accepted by Laravel 13 — always pass the colon form.
                [PHP_BINARY, base_path('artisan'), $command],
                base_path(),
                null,
                null,
                300,
            );
            $process->run();

            $this->assertSame(
                0,
                $process->getExitCode(),
                "`{$command}` failed:\n".trim($process->getOutput()."\n".$process->getErrorOutput()),
            );
        }
    }

    protected function tearDown(): void
    {
        // Caches built by the test above embed test configuration — never keep them.
        foreach (['config.php', 'routes-v7.php', 'events.php'] as $file) {
            @unlink(base_path('bootstrap/cache/'.$file));
        }

        parent::tearDown();
    }
}
