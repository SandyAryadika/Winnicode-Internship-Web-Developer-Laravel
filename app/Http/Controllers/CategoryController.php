<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Author;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::findOrFail($id);

        $articles = Article::with(['author', 'category'])
            ->where('category_id', $id)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->paginate(12);

        $authors = Author::withCount([
            'articles' => function ($q) {
                $q->where('status', 'published')->whereNotNull('published_at');
            }
        ])
            ->having('articles_count', '>', 0)
            ->orderByDesc('articles_count')
            ->take(4)
            ->get();

        $relatedCategories = \App\Models\Category::where('id', '!=', $category->id)
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

        return view('categories.show', compact('category', 'articles', 'authors', 'relatedCategories'));
    }
}
