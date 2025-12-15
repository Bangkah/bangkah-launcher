#!/bin/bash

# Script to update Packagist package
# Requires: PACKAGIST_TOKEN environment variable

PACKAGE="bangkah/bangkah"
TOKEN="${PACKAGIST_TOKEN:-}"

if [ -z "$TOKEN" ]; then
    echo "❌ Error: PACKAGIST_TOKEN environment variable not set"
    echo ""
    echo "To get your token:"
    echo "1. Login to https://packagist.org"
    echo "2. Go to your profile → API Token"
    echo "3. Copy your token"
    echo "4. Run: export PACKAGIST_TOKEN='your-token-here'"
    echo ""
    echo "Or manually update at: https://packagist.org/packages/bangkah/bangkah"
    echo "Change repository URL to: https://github.com/Bangkah/bangkah"
    exit 1
fi

echo "🔄 Triggering Packagist update for $PACKAGE..."

RESPONSE=$(curl -s -X POST \
    "https://packagist.org/api/update-package?username=Bangkah&apiToken=$TOKEN" \
    -d "repository[url]=https://github.com/Bangkah/bangkah")

if echo "$RESPONSE" | grep -q '"status":"success"'; then
    echo "✅ Packagist update triggered successfully!"
    echo "⏳ Wait 30 seconds for indexing..."
    sleep 30
    
    echo ""
    echo "🧪 Testing installation..."
    rm -rf /tmp/test-packagist-update
    composer create-project laravel/laravel /tmp/test-packagist-update --no-interaction --quiet
    cd /tmp/test-packagist-update
    
    if composer require bangkah/bangkah --no-audit --quiet 2>&1 | grep -q "Installing bangkah/bangkah"; then
        VERSION=$(composer show bangkah/bangkah | grep "versions" | awk '{print $3}')
        echo "✅ Installation successful! Version: $VERSION"
        
        if php artisan bangkah:create --help >/dev/null 2>&1; then
            echo "✅ Command registered correctly"
        else
            echo "❌ Command not found - package structure issue"
        fi
    else
        echo "❌ Installation failed"
    fi
else
    echo "❌ Failed to update Packagist"
    echo "$RESPONSE"
fi
