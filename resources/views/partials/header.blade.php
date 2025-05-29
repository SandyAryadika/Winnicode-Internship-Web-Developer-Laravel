<!-- Top Bar -->
<div class="bg-[#FFF3FA] flex justify-center items-center py-6 text-sm text-[#252525] border-b font-medium">
    <span id="date-today">Loading date...</span>
</div>

<!-- Header: Logo + Right Menu -->
<header class="flex items-center justify-between px-6 py-4 border-b text-sm">
    <!-- Logo -->
    <div class="whitespace-nowrap">
        <a href="{{ route('landing') }}">
            <img src="{{ asset('images/Winni Code.png') }}" alt="WinniCode Logo" class="h-16 object-contain" />
        </a>
    </div>

    <!-- Right Side: Search -->
    <form action="{{ route('search') }}" method="GET"
        class="flex items-center bg-[#FFF3FA] px-4 py-3 rounded-full w-full max-w-72">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search Winnicode..."
            class="bg-transparent outline-none text-sm placeholder-[#f2f2f2] w-full" />
        <button type="submit">
            <img src="{{ asset('images/search.png') }}" alt="Search" class="w-5 h-5 ml-2" />
        </button>
    </form>
</header>
</nav>
