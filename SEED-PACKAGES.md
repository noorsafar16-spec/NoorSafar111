# Seed Packages (how to make the homepage match the Web Demo)

The homepage "Hajj & Umrah Packages" section queries the `tour` CPT for
featured packages. To match the supplied reference exactly on staging, create
the three records below. They are NOT auto-created in production.

The file `inc/seed-demo-content.php` can generate them automatically during
staging by enabling the flag in `wp-config.php`:

```php
define( 'NOORSAFAR_SEED_DEMO', true );
```

After activating the theme with that flag set, the three packages are created
and the `noorsafar_demo_seed_done` option prevents re-runs.

## Records to create (manual alternative)

| # | Title                | Duration | Destination     | Price          | Status  | Image                        | Badge   |
|---|----------------------|----------|-----------------|----------------|---------|------------------------------|---------|
| 1 | Classic Umrah Package| 10/09    | Makkah & Madinah| From $1,250    | available| assets/images/03_featured_classic_umrah.png | Bestseller |
| 2 | Premium Umrah Package| 10/19    | Makkah & Madinah| From $1,850    | available| assets/images/04_featured_premium_umrah.png | —        |
| 3 | Hajj Package 2026    | 20/30    | Makkah & Madinah| From $4,590    | available| assets/images/05_featured_hajj.png        | —        |

Pricing note: the reference prices are in USD. `pkg_price_pkr` stores the numeric
value; render a `$`-prefixed "From" label via the Customizer/currency setting, and
never auto-convert PKR. Set `pkg_featured = 1` so `featured-journeys.php` shows them.
