<div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300 overflow-hidden">
    <a href="{{ route('articles.show', $related->id) }}" class="block">
        @if ($related->thumbnail)
            <img src="{{ asset('storage/' . $related->thumbnail) }}" alt="{{ $related->title }}"
                class="w-full h-40 object-cover">
        @endif
        <div class="p-4 space-y-2">
            <h3 class="text-lg font-bold text-black">
                {{ \Illuminate\Support\Str::limit($related->title, 45) }}
            </h3>

            <!-- Tambahan kategori dan tanggal publish -->
            <div class="flex gap-2 items-center text-sm text-gray-500">
                <span>{{ $related->category->name ?? 'Umum' }}</span>
                <span>|</span>
                <span>{{ \Carbon\Carbon::parse($related->published_at)->format('d/m/Y') }}</span>
            </div>

            <p class="text-sm text-gray-600 leading-relaxed">
                {{ \Illuminate\Support\Str::limit(strip_tags($related->content), 85) }}
            </p>

            <div class="flex gap-4 items-center text-sm text-gray-500 pt-2">
                <span class="flex items-center gap-1">
                    <img src="{{ asset('icons/visibilitydark.png') }}" alt="Views" class="w-4 h-4">
                    {{ number_format($related->views) }}
                </span>
                <span class="flex items-center gap-1">
                    <img src="{{ asset('icons/commentdark.png') }}" alt="Comments" class="w-4 h-4">
                    {{ $related->comments_count ?? 0 }}
                </span>
            </div>
        </div>
    </a>
</div>
