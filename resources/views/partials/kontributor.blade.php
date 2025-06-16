<section class="py-6 px-6">
    <h2 class="text-6xl font-semibold border-b border-t font-birthstone mb-6 mt-6 pl-6 tracking-wide">
        Kontributor Teratas <span class="text-[#FF66C4]">&gt;</span>
    </h2>
</section>

<section class="px-6 py-12 bg-[#F2F4FF] rounded-lg">
    <div class="flex gap-12 overflow-x-auto justify-center px-6 py-6">
        @foreach ($topContributors as $contributor)
            <a href="{{ route('authors.show', $contributor->id) }}"
                class="flex-shrink-0 w-48 bg-white p-4 rounded-lg border shadow-sm hover:shadow-lg transition duration-300 hover:shadow-blue-300 cursor-pointer block text-inherit no-underline">
                <img src="{{ $contributor->photo ? asset('storage/' . $contributor->photo) : asset('images/default.jpg') }}"
                    loading="lazy" class="w-32 h-32 rounded-full mx-auto mb-2" alt="{{ $contributor->name }}">
                <h4 class="text-center font-semibold">{{ $contributor->name }}</h4>
                <p class="text-xs text-center text-gray-500">
                    {{ $contributor->articles_count }} artikel
                </p>
            </a>
        @endforeach
    </div>
</section>
