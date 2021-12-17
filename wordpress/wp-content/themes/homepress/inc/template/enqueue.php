<?php

function homepress_scripts()
{

    $script_vars = homepress_scripts_vars();
    $jquery = array('jquery');

	/*Styles*/
	wp_enqueue_style('homepress-style', get_stylesheet_uri());
    wp_enqueue_style('select2', "{$script_vars['css']}select2.min.css", array(), $script_vars['v']);
    wp_enqueue_style('owl-carousel', "{$script_vars['css']}owl.carousel.min.css", array(), $script_vars['v']);
    wp_enqueue_style('homepress-app-style', "{$script_vars['css']}style.css", array(), $script_vars['v']);

    if (get_the_ID() === 0) {
        wp_enqueue_script('bootstrap3', get_template_directory_uri() . '/assets/js/bootstrap3.js', $jquery, null, true);
    }

    /* IDX styles */
    if ( !empty( homepress_get_option('load_style_idxbroker') )) {
        wp_enqueue_style('idx_broker', get_template_directory_uri() . '/assets/css/idx_styles/idx_broker_stm.css');
    }
    if ( !empty( homepress_get_option('load_style_ihomefinder') )) {
        wp_enqueue_style('idx_ihomefinder', get_template_directory_uri() . '/assets/css/idx_styles/idx_ihomefinder_stm.css');
    }

	//Fonts
	wp_enqueue_style('homepress-google-fonts', homepress_google_fonts());
    wp_enqueue_style('homepress-linear-icons', "{$script_vars['linear_icons']}linear-icons.css", array(), $script_vars['v']);
    wp_enqueue_style('homepress-icons', "{$script_vars['homepress_icons']}homepress-icons.css", array(), $script_vars['v']);

	/*Scripts*/
    wp_enqueue_script('select2', "{$script_vars['js']}select2.full.min.js", $jquery, $script_vars['v'], true);
    wp_enqueue_script('inventory', "{$script_vars['js']}inventory.js", $jquery, $script_vars['v'], true);
    wp_enqueue_script('homepress-app', "{$script_vars['js']}app.js", $jquery, $script_vars['v'], true);
    if(defined('HFE_DIR')) {
        wp_enqueue_script('stm-hfe', "{$script_vars['js']}stm-hfe.js", $jquery, $script_vars['v'], 'all');
    }
	/*Theme Options Custom Styles*/
	$upload = wp_upload_dir();
	$baseurl = $upload['baseurl'] . '/stm_configurations_styles';
	wp_enqueue_style('homepress-app-style-custom', "{$baseurl}/styles.css", array(), get_option('stm_theme_styles_v', 1));

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

    /*JS modules*/
    $js_modules = array(
        'owl-carousel',
        'ulisting/frontend/stm-login-register',
        'ulisting/ulisting_posts_carousel/style_1',
        'ulisting/ulisting_posts_carousel/style_2',
        'ulisting/single/gallery/style_1',
        'ulisting/single/gallery/style_3',
        'ulisting/single/gallery/style_5',
        'ulisting/single/gallery/style_6',
        'ulisting/single/item-meta/style_1',
        'ulisting/single/mortgage_calc/mortgage_calc',
        'ulisting/single/mortgage_calc/calc_link',
        'ulisting/single/item-meta/floor_plans',
        'ulisting/property_slider/style_1',
    );

    $js_modules_path = $script_vars['js'];

    foreach ($js_modules as $js_module) {
        wp_register_script(
            $js_module,$js_modules_path . $js_module . '.js', $jquery, $script_vars['v'], true
        );
    }

    homepress_add_post_meta_styles();

}
add_action('wp_enqueue_scripts', 'homepress_scripts');

function homepress_admin_styles() {
    $script_vars = homepress_scripts_vars();
    wp_enqueue_style('homepress-icons', "{$script_vars['homepress_icons']}homepress-icons.css", array(), $script_vars['v']);
}
add_action('admin_enqueue_scripts', 'homepress_admin_styles');

function homepress_scripts_vars() {
	$vars = array();
	$url = get_template_directory_uri() . '/assets/';

	global $theme_info;
	$theme_info = wp_get_theme();

	$vars['linear_icons'] = "{$url}icons/linearicons/";
	$vars['homepress_icons'] = "{$url}icons/homepress/";
	$vars['css'] = "{$url}css/";
	$vars['js'] = "{$url}js/";
	$vars['v'] = ( WP_DEBUG ) ? time() : $theme_info->get( 'Version' );

	return $vars;
}

add_action( 'wp_default_scripts', 'homepress_move_jquery_into_footer' );

function homepress_move_jquery_into_footer( $wp_scripts ) {

	if( is_admin() ) {
		return;
	}

	$wp_scripts->add_data( 'jquery', 'group', 1 );
	$wp_scripts->add_data( 'jquery-core', 'group', 1 );
	$wp_scripts->add_data( 'jquery-migrate', 'group', 1 );
}

function homepress_google_fonts() {
	$fonts_url = '';
	$enable_google_fonts = _x('on', 'Main font: on or off', 'homepress');

    $settings = get_option('stmt_to_settings', array());
    /*Default Headings font-family*/
    $ffs = array();

    $weights = apply_filters('homepress_font_weight', '300,400,400i,500,600,700,800,900');
    if(!empty($settings['default_header_font_family'])) $ffs[] = "{$settings['default_header_font_family']}:{$weights}";

    $typo = array(
        'body', 'h1, .h1', 'h2, .h2', 'h3, .h3', 'h4, .h4', 'h5, .h5', 'h6, .h6'
    );

    foreach($typo as $setting) {
        if(empty($settings[$setting])) continue;
        $data = json_decode($settings[$setting], true);
        if(!empty($data['font-family'])) $ffs[] = "{$data['font-family']}:{$weights}";
    }

    $subsets = apply_filters('homepress_font_subset', 'latin,latin-ext');

    $query_args = array(
        'family' => urlencode(implode('|', array_unique($ffs))),
        'subset' => urlencode($subsets)
    );

    $fonts_url = (!empty($ffs)) ? add_query_arg($query_args, 'https://fonts.googleapis.com/css') : '';

	return esc_url($fonts_url);

}
add_action('init', 'homepress_google_fonts');

function homepress_add_post_meta_styles() {
    ob_start();
    get_template_part('inc/admin/css/post_meta_css/title-box');
    wp_add_inline_style('homepress-app-style', ob_get_clean());
}