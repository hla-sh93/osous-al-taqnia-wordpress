#!/usr/bin/env bash
# Runs WP-CLI against the local stack: tools/wp.sh <wp-cli arguments>
set -euo pipefail
cd "$(dirname "$0")/.."
MSYS_NO_PATHCONV=1 docker compose run --rm -T cli wp "$@"
