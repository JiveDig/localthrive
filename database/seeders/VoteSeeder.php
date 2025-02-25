<?php

namespace Database\Seeders;

use App\Models\Nomination;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $nominations = Nomination::all();

        foreach ($nominations as $nomination) {
            // Create 3-8 votes per nomination
            $numVotes = rand(3, 8);
            $randomUsers = $users->random($numVotes);

            foreach ($randomUsers as $user) {
                Vote::factory()->create([
                    'user_id' => $user->id,
                    'ranking_id' => $nomination->ranking_id,
                    'place_id' => $nomination->place_id,
                ]);
            }
        }
    }
}
