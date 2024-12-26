<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(FileHistory::class);
    }

    protected function duration(): string
    {
        return $this->start->diffForHumans($this->end);
    }

    public function scopeFilter(Builder $builder, $search = ''): Builder
    {
        return $builder->where(function (Builder $builder) use ($search) {
            return $builder->when($search, function ($query) use ($search) {
                return $query->where('address', 'like', '%'.$search.'%')
                    ->orWhereRelation('location', 'name', 'like', '%'.$search.'%');
            });
        });
    }

    public function scopeDate(Builder $builder, $date = null): Builder
    {
        $date = Carbon::parse($date)->format('Y-m-d');

        return $builder->where(function (Builder $builder) use ($date) {
            $builder->when($date, function ($query) use ($date) {
                return $query->whereDate('start', '<=', $date)
                    ->whereDate('end', '>=', $date);
            });
        });
    }

    public function scopeActive(Builder $builder, $date): Builder
    {
        return $builder->where(function (Builder $builder) use ($date) {
            return $builder->when($date, function ($query) use ($date) {
                return $query->whereDate('end', $date);
            });
        });
    }

    public function scopeStatus(): string
    {
        return match (true) {
            now()->lt($this->start) => 'Upcoming',
            now()->gt($this->start) => 'Finished',
            now()->between($this->start, $this->end) => 'Active'
        };
    }
}
