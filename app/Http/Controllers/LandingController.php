<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Author;

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

        return view('landing', [
            'beritaHangat' => $beritaHangat,
            'beritaUtama' => $beritaUtama,
            'artikelSorotan' => $artikelSorotan,
            'editorChoiceArticles' => $editorChoiceArticles,
            'topContributors' => $topContributors,
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

        return view('articles.show', compact('article', 'relatedPosts'));
    }
}
