@extends('layouts.app')

@section('content')
    <section class="px-6 py-4">
        <h2 class="text-lg font-semibold mb-4">Hasil pencarian untuk: "{{ $query }}"</h2>

        @forelse ($results as $article)
            <div class="mb-4 border-b pb-2">
                <h3 class="text-xl font-bold">
                    <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                </h3>
                <p class="text-sm text-gray-600">
                    Kategori: {{ $article->category->name ?? '-' }} • {{ $article->published_at->format('d M Y') }}
                </p>
                <p>{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}</p>
            </div>
        @empty
            <p>Tidak ada hasil ditemukan.</p>
        @endforelse

        {{ $results->links() }}
    </section>
@endsection
