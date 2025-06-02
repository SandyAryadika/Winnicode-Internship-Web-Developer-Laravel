<div id="toast"
    class="hidden fixed top-5 right-5 bg-white border border-gray-300 shadow-lg rounded-lg p-4 z-50 transition transform duration-300">
    <p id="toast-message" class="text-sm text-gray-800"></p>
</div>

<section class="px-6 py-16">
    <div class="max-w-4xl mx-auto text-center mb-12">
        <h3 class="text-3xl font-bold mb-2">Stay Updated</h3>
        <p class="text-gray-600 mb-6">
            Subscribe kami untuk mendapatkan berita terbaru dan pembaruan eksklusif
        </p>

        {{-- @if (session('success'))
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
        @endif --}}

        <form method="POST" action="{{ route('subscriber.store') }}"
            class="flex flex-col sm:flex-row justify-center gap-4 max-w-xl mx-auto">
            @csrf
            <input type="email" name="email" required placeholder="Masukkan Email Anda..."
                class="w-full sm:w-auto flex-1 px-4 py-2 border rounded focus:outline-none focus:border-blue-600"
                style="border-color: rgba(0, 0, 0, 0.253);">
            <button type="submit"
                class="bg-blue-400 text-white px-6 py-2 rounded border border-gray-300 shadow-md hover:shadow-lg transition">
                Subscribe
            </button>
        </form>
    </div>
</section>
