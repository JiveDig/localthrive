<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Statamic\Facades\Collection;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class VoteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Collection::computed('nominations', 'vote_total', function ($entry) {
            return Vote::where([
                'ranking_id' => $entry->get('ranking_id'),
                'place_id' => $entry->get('place_data')->id()
            ])->sum('value');
        });

        Collection::computed('nominations', 'user_vote', function ($entry) {
            if (!Auth::check()) {
                return null;
            }

            $vote = Vote::where([
                'user_id' => Auth::id(),
                'ranking_id' => $entry->get('ranking_id'),
                'place_id' => $entry->get('place_data')->id()
            ])->first();

            return $vote ? $vote->value : null;
        });
    }

    public function register()
    {
        //
    }
}