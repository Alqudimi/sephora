<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class QueueRunWorkers extends Command
{
    protected $signature = 'app:queue-work
                            {--workers=2 : Number of parallel worker processes to spawn}
                            {--queue=payments,emails,default,low : Comma-separated list of queues}
                            {--timeout=60 : Maximum seconds a job may run}
                            {--tries=3 : Maximum attempts before failing a job}
                            {--memory=128 : Memory limit per worker in megabytes}
                            {--sleep=3 : Seconds to wait when no job is available}';

    protected $description = 'Spawn and supervise multiple parallel queue worker processes';

    /** @var array<int, Process> */
    private array $processes = [];

    private bool $running = true;

    public function handle(): int
    {
        $workerCount = max(1, (int) $this->option('workers'));
        $queue = (string) $this->option('queue');
        $timeout = (int) $this->option('timeout');
        $tries = (int) $this->option('tries');
        $memory = (int) $this->option('memory');
        $sleep = (int) $this->option('sleep');

        $this->components->info("Starting {$workerCount} Sephora Queue Worker(s)...");
        $this->components->twoColumnDetail('Queues', $queue);
        $this->components->twoColumnDetail('Tries / Timeout', "{$tries} attempts / {$timeout}s timeout");
        $this->components->twoColumnDetail('Memory limit', "{$memory} MB");
        $this->newLine();

        if (function_exists('pcntl_async_signals')) {
            pcntl_async_signals(true);
            pcntl_signal(SIGINT, fn () => $this->stop());
            pcntl_signal(SIGTERM, fn () => $this->stop());
        }

        // Spawn workers
        for ($i = 0; $i < $workerCount; $i++) {
            $this->startWorker($i, $queue, $timeout, $tries, $memory, $sleep);
        }

        $this->components->info('All workers are active and listening. Press Ctrl+C to terminate.');

        // Supervision loop
        while ($this->running) {
            foreach ($this->processes as $id => $process) {
                if (! $process->isRunning()) {
                    $exitCode = $process->getExitCode();
                    $this->warn("Worker #{$id} stopped (exit code: {$exitCode}). Restarting...");
                    $this->startWorker($id, $queue, $timeout, $tries, $memory, $sleep);
                }
            }

            usleep(500000); // 0.5s check
        }

        $this->shutdownWorkers();

        return self::SUCCESS;
    }

    private function startWorker(int $id, string $queue, int $timeout, int $tries, int $memory, int $sleep): void
    {
        $cmd = [
            PHP_BINARY,
            base_path('artisan'),
            'queue:work',
            '--queue='.$queue,
            '--timeout='.$timeout,
            '--tries='.$tries,
            '--memory='.$memory,
            '--sleep='.$sleep,
        ];

        $process = new Process($cmd, base_path(), null, null, null);
        $process->start();

        $this->processes[$id] = $process;
        $this->line("  <fg=green>✓</> Worker #{$id} [PID {$process->getPid()}] started.");
    }

    private function stop(): void
    {
        $this->running = false;
    }

    private function shutdownWorkers(): void
    {
        $this->newLine();
        $this->components->info('Gracefully stopping all workers...');

        foreach ($this->processes as $id => $process) {
            if ($process->isRunning()) {
                $process->stop(5);
                $this->line("  <fg=gray>Worker #{$id} stopped.</>");
            }
        }

        $this->components->info('All workers terminated.');
    }
}
