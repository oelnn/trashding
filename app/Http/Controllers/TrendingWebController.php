<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrendingTopic;
use App\Models\NewsArticle;
use App\Models\Comment;

class TrendingWebController extends Controller
{
    public function index(Request $request)
    {
        $query = TrendingTopic::query();

        if ($request->filled('q')) {
            $query->where('keyword', 'like', '%' . $request->q . '%');
        }

        $trendingTopics = $query
            ->orderByDesc('score')
            ->limit(30)
            ->get();

        return view('trending.index', [
            'trendingTopics' => $trendingTopics,
            'q' => $request->q,
        ]);
    }

    public function show(string $keyword)
    {
        return view('trending.show', [
            'topic' => $keyword,
            'articles' => NewsArticle::where('topic', $keyword)
                ->latest()
                ->limit(10)
                ->get(),
            'comments' => Comment::where('topic', $keyword)
                ->latest()
                ->get(),
        ]);
    }
}
