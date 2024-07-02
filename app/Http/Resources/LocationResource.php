<?php

namespace App\Http\Resources;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Location */
class LocationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type' => 'location',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'cec_number' => $this->cec_number,
                'properties' => $this->properties,
            ],
            'links' => [
                'self' => route('locations.show', ['location' => $this->id]),
            ]
        ];
    }
}
