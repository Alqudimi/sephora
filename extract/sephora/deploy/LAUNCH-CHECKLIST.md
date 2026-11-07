# Go-Live Checklist — SEPHORA UAE

The single page to walk through on launch day. Everything else
(DEPLOYMENT.md, OPERATIONS.md) explains the *how*; this is the *what*.

## 1. Server & infrastructure
- [ ] Ubuntu/Debian server prepared (nginx, PHP 8.3 FPM, MySQL 8, composer) — DEPLOYMENT.md §1
- [ ] DNS A/AAAA records point at the server (both apex and www)
- [ ] TLS certificates issued and auto-renewing (`sudo certbot renew --dry-run`)
- [ ] `deploy/nginx.conf` installed with your real domain (`sudo nginx -t` passes)
- [ ] PHP production tuning: OPcache on (`sudo cp deploy/php/opcache.ini /etc/php/8.3/fpm/conf.d/20-opcache.ini`), `memory_limit ≥ 256M`, `upload_max_filesize = 20M`
- [ ] Firewall: only 22/80/443 open (`ufw limit ssh && ufw allow 80,443/tcp && ufw enable`)

## 2. Application
- [ ] Code at `/var/www/sephora` (owner `www-data`, `storage/` + `bootstrap/cache` writable)
- [ ] **Fast path:** `php artisan app:go-production` — env rewrite, APP_KEY, MySQL/SMTP/Stripe credentials, staff password rotation, demo-customer removal, migrations, seeders, caches & final audit in one command
- [ ] *…or manually:* `.env` created from `.env.production.example` — every `CHANGE_ME` replaced
- [ ] `php artisan key:generate` run (or a strong 32-byte key set)
- [ ] `php artisan migrate --force` completed clean
- [ ] `php artisan db:seed --force` (catalogue data) — *optional on launch day
- [ ] `php artisan storage:link` executed (`public/storage` exists)

## 3. Background services
- [ ] Scheduler running — cron entry **or** `deploy/systemd/sephora-scheduler.timer` enabled
- [ ] Queue worker running — `deploy/supervisor/sephora-queue.conf` **or** `deploy/systemd/sephora-queue.service`
- [ ] `deploy/logrotate/sephora.conf` installed in `/etc/logrotate.d/`

## 4. Store operations
- [ ] SMTP mailbox verified (send a test: order confirmation to yourself)
- [ ] Stripe live keys + webhook secret set (`PAYMENTS_DRIVER=stripe`)
- [ ] Webhook endpoint registered: `https://your-domain.com/payments/webhook/stripe`
- [ ] Shipping fees / VAT rate / TRN set in Admin → Store settings
- [ ] Admin staff accounts created, **seeder passwords rotated**, demo customer removed
- [ ] Test order end-to-end: browse → cart → checkout → pay → confirmation email → invoice

## 5. Launch gate
```bash
php artisan app:production-check          # must show 0 failed
php artisan app:production-check --strict # recommended: 0 warnings too
curl -fsS https://your-domain.com/up      # → 200 OK
```

## 6. After launch
- [ ] `deploy/backup.sh` in cron (02:00) — first backup verified manually
- [ ] Uptime monitor watching `https://your-domain.com/up`
- [ ] Google Search Console: submit `https://your-domain.com/sitemap.xml`
- [ ] Watch `storage/logs/laravel.log` + `php artisan queue:failed` for the first 24h

Rollback plan: OPERATIONS.md §6 (previous release + pre-deploy backup).
