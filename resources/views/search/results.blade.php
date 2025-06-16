@extends('layouts.app')

@section('title', 'Hasil Pencarian Artikel & Penulis | Winnicode')

@section('head')
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
@endsection

@section('content')
    @include('partials.header')
    @include('partials.navbar')
    <section class="px-4 sm:px-6 lg:px-20 py-8 min-h-screen">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 flex items-center gap-2">
            <img src="{{ asset('images/result-search.png') }}" loading="lazy" alt="Search Icon" class="w-6 h-6">
            Hasil pencarian untuk: <span class="italic text-blue-600">"{{ $query }}"</span>
        </h2>

        @if ($matchedAuthors->count())
            <div class="mb-12 border-t">
                <h3 class="text-xl font-semibold mb-6 mt-4 text-black-700 flex items-center gap-2">
                    <img src="{{ asset('images/result-author.png') }}" loading="lazy" alt="Author Icon" class="w-8 h-8">
                    Penulis yang cocok:
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($matchedAuthors as $author)
                        <a href="{{ route('authors.show', $author->id) }}"
                            class="block bg-white p-6 rounded-md border border-gray-200 shadow-sm hover:shadow-md hover:ring-2 hover:ring-blue-200 hover:scale-[1.02] transition-all duration-200">
                            <div class="flex flex-col items-center text-center">
                                <img src="{{ $author->photo ? asset('storage/' . $author->photo) : asset('images/default-profile.png') }}"
                                    loading="lazy" alt="{{ $author->name }}"
                                    class="w-28 h-28 object-cover rounded-full border mb-4">
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

        @if ($results->count())
            <h3 class="text-xl font-semibold mb-6 mt-4 text-black-700 flex items-center gap-2">
                <img src="{{ asset('images/result-article.png') }}" loading="lazy" alt="Article Icon" class="w-8 h-8">
                Artikel yang sesuai:
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($results as $article)
                    <a href="{{ route('articles.show', $article->id) }}"
                        class="block bg-white border rounded-md overflow-hidden shadow-sm hover:shadow-lg transition duration-300"
                        style="border-color: #F2F4FF;">

                        <img src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('images/default.jpg') }}"
                            loading="lazy" alt="{{ $article->title }}" class="w-full h-48 object-cover">

                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-black mb-2 line-clamp-2">
                                {{ \Illuminate\Support\Str::limit($article->title, 50) }}
                            </h3>
                            <p class="text-xs text-gray-500 mb-2">
                                {{ $article->category->name ?? '-' }} |
                                {{ $article->author->name ?? 'Tim Winnicode' }}
                            </p>
                            <p class="text-sm text-gray-700 mb-2 line-clamp-2">
                                {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            <div class="flex justify-between items-center text-xs text-gray-500">
                                {{-- Tanggal Publish di kiri --}}
                                <span>
                                    {{ $article->published_at ? $article->published_at->format('d/m/Y') : 'Belum dipublikasikan' }}
                                </span>

                                {{-- Views & Comments di kanan --}}
                                <div class="flex items-center gap-4">
                                    <span class="flex items-center gap-1">
                                        <img src="{{ asset('icons/visibilitydark.png') }}" loading="lazy" class="w-4 h-4"
                                            alt="views">
                                        {{ number_format($article->views) }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <img src="{{ asset('icons/commentdark.png') }}" loading="lazy" class="w-4 h-4"
                                            alt="comments">
                                        {{ $article->comments_count ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600 mt-6">⚠️ Tidak ada hasil ditemukan.</p>
        @endif

        <div class="mt-8">
            {{ $results->links('pagination::tailwind') }}
        </div>
    </section>
    @include('partials.newsletter')
    @include('partials.footer')
@endsection
