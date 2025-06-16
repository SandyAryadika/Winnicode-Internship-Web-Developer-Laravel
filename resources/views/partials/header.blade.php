<header class="flex flex-wrap md:flex-nowrap items-center justify-between px-6 py-4 border-b text-sm gap-4">
    <div class="flex-shrink-0">
        <a href="{{ route('landing') }}">
            <img src="{{ asset('images/Winni Code.png') }}" loading="lazy" alt="WinniCode Logo"
                class="h-16 object-contain" />
        </a>
    </div>

    <div class="flex items-center gap-4 ml-auto">
        <form action="{{ route('search') }}" method="GET"
            class="flex items-center border border-gray-300 px-4 py-2 rounded w-80 bg-transparent">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search Winnicode..."
                class="bg-transparent outline-none text-sm text-black placeholder-gray-400 w-full" />
            <button type="submit">
                <img src="{{ asset('images/search.png') }}" loading="lazy" alt="Search" class="w-5 h-5 ml-2" />
            </button>
        </form>

        @if (session('subscribed_email'))
            <form method="POST" action="{{ route('subscriber.unsubscribe') }}">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 rounded bg-pink-500 text-white text-sm font-semibold transition duration-300 hover:bg-pink-600">
                    <img src="{{ asset('images/bell-uns.png') }}" loading="lazy" alt="Bell Icon" class="w-4 h-4">
                    Unsubscribe
                </button>
            </form>
        @else
            <a href="#newsletter-section" id="subscribe-btn"
                class="flex items-center gap-2 px-4 py-2 rounded border border-pink-500 text-pink-500 text-sm font-semibold transition duration-300 hover:bg-pink-50">
                <img src="{{ asset('images/bell-sub.png') }}" alt="Bell Icon" class="w-4 h-4">
                Subscribe
            </a>
        @endif
    </div>
</header>
