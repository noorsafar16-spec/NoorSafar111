<?php
/**
 * Template Name: Ziyarat
 * Description: Ziyarat Auliya / spiritual sites page (PDF §6).
 */
get_header();
?>
<section class="ns-section ns-single-v2 ns-reveal">
  <div class="ns-container">
    <div class="ns-v2-hero ns-reveal">
      <div>
        <div class="ns-v2-kicker"><?php esc_html_e( 'Sacred Visits', 'noorsafar' ); ?></div>
        <h1 class="ns-h1"><?php esc_html_e( 'Ziyarat Auliya Allah', 'noorsafar' ); ?></h1>
        <p class="ns-v2-lead"><?php esc_html_e( 'Visit the blessed shrines of the Awliya Allah across the Islamic world.', 'noorsafar' ); ?></p>
      </div>
    </div>

    <?php
    // Ziyarat list — editable via theme_mod
    $ziarats = get_theme_mod( 'ns_ziarat_sites', [
      [ 'name' => 'Data Darbar Lahore',       'image' => '16_gallery_architecture.png', 'desc' => 'The shrine of Hazrat Ali bin Usman Ali Hajveri.' ],
      [ 'name' => 'Lal Shahbaz Qalandar',      'image' => '17_gallery_mosque.png', 'desc' => 'The iconic shrine in Sehwan Shar.' ],
      [ 'name' => 'Bahauddin Zakariya Multan', 'image' => '16_gallery_architecture.png', 'desc' => 'Sufi master buried in Multan.' ],
    ] );
    ?>
    <div class="ns-grid-3">
      <?php foreach ( $ziarats as $z ) : ?>
        <div class="ns-card-3d ns-tilt ns-reveal" data-ns-tilt="2" style="height:100%;">
          <div class="ns-card-3d-media" style="background-image:url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $z['image'] ); ?>');"></div>
          <div class="ns-card-3d-body">
            <h3><?php echo esc_html( $z['name'] ); ?></h3>
            <p style="color:var(--ns-text-2);"><?php echo esc_html( $z['desc'] ); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
