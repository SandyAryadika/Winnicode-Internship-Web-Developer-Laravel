@extends('layouts.app')

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

        @include('partials.newsletter')

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
        <div class="mt-16 border-t pt-10">
            <h2 class="text-2xl font-semibold mb-4 text-[#252525]">Komentar</h2>
            <div id="disqus_thread"></div>
            <script>
                var disqus_config = function() {
                    this.page.url = "{{ Request::url() }}";
                    this.page.identifier = "article-{{ $article->id }}";
                };
                (function() {
                    var d = document,
                        s = d.createElement('script');
                    s.src = 'https://YOUR-DISQUS-SHORTNAME.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
            </script>
        </div>
    </section>

    @include('partials.footer')
@endsection
