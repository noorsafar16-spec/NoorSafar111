<?php
/**
 * NoorSafar Theme — front-page.php
 *
 * Component-based WordPress front page.
 * Section order is locked to the "Noor-ul-Saifa Final Designing.jpg" Web Demo:
 *
 *   Header → Hero → Feature Strip → Packages → Destinations
 *   → Trusted Travel Partner → Islamic Audio → Gallery
 *   → Testimonials → CTA → Footer
 *
 * Every block is rendered from real WordPress data (CPTs, options, custom fields)
 * so no price/date/contact is hard-coded.  Pricing follows the manual, approved
 * status workflow (Draft / Coming Soon / Price Not Set / Contact for Price / Available)
 * per report §8.
 *
 * @package NoorSafar
 */

get_header(); ?>

<!-- Cinematic Hero + search -->
<?php get_template_part( 'template-parts/home/hero' ); ?>

<!-- Five-feature strip -->
<?php get_template_part( 'template-parts/home/feature-strip' ); ?>

<!-- Featured journeys / packages (dynamic, editable) -->
<?php get_template_part( 'template-parts/home/featured-journeys' ); ?>

<!-- Sacred destinations (Makkah, Madinah, Bait-ul-Muqaddas, Karbala) -->
<?php get_template_part( 'template-parts/home/destinations' ); ?>

<!-- Trusted travel partner -->
<?php get_template_part( 'template-parts/home/trust-partner' ); ?>

<!-- Islamic audio (Hamd / Naat / Recitations) -->
<?php get_template_part( 'template-parts/home/audio' ); ?>

<!-- Inspiring gallery -->
<?php get_template_part( 'template-parts/home/gallery' ); ?>

<!-- Testimonials -->
<?php get_template_part( 'template-parts/home/testimonials' ); ?>

<!-- Ready for your next journey -->
<?php get_template_part( 'template-parts/home/cta' ); ?>

<?php get_footer(); ?>
