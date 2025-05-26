<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $results = Article::with('category')
            ->where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->orWhereHas('category', fn($q) => $q->where('name', 'like', "%{$query}%"))
            ->latest()
            ->paginate(10);

        return view('search.results', compact('results', 'query'));
    }
}
