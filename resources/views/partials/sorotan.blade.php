<section class="py-6 px-6">
    <h2 class="text-6xl font-semibold border-b border-t font-birthstone mb-6 pl-6">Sorotan Pilihan <span
            class="text-[#FF66C4]">&gt;</span></h2>

    @if ($artikelSorotan->isNotEmpty())
        <!-- Featured Main (artikel pertama) -->
        @php $utama = $artikelSorotan->first(); @endphp
        <a href="{{ route('articles.show', $utama->id) }}" class="flex flex-col md:flex-row gap-6 items-start group">
            <div class="basis-full md:basis-1/3 space-y-2">
                <h3 class="text-2xl font-bold leading-snug">
                    {{ Str::limit($utama->title, 150) }}
                </h3>
                <p class="text-gray-600 text-sm py-8">
                    {{ Str::limit($utama->excerpt ?? strip_tags($utama->content), 600) }}
                </p>
                <div class="text-sm text-gray-500 flex gap-4 mt-2">
                    <span>{{ $utama->category->name ?? 'Tanpa Kategori' }}</span> |
                    <span>{{ $utama->published_at->format('d/m/Y') }}</span> |
                    <span>{{ number_format($utama->views) }} 👁</span> |
                    <span>{{ $utama->comments_count ?? '0' }} 💬</span>
                </div>
            </div>
            <div class="basis-full md:basis-2/3">
                <img src="{{ $utama->thumbnail ? asset('storage/' . $utama->thumbnail) : asset('images/default.jpg') }}"
                    alt="Gambar Sorotan"
                    class="w-full h-52 md:h-full object-cover group-hover:brightness-90 transition">
            </div>
        </a>

        <!-- Featured List -->
        <div class="grid grid-cols-2 md:grid-cols-4 my-6 gap-4">
            @foreach ($artikelSorotan->skip(1) as $item)
                <a href="{{ route('articles.show', $item->id) }}" class="group hover:bg-pink-50 p-2">
                    <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('images/default.jpg') }}"
                        alt="Sub Sorotan" class="w-full h-36 object-cover mb-2">
                    <h4 class="text-sm font-semibold leading-snug line-clamp-2">
                        {{ Str::limit($item->title, 70) }}
                    </h4>
                    <div class="text-xs text-gray-500 mt-1">
                        {{ $item->category->name ?? 'Tanpa Kategori' }} |
                        {{ $item->published_at->format('d/m/Y') }} |
                        {{ number_format($item->views) }} 👁 |
                        {{ $item->comments_count ?? '0' }} 💬
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 italic">Belum ada artikel sorotan pilihan.</p>
    @endif
</section>
