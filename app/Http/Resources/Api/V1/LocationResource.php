<?php

namespace App\Http\Resources\Api\V1;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

/** @mixin Location */
class LocationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type' => 'location',
            'id' => $this->id,
            'name' => $this->when(app()->getLocale() === 'en', function () {
                return Str::transliterate($this->name);
            }, $this->name),
            'cec_number' => $this->cec_number,
            'properties' => $this->properties,
        ];
    }
}
