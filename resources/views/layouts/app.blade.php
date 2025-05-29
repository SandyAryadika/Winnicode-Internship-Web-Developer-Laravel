<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Winnicode')</title>

    <link href="https://fonts.googleapis.com/css2?family=Birthstone&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')

    <!-- CSS Global -->
    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
        }

        .font-birthstone {
            font-family: 'Birthstone', sans-serif;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }
    </style>

    @stack('styles')
</head>

<body>

    @yield('content')

    @php
        $type = session('success') ? 'success' : (session('error') ? 'error' : (session('message') ? 'error' : null));
        $toastColors = [
            'success' => 'bg-green-500 text-white',
            'error' => 'bg-red-500 text-white',
        ];
        $icon =
            $type === 'success'
                ? '<path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />'
                : '<path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />';
    @endphp

    @if ($type)
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition.duration.300ms
            class="fixed top-5 right-5 z-50 flex items-start w-full max-w-sm p-4 rounded-lg shadow-lg {{ $toastColors[$type] }}"
            role="alert">
            <span class="flex-1 text-sm font-medium">
                {{ session('success') ?? (session('error') ?? session('message')) }}
            </span>
            <button @click="show = false" class="ml-4 text-white hover:text-gray-200 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    @endif

    <!-- JS Global -->
    <script>
        // date-today
        document.addEventListener("DOMContentLoaded", () => {
            const dateSpan = document.getElementById("date-today");

            function updateDateTime() {
                const now = new Date();
                const options = {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                };

                const datePart = now.toLocaleDateString('en-US', options);
                const timePart = now.toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });

                dateSpan.textContent = `${datePart}, ${timePart}`;
            }

            updateDateTime();
            setInterval(updateDateTime, 1000);

            const scrollBox = document.getElementById("category-scroll");
            if (scrollBox) {
                scrollBox.innerHTML += scrollBox.innerHTML;

                let scrollAmount = 0;
                const scrollSpeed = 1;
                const intervalSpeed = 35;

                setInterval(() => {
                    scrollBox.scrollLeft += scrollSpeed;
                    scrollAmount += scrollSpeed;

                    if (scrollAmount >= scrollBox.scrollWidth / 2) {
                        scrollBox.scrollLeft = 0;
                        scrollAmount = 0;
                    }
                }, intervalSpeed);
            }
        });

        // hero-slider
        let currentSlide = 0;

        function showSlide(index) {
            const slider = document.getElementById("hero-slider");
            const totalSlides = slider?.children.length || 0;
            if (index >= 0 && index < totalSlides) {
                slider.style.transform = `translateX(-${index * 100}%)`;
                currentSlide = index;
            }
        }

        setInterval(() => {
            currentSlide = (currentSlide + 1) % 3;
            showSlide(currentSlide);
        }, 7000);
    </script>

    @stack('scripts')

</body>

</html>
