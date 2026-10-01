<?php
if (!defined('ABSPATH')) exit;
function noorsafar_schema(){
 if(is_admin()) return;
 $data=['@context'=>'https://schema.org','@type'=>'TravelAgency','name'=>'NoorSafar','url'=>home_url('/'),'email'=>'noorsafar16@gmail.com','telephone'=>'+92 329 2219 787','sameAs'=>['https://www.facebook.com/profile.php?id=61591612406926','https://www.instagram.com/noor843771/','https://www.youtube.com/@noorsafar-w6r','https://www.pinterest.com/noorsafar16/']];
 echo '<script type="application/ld+json">'.wp_json_encode($data,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
}
add_action('wp_head','noorsafar_schema',20);
