<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Winnicode')</title>

    <link href="https://fonts.googleapis.com/css2?family=Birthstone&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CSS Global -->
    <style>
        body {
            font-family: 'Lexend', sans-serif;
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
    </style>

    @stack('styles')
</head>

<body>

    @yield('content')

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
