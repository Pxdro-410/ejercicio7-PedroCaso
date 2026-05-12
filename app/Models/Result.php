<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'race_id',
        'driver_id',
        'grid',
        'position',
        'points',
        'fastest_lap',
        'time_ms',
        'status',
    ];

    protected $casts = [
        'grid' => 'integer',
        'position' => 'integer',
        'points' => 'decimal:2',
        'fastest_lap' => 'string',
        'time_ms' => 'integer',
    ];

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }
}
