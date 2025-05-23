<!-- Berita Utama Section -->
<section class="px-6 py-6">
    <h2 class="text-6xl font-semibold font-birthstone mb-6 border-b pl-6">Berita Utama <span
            class="text-[#FF66C4]">&gt;</span></h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <!-- KIRI -->
        <div class="flex flex-col gap-6 h-full">
            <!-- 1 Besar -->
            <div>
                <img src="{{ asset('images/gambar1.jpg') }}" alt="Big News" class="rounded-lg w-full h-56 object-cover">
                <h3 class="mt-3 font-semibold text-lg leading-snug">
                    Sky Sports Presenter Anna Woolhouse Reveals She’s Treated for Lifting Weights
                </h3>
                <div class="text-sm text-gray-500 flex gap-4 mt-1">
                    <span>Tennis</span>
                    <span>29/08/2023</span>
                    <span>6.1k 👁</span>
                    <span>134 💬</span>
                </div>
            </div>

            <!-- 2 Kecil Vertikal (tinggi menyesuaikan dengan kanan bawah) -->
            <div class="flex flex-col justify-between h-[14.5rem] gap-4">
                <div class="flex items-start gap-3">
                    <img src="{{ asset('images/gambar2.jpg') }}" alt="Small 1"
                        class="w-24 h-24 rounded-lg object-cover">
                    <div>
                        <h4 class="text-sm font-semibold leading-snug">In Race Week 5 Storylines We’re Excited About…
                        </h4>
                        <div class="text-xs text-gray-500 mt-1">Motorsport &bull; 28/08/2023</div>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <img src="{{ asset('images/gambar1.jpg') }}" alt="Small 2"
                        class="w-24 h-24 rounded-lg object-cover">
                    <div>
                        <h4 class="text-sm font-semibold leading-snug">A Fight for Points and Reputation Stirs Battle at
                            Aragon…</h4>
                        <div class="text-xs text-gray-500 mt-1">Racing &bull; 28/08/2023</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KANAN -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            <!-- Kanan Atas - 1 Besar Horizontal -->
            <div class="flex flex-col lg:flex-row gap-4">
                <img src="{{ asset('images/gambar2.jpg') }}" alt="Big Horizontal"
                    class="w-full lg:w-1/2 h-80 object-cover rounded-lg">
                <div class="w-full lg:w-1/2">
                    <h3 class="font-bold text-xl leading-snug">
                        English Rugby Needs Urgent Rescuing Before Being Cast Away Indefinitely
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">
                        There have been open criticisms recently on what English rugby supporters are experiencing…
                    </p>
                    <div class="text-sm text-gray-500 flex gap-4 mt-2">
                        <span>Rugby</span>
                        <span>29/08/2023</span>
                        <span>6.2k 👁</span>
                        <span>121 💬</span>
                    </div>
                </div>
            </div>

            <!-- 2 Horizontal Sejajar (50%-50%) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 h-[14.5rem]">
                <div class="flex flex-col">
                    <img src="{{ asset('images/gambar1.jpg') }}" alt="Half 1"
                        class="w-full h-40 object-cover rounded-lg">
                    <h4 class="font-semibold mt-2 leading-snug">Anthony Edwards Shares Checklist to FIBA Rules…</h4>
                    <p class="text-sm text-gray-600">Anthony Edwards shines in FIBA matches as he adapts…</p>
                    <div class="text-sm text-gray-500 flex gap-4 mt-1">
                        <span>Basketball</span>
                        <span>29/08/2023</span>
                        <span>5.8k 👁</span>
                        <span>143 💬</span>
                    </div>
                </div>

                <div class="flex flex-col">
                    <img src="{{ asset('images/gambar2.jpg') }}" alt="Half 2"
                        class="w-full h-40 object-cover rounded-lg">
                    <h4 class="font-semibold mt-2 leading-snug">Another Rising Star Makes Waves in Women’s Tennis</h4>
                    <p class="text-sm text-gray-600">A new contender is stepping up in the women’s circuit…</p>
                    <div class="text-sm text-gray-500 flex gap-4 mt-1">
                        <span>Tennis</span>
                        <span>29/08/2023</span>
                        <span>4.7k 👁</span>
                        <span>99 💬</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
