# Winnicode - Portal Berita

**Winnicode** adalah aplikasi portal berita berbasis Laravel yang menyajikan konten informatif dengan tampilan antarmuka yang interaktif dan rapi. Proyek ini dikembangkan menggunakan Laravel 12 dan Filament 3, serta mengusung prinsip desain modern dengan Tailwind CSS.


## 🧩 Teknologi yang Digunakan

- **Laravel 12** – Framework backend PHP yang andal dan efisien.
- **Filament 3** – Panel admin modern berbasis TALL Stack.
- **Tailwind CSS** – Framework CSS utility-first.
- **MySQL** – Sistem manajemen basis data relasional.



## 🎯 Fitur Utama

### 👥 Halaman Publik
- Beranda dengan berbagai segmen berita:
  - Berita hangat
  - Berita utama
  - Sorotan pilihan
  - Rekomendasi artikel
  - Pilihan penulis
  - Kontributor teratas
- Halaman detail artikel yang fokus pada keterbacaan.
- Daftar artikel berdasarkan kategori.
- Profil penulis dan daftar artikelnya.
- Fitur pencarian artikel.

### 🛠️ Panel Admin
- Manajemen artikel (CRUD)
- Manajemen kategori (CRUD)
- Manajemen penulis (CRUD)
- Pengelolaan subscriber
- Moderasi komentar
- Pengaturan peran pengguna berbasis Role-Based Access Control (RBAC)



## 🔧 Langkah-Langkah Instalasi Winnicode

Ikuti langkah-langkah berikut untuk menjalankan aplikasi Winnicode secara lokal di komputer Anda.

### ⚙️ Prasyarat

Pastikan server lokal Anda memenuhi persyaratan berikut:

- PHP 8.2 atau lebih tinggi
- Composer
- Database MySQL/MariaDB
- Node.js & npm (jika menggunakan fitur frontend)


## ⚙️ Langkah-Langkah Instalasi Winnicode

1. **Clone Repository**
    ```bash
    git clone https://github.com/SandyAryadika/Winnicode-LaravelDeveloper.git
    cd Winnicode-LaravelDeveloper
    ```

2. **Install Dependensi PHP**
    Jalankan perintah berikut untuk menginstal seluruh dependensi backend Laravel:
    ```bash
    composer install
    ```

3. **Buat & Konfigurasi File Environment**
    Salin file `.env.example` menjadi `.env`, lalu generate kunci aplikasi.

    * Untuk Windows:
      ```bash
      copy .env.example .env
      ```
    * Untuk macOS/Linux:
      ```bash
      cp .env.example .env
      ```

    Lalu jalankan:
    ```bash
    php artisan key:generate
    ```

4. **Setup Database (Import dari File `.sql`)**

    a. Buka XAMPP Control Panel atau aplikasi server lokal Anda, lalu aktifkan layanan **Apache** dan **MySQL**.

    b. Akses `http://localhost/phpmyadmin` melalui browser.

    c. Buat database baru dengan nama **`winnicode`** (pastikan belum ada sebelumnya).

    d. Buka file `.env`, lalu pastikan bagian konfigurasi database seperti berikut:
    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=winnicode
    DB_USERNAME=root
    DB_PASSWORD=
    ```

    e. Kembali ke phpMyAdmin, klik database **`winnicode`** yang baru dibuat.

    f. Buka tab **"Import"**.

    g. Klik tombol **"Choose File"** dan pilih file `winnicode.sql` yang ada di folder `database/seeder` dalam proyek.

    h. Klik tombol **"Go"** untuk memulai proses impor.

5. **Instalasi Aset Frontend (Jika Menggunakan Vite)**

    Jika proyek ini menggunakan Vite atau Anda ingin menampilkan frontend interaktif, jalankan perintah berikut:
    ```bash
    npm install
    npm run dev
    ```

6. **Buat Symbolic Link untuk Storage**

    Untuk menampilkan gambar seperti thumbnail artikel dan foto penulis dengan benar di browser, jalankan:
    ```bash
    php artisan storage:link
    ```

    Perintah ini membuat link simbolik dari `storage/app/public` ke `public/storage`, agar file bisa diakses publik.


## 🚀 Jalankan Aplikasi

1. **Menjalankan Server Laravel**
    Jalankan perintah berikut untuk memulai server lokal Laravel:
    ```bash
    php artisan serve
    ```

2. **Akses Aplikasi**
    * **Halaman Publik**: [http://127.0.0.1:8000](http://127.0.0.1:8000)
    * **Panel Admin**: [http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin)
    * **Email**: winnicode@gmail.com  
    * **Password**: 12345678

Jika database Anda belum memiliki akun pengguna admin/editor, Anda dapat membuatnya secara manual melalui terminal dengan perintah berikut:

```bash
php artisan make:filament-user-role "Nama Lengkap" email@example.com password role
```
> Gantilah role dengan salah satu peran yang tersedia di aplikasi, seperti: admin atau editor.
