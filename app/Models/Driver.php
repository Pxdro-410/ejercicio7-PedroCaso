<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Modelo que representa a un piloto de Fórmula 1
class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'first_name',
        'last_name',
        'nationality',
        'number',
        'dob',
    ];

    protected $casts = [
        'number' => 'integer',
        'dob' => 'date',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
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
