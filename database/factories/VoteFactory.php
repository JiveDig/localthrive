<?php

namespace Database\Factories;

use App\Models\Place;
use App\Models\Ranking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'ranking_id' => Ranking::factory(),
            'place_id' => Place::factory(),
            'value' => $this->faker->randomElement([1, 1, 1, 1, -1]),
        ];
    }
}
