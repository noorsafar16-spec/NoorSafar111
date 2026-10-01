<?php
/**
 * archive.php — Generic archive fallback (tours, destinations, blog)
 */
get_header(); ?>
<section class="ns-section ns-single-v2 ns-reveal">
  <div class="ns-container">
    <div class="ns-v2-hero ns-reveal">
      <h1 class="ns-h1"><?php post_type_archive_title(); ?></h1>
    </div>
    <div class="ns-grid-3">
      <?php if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
          <article class="ns-card-3d ns-tilt ns-reveal" data-ns-tilt="2.2">
            <?php if ( has_post_thumbnail() ) : ?>
              <div class="ns-card-3d-media" style="background-image:url('<?php echo esc_url( get_the_post_thumbnail_url( null, 'large' ) ); ?>');"></div>
            <?php endif; ?>
            <div class="ns-card-3d-body">
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <?php if ( get_the_excerpt() ) : ?>
                <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
              <?php endif; ?>
            </div>
          </article>
        <?php endwhile;
        the_posts_pagination();
      else : ?>
        <p class="ns-v2-empty"><?php esc_html_e( 'No entries found.', 'noorsafar' ); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
