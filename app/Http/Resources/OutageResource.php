<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Outage */
class OutageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id' => $this->id,
            'start' => $this->start,
            'end' => $this->end,
            'address' => $this->address,

            'location' => new LocationResource($this->whenLoaded('location')),
        ];
    }
}
