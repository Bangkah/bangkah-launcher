# Bangkah Usage Guide

This guide covers the `bangkah:create` command, options, and examples.

## Command

```
php artisan bangkah:create [options]
```

## Options
- `--docker`: Enable Docker scaffolding
- `--nginx`: Use Nginx with Docker
- `--type=`: `web|api`
- `--auth`: Include auth scaffolding
- `--db=`: `mysql|postgres`
- `--frontend=`: `tailwind|bootstrap|none`
- `--yes`: Auto-confirm prompts (non-interactive)

## Examples

### Web preset with Tailwind + Docker
```
php artisan bangkah:create --type=web --frontend=tailwind --docker --nginx --yes
```

### API preset, headless (no frontend)
```
php artisan bangkah:create --type=api --frontend=none --yes
```

### PostgreSQL
```
php artisan bangkah:create --type=web --db=postgres --yes
```

## Generated Files
- Web: `routes/web.php`, `app/Http/Controllers/HomeController.php`, `resources/views/home.blade.php`
- API: `routes/api.php`, `app/Http/Controllers/Api/HealthController.php`
- Docker: `Dockerfile`, `docker-compose.yml`, optional `docker/nginx/nginx.conf`

## Backups
When replacing routes, Bangkah creates backups:
- `routes/web.php.backup-YYYYMMDDHHMMSS`
- `routes/api.php.backup-YYYYMMDDHHMMSS`

## Next Steps
- Run migrations: `php artisan migrate`
- Serve: `php artisan serve` (or Docker: `docker-compose up -d`)

## Troubleshooting
- If composer fails, ensure PHP meets requirements (PHP 8.4+)
- For Docker port conflicts, change host ports in `docker-compose.yml`
- If `route:list` fails after scaffolding, check for duplicated `<?php` tags in routes. Bangkah now backs up and replaces routes cleanly.
