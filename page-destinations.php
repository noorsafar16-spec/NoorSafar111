<?php
/**
 * page-destinations.php — Destinations archive (Makkah, Madinah, etc.)
 * Dynamic from 'destination' CPT when populated, else theme_mod defaults.
 */
get_header();
$destinations = get_posts( [ 'post_type' => 'destination', 'numberposts' => 20, 'post_status' => 'publish' ] );
if ( empty( $destinations ) ) {
  $defaults = get_theme_mod( 'ns_destinations', [] );
}
?>
<section class="ns-section ns-single-v2 ns-reveal">
  <div class="ns-container">
    <div class="ns-v2-hero ns-reveal">
      <div>
        <div class="ns-v2-kicker"><?php esc_html_e( 'Blessed Places', 'noorsafar' ); ?></div>
        <h1 class="ns-h1"><?php esc_html_e( 'Sacred Destinations', 'noorsafar' ); ?></h1>
        <p class="ns-v2-lead"><?php esc_html_e( 'Explore the holy places of our faith.', 'noorsafar' ); ?></p>
      </div>
    </div>

    <?php if ( ! empty( $destinations ) ) : ?>
      <div class="ns-dest-grid">
        <?php foreach ( $destinations as $i => $d ) :
          $img = get_the_post_thumbnail_url( $d, 'large' ) ?: get_template_directory_uri() . '/assets/images/06_destination_makkah.png';
          printf(
            '<a href="%1$s" class="ns-dest-card ns-tilt ns-reveal" data-ns-tilt="1.8" data-ns-delay="%2$d"><img src="%3$s" alt="%4$s"><div class="ns-dest-name">%5$s</div></a>',
            esc_url( get_permalink( $d ) ),
            $i * 60,
            esc_url( $img ),
            esc_attr( $d->post_title ),
            esc_html( $d->post_title )
          );
        endforeach; ?>
      </div>
    <?php else : ?>
      <div class="ns-dest-grid">
        <?php foreach ( $defaults as $i => $d ) : ?>
          <a href="<?php echo esc_url( $d['link'] ); ?>" class="ns-dest-card ns-tilt ns-reveal" data-ns-tilt="1.8" data-ns-delay="<?php echo $i*60; ?>">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $d['image'] ); ?>" alt="<?php echo esc_attr( $d['name'] ); ?>">
            <div class="ns-dest-name"><?php echo esc_html( $d['name'] ); ?></div>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
<?php get_footer(); ?>