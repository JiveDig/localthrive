<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RankingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'site' => 'default',
            'published' => true,
            'collection' => 'rankings',
            'slug' => $this->faker->slug(),
            'data' => json_encode([
                'title' => $this->faker->words(3, true),
                'description' => $this->faker->paragraph(),
            ]),
        ];
    }
}