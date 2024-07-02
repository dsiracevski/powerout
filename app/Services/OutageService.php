<?php

namespace App\Services;

use App\Models\FileHistory;
use App\Models\Outage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

readonly class OutageService
{
    public function __construct(
        private Outage $outage,
    ) {
    }

    public function getOutages(): Collection
    {
        return $this->outage->with('location')->get();
    }

    public function outagesEndingOn(string $date): \Illuminate\Support\Collection
    {
        return $this->outage->where('end', $date)->get();
    }

    public function checkIfFileContentsImported(string $fileName): bool
    {
        $fileDownloaded = Storage::exists("public/$fileName");

        if ($fileDownloaded) {
            $this->logStep('File with same name already exists! Checking if imported...');
            FileHistory::where('name', $fileName)->update(['updated_at' => now()]);
        }

        return FileHistory::where('name', $fileName)->exists();
    }

    public function logStep(string $message): void
    {
        Log::info($message);
    }
}