<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;

class LandingController extends Controller
{
    public function index()
    {
        $beritaHangat  = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->where('is_hot', true)
            ->orderByDesc('published_at')
            ->take(6)
            ->get();

        $beritaUtama = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->where('is_headline', true)
            ->orderByDesc('published_at')
            ->take(6)
            ->get();

        $artikelSorotan = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->where('is_featured', true)
            ->orderByDesc('published_at')
            ->take(5)
            ->get();

        $editorChoiceArticles = Article::with('author')
            ->where('is_editor_choice', true)
            ->latest()
            ->take(6)
            ->get();

        $topContributors = Author::withCount('articles')
            ->orderByDesc('articles_count')
            ->take(5)
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('landing', [
            'beritaHangat' => $beritaHangat,
            'beritaUtama' => $beritaUtama,
            'artikelSorotan' => $artikelSorotan,
            'editorChoiceArticles' => $editorChoiceArticles,
            'topContributors' => $topContributors,
            'categories' => $categories,
        ]);
    }

    public function show($id)
    {
        $article = Article::with(['category', 'author'])->findOrFail($id);

        $relatedPosts = Article::where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest()
            ->take(4)
            ->get();

        $sameAuthor = Article::where('author_id', $article->author_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        $sameCategory = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        $editorChoice = Article::where('is_editor_choice', true)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedPosts', 'sameAuthor', 'sameCategory', 'editorChoice'));
    }

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
