<section class="px-6 py-6">
    <h2 class="text-6xl font-semibold font-birthstone mb-6 border-b border-t pl-6 tracking-wide">Berita Utama <span
            class="text-[#FF66C4]">&gt;</span></h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <div class="flex flex-col gap-5 h-full">
            @if (isset($beritaUtama[0]))
                <a href="{{ route('articles.show', $beritaUtama[0]->id) }}" class="group block">
                    <img src="{{ $beritaUtama[0]->thumbnail ? asset('storage/' . $beritaUtama[0]->thumbnail) : asset('images/default.jpg') }}"
                        loading="lazy" alt="{{ $beritaUtama[0]->title }}"
                        class="w-full h-56 object-cover rounded-md group-hover:scale-105 group-hover:brightness-90 transition duration-300">
                    <h3 class="mt-3 font-semibold text-lg group-hover:underline leading-snug mb-4">
                        {{ $beritaUtama[0]->title }}
                    </h3>
                    <div class="text-xs text-gray-500 flex justify-between mt-1 items-center w-full">
                        <div class="flex items-center gap-2 mb-2">
                            <span>{{ $beritaUtama[0]->category->name ?? '-' }}</span> |
                            <span>{{ \Carbon\Carbon::parse($beritaUtama[0]->published_at)->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="flex items-center gap-1">
                                <img src="{{ asset('icons/visibilitydark.png') }}" loading="lazy" alt="Views"
                                    class="w-4 h-4">
                                {{ number_format($beritaUtama[0]->views) }}
                            </span>
                            <span class="flex items-center gap-1">
                                <img src="{{ asset('icons/commentdark.png') }}" loading="lazy" alt="Comments"
                                    class="w-4 h-4">
                                {{ $beritaUtama[0]->comments_count ?? 0 }}
                            </span>
                        </div>
                    </div>
                </a>
            @endif

            <div class="flex flex-col justify-between h-[14.5rem] gap-4">
                @foreach ($beritaUtama->slice(1, 2) as $item)
                    <a href="{{ route('articles.show', $item->id) }}"
                        class="flex items-start gap-3 group p-2 transition border rounded-md hover:shadow-lg">
                        <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('images/default.jpg') }}"
                            loading="lazy" alt="{{ $item->title }}"
                            class="w-24 h-24 object-cover rounded-md border group-hover:scale-105 transition duration-300">

                        <div class="flex flex-col justify-between h-full w-full">
                            <h4
                                class="text-base font-semibold leading-snug line-clamp-2 group-hover:text-[#FF66C4] transition">
                                {{ \Illuminate\Support\Str::limit($item->title, 150, '...') }}
                            </h4>

                            <div class="flex justify-between items-center mt-2 text-xs text-gray-500">
                                <span>
                                    {{ $item->category->name ?? '-' }} |
                                    {{ \Carbon\Carbon::parse($item->published_at)->format('d/m/Y') }}
                                </span>

                                <div class="flex gap-3">
                                    <span class="flex items-center gap-1">
                                        <img src="{{ asset('icons/visibilitydark.png') }}" loading="lazy"
                                            alt="Views" class="w-4 h-4">
                                        {{ number_format($item->views) }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <img src="{{ asset('icons/commentdark.png') }}" loading="lazy" alt="Comments"
                                            class="w-4 h-4">
                                        {{ $item->comments_count ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-2 flex flex-col gap-6">
            @if (isset($beritaUtama[3]))
                <a href="{{ route('articles.show', $beritaUtama[3]->id) }}"
                    class="flex flex-col lg:flex-row gap-4 group">
                    <img src="{{ $beritaUtama[3]->thumbnail ? asset('storage/' . $beritaUtama[3]->thumbnail) : asset('images/default.jpg') }}"
                        loading="lazy" alt="{{ $beritaUtama[3]->title }}"
                        class="w-full lg:w-1/2 h-80 object-cover rounded-md group-hover:brightness-90 transition duration-300">
                    <div class="w-full lg:w-1/2">
                        <h3 class="font-bold text-xl leading-snug group-hover:underline">
                            {{ $beritaUtama[3]->title }}
                        </h3>
                        <p class="text-sm text-gray-600 mt-8 mb-10">
                            {{ \Illuminate\Support\Str::limit(strip_tags($beritaUtama[3]->content), 350, '...') }}
                        </p>
                        <div class="text-xs text-gray-500 flex justify-between mt-2 items-center w-full">
                            <div class="flex items-center gap-2">
                                <span>{{ $beritaUtama[3]->category->name ?? '-' }}</span> |
                                <span>{{ \Carbon\Carbon::parse($beritaUtama[3]->published_at)->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="flex items-center gap-1">
                                    <img src="{{ asset('icons/visibilitydark.png') }}" loading="lazy" alt="Views"
                                        class="w-4 h-4">
                                    {{ number_format($beritaUtama[3]->views) }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <img src="{{ asset('icons/commentdark.png') }}" loading="lazy" alt="Comments"
                                        class="w-4 h-4">
                                    {{ $beritaUtama[3]->comments_count ?? 0 }}
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 h-[14.5rem]">
                @foreach ($beritaUtama->slice(4, 2) as $item)
                    <a href="{{ route('articles.show', $item->id) }}"
                        class="flex flex-col group p-2 border rounded-md hover:shadow-lg transition">
                        <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('images/default.jpg') }}"
                            loading="lazy" alt="{{ $item->title }}" class="w-full h-40 object-cover rounded-md">
                        <h4 class="font-semibold mt-2 leading-snug">
                            {{ $item->title }}
                        </h4>
                        <div class="text-xs text-gray-500 flex justify-between mt-1 items-center w-full">
                            <div class="flex items-center gap-2">
                                <span>{{ $item->category->name ?? '-' }}</span> |
                                <span>{{ \Carbon\Carbon::parse($item->published_at)->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex items-center gap-4">
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
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
