<!-- Top Bar -->
<div class="bg-[#FFF3FA] flex justify-center items-center py-6 text-sm text-[#252525] border-b font-medium">
    <span id="date-today">Loading date...</span>
</div>

<!-- Header: Logo + Right Menu -->
<header class="flex items-center justify-between px-6 py-4 border-b text-sm">
    <!-- Logo -->
    <div class="whitespace-nowrap">
        <img src="{{ asset('images/Winni Code.png') }}" alt="WinniCode Logo" class="h-16 object-contain" />
    </div>


    <!-- Right Side: Search, Subscribe, Login -->
    <div class="flex items-center space-x-3">
        <!-- Search Input + Icon -->
        <div class="flex items-center bg-[#FFF3FA] px-4 py-3 rounded-full w-full max-w-90">
            <input type="text" placeholder="Search..."
                class="bg-transparent outline-none text-sm placeholder-[#252525] w-full" />
            <img src="{{ asset('images/search.png') }}" alt="Search" class="w-5 h-5 ml-2" />
        </div>

        <!-- Subscribe Button -->
        <!-- <button class="text-sm font-medium border px-4 py-3 rounded-full border-gray-300 ">
        Subscribe
      </button> -->

        <!-- Login Button -->
        <!-- <button class="bg-[#FF66C4] text-white px-4 py-3 rounded-full text-sm font-medium">
        Login
      </button> -->
    </div>
</header>
</nav>
