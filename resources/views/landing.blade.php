@extends('layouts.app')

@section('title', 'Winnicode')

@section('content')
    @include('partials.header')
    @include('partials.navbar')
    @include('partials.berita-terkini')
    @include('partials.berita-utama')
    @include('partials.sorotan')
    @include('partials.pilihan-penulis')
    @include('partials.kontributor')
    @php
        $categoriesWithArticles = \App\Models\Category::has('articles')->get();
        $kategoriAcak = $categoriesWithArticles->random();
        $artikelKategori = \App\Models\Article::where('category_id', $kategoriAcak->id)->latest()->get();
    @endphp

    @include('partials.lower-category', [
        'kategoriAcak' => $kategoriAcak,
        'artikelKategori' => $artikelKategori,
        'rekomendasi' => $rekomendasi,
    ])
    @include('partials.newsletter')
    @include('partials.footer')
@endsection
