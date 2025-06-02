<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'content' => 'required|string',
        ]);

        $article->comments()->create($request->only('name', 'email', 'content'));

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
