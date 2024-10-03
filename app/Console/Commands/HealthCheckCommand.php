<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class HealthCheckCommand extends Command
{
    protected $signature = 'health:check';

    protected $description = 'Check the health of the application';

    public function handle()
    {
        try {
            // Check database connection
            DB::connection()->getPdo();

            // Check Redis connection
            Redis::connection()->ping();

            // Check if the storage directory is writable
            if (! is_writable(storage_path())) {
                throw new \Exception('Storage directory is not writable');
            }

            // Add more checks as needed

            $this->info('Health check passed');

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Health check failed: '.$e->getMessage());

            return Command::FAILURE;
        }
    }
}
