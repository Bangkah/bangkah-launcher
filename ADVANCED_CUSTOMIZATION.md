# Advanced Customization (ADVANCED_CUSTOMIZATION.md)

Panduan ini untuk developer senior yang ingin mengubah, menambah, atau mengintegrasikan fitur lanjutan di Bangkah.

## 1. Custom Scaffold Template
- Tambahkan/ubah template di folder `resources/starter/`.
- Gunakan variabel dan logic Blade untuk dynamic scaffolding.
- Pastikan template aman dari malicious code.

## 2. Integrasi CI/CD Lanjutan
- Modifikasi workflow di `.github/workflows/` untuk pipeline multi-stage, matrix build, atau deployment otomatis.
- Tambahkan secret, badge, dan notifikasi sesuai kebutuhan tim.

## 3. Override Docker/Nginx
- Edit `Dockerfile`, `docker-compose.yml`, atau `docker/nginx/default.conf` untuk kebutuhan khusus (multi-service, custom port, dsb).
- Gunakan ARG/ENV untuk parameterisasi build.

## 4. Menambah Command CLI
- Tambahkan command baru di `app/Console/Commands/`.
- Register di `app/Console/Kernel.php`.

## 5. Audit & Security
- Review semua template dan dependency.
- Gunakan tools seperti `phpstan`, `larastan`, dan Dependabot.

## 6. Testing & E2E
- Integrasi Dusk, Pest, atau Cypress untuk E2E test.
- Tambahkan coverage dan badge di CI.

---

Untuk diskusi lebih lanjut, gunakan GitHub Discussions atau ajukan PR/issue.
