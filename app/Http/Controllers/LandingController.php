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
            ->withCount('comments')
            ->take(6)
            ->get();

        $beritaUtama = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->where('is_headline', true)
            ->orderByDesc('published_at')
            ->withCount('comments')
            ->take(6)
            ->get();

        $artikelSorotan = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->where('is_featured', true)
            ->orderByDesc('published_at')
            ->withCount('comments')
            ->take(5)
            ->get();

        $editorChoiceArticles = Article::with('author')
            ->where('is_editor_choice', true)
            ->latest()
            ->withCount('comments')
            ->take(6)
            ->get();

        $topContributors = Author::withCount('articles')
            ->orderByDesc('articles_count')
            ->take(5)
            ->get();

        $internasional = Article::whereHas('category', fn($q) => $q->where('name', 'Internasional'))
            ->latest()
            ->take(4)
            ->get();

        $rekomendasi = Article::inRandomOrder()->take(3)->get();

        return view('landing', [
            'beritaHangat' => $beritaHangat,
            'beritaUtama' => $beritaUtama,
            'artikelSorotan' => $artikelSorotan,
            'editorChoiceArticles' => $editorChoiceArticles,
            'topContributors' => $topContributors,
            'internasional' => $internasional,
            'rekomendasi' => $rekomendasi,
        ]);
    }
}
