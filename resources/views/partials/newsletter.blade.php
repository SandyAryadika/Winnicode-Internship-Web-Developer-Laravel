<div id="toast"
    class="hidden fixed top-5 right-5 bg-white border border-gray-300 shadow-lg rounded-lg p-4 z-50 transition transform duration-300">
    <p id="toast-message" class="text-sm text-gray-800"></p>
</div>

<!-- Newsletter -->
<section id="newsletter" class="bg-white px-6 py-16 mt-8">
    <div class="max-w-4xl mx-auto text-center mb-12">
        <h3 class="text-3xl font-bold mb-2">Stay Updated</h3>
        <p class="text-gray-600 mb-6">
            Subscribe kami untuk mendapatkan berita terbaru dan pembaruan eksklusif
        </p>

        <!-- Feedback Message -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Newsletter Form -->
        <form method="POST" action="{{ route('subscribe') }}"
            class="flex flex-col sm:flex-row justify-center gap-4 max-w-xl mx-auto">
            @csrf
            <input type="email" name="email" required placeholder="Masukkan Email Anda..."
                class="w-full sm:w-auto flex-1 px-4 py-2 border rounded-full focus:outline-none focus:ring focus:border-blue-300">
            <button type="submit" class="bg-[#F2F4FF] text-black px-6 py-2 rounded-full border border-gray-300">
                Subscribe
            </button>
        </form>
    </div>
</section>
