<?php
if (!defined('ABSPATH')) exit;
function noorsafar_cpts(){
 register_post_type('tour',['labels'=>['name'=>'Journeys','singular_name'=>'Journey'],'public'=>true,'menu_icon'=>'dashicons-palmtree','supports'=>['title','editor','thumbnail','excerpt','page-attributes'],'has_archive'=>true,'rewrite'=>['slug'=>'tours']]);
 register_taxonomy('tour_category','tour',['labels'=>['name'=>'Journey Categories'],'public'=>true,'hierarchical'=>true,'rewrite'=>['slug'=>'journey-category']]);
 register_post_type('destination',['labels'=>['name'=>'Destinations','singular_name'=>'Destination'],'public'=>true,'menu_icon'=>'dashicons-location-alt','supports'=>['title','editor','thumbnail','excerpt'],'has_archive'=>true,'rewrite'=>['slug'=>'destinations']]);
 register_post_type('testimonial',['labels'=>['name'=>'Testimonials'],'public'=>true,'menu_icon'=>'dashicons-format-quote','supports'=>['title','editor','thumbnail']]);
 register_post_type('ns_booking',['labels'=>['name'=>'Bookings'],'public'=>false,'show_ui'=>true,'menu_icon'=>'dashicons-calendar-alt','supports'=>['title','editor','custom-fields']]);
}
add_action('init','noorsafar_cpts');
function noorsafar_seed_terms(){ if(!term_exists('Hajj','tour_category')) wp_insert_term('Hajj','tour_category',['slug'=>'hajj']); if(!term_exists('Umrah','tour_category')) wp_insert_term('Umrah','tour_category',['slug'=>'umrah']); if(!term_exists('Ziyarat','tour_category')) wp_insert_term('Ziyarat','tour_category',['slug'=>'ziyarat']);}
add_action('init','noorsafar_seed_terms',20);
