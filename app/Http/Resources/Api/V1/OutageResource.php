<?php

namespace App\Http\Resources\Api\V1;

use App\Models\Outage;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

/** @mixin Outage */
class OutageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'outage',
            'start' => $this->start->format('Y-m-d H:i:s'),
            'end' => $this->end->format('Y-m-d H:i:s'),
            'duration' => $this->start->locale('mk')->diffForHumans($this->end, CarbonInterface::DIFF_ABSOLUTE),
            'address' => $this->when(app()->getLocale() === 'en', function () {
                return Str::transliterate($this->address);
            }, $this->address),
            'status' => $this->status(),
            'location' => new LocationResource($this->whenLoaded('location'))
        ];
    }
}
