@extends('layouts.app')

@section('title', 'Profil Kontributor')

@include('partials.header')
@include('partials.navbar')
@section('content')
    <section class="py-10 px-6 max-w-screen-xl mx-auto">
        <h2 class="text-6xl font-semibold font-birthstone mb-6 pl-6">Profile Penulis <span class="text-[#FF66C4]">&gt;</span>
        </h2>

        {{-- PROFIL AUTHOR (1 baris penuh, ditengah) --}}
        @if ($author)
            <div class="flex justify-center mb-8">
                <div
                    class="bg-white rounded-lg p-6  flex flex-col items-center text-center md:flex-row md:items-center md:text-left md:gap-6">
                    <img src="{{ $author->photo ? asset('storage/' . $author->photo) : asset('images/default.jpg') }}"
                        alt="{{ $author->name }}" class="w-48 h-48 rounded-full object-cover border mb-4 md:mb-0">
                    <div>
                        <h3 class="text-2xl font-bold text-[#252525]">{{ $author->name }}</h3>
                        <p class="text-medium text-[#252525] mt-3">{{ $author->articles->count() }} artikel</p>
                        <p class="text-medium text-[#252525] mt-3 italic">{{ $author->bio ?? 'Belum ada bio.' }}</p>
                        <p class="text-medium text-gray-800 mt-3">Bergabung sejak
                            {{ $author->created_at->translatedFormat('F Y') }}</p>
                    </div>
                </div>
            </div>
        @endif


        {{-- ARTIKEL DARI AUTHOR --}}
        <div class="border-t border-gray-300 mt-10 pt-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @if ($author && $author->articles->count())
                    @foreach ($author->articles->take(12) as $article)
                        <div class="bg-white shadow-md overflow-hidden hover:shadow transition">
                            <a href="{{ route('articles.show', $article->id) }}">
                                <img src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('images/default.jpg') }}"
                                    alt="{{ $article->title }}" class="w-full h-50 object-cover">
                                <div class="p-4">
                                    <h3 class="text-base font-semibold text-gray-800 mb-1">{{ $article->title }}</h3>
                                    <p class="text-sm text-gray-600">{{ Str::limit($article->excerpt, 100) }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-3 text-center py-8">
                        <p class="text-gray-500">Belum ada artikel yang ditulis oleh kontributor ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
    @include('partials.newsletter')
    @include('partials.footer')
@endsection
