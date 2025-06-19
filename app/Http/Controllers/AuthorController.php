<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AuthorController extends Controller
{
    public function show($id)
    {
        $author = Cache::remember("author_{$id}_info", now()->addMinutes(10), function () use ($id) {
            return Author::withCount([
                'publishedArticles as articles_count' // alias untuk konsistensi
            ])->with([
                'publishedArticles' => function ($query) {
                    $query->withCount('comments');
                }
            ])->findOrFail($id);
        });

        $page = request()->get('page', 1);

        $articles = Cache::remember("author_{$id}_articles_page_{$page}", now()->addMinutes(10), function () use ($id) {
            return Article::where('author_id', $id)
                ->whereNotNull('published_at')
                ->withCount('comments')
                ->orderByDesc('published_at')
                ->paginate(12);
        });

        return view('authors.show', compact('author', 'articles'));
    }
}
