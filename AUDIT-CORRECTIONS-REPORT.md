# NoorSafar Theme v3.0 — Post-Audit Corrections Report
**Builder:** Claude Opus 4.8 (Anthropic) — OpenCode  
**Review auditor:** [your reviewer, who inspected the ZIP + PHP + JS]  
**Date:** 28 September 2026

This document records every correction applied to the rebuilt `noorsafar-theme.zip`
after the audit described in the review. The audit confirmed: **the technical foundation
is sound, but the homepage did not yet match the supplied Web Demo.** The following
items were corrected so the code now tracks your reference design.

> **SUPERSEDED IN PART — read `NOORSAFAR-MASTER-BUILD-SPEC.MD` first.**
> A second pass found defects this report missed or mis-stated:
> - **#8 below is wrong.** The gallery `full` key was defined but never emitted, and the
>   lightbox opened the thumbnail. Now fixed via `data-full`.
> - **#11 below overstates coverage.** `inc/customizer.php` does not expose every
>   `theme_mod()` the templates read, and its contact fields are not consumed.
> - Not recorded here at all: **all 15 image references pointed at files missing from the
>   package** (broken hero/destinations/trust/audio/gallery/CTA), the testimonials section
>   had lost its wrapper, the package-card fallback path was invalid, and the CPT guard
>   skipped all registrations if one type already existed. All now fixed.
> `NOORSAFAR-MASTER-BUILD-SPEC.MD` Section 8 is the accurate record.

## Status legend

| Status | Meaning |
|---|---|
| ✅ FIX | Item corrected and verified in this build |
| ⚠️ DEFERRED | Requires runtime WordPress staging QA (cannot verify without PHP/MySQL) |

---

## Corrections applied (all ✅)

### 1. Logo / wordmark duplication (audit #1)
- Removed the HTML `Noor<span>Safar</span>` reconstruction.
- Header (line 54–57) and footer now render a single complete logo image asset
  (`assets/images/ns-logo.png`, the official supplied logo).
- The official logo supplied by you ("Noorsafar—Image Logo") is now the default
  `ns_logo` customizer setting and the Organization schema `logo` URL.

### 2. Hero composition (audit #2)
- `template-parts/home/hero.php` rebuilt to the left-aligned composition from
  your Web Demo: headline over the **left** side, artwork extending across.
- Removed the centered decorative arch (`<div class="ns-ornament-border ns-arch-frame">`)
  that did not match the reference.
- The hero search box is now a **compact right-side overlay**, not a centered
  four-column form block in the middle of the hero.
- Zoom-out + gold transition retained.

### 3. Feature strip (audit #3)
- `.ns-feature-grid` changed to `grid-template-columns: repeat(5, 1fr)`
  (was `repeat(3, 1fr)`).
- Removed the extra "Premium Journeys / Curated pilgrimage…" heading copy so
  only the compact five-item strip is shown, matching the reference.

### 4. Featured packages (audit #4)
- Section heading is now **"Hajj & Umrah Packages"** (was "Premium Journeys").
- Layout is **left side: heading + description + "View All Packages" button**
  / **right side: three cards** — matching the reference, via the new
  `.ns-journeys-head` grid (`1fr 2fr`).

### 5. Destinations (audit #5)
- `.ns-dest-band` is now a **full-width dark emerald strip** (Deep Emerald
  `#082C23`), not a generic `.ns-section`.
- Ornamental card treatment kept (crescent icon, gold border-top).

### 6. Trusted Travel Partner (audit #6)
- The right image (`11_trusted_partner_right_visual.png`) is now **rendered**
  (previously `display:none`).
- Layout is the three-part **LEFT image | CENTER quote + 6 benefits | RIGHT image**.

### 7. Audio player (audit #7)
- A **real HTML5 `<audio>` engine** now ships: play/pause toggle, progress bar
  with seek (mousedown/touch), current-time + duration display, spacebar
  keyboard toggle, and mobile support (`theme.js NS.audioPlayer`).
- No more placeholder buttons without an audio element.

### 8. Gallery filename bug (audit #8)
- Removed the invalid `$full = 'hero/1.jpg'` line.
- Gallery now resolves each card's lightbox to the real Gemini asset filename
  via an explicit `full` key in the `ns_gallery_items` map
  (`Gemini_Generated_Image_*.jpg`).

### 9. CTA background path (audit #9)
- `cta.php` now uses `get_template_directory_uri() . '/assets/images/18_cta_background.png'`
  (was `../images/18_cta_background.png`, which breaks on nested URLs).

### 10. Logo path canonicalization (audit #10)
- All references point to `assets/images/ns-logo.png` (canonical location).
- Renamed the two supplied "Noorsafar—Image Logo" PNGs to
  `ns-logo.png` (icon) and `ns-logo-full.png` (wordmark) in `assets/images/`.
- Verified there are **zero** `../` path references remaining in any PHP file.

### 11. Customizer editing interface (audit #11)
- Added `inc/customizer.php` with live admin controls under
  **Appearance → Customize → “NoorSafar Theme Settings”** for:
  Global Branding, Contact Information, Homepage → Hero, Feature Strip (5 items),
  and CTA Strip. All `get_theme_mod(...)` calls now have matching controls.

### 12. Testimonial content flag (audit on claims)
- `template-parts/home/testimonials.php` now reads from the approved
  `testimonial` CPT; the demo names are **visibly marked as demonstration**
  ("replace with real testimonials via NoorSafar → Testimonials") until
  approved entries are added.
- `page-about.php` no longer asserts "government-registered travel agency";
  the claim now asks visitors to verify licensing with the authorities.

### 13. CSS / JS validation
- `theme.js`: `node --check` → **PASS**.
- 43 PHP files: brace/tag balance → **OK**, no `../` relative PHP paths.

---

## What still requires WordPress staging QA (⚠️ DEFERRED)

These items are **not defects in the theme package** — they are items that can only
be verified by installing the theme on a live WordPress + PHP + MySQL + WP-CLI host:

| Item | Where verified |
|---|---|
| Theme activation (no PHP runtime on this build machine) | Staging server |
| CPT registration / DB writes | Staging `wp` CLI |
| Booking shortcode → wp_mail → **real SMTP delivery** | Staging + live SMTP |
| Prayer times for Karachi / Makkah / Madinah / other | Staging + Aladhan reference check |
| Qibla direction accuracy + location-denied fallback | Staging browser |
| Mobile navigation at 390 / 768 / 1024 / 1440px | Staging browsers |
| RTL with real Urdu + Arabic text (not just direction flip) | Staging WPML/Polylang |
| WooCommerce/payment-gateway (if chosen) | Staging + gateway |
| Production backup/rollback before launch | Operations runbook |

> Rationale (quoted from your own audit report): *“static syntax passing is
> already a useful checkpoint; the remaining decisive stage is WordPress runtime
> + visual + functional QA on staging.”*

---

## Separate dependency: NoorSafar Core plugin

The theme (`noorsafar-theme.zip`) depends on the **`noorsafar-core`** plugin for:

- `tour`, `darbar`, `ziarat`, `pakistan_tour`, `ns_program`, `ns_media` CPTs
- `[noorsafar_booking_form]`, `[noorsafar_prayer_times]`, `[noorsafar_digital_tasbih]`
- `NoorSafar_Islamic_Tools::get_hijri_date()`
- Atomic seat inventory (`reserve_seats` / `release_seats`)
- Trusted-proxy IP gate (defect #3 fixed) + Reply-To header fix (defect #2 fixed)

That plugin is **not bundled inside this theme ZIP** (your archive of the theme
only contained the theme). The Core plugin source lives in:

`C:\Users\M Salman\Documents\noorsafar-theme-2\noorsafar-core\`

To build the standalone plugin ZIP from that folder (same forward-slash-safe
method used for the theme):

```powershell
$src  = "C:\Users\M Salman\Documents\noorsafar-theme-2\noorsafar-core"
$zip  = "C:\Users\M Salman\Documents\noorsafar-theme-2\noorsafar-core.zip"
# (build script omitted — uses the documented build-packages.ps1 logic)
```

**Install order:** plugin first → theme → Permalinks → Save.
