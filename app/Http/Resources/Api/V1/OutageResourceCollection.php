<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

/** @see \App\Models\Outage */
class OutageResourceCollection extends ResourceCollection
{
    public array $pagination = [];

//    public function __construct($resource, string|array $filter = null, string $state = null)
//    {
//        if ($resource instanceof LengthAwarePaginator) {
//            $this->pagination = [
//                'page' => $resource->currentPage(),
//                'limit' => $resource->perPage(),
//                'total_records' => $resource->total(),
//                'total_pages' => $resource->lastPage(),
//                'filter' => $filter ?? '',
//                'state' => $state ?? '',
//            ];
//        }
//
//        parent::__construct($resource);
//    }

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
        ];
    }

//    public function withResponse($request, $response): void
//    {
//        $data = $response->getData(true);
//        unset($data['meta'], $data['links']);
//
//        if (count($this->pagination)) {
//            $data = array_merge($this->pagination, $data['data']);
//        }
//
//        $response->setData($data);
//    }
}
