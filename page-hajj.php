<?php
/**
 * Template Name: Hajj Packages
 * Template Post Type: page, tour
 * Description: Hajj pilgrimage service page (PDF §6 P0/P1).
 *
 * Dynamic: queries 'tour' CPT filtered by category 'Hajj'.
 * Pricing/status sourced from pkg_* meta — never hard-coded.
 */
get_header();

$cat = get_term_by( 'slug', 'hajj', 'tour_category' );
$hajj_tours = new WP_Query( [
  'post_type'      => 'tour',
  'post_status'    => 'publish',
  'posts_per_page' => 12,
  'orderby'        => 'menu_order title',
  'order'          => 'ASC',
  'tax_query'      => $cat ? [ [ 'taxonomy' => 'tour_category', 'field' => 'term_id', 'terms' => [ $cat->term_id ] ] ] : [],
] );
?>

<section class="ns-section ns-single-v2 ns-reveal">
  <div class="ns-container">
    <div class="ns-v2-hero ns-reveal">
      <div>
        <div class="ns-v2-kicker"><?php esc_html_e( 'Hajj Services', 'noorsafar' ); ?></div>
        <h1 class="ns-h1"><?php esc_html_e( 'Hajj Packages', 'noorsafar' ); ?></h1>
        <p class="ns-v2-lead"><?php esc_html_e( 'Comprehensive Hajj arrangements with scholar guidance and Pakistani coordination.', 'noorsafar' ); ?></p>
      </div>
    </div>

    <div class="ns-grid-3">
      <?php if ( $hajj_tours->have_posts() ) :
        while ( $hajj_tours->have_posts() ) : $hajj_tours->the_post();
          get_template_part( 'template-parts/cards/package-card' );
        endwhile; wp_reset_postdata();
      else : ?>
        <p class="ns-v2-empty"><?php esc_html_e( 'Hajj packages for the upcoming season are coming soon. Please check back or contact us.', 'noorsafar' ); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
