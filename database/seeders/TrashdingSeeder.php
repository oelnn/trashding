<?php

namespace Database\Seeders;

use App\Models\TrendingTopic;
use Illuminate\Database\Seeder;

class TrashdingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        TrendingTopic::insert([
            [
                'keyword' => '#AIIndonesia',
                'mentions' => 12000,
                'score' => 87.3,
                'source' => 'x',
            ],
            [
                'keyword' => '#BanjirJakarta',
                'mentions' => 9800,
                'score' => 80.1,
                'source' => 'news',
            ],
            [
                'keyword' => '#Laravel',
                'mentions' => 7200,
                'score' => 70.5,
                'source' => 'developer',
            ],
        ]);
    }
}
