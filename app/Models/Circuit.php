<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Circuit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'country',
        'length_km',
        'turns',
    ];

    protected $casts = [
        'length_km' => 'decimal:3',
        'turns' => 'integer',
    ];

    public function races(): HasMany
    {
        return $this->hasMany(Race::class);
    }
}
