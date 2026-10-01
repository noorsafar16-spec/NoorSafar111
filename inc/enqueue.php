<?php
if (!defined('ABSPATH')) exit;
function noorsafar_assets(){
 wp_enqueue_style('noorsafar-fonts','https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap',[],null);
 wp_enqueue_style('noorsafar-design',NOORSAFAR_URI.'/assets/css/noorsafar-design.css',[],NOORSAFAR_VERSION);
 if(is_rtl()) wp_enqueue_style('noorsafar-rtl',NOORSAFAR_URI.'/assets/css/noorsafar-rtl.css',['noorsafar-design'],NOORSAFAR_VERSION);
 wp_enqueue_script('noorsafar-theme',NOORSAFAR_URI.'/assets/js/theme.js',[],NOORSAFAR_VERSION,true);
 wp_localize_script('noorsafar-theme','NoorSafarConfig',['ajax'=>admin_url('admin-ajax.php'),'nonce'=>wp_create_nonce('noorsafar_booking'),'home'=>home_url('/')]);
}
add_action('wp_enqueue_scripts','noorsafar_assets');
