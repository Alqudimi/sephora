# Localization completion checklist

- [x] Synchronize the working tree with the latest `sephora-admin` branch from GitHub.
- [x] Add matching shared UI keys to `resources/lang/en/ui.php` and `resources/lang/ar/ui.php`.
- [x] Migrate repeated storefront, account, error, Filament invoice, and admin labels to explicit `__()` calls.
- [x] Add regression tests for Arabic rendering and locale key parity.
- [ ] Run Laravel/PHP tests when PHP and Composer dependencies are available.
- [ ] Run the frontend build after the repository's missing Tailwind plugin dependencies are restored.
- [ ] Commit and push the completed localization work to `sephora-admin`.
