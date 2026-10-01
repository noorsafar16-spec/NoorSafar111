<?php
if (!defined('ABSPATH')) exit;
function noorsafar_customize($c){
 $c->add_section('noorsafar_brand',['title'=>'NoorSafar Settings','priority'=>30]);
 foreach([['ns_whatsapp','WhatsApp Number','923121012277'],['ns_phone','Phone','923292219787'],['ns_email','Email','noorsafar16@gmail.com'],['ns_tagline','Hero Tagline','Light of the Journey']] as $x){$c->add_setting($x[0],['default'=>$x[2],'sanitize_callback'=>'sanitize_text_field']);$c->add_control($x[0],['section'=>'noorsafar_brand','label'=>$x[1],'type'=>'text']);}
}
add_action('customize_register','noorsafar_customize');
