<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Race extends Model
{
    use HasFactory;

    protected $fillable = [
        'circuit_id',
        'season',
        'name',
        'date',
        'laps',
    ];

    protected $casts = [
        'season' => 'integer',
        'date' => 'date',
        'laps' => 'integer',
    ];

    public function circuit(): BelongsTo
    {
        return $this->belongsTo(Circuit::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function pitStops(): HasMany
    {
        return $this->hasMany(PitStop::class);
    }

    public function qualifyings(): HasMany
    {
        return $this->hasMany(Qualifying::class);
    }
}
