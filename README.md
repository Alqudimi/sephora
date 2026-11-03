# SEPHORA UAE — Laravel E-Commerce (Exact Design Replica)

متجر إلكتروني كامل مبني بـ **Laravel 13** كنسخة مطابقة تماماً لتصميم Stitch AI
(33 صفحة) — جاهز للنشر في بيئة إنتاج حقيقية.

> **الحزمة الخفيفة (Lite)**: تم ضغط جميع الصور إلى **WebP بجودة عالية**
> (غير قابلة للتمييز بصرياً) — حجم الصور انخفض من ~96MB إلى ~14MB.
> الحزمة لا تتضمن `vendor/` و `node_modules/` (تُستعاد بأمر واحد — انظر أدناه).

A complete e-commerce store built with **Laravel 13**, a faithful replica of the
provided Stitch AI design pack (33 pages) — production-ready.

> **Lite package**: all images converted to high-quality **WebP** (visually
> indistinguishable) — images shrank from ~96MB to ~14MB. `vendor/` and
> `node_modules/` are not included; restore them with one command (see below).

---

## What's inside

### Exact design replica (33 pages)
Each page was converted **1:1** from the design HTML: identical layout, colors,
typography (Bodoni Moda / Manrope / Montserrat + Material Symbols), spacing,
interactions and custom JavaScript — with production wiring (real routes, forms,
CSRF, dynamic data).

### Full e-commerce functionality
- **Catalog**: 129 products, 164 brands, 12 categories — seeded from the design data
- **Product pages**: gallery, shades, ratings, reviews, related products
- **Cart** (session+DB hybrid), **wishlist**, **search**
- **Checkout**: delivery methods (standard / same-day / click&collect), UAE address
  form, free samples, gift box & message, payment methods (Card / Apple Pay /
  Tabby / Tamara / COD), **promo codes**
- **Orders**: transactional placement, atomic stock & coupon guards, order numbers,
  statuses, loyalty points (Beauty Pass), queued confirmation emails
- **Auth**: custom sign-in/register matching the design + password reset +
  login throttling
- **Account**: dashboard, orders & tracking, settings, addresses, wishlist,
  country/language
- **Admin panel** (`/admin`): dashboard with KPIs, product CRUD, order management
- **Newsletter**, **contact form**, **gift-card balance check**

### Technical
| Layer | Choice |
|---|---|
| Framework | Laravel 13 (PHP 8.3) |
| Styling | Tailwind CSS v3 (exact merged design config, compiled via Vite — no CDN) |
| DB | SQLite (dev) / MySQL 8 (production) |
| Queue | `database` driver (worker required in production) |
| Assets | 300+ images stored locally (`public/images`), optimized to WebP (q90) |
| Auth | Laravel native (custom-designed views) |
| Tests | 66 feature tests / 188 assertions (`php artisan test`) |

## Quick start (local)

```bash
composer install          # restores vendor/ (PHP dependencies)
cp .env.example .env      # .env with a ready APP_KEY is also included
php artisan key:generate  # only if you created a fresh .env
php artisan migrate --seed   # or keep the included pre-seeded database.sqlite
php artisan serve
```

> `npm install` **غير مطلوب للتشغيل** — الأصول مجمّعة مسبقاً في `public/build/`.
> تحتاج Node فقط إذا عدّلت `resources/css` أو `resources/js` (ثم `npm run build`).
>
> `npm install` is **not required to run** — assets are pre-built in
> `public/build/`. You only need Node if you edit `resources/css` or
> `resources/js` (then run `npm run build`).

**Demo accounts** (seeded):

| Role | Email | Password |
|---|---|---|
| Admin | `admin@sephora.test` | `Sephora@Admin2024` |
| Customer | `demo@sephora.test` | `Sephora@Demo2024` |

> Change/remove these in production — see `database/seeders/AdminUserSeeder.php`.

## Testing

```bash
php artisan test          # 66 tests, 188 assertions (in-memory sqlite)
vendor/bin/pint --dirty   # code style (Laravel Pint)
```

Coverage highlights: authentication (register/login/logout/throttle/password
reset), cart (add/update/remove/merge-on-login), checkout (guest + user flows,
stock atomicity, coupon redemption, confirmation access control, signed guest
links), admin authorization & CRUD, rate limits, security headers, email
pipeline, wishlist, newsletter, contact, addresses, settings cache.

## Production

See **`deploy/DEPLOYMENT.md`** for the complete guide (Nginx config included at
`deploy/nginx.conf`, `.env.production.example` provided). Architecture:
**`ARCHITECTURE.md`**. Operations runbook: **`OPERATIONS.md`**.

```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --force --seed
php artisan config:cache && php artisan route:cache && php artisan view:cache
php artisan queue:work --tries=3 --backoff=60 &   # or supervisor (OPERATIONS.md §1)
# npm not needed on the server: public/build/ is already compiled.
```

## Structure highlights

```
app/
├── Http/Controllers/          # Page, Category, Product, Brand, Cart, Wishlist,
│   ├── Auth/                  #   Checkout, Search, Account, Newsletter + Admin/
│   └── Admin/
├── Http/Middleware/           # AdminMiddleware, ShareCartCount, SecurityHeaders
├── Http/Requests/             # CheckoutRequest (conditional validation)
├── Services/Checkout/         # PlaceOrderService (transactional core)
├── Events/ + Listeners/       # OrderPlaced → queued confirmation email
├── Mail/                      # OrderConfirmationMail, AdminNewOrderAlert
└── Models/                    # Product, Brand, Category, Order, Cart, ... (19)
database/seeders/ShopSeeder.php   # 129 products / brands / FAQs / stores / offers
resources/views/
├── layouts/app.blade.php      # Fonts + Vite + Material Symbols
├── pages/  shop/  auth/  account/  admin/  emails/  errors/  components/
public/images/                 # products, content, hero assets (WebP)
deploy/                        # nginx.conf + DEPLOYMENT.md
```

## Payment integration

Checkout records the selected method and creates orders with
`payment_status = pending`. To activate live payments, wire the gateway inside
`App\Services\Checkout\PlaceOrderService::place()` (documented in
`deploy/DEPLOYMENT.md` §Payment gateways) — Stripe / Tabby / Tamara SDKs are
referenced there.

## License
Project delivered for the client's own use. Sephora is a trademark of LVMH —
this build is a design replica for demonstration/internal purposes.
