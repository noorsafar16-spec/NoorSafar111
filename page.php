<?php
/**
 * page.php — Generic WordPress page fallback
 */
get_header(); ?>
<section class="ns-section ns-single-v2 ns-reveal">
  <div class="ns-container">
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="ns-v2-hero ns-reveal">
        <h1 class="ns-h1"><?php the_title(); ?></h1>
      </div>
      <div class="ns-v2-panel ns-reveal">
        <?php the_content(); ?>
      </div>
    <?php endwhile; ?>
  </div>
</section>
<?php get_footer(); ?>