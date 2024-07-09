<?php

namespace App\Services;

use App\Imports\OutageImport;
use App\Models\FileHistory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class FileImportService
{
    protected string $fileUrl;
    protected string $fileName;

    protected string $latestDownloadedFile;

    public function __construct()
    {
        $this->setLatestDownloadedFile();
        $this->setData();
    }

    public function handle(): void
    {
        $outageService = app()->make(OutageService::class);
        $fileImported = $outageService->checkIfFileContentsImported($this->fileName, $this->latestDownloadedFile);

        if (!$fileImported) {
            $this->importOutageDocument();
        } else {
            $this->logStep('File data already imported to database, nothing to import...');
        }
    }

    private function setData(): void
    {
        $url = "https://elektrodistribucija.mk/Grid/Planned-disconnections.aspx?lang=en-us";
        preg_match('/Planirani-isklucuvanja-Samo-aktuelno(.*?).aspx/', file_get_contents($url), $match);
        $name = trim($match[1], '/');
        $this->fileUrl = "https://www.elektrodistribucija.mk/Files/Planirani-isklucuvanja-Samo-aktuelno/$name.aspx";

        $this->fileName = Str::remove('.aspx', basename($this->fileUrl));
        $this->fileName .= ".xlsx";

        if ($this->fileName === 'Planned_outages_MK.xlsx') {
            $this->fileName = now()->toDateString().'-'.$this->fileName;
        }
    }

    private function importOutageDocument(): void
    {
        $this->downloadDocument();

        $outageImport = new OutageImport($this->fileName);
        $fileHistory = $this->logFileName();
        $this->logStep("Import of file $this->fileName started...");

        Excel::import(
            $outageImport,
            $this->fileName,
            'public',
            \Maatwebsite\Excel\Excel::XLSX
        )
            ->toArray($outageImport, $this->fileName, 'public');

        $fileHistory->update(['entries_amount' => $outageImport->getRowCount()]);

        $this->logStep("$this->fileName contents imported to database");
    }

    public function logFileName(): FileHistory
    {
        return FileHistory::updateOrCreate(
            [
                'name' => $this->fileName,
                'entries_amount' => 0
            ]
        );
    }

    public function downloadDocument(): void
    {
        Storage::put("public/$this->fileName", file_get_contents($this->fileUrl));
        $this->logStep('The file was downloaded and logged');
    }

    public function logStep(string $message): void
    {
        Log::info($message);
    }

    private function setLatestDownloadedFile(): void
    {
        $allFiles = File::allFiles('storage/app/public');

        $this->latestDownloadedFile = collect($allFiles)
            ->filter(function ($file) {
                return $file->getExtension() === 'xlsx';
            })->sortBy(function ($file) {
                return $file->getCTime();
            })->last();

        $stringTobeRemoved = "storage/app/public\\";

        $this->latestDownloadedFile = Str::replace(search: $stringTobeRemoved, replace: '', subject: $this->latestDownloadedFile);
    }

}