<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /** @use HasFactory<\Database\Factories\VoteFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ranking_id',
        'place_id',
        'value'
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

    public function nomination()
    {
        return $this->belongsTo(Nomination::class, ['ranking_id', 'place_id'], ['ranking_id', 'place_id']);
    }
}
