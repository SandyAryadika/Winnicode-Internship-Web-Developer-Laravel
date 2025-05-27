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
        $author = Author::withCount('articles')
            ->with(['articles' => function ($query) {
                $query->latest()->take(5);
            }])
            ->findOrFail($id);

        return view('authors.show', compact('author'));
    }
}
