@extends('layouts.app')

@section('title', $category->name . ' - Kategori Artikel | Winnicode')

@include('partials.header')
@include('partials.navbar')

@section('content')
    <div class="container mx-auto px-4 py-8 flex gap-6">
        <div class="w-full lg:w-4/5">
            <div class="text-2xl font-bold mb-6">Kategori: {{ $category->name }}</div>

            @if ($articles->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($articles as $article)
                        <a href="{{ route('articles.show', $article->id) }}"
                            class="block h-full border rounded-md overflow-hidden shadow-sm group hover:shadow-lg transition duration-300 bg-white">

                            <div class="flex flex-col h-full">
                                <div class="w-full aspect-[16/9] overflow-hidden">
                                    <img src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('images/default.jpg') }}"
                                        alt="Thumbnail"
                                        class="w-full h-40 object-cover group-hover:brightness-90 transition duration-300">
                                </div>

                                <div class="p-4 flex flex-col justify-between flex-1">
                                    <div class="text-base font-semibold text-black group-hover:underline mb-1">
                                        {{ \Illuminate\Support\Str::limit($article->title, 60) }}
                                    </div>

                                    @if ($article->author)
                                        <div class="text-sm text-gray-500 mb-2">
                                            Oleh: {{ $article->author->name }}
                                        </div>
                                    @endif

                                    <div class="text-sm text-gray-600 mb-3">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 80) }}
                                    </div>

                                    <div class="flex items-center justify-between text-xs text-gray-400 mb-2">
                                        <div>
                                            {{ \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }}
                                        </div>

                                        <div class="flex gap-4 items-center text-gray-500">
                                            <span class="flex items-center gap-1">
                                                <img src="{{ asset('icons/visibilitydark.png') }}" alt="Views"
                                                    class="w-4 h-4">
                                                {{ number_format($article->views) }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <img src="{{ asset('icons/commentdark.png') }}" alt="Comments"
                                                    class="w-4 h-4">
                                                {{ $article->comments_count ?? 0 }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $articles->links() }}
                </div>

                @if ($relatedCategories->count())
                    <div class="mt-12">
                        <div class="border-t mb-3"></div>
                        <div class="text-2xl font-bold mb-6">Kategori Lainnya</div>

                        @foreach ($relatedCategories as $relCategory)
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                    {{ $relCategory->name }}
                                </h3>

                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                                    @foreach ($relCategory->latest_articles as $relArticle)
                                        <a href="{{ route('articles.show', $relArticle->id) }}"
                                            class="block h-full border rounded-md overflow-hidden shadow-sm group hover:shadow-lg transition duration-300 bg-white">
                                            <div class="flex flex-col h-full">
                                                <div class="w-full aspect-[16/9] overflow-hidden">
                                                    <img src="{{ $relArticle->thumbnail ? asset('storage/' . $relArticle->thumbnail) : asset('images/default.jpg') }}"
                                                        alt="Thumbnail"
                                                        class="w-full h-40 object-cover group-hover:brightness-90 transition duration-300">
                                                </div>
                                                <div class="p-4 flex flex-col justify-between flex-1">
                                                    <div
                                                        class="text-base font-semibold text-black group-hover:underline mb-1">
                                                        {{ \Illuminate\Support\Str::limit($relArticle->title, 60) }}
                                                    </div>
                                                    @if ($relArticle->author)
                                                        <div class="text-sm text-gray-500 mb-2">
                                                            Oleh: {{ $relArticle->author->name }}
                                                        </div>
                                                    @endif
                                                    <div class="text-sm text-gray-600 mb-3">
                                                        {{ \Illuminate\Support\Str::limit(strip_tags($relArticle->content), 80) }}
                                                    </div>
                                                    @if ($article->published_at)
                                                        <div class="text-xs text-gray-400 mt-1">
                                                            <span>{{ \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="text-gray-500">Tidak ada artikel dalam kategori ini.</div>
            @endif
        </div>

        <div class="w-full lg:w-1/5 hidden lg:block border-l border-gray-200 pl-6">
            <div class="font-semibold text-lg mb-4">Authors Lainnya</div>

            <div class="space-y-6">
                @php
                    $otherAuthors = \App\Models\Author::withCount([
                        'articles' => function ($q) {
                            $q->whereNotNull('published_at');
                        },
                    ])
                        ->has('articles')
                        ->inRandomOrder()
                        ->limit(4)
                        ->get();
                @endphp

                @foreach ($otherAuthors as $otherAuthor)
                    <a href="{{ route('authors.show', $otherAuthor->id) }}"
                        class="block bg-white border rounded-lg p-4 shadow-sm hover:shadow-lg transition hover:bg-gray-50">
                        <img src="{{ $otherAuthor->photo_url }}" alt="{{ $otherAuthor->name }}"
                            class="w-24 h-24 rounded-full object-cover mx-auto mb-3">
                        <div class="text-center font-semibold text-base text-black">
                            {{ $otherAuthor->name }}
                        </div>
                        <div class="text-xs text-gray-600 text-center mt-1">
                            {{ \Illuminate\Support\Str::limit($otherAuthor->bio, 80) }}
                        </div>
                        <div class="text-xs text-gray-500 text-center mt-2">
                            {{ $otherAuthor->articles_count }} artikel dipublikasikan
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    @include('partials.newsletter')
    @include('partials.footer')
@endsection
