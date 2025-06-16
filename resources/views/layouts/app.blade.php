<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Winnicode')</title>

    <link rel="shortcut icon" href="{{ asset('images/circle-winnicode.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Birthstone&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CSS Global -->
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Noto Sans', sans-serif;
        }

        .font-birthstone {
            font-family: 'Birthstone', sans-serif;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
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
    @yield('head')
</head>

<body>
    @yield('content')

    @php
        $success = session()->pull('success');
        $error = session()->pull('error');
        $message = session()->pull('message');

        $toastMessage = $success ?? ($error ?? $message);
        $type = $success ? 'success' : ($error || $message ? 'error' : null);

        $toastColors = [
            'success' => 'bg-green-500 text-white',
            'error' => 'bg-red-500 text-white',
        ];
    @endphp

    @if ($toastMessage && $type)
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition.duration.300ms
            class="fixed top-5 right-5 z-50 flex items-start w-full max-w-sm p-4 rounded-lg shadow-lg {{ $toastColors[$type] }}"
            role="alert">
            <span class="flex-1 text-sm font-medium">
                {{ $toastMessage }}
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
        document.addEventListener("DOMContentLoaded", function() {
            // Date-Time
            const dateSpan = document.getElementById("date-today");
            if (dateSpan) {
                function updateDateTime() {
                    const now = new Date();
                    const datePart = now.toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        timeZone: 'Asia/Jakarta'
                    });

                    const timePart = now.toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: true,
                        timeZone: 'Asia/Jakarta'
                    });

                    dateSpan.textContent = `${datePart}, ${timePart}`;
                }

                updateDateTime();
                setInterval(updateDateTime, 1000);
            }

            // Category Scroll
            const scrollBox = document.getElementById("category-scroll");
            if (scrollBox && !scrollBox.dataset.duplicated) {
                scrollBox.innerHTML += scrollBox.innerHTML;
                scrollBox.dataset.duplicated = "true";

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

            // Hero Slider
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

            // Related Cards
            window.scrollCarousel = function(id, direction) {
                const container = document.getElementById(id);
                const scrollAmount = 320;
                container?.scrollBy({
                    left: direction * scrollAmount,
                    behavior: 'smooth'
                });
            }
        });
    </script>

    @stack('scripts')

</body>

</html>
