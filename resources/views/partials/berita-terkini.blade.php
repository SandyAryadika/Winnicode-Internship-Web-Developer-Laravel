<!-- Berita Hangat Section Title -->
<section class="border-b py-6 px-6">
    <h2 class="text-6xl font-bold border-b font-birthstone pl-6 tracking-wide">
        Berita Hangat <span class="text-[#FF66C4]">&gt;</span>
    </h2>
</section>

<!-- Hero Slider Section -->
<section class="relative overflow-hidden">
    <!-- Slides Container -->
    <div id="hero-slider" class="flex transition-transform duration-500" style="width: 100%;">
        @foreach ($beritaHangat->take(3) as $index => $article)
            <a href="{{ route('articles.show', $article->id) }}" class="block w-full shrink-0 relative group">
                <img src="{{ asset('storage/' . $article->thumbnail) }}"
                    class="w-full h-[600px] object-cover brightness-75 group-hover:brightness-50 transition duration-300"
                    alt="{{ $article->title }}" />
                <div class="absolute inset-4 flex items-end p-6 md:p-12 text-white">
                    <div>
                        <h3 class="text-sm uppercase mb-2">
                            {{ $article->category->name ?? 'Umum' }} |
                            {{ \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }} |
                            {{ $article->author->name ?? 'Penulis Tidak Diketahui' }}
                        </h3>
                        <h1 class="text-2xl md:text-4xl font-bold max-w-2xl leading-tight line-clamp-2">
                            {{ $article->title }}
                        </h1>
                        <div class="flex space-x-4 text-sm text-gray-200 mt-4">
                            <span>👁️ {{ $article->views ?? '0' }}</span>
                            <span>💬 {{ $article->comments_count ?? '0' }}</span>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Numbered Navigation Dots -->
    <div class="absolute bottom-4 left-12 flex space-x-4">
        @foreach ($beritaHangat->take(3) as $index => $article)
            <button
                class="w-8 h-8 border-2 border-white rounded-full text-white font-semibold flex items-center justify-center hover:bg-white hover:text-black transition"
                onclick="showSlide({{ $index }})">
                {{ $index + 1 }}
            </button>
        @endforeach
    </div>
</section>

<!-- Thumbnail Highlights Section -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6 py-10 bg-white">
    @foreach ($beritaHangat->slice(3, 3) as $article)
        <a href="{{ route('articles.show', $article->id) }}" class="flex space-x-4 hover:bg-pink-50 p-2 transition">
            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                class="w-24 h-24 object-cover" />
            <div class="flex flex-col justify-between">
                <h4 class="text-base font-semibold leading-snug line-clamp-3">
                    {{ \Illuminate\Support\Str::limit($article->title, 100, '...') }}
                </h4>
                <span class="text-xs text-gray-500 mt-1">
                    {{ $article->category->name ?? 'Umum' }} |
                    {{ \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }}
                </span>
            </div>
        </a>
    @endforeach
</section>
