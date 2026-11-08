<?php

namespace App\Console\Commands;

use Database\Seeders\AdminUserSeeder;
use Database\Seeders\DatabaseSqlSeeder;
use Database\Seeders\DemoOrdersSeeder;
use Illuminate\Console\Command;

class ImportDatabaseSqlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:import-sql
                            {--force : Force re-importing database.sql even if already populated}
                            {--with-admin : Seed admin and staff accounts after import}
                            {--with-orders : Seed demo orders after import}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inject and populate project database from database.sql (idempotent)';

    /**
     * Execute the console command.
     */
    public function handle(DatabaseSqlSeeder $seeder): int
    {
        $force = (bool) $this->option('force');

        $this->info('Starting database.sql seeder pipeline...');

        $seeder->setCommand($this);
        $seeder->run($force);

        if ($this->option('with-admin')) {
            $this->info('Seeding admin accounts...');
            $this->call(AdminUserSeeder::class);
        }

        if ($this->option('with-orders')) {
            $this->info('Seeding demo orders...');
            $this->call(DemoOrdersSeeder::class);
        }

        $this->info('Database pipeline execution complete.');

        return self::SUCCESS;
    }
}

