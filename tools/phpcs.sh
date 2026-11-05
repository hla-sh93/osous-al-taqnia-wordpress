#!/usr/bin/env bash
# Runs PHP_CodeSniffer (WordPress Coding Standards) in a PHP container: tools/phpcs.sh [args]
set -euo pipefail
cd "$(dirname "$0")/.."
MSYS_NO_PATHCONV=1 docker run --rm -v "$(pwd -W 2>/dev/null || pwd):/app" -w /app --entrypoint php wordpress:php8.3-apache vendor/bin/phpcs "$@"
