# OPERATIONS — SEPHORA UAE (Laravel)

Day-to-day running, monitoring, and emergency procedures.

## 1. Processes to run

| Process | Command | Notes |
|---|---|---|
| App | nginx + PHP-FPM (`www-data`) | see `deploy/nginx.conf` |
| Queue worker | `php artisan queue:work --tries=3 --backoff=60 --timeout=60` | supervisor config below |
| Scheduler | `php artisan schedule:run` | cron entry, every minute |

### Supervisor (queue worker)

```ini
[program:sephora-queue]
command=php /var/www/sephora/artisan queue:work --tries=3 --backoff=60 --timeout=60 --sleep=1
numprocs=1
autostart=true
autorestart=true
stopwaitsecs=30
user=www-data
redirect_stderr=true
stdout_logfile=/var/www/sephora/storage/logs/worker.log
stopasgroup=true
killasgroup=true
```

After **every deploy**: `php artisan queue:restart` (gracefully restarts workers).

### Cron

```
* * * * * cd /var/www/sephora && php artisan schedule:run >> /dev/null 2>&1
```

## 2. Scheduled tasks (routes/console.php)

| Task | Schedule | What it does |
|---|---|---|
| `shop-housekeeping` | daily 03:00 | deletes guest carts idle > 30 days; deactivates expired coupons |
| `sitemap-refresh` | daily 03:10 | rebuilds the sitemap cache |
| `queue:prune-batches` | daily | trims old batch records |

List them any time: `php artisan schedule:list`.

## 3. Monitoring & health

- **Liveness**: `GET /up` → 200 (used by load balancers / uptime checks).
- **Launch/health audit**: `php artisan app:production-check` — environment,
  HTTPS, DB, storage, queue, mail, payments, seeder accounts, runtime.
  `--strict` fails on warnings too (CI-friendly exit codes).
- **Logs**: `storage/logs/laravel.log` — watch `production.ERROR` entries.
  Never log passwords or tokens (verified: none are logged).
- **Failed jobs**: `php artisan queue:failed` → retry with `queue:retry {uuid|all}`,
  inspect with `queue:failed --max=50`. Investigate the matching stack trace in the log.
- **Queue backlog**: `SELECT COUNT(*) FROM jobs;` — a growing number means the
  worker is down or slow.

## 4. Common runbook procedures

### 4.1 Order stuck as "processing" (payment callback missed)
1. Admin → Orders → open the order.
2. Set `payment_status` = `paid`/`failed` and `status` appropriately from the dropdown (audited via updated_at).

### 4.2 Customer cannot log in
1. Confirm the account exists (Admin → dashboard → customers count, or tinker).
2. After 5 failed attempts the pair email+IP is locked for 1 minute — wait it out.
3. Password reset: direct them to `/forgot-password` (links expire per Laravel default).

### 4.3 Coupon abuse suspected
1. `SELECT * FROM coupons WHERE code = 'CODE';` — check `used_count` vs `usage_limit`.
2. Emergency stop: set `is_active = 0` in admin/DB. Applied sessions are re-validated at order placement, so abuse stops immediately.

### 4.4 Product oversold report
Stock decrements are atomic (`WHERE stock >= qty`) — overselling should be
impossible. If reported anyway: check `order_items` vs `products.stock` for the
SKU and reconcile manually; investigate `storage/logs/laravel.log` for
`InsufficientStockException` bursts.

### 4.5 Rotate APP_KEY
Rotating invalidates encrypted cookies/sessions (users get logged out once) —
do it in a maintenance window: update `.env`, then `php artisan config:cache`.

## 5. Backups

### What to back up
| Asset | Location | Frequency |
|---|---|---|
| Database | MySQL dump (or `database/database.sqlite`) | daily, keep 14 |
| `.env` | project root | on change |
| `public/images` | static assets | on release |
| `storage/logs` | optional | weekly |

### Backup & restore (MySQL)

Daily backups are automated by `deploy/backup.sh` (cron it at 02:00):
DB dump + `.env` + uploaded media, gzipped into `storage/backups/<timestamp>/`
with N-day rotation (`BACKUP_RETENTION_DAYS=30 ./deploy/backup.sh`).

```bash
# Backup
mysqldump --single-transaction --routines sephora | gzip > backup-$(date +%F).sql.gz

# Restore into a fresh database, then verify
gunzip < backup-2026-11-03.sql.gz | mysql sephora_restore
mysql sephora_restore -e "SELECT COUNT(*) FROM orders; SELECT COUNT(*) FROM order_items;"
php artisan migrate:status   # inside a copy pointed at the restored DB
```

**Verification is mandatory**: row counts, a spot-check order with its items,
and `migrate:status` must all pass before a backup is trusted. Practice the
restore quarterly.

## 6. Deployments

See `DEPLOYMENT.md`. One command: `./deploy/deploy.sh`
(backup → composer --no-dev → migrate --force → storage:link → caches →
queue:restart → `/up` health check). Add `--with-maintenance` for risky
migrations, `--skip-backup` to skip the pre-deploy snapshot.

Rollback: `git checkout <previous-tag>` + `composer install` + restore the
database dump taken pre-deploy (migrations are additive-first; see DEPLOYMENT.md).

## 7. Emergency: take the site offline

```bash
php artisan down --secret="maaintenance-token-xyz"
# recover with the secret URL /maaintenance-token-xyz, or:
php artisan up
```
