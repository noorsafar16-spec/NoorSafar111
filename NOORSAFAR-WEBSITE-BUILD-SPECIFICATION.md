# NoorSafar — Website Build Specification (Reference-Match Edition)

**Purpose:** A complete, executable brief for building the NoorSafar WordPress website so it matches the supplied reference design (`New_Project (2).webp`, 7016 × 9922 px) and every feature works.
**Inputs reviewed:** `noorsafar-theme.zip` (v3.0, 44 PHP files, 972-line design CSS, 355-line JS, all `.md` handoff docs), the reference screenshot, the logo (`01_header_logo.png`).
**Not reviewed:** the live URL `https://noor-safar100.unaux.com/`. It could not be opened from my environment (network blocked). Section 13 lists what to check on the live site yourself.

---

## 0. Honest starting point

Read this first, because it changes the plan.

1. **The theme is a structural draft, not a finished site.** Its own handoff (`NOORSAFAR-MASTER-BUILD-SPEC.MD` §11) says: *"structurally valid but NOT a finished website."* It has never been run in WordPress: no `php -l`, no activation test, no form/email test.
2. **A required plugin is missing.** The theme depends on `noorsafar-core` (tours, booking, prayer times, settings). It is **not in the ZIP**. Without it, the Tours CPT, booking form, prayer times and the contact-settings API do nothing.
3. **The reference image is an AI mock-up with garbled text.** Examples visible in it: "Ziyeret", "Explore Our Journeys" clipped, "Watch Our Scary", "Hajj, Umrah, Jiverert…", "Personalised Service / Tailored to your needs" rendered as gibberish in places, footer links unreadable. **Match the layout, colours, spacing and mood, not the misspelled text.** Correct copy is supplied in Section 5.
4. **Content in the theme is placeholder.** Legal pages, "5-star" claims, years in business, testimonials and USD prices are drafts that need owner approval before launch.

Because of 1 and 2, the recommended path is: **fix and complete the existing theme rather than restart**, following the phased plan in Section 12.

---

## 1. Brand system

### 1.1 Logo
- Use the supplied `01_header_logo.png` (crescent + Madinah dome + Kaaba + aeroplane, wordmark "Noor Safar", tagline "ISLAMIC TRAVEL & SPIRITUAL KNOWLEDGE").
- The supplied file is a **stacked/square logo (≈300 × 300)**. The reference header uses a **small horizontal lock-up** (icon left, "NoorSafar" right). Deliver two files:
  - `logo-header.png/svg`: icon + wordmark, horizontal, height 48–56 px, **transparent background**, white/gold wordmark for the dark header.
  - `logo-footer.png/svg`: same, height 44 px.
  - `logo-full.png`: the stacked version for favicon source, invoices, social profile, loading screen.
- Ask for an SVG or a ≥1200 px PNG. 300 px will look soft on retina screens.
- Never render the wordmark as live text next to the image (the theme did this earlier and duplicated it).
- Favicon: crescent + dome icon only, 512 × 512, exported to 32/180/192/512.

### 1.2 Colours (locked)
| Token | Hex | Use |
|---|---|---|
| `--ns-emerald` | `#082C23` | Header, footer, dark bands |
| `--ns-emerald-2` | `#0D4538` | Gradients, hover, card overlays |
| `--ns-gold` | `#C29B48` | Accents, borders, primary CTA |
| `--ns-gold-light` | `#DFB76C` | Hover, badges, gold text highlight |
| `--ns-ivory` | `#F7F5F0` | Light section background |
| `--ns-white` | `#FFFFFF` | Cards |
| `--ns-text-1` | `#082C23` | Body text on light |
| `--ns-text-2` | `#4A6B5F` | Secondary text |
| `--ns-border` | `rgba(13,69,56,.12)` | Hairlines |

Gold CTA gradient (from reference "Book My Journey"): `linear-gradient(135deg,#DFB76C,#C29B48)` with dark emerald text `#082C23`.
Dark band background: `radial-gradient(ellipse at top left,#0D4538,#082C23 70%)` plus faint gold Arabic-geometry line pattern at 6–8 % opacity in the corners (visible at the far left/right edges of the hero, destinations and testimonials bands).

### 1.3 Typography
| Role | Font | Notes |
|---|---|---|
| Headings | **Playfair Display** 600/700 | Hero H1 in reference looks like a lighter serif; use 600 |
| Body / UI | **Plus Jakarta Sans** 400/500/600 | |
| Eyebrow labels | **Cinzel** 500, letter-spacing .18em, uppercase, 12 px, gold | e.g. "SPIRITUAL JOURNEYS · HALAL TRAVEL · LIFE-ENRICHING EXPERIENCES" |
| Urdu | Noto Nastaliq Urdu | RTL |
| Arabic (calligraphy badge) | Amiri | |

Scale (desktop 1440): H1 64/1.05, H2 40/1.15, H3 22/1.25, body 16/1.65, small 13–14.
Mobile (390): H1 38, H2 30, H3 20, body 16.
**Self-host fonts** (download woff2 into `assets/fonts/`), don't call Google Fonts at runtime; this removes a privacy/GDPR issue and speeds up first paint.

### 1.4 Shape, depth, motion
- Radius: cards 16–20 px, buttons 999 px (pill), header bar 999 px.
- Shadows: soft, emerald-tinted (`0 20px 50px rgba(8,44,35,.12)`).
- Glass: header bar `background: rgba(8,44,35,.55); backdrop-filter: blur(14px); border:1px solid rgba(223,183,108,.25)`.
- Hero: one-time zoom-out `scale(1.08 → 1)`, 1.6 s. Gold text on "NoorSafar" shimmer (Antique → Light → Antique, 4 s, subtle).
- Cards: 2–3° pointer-tracked tilt, `scale(1.02)` on hover, desktop only.
- Scroll reveal: opacity 0→1 plus 12–24 px rise, 60 ms stagger.
- **`prefers-reduced-motion: reduce` disables all of the above.**

---

## 2. Global layout rules

- Container max-width **1240 px**, side padding 20 px (24 px ≥ 1024).
- Section vertical padding 70 px desktop / 45 px mobile. The reference is **dense**: sections are short bands, not tall pages. Keep the features strip ~110 px, gallery band ~260 px, CTA strip ~130 px.
- Breakpoints: 1200 / 980 / 768 / 480.
- Grid: 12 columns, 24 px gutter.
- Touch targets ≥ 44 px. Focus ring: 2 px `--ns-gold-light`, offset 3 px.
- Contrast: gold `#C29B48` on emerald passes for large text only; use `#DFB76C` for small gold text on dark.

---

## 3. Homepage — section-by-section (reference order, do not reorder)

Positions below are measured from the reference at 700 px preview width, scaled to a 1440 px desktop design.

### 3.1 Header (sticky)
- Full-width emerald strip, 84 px tall, thin gold line at the bottom edge.
- **Left:** logo (horizontal).
- **Centre:** a rounded glass pill containing the menu: `Home · Journeys + · Destinations + · Gallery · Ziyarat · Blog · Contact`. Active item has a subtle lighter pill. The pill also holds, on its right, a language chip (`EN ▾`) and a search icon.
- **Far right:** gold gradient pill button **Book My Journey** with a small dark circular arrow icon.
- Dropdowns (on hover and keyboard): Journeys → Hajj, Umrah, Northern Pakistan Tours, Programs. Destinations → Makkah, Madinah, Jerusalem, Karbala.
- **Mobile:** logo + hamburger; full-height emerald drawer, accordions for the two dropdowns, Book My Journey pinned at bottom, WhatsApp shortcut.
- Behaviour: on scroll >40 px the bar shrinks to 68 px and gains a shadow.
- Remove the top utility bar (phone/Hijri) exactly as the reference has none; move phone and Hijri date to the footer/contact page.

### 3.2 Hero (≈ 620 px tall on desktop; min 560 mobile)
- Full-bleed artwork: Madinah skyline left, glowing sunrise, Kaaba right-of-centre, camels and dunes, starry teal sky. Left half has an emerald gradient overlay (`linear-gradient(90deg,rgba(8,44,35,.92) 0,rgba(8,44,35,.55) 45%,transparent 75%)`) so text is legible.
- **Left text block (max-width 560 px, vertically centred):**
  - Eyebrow (Cinzel, gold): `SPIRITUAL JOURNEYS • HALAL TRAVEL • LIFE-ENRICHING EXPERIENCES`
  - H1: `Discover the Sacred` (line 1, white) / `with NoorSafar` (line 2, "NoorSafar" in gold with shimmer)
  - Paragraph: *Hajj, Umrah, Ziyarat and Islamic tours designed to bring you closer to Allah.*
  - Buttons: **Explore Our Journeys** (glass pill with arrow → `/journeys/`) and **▶ Watch Our Story** (circular gold play icon + text → opens video modal).
- **Right-edge badge:** an arched, translucent emerald "mihrab" panel with gold Arabic calligraphy **اللهم تقبل** and caption *May Allah accept our journey*. Hide below 1100 px.
- **Artwork:** use the owner-approved hero image at 2400 × 1100 (WebP + JPEG fallback, < 300 KB). The theme's `02_hero_visual.png` is flagged in its own docs as "not pre-approved". The reference's hero itself is the target composition.
- No search box in the hero (search is the header icon only).

### 3.3 Feature strip (white, 5 columns, dividers)
Five items, each: 44 px circular ivory badge with gold line icon (inline SVG), bold title, one-line grey caption.

| Icon | Title | Caption | Link |
|---|---|---|---|
| Kaaba | Hajj & Umrah | Life-changing pilgrimage | /hajj-packages |
| Dome/mosque | Ziyarat | Visit the blessed places | /ziarat |
| Compass | Islamic Tours | Explore with purpose | /tours |
| Suitcase/ticket | Custom Packages | Tailored to your needs | /custom-package (or booking with preset) |
| Headset | 24/7 Support | Always by your side | WhatsApp link |

Mobile: horizontal scroll-snap row or 2-column grid.

### 3.4 Featured Journeys — "Hajj & Umrah Packages" (ivory)
- Two-column layout `1fr | 2fr`.
- **Left:** eyebrow `FEATURED JOURNEYS`; H2 `Hajj & Umrah Packages`; text *Comfortable, reliable and spiritually fulfilling journeys with expert guidance and full support.*; dark-emerald pill button **View All Packages**.
- **Right:** three image cards (each ~300 × 390, radius 20):
  - Full-bleed photo, dark bottom gradient, gold hairline border.
  - Title (white serif), a row `🗓 7–15 Days`, a row `📍 Makkah & Madinah`, price row `From $1,250` (gold, large) and a circular arrow button at bottom-right.
  - Hover: image zooms 1.05, card lifts and tilts, arrow button fills gold.
- Cards from the reference: **Classic Umrah Package** (7–15 days), **Premium Umrah Package** (10–19 days), **Hajj Package 2026** (20–30 days).
- **Data rule:** prices come from admin fields, never hard-coded. Status options: Draft, Coming Soon, Price Not Set, Contact for Price, Available, Sold Out. If not "Available", show the status text instead of a price.
- **Decision needed:** the reference shows USD; the business is in Karachi. Add a currency setting (PKR default, USD optional). Do **not** auto-convert.

### 3.5 Blessed Destinations (full-width dark emerald)
- Left column: eyebrow `POPULAR DESTINATIONS`; H2 `Explore the Blessed Places`; text *Visit the sacred cities, historical landmarks and the homes of our beloved saints.*; gold pill **Discover All Destinations**.
- Right: carousel of 4 **arch/mihrab-shaped** cards (ornamental gold outline, isometric 3D-style illustrations): **Makkah, Madinah, Jerusalem, Karbala**, with labels below. Circular ‹ › arrow buttons at both ends.
- Fourth card in the reference has a burgundy tint, others are teal/blue. Use per-card accent colours.
- Carousel: touch swipe, arrow keys, `aria-roledescription="carousel"`; 4 visible desktop, 2 tablet, 1.3 mobile.
- Label choice: reference says "Jerusalem", theme says "Bait-ul-Muqaddas". Use **"Jerusalem (Bait-ul-Muqaddas)"** in the card title on hover/detail page, "Jerusalem" on the card label.

### 3.6 Your Trusted Travel Partner (ivory, three-part)
- **Left (≈30 %):** photo of Kaaba with Madinah minaret, with the quote overlaid on a soft ivory fade: *"Not just a trip, but a journey of faith."* — NoorSafar.
- **Centre (≈45 %):** eyebrow `WHY NOORSAFAR`; H2 `Your Trusted Travel Partner`; 2 × 3 grid of benefits, each with a round line icon, bold title and grey caption:
  - Experienced Guides — Knowledgeable & caring
  - Comfortable Stays — Premium accommodations
  - Safe & Secure — Your safety is our priority
  - Personalised Service — Tailored to your needs
  - Easy Booking — Secure & flexible
  - 24/7 Support — Always here for you
- **Right (≈25 %):** Quran on a rehal with tasbih, arched window blur, fading into ivory.
- Mobile: image on top, quote, then benefits 1-col.

### 3.7 Islamic Audio (white)
Three columns:
- **Left:** eyebrow `ISLAMIC AUDIO`; H2 `Hamd, Naat & Recitations`; text *Listen to soul-touching Hamd, Naat, Quran recitations and spiritual audios.*; emerald pill **Listen Now →**.
- **Centre:** card with square thumbnail (mosque), track title (`Beautiful Naat`), sub-line, gold play button, waveform, progress bar with current/total time (`2:34 / 5:30`), volume icon.
- **Right:** list of four categories with icons and chevrons: Quran Recitation, Hamd & Naat, Spiritual Talks, Zikr & Duas.
- **Functionality:** real HTML5 `<audio>`; play/pause, seek, time, volume, next/prev track, category switching, only one track plays at a time, keyboard (Space, ←/→). Tracks managed via an admin "Audio Track" post type (title, category, file, thumbnail). **Audio files were never supplied** — upload real, rights-cleared recordings or hide this section. Do not stream copyrighted naat/qirat you don't have permission for.

### 3.8 Gallery — "Moments That Inspire" (ivory)
- Left: eyebrow `OUR GALLERY`; H2 `Moments That Inspire`; text *Explore beautiful moments from our journeys.*; emerald pill **View Gallery →**.
- Right: five equal-height rounded images in a row (Kaaba crowd, Madinah dome, desert camels at sunset, mosque interior arches, Masjid at dusk). Horizontal scroll-snap on mobile.
- Click opens a **lightbox** with the high-resolution file, caption, prev/next, Esc to close, focus trap, swipe.
- Use real photos of real trips where possible; the AI-generated images in `/assets/images/hero/` should not be presented as "moments from our journeys" (that is misleading). Label them or replace.

### 3.9 Testimonials (dark emerald band)
- Left: eyebrow `TESTIMONIALS`; H2 `What Our Travelers Say`; text *Real stories. Genuine experiences.*; outlined gold pill **Read More Stories**.
- Right: three white cards, each with quote text, circular photo, name, 5 gold stars, journey label, and a quote-mark glyph at the bottom-right. Reference names: Ayesha Khan, Ahmed Raza, Fatima Ali.
- **Rule:** publish only real, consented testimonials from the `testimonial` CPT. Remove demo names before launch.

### 3.10 CTA strip
- Thin full-width cinematic banner: dusk skyline of mosques silhouetted in gold haze, emerald overlay.
- Left: `Ready for Your Next Journey?` + small line *Let us plan your perfect spiritual journey today.*
- Right: gold pill **Book Now** → `/book-my-journey/`.

### 3.11 Footer (deep emerald, 6 columns + bottom bar)
- Col 1: logo, short paragraph, social icons (Facebook, Instagram, YouTube, Pinterest — real URLs in Section 6).
- Col 2 **Journeys:** Hajj Packages, Umrah Packages, Islamic Tours, Ziyarat Tours, Custom Packages.
- Col 3 **Destinations:** Makkah, Madinah, Jerusalem, Karbala, All Destinations.
- Col 4 **Resources:** Blog, Gallery, Prayer Times & Islamic Tools, FAQ, Travel Guide.
- Col 5 **Company:** About Us, Our Team, Testimonials, Privacy Policy, Terms & Conditions.
- Col 6 **Contact:** WhatsApp, phone, email, address, newsletter form (email + gold arrow button).
- Decorative crescent-moon emblem centred at the bottom edge.
- Bottom bar: `© 2026 NoorSafar. All rights reserved.` left; `Privacy Policy | Terms & Conditions | Cancellation` right.
- Floating round WhatsApp button (bottom-right, sits above the mobile bottom-nav if any).

---

## 4. Inner pages

| Page | Slug | Content and function |
|---|---|---|
| About | /about | Story, mission, team, licences/registrations (owner to supply), trust badges |
| Hajj Packages | /hajj-packages | Filterable list (year, duration, price status), card component as §3.4 |
| Umrah Packages | /umrah-packages | Same, plus seasonal availability |
| Ziyarat | /ziarat | Sites list with maps, itineraries |
| Pakistan Tours | /pakistan-tours | Northern areas tours; uses `pakistan_tour` CPT |
| Journeys (all) | /tours | Archive of all packages, filters, sort |
| Single package | /tours/{slug} | Gallery, itinerary accordion, inclusions/exclusions, hotel list, dates and seats left, price/status, **Book now** and **Ask on WhatsApp**, FAQ, related packages |
| Destinations | /destinations, /destinations/{slug} | Overview + history + related packages |
| Gallery | /gallery | Masonry with category filter and lightbox |
| Blog | /blog, single, category | Standard posts; reading time; share buttons |
| Islamic Tools | /islamic-tools | Prayer times, Qibla, digital tasbih, Hijri calendar |
| Book My Journey | /book-my-journey | Booking form (Section 7.1) |
| Contact | /contact | Form, map, hours, WhatsApp, address |
| Privacy / Terms / Cancellation | /privacy-policy etc. | **Lawyer-reviewed** text |
| 404, Search | | Branded, with search box and popular links |

---

## 5. Approved copy (use instead of the garbled mock-up text)

| Element | Text |
|---|---|
| Hero eyebrow | SPIRITUAL JOURNEYS • HALAL TRAVEL • LIFE-ENRICHING EXPERIENCES |
| Hero H1 | Discover the Sacred with NoorSafar |
| Hero sub | Hajj, Umrah, Ziyarat and Islamic tours designed to bring you closer to Allah. |
| Hero CTAs | Explore Our Journeys · Watch Our Story |
| Badge | اللهم تقبل — May Allah accept our journey |
| Nav | Home · Journeys · Destinations · Gallery · Ziyarat · Blog · Contact |
| Header CTA | Book My Journey |
| CTA strip | Ready for Your Next Journey? · Book Now |

Fix every place the theme spells it "Ziyaret", "Ziarat" or "Ziyeret": pick **"Ziyarat"** for visible text, and keep `/ziarat/` as the URL slug or change it consistently.

---

## 6. Business data (single source of truth)

Store once in **NoorSafar → Settings** (plugin) and read everywhere (header, footer, schema, WhatsApp button, emails).

| Field | Value (from your handoff — confirm) |
|---|---|
| Contact name | Muhammad Salman |
| WhatsApp | +92 312 101 2277 (`https://wa.me/923121012277`) |
| Phone | +92 329 2219 787 |
| Email | noorsafar16@gmail.com |
| Address | House No. 23/4, Sector 5G, Baldia Town, Saeedabad, Karachi, Pakistan |
| Facebook | https://www.facebook.com/profile.php?id=61591612406926 |
| Instagram | https://www.instagram.com/noor843771/ |
| YouTube | https://www.youtube.com/@noorsafar-w6r |
| Pinterest | https://www.pinterest.com/noorsafar16/ |

Consider a **business email on your own domain** (e.g. `info@yourdomain`) for bookings. Gmail-only sending from WordPress often lands in spam.

---

## 7. Functional requirements (all must work)

### 7.1 Booking
- Fields: name, phone/WhatsApp, email, package (dropdown, prefilled from URL `?package=`), travel month/date, adults, children, infants, city of departure, message, consent checkbox.
- Client-side validation and server-side sanitisation; nonce, honeypot, per-IP rate limit (5/hour), optional reCAPTCHA/Turnstile.
- On submit: save as `ns_booking` record (admin-viewable, status workflow: New → Contacted → Confirmed → Cancelled), email admin, auto-reply to customer, and generate a prefilled WhatsApp link.
- Seat inventory: decrement atomically when status = Confirmed.
- **Use SMTP** (e.g. Brevo/Mailgun via WP Mail SMTP) and test real delivery to Gmail/Outlook.

### 7.2 Prayer times, Qibla, Tasbih, Hijri
- Prayer times from the Aladhan API with a city setting (default Karachi), cached for 6 hours, fallbacks if API fails; geolocation optional with a clear denied-state.
- Qibla compass using device orientation with a static bearing fallback.
- Digital tasbih (counter, reset, vibration toggle, saved locally).
- Hijri date in footer or tools page.

### 7.3 Search
- Header icon opens a full-screen overlay, live results (packages, destinations, posts).

### 7.4 Language
- English (LTR), Urdu and Arabic (RTL). Use **Polylang** (free) or WPML — never both. The `EN ▾` selector must actually redirect; it is inert in the current theme.
- Real translations of key pages. Do not ship machine translations of legal text.

### 7.5 Newsletter
- Footer form → Mailchimp/Brevo list, double opt-in, consent text.

### 7.6 WhatsApp
- Floating button plus per-package "Ask on WhatsApp" with prefilled message including the package name and page URL.

### 7.7 Admin editing (no code needed by the owner)
- CPTs: Tours (Hajj/Umrah/Ziyarat/Pakistan), Destinations, Testimonials, FAQs, Audio Tracks, Bookings, Gallery.
- Customizer / options page for hero image, hero text, badge text, feature-strip items, CTA text, footer text, social links, currency.

### 7.8 Video modal ("Watch Our Story")
- Lazy-load YouTube embed via `youtube-nocookie.com`, closed with Esc/outside click, focus returns to the button.

---

## 8. Responsive behaviour

| Viewport | Changes |
|---|---|
| ≥1200 | As described |
| 980–1199 | Journeys cards 2 per row; hero badge hidden; destinations 3 visible |
| 768–979 | Journeys left text stacks above cards; trust section stacks; audio 1 column |
| ≤767 | Hamburger nav; hero text centred-left, 60 vh; feature strip scroll-snap; all grids 1 column; gallery scroll-snap; footer accordions; CTA button full width |
| ≤390 | H1 38 px, buttons stacked full width, 16 px side padding |

Test at 390, 768, 1024, 1440, plus RTL at 390.

---

## 9. Performance, SEO, accessibility, security

**Performance**
- Images: WebP/AVIF with JPEG fallback, `srcset`, `loading="lazy"` except the hero (`fetchpriority="high"`).
- The theme's images total **~13 MB** (the design reference JPG alone is large). Remove the design-reference JPGs and unused aliases from the production build; compress everything.
- Self-hosted fonts with `font-display: swap`; preload the H1 font.
- Target: Lighthouse ≥ 90 mobile Performance, LCP < 2.5 s.
- Use a caching plugin (LiteSpeed/WP Rocket) and a CDN. Free InfinityFree/"unaux" hosting is slow and limited; for a real business site move to proper hosting.

**SEO**
- Yoast/RankMath or the theme's schema module: `TravelAgency` Organization, `Product/Offer` for packages, `BreadcrumbList`, `FAQPage`.
- Unique title/meta per page; `hreflang` for languages; XML sitemap; canonical URLs.
- Add `screenshot.png` (1200 × 900) to the theme.

**Accessibility (WCAG 2.2 AA)**
- Semantic landmarks, skip link, alt text on all images, visible focus, keyboard-operable dropdowns/carousel/audio/lightbox, `aria-live` for booking form errors, reduced-motion support, contrast checks on gold-on-emerald.

**Security**
- Keep the security module (headers, hardening); add 2FA for admins, limit login attempts, daily backups, HTTPS/HSTS, and update policy.
- Never commit API keys; put them in `wp-config.php`.

---

## 10. Known defects to fix in the supplied theme

From its own handoff, plus items I noticed:

1. `noorsafar-core` plugin missing → build it (CPTs, settings, booking, tools).
2. Customizer doesn't expose all `theme_mod()` values the templates read (gallery, testimonials, trust images, destinations, audio, secondary CTA); contact fields not consumed.
3. Language `<select>` has no JS handler.
4. `audio_track` CPT registered but `audio.php` reads theme mods only. Choose the CPT.
5. Page templates depend on slugs instead of `Template Name:` headers.
6. Dead/invalid CSS (`--font-main` inside RTL file; superseded `.ns-journeys-cards` rule).
7. Header/footer "Ziyaret" spelling; header `Book My Journey` links to `#nsBookingSection`, which doesn't exist on the homepage → point to `/book-my-journey/`.
8. Header search button is an emoji (🔍) → replace with SVG + overlay.
9. PHP/WP minimum versions differ between theme (8.0 / 6.3) and plugin (7.4 / 6.0) → align to PHP 8.1 / WP 6.5.
10. `php -l` never run → run on all files.
11. Image weight and duplicate alias files → clean.
12. Draft legal text and marketing claims → owner/legal review.
13. Demo seed content must never run in production (`NOORSAFAR_SEED_DEMO` off).

---

## 11. Assets you must supply or confirm

| Asset | Status |
|---|---|
| Logo (SVG or ≥1200 px, transparent) | Have 300 px PNG; need higher-res |
| Approved hero image (2400 × 1100) | Confirm final |
| Package photos (real) | Mock-up images only |
| Audio files with usage rights | **Missing** |
| Team photos, licence/registration numbers | Missing |
| Real testimonials + consent | Missing |
| Package data: dates, prices, hotels, inclusions, seat counts | Missing |
| Legal texts (privacy, terms, cancellation, refund) | Draft only |
| Business email + SMTP credentials | Missing |
| Domain + proper hosting | Currently free `unaux.com` subdomain |

---

## 12. Phased execution plan

**Phase 0 — Prep (½ day):** local WordPress (LocalWP), PHP 8.1, install theme, run `php -l` on every file, list fatal errors. Confirm logo, hero, colour/font decisions.

**Phase 1 — Core plugin (2–3 days):** CPTs, taxonomies, settings page, booking engine, Aladhan integration, tasbih, activation/uninstall hooks.

**Phase 2 — Homepage pixel match (2–3 days):** build each section in §3 against the reference at 1440 and 390 widths; overlay-compare screenshots (target ≤ 4 px deviation on layout).

**Phase 3 — Inner pages and templates (2–3 days):** §4, with `Template Name` headers.

**Phase 4 — Functionality (2 days):** audio player, lightbox, video modal, search overlay, carousel, language switcher, newsletter, WhatsApp.

**Phase 5 — Content entry (2 days):** real packages, destinations, gallery, testimonials, FAQs, legal.

**Phase 6 — QA (2 days):** checklist below.

**Phase 7 — Launch:** move to production hosting, SSL, SMTP, backups, analytics, Search Console, 301 redirects, final smoke test, rollback plan.

### QA checklist (must all pass)
- [ ] Theme and plugin activate with **no PHP notices** (`WP_DEBUG` on)
- [ ] All pages render at 390 / 768 / 1024 / 1440; RTL at 390
- [ ] Homepage visually matches reference (side-by-side)
- [ ] No console errors, 404s or broken images
- [ ] Booking → DB record → admin email → customer email (real inbox, not spam) → WhatsApp link
- [ ] Prayer times for Karachi, Makkah, Madinah match a trusted source; denied-location fallback
- [ ] Qibla within ±2° of a reference
- [ ] Audio plays, seeks, switches; only one at a time
- [ ] Lightbox, carousel, video modal: keyboard, swipe, Esc, focus trap
- [ ] Language switch works with real Urdu/Arabic copy
- [ ] Keyboard-only and screen-reader pass; reduced-motion respected
- [ ] Lighthouse mobile ≥ 90 Performance, ≥ 95 Accessibility/SEO/Best Practices
- [ ] Security scan, backup restore test
- [ ] JS-disabled fallback readable

---

## 13. What to check on your live localhost/URL and send me

I could not open `https://noor-safar100.unaux.com/`. To close the gap, please send:
1. A **full-page screenshot** of how the theme currently renders (desktop and phone).
2. Any **PHP errors** shown (turn on `WP_DEBUG` and `WP_DEBUG_LOG`, then send `wp-content/debug.log`).
3. Whether **`noorsafar-core`** is installed (Plugins screen).
4. A list of which sections look broken or different from the reference.

With those, I can turn this spec into a precise defect list and start writing the actual fixes and the missing plugin code.

---

## 14. Acceptance criteria (definition of "done")

The site is accepted when: (a) the homepage matches the reference layout, colour, spacing and motion at all breakpoints; (b) every function in §7 works end-to-end on production hosting; (c) the owner can edit all text, prices, images and contacts without code; (d) QA checklist in §12 is fully ticked; (e) content and legal text are owner-approved.
