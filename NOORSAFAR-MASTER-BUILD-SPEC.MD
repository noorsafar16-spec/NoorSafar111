# NOORSAFAR - MASTER BUILD SPECIFICATION

**Single-file handoff. Everything a cloud coding agent needs to continue this build.**
Theme: `noorsafar-theme` v3.0 | Status: **Visual Reconstruction Complete - Staging Candidate - Runtime/Functional Certification Pending** | Package: `noorsafar-theme.zip` (90 entries, single root `noorsafar-theme/`, ~13.1 MB)
Source of truth folder: `C:\Users\M Salman\Documents\Noor Safar-Wey-Theme\noorsafar-theme\`
Last updated: 28 September 2026

---

## 0. READ THIS FIRST

1. This document is the authoritative handoff. `README.md` and `AUDIT-CORRECTIONS-REPORT.md` ship alongside it; where they disagree with this file, this file wins.
2. The design is defined by images. The agent MUST open and compare these before and after coding:
   - `C:\Users\M Salman\Documents\Noor-ul-Saifa Final Designing.jpg` (original homepage master)
   - `C:\Users\M Salman\Documents\the full-resolution design screenshot.pdf` (latest full-resolution design reference)
   - `C:\Users\M Salman\Downloads\New Project (2).webp` (latest redesign pass)
   - A copy of the JPG also ships at `assets/images/Design-Reference-Noor-ul-Saifa.jpg` and `assets/images/hero/Noor-ul-Saifa Final Designing.jpg`.
   Text descriptions in Section 4 are a written proxy for those images, not a replacement for looking at them.
3. Nothing in this build has been executed in WordPress. No PHP binary, MySQL, or WP-CLI exists on the build machine. Every "verified" claim below is a static check only. See Section 9.
4. Do not ship to production until Section 9 passes on staging.

---

## 1. WHAT THIS PROJECT IS

A WordPress theme for NoorSafar, a Karachi-based Islamic travel company (Hajj, Umrah, Ziyarat, Pakistan tours), plus a required companion plugin `noorsafar-core`.

Content must be editable from the WordPress admin (CPTs, meta boxes, Customizer). No hard-coded prices, no hard-coded contact strings outside the single-source settings noted in Section 3.

---

## 2. VISUAL SYSTEM (locked)

### Palette
| Token | Value | Use |
|---|---|---|
| `--ns-emerald` | `#082C23` | Deep Emerald - header, footer, dark bands |
| `--ns-emerald-2` | `#0D4538` | Teal - gradients, hover overlays |
| `--ns-gold` | `#C29B48` | Antique Gold - accents, CTA, borders |
| `--ns-gold-light` | `#DFB76C` | Light Gold - hover, badges, highlights |
| `--ns-ivory` | `#F7F5F0` | Warm Ivory - page section background |
| `--ns-white` | `#FFFFFF` | Pure White - elevated cards |

Text: `--ns-text-1: #082C23`, `--ns-text-2: #4A6B5F`, border `rgba(13,69,56,0.12)`.
Radii: `--ns-radius: 16px`, `--ns-radius-sm: 12px`.
Shadows: `--ns-shadow-sm/md/lg/xl` (see `assets/css/noorsafar-design.css` `:root`).

### Typography
- Body: Plus Jakarta Sans
- Headings: Playfair Display
- Decorative / hero tagline: Cinzel
- RTL Urdu: Noto Nastaliq Urdu
- RTL Arabic: Amiri

### Required effects
- Hero zoom-out: `scale(1.08) -> 1`, 1.6s, cubic-bezier, runs once.
- Gold tagline pulse: Antique -> Light -> Antique, 4s, subtle, infinite.
- 3D/2D card tilt: 2-3 degrees, pointer-tracked, disabled on touch.
- Auto-reverse hover depth: tilt + `scale(1.02)`, reverses on mouse-out.
- Scroll reveal: opacity + 12-24px vertical, staggered via `data-ns-delay`.
- Parallax: ~15% speed, rAF-driven, disabled on touch.
- `@media (prefers-reduced-motion: reduce)` must disable ALL of the above (zoom, tilt, parallax, color transitions, scroll reveal).

---

## 3. CANONICAL DATA (do not reword)

| Field | Value |
|---|---|
| Display name | Muhammad Salman |
| WhatsApp | +92 312 101 2277 (`923121012277` for wa.me links) |
| Phone | +92 329 2219 787 |
| Email | noorsafar16@gmail.com |
| Office | House No. 23/4, Sector 5G, Baldia Town, Saeedabad, Karachi, Pakistan |
| Facebook | https://www.facebook.com/profile.php?id=61591612406926 |
| Instagram | https://www.instagram.com/noor843771/ |
| YouTube | https://www.youtube.com/@noorsafar-w6r |
| Pinterest | https://www.pinterest.com/noorsafar16/ |

Canonical source of truth: `noorsafar_core()->get_setting('whatsapp_number' | 'support_phone' | 'admin_email')` in the plugin, mirrored into the Organization schema in `inc/seo-schema.php`.
Open issue: display-form literals still live in `inc/forms.php` and `footer.php`, and the Customizer contact fields are not wired to them. Consolidate to the plugin settings (Section 8).

### Logo - IMPORTANT DISCREPANCY
- `assets/images/ns-logo.png` (default, used by header + footer) was copied from `C:\Users\M Salman\Documents\Noorsafar-Image Logo 2.png`.
- `assets/images/ns-logo-full.png` was copied from the specifically re-sent `C:\Users\M Salman\Documents\Noorsafar-Image Logo.png`. It is NOT the default asset.
- The footer additionally renders the plain text `NoorSafar` next to the image, which may duplicate the wordmark.
Action: confirm with the owner which of the two logos is canonical, set it as the single default, and remove the duplicate text. Do not ship both.

---

## 4. HOMEPAGE - LOCKED SECTION ORDER

`front-page.php` renders `template-parts/home/*` in exactly this order. Do not reorder.

1. **Header** - `header.php`. Deep emerald. Logo left; nav Home / Journey / Destinations / Gallery / Ziyarat / Blog / Contact. Top utility bar with phone + Hijri date.
2. **Hero** - `hero.php`. Full-width sacred-travel artwork, LEFT-aligned text composition. No centered arch frame, no centered multi-column search block. Compact CTA pair bottom-left. Zoom-out + gold pulse.
3. **Five Features** - `feature-strip.php`. Tight `repeat(5, 1fr)` row: Hajj & Umrah, Ziyarat, Islamic Tours, Custom Packages, 24/7 Support. No heading paragraph above the strip.
4. **Hajj & Umrah Packages** - `featured-journeys.php`. Left: heading + supporting text + "View All Packages". Right: 3 dynamic package cards. Layout: `.ns-journeys-head` is `1fr 2fr`; `.ns-journeys-cards` is its own 3-column grid (2 columns <=1200px, 1 column <=980px). Each card: image, title, duration, destination, price tag, circular refresh-arrow hover badge.
5. **Blessed Destinations** - `destinations.php`. Full-width DARK EMERALD band. 4 ornamental cards: Makkah, Madinah, Bait-ul-Muqaddas, Karbala. Crescent icon, gold border-top, image-filled card, 3D hover.
6. **Trusted Travel Partner** - `trust-partner.php`. Emerald band. LEFT image | CENTER quote + 6 benefits in a 2x3 grid (Experienced Guides, Comfortable Stays, Safe and Secure, Personalized Service, Easy Booking, 24/7 Support) | RIGHT image.
7. **Islamic Audio** - `audio.php`. Real HTML5 player. Tracks: Quran Recitation, Naat & Hamd, Spiritual Talks, Zikr & Duas. Controls: play/pause, seekable progress, current time + duration.
8. **Gallery** - `gallery.php`. "Moments That Inspire". 5 items. Thumbnail PNG, high-res `assets/images/hero/Gemini_Generated_Image_*.jpg` in the lightbox.
9. **Testimonials** - `testimonials.php`. "What Our Travelers Say". 3 cards: quote, name, rating stars, journey label. Demo content is visibly marked until approved entries exist in the `testimonial` CPT.
10. **CTA** - `cta.php`. "Ready for Your Next Journey?" on a cinematic dark background. Single gold "Book Now" button.
11. **Footer** - `footer.php`. Deep emerald, 4 columns: brand, Pilgrimages, Destinations, Contact. Full canonical contact set, social links, Privacy / Terms / Cancellation, floating WhatsApp button.

Prayer Times and Booking are NOT on the homepage. They live at their own pages (`/islamic-tools/`, `/book-my-journey/`).

### Other pages
`page-about.php`, `page-hajj.php`, `page-umrah.php`, `page-ziarat.php`, `page-destinations.php`, `page-gallery.php`, `page-contact.php`, `page-booking.php`, `page-islamic-tools.php`, `page-privacy.php`, `page-terms.php`, `page-cancellation.php`, `single-destination.php`, plus `index/archive/search/single/404`.

---

## 5. ASSETS

### Originals now correctly installed
The 18 original supplied reference PNGs live in `assets/images/` under their ORIGINAL names, because every template references those names:
`02_hero_visual.png`, `06_destination_makkah.png`, `07_destination_madinah.png`, `08_destination_jerusalem.png`, `09_destination_karbala.png`, `10_trusted_partner_left_visual.png`, `11_trusted_partner_right_visual.png`, `12_audio_thumbnail.png`, `13_gallery_kaaba.png`, `14_gallery_madinah.png`, `15_gallery_desert.png`, `16_gallery_architecture.png`, `17_gallery_mosque.png`, `18_cta_background.png` (and the remaining 01/03/04/05 originals).
Backups of the originals live in `C:\Users\M Salman\Documents\noorsafar-images\`.

Clean-named aliases also exist in the same folder (`hero.png`, `dest-makkah.png`, `gallery-1..5.png`, `partner-left/right.png`, `audio-thumb.png`, `cta-bg.png`, `ns-logo.png`, `ns-logo-full.png`, `header-logo.png`). They are unused duplicates - delete them at cleanup time to avoid confusion, OR migrate every template to the clean names in one pass. Do not leave both conventions live.

### High-resolution gallery set
`assets/images/hero/` holds 17 `Gemini_Generated_Image_*.jpg` files (516-798 KB each) used as lightbox sources, plus `logo-1.png`, `logo-2.png`, and the design-reference JPG.

### Audio media - NOT SUPPLIED
`audio.php` points at `/wp-content/uploads/audio/{quran-fatiha,naat-hamd,talk,zikr}.mp3`. Those files do not exist. The player renders and functions, but nothing plays until the owner uploads real audio. Decide: upload real files, or ship the section hidden.

---

## 6. ARCHITECTURE

```
noorsafar-theme/
  style.css                     theme header + @import of the design system
  functions.php                 loads /inc modules
  front-page.php                component homepage (Section 4 order)
  header.php / footer.php
  index.php page.php single.php archive.php search.php 404.php
  page-*.php                    About, Hajj, Umrah, Ziarat, Destinations, Gallery,
                                Contact, Booking, Islamic Tools, Privacy, Terms, Cancellation
  single-destination.php
  inc/
    setup.php                   theme supports, menus, defaults
    enqueue.php                 fonts, RTL, assets
    custom-post-types.php       destination, urs_event, hajj, umrah, testimonial, guide, faq, audio_track
    taxonomies.php              destination_tag
    customizer.php              Appearance > Customize > NoorSafar Theme Settings
    meta-fields.php             pricing status workflow
    forms.php                   [ns_booking] + [noorsafar_booking_form]
    prayer-times.php            [ns_prayer_times] + [noorsafar_prayer_times]
    seo-schema.php              OG/Twitter + Organization TravelAgency schema
    security.php                headers, admin hardening
  template-parts/
    home/                       hero, feature-strip, featured-journeys, destinations,
                                trust-partner, audio, gallery, testimonials, cta
    cards/                      package-card.php, testimonial-card.php
  assets/
    css/noorsafar-design.css    860 lines, full design system
    css/noorsafar-rtl.css       Urdu/Arabic RTL overrides
    js/theme.js                 motion, lightbox, nav, search, 360, audio engine
    images/                     originals + clean aliases + hero/ set
```

Inventory at handoff: 44 PHP, 3 CSS, 1 JS, 40 image files (22 PNG + 18 JPG in the images tree before this fix; now 39 files in `assets/images` plus 19 in `hero/`).

### Pricing model (never auto-calculate)
Statuses: `draft`, `coming_soon` ("Coming Soon"), `price_not_set` ("Price Not Set"), `contact` ("Contact for Price"), `available`, `sold_out` ("Sold Out"). Price is entered manually per package via meta; the front end only displays the status/price that the owner set.

### Multilingual
English (LTR), Urdu (RTL), Arabic (RTL). Use WPML **or** Polylang, never both. RTL CSS is enqueued when `is_rtl()`.

---

## 7. SEPARATE REQUIRED PLUGIN: noorsafar-core

Not bundled in the theme ZIP. Source is built at the canonical project root:
`C:\Users\M Salman\Documents\NoorSafar-Wey-Project\noorsafar-core\` (plugin header v1.1.0, 11 PHP files).
Package it as `noorsafar-core.zip` and install BEFORE the theme.

Provides: CPTs (`tour`, `darbar`, `ziyarat`, `pakistan_tour`, `ns_program`, `ns_media`, `ns_booking`); taxonomies (`tour_category` seeded with Umrah / Hajj / Ziarat Auliya / Northern Pakistan, `tour_region`, `program_category`, `media_category`); shortcodes `[noorsafar_booking_form]`, `[noorsafar_prayer_times]`, `[noorsafar_digital_tasbih]`; classes `NoorSafar_Core`, `NoorSafar_Islamic_Tools`, `NoorSafar_Booking`, `NoorSafar_Shortcodes`; booking engine with nonce + honeypot + 5 req/hr per-IP rate limit (trusted-proxy gated), atomic seat reservation (`reserve_seats`/`release_seats`), email + WhatsApp workflow; settings `whatsapp_number`, `support_phone`, `admin_email`, `prayer_city`, `trusted_proxies`.

Prayer-times/Islamic-tools use a **provider abstraction** (`NoorSafar_Prayer_Provider`); no API key is hardcoded. A provider is selected via the `prayer_provider`/`prayer_api_key` settings.

**Install order:** plugin -> theme -> Settings > Permalinks > Save.

---

## 8. FIXED IN THIS BUILD (verified statically)

1. **Broken images - the big one.** All 15 image references in the templates pointed at filenames absent from the package. Every hero, destination, trust, audio, gallery and CTA image rendered as a broken image. Originals restored into `assets/images/`; all references now resolve (verified by resolving every `.png/.jpg/.webp/.svg` string in PHP/CSS/JS against the files on disk).
2. **Testimonials section wrapper.** `template-parts/home/testimonials.php` had lost its `<section>`, `.ns-container`, `.ns-section-head` and `.ns-testimonials` grid, so the 3-column layout never applied and the heading was missing. Restored.
3. **Gallery lightbox used thumbnails.** The `full` high-res key was defined but never emitted, so the lightbox opened the small PNG. Now emitted as `data-full` and consumed by `theme.js`.
4. **Package card fallback pointed at a non-existent file** (`assets/images/hero/1.jpg`). Now `02_hero_visual.png`.
5. **CPT registration guard.** `if ( post_type_exists( 'destination' ) ) return;` meant that if any one post type was already registered by another plugin, the theme registered none. Now each type is checked individually.
6. **Journeys grid conflict.** CSS said `display: contents` while the template forced an inline `display:grid`; the inline style silently won. CSS is now authoritative and responsive (3 / 2 / 1 columns), inline style removed.
7. **Logo duplication.** The HTML `Noor<span>Safar</span>` reconstruction was replaced with a single image asset (remaining discrepancy documented in Section 3).

### 8.1 Visual reconstruction pass (post-verdict)

A second review (your verdict) found the homepage followed the right *sequence* but did not *match* the reference. The following structural/layout edits were applied:

- **Header**: swapped default logo to `01_header_logo.png` at natural horizontal proportions (`header.php`; `ns_logo` customizer default + Organization schema in `inc/seo-schema.php` also updated); **removed the top utility bar** (`ns-topbar`) so the header begins with the compact emerald navigation.
- **Hero**: removed the large multi-field **hero search form**, matching the reference (search is a header icon only). Updated tagline/CTA text to the reference wording ("Explore Our Journeys" / "Watch Our Story").
- **Feature strip**: replaced emoji-style generic icons with **inline SVG line icons** on small circular gold/ivory badges; removed the heavy 3D card tilt in favor of a clean horizontal strip.
- **Featured packages**: added `inc/seed-demo-content.php` (opt-in via `NOORSAFAR_SEED_DEMO`) + `SEED-PACKAGES.md` so staging can create the exact Classic Umrah / Premium Umrah / Hajj 2026 records with `03_/04_/05_featured_*`.
- **Destinations**: rebuilt to a **left text / right 4-card** dark-emerald band with left/right carousel arrows; responsive to single-column below 1100px.
- **Trusted Partner**: changed the background from a dark-emerald rounded box to a **full-width light ivory** three-part layout (left image / center "Your Trusted Travel Partner" + quote + 6 benefits / right Quran visual).
- **Islamic Audio**: rebuilt from 4 stacked players into the **three-column reference layout** (left heading/listen, center featured player with waveform + progress, right category list).
- **Gallery**: rebuilt from a centered grid into **left intro + right horizontal scroll strip** of five images; lightbox now uses `data-full` high-res assets.
- **Testimonials**: rebuilt into a **dark-emerald band** with left intro + right 3-card split; the visible "Demo testimonials" notice is confined to the staging fallback path and removed from production rendering.
- **CTA**: converted to a **thin full-width cinematic strip** using `18_cta_background.png` with an emerald overlay, replacing the previous large rounded card.
- **Footer**: rebuilt to **six columns** (NoorSafar / Journeys / Destinations / Resources / Company / Contact) with full canonical contact data, social icons, the Book My Journey button, and legal links; removed the duplicate "NoorSafar" text next to the logo (logo now carries the wordmark).
- **Asset cleanup**: archived 22 duplicate alias files (`ns-logo.png`, `hero.png`, `gallery-1..5.png`, `dest-*.png`, `tour-*.png`, etc.) into `assets/images/archive-duplicate-aliases/` so the active tree contains **only** the canonical `01..18_*` reference files plus the `hero/` Gemini set and design reference.

Remaining note: `php -l` still can't be run locally (no PHP binary); all edits are brace-balanced and `node --check` passes on `theme.js`.

---

## 9. STILL OPEN - MUST BE RESOLVED BEFORE LAUNCH

### 9.1 Required developer sequence (in this exact order)

1. Confirm/replace final hero artwork (`02_hero_visual.png` is NOT pre-approved - use the owner-approved artwork as the final asset, preserving the filename/path).
2. Complete the `noorsafar-core` plugin (CPTs, settings, booking, prayer times, APIs, business rules).
3. Run `php -l` on ALL PHP files (no PHP binary exists on the build machine).
4. Rebuild theme + core packages.
5. Install both on a clean WordPress staging site.
6. Run the full runtime QA in Section 9.3.
7. Fix only confirmed defects.
8. Repeat runtime QA.
9. Pass 4.5-C.
10. Continue to 4.5-D / next approved phase.

### 9.2 Blocking correctness

- `php -l` has never been run: no PHP binary on the build machine. Run it on all 45 PHP files on staging.
- **Required core plugin `noorsafar-core` is NOT on disk.** The plugin must be created/delivered separately - see `PLUGIN-DELIVERABLE.md`. Without it, all CPTs, booking, prayer times, and the single-source settings API are non-functional; header/footer fall back to canonical literals so static rendering works. Do NOT move core functionality into `functions.php` - keep the theme/plugin separation (Section 7).
- Logo canonical choice + footer duplicate text (Section 3).
- Audio files missing (Section 5).
- Content-ownership gate: `page-privacy.php`, `page-terms.php` and `page-cancellation.php` contain drafted policy text (retention periods, cancellation windows) that is NOT owner-verified. Legal review required before launch. Several marketing claims on `page-about.php` (5-star ratings, years in business) also need owner confirmation.
- Testimonial entries are demo placeholders; do not launch with them.

**Incomplete / inconsistent**
- `inc/customizer.php` does not expose every `theme_mod()` the templates read (gallery, testimonials, trust images, destinations, audio, secondary CTA are theme-mod-driven with no control), and its contact fields are not consumed by header/footer. Either add the controls or make the templates read the plugin settings.
- Header language `<select>` has no JavaScript redirect handler, so WPML/Polylang switching is inert until wired.
- `inc/custom-post-types.php` registers an `audio_track` CPT, but `audio.php` reads `theme_mod` only - pick one source.
- `page-about.php` and several page templates rely on page slugs rather than declared `Template Name` headers, so they only auto-apply to those exact slugs.
- Dead CSS: `assets/css/noorsafar-design.css` still contains a `.ns-journeys-cards` mobile rule superseded by the new block (clean up), and the `--font-main: '...'` declaration inside the RTL override is an invalid custom-property value; use `font-family` or drop it.
- No `screenshot.png`, so the theme shows no preview in Appearance > Themes.
- `style.css` header states PHP 8.0 / WP 6.3 while the core plugin targets PHP 7.4 / WP 6.0 - reconcile the declared minimums.
- Duplicate asset naming conventions resolved: 22 alias files archived into
  `assets/images/archive-duplicate-aliases/`; only the canonical `01..18_*` names
  plus `hero/` Gemini set and design reference remain active.
- `DISCONTINUATION-REASON.md` explains why the old `noorsafar-theme-2` generic homepage was abandoned; the old folder is reference-only and must not be activated.

**Staging QA gate - all must pass before production**
- Theme + plugin activation with no PHP notices.
- CPT registration and database writes confirmed.
- Booking form end-to-end with REAL SMTP delivery (a `wp_mail()` true is not proof of delivery) and a real WhatsApp send.
- Prayer times verified for Karachi / Makkah / Madinah against a reference source; location-denied fallback.
- Qibla accuracy.
- Responsive acceptance at 390 / 768 / 1024 / 1440px.
- RTL with real Urdu and Arabic copy, not just a direction flip.
- Keyboard/screen-reader pass: audio player key handling, lightbox focus trap, mobile nav, reduced-motion.
- Security review, then Lighthouse/performance on real hosting.
- Backup and rollback plan before cutover.

---

## 10. HOW TO PACKAGE AND INSTALL

```
Source : C:\Users\M Salman\Documents\Noor Safar-Wey-Theme\noorsafar-theme\
Package: C:\Users\M Salman\Documents\Noor Safar-Wey-Theme\noorsafar-theme.zip
Root   : noorsafar-theme/   (110 entries, verified single root)
```

1. Install and activate `noorsafar-core` first.
2. Install and activate `noorsafar-theme.zip`.
3. Settings > Permalinks > Post name > Save.
4. Configure NoorSafar settings: WhatsApp number, support phone, prayer city.
5. Run the Section 9 gate. Do not promote until it passes.

### 9.3 Runtime QA checklist

**Homepage rendering (pixel match to reference)**
- Header/logo, Hero, Feature cards, Journey cards, Destination carousel, Trust section, Audio, Gallery, Testimonials, CTA, Footer

**Functional**
- Quick View / Modal open-close, Escape + outside-click dismiss, keyboard focus trap
- Mobile scroll, touch swipe on carousel/gallery/lightbox
- RTL for Urdu and Arabic (not just direction flip)
- Elementor-generated content compatibility
- Registration CTA and WhatsApp CTA both fire
- JS-disabled fallback renders usable HTML

**Core plugin**
- CPT registration + DB writes
- Settings load and propagate (contact info single source)
- Booking form end-to-end with real SMTP delivery + real WhatsApp send
- Prayer times for Karachi / Makkah / Madinah (+ location-denied fallback)

**Responsive**
- Desktop 1440px, Tablet 768/1024px, Mobile 390px (and RTL mobile)

**Technical**
- `php -l` on all PHP files (theme + plugin)
- `node --check` on JS
- Console errors, 404s, missing assets, broken links, runtime/database errors

## 11. ACCURATE CURRENT STATUS

> **This package is structurally valid (ZIP integrity, single root, 90 entries,
> ~13.1 MB, brace-balanced, JS syntax clean) but is NOT a finished website.**
> Status: **Visual Reconstruction Complete - Staging Candidate - Runtime/Functional
> Certification Pending.**

The two blockers that prevent launch certification are the missing `noorsafar-core`
plugin (Section 7 / 9.2) and the lack of any WordPress runtime on this machine to
execute `php -l` or render the design (Section 9.1). The hero artwork also awaits
owner approval of the final composition.
