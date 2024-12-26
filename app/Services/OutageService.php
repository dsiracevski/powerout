<?php

namespace App\Services;


use App\Models\FileHistory;

final class OutageService
{
    public function getLastUpdateDate(): mixed
    {
        return FileHistory::latest()->first()->updated_at;
    }
}