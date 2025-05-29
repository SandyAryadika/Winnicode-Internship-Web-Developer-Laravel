<!-- Pilihan Penulis -->
<section class="py-6 px-6">
    <h2 class="text-6xl font-semibold border-b border-t font-birthstone mb-6 pl-6">Pilihan Penulis <span
            class="text-[#FF66C4]">&gt;</span></h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse ($editorChoiceArticles as $item)
            <a href="{{ route('articles.show', $item->id) }}" class="group hover:bg-pink-50 p-2">
                <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('images/default.jpg') }}"
                    alt="{{ $item->title }}" class="w-full h-48 object-cover mb-2" />
                <h4 class="font-semibold leading-snug line-clamp-2">
                    {{ Str::limit($item->title, 80) }}
                </h4>
                <div class="text-sm text-gray-500 mt-1">
                    {{ $item->category->name ?? '-' }} |
                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                </div>
            </a>
        @empty
            <p class="text-gray-500">Belum ada artikel pilihan penulis.</p>
        @endforelse
    </div>
</section>
