<?php
/**
 * Template Name: Umrah Packages
 * Description: Umrah service page (PDF §6).
 */
get_header();
$cat = get_term_by( 'slug', 'umrah', 'tour_category' );
$umrah_tours = new WP_Query( [
  'post_type'      => 'tour',
  'post_status'    => 'publish',
  'posts_per_page' => 12,
  'tax_query'      => $cat ? [ [ 'taxonomy' => 'tour_category', 'field' => 'term_id', 'terms' => [ $cat->term_id ] ] ] : [],
] );
?>
<section class="ns-section ns-single-v2 ns-reveal">
  <div class="ns-container">
    <div class="ns-v2-hero ns-reveal">
      <div>
        <div class="ns-v2-kicker"><?php esc_html_e( 'Umrah Services', 'noorsafar' ); ?></div>
        <h1 class="ns-h1"><?php esc_html_e( 'Umrah Packages', 'noorsafar' ); ?></h1>
        <p class="ns-v2-lead"><?php esc_html_e( 'Economy and 5-star Umrah packages with verified transport and accommodation.', 'noorsafar' ); ?></p>
      </div>
    </div>

    <div class="ns-grid-3">
      <?php if ( $umrah_tours->have_posts() ) :
        while ( $umrah_tours->have_posts() ) : $umrah_tours->the_post();
          get_template_part( 'template-parts/cards/package-card' );
        endwhile; wp_reset_postdata();
      else : ?>
        <p class="ns-v2-empty"><?php esc_html_e( 'Umrah packages are coming soon. Check back or contact us.', 'noorsafar' ); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
