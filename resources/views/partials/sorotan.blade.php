<section class="py-6 px-6">
    <h2 class="text-6xl font-semibold border-b border-t font-birthstone mb-6 pl-6 tracking-wide">
        Sorotan Pilihan <span class="text-[#FF66C4]">&gt;</span>
    </h2>

    @if ($artikelSorotan->isNotEmpty())
        @php $utama = $artikelSorotan->first(); @endphp
        <a href="{{ route('articles.show', $utama->id) }}" class="flex flex-col md:flex-row gap-6 group h-full">
            <div class="basis-full md:basis-1/3 flex flex-col justify-between h-full space-y-2">
                <div>
                    <h3 class="text-2xl font-bold group-hover:underline leading-snug">
                        {{ Str::limit($utama->title, 150) }}
                    </h3>
                    <p class="text-gray-600 text-sm py-6">
                        {{ Str::limit($utama->excerpt ?? strip_tags($utama->content), 600) }}
                    </p>
                </div>

                <div class="text-sm text-gray-500 flex flex-col sm:flex-row sm:justify-between gap-2 mt-auto">
                    <div class="flex gap-2 items-center">
                        <span>{{ $utama->category->name ?? 'Tanpa Kategori' }}</span> |
                        <span>{{ $utama->published_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex gap-4 items-center">
                        <span class="flex items-center gap-1">
                            <img src="{{ asset('icons/visibilitydark.png') }}" loading="lazy" alt="Views"
                                class="w-4 h-4">
                            {{ number_format($utama->views) }}
                        </span>
                        <span class="flex items-center gap-1">
                            <img src="{{ asset('icons/commentdark.png') }}" loading="lazy" alt="Comments"
                                class="w-4 h-4">
                            {{ $utama->comments_count ?? '0' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="basis-full md:basis-2/3">
                <img src="{{ $utama->thumbnail ? asset('storage/' . $utama->thumbnail) : asset('images/default.jpg') }}"
                    loading="lazy" alt="Gambar Sorotan"
                    class="w-full h-52 md:h-full object-cover group-hover:brightness-90 rounded-md transition">
            </div>
        </a>

        <div class="grid grid-cols-2 md:grid-cols-4 my-6 gap-4">
            @foreach ($artikelSorotan->skip(1) as $item)
                <a href="{{ route('articles.show', $item->id) }}"
                    class="group p-2 border rounded-md hover:shadow-lg transition">
                    <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('images/default.jpg') }}"
                        loading="lazy" alt="Sub Sorotan" class="w-full h-36 object-cover mb-2 rounded-md">

                    <h4 class="text-sm font-semibold leading-snug line-clamp-2">
                        {{ Str::limit($item->title, 70) }}
                    </h4>

                    <div class="flex justify-between items-center text-xs text-gray-400 mt-1">
                        <span>
                            {{ $item->category->name ?? 'Tanpa Kategori' }} |
                            {{ $item->published_at->format('d/m/Y') }}
                        </span>

                        <span class="flex gap-2">
                            <span class="flex items-center gap-1">
                                <img src="{{ asset('icons/visibilitydark.png') }}" loading="lazy" alt="Views"
                                    class="w-4 h-4">
                                {{ number_format($item->views) }}
                            </span>
                            <span class="flex items-center gap-1">
                                <img src="{{ asset('icons/commentdark.png') }}" loading="lazy" alt="Comments"
                                    class="w-4 h-4">
                                {{ $item->comments_count ?? 0 }}
                            </span>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="py-12 text-center">
            <p class="text-lg text-gray-500">Tidak ada artikel di section <strong>Sorotan Pilihan</strong>.</p>
        </div>
    @endif
</section>
