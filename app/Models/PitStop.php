<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PitStop extends Model
{
    use HasFactory;

    protected $fillable = [
        'race_id',
        'driver_id',
        'lap',
        'duration_ms',
    ];

    protected $casts = [
        'lap' => 'integer',
        'duration_ms' => 'integer',
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
