<?php

namespace App\Console\Commands;

use App\Models\FileHistory;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Facades\Excel;

class UpdateDocumentHashesCommand extends Command
{
    protected $signature = 'update:document-hashes';

    protected $description = 'Updates md5 hash for already imported files';

    public function handle(): void
    {
        $documentsTobeUpdated = $this->getDocumentsWithoutHashes();
        $documentsTobeUpdated->each(function (FileHistory $fileHistory) {
            $documentHash = $this->getHashForDocument($fileHistory->name);
            $fileHistory->update(['md5_hash' => $documentHash]);
        });
    }

    public function getDocumentsWithoutHashes(): Collection
    {
        return FileHistory::where('md5_hash', null)->get();
    }

    public function getHashForDocument(string $fileName): string
    {
        $tempFileContents = Excel::toArray((object) null, "public/$fileName");

        return md5(json_encode($tempFileContents));
    }
}
