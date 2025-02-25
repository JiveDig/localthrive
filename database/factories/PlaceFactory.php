<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlaceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'site' => 'default',
            'published' => true,
            'collection' => 'places',
            'slug' => $this->faker->slug(),
            'data' => json_encode([
                'title' => $this->faker->company(),
                'description' => $this->faker->paragraph(),
            ]),
        ];
    }
}