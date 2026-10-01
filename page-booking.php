<?php
/**
 * page-booking.php — Book My Journey (dedicated booking page per PDF §6).
 */
get_header();
?>
<section class="ns-section ns-single-v2 ns-reveal">
  <div class="ns-container">
    <div class="ns-v2-hero ns-reveal">
      <div>
        <div class="ns-v2-kicker"><?php esc_html_e( 'Reserve Your Journey', 'noorsafar' ); ?></div>
        <h1 class="ns-h1"><?php esc_html_e( 'Book My Journey', 'noorsafar' ); ?></h1>
        <p class="ns-v2-lead"><?php esc_html_e( 'Select your package and complete your registration.', 'noorsafar' ); ?></p>
      </div>
    </div>

    <div class="ns-v2-panel ns-reveal ns-reveal-delay-1">
      <?php echo do_shortcode( '[ns_booking]' ); ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>