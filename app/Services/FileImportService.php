<?php

namespace App\Services;

use App\Imports\OutageImport;
use App\Models\FileHistory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class FileImportService
{
    protected string $fileUrl;
    protected string $fileName;
    protected string $tempFileMD5Hash;
    protected bool $importShouldContinue;

    public function __construct()
    {
        $this->setData();
        $this->performImportChecks();
    }

    public function handle(): void
    {
        if ($this->importShouldContinue) {
            $this->importOutageDocument();
        } else {
            $this->logStep('File data already imported to database, nothing to import...');
        }
    }

    private function setData(): void
    {
        $url = "https://elektrodistribucija.mk/Grid/Planned-disconnections.aspx?lang=mk-mk";
        preg_match('/Planirani-isklucuvanja-Samo-aktuelno(.*?).aspx/', file_get_contents($url), $match);
        $name = trim($match[1], '/');
        $this->fileUrl = "https://www.elektrodistribucija.mk/Files/Planirani-isklucuvanja-Samo-aktuelno/$name.aspx";

        $this->fileName = Str::remove('.aspx', basename($this->fileUrl));
        $this->fileName .= ".xlsx";

        if ($this->fileName === 'Planned_outages_MK.xlsx') {
            $this->fileName = now()->toDateString().'-'.$this->fileName;
        }

        $this->downloadTempDocument();
        $this->setMD5HashForTempFile();
    }

    private function importOutageDocument(): void
    {
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

        $recordsCount = $outageImport->getRowCount();

        $fileHistory->update(['entries_amount' => $recordsCount, 'md5_hash' => $this->tempFileMD5Hash]);

        $this->logStep("$this->fileName contents imported to database, $recordsCount entries created");
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

    public function logStep(string $message): void
    {
        Log::info($message);
    }

    private function downloadTempDocument(): void
    {
        if (Storage::missing("temp/$this->fileName")) {
            Storage::put("temp/$this->fileName", file_get_contents($this->fileUrl));
            $this->logStep("Downloaded file - $this->fileName to temporary folder");
        } else {
            $this->logStep("File - $this->fileName has already been downloaded");
        }
    }

    public function setMD5HashForTempFile(): void
    {
        $tempFileContents = Excel::toArray(null, "temp/$this->fileName");

        $this->tempFileMD5Hash = md5(json_encode($tempFileContents));
    }

    public function getAllMD5Hashes(): array
    {
        return FileHistory::whereNotNull('md5_hash')->pluck('md5_hash')->all();
    }

    private function performImportChecks(): void
    {
        $fileImported = $this->checkIfFileWasImported();

        $fileImported ? $this->deleteTempFile() : $this->moveToPublicFolder();

        $this->importShouldContinue = !$fileImported;
    }

    private function deleteTempFile(): void
    {
        Storage::delete("temp/$this->fileName");
        $this->logStep("Deleted file - $this->fileName from temporary folder");
    }

    private function moveToPublicFolder(): void
    {
        Storage::move("temp/$this->fileName", "public/$this->fileName");
        $this->logStep("Moved file - $this->fileName from temporary to public folder");
    }

    private function checkIfFileWasImported(): bool
    {
        $importedMD5Hashes = $this->getAllMD5Hashes();

        return in_array($this->tempFileMD5Hash, $importedMD5Hashes, true);
    }

}