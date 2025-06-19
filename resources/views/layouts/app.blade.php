<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Winnicode')</title>

    <link rel="shortcut icon" href="{{ asset('images/circle-winnicode.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Birthstone&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        // --- GLOBAL FUNCTIONS ---
        function scrollCarousel(containerId, direction) {
            const container = document.getElementById(containerId);
            if (!container) {
                console.warn('Container not found:', containerId);
                return;
            }

            const card = container.querySelector('.carousel-card');
            const gap = 16; // gap-x-4 = 1rem
            const scrollAmount = (card ? card.offsetWidth : 320) + gap;

            container.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }

        function confirmDelete(button) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Aksi ini tidak bisa dibatalkan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }

        function toggleReplyForm(id) {
            const form = document.getElementById(`reply-form-${id}`);
            if (form) {
                form.classList.toggle('hidden');
            }
        }

        // --- DOM READY LOGIC ---
        document.addEventListener("DOMContentLoaded", function() {
            // Date-Time Live Update
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

            // Hero Slider Logic
            const slider = document.getElementById('hero-slider');
            if (slider) {
                let currentSlide = 0;
                const slideCount = slider.children.length;

                window.showSlide = function(index) {
                    if (index >= 0 && index < slideCount) {
                        currentSlide = index;
                        const offset = -index * 100;
                        slider.style.transform = `translateX(${offset}%)`;
                    }
                };

                setInterval(() => {
                    currentSlide = (currentSlide + 1) % slideCount;
                    window.showSlide(currentSlide);
                }, 5000);
            }

            // Marquee/Auto Scrolling Category
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
        });
    </script>


    @stack('scripts')

</body>

</html>
