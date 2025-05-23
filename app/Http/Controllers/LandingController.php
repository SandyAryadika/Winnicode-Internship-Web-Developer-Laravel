<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

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

        return view('landing', [
            'beritaHangat' => $beritaHangat,
        ]);
    }
}
