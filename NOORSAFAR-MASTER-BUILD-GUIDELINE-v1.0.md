# NOORSAFAR MASTER DESIGN & BUILD GUIDELINE v1.0
**Single-source specification for one-pass WordPress design, integration, QA and ZIP delivery.**  
**Date:** 1 October 2026

## One-command handoff
```text
READ /USE: NOORSAFAR-MASTER-BUILD-GUIDELINE-v1.0.docx (or the accompanying .md) AS THE SINGLE SOURCE OF TRUTH. BUILD THE COMPLETE NOORSAFAR WORDPRESS SITE EXACTLY TO THIS SPECIFICATION. Do not redesign, reinterpret, reorder sections, invent content, change the palette, replace the logo, remove required sections, or introduce duplicate business logic. Preserve the supplied visual reference while upgrading the hero to the specified lightweight 3D-depth animation. Consolidate the approved visual theme with noorsafar-core; Theme handles presentation, Core handles data/business logic. Use the 18 numbered assets only in their assigned roles, and request/produce high-resolution production derivatives where the supplied files are too small. Build clean noorsafar-theme.zip and noorsafar-core.zip, install them on a clean WordPress staging site, run every acceptance test in this document, fix confirmed defects, rebuild, and do not mark FINAL-UPLOAD until every P0/P1 acceptance test passes.
```

## Architecture
- Theme: visual presentation, templates, CSS/JS, responsive/RTL UI.
- Core: CPTs, settings, booking, seat reservation, Islamic tools, AJAX/security/business rules.
- WordPress Admin: all editable content.
- Final installables: `noorsafar-theme.zip` + `noorsafar-core.zip`.

## Locked brand
- Emerald: `#082C23`
- Emerald 2: `#0D4538`
- Gold: `#C29B48`
- Light Gold: `#DFB76C`
- Ivory: `#F7F5F0`
- White: `#FFFFFF`
- Headings: Playfair Display
- Body: Plus Jakarta Sans
- Decorative: Cinzel
- Urdu: Noto Nastaliq Urdu
- Arabic: Amiri

## Hero — mandatory 3D cinematic implementation
The supplied `02_hero_visual.png` is the reference composition, not a production-resolution 3D scene. Build a lightweight layered 3D-depth hero:
1. Background sacred architecture/sky.
2. Atmospheric light/haze.
3. Architectural midground.
4. Foreground Islamic framing.
5. UI plane with headline/CTAs.
- CSS 3D + layered parallax, requestAnimationFrame interpolation.
- Entrance zoom `1.08 -> 1.00` over `1.6s`.
- Pointer depth max 2–3 degrees on desktop only.
- Scroll parallax about 15%.
- Static fallback and `prefers-reduced-motion` mode mandatory.
- Hero ~600–640px desktop, ~560px tablet, ~600px mobile with safe crop.
- No heavy 3D dependency unless performance testing proves it acceptable.

## Homepage order
1. Header
2. 3D Hero
3. Feature Strip
4. Featured Journeys
5. Blessed Destinations
6. Trusted Travel Partner
7. Islamic Audio
8. Moments That Inspire
9. Testimonials
10. CTA
11. Footer

## 18 asset placement register
| Asset | Size | Role | Placement |
|---|---:|---|---|
| `01_header_logo.png` | 180×55 | Header/footer logo | Single complete logo, preserve ratio |
| `02_hero_visual.png` | 749×249 | Hero reference | Full-width cover; derive high-res 3D layers |
| `03_featured_classic_umrah.png` | 175×94 | Package card 1 | Featured Classic Umrah |
| `04_featured_premium_umrah.png` | 178×94 | Package card 2 | Featured Premium Umrah |
| `05_featured_hajj.png` | 179×94 | Package card 3 | Featured Hajj |
| `06_destination_makkah.png` | 135×144 | Destination 1 | Makkah |
| `07_destination_madinah.png` | 135×144 | Destination 2 | Madinah |
| `08_destination_jerusalem.png` | 135×144 | Destination 3 | Bait-ul-Muqaddas/Jerusalem |
| `09_destination_karbala.png` | 135×144 | Destination 4 | Karbala |
| `10_trusted_partner_left_visual.png` | 330×195 | Trust visual | Left column |
| `11_trusted_partner_right_visual.png` | 219×195 | Trust visual | Right column |
| `12_audio_thumbnail.png` | 84×62 | Audio | Featured player |
| `13_gallery_kaaba.png` | 108×76 | Gallery 1 | Horizontal strip |
| `14_gallery_madinah.png` | 108×76 | Gallery 2 | Horizontal strip |
| `15_gallery_desert.png` | 135×76 | Gallery 3 | Horizontal strip |
| `16_gallery_architecture.png` | 105×76 | Gallery 4 | Horizontal strip |
| `17_gallery_mosque.png` | 107×76 | Gallery 5 | Horizontal strip |
| `18_cta_background.png` | 1024×54 | CTA | Full-width thin CTA strip |

**Important:** current dimensions are reference/mockup sizes and are too small for many production placements. Create approved high-resolution derivatives; do not simply upscale and ship.

## Inner pages
- About
- Journeys
- Hajj Packages
- Umrah Packages
- Ziyarat
- Pakistan Tours
- Programs
- Single Package
- Destinations
- Single Destination
- Gallery
- Blog
- Islamic Tools
- Book My Journey
- Contact
- FAQ
- Privacy
- Terms
- Cancellation
- Search/404

## Data rules
- Manual pricing only.
- Statuses: Draft, Coming Soon, Price Not Set, Contact for Price, Available, Sold Out.
- Currency/context: Urdu PKR; English USD presentation where configured; Arabic configured Arabic-market currency.
- Core owns contact settings and booking.
- Real consented testimonials only.
- Rights-cleared audio only.
- Legal text requires owner/legal review.

## Required corrections
- `Ziyaret` -> `Ziyarat`
- Book My Journey -> `/book-my-journey/`
- Emoji search -> accessible SVG
- Align PHP/WP requirements
- Wire real multilingual switcher
- Resolve audio source ownership
- Add template headers where appropriate
- Add `screenshot.png`
- Remove dead CSS/invalid RTL property
- Remove demo/placeholder production content
- Consolidate contact settings

## Final packages
```text
FINAL-UPLOAD/
  noorsafar-theme.zip
  noorsafar-core.zip
```

## QA
The build is not production-certified until clean staging passes:
- PHP syntax
- activation
- CPTs/data
- homepage reference match at 1440 and 390
- 3D hero/fallback/reduced-motion
- all 18 assets
- gallery lightbox
- pricing/status
- booking + real SMTP + WhatsApp + seats
- prayer provider
- Urdu/Arabic RTL
- search/dropdowns/carousel/lightbox/audio
- SEO/schema
- accessibility
- performance
- security
- backup/restore
- production smoke test
