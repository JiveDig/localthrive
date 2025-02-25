<?php

namespace Database\Seeders;

use App\Models\Nomination;
use App\Models\Place;
use App\Models\Ranking;
use App\Models\User;
use Illuminate\Database\Seeder;

class NominationSeeder extends Seeder
{
    public function run(): void
    {
        // Get actual existing records
        $users = User::all();         // These have regular auto-incrementing IDs (1, 2, 3...)
        $rankings = Ranking::all();   // These have UUIDs from entries table
        $places = Place::all();       // These have UUIDs from entries table

        // Debug what we're getting
        dump([
            'first_ranking' => $rankings->first()->id,
            'first_place' => $places->first()->id,
        ]);

        foreach ($rankings as $ranking) {
            // Create 3-10 nominations per ranking
            $numNominations = rand(3, 10);
            $randomPlaces = $places->random($numNominations);

            foreach ($randomPlaces as $place) {
                dump([
                    'creating_nomination' => [
                        'user_id' => $users->random()->id,
                        'ranking_id' => $ranking->id,
                        'place_id' => $place->id,
                    ]
                ]);

                // Here we use the actual IDs from existing records
                Nomination::factory()->create([
                    'user_id' => $users->random()->id,      // This will be a number like 1, 2, 3...
                    'ranking_id' => $ranking->id,           // This will be a UUID
                    'place_id' => $place->id,               // This will be a UUID
                ]);
            }
        }
    }
}
