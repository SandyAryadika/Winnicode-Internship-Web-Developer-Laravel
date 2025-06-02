<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function show($id)
    {
        $author = Author::withCount(['articles' => function ($query) {
            $query->whereNotNull('published_at');
        }])->findOrFail($id);

        $author = Author::with(['articles' => function ($query) {
            $query->withCount('comments');
        }])->findOrFail($id);

        $articles = Article::where('author_id', $author->id)
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->latest()
            ->paginate(12);

        return view('authors.show', compact('author', 'articles'));
    }
}
