<?php
if (!defined('ABSPATH')) exit;
function noorsafar_meta_box(){ add_meta_box('ns_package_meta','NoorSafar Journey Settings','noorsafar_meta_html','tour','normal','high'); }
add_action('add_meta_boxes','noorsafar_meta_box');
function noorsafar_meta_html($post){
 wp_nonce_field('ns_meta_save','ns_meta_nonce');
 $fields=['status'=>'Price Status','price'=>'Published Price','currency'=>'Currency','duration'=>'Duration','capacity'=>'Seat Capacity'];
 foreach($fields as $k=>$label){$v=get_post_meta($post->ID,'ns_'.$k,true); echo '<p><label><strong>'.esc_html($label).'</strong><br><input class="widefat" name="ns_'.$k.'" value="'.esc_attr($v).'"></label></p>';}
 echo '<p><small>Use status values: Draft, Coming Soon, Price Not Set, Contact for Price, Available.</small></p>';
}
function noorsafar_meta_save($post_id){
 if(!isset($_POST['ns_meta_nonce'])||!wp_verify_nonce($_POST['ns_meta_nonce'],'ns_meta_save')||defined('DOING_AUTOSAVE')) return;
 if(!current_user_can('edit_post',$post_id)) return;
 foreach(['status','price','currency','duration','capacity'] as $k) if(isset($_POST['ns_'.$k])) update_post_meta($post_id,'ns_'.$k,sanitize_text_field(wp_unslash($_POST['ns_'.$k])));
}
add_action('save_post_tour','noorsafar_meta_save');
