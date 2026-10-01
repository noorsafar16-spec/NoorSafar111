# NoorSafar Core Plugin - Delivery Status

> **STATUS: NOT DELIVERED.** The required `noorsafar-core` plugin is **missing
> from this handoff** and must be obtained/created before staging.

## What is expected

File `noorsafar-core/noorsafar-core.php` (plugin header v1.1.0) providing:

- CPTs: `tour`, `darbar`, `ziarat`, `pakistan_tour`, `ns_program`, `ns_media`, `ns_booking`
- Taxonomies: `tour_category` (seeded: Umrah, Hajj, Ziarat Auliya, Northern Pakistan), `tour_region`, `program_category`, `media_category`
- Shortcodes: `[noorsafar_booking_form]`, `[noorsafar_prayer_times]`, `[noorsafar_digital_tasbih]`
- Classes: `NoorSafar_Core`, `NoorSafar_Islamic_Tools`, `NS_Core_Booking`, `NS_Core_Shortcodes`
- Booking engine: nonce + honeypot + per-IP rate limit (trusted-proxy gated), atomic seat reservation (`reserve_seats`/`release_seats`), email + WhatsApp workflow
- Settings: `whatsapp_number`, `support_phone`, `admin_email`, `prayer_city`, `trusted_proxies`

## Where it should live

The final production package must contain BOTH:

```
NoorSafar Project/
  theme/      noorsafar-theme.zip        (this theme)
  plugin/     noorsafar-core.zip         (MISSING - build from the plugin source)
  DOCUMENTATION/
    NOORSAFAR-MASTER-BUILD-SPEC.MD      (this spec)
```

## Install order

1. Install and activate `noorsafar-core.zip` first.
2. Install and activate `noorsafar-theme.zip`.
3. Settings > Permalinks > Post name > Save.

Without the plugin, CPTs, booking forms, prayer times, and the
single-source contact/settings API (`noorsafar_core()->get_setting(...)`)
will not function. Header/footer fall back to their canonical literals so the
site still renders.
