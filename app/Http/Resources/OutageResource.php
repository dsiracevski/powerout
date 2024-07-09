<?php

namespace App\Http\Resources;

use App\Models\Outage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Outage */
class OutageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type' => 'outage',
            'id' => $this->id,
            'attributes' => [
                'start' => $this->start,
                'end' => $this->end,
                'address' => $this->address,
            ],
            'relationships' => $this->when(
                $request->routeIs('outages.show'), [
                    'data' => [
                        'location' => new LocationResource($this->whenLoaded('location'))
                    ],
                ]
            ),
            'links' => [
                'self' => route('outages.show', $this->id),
            ]
        ];
    }
}
