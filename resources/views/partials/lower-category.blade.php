@extends('layouts.app')

<div class="max-w-7xl mx-auto bg-[#F2F4FF] p-6 rounded-xl shadow-sm mt-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2">
            @php
                $internasionalCategory = $categories->firstWhere('name', 'Internasional');
            @endphp

            @if ($internasionalCategory)
                <a href="{{ route('categories.show', $kategoriAcak->id) }}"
                    class="flex justify-between items-center mb-4 group">
                    <h2 class="text-5xl font-semibold font-birthstone tracking-wide text-black group-hover:underline">
                        {{ $kategoriAcak->name }}
                    </h2>
                    <span class="text-blue-600 text-sm group-hover:underline">&rsaquo;</span>
                </a>
            @endif

            @php
                $utama = $artikelKategori->first();
                $lainnya = $artikelKategori->skip(1);
            @endphp

            @if ($utama)
                <a href="{{ route('articles.show', $utama->id) }}"
                    class="flex gap-4 mb-4 group rounded-md p-2 transition">
                    <img src="{{ $utama->thumbnail ? asset('storage/' . $utama->thumbnail) : asset('images/default.jpg') }}"
                        alt="Thumbnail"
                        class="rounded-md w-48 h-32 object-cover group-hover:brightness-90 duration-300">
                    <div class="w-full">
                        <div class="flex items-center space-x-1 text-sm text-gray-500 mb-1">
                            <span>{{ $utama->author->name ?? 'Tim Winnicode' }}</span>
                        </div>
                        <h3 class="font-semibold leading-snug line-clamp-2 text-black group-hover:underline transition">
                            {{ $utama->title }}
                        </h3>
                        <p class="text-sm text-gray-800 mt-1 line-clamp-2">
                            {{ \Illuminate\Support\Str::limit(strip_tags($utama->content), 75) }}
                        </p>
                        <div class="flex justify-between items-center mt-1 text-sm text-gray-500">
                            <span>
                                {{ $utama->published_at ? $utama->published_at->translatedFormat('d F Y') : 'Belum dipublikasikan' }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center mt-1 text-sm text-gray-500">
                            <span class="flex gap-3 items-center">
                                <span class="flex items-center gap-1">
                                    <img src="{{ asset('icons/visibilitydark.png') }}" class="w-4 h-4" alt="views">
                                    {{ number_format($utama->views) }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <img src="{{ asset('icons/commentdark.png') }}" class="w-4 h-4" alt="comments">
                                    {{ $utama->comments_count ?? 0 }}
                                </span>
                            </span>
                        </div>
                    </div>
                </a>
            @endif

            <div class="space-y-4 border-t pt-4">
                @forelse ($lainnya->take(3) as $item)
                    <a href="{{ route('articles.show', $item->id) }}" class="block rounded-md p-2 transition group">
                        <div class="text-sm text-gray-500 mb-1">
                            <span class="font-medium text-gray-500">{{ $item->author->name ?? 'Tim Winnicode' }}</span>
                        </div>
                        <p
                            class="text-sm font-medium leading-snug text-black transition duration-150 group-hover:underline">
                            {{ $item->title }}
                        </p>
                        <div class="flex justify-between items-center text-sm text-gray-500 mt-1">
                            <span>
                                {{ $item->published_at ? $item->published_at->translatedFormat('d F Y') : 'Belum dipublikasikan' }}
                            </span>
                            <span class="flex gap-3 items-center">
                                <span class="flex items-center gap-1">
                                    <img src="{{ asset('icons/visibilitydark.png') }}" class="w-4 h-4" alt="views">
                                    {{ number_format($item->views) }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <img src="{{ asset('icons/commentdark.png') }}" class="w-4 h-4" alt="comments">
                                    {{ $item->comments_count ?? 0 }}
                                </span>
                            </span>
                        </div>
                    </a>
                @empty
                    <p class="text-sm text-gray-500">Belum ada artikel lainnya di kategori ini.</p>
                @endforelse
            </div>
        </div>

        <div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-5xl font-birthstone tracking-wide font-semibold text-teal-700">Rekomendasi</h2>
                <span class="text-blue-600 text-sm cursor-pointer"></span>
            </div>

            <div class="space-y-6">
                @foreach ($rekomendasi as $berita)
                    <div class="flex gap-4 group">
                        <div class="flex-1">
                            <div class="text-sm text-gray-500 mb-1">
                                <span class="font-medium">{{ $berita->author->name ?? 'Tim Winnicode' }}</span>
                            </div>
                            <a href="{{ route('articles.show', $berita->id) }}"
                                class="block text-black group-hover:underline">
                                <p class="text-sm font-medium leading-snug">
                                    {{ \Illuminate\Support\Str::limit($berita->title, 75) }}
                                </p>
                            </a>

                            {{-- Bagian tanggal + views + komentar --}}
                            <div class="flex justify-between items-center mt-1 text-xs text-gray-500">
                                {{-- Tanggal Publish --}}
                                <span>
                                    {{ optional($berita->published_at)->translatedFormat('d F Y') ?? 'Belum dipublikasikan' }}
                                </span>

                                {{-- Views dan Komentar --}}
                                <span class="flex items-center gap-3">
                                    <span class="flex items-center gap-1">
                                        <img src="{{ asset('icons/visibilitydark.png') }}" alt="views"
                                            class="w-4 h-4">
                                        {{ number_format($berita->views) }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <img src="{{ asset('icons/commentdark.png') }}" alt="comments" class="w-4 h-4">
                                        {{ $berita->comments_count ?? 0 }}
                                    </span>
                                </span>
                            </div>
                        </div>

                        {{-- Thumbnail --}}
                        <a href="{{ route('articles.show', $berita->id) }}">
                            <img src="{{ $berita->thumbnail ? asset('storage/' . $berita->thumbnail) : asset('images/default.jpg') }}"
                                class="rounded-md w-24 h-20 object-cover" alt="Thumb">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
