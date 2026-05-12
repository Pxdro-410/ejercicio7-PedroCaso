<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Qualifying extends Model
{
    use HasFactory;

    protected $fillable = [
        'race_id',
        'driver_id',
        'position',
        'q1_time',
        'q2_time',
        'q3_time',
    ];

    protected $casts = [
        'position' => 'integer',
        'q1_time' => 'string',
        'q2_time' => 'string',
        'q3_time' => 'string',
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
