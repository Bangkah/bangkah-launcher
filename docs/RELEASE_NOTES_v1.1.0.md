# Bangkah v1.1.0 Release Notes

Date: 2025-12-15

## Highlights
- Clean API/Web scaffolding with safe route backups
- Docker setup for PHP 8.4-FPM and MySQL 8.0
- Comprehensive usage and Docker documentation

## Fixes
- Prevent duplicate `routes/api.php` by making a backup and replacing
- Clarified port mapping to avoid conflicts (recommend internal-only DB ports)

## Migration Guide
1. Update to v1.1.0 via Composer:
```
composer require bangkah/bangkah:^1.1
```
2. If you had duplicated `routes/api.php`, clean the file or re-run:
```
php artisan bangkah:create --type=api --frontend=none --yes
```
3. For Docker users, rebuild the stack:
```
docker-compose down && docker-compose up -d --build
docker-compose exec app php artisan migrate
```

## Known Issues
- `--yes` skips most confirmations, but database selection may still prompt when `--db` is not specified.
- On some systems, host port conflicts may prevent MySQL from binding; removing the host port mapping is recommended for internal-only usage.

## Links
- Usage Guide: docs/USAGE.md
- Docker Guide: docs/DOCKER.md
- Changelog: CHANGELOG.md
