<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nomination extends Model
{
    /** @use HasFactory<\Database\Factories\NominationFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ranking_id',
        'place_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ranking()
    {
        return $this->belongsTo(Ranking::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class, ['ranking_id', 'place_id'], ['ranking_id', 'place_id']);
    }
}
