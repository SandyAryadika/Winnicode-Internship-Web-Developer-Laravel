<section class="px-6 py-12 bg-[#F2F4FF] rounded-lg">
    <div class="flex gap-12 overflow-x-auto justify-center px-6 py-6">
        @foreach ($topContributors as $contributor)
            <div
                class="flex-shrink-0 w-48 bg-white p-4 rounded-lg shadow transition duration-300 hover:shadow-[0_0_25px_rgba(82,113,255,0.5)] cursor-pointer block text-inherit no-underline">
                <img src="{{ $contributor->photo ? asset('storage/' . $contributor->photo) : asset('images/default.jpg') }}"
                    class="w-32 h-32 rounded-full mx-auto mb-2" alt="{{ $contributor->name }}">
                <h4 class="text-center font-semibold">{{ $contributor->name }}</h4>
                <p class="text-xs text-center text-gray-500">{{ $contributor->articles_count }} articles</p>
            </div>
        @endforeach
    </div>
</section>
