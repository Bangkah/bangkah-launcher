# Release Notes - v1.0.1

**Release Date:** December 15, 2025  
**Type:** Bug Fix Release

## 🐛 Fixes

### Ambiguous Class Resolution
- **Fixed:** Added `exclude-from-classmap` configuration to package `composer.json`
- **Impact:** Eliminates warnings about duplicate classes (`DatabaseSeeder`, `UserFactory`, `Controller`, `User`, `AppServiceProvider`)
- **Result:** Clean installation without autoload conflicts

### Missing Command Registration
- **Fixed:** Command `bangkah:create` now properly registers in all installations
- **Cause:** Ambiguous class warnings prevented service provider from loading correctly
- **Result:** `php artisan bangkah:create` works immediately after `composer require`

## 🔧 Technical Details

### Excluded Paths
The following directories are now excluded from Composer's classmap generation:
- `/app/`
- `/bootstrap/`
- `/config/`
- `/database/`
- `/public/`
- `/resources/`
- `/routes/`
- `/storage/`
- `/tests/`
- `/vendor/`

This ensures that even if the package archive accidentally includes monorepo files, they won't interfere with the user's application.

### Clean Distribution
- All tags now point to clean subtree commits containing only package files
- Package structure: `bin/`, `src/`, `stubs/`, `composer.json`

## 📦 Installation

```bash
composer require bangkah/bangkah:^1.0
```

## ✅ Verification

After installation, verify the command is available:
```bash
php artisan list | grep bangkah
# Should show: bangkah:create

php artisan bangkah:create --help
# Should display command options
```

## 🔗 Links

- [Changelog](../CHANGELOG.md)
- [Usage Guide](USAGE.md)
- [Docker Guide](DOCKER.md)
- [Repository](https://github.com/Bangkah/bangkah-launcher)
- [Packagist](https://packagist.org/packages/bangkah/bangkah)

## 🙏 Notes

If you previously installed v1.1.0 and encountered issues:
1. Run `composer remove bangkah/bangkah`
2. Clear cache: `composer clear-cache`
3. Install v1.0.1: `composer require bangkah/bangkah:^1.0`
4. Clear Laravel caches: `php artisan optimize:clear`

The package is now stable and ready for production use.
