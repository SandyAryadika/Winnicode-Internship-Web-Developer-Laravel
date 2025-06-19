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
            <span>
                By <a href="{{ route('authors.show', $article->author) }}" class="text-blue-600 hover:underline">
                    {{ $article->author->name }}
                </a>
            </span>
            <span class="flex items-center gap-1">
                <img src="{{ asset('icons/calendar.png') }}" alt="Published At" class="w-4 h-4" loading="lazy">
                {{ $article->published_at->format('d M Y') }}
            </span>
            <span class="flex items-center gap-1">
                <img src="{{ asset('icons/category.png') }}" alt="Category" class="w-4 h-4" loading="lazy">
                <a href="{{ route('categories.show', $article->category) }}" class="hover:underline text-blue-600">
                    {{ $article->category->name }}
                </a>
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

    <section class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold text-center mb-4 text-[#252525]">
            {{ $article->title }}
        </h1>

        <div x-data="{ expanded: false }" class="relative">
            <div x-ref="content" :style="expanded ? 'max-height: none' : 'max-height: 400px; overflow: hidden;'"
                class="transition-all duration-500 ease-in-out">
                <article class="prose prose-lg max-w-none text-justify text-[#252525]">
                    {!! modifyArticleContent($article->content) !!}
                </article>
            </div>

            <div class="mt-4 text-center">
                <button @click="expanded = !expanded" class="text-blue-500 hover:underline font-medium">
                    <span x-text="expanded ? 'Sembunyikan' : 'Tampilkan selengkapnya'"></span>
                </button>
            </div>
        </div>

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
                                    class="min-w-[300px] max-w-xs snap-start shrink-0 transition-shadow duration-300 shadow-sm hover:shadow-xl rounded-lg bg-white carousel-card">
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

            {{-- Komentar utama --}}
            @foreach ($comments as $comment)
                <div class="mb-4 border-b pb-4 flex gap-4">
                    <img src="{{ asset('images/default-comments.png') }}"
                        class="w-10 h-10 rounded-full object-cover mt-1" />

                    <div class="flex-1">
                        <p class="font-extrabold text-lg text-[#252525]">{{ $comment->name }}</p>
                        <p class="font-extralight text-sm text-gray-600">
                            {{ $comment->created_at->diffForHumans() }} ·
                            {{ $comment->created_at->format('d F Y') }} ·
                            {{ $comment->created_at->format('H:i') }} WIB
                        </p>
                        <p class="font-normal mt-2 text-[#252525]">{{ $comment->content }}</p>

                        {{-- Tombol Balas --}}
                        <button
                            onclick="document.getElementById('reply-form-{{ $comment->id }}').classList.toggle('hidden')"
                            class="inline-flex items-center text-sm bg-blue-100 text-blue-600 px-3 py-1 rounded-full mt-2 hover:bg-blue-200 transition">
                            Balas
                        </button>

                        @php
                            $sessionEmail = session('comment_email');
                        @endphp

                        @if ($comment->email && $comment->email === $sessionEmail)
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                class="inline mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center text-sm bg-red-100 text-red-600 px-3 py-1 rounded-full mt-2 hover:bg-red-200 transition">
                                    Hapus
                                </button>
                            </form>
                        @endif

                        {{-- Form balasan --}}
                        <form method="POST" action="{{ route('comments.store', $article->id) }}"
                            id="reply-form-{{ $comment->id }}" class="mt-2 hidden">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <input type="text" name="name" placeholder="Nama Anda" required
                                class="w-full font-normal border px-2 py-1 rounded mt-2">
                            <input type="email" name="email" placeholder="Email Anda (opsional)"
                                class="w-full font-normal border px-2 py-1 rounded mt-2">
                            <small class="px-2 mt-2 font-light text-red-500 text-sm">Isi email jika ingin bisa menghapus
                                komentar ini
                                nanti.</small>

                            <textarea name="content" placeholder="Tulis balasan..." required
                                class="w-full font-normal border px-2 py-1 rounded mt-2"></textarea>
                            <button type="submit" class="text-sm text-white bg-blue-400 px-3 py-1 rounded mt-2">Kirim
                                Balasan</button>
                        </form>

                        {{-- Balasan --}}
                        @foreach ($comment->replies as $reply)
                            <div class="ml-10 mt-4 border-l pl-4 flex gap-4">
                                <img src="{{ asset('images/default-comments.png') }}" alt="Avatar"
                                    class="w-8 h-8 rounded-full object-cover mt-1" />
                                <div>
                                    <p class="font-semibold text-[#252525]">{{ $reply->name }}</p>
                                    <p class="font-extralight text-sm text-gray-600">
                                        {{ $reply->created_at->diffForHumans() }} ·
                                        {{ $reply->created_at->format('d F Y') }} ·
                                        {{ $reply->created_at->format('H:i') }} WIB
                                    </p>
                                    <p class="font-normal text-sm mt-1">{{ $reply->content }}</p>

                                    @php
                                        $sessionEmail = session('comment_email');
                                    @endphp

                                    @if ($reply->email && $reply->email === $sessionEmail)
                                        <form action="{{ route('comments.destroy', $reply->id) }}" method="POST"
                                            class="inline mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center text-sm bg-red-100 text-red-600 px-3 py-1 rounded-full mt-2 hover:bg-red-200 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            {{-- PAGINATION untuk komentar utama --}}
            <div class="mt-6">
                {{ $comments->links() }}
            </div>

            {{-- FORM KOMENTAR BARU --}}
            <form method="POST" action="{{ route('comments.store', $article->id) }}" class="mt-6 space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Nama Anda" required
                    class="w-full border px-4 py-2 rounded">
                <input type="email" name="email" placeholder="Email (opsional)"
                    class="w-full border px-4 py-2 rounded">
                <small class="px-2 mt-2 font-light text-red-500 text-sm">Isi email jika ingin bisa menghapus
                    komentar ini
                    nanti.</small>
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
