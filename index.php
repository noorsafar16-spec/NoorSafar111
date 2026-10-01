<?php
/**
 * index.php — Fallback blog template
 */
get_header(); ?>
<section class="ns-section ns-single-v2 ns-reveal">
  <div class="ns-container">
    <div class="ns-v2-hero"><h1 class="ns-h1"><?php esc_html_e( 'Blog & Guides', 'noorsafar' ); ?></h1>
      <p class="ns-v2-lead"><?php esc_html_e( 'Travel guides, Hajj/Umrah preparation, visa tips and spiritual articles.', 'noorsafar' ); ?></p></div>

    <div class="ns-v2-grid">
      <div class="ns-v2-main">
        <?php if ( have_posts() ) :
          while ( have_posts() ) : the_post(); ?>
            <article class="ns-card-3d ns-reveal" style="margin-bottom:24px;">
              <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'medium_large', [ 'class' => 'ns-v2-featured' ] ); ?>
              <?php endif; ?>
              <div class="ns-card-3d-body">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
              </div>
            </article>
          <?php endwhile;
          the_posts_pagination();
        else : ?>
          <p><?php esc_html_e( 'No articles yet. Check back soon.', 'noorsafar' ); ?></p>
        <?php endif; ?>
      </div>
      <aside class="ns-v2-side ns-v2-sticky">
        <div class="ns-v2-panel">
          <h2><?php esc_html_e( 'Categories', 'noorsafar' ); ?></h2>
          <?php the_category( '<br>' ); ?>
        </div>
      </aside>
    </div>
  </div>
</section>
<?php get_footer(); ?>