<?php
/**
 * single.php — Generic single post (blog articles, etc.)
 */
get_header(); ?>
<section class="ns-section ns-single-v2 ns-reveal">
  <div class="ns-container">
    <?php while ( have_posts() ) : the_post(); ?>
      <article>
        <div class="ns-v2-hero ns-reveal">
          <div class="ns-v2-kicker"><?php the_time( 'M j, Y' ); ?></div>
          <h1 class="ns-h1"><?php the_title(); ?></h1>
        </div>
        <?php if ( has_post_thumbnail() ) : ?>
          <?php the_post_thumbnail( 'large', [ 'class' => 'ns-v2-featured ns-reveal' ] ); ?>
        <?php endif; ?>
        <div class="ns-v2-panel ns-reveal">
          <?php the_content(); ?>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
</section>
<?php get_footer(); ?>
