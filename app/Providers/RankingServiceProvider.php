<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Statamic\Facades\Collection;
use App\Models\Ranking;
use Statamic\Facades\Entry;
use Illuminate\Support\Facades\Log;

class RankingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Collection::computed('rankings', 'nominations', function ($entry) {
            Log::info('Computing nominations for entry', [
                'entry_id' => $entry->id(),
                'collection' => $entry->collection()->handle()
            ]);

            // Get the Ranking model for this entry
            $ranking = Ranking::where('id', $entry->id())->first();

            if (!$ranking) {
                Log::warning('No ranking found for entry', [
                    'entry_id' => $entry->id()
                ]);
                return collect();
            }

            // Get nominations with their related places
            return $ranking->nominations()
                ->with('place')
                ->get()
                ->map(function ($nomination) {
                    // Get the Statamic entry for the place
                    $placeEntry = Entry::find($nomination->place_id);

                    if (!$placeEntry) {
                        Log::warning('No place entry found', [
                            'nomination_id' => $nomination->id,
                            'place_id' => $nomination->place_id
                        ]);
                        return null;
                    }

                    // Get the vote total for this nomination
                    $voteTotal = $nomination->place->votes()
                        ->where('ranking_id', $nomination->ranking_id)
                        ->sum('value');

                    // Return the nomination data structure
                    return [
                        'id' => $nomination->id,
                        'ranking_id' => $nomination->ranking_id,
                        'place_data' => $placeEntry,
                        'vote_total' => $voteTotal
                    ];
                })
                ->filter()
                ->sortByDesc('vote_total')
                ->values();
        });

        Collection::computed('rankings', 'total_votes', function ($entry) {
            $ranking = Ranking::where('id', $entry->id())->first();
            if (!$ranking) return 0;

            return $ranking->votes()->sum('value');
        });
    }

    public function register()
    {
        //
    }
}