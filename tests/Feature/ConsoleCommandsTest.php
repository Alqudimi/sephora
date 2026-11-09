<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSqlSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConsoleCommandsTest extends TestCase
{
    use RefreshDatabase;

    public function test_production_check_command_detects_local_environment(): void
    {
        // When APP_ENV is testing/local and debug is true, production-check warns and exits non-zero
        $this->artisan('app:production-check')
            ->expectsOutputToContain('SEPHORA UAE — production launch readiness audit')
            ->assertExitCode(1);
    }

    public function test_production_check_strict_flag(): void
    {
        $this->artisan('app:production-check --strict')
            ->expectsOutputToContain('Result')
            ->assertExitCode(1);
    }

    public function test_db_import_sql_command_invokes_seeder(): void
    {
        $seederMock = $this->createMock(DatabaseSqlSeeder::class);
        $seederMock->expects($this->once())
            ->method('run')
            ->with(true);

        $this->app->instance(DatabaseSqlSeeder::class, $seederMock);

        $this->artisan('db:import-sql --force')
            ->expectsOutputToContain('Starting database.sql seeder pipeline...')
            ->expectsOutputToContain('Database pipeline execution complete.')
            ->assertSuccessful();
    }

    public function test_queue_run_workers_command_is_registered(): void
    {
        $this->artisan('app:queue-work --help')
            ->assertSuccessful()
            ->expectsOutputToContain('Spawn and supervise multiple parallel queue worker processes');
    }
}

