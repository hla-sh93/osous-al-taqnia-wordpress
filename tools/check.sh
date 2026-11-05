#!/usr/bin/env bash
# Runs every check, one line per check. A check passes only by its own counted sentence.
#
#   tools/check.sh           everything (the layout check takes about 15 minutes)
#   tools/check.sh --quick   everything except the browser layout check
#
# Needs: the local stack up (docker compose up -d) with the pages installed, the
# reference served on port 8110 for the layout check, and `npm install` / composer done.
set -uo pipefail
cd "$(dirname "$0")/.."

failures=0
run() {
	local label="$1"
	shift
	local output
	if output="$("$@" 2>&1)"; then
		printf 'ok    %-22s %s\n' "$label" "$(printf '%s\n' "$output" | grep -v '^\s*$' | tail -1)"
	else
		printf 'FAIL  %-22s\n%s\n' "$label" "$output"
		failures=$((failures + 1))
	fi
}

php_log_clean() {
	docker compose exec -T wordpress sh -c ': > /var/www/html/wp-content/debug.log'
	python - <<'PY'
import sys, urllib.request
sys.path.insert(0, "tools")
from common import public_pages, slug_for
urls = ["http://localhost:8100/" + (slug_for(p) + "/" if slug_for(p) else "") for p in public_pages()]
urls += ["http://localhost:8100/blog/page/2/", "http://localhost:8100/no-such-page/", "http://localhost:8100/?s=cloud"]
for url in urls:
    try:
        urllib.request.urlopen(url, timeout=60).read()
    except urllib.error.HTTPError as error:
        if error.code != 404:
            raise
print(f"{len(urls)} addresses requested")
PY
	local log
	log="$(docker compose exec -T wordpress sh -c 'cat /var/www/html/wp-content/debug.log')"
	if [ -n "$log" ]; then
		printf '%s\n' "$log"
		return 1
	fi
	echo "PHP debug log empty after every page"
}

php_standards() {
	tools/phpcs.sh -q --report=summary || return 1
	echo "$(find theme/osous -name '*.php' -not -path '*/content/*' | wc -l) PHP files, 0 errors, 0 warnings (WordPress Coding Standards)"
}
js_lint() {
	npx eslint theme/osous/assets/js --ignore-pattern "theme/osous/assets/js/vendor/**" --max-warnings 0 || return 1
	echo "$(find theme/osous/assets/js -maxdepth 1 -name '*.js' | wc -l) scripts, 0 problems (@wordpress/eslint-plugin)"
}
css_lint() {
	npx stylelint "theme/osous/assets/css/interactions.css" "theme/osous/assets/css/fonts.css" || return 1
	echo "2 hand-written stylesheets, 0 problems (@wordpress/stylelint-config)"
}
duplication() {
	local output
	output="$(npx jscpd theme/osous/inc theme/osous/template-parts theme/osous/assets/js theme/osous/assets/css/interactions.css tools --ignore "**/vendor/**,**/composer.phar" --min-lines 6 --min-tokens 60 --threshold 0 --reporters console 2>&1)" || { printf '%s\n' "$output"; return 1; }
	printf '%s\n' "$output" | grep -o 'Found [0-9]* clones'
}

run "PHP standards" php_standards
run "JS lint" js_lint
run "CSS lint" css_lint
run "duplication" duplication
run "markup vs Webflow" python tools/verify_dom.py
run "contact form" python tools/verify_contact.py
run "blog" python tools/verify_blog.py
run "security" python tools/verify_security.py
run "PHP errors" php_log_clean
if [ "${1:-}" != "--quick" ]; then
	run "interactions" python tools/verify_interactions.py
	run "layout vs Webflow" python tools/verify_layout.py
fi

echo "$failures checks failed"
exit $((failures > 0))
