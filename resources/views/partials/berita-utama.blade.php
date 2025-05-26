<!-- Berita Utama Section -->
<section class="px-6 py-6">
    <h2 class="text-6xl font-semibold font-birthstone mb-6 border-b border-t pl-6">Berita Utama <span
            class="text-[#FF66C4]">&gt;</span></h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <!-- KIRI -->
        <div class="flex flex-col gap-6 h-full">
            <!-- 1 Besar -->
            @if (isset($beritaUtama[0]))
                <div>
                    <img src="{{ $beritaUtama[0]->thumbnail ? asset('storage/' . $beritaUtama[0]->thumbnail) : asset('images/default.jpg') }}"
                        alt="{{ $beritaUtama[0]->title }}" class="w-full h-56 object-cover">
                    <h3 class="mt-3 font-semibold text-lg leading-snug">
                        {{ $beritaUtama[0]->title }}
                    </h3>
                    <div class="text-xs text-gray-500 flex gap-4 mt-1">
                        <span>{{ $beritaUtama[0]->category->name ?? '-' }}</span> |
                        <span>{{ \Carbon\Carbon::parse($beritaUtama[0]->published_at)->format('d/m/Y') }}</span> |
                        <span>{{ number_format($beritaUtama[0]->views) }} 👁</span> |
                        <span>{{ $beritaUtama[0]->comments_count ?? 0 }} 💬</span>
                    </div>
                </div>
            @endif

            <!-- 2 Kecil Vertikal -->
            <div class="flex flex-col justify-between h-[14.5rem] gap-4">
                @foreach ($beritaUtama->slice(1, 2) as $item)
                    <div class="flex items-start gap-3">
                        <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('images/default.jpg') }}"
                            alt="{{ $item->title }}" class="w-24 h-24 object-cover">
                        <div>
                            <h4 class="text-sm font-semibold leading-snug">
                                {{ \Illuminate\Support\Str::limit($item->title, 150, '...') }}
                            </h4>
                            <div class="text-xs text-gray-500 mt-1">
                                {{ $item->category->name ?? '-' }} &bull;
                                {{ \Carbon\Carbon::parse($item->published_at)->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- KANAN -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            <!-- Kanan Atas - 1 Besar Horizontal -->
            @if (isset($beritaUtama[3]))
                <div class="flex flex-col lg:flex-row gap-4">
                    <img src="{{ $beritaUtama[3]->thumbnail ? asset('storage/' . $beritaUtama[3]->thumbnail) : asset('images/default.jpg') }}"
                        alt="{{ $beritaUtama[3]->title }}" class="w-full lg:w-1/2 h-80 object-cover">
                    <div class="w-full lg:w-1/2">
                        <h3 class="font-bold text-xl leading-snug">
                            {{ $beritaUtama[3]->title }}
                        </h3>
                        <p class="text-sm text-gray-600 mt-8 mb-10">
                            {{ \Illuminate\Support\Str::limit(strip_tags($beritaUtama[3]->content), 350, '...') }}
                        </p>
                        <div class="text-xs text-gray-500 flex gap-4 mt-2">
                            <span>{{ $beritaUtama[3]->category->name ?? '-' }}</span> |
                            <span>{{ \Carbon\Carbon::parse($beritaUtama[3]->published_at)->format('d/m/Y') }}</span> |
                            <span>{{ number_format($beritaUtama[3]->views) }} 👁</span> |
                            <span>{{ $beritaUtama[3]->comments_count ?? 0 }} 💬</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- 2 Horizontal Sejajar -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 h-[14.5rem]">
                @foreach ($beritaUtama->slice(4, 2) as $item)
                    <div class="flex flex-col">
                        <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('images/default.jpg') }}"
                            alt="{{ $item->title }}" class="w-full h-40 object-cover">
                        <h4 class="font-semibold mt-2 leading-snug">{{ $item->title }}</h4>
                        <p class="text-sm text-gray-600">
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 40, '...') }}
                        </p>
                        <div class="text-xs text-gray-500 flex gap-4 mt-1">
                            <span>{{ $item->category->name ?? '-' }}</span> |
                            <span>{{ \Carbon\Carbon::parse($item->published_at)->format('d/m/Y') }}</span> |
                            <span>{{ number_format($item->views) }} 👁</span> |
                            <span>{{ $item->comments_count ?? 0 }} 💬</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
