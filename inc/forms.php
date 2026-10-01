<?php
if (!defined('ABSPATH')) exit;
function noorsafar_booking_shortcode(){
 ob_start(); ?>
 <form class="ns-booking-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
  <input type="hidden" name="action" value="noorsafar_booking"><input type="hidden" name="noorsafar_nonce" value="<?php echo esc_attr(wp_create_nonce('noorsafar_booking')); ?>">
  <div class="ns-form-grid"><label>Full Name<input required name="full_name" type="text"></label><label>Phone / WhatsApp<input required name="phone" type="tel"></label><label>Email<input name="email" type="email"></label><label>Journey<input name="package" type="text" placeholder="Hajj, Umrah, Ziyarat..."></label></div>
  <label>Message<textarea name="message" rows="5"></textarea></label><input class="ns-honeypot" tabindex="-1" autocomplete="off" name="website" aria-hidden="true">
  <button class="ns-btn ns-btn-gold" type="submit">Send Booking Request</button>
 </form>
 <?php return ob_get_clean();
}
add_shortcode('ns_booking','noorsafar_booking_shortcode');
function noorsafar_booking_submit(){
 if(!isset($_POST['noorsafar_nonce'])||!wp_verify_nonce($_POST['noorsafar_nonce'],'noorsafar_booking')) wp_die('Security check failed.',403);
 if(!empty($_POST['website'])) wp_die('Spam detected.',403);
 $name=sanitize_text_field(wp_unslash($_POST['full_name']??'')); $phone=sanitize_text_field(wp_unslash($_POST['phone']??'')); $email=sanitize_email(wp_unslash($_POST['email']??'')); $pkg=sanitize_text_field(wp_unslash($_POST['package']??'')); $msg=sanitize_textarea_field(wp_unslash($_POST['message']??''));
 if(!$name||!$phone) wp_die('Name and phone are required.',400);
 $id=wp_insert_post(['post_type'=>'ns_booking','post_status'=>'pending','post_title'=>$name.' — '.$pkg,'post_content'=>"Phone: $phone\nEmail: $email\nJourney: $pkg\nMessage: $msg"]);
 if(!$id) wp_die('Booking could not be saved.',500);
 wp_mail(get_option('admin_email'),'New NoorSafar booking #'.$id,"Name: $name\nPhone: $phone\nEmail: $email\nJourney: $pkg\nMessage: $msg");
 wp_safe_redirect(add_query_arg('booking','sent',wp_get_referer()?:home_url('/booking/'))); exit;
}
add_action('admin_post_noorsafar_booking','noorsafar_booking_submit'); add_action('admin_post_nopriv_noorsafar_booking','noorsafar_booking_submit');
