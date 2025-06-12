<div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 border-t pt-12">
    <div>
        <h4 class="font-bold mb-3 text-lg">About Us</h4>
        <p class="text-sm text-gray-600">Jurnalistik Program winnicode adalah program pengembangan sumber daya
            manusia yang ditujukan bagi pemuda pemudi yang berkarir di dunia report.</p>
    </div>

    <div class="space-y-2">
        <h4 class="font-semibold text-lg">Quick Links</h4>
        <ul class="text-sm text-gray-600 space-y-1">
            @foreach ($quickCategories ?? [] as $category)
                <li>
                    <a href="{{ route('categories.show', ['id' => $category->id]) }}" class="hover:text-[#5271FF]">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div>
        <h4 class="font-bold mb-4 text-lg">Kontak Kami</h4>
        <ul class="space-y-2 text-sm text-gray-600">
            <li><span class="text-black font-medium">E-Mail:</span> winnicodegarudaofficial@gmail.com</li>
            <li><span class="text-black font-medium">Call Center:</span><br> 6285159932501 (24 Jam)</li>
        </ul>
    </div>

    <div>
        <h4 class="font-bold mb-3 text-lg">Follow Us</h4>
        <div class="flex gap-4">
            <a href="https://winnicode.com/" target="_blank" class="hover:opacity-80 transition">
                <img src="{{ asset('images/web.png') }}" alt="Website" class="w-6 h-6">
            </a>
            <a href="https://www.instagram.com/winnicodeofficial/" target="_blank" class="hover:opacity-80 transition">
                <img src="{{ asset('images/instagram.png') }}" alt="Instagram" class="w-6 h-6">
            </a>
        </div>
    </div>
</div>

<div class="text-center text-sm text-gray-500 mt-10 mb-6">
    Copyright &copy; 2025 PT. WINNICODE GARUDA TEKNOLOGI.
</div>
