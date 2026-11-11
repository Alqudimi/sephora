# Implementation Plan: Complete storefront localization

## Overview
Complete the existing English/Arabic foundation so every HTML page can be viewed using the user's selected language. Existing Laravel translation files, locale persistence, RTL layout, and the one-click switch remain the source of truth.

## Architecture Decisions
- Keep locale selection in `SetLocale` and persist it in session, cookie, and authenticated user profile.
- Reuse existing `resources/lang/en` and `resources/lang/ar` values as the only source of user-facing copy.
- Add shared `ui` translation keys and migrate legacy Blade literals to explicit `__()` calls, so translation happens before rendering and is safe for HTML, JSON, and cached views.
- Keep RTL behavior at the document level (`html[dir="rtl"]`) and use logical CSS utilities already present in the project.

## Task List

### Phase 1: Foundation
- [ ] Add shared UI keys to `resources/lang/en/ui.php` and `resources/lang/ar/ui.php`.
- [ ] Migrate repeated storefront, account, authentication, error, and admin labels to `__()` calls.
- [ ] Keep locale resolution and RTL behavior in the existing middleware/layout foundation.

### Checkpoint: Foundation
- [ ] Locale persistence tests remain valid.
- [ ] English responses are unchanged.
- [ ] Arabic responses translate migrated static-page headings and shared controls.

### Phase 2: Verification
- [ ] Add feature tests for Arabic static-page rendering and non-HTML response safety.
- [ ] Build frontend assets and run available static checks.
- [ ] Review diff for accidental `.env` or generated artifact changes.

## Risks and Mitigations
| Risk | Impact | Mitigation |
|---|---|---|
| Legacy Blade literals are not all migrated to translation calls | Medium | Shared UI keys cover repeated labels first; page-specific editorial copy can be migrated incrementally without changing locale architecture. |
| A translation key is missing in one locale | Medium | Keep matching `en/ui.php` and `ar/ui.php` key sets and add a regression test for the catalog. |
| Arabic strings may change HTML escaping | Medium | Use escaped catalog values and preserve response encoding/headers. |

## Open Questions
- Product names, brand names, and editorial marketing copy are intentionally left unchanged unless a translated value exists; they are proper nouns or content data rather than UI chrome.
