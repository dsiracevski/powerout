<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cec_number',
        'properties',
    ];

    protected function casts()
    {
        return [
            'properties' => 'array',
        ];
    }

    public function outages(): HasMany
    {
        return $this->hasMany(Outage::class, 'location_id');
    }
}
