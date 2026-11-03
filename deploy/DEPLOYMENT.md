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
npm ci && npm run build
```

## 4. Environment

```bash
cp .env.production.example .env
php artisan key:generate        # sets APP_KEY
nano .env                        # set DB_*, APP_URL, MAIL_*
```

## 5. Migrate & seed

```bash
php artisan migrate --force
php artisan db:seed --force      # 129 products, 164 brands, 30 offers, FAQs, stores
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

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache 2>/dev/null || true
```

## 9. Scheduler & queue (optional)

```bash
# crontab -e
* * * * * cd /var/www/sephora && php artisan schedule:run >> /dev/null 2>&1

# queue worker (if you enable Redis queues)
php artisan queue:work --tries=3
```

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

The checkout UI presents Card / Apple Pay / Tabby / Tamara / COD exactly as designed.
`PlaceOrderService` records the chosen method and creates every order with
`payment_status = pending`. To take **live payments**, integrate the gateway
inside `App\Services\Checkout\PlaceOrderService::place()` **inside the DB
transaction, before the order is created** — call the gateway authorize/charge
API, then persist its reference and flip `payment_status` accordingly. On
webhook confirmation, update `orders.payment_status` directly (idempotently by
`order_number`). Recommended packages:

- Stripe: `composer require stripe/stripe-php` (card, Apple Pay)
- Tabby: https://docs.tabby.ai (BNPL)
- Tamara: `composer require tamara-sdk/php` (BNPL)

Webhook endpoints should validate the gateway signature, be idempotent, and be
exempted from CSRF (register them outside the `web` middleware group).

## Backup

```bash
# database
mysqldump -u sephora_app -p sephora_uae | gzip > backup_$(date +%F).sql.gz
# uploads & images
tar czf images_$(date +%F).tar.gz public/images
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
- [ ] Rotate seeder admin password on first login
- [ ] Enable HTTPS (certbot steps above)
- [ ] Configure `MAIL_*` for order confirmation emails

## Post-deploy services (required)

```bash
# Scheduler — cron entry (once per server):
* * * * * cd /var/www/sephora && php artisan schedule:run >> /dev/null 2>&1

# Queue worker — supervisor (config in OPERATIONS.md §1):
php artisan queue:work --tries=3 --backoff=60 --timeout=60
```

Order-confirmation emails, the daily abandoned-cart cleanup, and coupon
expiry all depend on these two services. Full runbook: **OPERATIONS.md**.
Architecture reference: **ARCHITECTURE.md**.
