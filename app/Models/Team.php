<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// Modelo que representa a una Escudería (equipo) de Fórmula 1
class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'principal',
        'base',
    ];

    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class);
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

    public function sponsors(): BelongsToMany
    {
        return $this->belongsToMany(Sponsor::class);
    }
}
