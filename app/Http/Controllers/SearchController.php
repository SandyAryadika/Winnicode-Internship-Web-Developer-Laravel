<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Author;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        $results = Article::with(['category', 'author'])
            ->where(function ($qbuilder) use ($query) {
                $qbuilder->where('title', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%")
                    ->orWhereHas('category', function ($categoryQuery) use ($query) {
                        $categoryQuery->where('name', 'like', "%{$query}%");
                    })
                    ->orWhereHas('author', function ($authorQuery) use ($query) {
                        $authorQuery->where('name', 'like', "%{$query}%");
                    });
            })
            ->latest()
            ->paginate(10);

        $results->appends(['q' => $query]);

        $matchedAuthors = Author::where('name', 'like', "%{$query}%")->get();

        return view('search.results', compact('results', 'query', 'matchedAuthors'));
    }
}
