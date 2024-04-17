<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outage extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'start',
        'end',
        'location_id',
        'file_history_id',
        'address',
        'created_at',
        'updated_at'
    ];

    protected function casts(): array
    {
        return [
            'start' => 'timestamp',
            'end' => 'timestamp',
        ];
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(FileHistory::class);
    }


}
