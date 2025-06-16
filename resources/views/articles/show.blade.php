@extends('layouts.app')

@section('title', $article->title . ' - Winnicode')

@section('head')
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
@endsection

@section('content')
    @include('partials.header')
    @include('partials.navbar')
    <div class="flex flex-wrap items-center justify-between text-sm px-4 md:px-10 text-gray-500 mt-4">
        <div class="flex items-center space-x-6">
            <a href="{{ route('authors.show', $article->author) }}">
                <img src="{{ $article->author->photo ? asset('storage/' . $article->author->photo) : asset('images/default.jpg') }}"
                    loading="lazy" class="w-14 h-14 rounded-full object-cover" alt="{{ $article->author->name }}">
            </a>
            <span>By <a href="{{ route('authors.show', $article->author) }}" class="text-blue-600 hover:underline">
                    {{ $article->author->name }}
                </a>
            </span>
            <span class="flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 9h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                {{ $article->published_at->format('d M Y') }}
            </span>
        </div>
        <div class="flex items-center gap-4 mt-2 sm:mt-0">
            <span class="flex items-center gap-1">
                <img src="{{ asset('icons/visibilitydark.png') }}" loading="lazy" alt="Views" class="w-4 h-4">
                {{ number_format($article->views) }} Views
            </span>
            <span class="flex items-center gap-1">
                <img src="{{ asset('icons/commentdark.png') }}" loading="lazy" alt="Comments" class="w-4 h-4">
                {{ $article->comments_count ?? 0 }} Comments
            </span>
        </div>
    </div>

    @if ($article->thumbnail)
        <div class="w-full px-4 md:px-10 lg:px-10 mt-6">
            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" loading="lazy"
                class="w-full h-[550px] object-cover shadow-md rounded-md">
        </div>
    @endif

    <section class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold text-center mb-4 text-[#252525]">
            {{ $article->title }}
        </h1>

        <article class="prose prose-lg max-w-none text-justify mb-12 ">
            {!! modifyArticleContent($article->content) !!}
        </article>

        @php
            $sections = [
                ['data' => $sameAuthor, 'title' => 'Dari penulis yang sama', 'id' => 'carousel-author'],
                ['data' => $sameCategory, 'title' => 'Dari kategori yang sama', 'id' => 'carousel-category'],
                ['data' => $editorChoice, 'title' => 'Rekomendasi untuk Anda', 'id' => 'carousel-editor'],
            ];
        @endphp

        <div class="mt-8 border-t pt-10">
            <h2 class="text-6xl font-semibold mb-4 text-[#252525] font-birthstone">Bacaan lainnya ></h2>

            @foreach ($sections as $section)
                @if ($section['data']->count())
                    <h3 class="text-xl font-semibold mb-2 text-[#252525]">{{ $section['title'] }}</h3>

                    <div class="relative">
                        <div id="{{ $section['id'] }}"
                            class="flex overflow-x-auto space-x-4 scroll-smooth snap-x snap-mandatory px-1 pb-4 no-scrollbar">
                            @foreach ($section['data'] as $related)
                                <div
                                    class="min-w-[300px] max-w-xs snap-start shrink-0 transition-shadow duration-300 shadow-sm hover:shadow-xl rounded-lg bg-white">
                                    @include('components.related-card', ['related' => $related])
                                </div>
                            @endforeach
                        </div>

                        {{-- Left Arrow --}}
                        <button onclick="scrollCarousel('{{ $section['id'] }}', -1)"
                            class="absolute -left-5 top-1/2 -translate-y-1/2 bg-white hover:bg-gray-100 text-black rounded-full shadow-md w-8 h-8 flex items-center justify-center z-10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        {{-- Right Arrow --}}
                        <button onclick="scrollCarousel('{{ $section['id'] }}', 1)"
                            class="absolute -right-5 top-1/2 -translate-y-1/2 bg-white hover:bg-gray-100 text-black rounded-full shadow-md w-8 h-8 flex items-center justify-center z-10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- Komentar --}}
        <div class="mt-6 border-t pt-10">
            <h2 class="text-6xl font-semibold font-birthstone mb-4 text-[#252525]">Komentar ></h2>

            @foreach ($article->comments as $comment)
                <div class="mb-4 border-b pb-2">
                    <p class="font-semibold text-[#252525]">{{ $comment->name }}</p>
                    <p class="text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
                    <p class="mt-2">{{ $comment->content }}</p>
                </div>
            @endforeach

            <form method="POST" action="{{ route('comments.store', $article->id) }}" class="mt-6 space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Nama Anda" required
                    class="w-full border px-4 py-2 rounded">
                <input type="email" name="email" placeholder="Email (opsional)" class="w-full border px-4 py-2 rounded">
                <textarea name="content" placeholder="Tulis komentar..." required class="w-full border px-4 py-2 rounded"></textarea>
                <button type="submit"
                    class="bg-blue-400 text-white px-6 py-2 rounded border border-gray-300 shadow-md hover:shadow-lg transition">
                    Kirim Komentar
                </button>
            </form>
        </div>
    </section>
    @include('partials.newsletter')
    @include('partials.footer')
@endsection
