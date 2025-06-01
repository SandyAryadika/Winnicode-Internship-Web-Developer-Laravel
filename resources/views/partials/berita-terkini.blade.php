<section class="border-b py-6 px-6">
    <h2 class="text-4xl md:text-6xl font-bold font-birthstone tracking-wide border-b pl-4 md:pl-6">
        Berita Hangat <span class="text-[#FF66C4]">&gt;</span>
    </h2>
</section>

<section class="relative overflow-hidden h-[400px]">
    <div id="hero-slider" class="flex transition-transform duration-500 w-full h-[400px]">
        @foreach ($beritaHangat->take(3) as $index => $article)
            <a href="{{ route('articles.show', $article->id) }}" class="block w-full shrink-0 relative group">
                <img src="{{ asset('storage/' . $article->thumbnail) }}"
                    class="w-full h-full object-cover brightness-75 group-hover:brightness-50 transition duration-500 ease-in-out"
                    alt="{{ $article->title }}" />
                <div class="absolute inset-0 bg-black bg-opacity-25 group-hover:bg-opacity-50 transition duration-500">
                </div>
                <div class="absolute inset-4 flex items-end p-6 md:p-12 text-white z-10">
                    <div>
                        <h3 class="text-sm uppercase mb-2 opacity-90">
                            {{ $article->category->name ?? 'Umum' }} |
                            {{ \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }} |
                            {{ $article->author->name ?? 'Penulis Tidak Diketahui' }}
                        </h3>
                        <h1
                            class="text-2xl md:text-4xl font-bold max-w-2xl leading-tight line-clamp-2 group-hover:underline">
                            {{ $article->title }}
                        </h1>
                        <div class="flex space-x-4 text-sm text-gray-200 mt-4 items-center">
                            <span class="flex items-center gap-1">
                                <img src="{{ asset('icons/visibility.png') }}" alt="Views"
                                    class="w-6 h-6 inline-block">
                                {{ $article->views ?? '0' }}
                            </span>
                            <span class="flex items-center gap-1">
                                <img src="{{ asset('icons/comment.png') }}" alt="Comments" class="w-6 h-6 inline-block">
                                {{ $article->comments_count ?? '0' }}
                            </span>
                        </div>

                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="absolute bottom-4 left-8 flex space-x-2 md:space-x-4 z-20">
        @foreach ($beritaHangat->take(3) as $index => $article)
            <button
                class="w-8 h-8 border-2 border-white rounded-full text-white font-semibold flex items-center justify-center hover:bg-white hover:text-black transition duration-300 shadow-md hover:scale-110"
                onclick="showSlide({{ $index }})">
                {{ $index + 1 }}
            </button>
        @endforeach
    </div>
</section>

<section class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6 py-10 bg-white">
    @foreach ($beritaHangat->slice(3, 3) as $article)
        <a href="{{ route('articles.show', $article->id) }}"
            class="flex space-x-2 hover:bg-[#f3f4f6] hover:shadow-lg rounded-lg p-2 border transition duration-300 group">
            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                class="w-24 h-24 object-cover rounded-md group-hover:scale-105 transition duration-300" />
            <div class="flex flex-col justify-between">
                <h4 class="text-base font-semibold leading-snug line-clamp-3 group-hover:text-[#FF66C4] transition">
                    {{ \Illuminate\Support\Str::limit($article->title, 100, '...') }}
                </h4>
                <div class="text-xs text-gray-500 flex justify-between mt-1">
                    <div class="flex gap-2 items-center">
                        <span>{{ $article->category->name ?? 'Umum' }}</span>
                        <span>|</span>
                        <span>{{ \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }}</span>
                    </div>

                    <div class="flex gap-4 items-center">
                        <span class="flex items-center gap-1">
                            <img src="{{ asset('icons/visibilitydark.png') }}" alt="Views" class="w-4 h-4">
                            {{ number_format($article->views) }}
                        </span>
                        <span class="flex items-center gap-1">
                            <img src="{{ asset('icons/commentdark.png') }}" alt="Comments" class="w-4 h-4">
                            {{ $article->comments_count ?? 0 }}
                        </span>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</section>
