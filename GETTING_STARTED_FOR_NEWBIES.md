# Panduan Awal untuk Pemula (GETTING_STARTED_FOR_NEWBIES.md)

## Istilah Penting

- **Scaffold**: Proses otomatis membuat struktur dan file dasar project (folder, config, kode awal) agar siap dikembangkan tanpa setup manual.
- **Docker**: Platform untuk menjalankan aplikasi di dalam container (lingkungan terisolasi), sehingga project bisa berjalan konsisten di semua komputer/server.
- **Nginx**: Web server modern yang sering digunakan untuk melayani aplikasi web, proxy, dan static file. Di Bangkah, Nginx mengatur lalu lintas HTTP ke aplikasi Laravel.

## Langkah Awal
1. Pastikan sudah install PHP, Composer, dan (opsional) Docker.
2. Clone repo ini, lalu jalankan:
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   php artisan serve
   # atau gunakan Docker: ./vendor/bin/sail up -d
   ```
3. Buka http://localhost:8000 di browser.

## Tips
- Jika ada error, cek dokumentasi atau tanya di komunitas.
- Untuk belajar lebih lanjut, baca README.md dan dokumentasi lain di repo ini.
