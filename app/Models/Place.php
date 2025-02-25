<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Scopes\PlacesScope;

class Place extends Model
{
    use HasFactory;

    protected $table = 'entries';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PlacesScope);
    }

    public function nominations()
    {
        return $this->hasMany(Nomination::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
