<!-- Sorotan Pilihan Section -->
<section class="py-6 px-6">
    <h2 class="text-6xl font-semibold border-b font-birthstone mb-6 pl-6">Sorotan Pilihan <span
            class="text-[#FF66C4]">&gt;</span></h2>

    <!-- Featured Main -->
    <div class="flex flex-col md:flex-row gap-6 items-start">
        <!-- Kiri: Judul & Deskripsi -->
        <div class="basis-full md:basis-1/3 space-y-2">
            <h3 class="text-2xl font-bold leading-snug">
                World’s Fastest Marathon Runner Says London Race ‘Is Like My Home’
            </h3>
            <p class="text-gray-600 text-sm">
                Eliud Kipchoge spoke to children at Cubit Town Primary School in east London to encourage them to take
                part in the Daily Mile challenge.
            </p>
            <div class="text-sm text-gray-500 flex gap-4 mt-2">
                <span>Running</span>
                <span>29/08/2023</span>
                <span>6.3k 👁</span>
                <span>103 💬</span>
            </div>
        </div>

        <!-- Kanan: Gambar -->
        <div class="basis-full md:basis-2/3">
            <img src="{{ asset('images/gambar1.jpg') }}" alt="Featured Runner"
                class="rounded-lg w-full h-52 md:h-full object-cover">
        </div>
    </div>

    <!-- Featured List -->
    <div class="grid grid-cols-2 md:grid-cols-4 my-6 gap-4">
        <!-- Item 1 -->
        <div>
            <img src="{{ asset('images/gambar2.jpg') }}" alt="Sub News 1"
                class="w-full h-36 object-cover rounded-lg mb-2">
            <h4 class="text-sm font-semibold leading-snug">Arctic Belter Sarulak Repeats World’s First in Wolfgang Climb
            </h4>
            <div class="text-xs text-gray-500 mt-1">Climbing &bull; 29/08/2023 &bull; 3.1k 👁 &bull; 44 💬</div>
        </div>

        <!-- Item 2 -->
        <div>
            <img src="{{ asset('images/gambar1.jpg') }}" alt="Sub News 2"
                class="w-full h-36 object-cover rounded-lg mb-2">
            <h4 class="text-sm font-semibold leading-snug">SEA Games: Aquatic-Kayakers, Garcis triumph 2-0 in Beach
                Volley</h4>
            <div class="text-xs text-gray-500 mt-1">Volleyball &bull; 29/08/2023 &bull; 2.6k 👁 &bull; 31 💬</div>
        </div>

        <!-- Item 3 -->
        <div>
            <img src="{{ asset('images/gambar2.jpg') }}" alt="Sub News 3"
                class="w-full h-36 object-cover rounded-lg mb-2">
            <h4 class="text-sm font-semibold leading-snug">Media-Journal Daughter Posts Heart-Warming Tribute After
                North Stars Finals Exit</h4>
            <div class="text-xs text-gray-500 mt-1">Skating &bull; 29/08/2023 &bull; 2.3k 👁 &bull; 19 💬</div>
        </div>

        <!-- Item 4 (Opsional jika ingin 4 kolom) -->
        <div>
            <img src="{{ asset('images/gambar1.jpg') }}" alt="Sub News 4"
                class="w-full h-36 object-cover rounded-lg mb-2">
            <h4 class="text-sm font-semibold leading-snug">Another Champion Claims Title in Epic Final Showdown</h4>
            <div class="text-xs text-gray-500 mt-1">Athletics &bull; 29/08/2023 &bull; 1.9k 👁 &bull; 21 💬</div>
        </div>
    </div>
</section>
