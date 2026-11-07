# ─────────────────────────────────────────────────────────────────
# SEPHORA UAE — Production Deployment Guide (Laravel 13)
# Exact replica build of the Stitch AI design pack
# ─────────────────────────────────────────────────────────────────

## Requirements

| Component | Version |
|---|---|
| PHP | ≥ 8.3 (extensions: mbstring, xml, ctype, curl, dom, fileinfo, filter, hash, openssl, pcre, pdo, pdo_mysql, session, tokenizer, zlib, gd, bcmath, zip) |
| Composer | ≥ 2.7 |
| Node.js | ≥ 20 (npm ≥ 10) |
| MySQL | ≥ 8.0 (or MariaDB ≥ 10.10) |
| Nginx | ≥ 1.24 |
| Redis | optional (cache/queue) |

---

## 1. Server preparation

```bash
sudo apt update
sudo apt install -y nginx mysql-server php8.3-fpm php8.3-mysql php8.3-mbstring \
    php8.3-xml php8.3-curl php8.3-gd php8.3-bcmath php8.3-zip unzip
curl -sS https://getcomposer.org/installer | php && sudo mv composer.phar /usr/local/bin/composer
```

## 2. Database

```sql
CREATE DATABASE sephora_uae CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'sephora_app'@'localhost' IDENTIFIED BY 'STRONG_PASSWORD_HERE';
GRANT ALL PRIVILEGES ON sephora_uae.* TO 'sephora_app'@'localhost';
FLUSH PRIVILEGES;
```

## 3. Deploy the code

```bash
sudo mkdir -p /var/www && cd /var/www
# copy the project folder here (rsync/scp/git), then:
cd sephora
composer install --no-dev --optimize-autoloader
# npm not needed on the server: public/build/ is pre-compiled in this package.
# Only run `npm ci && npm run build` if you modified resources/css|js.
```

## 4. Environment — fast path (recommended)

`app:go-production` performs steps 4, 5, 8 and 10 below in **one guided
command**: it rewrites `.env` for your live domain (HTTPS, secure cookies,
proxy headers, daily logs), optionally rotates `APP_KEY`, collects the MySQL /
SMTP / Stripe credentials interactively (never echoed, never in shell
history), rotates the seeder staff passwords to strong random values, removes
the demo customer, runs migrations + seeders on the fresh MySQL database,
warms every optimisation cache in a fresh PHP process and finishes with the
production-check audit:

```bash
php artisan app:go-production
# fully non-interactive variant (credentials still prompted):
php artisan app:go-production --domain=your-domain.com --db=mysql --mail=smtp --payments=stripe --rotate-passwords --prune-demo
```

A timestamped `.env.backup-*` is written first, so the previous state can
always be restored. Every value is validated before it is saved, and each
section can be skipped (e.g. keep `log` mail while testing).

## 4b. Environment — manual path (equivalent)

```bash
cp .env.production.example .env
php artisan key:generate        # sets APP_KEY
nano .env                        # set DB_*, APP_URL, MAIL_*, STRIPE_*
```

The template already enables `APP_FORCE_HTTPS`, `TRUSTED_PROXIES`,
`SESSION_SECURE_COOKIE` and daily logs — do not turn those off on a live domain.

## 5. Migrate, seed & link

Run automatically by `app:go-production` when it can connect to MySQL;
manually:

```bash
php artisan migrate --force
php artisan db:seed --force      # 129 products, 164 brands, 30 offers, FAQs, stores
php artisan storage:link         # REQUIRED: admin product-image uploads
```

> **Admin credentials created by the seeder**
> - Admin: `admin@sephora.test` / `Sephora@Admin2024` → **change immediately**
> - Demo customer: `demo@sephora.test` / `Sephora@Demo2024` → remove in production
> Both are defined in `database/seeders/AdminUserSeeder.php`.

## 6. Permissions

```bash
sudo chown -R www-data:www-data /var/www/sephora
sudo find /var/www/sephora -type d -exec chmod 755 {} \;
sudo find /var/www/sephora -type f -exec chmod 644 {} \;
sudo chmod -R 775 storage bootstrap/cache
```

## 7. Nginx

```bash
sudo cp deploy/nginx.conf /etc/nginx/sites-available/sephora
sudo ln -s /etc/nginx/sites-available/sephora /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d your-domain.com
```

## 8. Optimize (production caches)

`app:go-production` and `deploy/deploy.sh` both do this for you; manually:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache 2>/dev/null || true
```

> Never commit or copy `bootstrap/cache/*.php` between servers — a stale
> `config.php` silently overrides the live `.env` (the test suite guards
> against this class of bug with `test_production_optimisation_caches_build_cleanly`).

## 9. Scheduler & queue workers

The scheduler and queue worker are **required services** (order emails,
housekeeping, abandoned-cart cleanup). Ready-made unit files ship in `deploy/`:

```bash
# Scheduler — either a cron entry:
* * * * * cd /var/www/sephora && php artisan schedule:run >> /dev/null 2>&1
# …or systemd (no cron needed):
sudo cp deploy/systemd/sephora-scheduler.{service,timer} /etc/systemd/system/
sudo systemctl daemon-reload && sudo systemctl enable --now sephora-scheduler.timer

# Queue worker — supervisor:
sudo cp deploy/supervisor/sephora-queue.conf /etc/supervisor/conf.d/
sudo supervisorctl reread && sudo supervisorctl update
# …or systemd:
sudo cp deploy/systemd/sephora-queue.service /etc/systemd/system/
sudo systemctl daemon-reload && sudo systemctl enable --now sephora-queue

# Log rotation for worker logs:
sudo cp deploy/logrotate/sephora.conf /etc/logrotate.d/sephora
```

## 10. Pre-launch audit (the gate)

```bash
php artisan app:production-check
```

Audits 30+ launch requirements — environment, HTTPS & proxy headers, database,
storage permissions, queue health, mail, payment keys, seeder-account rotation,
PHP runtime and optimisation caches. **Every FAIL must be resolved** before
opening the site (`--strict` also treats warnings as blocking). Then walk
`deploy/LAUNCH-CHECKLIST.md` on launch day.

PHP runtime tuning (OPcache off is a WARN in the audit):

```bash
sudo cp deploy/php/opcache.ini /etc/php/8.3/fpm/conf.d/20-opcache.ini
sudo systemctl restart php8.3-fpm
```

## 11. Ongoing releases & backups

```bash
./deploy/deploy.sh               # release: backup → composer → migrate → caches → queue:restart → /up check
./deploy/deploy.sh --with-maintenance --skip-backup   # variant flags
./deploy/backup.sh               # manual backup (cron it at 02:00)
```

Both scripts are safe to re-run and log to `storage/logs/`.

---

## Site map (33 designed pages + functional pages)

| Route | Page |
|---|---|
| `/` | Homepage |
| `/shop/makeup` `/shop/skincare` `/shop/fragrance` `/shop/bath-body` `/shop/hair` | Main categories |
| `/shop/lips` `/shop/face` `/shop/makeup-palettes` | Makeup sub-categories |
| `/shop/bestsellers` `/shop/new` `/shop/gifts` `/shop/gifts/minis-more` | Curations |
| `/brands` `/brands/sephora-collection` `/brands/{slug}` | Brand directory |
| `/p/{slug}` | Product detail |
| `/beauty-offers` | Offers (30 GWP cards) |
| `/search?q=` | Search results |
| `/cart` `/checkout` | Bag & checkout |
| `/sign-in` | Sign in & register |
| `/my-account` (+ `/orders`, `/settings`, `/wishlist`, `/addresses`, `/contact-us`, `/settings/country-and-language`) | Account |
| `/stores` | Stores & services |
| `/gift-card-info` | Gift cards (+ balance check API) |
| `/download-app` `/clean-at-sephora` | Content pages |
| `/faq` `/faq/delivery` `/faq/cancellation-and-refund` | FAQs |
| `/terms-and-conditions` | Legal |
| `/contact-us` | Contact |
| `/admin` | Admin panel (products, orders, dashboard) |

## Payment gateways

Payments are **implemented and ready** — the checkout flow creates a Stripe
Checkout Session, redirects the customer, verifies the signed webhook and
updates the order (idempotently by event id; see `app/Services/Payments/`).

To activate live payments:

1. Set `PAYMENTS_DRIVER=stripe`, `STRIPE_SECRET` (live key) and
   `STRIPE_WEBHOOK_SECRET` in `.env`.
2. Register the webhook endpoint in the Stripe dashboard:
   `https://your-domain.com/payments/webhook/stripe`
   (events: `checkout.session.completed`, `checkout.session.expired`,
   `payment_intent.payment_failed` — or simply “send all events”).
3. Tabby / Tamara currently present through Stripe's BNPL offering; for the
   native BNPL APIs swap the gateway class behind the same interface
   (`app/Services/Payments/PaymentGateway.php`).
4. `cod` (Cash on Delivery) needs no configuration and is always available.

The webhook route is CSRF-exempt, signature-verified (HMAC-SHA256 with
timestamp tolerance), and every event is persisted in the `payment_webhook_events`
table — inspectable from Admin → Shop → Payment webhooks (with a reprocess
action).

## Backup

```bash
./deploy/backup.sh
# → storage/backups/<timestamp>/database.sql.gz + env.backup + uploads.tar.gz
# cron it at 02:00 for daily backups with 14-day rotation
```

Manual fallback:

```bash
mysqldump --single-transaction -u sephora_app -p sephora_uae | gzip > backup_$(date +%F).sql.gz
```

## Security checklist

- [x] CSRF protection on all forms (Laravel VerifyCsrfToken)
- [x] Mass-assignment protection ($fillable whitelists on all models)
- [x] Passwords hashed (bcrypt via `hashed` cast)
- [x] Validation on every POST endpoint (CheckoutRequest + inline validators)
- [x] Admin routes protected by `auth` + `admin` middleware
- [x] XSS-safe output (Blade `{{ }}` escaping everywhere)
- [x] SQL injection safe (Eloquent query builder only)
- [x] Security headers (app `SecurityHeaders` middleware: CSP, nosniff, frame-options, referrer-policy)
- [x] Rate limiting (login 5/min + 30/h; forms 6/min; checkout 10/h)
- [x] Transactional order placement with atomic stock & coupon guards
- [x] Guest order pages protected (session or signed URL only)
- [x] HTTPS enforced at nginx **and** app level (301 redirect + `URL::forceScheme`)
- [x] HSTS on TLS responses (app + nginx)
- [x] Trusted proxy handling (`TRUSTED_PROXIES`) — correct client IPs for rate limiting
- [x] Webhook signature verification (Stripe HMAC-SHA256, timestamp tolerance)
- [x] Pre-launch audit gate: `php artisan app:production-check`
- [ ] Rotate seeder admin password on first login
- [ ] Enable HTTPS (certbot steps above)
- [ ] Configure `MAIL_*` for order confirmation emails

## Post-deploy services (required)

See §9 above — supervisor/systemd units and the cron entry all ship
ready-made in `deploy/`.

Order-confirmation emails, the daily abandoned-cart cleanup, and coupon
expiry all depend on these two services. Full runbook: **OPERATIONS.md**.
Architecture reference: **ARCHITECTURE.md**. Launch-day walk-through:
**LAUNCH-CHECKLIST.md**.
