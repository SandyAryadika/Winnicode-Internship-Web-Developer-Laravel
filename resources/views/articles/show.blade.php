@extends('layouts.app')

@section('title', $article->title . ' - Winnicode')

@include('partials.header')
@include('partials.navbar')

@section('content')
    @if ($article->thumbnail)
        <div class="w-full px-4 md:px-10 lg:px-10 mt-12">
            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                class="w-full h-[550px] object-cover shadow-md">
        </div>
    @endif

    <section class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold text-center mb-4 text-[#252525]">
            {{ $article->title }}
        </h1>

        <div class="text-center text-sm text-gray-500 mb-6">
            Dipublikasikan {{ $article->published_at->format('d M Y') }} |
            Kategori: {{ $article->category->name ?? '-' }} |
            Oleh: {{ $article->author->name ?? 'Tim Winnicode' }}
        </div>

        <article class="prose prose-lg max-w-none text-justify mb-12 ">
            {!! modifyArticleContent($article->content) !!}
        </article>

        <div class="mt-8 border-t pt-10">
            <h2 class="text-6xl font-semibold mb-4 text-[#252525] font-birthstone">Bacaan lainnya ></h2>

            @if ($sameAuthor->count())
                <h3 class="text-xl font-semibold mb-2 text-[#252525]">Dari penulis yang sama</h3>
                <div class="grid md:grid-cols-3 gap-6 mb-8">
                    @foreach ($sameAuthor as $related)
                        @include('components.related-card', ['related' => $related])
                    @endforeach
                </div>
            @endif

            @if ($sameCategory->count())
                <h3 class="text-xl font-semibold mb-2 text-[#252525]">Dari kategori yang sama</h3>
                <div class="grid md:grid-cols-3 gap-6 mb-8">
                    @foreach ($sameCategory as $related)
                        @include('components.related-card', ['related' => $related])
                    @endforeach
                </div>
            @endif

            @if ($editorChoice->count())
                <h3 class="text-xl font-semibold mb-2 text-[#252525]">Rekomendasi untuk Anda</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach ($editorChoice as $related)
                        @include('components.related-card', ['related' => $related])
                    @endforeach
                </div>
            @endif
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
