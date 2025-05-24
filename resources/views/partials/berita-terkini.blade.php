<!-- Berita Terkini Section -->
<section class="border-b py-6 px-6">
    <h2 class="text-6xl font-semibold border-b font-birthstone pl-6">Berita Hangat <span
            class="text-[#FF66C4]">&gt;</span></h2>
</section>

<!-- Hero Slider Section -->
<section class="relative overflow-hidden">
    <!-- Slides Container -->
    <div id="hero-slider" class="flex transition-transform duration-500" style="width: 100%;">
        <!-- Slide 1 -->
        <div class="w-full shrink-0 relative">
            <img src="{{ asset('images/gambar1.jpg') }}" class="w-full h-[600px] object-cover brightness-75"
                alt="Slide 1" />
            <div class="absolute inset-4 flex items-end p-6 md:p-12 text-white">
                <div>
                    <h3 class="text-sm uppercase mb-2">Tennis | 29/08/2023</h3>
                    <h1 class="text-2xl md:text-4xl font-bold max-w-2xl leading-tight">
                        The Hidden Gems Of The US Open: Outside The Gates At Practice Courts P6 To P17
                    </h1>
                    <div class="flex space-x-4 text-sm text-gray-200 mt-4">
                        <span>👁️ 15,500</span>
                        <span>💬 180</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="w-full shrink-0 relative">
            <img src="{{ asset('images/gambar2.jpg') }}" class="w-full h-[600px] object-cover brightness-75"
                alt="Slide 2" />
            <div class="absolute inset-4 flex items-end p-6 md:p-12 text-white">
                <div>
                    <h3 class="text-sm uppercase mb-2">Soccer | 30/08/2023</h3>
                    <h1 class="text-2xl md:text-4xl font-bold max-w-2xl leading-tight">
                        Qatar Breaks Italy's Record in Men's Soccer Qualifying Streak
                    </h1>
                    <div class="flex space-x-4 text-sm text-gray-200 mt-4">
                        <span>👁️ 12,400</span>
                        <span>💬 97</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="w-full shrink-0 relative">
            <img src="{{ asset('images/gambar1.jpg') }}" class="w-full h-[600px] object-cover brightness-75"
                alt="Slide 3" />
            <div class="absolute inset-4 flex items-end p-6 md:p-12 text-white">
                <div>
                    <h3 class="text-sm uppercase mb-2">Boxing | 31/08/2023</h3>
                    <h1 class="text-2xl md:text-4xl font-bold max-w-2xl leading-tight">
                        Katie Taylor’s Impact on Women’s Boxing: From Underdog to Icon
                    </h1>
                    <div class="flex space-x-4 text-sm text-gray-200 mt-4">
                        <span>👁️ 8,900</span>
                        <span>💬 65</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Numbered Navigation Dots -->
    <div class="absolute bottom-4 left-12 flex space-x-4">
        <button
            class="w-8 h-8 border-2 border-white rounded-full text-white font-semibold flex items-center justify-center hover:bg-white hover:text-black transition"
            onclick="showSlide(0)">1</button>
        <button
            class="w-8 h-8 border-2 border-white rounded-full text-white font-semibold flex items-center justify-center hover:bg-white hover:text-black transition"
            onclick="showSlide(1)">2</button>
        <button
            class="w-8 h-8 border-2 border-white rounded-full text-white font-semibold flex items-center justify-center hover:bg-white hover:text-black transition"
            onclick="showSlide(2)">3</button>
    </div>
</section>

<!-- Thumbnail Highlights Section -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6 py-10 bg-white">
    <!-- Box 1 -->
    <div class="flex space-x-4">
        <img src="{{ asset('images/gambar2.jpg') }}" alt="Thumb 1" class="w-24 h-24 object-cover rounded-md" />
        <div class="flex flex-col justify-between">
            <h4 class="text-base font-semibold leading-snug">
                Kader Gawek Hadiri FIFA: Garuda Muda Disiapkan Penuh di Waktu Senggang
            </h4>
            <span class="text-xs text-gray-500 mt-1">Tennis | 29/08/2023</span>
        </div>
    </div>

    <!-- Box 2 -->
    <div class="flex space-x-4">
        <img src="{{ asset('images/gambar1.jpg') }}" alt="Thumb 2" class="w-24 h-24 object-cover rounded-md" />
        <div class="flex flex-col justify-between">
            <h4 class="text-base font-semibold leading-snug">
                Qatar Breaks Italy's Record: Men’s Streak Stays Solid with Firepower
            </h4>
            <span class="text-xs text-gray-500 mt-1">Football | 29/08/2023</span>
        </div>
    </div>

    <!-- Box 3 -->
    <div class="flex space-x-4">
        <img src="{{ asset('images/gambar2.jpg') }}" alt="Thumb 3" class="w-24 h-24 object-cover rounded-md" />
        <div class="flex flex-col justify-between">
            <h4 class="text-base font-semibold leading-snug">
                Katie Taylor’s Impact on Women’s Boxing: Her Warrior’s Return
            </h4>
            <span class="text-xs text-gray-500 mt-1">Boxing | 29/08/2023</span>
        </div>
    </div>
</section>
