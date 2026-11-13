# Full bilingual localization checklist

- [x] Keep locale persistence, RTL layout, and the responsive header switcher working.
- [x] Audit remaining static Blade text, attributes, and multiline copy on storefront pages.
- [x] Audit JavaScript alerts, toasts, checkout messages, and client-side validation messages.
- [x] Add matching English and Arabic keys for remaining storefront, error, invoice, and report UI strings.
- [x] Replace remaining static storefront and selected admin template literals with translation calls.
- [x] Add regression coverage for key parity and rendered English/Arabic store controls.
- [x] Run static audits, `git diff --check`, and the Vite build.
- [ ] Run PHPUnit when PHP/Composer dependencies are available.
- [ ] Finish converting the remaining Filament form/action labels that are still hardcoded in PHP resources.
- [ ] Commit and push this localization pass.
