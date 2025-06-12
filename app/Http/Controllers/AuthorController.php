<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AuthorController extends Controller
{
    public function show($id)
    {
        $author = Cache::remember("author_{$id}_info", now()->addMinutes(30), function () use ($id) {
            return Author::withCount(['articles' => function ($query) {
                $query->whereNotNull('published_at');
            }])->with(['articles' => function ($query) {
                $query->withCount('comments');
            }])->findOrFail($id);
        });

        $page = request()->get('page', 1);

        $articles = Cache::remember("author_{$id}_articles_page_{$page}", now()->addMinutes(30), function () use ($id) {
            return Article::where('author_id', $id)
                ->whereNotNull('published_at')
                ->orderByDesc('published_at')
                ->latest()
                ->paginate(12);
        });

        return view('authors.show', compact('author', 'articles'));
    }
}
