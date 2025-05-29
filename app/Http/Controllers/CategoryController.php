<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

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

        return view('categories.show', compact('category', 'articles'));
    }
}
