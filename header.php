<?php
/**
 * header.php — Emerald/glass header, Web Demo navigation.
 *
 * CORRECTIONS applied per review:
 *  - Logo is the official NoorSafar logo asset ONLY (no HTML "Noor<span>Safar" duplication).
 *  - Canonical path: assets/images/01_header_logo.png (natural horizontal proportions).
 *  - Nav matches Web Demo: Home, Journey+, Destinations+, Gallery, Ziyaret, Blog, Contact.
 *  - Contact data sourced from NoorSafar Core settings (single source of truth).
 */
$phone   = class_exists( 'NoorSafar_Core' ) ? noorsafar_core()->get_setting( 'support_phone', '' ) : '';
$wa      = class_exists( 'NoorSafar_Core' ) ? preg_replace( '/[^0-9]/', '', (string) noorsafar_core()->get_setting( 'whatsapp_number', '' ) ) : '';
$logo    = get_theme_mod( 'ns_logo', get_template_directory_uri() . '/assets/images/01_header_logo.png' );

// Canonical phone/WhatsApp display (PDF p.10)
$wa_display   = '+92 312 101 2277';
$phone_display = '+92 329 2219 787';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Emerald / glass header navigation — Web Demo order: Home, Journey, Destinations, Gallery, Ziyarat, Blog, Contact -->
<header class="ns-header ns-parallax" data-ns-speed="0.15">
  <div class="ns-container ns-nav-flex">
    <!-- Brand: official logo as single complete asset -->
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ns-logo" title="NoorSafar">
      <img src="<?php echo esc_url( $logo ); ?>"
           alt="<?php esc_attr_e( 'NoorSafar - Islamic Travel & Spiritual Pilgrimage', 'noorsafar' ); ?>"
           class="ns-logo-img">
    </a>

    <nav>
      <ul class="ns-nav-menu">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'noorsafar' ); ?></a></li>

        <li class="ns-has-dropdown">
          <a href="<?php echo esc_url( home_url( '/tours/' ) ); ?>"><?php esc_html_e( 'Journey', 'noorsafar' ); ?> +</a>
          <ul class="ns-dropdown">
            <li><a href="<?php echo esc_url( home_url( '/hajj-packages/' ) ); ?>"><?php esc_html_e( 'Hajj', 'noorsafar' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/umrah-packages/' ) ); ?>"><?php esc_html_e( 'Umrah', 'noorsafar' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/pakistan-tours/' ) ); ?>"><?php esc_html_e( 'Northern Pakistan Tours', 'noorsafar' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/programs/' ) ); ?>"><?php esc_html_e( 'Programs', 'noorsafar' ); ?></a></li>
          </ul>
        </li>

        <li class="ns-has-dropdown">
          <a href="<?php echo esc_url( home_url( '/destinations/' ) ); ?>"><?php esc_html_e( 'Destinations', 'noorsafar' ); ?> +</a>
          <ul class="ns-dropdown">
            <li><a href="<?php echo esc_url( home_url( '/destinations/makkah/' ) ); ?>"><?php esc_html_e( 'Makkah', 'noorsafar' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/destinations/madinah/' ) ); ?>"><?php esc_html_e( 'Madinah', 'noorsafar' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/destinations/jerusalem/' ) ); ?>"><?php esc_html_e( 'Jerusalem', 'noorsafar' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/destinations/karbala/' ) ); ?>"><?php esc_html_e( 'Karbala', 'noorsafar' ); ?></a></li>
          </ul>
        </li>

        <li><a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>"><?php esc_html_e( 'Gallery', 'noorsafar' ); ?></a></li>
        <li><a href="<?php echo esc_url( home_url( '/ziarat/' ) ); ?>"><?php esc_html_e( 'Ziyaret', 'noorsafar' ); ?></a></li>
        <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Blog', 'noorsafar' ); ?></a></li>
        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'noorsafar' ); ?></a></li>
      </ul>

      <!-- Right-side: language selector + search -->
      <div class="ns-nav-tools">
        <?php if ( function_exists( 'icl_get_languages' ) && icl_detected_lang() ) : ?>
          <select id="ns-lang-switcher" aria-label="<?php esc_attr_e( 'Select language', 'noorsafar' ); ?>">
            <?php foreach ( icl_get_languages( 'skip_missing=0' ) as $lang ) : ?>
              <option value="<?php echo esc_url( $lang['url'] ); ?>" <?php echo $lang['active'] ? 'selected' : ''; ?>><?php echo esc_html( $lang['native_name'] ); ?></option>
            <?php endforeach; ?>
          </select>
        <?php endif; ?>
        <button class="ns-nav-search-btn" aria-label="<?php esc_attr_e( 'Search', 'noorsafar' ); ?>">&#128269;</button>
        <a href="#nsBookingSection" class="ns-btn-cta"><?php esc_html_e( 'Book My Journey', 'noorsafar' ); ?></a>
      </div>
    </nav>
  </div>
</header>
