<?php
if (!defined('ABSPATH')) exit;
function noorsafar_prayer_shortcode(){
 $times=['Fajr'=>'05:00','Sunrise'=>'06:20','Dhuhr'=>'12:15','Asr'=>'15:45','Maghrib'=>'18:05','Isha'=>'19:25'];
 ob_start(); echo '<div class="ns-prayer-grid">';
 foreach($times as $n=>$t) echo '<div class="ns-prayer-card"><span>'.esc_html($n).'</span><strong>'.esc_html($t).'</strong></div>';
 echo '</div><p class="ns-note">Prayer times are a display framework. Connect your chosen prayer-time provider in production for live location-based calculations.</p>';
 return ob_get_clean();
}
add_shortcode('ns_prayer_times','noorsafar_prayer_shortcode');
