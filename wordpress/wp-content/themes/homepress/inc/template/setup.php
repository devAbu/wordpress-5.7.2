<?php
if (!function_exists('homepress_setup')) :
	function homepress_setup()
	{

		load_theme_textdomain('homepress', get_template_directory() . '/languages');

		add_theme_support('automatic-feed-links');

		add_theme_support('title-tag');

		add_theme_support('post-thumbnails');

		register_nav_menus(array(
			'menu-header' => esc_html__('Header menu', 'homepress'),
			'menu-footer' => esc_html__('Footer menu', 'homepress'),
		));

		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );

	}
endif;

add_action('after_setup_theme', 'homepress_setup');


function homepress_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Primary sidebar', 'homepress'),
		'id'            => 'primary-sidebar',
		'description'   => esc_html__('Add widgets here.', 'homepress'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Secondary sidebar', 'homepress'),
		'id'            => 'secondary-sidebar',
		'description'   => esc_html__('Add widgets here.', 'homepress'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

    register_sidebar(array(
        'name'          => esc_html__('IDXBroker sidebar', 'homepress'),
        'id'            => 'idxbroker-sidebar',
        'description'   => esc_html__('Add widgets here.', 'homepress'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('iHomefinder sidebar', 'homepress'),
        'id'            => 'ihomefinder-sidebar',
        'description'   => esc_html__('Add widgets here.', 'homepress'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

}

add_action('widgets_init', 'homepress_widgets_init');

add_action( 'homepress_theme_content_imported', function () {
    if ( empty( get_option( 'stmt_to_settings', '' ) ) ) {
        $themeoptions_json = '{"body_settings":"","body_background_color":"rgba(255,255,255,1)","content_max_width":"1140px","header_settings":"","header_position":"relative","sidebar_settings":"","sidebar_id":"primary-sidebar","sidebar_position":"right","account_settings":"","account_form_id":"3610","yelp_settings":"","yelp_api":"kJltjjAcZLdVJz87_2su0Rz7rp2gC3YbuR7wFpFTBJza-6nIxpPWmhQvBrPuafZD_Bx22TRRbV6kWsyW_649GssJF5a0XLNtbML5Wn87pDia9ztxS-DzTnbtkqS-XHYx","yelp_categories_list_limit":"4","yelp_categories_list":"[{\"name\":\"Food\",\"value\":\"food\"},{\"name\":\"Education\",\"value\":\"education\"},{\"name\":\"Home Services\",\"value\":\"homeservices\"}]","yelp_categories_sort":"distance","yelp_categories_cache":"true","primary_color":"rgba(48,52,65,1)","secondary_color":"rgba(35,77,212,1)","third_color":"rgba(67,195,112,1)","button_text_color":"rgba(255,255,255,1)","button_text_color_action":"rgba(255,255,255,1)","button_background_color":"rgba(35,77,212,1)","button_background_color_action":"rgba(67,195,112,1)","links_color":"rgba(53,142,225,1)","links_color_action":"rgba(35,77,212,1)","body":"{\"selectors\":\"body, .normal-font\",\"font-family\":\"Open Sans\",\"color\":\"rgba(34,34,34,1)\",\"font-size\":\"15px\",\"line-height\":\"28px\",\"font-weight\":\"400\"}","default_header_font_family":"Raleway","default_header_font_color":"rgba(48,52,65,1)","h1, .h1":"{\"margin_top\":\"\",\"margin_bottom\":\"24px\",\"font-size\":\"44px\",\"line-height\":\"50px\",\"font-weight\":\"700\",\"letter-spacing\":\"-0.5px\",\"font-family\":\"\"}","h2, .h2":"{\"font-size\":\"42px\",\"font-weight\":\"600\",\"line-height\":\"50px\",\"letter-spacing\":\"-0.25px\",\"margin_bottom\":\"20px\"}","h3, .h3":"{\"font-size\":\"36px\",\"font-weight\":\"600\",\"letter-spacing\":\"-0.2px\",\"line-height\":\"44px\",\"margin_bottom\":\"20px\"}","h4, .h4":"{\"font-size\":\"30px\",\"font-weight\":\"600\",\"letter-spacing\":\"-0.15px\",\"line-height\":\"38px\",\"margin_bottom\":\"20px\"}","h5, .h5":"{\"font-size\":\"24px\",\"font-weight\":\"600\",\"line-height\":\"32px\",\"letter-spacing\":\"-0.1px\",\"margin_bottom\":\"20px\"}","h6, .h6":"{\"font-size\":\"18px\",\"font-weight\":\"600\",\"letter-spacing\":\"0px\",\"line-height\":\"26px\",\"margin_bottom\":\"20px\"}","title_box_title":true,"title_box_breadcrumbs":true,"title_box_style":"style_1","title_box_style_1":"","title_box_style_1_breadcrumbs_color":"rgba(136,136,136,0.8)","title_box_style_1_breadcrumbs_action_color":"rgba(136,136,136,1)","title_box_style_1_breadcrumbs_bg_color":"","title_box_style_1_border_color":"","title_box_style_2":"","title_box_style_2_color":"rgba(255,255,255,1)","title_box_style_2_bg_color":"rgba(129,82,82,1)","title_box_style_2_bg_image":3032,"title_box_style_2_breadcrumbs_color":"rgba(255,255,255,0.75)","title_box_style_2_breadcrumbs_action_color":"rgba(255,255,255,1)","post_settings":"","post_sidebar_id":"global","post_sidebar_position":"right","post_archive_style":"style_1","post_single_style":"style_1","post_single_categories":true,"post_single_info_box":true,"post_single_share":true,"post_single_excerpt":true,"post_single_thumbnail":true,"post_single_tags":true,"post_single_author":true,"post_single_prev_next":true,"post_single_comments":true,"post_single_related_posts":"true","services_settings":"","services_sidebar_id":"secondary-sidebar","services_sidebar_position":"right","services_archive_style":"style_1","services_single_style":"style_1","services_single_thumbnail":"true","services_single_excerpt":"true","footer_main_bg_color":"","footer_main_links_color":"","footer_main_text_color":"","footer_main_links_action_color":"","copyright":"<a href=\"https:\/\/stylemixthemes.com\/\">StylemixThemes<\/a>. All rights reserved.","copyright_symbol":true,"copyright_current_year":true,"copyright_bg_color":"","copyright_links_color":"rgba(255,255,255,1)","copyright_text_color":"","copyright_links_action_color":"","idx_options":"","load_style_idxbroker":"","page_style_idxbroker":"left_sidebar","load_style_ihomefinder":"","page_style_ihomefinder":"right_sidebar","virtual_page_hf_settings":"","virtual_page_header":"1733"}';
        $homepage_id = get_option('page_on_front', '');
        if(!empty($homepage_id)){
            $homepage = get_post($homepage_id);
            if(!empty($homepage) && ($homepage->post_name === 'studios-homepage' || $homepage->post_name === 'main-demo-2')){
                $themeoptions_json = '{"body_settings":"","body_background_color":"rgba(255,255,255,1)","content_max_width":"1140px","enable_preloader":"","header_settings":"","header_position":"relative","buttons_settings":"","buttons_border_radius":"4","buttons_text_transform":"none","buttons_font_weight":"400","buttons_font_size":"16","buttons_line_height":"18","sidebar_settings":"","sidebar_id":"primary-sidebar","sidebar_position":"right","account_settings":"","account_form_id":"7725","yelp_settings":"","yelp_api":"jkER7Nqmj18b7oVH-3LH3zBB48WKjI7qohRVY3AmfV2GJGrfdMVMlTvV_C32Uf0jjBWUpk2LDexPkD8lmzcGj4Kw7OCs-lGul5SPwNU824R0SxUuLcNls4dnD0e9XHYx","yelp_categories_list_limit":"4","yelp_categories_list":"[{\"name\":\"Food\",\"value\":\"food\"},{\"name\":\"Education\",\"value\":\"education\"},{\"name\":\"Home Services\",\"value\":\"homeservices\"}]","yelp_categories_sort":"distance","yelp_categories_cache":"true","primary_color":"rgba(48,52,65,1)","secondary_color":"rgba(75,133,240,1)","third_color":"rgba(50,104,204,1)","button_text_color":"rgba(255,255,255,1)","button_text_color_action":"rgba(255,255,255,1)","button_background_color":"rgba(75,133,240,1)","button_background_color_action":"rgba(50,104,204,1)","links_color":"rgba(75,133,240,1)","links_color_action":"rgba(75,133,240,1)","body":"{\"selectors\":\"body, .normal-font\",\"font-family\":\"Roboto\",\"color\":\"rgba(34,34,34,1)\",\"font-size\":\"16px\",\"line-height\":\"24px\",\"font-weight\":\"400\"}","default_header_font_family":"Roboto","default_header_font_color":"rgba(48,52,65,1)","h1, .h1":"{\"margin_top\":\"\",\"margin_bottom\":\"24px\",\"font-size\":\"50px\",\"line-height\":\"65px\",\"font-weight\":\"400\",\"letter-spacing\":\"\",\"font-family\":\"\"}","h2, .h2":"{\"font-size\":\"40px\",\"font-weight\":\"400\",\"line-height\":\"50px\",\"letter-spacing\":\"\",\"margin_bottom\":\"20px\"}","h3, .h3":"{\"font-size\":\"30px\",\"font-weight\":\"400\",\"letter-spacing\":\"\",\"line-height\":\"44px\",\"margin_bottom\":\"20px\"}","h4, .h4":"{\"font-size\":\"28px\",\"font-weight\":\"400\",\"letter-spacing\":\"\",\"line-height\":\"36px\",\"margin_bottom\":\"20px\"}","h5, .h5":"{\"font-size\":\"24px\",\"font-weight\":\"400\",\"line-height\":\"32px\",\"letter-spacing\":\"\",\"margin_bottom\":\"20px\"}","h6, .h6":"{\"font-size\":\"18px\",\"font-weight\":\"400\",\"letter-spacing\":\"0px\",\"line-height\":\"26px\",\"margin_bottom\":\"20px\"}","title_box_title":true,"title_box_breadcrumbs":true,"title_box_style":"style_1","title_box_style_1":"","title_box_style_1_breadcrumbs_color":"rgba(136,136,136,0.8)","title_box_style_1_breadcrumbs_action_color":"rgba(136,136,136,1)","title_box_style_1_breadcrumbs_bg_color":"","title_box_style_1_border_color":"","title_box_style_2":"","title_box_style_2_color":"rgba(255,255,255,1)","title_box_style_2_bg_color":"rgba(129,82,82,1)","title_box_style_2_bg_image":3032,"title_box_style_2_breadcrumbs_color":"rgba(255,255,255,0.75)","title_box_style_2_breadcrumbs_action_color":"rgba(255,255,255,1)","post_settings":"","post_sidebar_id":"global","post_sidebar_position":"right","post_archive_style":"style_1","post_single_style":"style_1","post_single_categories":true,"post_single_info_box":true,"post_single_share":true,"post_single_excerpt":true,"post_single_thumbnail":true,"post_single_tags":true,"post_single_author":true,"post_single_prev_next":true,"post_single_comments":true,"post_single_related_posts":"true","services_settings":"","services_sidebar_id":"secondary-sidebar","services_sidebar_position":"right","services_archive_style":"style_1","services_single_style":"style_1","services_single_thumbnail":"true","services_single_excerpt":"true","footer_main_bg_color":"","footer_main_links_color":"","footer_main_text_color":"","footer_main_links_action_color":"","copyright":"<a href=\"https:\/\/stylemixthemes.com\/\">StylemixThemes<\/a>. All rights reserved.","copyright_symbol":true,"copyright_current_year":true,"copyright_bg_color":"","copyright_links_color":"rgba(255,255,255,1)","copyright_text_color":"","copyright_links_action_color":"","idx_options":"","load_style_idxbroker":"","page_style_idxbroker":"left_sidebar","load_style_ihomefinder":"","page_style_ihomefinder":"right_sidebar","virtual_page_hf_settings":"","virtual_page_header":"1733"}';
            }
        }
        $options = json_decode( $themeoptions_json, true );
        update_option( 'stmt_to_settings', $options );
    }
} );