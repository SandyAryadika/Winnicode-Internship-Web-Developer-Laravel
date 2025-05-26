<div>
    <a href="{{ route('articles.show', $related->id) }}">
        @if ($related->thumbnail)
            <img src="{{ asset('storage/' . $related->thumbnail) }}" alt="{{ $related->title }}"
                class="mt-3 mb-3 w-full h-40 object-cover">
        @endif
        <h3 class="text-lg font-bold mb-2 text-[#252525]">{{ $related->title }}</h3>
        <p class="text-sm text-gray-600">
            {{ \Illuminate\Support\Str::limit(strip_tags($related->content), 100) }}
        </p>
    </a>
</div>
