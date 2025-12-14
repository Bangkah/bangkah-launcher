# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.0] - 2025-12-15
### Added
- API and Web templates with safe route backups before replacement
- Docker scaffolding (PHP 8.4-FPM, MySQL 8.0, optional phpMyAdmin)
- Usage and Docker documentation under `docs/`

### Changed
- Updated minimum PHP requirement to 8.4
- Improved environment configuration logic for Docker and database selection

### Fixed
- Avoided duplicate `routes/api.php` content by replacing with backup (was appending)
- Resolved port conflicts guidance and internal-only DB port mapping recommendation

### Migration Notes
- If you previously ran `bangkah:create` with API preset, remove duplicated sections in `routes/api.php` or re-run after this version; backups will be created automatically.

[1.1.0]: https://github.com/Bangkah/bangkah-launcher/releases/tag/v1.1.0
# Changelog

All notable changes to Bangkah will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.1] - 2025-12-15

### Fixed
- 🛠️ Rebuilt package dist to remove escaped characters that caused a PHP parse error in `StarterCreateCommand` when installing from Packagist
- ✅ Verified fresh `composer require bangkah/bangkah` install succeeds without syntax errors

### Notes
- Tag `v1.1.1` is a hotfix; no API or behavior changes from 1.1.0

## [1.1.0] - 2025-12-15

### Added
- Feature and stability improvements for the starter CLI (TTY detection, logging, validation, Docker fixes)
- See package changelog for full details

## [1.0.0] - 2025-12-15

### Added

#### Core Features
- 🎯 Interactive CLI command with step-by-step wizard
- 🚀 Non-interactive mode with `--yes` flag for automation
- 📦 Web & API project templates with starter code
- 🐳 Docker + Nginx + Database configuration generator
- 🔐 Authentication scaffolding (Laravel Breeze & UI)
- 🎨 Frontend framework support (Tailwind CSS, Bootstrap, None)
- 💾 Multiple database support (MySQL, PostgreSQL)
- ⚡ Auto-build frontend assets after installation

#### Templates
- **Web Template**:
  - Modern gradient homepage
  - HomeController with routes
  - Responsive design with feature cards
  - Vite integration
  
- **API Template**:
  - Health check endpoint with system info
  - API routes enabled for Laravel 12
  - CORS pre-configured
  - RESTful ready structure

#### Docker Support
- Optimized Dockerfile with PHP 8.2-FPM
- docker-compose.yml with multi-service setup
- Nginx configuration for Laravel
- MySQL 8.0 and PostgreSQL 16 support
- Persistent volumes for data
- Network configuration

#### Services
- `TemplateService` - Template generation & copying
- `DockerService` - Docker files generation
- `DependencyInstaller` - Package installation & build automation
- `EnvironmentService` - .env configuration

#### Documentation
- Comprehensive README with 2500+ lines
- 15+ examples and use cases
- Troubleshooting guide with 7+ common issues
- FAQ section with 15+ Q&A
- Deployment guide for multiple platforms
- Advanced usage and extension guides

### Features Details

- ✅ Laravel 12.x compatibility
- ✅ PHP 8.2+ support
- ✅ Service Provider with auto-discovery
- ✅ PSR-4 autoloading
- ✅ Command registration via Laravel
- ✅ Stub-based template system
- ✅ Automatic npm package installation
- ✅ Automatic frontend asset building
- ✅ Environment variable auto-configuration
- ✅ Local repository cleanup for Docker builds

### Security
- Non-root user in Docker containers
- Proper file permissions handling
- Hidden sensitive files in Nginx config
- Environment variable protection

### Developer Experience
- Clear error messages
- Progress indicators
- Colored output for better readability
- Validation for user inputs
- Automatic dependency resolution

### Platform Support
- Linux (primary)
- macOS (supported)
- Windows (via WSL2)

---

## [Unreleased]

### Planned Features
- Additional database support (SQLite, MariaDB, SQL Server)
- More frontend frameworks (Vue, React, Alpine)
- Custom stub publishing
- Multiple language support
- GitHub Actions workflows
- Testing suite
- Performance optimizations

---

## Release Notes

### v1.0.0 - Initial Release

This is the first stable release of Bangkah Laravel Starter Kit. The package provides a comprehensive scaffolding solution for Laravel projects with focus on:

- **Simplicity**: Easy-to-use interactive CLI
- **Flexibility**: Multiple configuration options
- **Production Ready**: Optimized Docker configs
- **Best Practices**: Following Laravel conventions
- **Modern Stack**: Laravel 12.x support

### Installation

```bash
composer require bangkah/bangkah
php artisan bangkah:create
```

### Quick Start

```bash
# Full stack web app
php artisan bangkah:create --type=web --docker --nginx --auth --yes

# API only
php artisan bangkah:create --type=api --docker --db=postgres --yes
```

### Support

- GitHub: https://github.com/Bangkah/bangkah-launcher
- Issues: https://github.com/Bangkah/bangkah-launcher/issues
- Discussions: https://github.com/Bangkah/bangkah-launcher/discussions

---

[1.1.1]: https://github.com/Bangkah/bangkah-launcher/compare/v1.1.0...v1.1.1
[1.1.0]: https://github.com/Bangkah/bangkah-launcher/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/Bangkah/bangkah-launcher/releases/tag/v1.0.0
[Unreleased]: https://github.com/Bangkah/bangkah-launcher/compare/v1.1.1...HEAD
