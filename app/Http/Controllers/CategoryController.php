<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Author;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function show($id)
    {
        $page = request()->get('page', 1);

        $category = Cache::remember("category_{$id}_detail", now()->addMinutes(30), function () use ($id) {
            return Category::findOrFail($id);
        });

        $articles = Cache::remember("category_{$id}_articles_page_{$page}", now()->addMinutes(30), function () use ($id) {
            return Article::with(['author', 'category'])
                ->where('category_id', $id)
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->withCount('comments')
                ->orderByDesc('published_at')
                ->paginate(12);
        });

        $authors = Cache::remember("category_{$id}_top_authors", now()->addMinutes(30), function () {
            return Author::withCount([
                'articles' => function ($q) {
                    $q->where('status', 'published')->whereNotNull('published_at');
                }
            ])
                ->having('articles_count', '>', 0)
                ->orderByDesc('articles_count')
                ->take(4)
                ->get();
        });

        $relatedCategories = Cache::remember("category_{$id}_related_categories", now()->addMinutes(30), function () use ($id) {
            return \App\Models\Category::where('id', '!=', $id)
                ->inRandomOrder()
                ->limit(3)
                ->get()
                ->map(function ($cat) {
                    $cat->latest_articles = $cat->articles()
                        ->with('author')
                        ->where('status', 'published')
                        ->whereNotNull('published_at')
                        ->orderByDesc('published_at')
                        ->limit(4)
                        ->get();
                    return $cat;
                });
        });

        return view('categories.show', compact('category', 'articles', 'authors', 'relatedCategories'));
    }
}
