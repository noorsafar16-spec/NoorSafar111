<?php
if (!defined('ABSPATH')) exit;
function noorsafar_setup(){
 load_theme_textdomain('noorsafar', NOORSAFAR_DIR.'/languages');
 add_theme_support('title-tag'); add_theme_support('post-thumbnails'); add_theme_support('custom-logo');
 add_theme_support('html5',['search-form','gallery','caption','style','script']);
 add_theme_support('automatic-feed-links'); add_theme_support('responsive-embeds');
 register_nav_menus(['primary'=>'Primary Navigation','footer'=>'Footer Navigation']);
}
add_action('after_setup_theme','noorsafar_setup');
function noorsafar_seed_pages(){
 $pages=[
  'about'=>'About NoorSafar','hajj-packages'=>'Hajj Packages','umrah-packages'=>'Umrah Packages',
  'destinations'=>'Sacred Destinations','gallery'=>'Gallery','ziarat'=>'Ziyarat',
  'booking'=>'Book My Journey','islamic-tools'=>'Islamic Tools','contact'=>'Contact NoorSafar',
  'blog'=>'Blog','privacy-policy'=>'Privacy Policy','terms'=>'Terms & Conditions','cancellation'=>'Cancellation Policy',
  'tours'=>'Journeys','pakistan-tours'=>'Northern Pakistan Tours','programs'=>'Special Programs'
 ];
 foreach($pages as $slug=>$title){
  if(!get_page_by_path($slug)) wp_insert_post(['post_title'=>$title,'post_name'=>$slug,'post_status'=>'publish','post_type'=>'page']);
 }
}
add_action('after_switch_theme','noorsafar_seed_pages');
function noorsafar_whatsapp_url($message=''){ $n=preg_replace('/\D+/','',get_theme_mod('ns_whatsapp','923121012277')); return 'https://wa.me/'.$n.($message?'?text='.rawurlencode($message):''); }
