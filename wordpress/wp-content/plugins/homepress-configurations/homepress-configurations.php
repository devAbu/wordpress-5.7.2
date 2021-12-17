<?php
/**
Plugin Name: Homepress Configurations
Plugin URI: https://stylemixthemes.com/
Description: Configurations plugin.
Author: StylemixThemes
Author URI: https://stylemixthemes.com/
Text Domain: homepress-configurations
Version: 1.2.6
*/

define( 'STM_CONFIGURATIONS_VER', '1.2.6' );
define( 'STM_CONFIGURATIONS_DIR', dirname(__FILE__) );
define( 'STM_CONFIGURATIONS_PATH', plugin_basename(__FILE__) );
define( 'STM_CONFIGURATIONS_URL', plugins_url('/', __FILE__) );

if (!is_textdomain_loaded('homepress-configurations')) {
    load_plugin_textdomain(
        'homepress-configurations',
        false,
        'homepress-configurations/languages'
    );
}

require_once STM_CONFIGURATIONS_DIR . '/shares/shares.php';
require_once STM_CONFIGURATIONS_DIR . '/mortgage_calc/calc.php';
require_once STM_CONFIGURATIONS_DIR . '/yelp/yelp_nearby.php';
require_once STM_CONFIGURATIONS_DIR . '/theme-options/theme-options.php';

/*Widgets*/
require_once STM_CONFIGURATIONS_DIR . '/widgets/class-stm-nav-menu-widget.php';
require_once STM_CONFIGURATIONS_DIR . '/widgets/testimonials.php';
require_once STM_CONFIGURATIONS_DIR . '/widgets/services_cat.php';

/**
 * Crop images
 */
add_image_size( 'homepress-image-ulisting-gallery_style_1', 760, 510, true );
add_image_size( 'homepress-image-staff-760x760', 760, 760, true );
add_image_size( 'homepress-image-ulisting-gallery_thumb_style_1', 101, 101, true );
add_image_size( 'homepress-image-ulisting-gallery_style_3', 942, 603, true );
add_image_size( 'homepress-image-ulisting-gallery_thumb_style_3', 705, 450, true );
add_image_size( 'homepress-image-ulisting-gallery_thumb_style_5', 1375, 632, true );
add_image_size( 'homepress-image-ulisting-gallery_single_style_7', 1600, 660, true );
add_image_size( 'homepress-image-ulisting-locations', 540, 255, true );
add_image_size( 'homepress-image-carousel', 920, 530, true );
add_image_size( 'homepress-image-carousel-thumb', 160, 100, true );


/**
 * Add file types support
 *
 * @param $mimes
 * @return mixed
 */
function homepress_svg_mime($mimes)
{
    $mimes['ico'] = 'image/icon';
    $mimes['svg'] = 'image/svg+xml';
    $mimes['xml'] = 'application/xml';
    /*TODO delete*/
    $mimes['zip'] = 'application/zip';

    return $mimes;
}

add_filter('upload_mimes', 'homepress_svg_mime', 100);


function homepress_configurations_add_nonces()
{
    $variables = array(
        'stmt_save_settings' => wp_create_nonce( 'stmt_save_settings' ),
        'stmt_get_image_url' => wp_create_nonce( 'stmt_get_image_url' )
    );
    echo( '<script type="text/javascript">window.homepress_data = ' . json_encode( $variables ) . ';</script>' );
}

add_action( 'wp_head', 'homepress_configurations_add_nonces' );
add_action( 'admin_head', 'homepress_configurations_add_nonces' );

function check_admin()
{
    if( !current_user_can( 'administrator' ) ) {
        show_admin_bar( false );
    }
}

add_action( 'plugins_loaded', 'check_admin' );