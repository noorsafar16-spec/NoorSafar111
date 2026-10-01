<?php
/**
 * search.php — Search results
 */
get_header(); ?>
<section class="ns-section ns-single-v2 ns-reveal">
  <div class="ns-container">
    <div class="ns-v2-hero">
      <h1 class="ns-h1"><?php printf( esc_html__( 'Search Results for: %s', 'noorsafar' ), get_search_query() ); ?></h1>
    </div>
    <div class="ns-grid-3">
      <?php if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
          <article class="ns-card-3d ns-reveal">
            <div class="ns-card-3d-body">
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
            </div>
          </article>
        <?php endwhile;
        the_posts_pagination();
      else : ?>
        <p class="ns-v2-empty"><?php esc_html_e( 'Nothing found. Try refining your search.', 'noorsafar' ); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
