<!-- Pilihan Penulis -->
<section class="py-6 px-6">
    <h2 class="text-6xl font-semibold border-b border-t font-birthstone mb-6 pl-6 tracking-wide">
        Pilihan Penulis <span class="text-[#FF66C4]">&gt;</span>
    </h2>

    @if ($editorChoiceArticles->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($editorChoiceArticles as $item)
                <a href="{{ route('articles.show', $item->id) }}"
                    class="group p-2 border rounded-md hover:shadow-lg transition flex flex-col">
                    <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('images/default.jpg') }}"
                        loading="lazy" alt="{{ $item->title }}" class="w-full h-48 object-cover mb-2 rounded-md" />

                    <h4 class="font-semibold leading-snug line-clamp-2 mb-2">
                        {{ Str::limit($item->title, 80) }}
                    </h4>

                    <!-- Meta info -->
                    <div class="flex justify-between items-center text-xs text-gray-400 mt-auto">
                        <span>
                            {{ $item->category->name ?? '-' }} |
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                        </span>

                        <span class="flex gap-3">
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
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Tidak ada artikel di section <strong>Pilihan Penulis</strong>.</p>
        </div>
    @endif
</section>
