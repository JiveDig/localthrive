<?php

namespace Database\Seeders;

use App\Models\Ranking;
use Illuminate\Database\Seeder;

class RankingSeeder extends Seeder
{
    public function run(): void
    {
        Ranking::factory(5)->create();
    }
}