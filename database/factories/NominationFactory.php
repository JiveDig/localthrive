<?php

namespace Database\Factories;

use App\Models\Place;
use App\Models\Ranking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nomination>
 */
class NominationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Don't create relationships here since we'll provide them in the seeder
        return [
            'user_id' => null,
            'ranking_id' => null,
            'place_id' => null,
        ];
    }
}
