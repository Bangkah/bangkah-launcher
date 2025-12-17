docker compose -f docker-compose.ci.yml build
docker compose -f docker-compose.ci.yml up --abort-on-container-exit --exit-code-from ci
echo "✅ Step 1: Clear Composer cache"
echo "✅ Step 2: Install Composer dependencies"
echo "✅ Step 3: Install Node dependencies (clean install)"
echo "✅ Step 4: Fix Vite temp folder permissions"
echo "✅ Step 5: Build frontend assets"
echo "✅ Step 6: Prepare SQLite database"
echo "✅ Step 7: Run PHPUnit tests with coverage"
echo "✅ Step 8: All steps completed successfully!"

#!/bin/bash
set -e

echo "✅ Step 1: Build Docker image for CI"
docker build --network=host -f Dockerfile.ci -t bangkah-ci .

echo "✅ Step 2: Run CI/tests in Docker Compose"
docker compose -f docker-compose.ci.yml up --abort-on-container-exit --exit-code-from ci

echo "✅ Step 3: Copy coverage report from container (if exists)"
docker cp $(docker ps -a -q -f name=bangkah-ci-1):/app/coverage.xml ./coverage.xml || true

echo "✅ Step 4: CI pipeline completed!"
