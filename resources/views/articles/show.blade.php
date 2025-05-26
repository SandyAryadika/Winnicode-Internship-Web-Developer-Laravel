@extends('layouts.app')

@section('content')
    <section class="max-w-4xl mx-auto px-2 py-4">
        {{-- Gambar Utama --}}
        @if ($article->thumbnail)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                    class="w-full h-[400px] object-cover rounded-2xl shadow-md">
            </div>
        @endif

        {{-- Judul --}}
        <h1 class="text-4xl font-extrabold text-center mb-4 text-[#252525]">
            {{ $article->title }}
        </h1>

        {{-- Tanggal & Kategori --}}
        <div class="text-center text-sm text-gray-500 mb-6">
            Dipublikasikan {{ $article->published_at->format('d M Y') }} |
            Kategori: {{ $article->category->name ?? '-' }} |
            Oleh: {{ $article->author->name ?? 'Tim Winnicode' }}
        </div>

        {{-- Isi Artikel --}}
        <article class="prose prose-lg max-w-none text-justify mb-12">
            {!! $article->content !!}
        </article>

        {{-- Komponen Newsletter --}}
        @include('partials.newsletter')

        {{-- Related Posts & More from Author --}}
        <div class="mt-16 border-t pt-10">
            <h2 class="text-2xl font-semibold mb-4 text-[#252525]">Bacaan lainnya</h2>
            <div class="grid md:grid-cols-2 gap-6">
                {{-- Related Post --}}
                @foreach ($relatedPosts as $related)
                    <div class="bg-[#FFF3FA] p-4 rounded-xl shadow hover:shadow-md transition">
                        <a href="{{ route('articles.show', $related->id) }}">
                            <h3 class="text-lg font-bold mb-2 text-[#252525]">{{ $related->title }}</h3>
                            <p class="text-sm text-gray-600">
                                {{ \Illuminate\Support\Str::limit(strip_tags($related->content), 100) }}
                            </p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Komentar --}}
        <div class="mt-16 border-t pt-10">
            <h2 class="text-2xl font-semibold mb-4 text-[#252525]">Komentar</h2>

            {{-- Komentar Disqus, Facebook, atau internal --}}
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
