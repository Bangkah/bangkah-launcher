# Project Structure Guide

Dokumen ini menjelaskan struktur folder utama agar repository tetap bersih, mudah dipahami, dan sesuai konvensi Laravel.

## Root Folder Utama

- `app/`: Business logic, controller, service, provider.
- `bootstrap/`: Bootstrap aplikasi dan cache framework.
- `config/`: Semua konfigurasi aplikasi.
- `database/`: Factory, migration, dan seeder.
- `public/`: Front controller (`index.php`) dan aset public.
- `resources/`: Source CSS/JS dan Blade views.
- `routes/`: Definisi route (`web.php`, `api.php`, `console.php`).
- `storage/`: Cache, logs, sessions, dan file runtime.
- `tests/`: Unit dan feature tests.
- `docs/`: Dokumentasi project.
- `docker/`: Konfigurasi Docker/Nginx pendukung.
- `packages/`: Source package lokal (jika ada).

## Folder Yang Tidak Boleh Masuk Repo Utama

- Folder hasil coba-coba/sandbox lokal (contoh: `tmp/`, `home/`).
- Backup route otomatis dengan pola `routes/*.backup-*`.

Folder di atas sudah diabaikan oleh `.gitignore` agar struktur utama tetap rapi.

## Praktik Rekomendasi

- Simpan eksperimen lokal di luar root repo, atau gunakan branch terpisah.
- Gunakan direktori `docs/` untuk dokumentasi, bukan menaruh file catatan acak di root.
- Bersihkan file backup yang sudah tidak dipakai sebelum commit.
