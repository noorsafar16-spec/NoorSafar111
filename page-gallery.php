<?php
/**
 * page-gallery.php — Gallery page using supplied assets.
 * PDF §4 P2: "Media proof and inspiration" with categories + captions.
 *
 * Web Demo layout: LEFT intro ("OUR GALLERY / Moments That Inspire") and a
 * RIGHT horizontal strip of five images; click opens a lightbox with the
 * high-res Gemini set.
 */
get_header();
$img_base = get_template_directory_uri() . '/assets/images/';

$gallery = get_theme_mod( 'ns_gallery_items', [
  [ 'img' => '13_gallery_kaaba.png',         'full' => 'hero/Gemini_Generated_Image_z5wcjhz5wcjhz5wc.jpg', 'caption' => 'Kaaba Shareef — the House of Allah' ],
  [ 'img' => '14_gallery_madinah.png',        'full' => 'hero/Gemini_Generated_Image_4fs1oy4fs1oy4fs1.jpg', 'caption' => 'Madinah al-Munawwarah — the Illuminated' ],
  [ 'img' => '15_gallery_desert.png',         'full' => 'hero/Gemini_Generated_Image_748qnv748qnv748q.jpg', 'caption' => 'Sacred Desert caravans' ],
  [ 'img' => '16_gallery_architecture.png',  'full' => 'hero/Gemini_Generated_Image_bc7b0vbc7b0vbc7b.jpg', 'caption' => 'Islamic geometric architecture' ],
  [ 'img' => '17_gallery_mosque.png',        'full' => 'hero/Gemini_Generated_Image_hinz7dhinz7dhinz.jpg', 'caption' => 'The Sacred Mosque' ],
] );
?>
<section class="ns-section ns-reveal">
  <div class="ns-container">
    <div class="ns-gallery-layout">
      <div class="ns-gallery-text ns-reveal" data-ns-delay="0">
        <span class="ns-gold"><?php esc_html_e( 'Our Gallery', 'noorsafar' ); ?></span>
        <div class="ns-deco-divider"></div>
        <h2 class="ns-h2"><?php esc_html_e( 'Moments That Inspire', 'noorsafar' ); ?></h2>
        <p><?php esc_html_e( 'A visual journey through sacred lands and blessed gatherings.', 'noorsafar' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="ns-btn-cta" style="margin-top:20px;"><?php esc_html_e( 'View All', 'noorsafar' ); ?></a>
      </div>

      <div class="ns-gallery-strip ns-reveal" data-ns-delay="80">
        <?php foreach ( $gallery as $i => $g ) : ?>
          <div class="ns-gallery-item ns-zoom ns-reveal" data-ns-delay="<?php echo $i*60; ?>">
            <img src="<?php echo esc_url( $img_base . $g['img'] ); ?>"
                 data-full="<?php echo esc_url( ! empty( $g['full'] ) ? $img_base . $g['full'] : $img_base . $g['img'] ); ?>"
                 alt="<?php echo esc_attr( $g['caption'] ); ?>"
                 data-caption="<?php echo esc_attr( $g['caption'] ); ?>"
                 loading="lazy">
            <span class="ns-gallery-caption"><?php echo esc_html( $g['caption'] ); ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>
