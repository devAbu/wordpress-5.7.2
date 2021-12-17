<?php
/*
Plugin Name: Homepress Demo Import
Plugin URI: https://stylemixthemes.com
Description: Homepress Demo Import plugin by StylemixThemes.
Version: 1.2.7
Author: Stylemix Themes
Author URI: https://stylemixthemes.com
*/

if ( ! defined( 'ABSPATH' ) ) exit;
define( 'HOMEPRESS_DEMO_IMPORT_VERSION', '1.2.7' );
define( 'HOMEPRESS_DEMO_IMPORT_PATH', dirname( __FILE__ ) );
define( 'HOMEPRESS_DEMO_IMPORT_FILE', __FILE__ );
define( 'HOMEPRESS_DEMO_IMPORT_URL', plugins_url( '', __FILE__ ) );
require_once __DIR__ . '/includes/autoload.php';

/**
 *  Disable uListing demo import
 */
add_filter('show_uListing_demo_import', '__return_false');