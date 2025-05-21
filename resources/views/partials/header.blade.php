<!-- resources/views/layouts/header.blade.php -->

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Updatix - Portal Berita</title>

    {{-- Bootstrap & Fonts --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;700&display=swap" rel="stylesheet">

    {{-- CSS Lokal --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    {{-- Header --}}
    <div class="container header-container mt-3">
        <a class="navbar-brand" href="#">Updatix</a>
        <div class="search-box">
            <img src="{{ asset('icons/search.png') }}" alt="Search">
            <input type="text" placeholder="Apa yang Anda Cari?">
        </div>
    </div>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light mt-2">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kategori</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Login</a></li>
                </ul>
                <button type="submit" class="btn subscribe-btn">Subscribe</button>
            </div>
        </div>
    </nav>
</body>