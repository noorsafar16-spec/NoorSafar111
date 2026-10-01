# Why the Legacy Build Was Discontinued
**Source:** NoorSafar_Website_Design_Comprehensive_Finalization_Report.pdf (PDF §1, §2, §3, §10, §15)
+ QA/status.md / static-qa-report.md / defect-list.md in `noorsafar-theme-2/QA`

## Summary
The legacy package was discontinued because the existing `noorsafar-theme-2` was an accurate
**technical foundation**, but an **inexact visual implementation** of the supplied design, and
it had **never cleared runtime staging QA**. Development is redirected here, into
`Noor Safar-Wey-Theme`, using the Web Demo image as the locked visual master.

## Specific Reasons (verified against source)

1. Homepage did NOT reproduce the approved design
   - `front-page.php` followed: Hero → Tours → Destinations → Prayer → Gallery → Booking → Testimonials → Trust → CTA.
   - The approved visual sequence is:
     Header → Hero → Feature Strip → Packages → Destinations → Trust → Audio → Gallery → Testimonials → CTA → Footer.
   - Hard-coded demo prices lived in `front-page.php:92, 109, 126` (`PKR 385,000`, `65,000`, `95,000`).
   - These were flagged as simulated content, not the locked Web Demo.

2. Functional layers were simulated, not implemented
   - Booking form `submitForm()` prevents real submission; shows success panel only.
     (PDF §2, §3 C2)
   - Prayer times are hard-coded Karachi literals, not live Aladhan integration. (PDF §3 C3)
   - No seat-capacity enforcement, no email/SMTP/WhatsApp delivery, no admin records. (defect-list #1)

3. No editable CMS content model
   - Prices, status, dates, destinations were embedded in PHP/HTML, not in meta fields.
     (PDF §7, §8)
   - This violates "the design should look fixed, but the content must remain editable."

4. Runtime staging QA was blocked
   - `QA/status.md:34`: "Runtime staging QA: BLOCKED — no PHP/MySQL/WP-CLI on this machine."
   - `static-qa-report.md:54-62`: only static checks passed; activation, CPT, AJAX,
     cache, and browser JS were unverified.
   - `FINAL-UPLOAD/READ.txt`: "EMPTY - staging QA is PENDING. Do not upload to production."

5. No single visual master was applied
   - The homepage structure diverged from `Noor-ul-Saifa Final Designing.jpg`,
     so incremental styling could never converge on an accepted screenshot. (PDF §Stage 10)

## Why the Work Was Preserved
- `noorsafar-theme-2/noorsafar-core` already had: CPTs (tour, darbar, ziarat, pakistan_tour, ns_program, ns_media),
  shortcodes, AJAX booking w/ nonce + honeypot + rate-limit, Aladhan prayer times, tasbih, RTL support.
- `defect-list.md` already records 4 fixes **as implemented** on 2026-09-18:
  atomic seat inventory, Reply-To header fix, trusted-proxy gate, pakistan_tour bookable.
- `build-packages.ps1` produces forward-slash-correct zips (static QA PASS).

These assets remain under `noorsafar-theme-2/` as **reference only**. They are NOT copied
into the new build unless they match the locked component architecture above.

## The Correct Next Step
Per your final instruction (PDF §15, Stage 1): treat the Web Demo image as the visual master and
re-implement the **exact section order** as component-based WordPress templates under
`template-parts/home/`, with dynamic data wired to WordPress — then pass runtime staging
QA before promoting to `FINAL-UPLOAD/`.

**Date redirected: 28 September 2026**  
Author: Claude Opus 4.8 (Anthropic) — for Muhammad Salman / NoorSafar
