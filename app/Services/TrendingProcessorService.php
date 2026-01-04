<?php

namespace App\Services;

use App\Models\TrendingTopic;

class TrendingProcessorService
{
    public function process(array $data, string $source): void
    {
        foreach ($data as $keyword => $count) {
            TrendingTopic::updateOrCreate(
                ['keyword' => $keyword],
                [
                    'mentions' => $count,
                    'score' => $this->score($count),
                    'source' => $source
                ]
            );
        }
    }

    private function score(int $mentions): float
    {
        return round(log($mentions + 1) * 10, 2);
    }
}
