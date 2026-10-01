<?php
/**
 * 404.php — Not found
 */
get_header(); ?>
<section class="ns-section ns-single-v2 ns-reveal" style="text-align:center;min-height:60vh;">
  <div class="ns-container">
    <h1 class="ns-h1" style="font-size:4rem;color:var(--ns-gold);margin-bottom:16px;">404</h1>
    <p class="ns-v2-lead"><?php esc_html_e( 'The page you are looking for has wandered off the sacred path.', 'noorsafar' ); ?></p>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ns-btn-hero-primary"><?php esc_html_e( 'Return Home', 'noorsafar' ); ?></a>
  </div>
</section>
<?php get_footer(); ?>
