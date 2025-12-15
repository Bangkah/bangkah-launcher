# Changelog

All notable changes to `bangkah/bangkah` will be documented in this file.

## [1.0.2] - 2024-12-15

### Fixed
- Fixed vendor directory deletion issue in scaffolding command that broke artisan
- Docker startup environment variables and bootstrapping now properly initialize apps
- Session driver defaults to `file` in generated Docker configs to avoid DB requirement

### Changed
- Updated generated Docker stack to use PHP 8.4 (fpm and cli)
- Nginx service now exposed on host port 8080 by default
- Success URL message updated to reflect http://localhost:8080
- Docker app service now includes env vars (APP_*, SESSION_DRIVER, DB_*)
- Docker startup command now copies .env from .env.example, runs key:generate, and fixes permissions
- Vite dev server in Node service now binds to 0.0.0.0:5173 with strictPort
- Removed external port mapping for MySQL service (internal networking only)

## [1.0.1] - 2024-12-14

### Fixed
- Added `exclude-from-classmap` for `App/` to prevent class ambiguity during installation

## [1.0.0] - 2024-12-13

### Added
- Initial release
- Starter kit scaffolding with Web/API presets
- Docker support with optional Nginx
- Frontend framework integration (Vue, React, Svelte, Alpine)
- Health check endpoints and controllers
- Automatic route generation
- Database configuration (MySQL/PostgreSQL)
