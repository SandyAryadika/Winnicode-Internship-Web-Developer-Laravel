<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $page = $request->get('page', 1);
        $cacheKey = 'search_' . md5($query) . "_page_{$page}";

        $results = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($query) {
            return Article::with(['category', 'author'])
                ->whereNotNull('published_at')
                ->where(function ($qbuilder) use ($query) {
                    $qbuilder->where('title', 'like', "%{$query}%")
                        ->orWhere('content', 'like', "%{$query}%")
                        ->orWhereHas('category', function ($categoryQuery) use ($query) {
                            $categoryQuery->where('name', 'like', "%{$query}%");
                        })
                        ->orWhereHas('author', function ($authorQuery) use ($query) {
                            $authorQuery->where('name', 'like', "%{$query}%");
                        });
                })
                ->withCount('comments')
                ->latest()
                ->paginate(12);
        });

        $results->appends(['q' => $query]);

        // Penulis yang cocok
        $matchedAuthors = Cache::remember("search_authors_" . md5($query), now()->addMinutes(10), function () use ($query) {
            return Author::withCount(['articles' => function ($q) {
                $q->whereNotNull('published_at');
            }])->where('name', 'like', "%{$query}%")->get();
        });

        // 🟡 Fallback: jika artikel tidak ditemukan, ambil dari penulis yang cocok
        if ($results->isEmpty() && $matchedAuthors->count()) {
            $author = $matchedAuthors->first(); // Ambil satu penulis pertama yang cocok

            $results = Article::with(['category', 'author'])
                ->whereNotNull('published_at')
                ->where('author_id', $author->id)
                ->withCount('comments')
                ->latest()
                ->paginate(12);

            $results->appends(['q' => $query]);
        }

        return view('search.results', compact('results', 'query', 'matchedAuthors'));
    }
}
