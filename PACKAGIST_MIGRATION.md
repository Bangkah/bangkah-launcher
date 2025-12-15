# Packagist Migration Guide

## Problem
Packagist was pointing to the monorepo (bangkah-launcher) which caused it to download the entire repository structure instead of just the package.

## Solution
Created a separate repository for the package: https://github.com/Bangkah/bangkah

## Steps to Complete Migration

### 1. Update Packagist Repository URL

1. Login to https://packagist.org
2. Go to your package: https://packagist.org/packages/bangkah/bangkah
3. Click "Settings" or "Edit"
4. Update repository URL from:
   - **Old**: `https://github.com/Bangkah/bangkah-launcher.git`
   - **New**: `https://github.com/Bangkah/bangkah.git`
5. Save changes
6. Click "Update" to force Packagist to re-index

### 2. Verify Package Structure

After Packagist update, verify at https://packagist.org/packages/bangkah/bangkah that:
- ✅ Type shows as "library" (not "project")
- ✅ Autoload shows `Bangkah\Starter\` PSR-4 mapping
- ✅ Versions show v1.0.0, v1.0.1, v1.0.2, v1.1.0
- ✅ Repository URL points to bangkah/bangkah (not bangkah-launcher)

### 3. Test Installation

```bash
rm -rf /tmp/test-packagist
composer create-project laravel/laravel /tmp/test-packagist
cd /tmp/test-packagist
composer require bangkah/bangkah:^1.0
php artisan bangkah:create --type=api --frontend=none --yes
php artisan serve
```

Visit http://localhost:8000/api/health - should return JSON response.

### 4. Update Documentation

After Packagist migration is complete, update:
- README.md installation instructions
- Documentation to reference new repository
- Any links pointing to old repository structure

## Repository Structure

### Main Monorepo (bangkah-launcher)
- Contains: Full project with packages, tests, docs
- Purpose: Development, integration testing
- URL: https://github.com/Bangkah/bangkah-launcher

### Package Repository (bangkah)
- Contains: Only the package code (src/, stubs/, bin/)
- Purpose: Distribution via Packagist
- URL: https://github.com/Bangkah/bangkah
- Created from: `git filter-branch --subdirectory-filter packages/bangkah/bangkah`

## Sync Workflow

When making changes to the package:

1. **Develop in monorepo**:
   ```bash
   cd /home/atha/Dokumen/myproject/Bangkah
   # Make changes in packages/bangkah/bangkah/
   git commit -m "your changes"
   git push origin main
   ```

2. **Sync to package repo**:
   ```bash
   cd /tmp/bangkah-package
   git remote add monorepo https://github.com/Bangkah/bangkah-launcher.git
   git fetch monorepo
   git merge monorepo/main --allow-unrelated-histories
   # Resolve conflicts if any, keeping only package files
   git push origin main
   ```

3. **Tag new version**:
   ```bash
   cd /tmp/bangkah-package
   git tag -a v1.0.3 -m "v1.0.3: Description"
   git push origin v1.0.3
   ```

4. **Update Packagist**:
   - Packagist auto-updates via GitHub webhook
   - Or manually trigger update at packagist.org

## Verified Working

✅ Package installs correctly from GitHub  
✅ Command `php artisan bangkah:create` works  
✅ Scaffolding generates correct structure  
✅ Health endpoint returns 200 JSON  
✅ No ambiguous class warnings  
✅ Service provider auto-discovered  

## Current Status

- [x] Package repository created and pushed
- [x] Tags migrated (v1.0.0, v1.0.1, v1.0.2)
- [x] Installation tested from GitHub
- [ ] Packagist URL updated (manual step required)
- [ ] Packagist re-indexed and verified
- [ ] Documentation updated with new instructions

## Notes

- The monorepo (bangkah-launcher) remains the primary development repo
- The package repo (bangkah) is for distribution only
- Consider setting up automated sync with GitHub Actions
- Packagist webhook should be configured on the new repo
