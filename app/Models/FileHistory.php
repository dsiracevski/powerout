<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FileHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'entries_amount',
        'md5_hash',
        'updated_at',
    ];

    public function outages(): HasMany
    {
        return $this->hasMany(Outage::class);
    }
}
