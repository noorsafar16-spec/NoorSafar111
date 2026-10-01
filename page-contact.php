<?php
/**
 * page-contact.php — Contact page with map + enquiry.
 * Canonical contact (PDF p.10) hard-surfaced here for visitors.
 */
get_header();
// The phone/WhatsApp come from plugin settings (single source of truth).
$wa   = class_exists( 'NoorSafar_Core' ) ? preg_replace( '/[^0-9]/', '', (string) noorsafar_core()->get_setting( 'whatsapp_number', '923121012277' ) ) : '923121012277';
$addr = 'House No. 23/4, Sector 5G, Baldia Town, Saeedabad, Karachi, Pakistan';
?>
<section class="ns-section ns-single-v2 ns-reveal">
  <div class="ns-container">
    <div class="ns-v2-hero ns-reveal">
      <div>
        <div class="ns-v2-kicker"><?php esc_html_e( 'Get In Touch', 'noorsafar' ); ?></div>
        <h1 class="ns-h1"><?php esc_html_e( 'Contact NoorSafar', 'noorsafar' ); ?></h1>
        <p class="ns-v2-lead"><?php esc_html_e( 'Reach us on WhatsApp, phone, or email — or complete the enquiry form.', 'noorsafar' ); ?></p>
      </div>
    </div>

    <div class="ns-v2-grid ns-reveal ns-reveal-delay-1">
      <div class="ns-v2-main">
        <div class="ns-v2-panel">
          <h2><?php esc_html_e( 'Contact Details', 'noorsafar' ); ?></h2>
          <dl class="ns-v2-details">
            <div><dt><?php esc_html_e( 'WhatsApp', 'noorsafar' ); ?></dt><dd><a href="<?php echo esc_url( noorsafar_whatsapp_url() ); ?>" target="_blank" rel="noopener">WhatsApp +92 312 101 2277</a></dd></div>
            <div><dt><?php esc_html_e( 'Phone', 'noorsafar' ); ?></dt><dd>+92 329 2219 787</dd></div>
            <div><dt><?php esc_html_e( 'Email', 'noorsafar' ); ?></dt><dd><a href="mailto:noorsafar16@gmail.com">noorsafar16@gmail.com</a></dd></div>
            <div><dt><?php esc_html_e( 'Office', 'noorsafar' ); ?></dt><dd><?php echo esc_html( $addr ); ?></dd></div>
          </dl>

          <h2 style="margin-top:28px;"><?php esc_html_e( 'Office Map', 'noorsafar' ); ?></h2>
          <div style="border-radius:var(--ns-radius);overflow:hidden;height:320px;background:rgba(13,69,56,0.12);display:flex;align-items:center;justify-content:center;font-style:italic;color:var(--ns-text-2);">
            <?php esc_html_e( 'Interactive map embeds once coordinates are confirmed in admin.', 'noorsafar' ); ?>
          </div>
        </div>
      </div>

      <aside class="ns-v2-side ns-v2-sticky">
        <div class="ns-v2-panel">
          <h2><?php esc_html_e( 'Quick Enquiry', 'noorsafar' ); ?></h2>
          <?php echo do_shortcode( '[ns_booking]' ); ?>
        </div>
      </aside>
    </div>
  </div>
</section>
<?php get_footer(); ?>