<section id="newsletter-section" class="px-6 py-16">
    <div class="max-w-4xl mx-auto text-center mb-12">
        <h3 class="text-3xl font-bold mb-2">Stay Updated</h3>
        <p class="text-gray-600 mb-6">
            Subscribe kami untuk mendapatkan berita terbaru dan pembaruan eksklusif
        </p>

        <form method="POST" action="{{ route('subscriber.store') }}"
            class="flex flex-col sm:flex-row justify-center gap-4 max-w-xl mx-auto">
            @csrf
            <input type="email" name="email" required placeholder="Masukkan Email Anda..."
                pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$"
                title="Gunakan alamat email yang valid dan berakhiran @gmail.com"
                class="w-full sm:w-auto flex-1 px-4 py-2 border rounded focus:outline-none focus:border-blue-600"
                style="border-color: rgba(0, 0, 0, 0.253);">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <button type="submit"
                class="bg-blue-400 text-white px-6 py-2 rounded border border-gray-300 shadow-md hover:shadow-lg transition">
                Subscribe
            </button>
        </form>
    </div>
</section>
