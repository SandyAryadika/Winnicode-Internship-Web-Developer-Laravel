@extends('layouts.app')

@section('content')
    <section class="px-6 py-4">
        <h2 class="text-lg font-semibold mb-4">Hasil pencarian untuk: "{{ $query }}"</h2>

        @if ($matchedAuthors->count())
            <div class="mb-6">
                <h3 class="text-md font-semibold mb-2 text-gray-700">Penulis yang cocok:</h3>
                <ul class="list-disc ml-5 text-sm text-gray-600">
                    @foreach ($matchedAuthors as $author)
                        <li>{{ $author->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @forelse ($results as $article)
            <div class="mb-4 border-b pb-2">
                <h3 class="text-xl font-bold">
                    <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                </h3>
                <p class="text-sm text-gray-600">
                    Kategori: {{ $article->category->name ?? '-' }} |
                    {{ $article->published_at ? $article->published_at->format('d M Y') : 'Belum dipublikasikan' }}
                </p>
                <p>{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}</p>
            </div>
        @empty
            <p>Tidak ada hasil ditemukan.</p>
        @endforelse

        {{ $results->links() }}
    </section>
@endsection
