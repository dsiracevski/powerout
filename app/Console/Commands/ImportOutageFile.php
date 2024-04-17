<?php

namespace App\Console\Commands;

use App\Services\FileImportService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ImportOutageFile extends Command
{
    protected $signature = 'app:import-outage-file';
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            (new FileImportService())->handle();
        } catch (Exception $e) {
            Log::info('Import failed, check logs');
            Log::error($e->getMessage());
        }
    }
}
