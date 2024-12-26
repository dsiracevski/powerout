<?php

namespace App\Http\Controllers\Outages;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\OutageResourceCollection;
use App\Models\Outage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Inertia\Inertia;
use App\Http\Requests\BaseIndexRequest;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OutageController extends Controller
{
    public function __invoke(BaseIndexRequest $request)
    {
        $outages = OutageResourceCollection::make(
            QueryBuilder::for(
                Outage::class
            )
                ->allowedFilters([
                    AllowedFilter::scope('name', 'filter'),
                    AllowedFilter::scope('date', 'date'),
                ])
                ->when(!Arr::exists($request->filter, 'date'), function (Builder $query) {
                    $query->whereDate('start', now());
                })
                ->with('location')
                ->orderByDesc('end')
                ->latest()
                ->paginate(perPage: $request->limit, page:  (int)$request->page)
                ->withQueryString());

        return Inertia::render('Index', [
                'outages' => $outages,
                'filters' => $request->all(),
            ]
        );
    }
}
