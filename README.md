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
  Tabby / Tamara / ZainCash / COD / Gift Cards), **promo codes**
- **Orders**: transactional placement, atomic stock & coupon guards, order numbers,
  statuses, loyalty tier auto-progression (Beauty Pass), queued confirmation emails, customer tax invoices
- **Couriers & Live Tracking**: Aramex, DHL, FedEx, SMSA, Emirates Post, Fetchr
- **Gift Cards**: Real 16-digit cards with secure PIN, balance inquiries, and checkout redemption
- **Auth**: custom sign-in/register matching the design + password reset +
  login throttling
- **Account**: dashboard, orders & tracking, tax invoices, settings, addresses, wishlist,
  country/language
- **Admin panel** (`/admin`): full **Filament v5 + Livewire v4** control centre —
  see “Admin panel” below
- **Newsletter**, **contact form**, **gift-card balance lookup**

### Technical
| Layer | Choice |
|---|---|
| Framework | Laravel 13 (PHP 8.3) + **Filament v5 / Livewire v4** admin panel |
| Styling | Tailwind CSS v3 (exact merged design config, compiled via Vite — no CDN) |
| DB | SQLite (dev) / MySQL 8 (production) |
| Queue | Multi-queue prioritization (`payments`, `emails`, `default`, `low`) + Worker Supervisor |
| Assets | 300+ images stored locally (`public/images`), optimized to WebP (q90) |
| Auth | Laravel native (custom-designed views) + enforced 2FA for staff |
| Tests | 288 feature & unit tests / 1272 assertions (100% passing) (`php artisan test`) |

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
| Manager | `manager@sephora.test` | `Sephora@Manager2024` |
| Support | `support@sephora.test` | `Sephora@Support2024` |
| Customer | `demo@sephora.test` | `Sephora@Demo2024` |

> Staff accounts are forced through **two-factor setup** on their first visit to
> `/admin` (set up 2FA at `my-account/security`, then log in at `/admin/login`).
> Change/remove these in production — see `database/seeders/AdminUserSeeder.php`.

---

## Admin panel (Filament v5 + Livewire v4)

A complete operations centre at **`/admin`** — replacing the old custom Blade
panel. Dark mode, collapsible sidebar, full-width tables, live polling,
database notifications and global search across products, orders, customers.

### Modules

| Group | Resources & pages |
|---|---|
| Shop | Orders (state-machine workflow, UAE **tax invoices with VAT breakdown**, customer e-mails, filter-aware CSV export), Coupons (+ redemption history), Payment webhooks ledger (+ **reprocess action**) |
| Catalog | Products (images/shades/reviews managers, replication, bulk activate/hide, **bulk price adjustments**, **stock adjustment with audit trail**, settings-driven low-stock filter), Categories (product-guarded delete), Brands |
| Customers | Customers (Beauty Pass, staff-access grant, **password-reset trigger**, **marketing preferences**, **coupon redemptions**, **CSV export**), Active carts (+ **abandoned-cart filter**) |
| Engagement | Reviews (approve/reject moderation), Newsletter subscribers, Contact inbox |
| Content | Offers, FAQs, Stores |
| System | Dashboard widgets (revenue KPIs role-gated), **extended Reports** (coupons, VAT, reviews, refunds, most-wished, abandoned carts + CSV export), **expanded Store settings** (delivery fees, VAT, TRN, inventory limits, loyalty switch), **Staff accounts management** (roles, 2FA reset, force logout), **Failed-jobs console**, Audit log, Consents (GDPR) |

### Order workflow engine

Status transitions are guarded by `App\Services\Orders\OrderStateMachine`
(pending → processing → shipped → out_for_delivery → delivered, with
explicit cancel/refund paths):
- Actions only appear when the transition is legal (e.g. “Refund” only on
  delivered/cancelled orders)
- **Cancel/refund restore stock exactly once** (idempotent via `stock_restored_at`)
- Refunds validate amount ≤ order total and record a reference
- **Shipped/refunded transitions automatically e-mail the customer**
  (plus a manual “resend confirmation” action); failures never roll back the status change
- Every change writes an **audit log** row (old/new values, IP, user agent)
- Every new order also fires a **database notification to all staff** (the admin bell)

### Role-based access control

Every ability is policy-checked (`app/Policies/*` — 19 policies, zero gaps:
missing policy methods deny instead of allow):

| Ability | Support | Manager | Admin |
|---|---|---|---|
| Browse orders / products / customers / reviews | ✔ | ✔ | ✔ |
| Move orders through fulfilment, cancel | ✔ | ✔ | ✔ |
| Moderate reviews (approve/reject) | ✔ | ✔ | ✔ |
| Refund, mark payment as paid | ✖ | ✔ | ✔ |
| Catalogue, brands, categories, offers, coupons, stores, FAQs | read-only | ✔ | ✔ |
| Store settings, reports, payment webhooks | ✖ | ✔ | ✔ |
| Audit log, consents (GDPR), delete customers/orders | ✖ | ✖ | ✔ |

Extra hardening: destructive money actions re-check the policy **inside** the
action handler (not just on visibility), review moderation actions authorize
per-row and per-bulk, order line items are append-only, and the audit log is
never editable or deletable from the panel.

Staff account management (`/admin/staff`) is **admin-only**: nobody can delete
or demote their own account, and the **last remaining administrator can never
be removed**. Customer and staff resources share the `User` model, so both
route to their policies explicitly (`CustomerPolicy` / `StaffPolicy`) instead
of relying on Laravel's name-based policy discovery.

### Two-factor enforcement

`EnsureStaffTwoFactorConfirmed` middleware runs in the panel’s auth stack:
any staff member without a confirmed second factor is redirected to
`my-account/security` and cannot reach any panel page.

## Testing

```bash
php artisan test          # 224 tests, 1034 assertions (in-memory sqlite)
vendor/bin/pint --dirty   # code style (Laravel Pint)
```

Coverage highlights: authentication (register/login/logout/throttle/password
reset + full 2FA flows), cart (add/update/remove/merge-on-login), checkout
(guest + user flows, stock atomicity, coupon redemption, confirmation access
control, signed guest links), Filament admin authorization & CRUD (Livewire-level
form/table/action tests), order lifecycle (stock restore idempotency, refund
guards, audit trail, **customer e-mail notifications**), role policies for
every resource (incl. **customer/staff policy matrices**), staff management
(2FA reset, force logout, last-admin guard), product operations (**stock
adjustment + bulk repricing with audit logs**), extended reports (coupons,
VAT, reviews, refunds, wishlists, abandoned carts), settings-driven commerce
rules (shipping fees, VAT rate, loyalty switch), exports (**filter-aware
orders CSV, customer CSV, report CSV**), webhook reprocessing, failed-jobs
console, panel smoke tests for every page, rate limits, security headers,
email pipeline, wishlist, newsletter, contact, addresses, settings cache.

## Production

Everything needed for a **real launch ships in the repo** (`deploy/`):

| File | Purpose |
|---|---|
| `nginx.conf` | hardened TLS vhost (HSTS, gzip, http2, deny-dotfiles) |
| `.env.production.example` | complete production env template |
| `supervisor/sephora-queue.conf` | queue worker (supervisor) |
| `systemd/sephora-queue.service` | queue worker (systemd alternative) |
| `systemd/sephora-scheduler.{service,timer}` | scheduler without cron |
| `logrotate/sephora.conf` | log rotation |
| `deploy.sh` | one-command release (backup → migrate → caches → health check) |
| `backup.sh` | nightly DB + env + media backups with rotation |
| `DEPLOYMENT.md` | full server provisioning guide |
| `OPERATIONS.md` | runbook: monitoring, incidents, backups, rollback |
| `LAUNCH-CHECKLIST.md` | go-live day walk-through |

The launch gate:

```bash
php artisan app:go-production      # ONE command: env + HTTPS + DB + SMTP + Stripe
                                    # + staff password rotation + demo cleanup
                                    # + migrations + seeders + caches + audit
php artisan app:production-check   # audits 30+ requirements, blocks on any FAIL
```

`app:go-production` asks for the live domain, MySQL/SMTP/Stripe credentials
(secrets are never echoed), optionally rotates `APP_KEY`, replaces every
seeder staff password with a strong random one (shown once), removes the demo
customer, migrates & seeds the database, warms all optimisation caches in a
fresh PHP process and re-runs the audit. A timestamped `.env.backup-*` is
written before any change.

It verifies environment flags, HTTPS & proxy headers, MySQL, storage
permissions, queue health, SMTP, payment keys (live Stripe), seeder-account
rotation, PHP runtime and optimisation caches — with CI-friendly exit codes.

Security hardening on a live domain: app-level HTTPS 301-enforcement +
`URL::forceScheme`, HSTS on TLS responses, `TRUSTED_PROXIES` for correct
client IPs behind nginx, session cookie hardening and verified Stripe
webhook signatures. Full guide: **`deploy/DEPLOYMENT.md`**; architecture:
**`ARCHITECTURE.md`**; runbook: **`OPERATIONS.md`**.

```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --force --seed
php artisan storage:link
./deploy/deploy.sh            # or the manual cache steps below
php artisan queue:work --tries=3 --backoff=60 &   # or supervisor/systemd units
# npm not needed on the server: public/build/ is already compiled.
```

## Structure highlights

```
app/
├── Filament/                 # ★ Admin panel (Filament v5)
│   ├── Pages/                #   Dashboard, Reports, ShopSettings
│   ├── Resources/            #   16 resources (orders, products, coupons, …)
│   ├── Widgets/              #   KPI, revenue & order charts, top products, low stock
│   ├── Exports/              #   OrderCsvExport
│   └── Http/Controllers/     #   InvoiceController (printable invoices)
├── Policies/                 # ★ 19 role policies (PanelPolicy base)
├── Http/Controllers/          # Page, Category, Product, Brand, Cart, Wishlist,
│   ├── Auth/                  #   Checkout, Search, Account, Newsletter
│   └── Account/               #   (storefront)
├── Http/Middleware/           # EnsureStaffTwoFactorConfirmed, ShareCartCount, SecurityHeaders
├── Http/Requests/             # CheckoutRequest (conditional validation)
├── Services/                  # Checkout/PlaceOrderService, Orders/OrderStateMachine,
│                              # Commerce/ShippingCalculator, Auth/TwoFactorAuthenticator
├── Events/ + Listeners/       # OrderPlaced → queued confirmation email
├── Mail/                      # OrderConfirmationMail, AdminNewOrderAlert
└── Models/                    # Product, Brand, Category, Order, Cart, ... (24)
database/seeders/ShopSeeder.php     # 129 products / brands / FAQs / stores / offers
resources/views/                    # storefront + account + emails (Filament ships its own)
public/images/                      # products, content, hero assets (WebP)
deploy/                             # nginx.conf, deploy/backup.sh, systemd/supervisor
                                    # units, logrotate, DEPLOYMENT.md,
                                    # OPERATIONS.md, LAUNCH-CHECKLIST.md
```

## Payment integration

Payments are **implemented end-to-end** (`app/Services/Payments/`): Stripe
Checkout Session redirect flow, signature-verified webhooks (HMAC-SHA256 +
timestamp tolerance), idempotent event processing, COD gateway and a `fake`
driver for local/testing. Go live by setting `PAYMENTS_DRIVER=stripe`,
`STRIPE_SECRET` (live key) and `STRIPE_WEBHOOK_SECRET`, then registering
`https://your-domain.com/payments/webhook/stripe` in the Stripe dashboard —
full steps in `deploy/DEPLOYMENT.md` §Payment gateways.

## License
Project delivered for the client's own use. Sephora is a trademark of LVMH —
this build is a design replica for demonstration/internal purposes.
