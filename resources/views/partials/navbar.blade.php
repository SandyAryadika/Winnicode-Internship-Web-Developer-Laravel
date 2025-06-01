<nav class="border-b text-sm font-medium bg-white">
    <div id="category-scroll" class="border-b flex overflow-x-auto whitespace-nowrap space-x-3 px-4 py-6 scrollbar-hide">
        @foreach ($categories as $category)
            <a href="{{ route('categories.show', $category->id) }}"
                class="px-4 py-1 border border-gray-300 rounded-full hover:bg-pink-500 hover:text-white transition duration-200">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
