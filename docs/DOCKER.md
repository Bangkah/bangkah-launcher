# Docker Guide

Bangkah can scaffold a Docker setup for Laravel development.

## Stack
- App: PHP 8.4-FPM
- DB: MySQL 8.0 (or PostgreSQL if selected)
- Optional: phpMyAdmin and Nginx

## Quick Start
```
docker-compose up -d --build
docker-compose exec app php artisan migrate
```

App URL: http://localhost:8000
phpMyAdmin: http://localhost:8081 (if enabled)

## Environment
For MySQL:
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=bangkah_db
DB_USERNAME=bangkah_user
DB_PASSWORD=bangkah_pass
```

## Port Conflicts
If host ports are in use:
- Change MySQL host port from `3307:3306` or remove port mapping (internal only)
- Change phpMyAdmin host port from `8081:80`

## SQLite Option
You can use a lightweight SQLite setup. Ensure `database/database.sqlite` exists and set:
```
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/database/database.sqlite
```

## Troubleshooting
- If containers start but app can't reach DB, ensure both are on the same compose network.
- If MySQL binding fails (`port is already allocated`), remove host port mapping or free the port.
- If `ping` is missing in app container, use `docker inspect` to verify network IPs.
