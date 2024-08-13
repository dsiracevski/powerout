<?php

namespace App\Http\Resources\Api\V1;

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
            'name' => $this->name,
            'cec_number' => $this->cec_number,
            'properties' => $this->properties,
        ];
    }
}
