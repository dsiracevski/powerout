<?php

namespace App\Http\Controllers\Outages;

use App\Actions\ImportOutages;
use App\Http\Controllers\Controller;
use App\Services\OutageService;
use Illuminate\Http\RedirectResponse;

class ImportOutagesController extends Controller
{
    public function __invoke(OutageService $service, ImportOutages $import): RedirectResponse
    {
        return $import->run();
    }
}
