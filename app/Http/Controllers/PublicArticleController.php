<?php

namespace App\Http\Controllers;

use App\Models\Article;

class PublicArticleController extends Controller
{
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
}
