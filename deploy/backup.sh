#!/usr/bin/env bash
# ─────────────────────────────────────────────────────────────────
# SEPHORA UAE — nightly backup with rotation
#
#   ./deploy/backup.sh                     # normal run (auto-detects DB driver)
#   BACKUP_RETENTION_DAYS=30 ./deploy/backup.sh
#   BACKUP_DIR=/mnt/backups ./deploy/backup.sh
#
# Recommended: run from cron at 02:00 —
#   0 2 * * * cd /var/www/sephora && ./deploy/backup.sh >> storage/logs/backup.log 2>&1
#
# Restores are documented in OPERATIONS.md §5.
# ─────────────────────────────────────────────────────────────────
set -euo pipefail

cd "$(dirname "$0")/.."
PROJECT_DIR=$(pwd)

BACKUP_DIR="${BACKUP_DIR:-$PROJECT_DIR/storage/backups}"
RETENTION_DAYS="${BACKUP_RETENTION_DAYS:-14}"
STAMP=$(date +%F_%H%M)
TARGET="$BACKUP_DIR/$STAMP"

mkdir -p "$TARGET"

echo "[backup] $(date -Is) starting → $TARGET"

# ── 1. Database (mysqldump for MySQL, file copy for SQLite) ──
if grep -q '^DB_CONNECTION=mysql' .env; then
    DB_NAME=$(grep -m1 '^DB_DATABASE=' .env  | cut -d= -f2)
    DB_USER=$(grep -m1 '^DB_USERNAME=' .env  | cut -d= -f2)
    DB_PASS=$(grep -m1 '^DB_PASSWORD=' .env  | cut -d= -f2-)

    echo "[backup] dumping MySQL database: $DB_NAME"
    MYSQL_PWD="$DB_PASS" mysqldump --single-transaction --routines --triggers \
        -u "$DB_USER" "$DB_NAME" | gzip > "$TARGET/database.sql.gz"
else
    echo "[backup] copying SQLite database"
    # sqlite3 .backup is the online-safe path; plain cp is a fallback that
    # should only run on a quiescent DB (maintenance window / low traffic).
    if command -v sqlite3 > /dev/null; then
        sqlite3 database/database.sqlite ".backup '$TARGET/database.sqlite'"
    else
        echo "[backup] NOTE: sqlite3 CLI not found — using cp (safe on a quiescent database)"
        cp database/database.sqlite "$TARGET/database.sqlite"
    fi
    gzip -f "$TARGET/database.sqlite"
fi

# ── 2. Environment (contains secrets — keep the destination private) ──
cp .env "$TARGET/env.backup"
chmod 600 "$TARGET/env.backup"

# ── 3. User-uploaded media (product images uploaded via the admin) ──
if [ -d storage/app/public ] && [ -n "$(ls -A storage/app/public 2>/dev/null)" ]; then
    echo "[backup] archiving uploaded media"
    tar czf "$TARGET/uploads.tar.gz" -C storage/app public
fi

# ── 4. Verify: the archive must be non-empty and gunzip-parseable ──
DB_ARCHIVE=$(ls "$TARGET"/database.* | head -1)
gunzip -t "$DB_ARCHIVE"
[ -s "$DB_ARCHIVE" ] || { echo "[backup] ERROR: dump is empty — aborting"; exit 1; }
echo "[backup] verified: $(du -h "$DB_ARCHIVE" | cut -f1) $DB_ARCHIVE"

# ── 5. Rotation ──
echo "[backup] pruning backups older than $RETENTION_DAYS days"
find "$BACKUP_DIR" -maxdepth 1 -type d -name '20*' -mtime +"$RETENTION_DAYS" -exec rm -rf {} +

echo "[backup] done at $(date -Is)"
echo "[backup] latest: $(ls -1t "$BACKUP_DIR" | head -3 | tr '\n' ' ')"
