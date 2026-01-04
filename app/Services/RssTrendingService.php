<?php

namespace App\Services;

use App\Models\TrendingTopic;
use App\Models\NewsArticle;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class RssTrendingService
{
    protected array $feeds = [
        'google' => 'https://news.google.com/rss?hl=id&gl=ID&ceid=ID:id',
        // Detik sering reset → kita jadikan opsional
        'cnn'    => 'https://www.cnnindonesia.com/rss',
        'kompas' => 'https://www.kompas.com/rss',
    ];

    public function fetch(): void
    {
        $keywords = [];

        foreach ($this->feeds as $source => $url) {
            try {
                $response = Http::timeout(10)
                    ->retry(2, 500)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Trashding Research Bot)'
                    ])
                    ->get($url);

                if (!$response->ok()) {
                    continue;
                }

                $xml = simplexml_load_string($response->body());
                if (!$xml || !isset($xml->channel->item)) {
                    continue;
                }

                foreach ($xml->channel->item as $item) {
                    $title = (string) $item->title;

                    $words = collect(
                        preg_split('/\s+/', strtolower($title))
                    )
                        ->filter(fn ($w) => strlen($w) > 5)
                        ->map(fn ($w) => Str::slug($w))
                        ->take(5);

                    foreach ($words as $word) {
                        $keywords[$word] = ($keywords[$word] ?? 0) + 1;

                        NewsArticle::create([
                            'title' => $title,
                            'source' => $source,
                            'topic' => $word,
                            'published_at' => now(),
                        ]);
                    }
                }

            } catch (\Throwable $e) {
                // LOG SAJA, JANGAN CRASH
                logger()->warning("RSS {$source} failed: " . $e->getMessage());
                continue;
            }
        }

        foreach ($keywords as $word => $count) {
            TrendingTopic::updateOrCreate(
                ['keyword' => $word],
                [
                    'mentions' => $count,
                    'score' => log($count + 1) * 10,
                    'source' => 'rss'
                ]
            );
        }
    }
}
