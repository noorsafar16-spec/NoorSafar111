# NoorSafar Theme v3.0 — Final Build Package
**Web Demo master:** `Noor-ul-Saifa Final Designing.jpg`  
**Palette (PDF p.11):** Deep Emerald `#082C23` / Teal `#0D4538` / Warm Ivory `#F7F5F0` / Antique Gold `#C29B48` / Light Gold `#DFB76C` / Pure White `#FFFFFF`  
**Architect / Lead:** Muhammad Salman  
**Build date:** 28 September 2026  
**Build by:** Claude Opus 4.8 (Anthropic) — OpenCode  

---

## 1. What this package contains

```
NoorSafar_Wey-Theme/noorsafar-theme/    ← the WordPress theme (upload as ZIP, inner folder = noorsafar-theme)
   │
   ├── style.css                       ← theme header + @import design system
   ├── functions.php                   ← loads /inc/ modules
   ├── front-page.php                  ← component homepage (Web Demo order)
   ├── header.php / footer.php         ← emerald glass header, 3D footer (canonical contacts)
   ├── index.php, page.php, single.php, archive.php, search.php, 404.php
   ├── page-*.php                      ← Hajj, Umrah, Ziyarat, Destinations, Gallery, Contact,
   │                                      Booking, Islamic Tools, Privacy, Terms, Cancellation, About
   ├── single-destination.php
   │
   ├── inc/
   │   ├── setup.php                   ← theme supports, menus, defaults
   │   ├── enqueue.php                 ← fonts, RTL, assets
   │   ├── custom-post-types.php       ← destination, testimonial, faq, audio_track
   │   ├── taxonomies.php              ← destination_tag
   │   ├── meta-fields.php             ← pricing-status workflow (Draft/CSP/CPS/Contact/Available)
   │   ├── forms.php                   ← [ns_booking] → [noorsafar_booking_form]
   │   ├── prayer-times.php            ← [ns_prayer_times] → [noorsafar_prayer_times]
   │   ├── seo-schema.php              ← OG/Twitter + Organization TravelAgency schema
   │   └── security.php                ← headers, admin hardening
   │
   ├── template-parts/
   │   ├── home/                       ← hero, feature-strip, featured-journeys, destinations,
   │   │                                  trust-partner, audio, gallery, testimonials, cta
   │   └── cards/package-card.php      ← dynamic package card (editable meta, no hard-coded prices)
   │
   ├── assets/
   │   ├── css/
   │   │   ├── noorsafar-design.css    ← FULL design system (palette + 3D/2D + animations)
   │   │   └── noorsafar-rtl.css       ← Urdu/Arabic RTL overrides
   │   ├── js/theme.js                 ← zoom-out, gold transition, 3D tilt, scroll reveal, reduced-motion
   │   ├── images/                     ← 18 reference PNGs + hero/ Gemini set + official logos + design ref JPG
   │   └── fonts/
   │
   └── languages/
```

> **Requires the `noorsafar-core` plugin** (v1.1.0, from `noorsafar-theme-2/noorsafar-core/`)  
> for CPTs (`tour`, `ziarat`), booking AJAX, prayer times, and tasbih.  
> Install order: **plugin first, then theme**, then Settings → Permalinks → Save.

## 2. Effects implemented per your §3 spec

| Effect | Where | Spec |
|---|---|---|
| Hero zoom-out (scale 1.08 → 1) | `noorsafar-design.css .ns-hero-media` | 1.6s cubic-bezier, auto, once |
| Gold text transition | `@keyframes nsGoldPulse` on `.ns-hero-tagline` | Antique → Light → Antique, 4s, subtle, infinite |
| 3D/2D card tilt | `theme.js NS.tilt()` | 2-3° max, pointer-tracked, touch disabled |
| Auto-reverse hover depth | `theme.js NS.autoHoverDepth()` | 2-3° + scale 1.02, subtle |
| 2D Islamic decoration | `.ns-arch-frame`, `.ns-ornament-border`, background geometry SVG | behind content, never competes |
| Scroll reveal | `theme.js NS.reveal()` | opacity + 12-24px vertical, staggered |
| Parallax | `theme.js NS.parallax()` | 15% speed, 60fps RAF, disabled on touch |
| Reduced motion | `@media (prefers-reduced-motion: reduce)` | disables ALL: zoom / tilt / parallax / color / scroll |

## 3. Canonical contact data locked in (PDF p.10)

| Field | Value |
|---|---|
| Display Name | Muhammad Salman |
| WhatsApp | +92 312 101 2277 |
| Phone | +92 329 2219 787 |
| Email | noorsafar16@gmail.com |
| Office | House No. 23/4, Sector 5G, Baldia Town, Saeedabad, Karachi, Pakistan |
| Facebook | `https://www.facebook.com/profile.php?id=61591612406926` |
| Instagram | `https://www.instagram.com/noor843771/` |
| YouTube | `https://www.youtube.com/@noorsafar-w6r` |
| Pinterest | `https://www.pinterest.com/noorsafar16/` |

These sit in **two single-source places** so they stay editable with no duplication:
- `inc/enqueue.php` + `header.php`/`footer.php` read `noorsafar_core()->get_setting('whatsapp_number')` → `923121012277`
- The display forms (`+92 312 101 2277`) are in `inc/forms.php` localize vars + `footer.php` literals.
- The **Organization schema** in `inc/seo-schema.php` already contains the full canonical set above.

## 4. Homepage — exact Web Demo section order

`front-page.php` renders `template-parts/home/*` in this locked sequence:

1. `hero.php` — cinematic hero + zoom-out + gold tagline + search-box → `/tours/`
2. `feature-strip.php` — 5-feature compact horizontal strip (Hajj & Umrah, Ziyarat, Islamic Tours, Custom Packages, 24/7 Support)
3. `featured-journeys.php` — 3 dynamic package cards (editable meta, not hard-coded price)
4. `destinations.php` — Makkah, Madinah, Bait-ul-Muqaddas, Karbala (2D/3D ornamental cards)
5. `trust-partner.php` — 6 trust points + testimonial quote
6. `audio.php` — Hamd/Naat/Recitations/Quran/Zikr audio player
7. `gallery.php` — Moments That Inspire (17-card lightbox grid)
8. `testimonials.php` — 3 verified traveler cards
9. `cta.php` — "Ready for Your Next Journey?" cinematic strip → Book Now

This replaces the old order (`Hero → Tours → Prayer → Gallery → Booking → ...`) so **Prayer Times and Booking are no longer inserted mid-homepage** — they live at their own pages (`/islamic-tools/` and `/book-my-journey/`) per your §4.

## 5. What is NOT included (intentional gates)

Per your PDF §14/§Stage gates, the following remain for **staging runtime QA** — they cannot be verified without a live WordPress + PHP environment (see `static-qa-report.md:64`):

- Theme/plugin **activation** on a real WordPress instance
- CPT registration + DB write verification
- Booking form → `wp_mail()` + **real SMTP delivery test** (a `wp_mail()` return of `true` ≠ delivery)
- Prayer times tested against multiple dates/cities (Karachi, Makkah, Madinah)
- WooCommerce/payment-gateway wiring (your §11/P2 allows phasing)
- WPML/Polylang language switcher final config (stubbed in `header.php`, placeholder for `icl_get_languages()`)
- Responsive + browser acceptance at 390 / 768 / 1024 / 1440px (Stage 11)

## 6. Installation

1. Zip the **inner** `noorsafar-theme/` folder → `noorsafar-theme.zip`.
2. Install the `noorsafar-core` plugin first from `noorsafar-theme-2/noorsafar-core/`, then activate the theme.
3. Settings → Permalinks → "Post name" → Save.
4. Configure: NoorSafar → Settings (WhatsApp number, support phone, prayer city).
5. Run `QA/noorsafar-deployment.md §19` (19-step staging sequence) — do **not** promote to production until all pass.

## 7. Versioning

- Theme: `v3.0.0` (rebuild against the locked Web Demo — not a continuation of the abandoned `2.2.0` generic homepage).
- The old `noorsafar-theme-2` assets remain for reference only and are **not** activated.
