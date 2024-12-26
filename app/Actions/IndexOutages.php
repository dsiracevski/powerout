<?php

namespace App\Actions;

use App\Http\Requests\BaseIndexRequest;
use App\Http\Resources\Api\V1\OutageResourceCollection;
use App\Models\Outage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class IndexOutages
{

    public function handle(BaseIndexRequest $request): OutageResourceCollection
    {
        OutageResourceCollection::make(
            QueryBuilder::for(
                Outage::class
            )
                ->allowedFilters([
                    AllowedFilter::scope('name', 'filter'),
                    AllowedFilter::scope('date', 'endDate'),
                ])
                ->with('location')
                ->orderByDesc('end')
                ->latest()
                ->paginate($request->limit)
                ->withQueryString()
        );
    }

}