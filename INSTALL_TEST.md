# Bangkah Launcher Fix - v1.0.1

## What Was Fixed

1. **Added `exclude-from-classmap`** to prevent ambiguous class resolution
   - Excludes: `/app/`, `/bootstrap/`, `/config/`, `/database/`, `/public/`, `/resources/`, `/routes/`, `/storage/`, `/tests/`, `/vendor/`
   - This ensures that even if the Packagist archive accidentally includes monorepo files, they won't be added to Composer's classmap

2. **Clean subtree tagging** 
   - v1.0.0: `e2698c3` (retagged to clean package)
   - v1.0.1: `42f2f06` (includes exclude-from-classmap fix)

## Test Installation (Once Packagist is Accessible)

### Refresh Packagist
Go to https://packagist.org/packages/bangkah/bangkah and click "Update"

### Clean Install Test
```bash
# Create fresh test project
rm -rf /tmp/test-bangkah
laravel new /tmp/test-bangkah
cd /tmp/test-bangkah

# Clear cache and install
composer clear-cache
composer require bangkah/bangkah:^1.0 --no-audit

# Clear Laravel caches
rm -f bootstrap/cache/*.php
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear
composer dump-autoload -o

# Verify command is available (should show bangkah:create)
php artisan list | grep -i bangkah

# Test the command
php artisan bangkah:create --type=api --frontend=none --yes

# Run migrations
php artisan migrate
```

### Expected Results
- ✅ No "Ambiguous class resolution" warnings
- ✅ `bangkah:create` command available in artisan list
- ✅ Scaffolding completes successfully
- ✅ Migrations run without errors

## Current Network Issue
Packagist.org is currently unreachable (connection timeout). Once network is restored:
1. Wait a few minutes for Packagist to sync the new v1.0.1 tag
2. Run the test commands above

## Version History
- v1.0.0: Initial stable release (retagged with clean subtree)
- v1.0.1: Added exclude-from-classmap to prevent ambiguous classes (CURRENT)
- v1.1.0: Removed (was bloated with monorepo files)

## Package Location
- Repository: https://github.com/Bangkah/bangkah-launcher
- Packagist: https://packagist.org/packages/bangkah/bangkah
- Local: `/home/atha/Dokumen/myproject/Bangkah/packages/bangkah/bangkah`
