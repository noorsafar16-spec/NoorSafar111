<?php
/**
 * footer.php — Six-column reference footer.
 *
 * Per the Web Demo review this must be a deep-emerald, six-column layout:
 *   NoorSafar | Journeys | Destinations | Resources | Company | Contact
 * Contact details are canonical (PDF p.10).
 *
 * WhatsApp +92 312 101 2277
 * Phone    +92 329 2219 787
 * Email    noorsafar16@gmail.com
 * Office   House No. 23/4, Sector 5G, Baldia Town, Saeedabad, Karachi, Pakistan
 *
 * Socials: pinterest / facebook / instagram / youtube
 */
$phone  = class_exists( 'NoorSafar_Core' ) ? preg_replace( '/[^0-9]/', '', (string) noorsafar_core()->get_setting( 'support_phone', '' ) ) : '';
$wa     = class_exists( 'NoorSafar_Core' ) ? preg_replace( '/[^0-9]/', '', (string) noorsafar_core()->get_setting( 'whatsapp_number', '' ) ) : '';
$email  = class_exists( 'NoorSafar_Core' ) ? noorsafar_core()->get_setting( 'admin_email', get_option( 'admin_email' ) ) : get_option( 'admin_email' );
$office = class_exists( 'NoorSafar_Core' ) ? noorsafar_core()->get_setting( 'office_address', '' ) : '';

$wa_display   = '+92 312 101 2277';
$phone_display = '+92 329 2219 787';
$email_display = 'noorsafar16@gmail.com';
$office_display = 'House No. 23/4, Sector 5G, Balidia Town, Saeedabad, Karachi, Pakistan';
$logo_url     = get_template_directory_uri() . '/assets/images/01_header_logo.png';
?>

<!-- Footer -->
<footer class="ns-footer">
  <div class="ns-container">
    <div class="ns-footer-grid ns-footer-6col">

      <!-- NoorSafar -->
      <div class="ns-footer-brand">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ns-logo" title="NoorSafar">
          <img src="<?php echo esc_url( $logo_url ); ?>" alt="NoorSafar — Islamic Travel & Spiritual Pilgrimage" class="ns-logo-img">
        </a>
        <p class="ns-footer-tagline"><?php esc_html_e( 'Sacred journeys. Verified faith.', 'noorsafar' ); ?></p>
        <div class="ns-footer-social">
          <a href="https://www.pinterest.com/noorsafar16/" target="_blank" rel="noopener" aria-label="Pinterest">&#128214;</a>
          <a href="https://www.facebook.com/profile.php?id=61591612406926" target="_blank" rel="noopener" aria-label="Facebook">&#128269;</a>
          <a href="https://www.instagram.com/noor843771/" target="_blank" rel="noopener" aria-label="Instagram">&#128565;</a>
          <a href="https://www.youtube.com/@noorsafar-w6r" target="_blank" rel="noopener" aria-label="YouTube">&#128246;</a>
        </div>
      </div>

      <!-- Journeys -->
      <div>
        <h4><?php esc_html_e( 'Journeys', 'noorsafar' ); ?></h4>
        <ul>
          <li><a href="<?php echo esc_url( home_url( '/hajj-packages/' ) ); ?>"><?php esc_html_e( 'Hajj Packages', 'noorsafar' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/umrah-packages/' ) ); ?>"><?php esc_html_e( 'Umrah Packages', 'noorsafar' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/ziarat/' ) ); ?>"><?php esc_html_e( 'Ziyarat Caravans', 'noorsafar' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/pakistan-tours/' ) ); ?>"><?php esc_html_e( 'Northern Pakistan Tours', 'noorsafar' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/programs/' ) ); ?>"><?php esc_html_e( 'Special Programs', 'noorsafar' ); ?></a></li>
        </ul>
      </div>

      <!-- Destinations -->
      <div>
        <h4><?php esc_html_e( 'Destinations', 'noorsafar' ); ?></h4>
        <ul>
          <li><a href="<?php echo esc_url( home_url( '/destinations/makkah/' ) ); ?>"><?php esc_html_e( 'Makkah al-Mukarramah', 'noorsafar' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/destinations/madinah/' ) ); ?>"><?php esc_html_e( 'Madinah al-Munawwarah', 'noorsafar' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/destinations/jerusalem/' ) ); ?>"><?php esc_html_e( 'Bait-ul-Muqaddas', 'noorsafar' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/destinations/karbala/' ) ); ?>"><?php esc_html_e( 'Karbala', 'noorsafar' ); ?></a></li>
        </ul>
      </div>

      <!-- Resources -->
      <div>
        <h4><?php esc_html_e( 'Resources', 'noorsafar' ); ?></h4>
        <ul>
          <li><a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>"><?php esc_html_e( 'Gallery', 'noorsafar' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Blog', 'noorsafar' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/islamic-tools/' ) ); ?>"><?php esc_html_e( 'Islamic Tools', 'noorsafar' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/prayer-times/' ) ); ?>"><?php esc_html_e( 'Prayer Times', 'noorsafar' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/fqa/' ) ); ?>"><?php esc_html_e( 'FAQs', 'noorsafar' ); ?></a></li>
        </ul>
      </div>

      <!-- Company -->
      <div>
        <h4><?php esc_html_e( 'Company', 'noorsafar' ); ?></h4>
        <ul>
          <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'noorsafar' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'noorsafar' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/careers/' ) ); ?>"><?php esc_html_e( 'Careers', 'noorsafar' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'noorsafar' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms & Conditions', 'noorsafar' ); ?></a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="ns-footer-contact">
        <h4><?php esc_html_e( 'Contact', 'noorsafar' ); ?></h4>
        <p class="ns-contact-item"><strong><?php esc_html_e( 'WhatsApp', 'noorsafar' ); ?></strong><br><?php echo esc_html( $wa_display ); ?></p>
        <p class="ns-contact-item"><strong><?php esc_html_e( 'Phone', 'noorsafar' ); ?></strong><br><?php echo esc_html( $phone_display ); ?></p>
        <p class="ns-contact-item"><strong><?php esc_html_e( 'Email', 'noorsafar' ); ?></strong><br>
          <a href="mailto:<?php echo esc_attr( $email_display ); ?>"><?php echo esc_html( $email_display ); ?></a></p>
        <p class="ns-contact-item ns-contact-addr"><?php echo esc_html( $office_display ); ?></p>
        if ( $wa ) : ?>
          <a href="<?php echo esc_url( noorsafar_whatsapp_url() ); ?>" class="ns-btn-cta" target="_blank" rel="noopener">
            <?php esc_html_e( 'Book My Journey', 'noorsafar' ); ?>
          </a>
        <?php endif; ?>
      </div>

    </div>

    <!-- Legal links + copyright -->
    <div class="ns-bottom-bar">
      <div class="ns-bottom-links">
        <div>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> NoorSafar Pilgrimage Bureau. All Rights Reserved.</div>
        <div class="ns-bottom-links-nav">
          <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'noorsafar' ); ?></a>
          <a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms & Conditions', 'noorsafar' ); ?></a>
          <a href="<?php echo esc_url( home_url( '/cancellation/' ) ); ?>"><?php esc_html_e( 'Cancellation Policy', 'noorsafar' ); ?></a>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Floating WhatsApp Action -->
<?php if ( $wa ) : ?>
  <a href="<?php echo esc_url( noorsafar_whatsapp_url() ); ?>"
     target="_blank" rel="noopener noreferrer"
     class="ns-whatsapp-float"
     title="<?php esc_attr_e( 'Contact coordinator on WhatsApp', 'noorsafar' ); ?>">&#128438;</a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
