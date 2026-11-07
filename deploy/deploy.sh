#!/usr/bin/env bash
# ─────────────────────────────────────────────────────────────────
# SEPHORA UAE — production release script
#
#   ./deploy/deploy.sh                  # normal release (zero downtime)
#   ./deploy/deploy.sh --with-maintenance  # brief maintenance window around migrations
#   ./deploy/deploy.sh --skip-backup    # skip the pre-deploy DB backup
#
# Steps: backup → composer (no-dev) → migrate --force → storage:link →
#        warm caches → queue:restart → health check (/up).
#
# Requirements: the app is deployed at /var/www/sephora (adjust APP_DIR),
# composer + php on PATH, and either cron/systemd running the scheduler.
# ─────────────────────────────────────────────────────────────────
set -euo pipefail

APP_DIR="${APP_DIR:-/var/www/sephora}"
WITH_MAINTENANCE=0
SKIP_BACKUP=0

for arg in "$@"; do
    case "$arg" in
        --with-maintenance) WITH_MAINTENANCE=1 ;;
        --skip-backup)      SKIP_BACKUP=1 ;;
    esac
done

cd "$APP_DIR"
echo "[deploy] releasing $(date -Is) at $APP_DIR"

run() { echo "→ $*"; "$@"; }

# ── 0. Optional maintenance window ──
if [ "$WITH_MAINTENANCE" -eq 1 ]; then
    run php artisan down --render="errors::503"
fi
trap '[ "$WITH_MAINTENANCE" -eq 1 ] && php artisan up || true' EXIT

# ── 1. Pre-deploy database backup (unless skipped) ──
if [ "$SKIP_BACKUP" -eq 0 ]; then
    run ./deploy/backup.sh
fi

# ── 2. Dependencies (production, optimised autoloader) ──
run composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# ── 3. Migrations ──
run php artisan migrate --force

# ── 4. Public storage symlink (idempotent) ──
run php artisan storage:link

# ── 5. Warm the optimisation caches ──
run php artisan config:cache
run php artisan route:cache
run php artisan view:cache
run php artisan event:cache

# ── 6. Restart queue workers (finish current job, pick up new code) ──
run php artisan queue:restart

# ── 7. Health check ──
sleep 2
if curl -fsSL -L "$(grep -m1 '^APP_URL=' .env | cut -d= -f2)/up" > /dev/null; then
    echo "[deploy] health check OK — site is live ✅"
else
    echo "[deploy] WARNING: /up health check failed — check storage/logs/laravel.log" >&2
fi

echo "[deploy] finished at $(date -Is)"
