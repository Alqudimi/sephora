# ARCHITECTURE — SEPHORA UAE (Laravel)

## 1. Overview

A monolithic Laravel 13 e-commerce application (PHP 8.3) that replicates the
provided Stitch AI design pack 1:1 (33 pages) with real, production-wired
functionality: catalog, cart, checkout, orders, auth, account area, and an
admin panel.

- **Rendering**: server-side Blade, Tailwind CSS v3 (pre-compiled via Vite in `public/build/`).
- **Database**: SQLite (dev/demo) / MySQL 8 (production).
- **Queue**: `database` driver (jobs + failed_jobs tables) — no external service required; Redis supported by config.
- **Session**: `database` driver.
- **Cache**: `database` driver (switchable to Redis/Memcached).

## 2. Folder Structure (key parts)

```
app/
├── Events/OrderPlaced.php                # fired after a successful checkout
├── Listeners/SendOrderConfirmation.php   # queued: customer email + admin alert
├── Mail/
│   ├── OrderConfirmationMail.php         # customer-facing confirmation (queued)
│   └── AdminNewOrderAlert.php            # optional admin notification (queued)
├── Http/
│   ├── Controllers/
│   │   ├── Auth/                          # Login (throttled), Register, PasswordReset
│   │   ├── Admin/                         # Dashboard, Products CRUD, Orders
│   │   └── ...                            # Pages, Category, Product, Brand, Cart,
│   │                                      # Checkout, Search, Wishlist, Newsletter, Account
│   ├── Middleware/
│   │   ├── AdminMiddleware.php            # 403 for non-admins
│   │   ├── SecurityHeaders.php            # CSP, nosniff, frame-options, referrer-policy
│   │   └── ShareCartCount.php             # one aggregate query, shares bag count
│   └── Requests/CheckoutRequest.php       # full checkout validation (conditional rules)
├── Models/                                # 19 Eloquent models
├── Providers/
│   ├── AppServiceProvider.php             # named rate limiters (login/forms/cart/checkout)
│   └── EventServiceProvider.php           # OrderPlaced → SendOrderConfirmation
└── Services/Checkout/
    ├── PlaceOrderService.php              # transactional order placement (see §5)
    └── InsufficientStockException.php

database/
├── migrations/                            # 9 migration groups, re-runnable from zero
└── seeders/ShopSeeder.php                 # 129 products, brands, categories, FAQs, stores, offers

resources/views/                           # 60 Blade views (design replica)
├── auth/ (sign-in, register, passwords/)  # login, registration, forgot/reset
├── emails/                                # order confirmation + admin alert templates
├── errors/ (403 404 419 500 503)          # branded error pages
├── shop/ pages/ account/ admin/ components/
routes/web.php                             # all routes (throttled where sensitive)
```

## 3. Request Lifecycle

```
HTTP → StartSession → CSRF → (auth) → ShareCartCount → SecurityHeaders →
       route middleware (throttle:login|forms|cart|checkout, admin) →
       Controller → Form Request validation → Service/Model → Blade response
```

- Every web response carries the security headers (§7).
- `ShareCartCount` performs a single `SUM(quantity)` query (no product relations loaded).

## 4. Database Schema (19 tables)

Core commerce:
- `products` (indexed `is_active+is_bestseller`, `is_active+is_new`, `name`; FULLTEXT on MySQL) → `product_images`, `product_shades`, `category_product` (unique composite), `reviews`, `wishlist_items` (unique `user_id+product_id`)
- `brands`, `categories` (self-referencing parent_id)
- `orders` (unique `order_number`; indexed `user_id+status`) → `order_items` (price/name snapshot per line)
- `carts` (unique `session_id`) → `cart_items` (unique `cart_id+product_id+shade_name`)
- `coupons` (unique code, usage_limit/used_count), `settings` (key/value, cached), `addresses`, `users` (+ profile/loyalty columns via the addresses migration)
- Support: `faqs`, `stores`, `offers`, `newsletter_subscribers`, `contact_messages`
- Infrastructure: `sessions`, `cache`, `jobs`, `failed_jobs`, `password_reset_tokens`

All foreign keys use explicit `constrained()` with cascade/null delete rules —
no orphan records possible.

## 5. Order Placement (critical path)

`CheckoutController::placeOrder` → `PlaceOrderService::place()`:

1. Single **DB transaction** wraps everything below.
2. **Coupon redemption is atomic**: `used_count` is incremented via a guarded
   `UPDATE ... WHERE used_count < usage_limit` (no overspend of limits under
   concurrency); invalid coupons are dropped, not fatal.
3. **Stock decrement is atomic**: per item `UPDATE products SET stock = stock - q
   WHERE id = ? AND stock >= q`; zero rows affected → `InsufficientStockException`
   → whole transaction rolls back → customer is sent back to the cart.
4. **Order number** `AE-yymmdd-XXXXXX` generated with a retry loop against the
   unique index.
5. Order + items written (name/price snapshots), loyalty points awarded,
   cart emptied, applied coupon cleared — all inside the same transaction.
6. After commit: `OrderPlaced` event → queued `SendOrderConfirmation` listener →
   `OrderConfirmationMail` to the customer (with a 30-day **signed** guest
   tracking URL) and optional `AdminNewOrderAlert` (see `settings.admin_notify_email`).
7. `payment_status` is always created as `pending`; card/Apple Pay/Tabby/Tamara
   require the gateway integration point (documented) to flip it to `paid`.

## 6. Background Processing

- **Jobs table** (database driver). Multi-worker processes with strict queue prioritization:
  `php artisan queue:work --queue=payments,emails,default,low --tries=3 --backoff=30 --timeout=60 --memory=256`
  (or via `php artisan app:queue-work --workers=4`).
- **Dedicated Queue Jobs**:
  - `ProcessPaymentWebhookJob` (`payments` queue, 5 retries, exponential backoff) — processes async gateway notifications.
  - `SendContactAlertJob` (`emails` queue, 3 retries) — notifies staff of client inquiries.
  - `SendNewsletterWelcomeJob` (`emails` queue, 3 retries) — delivers welcome discount codes.
  - `CancelUnpaidOrdersJob` (`default` queue) — releases stock from expired checkouts.
  - `PruneAbandonedCartsJob` (`low` queue) — clears guest carts >30 days.
  - `WarmSystemCacheJob` (`low` queue) — pre-caches sitemap and top catalog queries.
- `SendOrderConfirmation` listener (`emails` queue) with `tries=3, backoff=60s`.
- Failed jobs land in `failed_jobs` (retry via CLI or Admin Panel at `/admin/failed-jobs`).
- Scheduled tasks (see `routes/console.php`):
  - `shop-housekeeping` daily 03:00 — deletes guest carts idle >30 days, deactivates expired coupons.
  - `system-cache-warm` daily 03:10 — invalidates and warms sitemap and database planner.
  - `cancel-abandoned-pending` hourly — cancels pending orders > 48h and restocks inventory.
  - `queue:prune-batches` daily & `queue:prune-failed` weekly.

## 7. Security Model

| Concern | Implementation |
|---|---|
| Auth | Laravel native sessions; custom designed views |
| Brute force | Named limiter `login`: 5/min per IP+email + 30/h per IP; manual `RateLimiter` lockout in controller |
| Form abuse | `throttle:forms` (6/min) on newsletter, contact, coupon, register, password reset |
| Order spam | `throttle:checkout` (10/h per IP) |
| IDOR | Orders scoped by `user_id`; guest confirmations only via session that placed the order or a signed URL |
| CSRF | Laravel `VerifyCsrfToken` (all POSTs, incl. JSON fetches via X-CSRF-TOKEN) |
| XSS | Blade `{{ }}` escaping everywhere (no `{!! !!}` in views) |
| Mass assignment | Explicit `$fillable` / PHP attributes on all models |
| Headers | `SecurityHeaders` middleware: CSP (self + Google Fonts + inline styles/scripts), `X-Frame-Options SAMEORIGIN`, `nosniff`, `Referrer-Policy`, `Permissions-Policy` |
| Secrets | Only in `.env` (never committed); `.env.example` documents every variable |
| Admin | `AdminMiddleware` 403 for non-admins; routes grouped behind `auth`+`admin` |

## 8. Caching Strategy

| What | Key / Driver | Invalidation |
|---|---|---|
| Settings | `settings.all` (rememberForever) | `Setting::set()`, model `saved`/`deleted` hooks |
| Sitemap | `sitemap.xml` (60 min) | daily schedule + `Cache::forget` |

Deliberately minimal: catalog queries are already fast at this dataset size;
adding query caching would complicate invalidation without measurable benefit.

## 9. Design Decisions

- **Service layer only where it pays** — `PlaceOrderService` isolates the
  transactional core; simple CRUD stays in controllers (KISS).
- **Blade-only frontend** — matches the design pack; no SPA complexity.
- **Payment Gateways** — Live production-ready integrations with Stripe, ZainCash (v1 & v2 with JWT HS256), Tabby BNPL (API v2), and Tamara BNPL (API v3). All gateway webhooks verify cryptographic signatures and execute idempotently via queued jobs.
- **Gift Cards Module** — Full database-backed gift card issuance and validation with 16-digit codes, secure PIN hashing, real-time balance check (`/gift-cards/balance`), and atomic balance deduction on checkout with concurrency locks.
- **Couriers & Live Tracking** — First-class courier support (Aramex, DHL, FedEx, SMSA, Emirates Post, Fetchr) generating direct tracking URLs in customer order views, shipment emails, and customer VAT tax invoices.
- **Address prefill** — logged-in users see their saved address; guests see
  placeholders (never fake data that could be submitted by accident).
