<?php
/**
 * single-destination.php — Individual destination detail (Makkah/Madinah/etc.)
 * Uses the v2.2 single template layout (ns-v2-hero / ns-v2-grid).
 */
get_header();
?>
<div class="ns-single-v2 ns-reveal">
  <div class="ns-container">
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="ns-v2-hero ns-reveal">
        <div>
          <div class="ns-v2-kicker"><?php esc_html_e( 'Sacred Destination', 'noorsafar' ); ?></div>
          <h1 class="ns-h1"><?php the_title(); ?></h1>
          <p class="ns-v2-lead"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
        </div>
      </div>

      <div class="ns-v2-grid ns-reveal ns-reveal-delay-1">
        <div class="ns-v2-main">
          <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'large', [ 'class' => 'ns-v2-featured' ] ); ?>
          <?php endif; ?>
          <div class="ns-v2-panel ns-reveal">
            <h2><?php esc_html_e( 'Overview', 'noorsafar' ); ?></h2>
            <?php the_content(); ?>
          </div>
        </div>
        <aside class="ns-v2-side ns-v2-sticky">
          <div class="ns-v2-panel">
            <div class="ns-card-meta">
              <?php if ( get_post_meta( get_the_ID(), 'pkg_duration_days', true ) ) : ?>
                <span>&#9201; <?php echo esc_html( get_post_meta( get_the_ID(), 'pkg_duration_days', true ) ); ?> <?php esc_html_e( 'Days', 'noorsafar' ); ?></span>
              <?php endif; ?>
            </div>
            <a href="#nsBookingSection" class="ns-btn-cta" style="display:block;text-align:center;margin-top:14px;"><?php esc_html_e( 'Book This Journey', 'noorsafar' ); ?></a>
          </div>
        </aside>
      </div>
    <?php endwhile; ?>
  </div>
</div>
<?php get_footer(); ?>