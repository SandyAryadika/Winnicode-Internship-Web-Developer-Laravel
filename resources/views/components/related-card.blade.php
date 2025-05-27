<div>
    <a href="{{ route('articles.show', $related->id) }}">
        @if ($related->thumbnail)
            <img src="{{ asset('storage/' . $related->thumbnail) }}" alt="{{ $related->title }}"
                class="mt-3 mb-3 w-full h-40 object-cover">
        @endif
        <h3 class="text-lg font-bold">
            {{ \Illuminate\Support\Str::limit($related->title, 45) }}
        </h3>
        <p class="text-sm text-gray-600">
            {{ \Illuminate\Support\Str::limit(strip_tags($related->content), 85) }}
        </p>
    </a>
</div>
