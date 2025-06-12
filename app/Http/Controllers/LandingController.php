<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    public function index()
    {
        $beritaHangat = Cache::remember('landing_berita_hangat', now()->addMinutes(10), function () {
            return Article::with(['category', 'author'])
                ->where('status', 'published')
                ->where('is_hot', true)
                ->orderByDesc('published_at')
                ->withCount('comments')
                ->take(6)
                ->get();
        });

        $beritaUtama = Cache::remember('landing_berita_utama', now()->addMinutes(10), function () {
            return Article::with(['category', 'author'])
                ->where('status', 'published')
                ->where('is_headline', true)
                ->orderByDesc('published_at')
                ->withCount('comments')
                ->take(6)
                ->get();
        });

        $artikelSorotan = Cache::remember('landing_artikel_sorotan', now()->addMinutes(10), function () {
            return Article::with(['category', 'author'])
                ->where('status', 'published')
                ->where('is_featured', true)
                ->orderByDesc('published_at')
                ->withCount('comments')
                ->take(5)
                ->get();
        });

        $editorChoiceArticles = Cache::remember('landing_editor_choice', now()->addMinutes(10), function () {
            return Article::with('author')
                ->where('is_editor_choice', true)
                ->latest()
                ->withCount('comments')
                ->take(6)
                ->get();
        });

        $topContributors = Cache::remember('landing_top_contributors', now()->addMinutes(30), function () {
            return Author::withCount('articles')
                ->orderByDesc('articles_count')
                ->take(5)
                ->get();
        });

        $internasional = Cache::remember('landing_internasional', now()->addMinutes(10), function () {
            return Article::whereHas('category', fn($q) => $q->where('name', 'Internasional'))
                ->latest()
                ->take(4)
                ->get();
        });

        $rekomendasi = Cache::remember('landing_rekomendasi', now()->addMinutes(5), function () {
            return Article::inRandomOrder()->take(3)->get();
        });

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
