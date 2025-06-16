@extends('layouts.app')

@section('title', $author->name . ' - Profil Penulis | Winnicode')

@section('head')
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
@endsection

@section('content')
    @include('partials.header')
    @include('partials.navbar')
    <section class="py-10 px-6 max-w-screen-xl mx-auto">
        <h2 class="text-6xl font-semibold font-birthstone mb-6 pl-6">Profile Penulis <span class="text-[#FF66C4]">&gt;</span>
        </h2>

        @if ($author)
            <div class="flex justify-center mb-8">
                <div
                    class="bg-white rounded-lg p-6  flex flex-col items-center text-center md:flex-row md:items-center md:text-left md:gap-6">
                    <img src="{{ $author->photo ? asset('storage/' . $author->photo) : asset('images/default.jpg') }}"
                        loading="lazy" alt="{{ $author->name }}" class="w-48 h-48 rounded-full object-cover mb-4 md:mb-0">
                    <div>
                        <h3 class="text-2xl font-bold text-[#252525]">{{ $author->name }}</h3>
                        <p class="text-medium text-[#252525] mt-3">{{ $author->articles->count() }} artikel</p>
                        <p class="text-medium text-[#252525] mt-3 italic">{{ $author->bio ?? 'Belum ada bio.' }}</p>
                        <p class="text-medium text-gray-800 mt-3">Bergabung sejak
                            {{ $author->created_at->translatedFormat('F Y') }}</p>
                        <p class="text-medium text-[#252525] mt-3">
                            Total views: <span
                                class="font-semibold">{{ number_format($author->articles->sum('views')) }}</span> |
                            Total komentar: <span
                                class="font-semibold">{{ $author->articles->sum('comments_count') }}</span>
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div class="border-t border-gray-300 pt-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($articles as $article)
                    <a href="{{ route('articles.show', $article->id) }}"
                        class="flex flex-col bg-white overflow-hidden border shadow-sm rounded-md transition-all duration-300 hover:shadow-lg hover:scale-[1.01] hover:ring-2 hover:ring-blue-200 h-full">
                        <img src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('images/default.jpg') }}"
                            loading="lazy" alt="{{ $article->title }}" class="w-full h-40 object-cover">
                        <div class="p-4 flex flex-col flex-grow">
                            <h4 class="text-base font-semibold text-gray-800 mb-1">
                                {{ Str::limit($article->title, 50) }}
                            </h4>
                            <p class="text-xs text-gray-500 mb-1">
                                {{ $article->category->name ?? '-' }}
                            </p>
                            <p class="text-sm text-gray-600 mb-1">
                                {{ Str::limit(strip_tags($article->content), 97) }}
                            </p>

                            <div class="flex justify-between items-center mt-auto text-xs text-gray-500">
                                {{-- Tanggal Publish di kiri --}}
                                <span>
                                    {{ $article->published_at ? $article->published_at->format('d M Y') : 'Belum dipublikasikan' }}
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

                <div class="mt-8 col-span-full">
                    {{ $articles->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </section>
    @include('partials.newsletter')
    @include('partials.footer')
@endsection
