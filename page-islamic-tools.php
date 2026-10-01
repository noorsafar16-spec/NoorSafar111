<?php
/**
 * page-islamic-tools.php — Prayer times / Qibla / Tasbih hub (PDF §6).
 * These exist as component shortcodes provided by NoorSafar Core.
 */
get_header();
?>
<section class="ns-section ns-single-v2 ns-reveal">
  <div class="ns-container">
    <div class="ns-v2-hero ns-reveal">
      <div>
        <div class="ns-v2-kicker"><?php esc_html_e( 'Sacred Utilities', 'noorsafar' ); ?></div>
        <h1 class="ns-h1"><?php esc_html_e( 'Islamic Tools', 'noorsafar' ); ?></h1>
        <p class="ns-v2-lead"><?php esc_html_e( 'Prayer times, Qibla direction, Islamic calendar and digital tasbih.', 'noorsafar' ); ?></p>
      </div>
    </div>

    <div class="ns-v2-grid ns-reveal ns-reveal-delay-1">
      <div class="ns-v2-main">
        <div class="ns-v2-panel ns-reveal">
          <h2><?php esc_html_e( 'Prayer Times', 'noorsafar' ); ?></h2>
          <?php echo do_shortcode( '[ns_prayer_times]' ); ?>
        </div>

        <div class="ns-v2-panel ns-reveal ns-reveal-delay-1">
          <h2><?php esc_html_e( 'Digital Tasbih', 'noorsafar' ); ?></h2>
          <?php echo do_shortcode( '[noorsafar_digital_tasbih goal="33" phrases="SubhanAllah,Alhamdulillah,Allahu Akbar"]' ); ?>
        </div>

        <div class="ns-v2-panel ns-reveal ns-reveal-delay-2">
          <h2><?php esc_html_e( 'Qibla Direction', 'noorsafar' ); ?></h2>
          <p><?php esc_html_e( 'Qibla bearing from your location.', 'noorsafar' ); ?></p>
          <div id="ns-qibla" style="min-height:120px;padding:16px;background:rgba(13,69,56,0.06);border-radius:var(--ns-radius);">
            <?php esc_html_e( 'Enable location access to display your Qibla direction.', 'noorsafar' ); ?>
          </div>
        </div>
      </div>

      <aside class="ns-v2-side ns-v2-sticky">
        <div class="ns-v2-panel">
          <h2><?php esc_html_e( 'Islamic Calendar', 'noorsafar' ); ?></h2>
          <p><?php esc_html_e( 'The current Hijri date is displayed in your header.', 'noorsafar' ); ?></p>
          <?php if ( class_exists( 'NoorSafar_Islamic_Tools' ) ) : ?>
            <p style="font-size:1.3rem;font-weight:700;color:var(--ns-emerald);"><?php echo esc_html( NoorSafar_Islamic_Tools::get_hijri_date() ); ?></p>
          <?php endif; ?>
        </div>
      </aside>
    </div>
  </div>
</section>
<?php get_footer(); ?>