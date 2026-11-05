#!/usr/bin/env bash
# Installs the delivery package on a WordPress that has never seen this repository,
# exactly as a client does (plugin, then theme), and checks every page there.
#
#   python tools/package.py && tools/handoff-test.sh
#
# Passing looks like:  The package installs and the site it makes matches the reference.
set -euo pipefail
cd "$(dirname "$0")/.."

compose=(docker compose -f tools/handoff/docker-compose.yml)
wp() { MSYS_NO_PATHCONV=1 "${compose[@]}" run --rm -T cli wp "$@" 2>&1 | grep -v -E 'Container|^\s*$' || true; }
cleanup() { "${compose[@]}" down -v --remove-orphans >/dev/null 2>&1 || true; }
trap cleanup EXIT

cleanup
"${compose[@]}" up -d --wait >/dev/null 2>&1
wp core install --url=http://localhost:8120 --title="Handoff test" --admin_user=handoff \
	--admin_password="handoff-$RANDOM-$RANDOM" --admin_email=handoff@example.test --skip-email >/dev/null
wp rewrite structure '/%postname%/' --hard >/dev/null
wp plugin install /dist/osous-site.zip --activate >/dev/null
wp theme install /dist/osous.zip --activate >/dev/null
curl -s -o /dev/null http://localhost:8120/   # the first visit after activation installs the pages

pages="$(wp post list --post_type=page --meta_key=_osous_content_key --format=count)"
front="$(wp option get show_on_front)"
[ "$pages" = "66" ] && [ "$front" = "page" ] || { echo "pages installed: $pages, front page: $front"; exit 1; }

python tools/verify_dom.py --base http://localhost:8120 | tail -1
log="$("${compose[@]}" exec -T wordpress sh -c 'cat /var/www/html/wp-content/debug.log 2>/dev/null || true')"
[ -z "$log" ] || { printf '%s\n' "$log"; exit 1; }

echo "The package installs and the site it makes matches the reference."
