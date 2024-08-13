<?php

namespace App\Http\Resources\Api\V1;

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
            'start' => $this->start,
            'end' => $this->end,
            'address' => $this->address,
            'relationships' => $this->when(
                $request->routeIs('outages.show'), [
                    'location' => new LocationResource($this->whenLoaded('location'))
                ]
            )
        ];
    }
}
