<?php
/**
 * functions.php — NoorSafar Theme v3.0
 * Loads the /inc/ modular includes per the approved architecture (PDF §5/12).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/inc/setup.php';
require_once __DIR__ . '/inc/enqueue.php';
require_once __DIR__ . '/inc/customizer.php';
require_once __DIR__ . '/inc/custom-post-types.php';
require_once __DIR__ . '/inc/taxonomies.php';
require_once __DIR__ . '/inc/meta-fields.php';
require_once __DIR__ . '/inc/forms.php';
require_once __DIR__ . '/inc/prayer-times.php';
require_once __DIR__ . '/inc/seo-schema.php';
require_once __DIR__ . '/inc/security.php';
require_once __DIR__ . '/inc/seed-demo-content.php';
