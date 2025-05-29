{{-- resources/views/categories/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Kategori: {{ $category->name }}</h1>

        @if ($articles->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($articles as $article)
                    <div class="border p-4 rounded shadow-sm">
                        <h2 class="text-lg font-semibold mb-2">{{ $article->title }}</h2>
                        <p class="text-sm text-gray-600">{{ Str::limit($article->content, 100) }}</p>
                        <a href="{{ route('articles.show', $article->id) }}" class="text-blue-500 hover:underline mt-2 block">
                            Baca selengkapnya
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $articles->links() }}
            </div>
        @else
            <p>Tidak ada artikel dalam kategori ini.</p>
        @endif
    </div>
@endsection
