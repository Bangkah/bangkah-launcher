#!/bin/bash
# Generate SHA256 checksums for all files in the release directory
# Usage: ./scripts/generate-release-checksums.sh dist/

set -e
RELEASE_DIR=${1:-dist}
cd "$RELEASE_DIR"
sha256sum * > SHA256SUMS
cd -
echo "SHA256SUMS generated in $RELEASE_DIR/"
