<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing users
        User::truncate();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test_'.time().'@example.com',
        ]);

        User::factory(9)->create();
    }
}