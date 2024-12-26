<?php

namespace App\Actions;

use App\Services\FileImportService;
use App\Services\OutageService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;

final class ImportOutages
{
    public function __construct(private readonly OutageService $outageService)
    {
    }

    public function run(): mixed
    {
        $lastUpdate = $this->outageService->getLastUpdateDate();
        $isLastHour = Carbon::parse($lastUpdate)->isCurrentHour();

        if ($isLastHour) {
            return redirect()->back()->with([
                    'warning' => "Check again in " . floor(now()->copy()->endOfHour()->diffInMinutes(now(), true)) . ' minutes'
                ]
            );
        }

        return (new FileImportService())->handle();
    }

}