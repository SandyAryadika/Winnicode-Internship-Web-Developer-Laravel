@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@include('partials.header')
@include('partials.navbar')
@section('content')
    <section class="px-4 sm:px-6 lg:px-20 py-8 bg-gray-50 min-h-screen">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            🔍 Hasil pencarian untuk: <span class="italic text-blue-600">"{{ $query }}"</span>
        </h2>

        {{-- Bagian Penulis --}}
        @if ($matchedAuthors->count())
            <div class="mb-12">
                <h3 class="text-xl font-semibold mb-6 text-gray-700">👤 Penulis yang cocok:</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($matchedAuthors as $author)
                        <a href="{{ route('authors.show', $author->id) }}"
                            class="block bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md hover:ring-2 hover:ring-blue-200 hover:scale-[1.02] transition-all duration-200">
                            <div class="flex flex-col items-center text-center">
                                <img src="{{ $author->photo ? asset('storage/' . $author->photo) : asset('images/default-profile.png') }}"
                                    alt="{{ $author->name }}" class="w-20 h-20 object-cover rounded-full border mb-4">
                                <h4 class="text-lg font-bold text-gray-800 mb-1">{{ $author->name }}</h4>
                                <p class="text-sm text-gray-500 mb-2">{{ $author->articles->count() }} artikel</p>
                                <p class="text-sm text-gray-600 italic line-clamp-2">
                                    {{ $author->bio ?? 'Belum ada bio.' }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Bagian Artikel --}}
        @if ($results->count())
            <h3 class="text-md font-semibold mb-3 text-gray-700"> Artikel yang sesuai:</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($results as $article)
                    <div class="bg-white overflow-hidden border hover:shadow-lg transition border"
                        style="border-color: #F2F4FF;">
                        <a href="{{ route('articles.show', $article->id) }}"
                            class="block bg-white rounded-md overflow-hidden border hover:shadow-lg transition border"
                            style="border-color: #F2F4FF;">
                            <img src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('images/default.jpg') }}"
                                alt="{{ $article->title }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-blue-700 mb-1">
                                    {{ \Illuminate\Support\Str::limit($article->title, 50) }}
                                </h3>
                                <p class="text-xs text-gray-500 mb-1">
                                    {{ $article->category->name ?? '-' }} |
                                    {{ $article->published_at ? $article->published_at->format('d M Y') : 'Belum dipublikasikan' }}
                                    |
                                    {{ $article->author->name ?? 'Tim Winnicode' }}
                                </p>
                                <p class="text-sm text-gray-700">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 100) }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600 mt-6">⚠️ Tidak ada hasil ditemukan.</p>
        @endif

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $results->links('pagination::tailwind') }}
        </div>
    </section>
    @include('partials.footer')
@endsection
