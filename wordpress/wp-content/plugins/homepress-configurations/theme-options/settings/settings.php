<?php

class STMT_TO_Settings
{

    private static $typography_fonts = array();
    private static $themeOptions = array();

	function __construct()
	{
        self::stmt_to_get_settings();
        self::set_typography_fonts();

        add_action( 'admin_menu', array( $this, 'stmt_to_settings_page' ), 1000 );
		add_action( 'wp_ajax_stmt_save_settings', array( $this, 'stmt_save_settings' ) );

		add_action( 'wp_ajax_stmt_get_settings', array( $this, 'get_settings' ) );

	}

	function stmt_to_settings_page()
	{
		add_menu_page(
			'Theme Options',
			'Theme Options',
			'manage_options',
			'stmt-to-settings',
			array( $this, 'stmt_to_settings_page_view' ),
			'dashicons-welcome-learn-more',
			4
		);
	}

	public static function stmt_get_post_type_array( $post_type, $args = array() ) {
		$r = array(
			'' => esc_html__( 'Choose Page', 'homepress-configurations' ),
		);

		$default_args = array(
			'post_type' => $post_type,
			'posts_per_page' => -1,
			'post_status' => 'publish'
		);

		$q = get_posts( wp_parse_args( $args, $default_args) );

		if(!empty( $q) ) {
			foreach ( $q as $post_data) {
				$r[$post_data->ID] = $post_data->post_title;
			}
		}

		wp_reset_query();

		return $r;
	}

	function stmt_to_settings() {

        //Headers
        if ( defined( 'HFE_VER' ) ) {
            $ehf_array = get_posts( array( 'post_type' => 'elementor-hf', 'posts_per_page' => - 1 ) );

            $ehf = array(
                'global' => esc_html__( 'Global', 'homepress-configurations' ),
            );

            if ( $ehf_array && ! is_wp_error( $ehf_array ) ) {
                foreach ( $ehf_array as $val ) {
                    $ehf[$val->ID] = $val->post_title;
                }
            }

            wp_reset_query();
            wp_reset_postdata();
        }

	    //Sidebars
	    global $wp_registered_sidebars;
        $sidebars = array( '' => esc_html__( 'No Sidebar', 'homepress-configurations' ) );
        $post_types_sidebars = array(
            'global' => esc_html__( 'Global', 'homepress-configurations' ),
            'hide' => esc_html__( 'No Sidebar', 'homepress-configurations' )
        );

		foreach ( $wp_registered_sidebars as $k => $val ) {
            $sidebars[$val['id']] = $val['name'];
            $post_types_sidebars[$val['id']] = $val['name'];
        }

        $sidebarPosition = array(
            'left' => esc_html__( 'Left', 'homepress-configurations' ),
            'right' => esc_html__( 'Right', 'homepress-configurations' )
        );
        $post_types_sidebarPosition = array(
            'global' => esc_html__( 'Global', 'homepress-configurations' ),
            'left' => esc_html__( 'Left', 'homepress-configurations' ),
            'right' => esc_html__( 'Right', 'homepress-configurations' )
        );


        //Contact Forms
        $cf7Forms = array( 'post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1 );
        $contactForms = array();
        if( $data = get_posts( $cf7Forms ) ) {
            foreach ( $data as $key ) {
                $contactForms[ $key->ID ] = $key->post_title;
            }
        }

        $args_el_hf = array(
            'post_type'=> 'elementor-hf',
            'numberposts' => -1,
        );
        $el_hf_raw = get_posts($args_el_hf);
        $el_hf_options = [];
        foreach ( $el_hf_raw as $key=>$value ) {
            $el_hf_options[ $value->ID ] = $value->post_title;
        }

        wp_reset_query();
        wp_reset_postdata();

		return apply_filters( 'stmt_to_settings', array(
			'id' => 'stmt_to_settings',
			'args' => array(
				'stmt_to_settings' => array(
                    'section_1' => array(
                        'name' => esc_html__( 'General', 'homepress-configurations' ),
                        'fields' => array(
                            'body_settings' => array(
                                'type' => 'separator',
                                'label' => esc_html__( 'Body', 'homepress-configurations' ),
                            ),
                            'body_background_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Body background color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'content_max_width' => array(
                                'type' => 'text',
                                'label' => esc_html__( 'Content Max Width', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'enable_preloader' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Enable Preloader', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'header_settings' => array(
                                'type' => 'separator',
                                'label' => esc_html__( 'Header', 'homepress-configurations' ),
                            ),
                            'header_position' => array(
                                'type' => 'select',
                                'label' => esc_html__('Header position', 'homepress-configurations'),
                                'options' => array(
                                    'relative' => esc_html__('Relative', 'homepress-configurations'),
                                    'absolute' => esc_html__('Absolute', 'homepress-configurations'),
                                    'fixed' => esc_html__('Fixed', 'homepress-configurations')
                                ),
                                'value' => 'header_position_relative'
                            ),
                            'buttons_settings' => array(
                                'type' => 'separator',
                                'label' => esc_html__( 'Buttons', 'homepress-configurations' ),
                            ),
                            'buttons_border_radius' => array(
                                'type' => 'number',
                                'label' => esc_html__( 'Border radius (in px)', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'buttons_text_transform' => array(
                                'type' => 'select',
                                'label' => esc_html__( 'Text transform', 'homepress-configurations' ),
                                'columns' => '50',
                                'options' => array(
                                    'none' => 'Normal',
                                    'uppercase' =>'Uppercase',
                                    'lowercase' => 'Lowercase',
                                    'capitalize' => 'Capitalize'
                                ),
                                'value' => 'uppercase'
                            ),
                            'buttons_font_weight' => array(
                                'type' => 'select',
                                'label' => esc_html__( 'Font weight', 'homepress-configurations' ),
                                'columns' => '50',
                                'options' => array(
                                    '100' => esc_html__( 'Thin', 'homepress-configurations' ),
                                    '300' => esc_html__( 'Light', 'homepress-configurations' ),
                                    '400' => esc_html__( 'Regular', 'homepress-configurations' ),
                                    '500' => esc_html__( 'Medium', 'homepress-configurations' ),
                                    '600' => esc_html__( 'Semi-Bold', 'homepress-configurations' ),
                                    '700' => esc_html__( 'Bold', 'homepress-configurations' ),
                                    '900' => esc_html__( 'Black', 'homepress-configurations' ),
                                ),
                                'value' => '600'
                            ),
                            'buttons_font_size' => array(
                                'type' => 'number',
                                'label' => esc_html__( 'Font size (in px)', 'homepress-configurations' ),
                                'columns' => '50',
                                'value' => '13'
                            ),
                            'buttons_line_height' => array(
                                'type' => 'number',
                                'label' => esc_html__( 'Line height (in px)', 'homepress-configurations' ),
                                'columns' => '50',
                                'value' => '18'
                            ),
                            'sidebar_settings' => array(
                                'type' => 'separator',
                                'label' => esc_html__( 'Sidebar', 'homepress-configurations' ),
                            ),
                            'sidebar_id' => array(
                                'type' => 'select',
                                'label' => esc_html__( 'Select sidebar', 'homepress-configurations' ),
                                'options' => $sidebars,
                                'value' => 'posts-sidebar',
                                'columns' => '50'
                            ),
                            'sidebar_position' => array(
                                'type' => 'select',
                                'label' => esc_html__( 'Sidebar Position', 'homepress-configurations' ),
                                'options' => $sidebarPosition,
                                'value' => 'right',
                                'columns' => '50'
                            ),
                            'account_settings' => array(
                                'type' => 'separator',
                                'label' => esc_html__( 'Account', 'homepress-configurations' ),
                            ),
                            'account_form_id' => array(
                                'type' => 'select',
                                'label' => esc_html__( 'Select Contact Form', 'homepress-configurations' ),
                                'options' => $contactForms,
                                'value' => '3610',
                                'columns' => '50'
                            ),
                            'yelp_settings' => array(
                                'type' => 'separator',
                                'label' => esc_html__( 'Yelp Nearby settings', 'homepress-configurations' ),
                            ),
                            'yelp_api' => array(
                                'type' => 'text',
                                'label' => esc_html__( 'API Key', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'yelp_categories_list_limit' => array(
                                'type' => 'text',
                                'label' => esc_html__( 'Limit', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'yelp_categories_list' => array(
                                'type' => 'multiselect',
                                'label' => esc_html__( 'Categories', 'homepress-configurations' ),
                                'options' => 'yelp_categories_list',
                                'columns' => '50'
                            ),
                            'yelp_categories_sort' => array(
                                'type' => 'select',
                                'label' => esc_html__( 'Sort by', 'homepress-configurations' ),
                                'options' => array(
                                    'best_match' => esc_html__( 'Best match', 'homepress-configurations' ),
                                    'rating' => esc_html__( 'Rating', 'homepress-configurations' ),
                                    'review_count' => esc_html__( 'Review count', 'homepress-configurations' ),
                                    'distance' => esc_html__( 'Distance', 'homepress-configurations' ),
                                ),
                                'value' => 'best_match',
                                'columns' => '50'
                            ),
                            'yelp_categories_cache' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Caching', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                        )
                    ),
					'section_2' => array(
						'name' => esc_html__( 'Colors', 'homepress-configurations' ),
						'fields' => array(
							'primary_color' => array(
								'type' => 'color',
								'label' => esc_html__( 'Primary color', 'homepress-configurations' ),
								'columns' => '50'
							),
							'secondary_color' => array(
								'type' => 'color',
								'label' => esc_html__( 'Secondary color', 'homepress-configurations' ),
								'columns' => '50'
							),
							'third_color' => array(
								'type' => 'color',
								'label' => esc_html__( 'Third color', 'homepress-configurations' ),
								'columns' => '50'
							),
                            'button_text_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Button text color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'button_text_color_action' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Button text color on action', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'button_background_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Button background color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'button_background_color_action' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Button background color on action', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'links_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Links color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'links_color_action' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Links color on action', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
						)
					),
					'section_3' => array(
						'name' => esc_html__( 'Typography', 'homepress-configurations' ),
						'fields' => array(
                            'body' => array(
                                'type' => 'typography',
                                'label' => esc_html__( 'Body Font', 'homepress-configurations' ),
                                'selector' => 'body, .normal-font',
                            ),
                            'default_header_font_family' => array (
                                'type' => 'select',
                                'label' => esc_html__( 'Default Headings Font Family', 'homepress-configurations' ),
                                'options' => stmt_get_google_fonts()
                            ),
                            'default_header_font_color' => array (
                                'type' => 'color',
                                'label' => esc_html__( 'Default Headings Font Color', 'homepress-configurations' ),
                            ),
                            'h1, .h1' => array (
                                'type' => 'typography',
                                'show_margins' => true,
                                'label' => esc_html__( 'H1', 'homepress-configurations' ),
                            ),
                            'h2, .h2' => array (
                                'type' => 'typography',
                                'show_margins' => true,
                                'label' => esc_html__( 'H2', 'homepress-configurations' ),
                            ),
                            'h3, .h3' => array (
                                'type' => 'typography',
                                'show_margins' => true,
                                'label' => esc_html__( 'H3', 'homepress-configurations' ),
                            ),
                            'h4, .h4' => array (
                                'type' => 'typography',
                                'show_margins' => true,
                                'label' => esc_html__( 'H4', 'homepress-configurations' ),
                            ),
                            'h5, .h5' => array (
                                'type' => 'typography',
                                'show_margins' => true,
                                'label' => esc_html__( 'H5', 'homepress-configurations' ),
                            ),
                            'h6, .h6' => array (
                                'type' => 'typography',
                                'show_margins' => true,
                                'label' => esc_html__( 'H6', 'homepress-configurations' ),
                            ),
						)
					),
                    'section_4_1' => array(
                        'name' => esc_html__( 'Title box', 'homepress-configurations' ),
                        'fields' => array(
                            'title_box_title' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Show title', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'title_box_breadcrumbs' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Show breadcrumbs', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'title_box_style' => array(
                                'type' => 'select',
                                'label' => esc_html__( 'Default title box style', 'homepress-configurations' ),
                                'options' => array(
                                    'style_1' => esc_html__( 'Style 1', 'homepress-configurations' ),
                                    'style_2' => esc_html__( 'Style 2', 'homepress-configurations' )
                                ),
                                'value' => 'style_1'
                            ),
                            'title_box_style_1' => array(
                                'type' => 'separator',
                                'label' => esc_html__( 'Style 1 settings:', 'homepress-configurations' ),
                            ),
                            'title_box_style_1_breadcrumbs_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Breadcrumbs color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'title_box_style_1_breadcrumbs_action_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Breadcrumbs color on action', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'title_box_style_1_breadcrumbs_bg_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Breadcrumbs background color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'title_box_style_1_border_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Border color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'title_box_style_2' => array(
                                'type' => 'separator',
                                'label' => esc_html__( 'Style 2 settings:', 'homepress-configurations' ),
                            ),
                            'title_box_style_2_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Text color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'title_box_style_2_bg_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Background color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'title_box_style_2_bg_image' => array(
                                'type' => 'image',
                                'label' => esc_html__( 'Background image', 'homepress-configurations' ),
                            ),
                            'title_box_style_2_breadcrumbs_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Breadcrumbs color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'title_box_style_2_breadcrumbs_action_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Breadcrumbs color on action', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                        )
                    ),
                    'section_5' => array(
                        'name' => esc_html__( 'Post types', 'homepress-configurations' ),
                        'fields' => array(
                            'post_settings' => array(
                                'type' => 'separator',
                                'label' => esc_html__( 'Blog', 'homepress-configurations' ),
                            ),
                            'post_sidebar_id' => array(
                                'type' => 'select',
                                'label' => esc_html__( 'Sidebar', 'homepress-configurations' ),
                                'options' => $post_types_sidebars,
                                'value' => 'global',
                                'columns' => '50'
                            ),
                            'post_sidebar_position' => array(
                                'type' => 'select',
                                'label' => esc_html__( 'Sidebar Position', 'homepress-configurations' ),
                                'options' => $post_types_sidebarPosition,
                                'value' => 'global',
                                'columns' => '50'
                            ),
                            'post_archive_style' => array(
                                'type' => 'select',
                                'label' => esc_html__( 'Archive Style', 'homepress-configurations' ),
                                'options' => array(
                                    'style_1' => esc_html__( 'Style 1', 'homepress-configurations' ),
                                    'style_2' => esc_html__( 'Style 2', 'homepress-configurations' ),
                                    'style_3' => esc_html__( 'Style 3', 'homepress-configurations' ),
                                    'style_4' => esc_html__( 'Style 4', 'homepress-configurations' )
                                ),
                                'value' => 'style_1'
                            ),
                            'post_single_style' => array(
                                'type' => 'select',
                                'label' => esc_html__( 'Single Page Style', 'homepress-configurations' ),
                                'options' => array(
                                    'style_1' => esc_html__( 'Style 1', 'homepress-configurations' )
                                ),
                                'value' => 'style_1'
                            ),
                            'post_single_categories' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Show categories', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'post_single_info_box' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Show info box', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'post_single_share' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Show share', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'post_single_excerpt' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Show excerpt', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'post_single_thumbnail' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Show thumbnail', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'post_single_tags' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Show tags', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'post_single_author' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Show author info', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'post_single_prev_next' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Show prev next buttons', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'post_single_comments' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Show comments', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'post_single_related_posts' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Related posts', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'services_settings' => array(
                                'type' => 'separator',
                                'label' => esc_html__( 'Services', 'homepress-configurations' ),
                            ),
                            'services_sidebar_id' => array(
                                'type' => 'select',
                                'label' => esc_html__( 'Sidebar', 'homepress-configurations' ),
                                'options' => $post_types_sidebars,
                                'value' => 'global',
                                'columns' => '50'
                            ),
                            'services_sidebar_position' => array(
                                'type' => 'select',
                                'label' => esc_html__( 'Sidebar Position', 'homepress-configurations' ),
                                'options' => $post_types_sidebarPosition,
                                'value' => 'global',
                                'columns' => '50'
                            ),
                            'services_archive_style' => array(
                                'type' => 'select',
                                'label' => esc_html__( 'Archive Style', 'homepress-configurations' ),
                                'options' => array(
                                    'style_1' => esc_html__( 'Style 1', 'homepress-configurations' ),
                                ),
                                'value' => 'style_1'
                            ),
                            'services_single_style' => array(
                                'type' => 'select',
                                'label' => esc_html__( 'Single Style', 'homepress-configurations' ),
                                'options' => array(
                                    'style_1' => esc_html__( 'Style 1', 'homepress-configurations' ),
                                ),
                                'value' => 'style_1'
                            ),
                            'services_single_thumbnail' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Show thumbnail', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'services_single_excerpt' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Show excerpt', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                        )
                    ),
                    'section_6' => array(
                        'name' => esc_html__( 'Footer', 'homepress-configurations' ),
                        'fields' => array(
                            'footer_main_bg_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Footer background color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'footer_main_links_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Footer links color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'footer_main_text_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Footer text color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'footer_main_links_action_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Footer links color on action', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'copyright' => array(
                                'type' => 'text',
                                'label' => esc_html__( 'Copyright', 'homepress-configurations' ),
                            ),
                            'copyright_symbol' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Show copyright symbol', 'homepress-configurations' ),
                            ),
                            'copyright_current_year' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Show current year', 'homepress-configurations' ),
                            ),
                            'copyright_bg_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Copyright background color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'copyright_links_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Copyright links color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'copyright_text_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Copyright text color', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'copyright_links_action_color' => array(
                                'type' => 'color',
                                'label' => esc_html__( 'Copyright links color on action', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                        )
                    ),
                    'section_7' => array(
                        'name' => esc_html__( 'IDX Pages', 'homepress-configurations' ),
                        'fields' => array(
                            'idx_options' => array(
                                'type' => 'separator',
                                'label' => esc_html__( 'IDX Integrations (IDX Plugin inherit Homepress theme styles)', 'homepress-configurations' ),
                            ),
                            'load_style_idxbroker' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Load IDXBroker Style', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'page_style_idxbroker' => array(
                                'type' => 'select',
                                'label' => esc_html__('IDXBroker Page Template', 'homepress-configurations'),
                                'options' => array(
                                    'full_width' => esc_html__('Full width', 'homepress-configurations'),
                                    'left_sidebar' => esc_html__('Left Sidebar', 'homepress-configurations'),
                                    'right_sidebar' => esc_html__('Right Sidebar', 'homepress-configurations'),
                                ),
                                'value' => 'with_sidebar',
                                'columns' => '50'
                            ),
                            'load_style_ihomefinder' => array(
                                'type' => 'checkbox',
                                'label' => esc_html__( 'Load iHomefinder Style', 'homepress-configurations' ),
                                'columns' => '50'
                            ),
                            'page_style_ihomefinder' => array(
                                'type' => 'select',
                                'label' => esc_html__('iHomefinder Page Template', 'homepress-configurations'),
                                'options' => array(
                                    'full_width' => esc_html__('Full width', 'homepress-configurations'),
                                    'left_sidebar' => esc_html__('Left Sidebar', 'homepress-configurations'),
                                    'right_sidebar' => esc_html__('Right Sidebar', 'homepress-configurations'),
                                ),
                                'value' => 'with_sidebar',
                                'columns' => '50'
                            ),
                            'virtual_page_hf_settings' => array(
                                'type' => 'separator',
                                'label' => esc_html__( 'Virtual page Elementor header', 'homepress-configurations' ),
                            ),
                            'virtual_page_header' => array(
                                'type' => 'select',
                                'label' => esc_html__('Header Template', 'homepress-configurations'),
                                'options' => $el_hf_options,
                                'value' => '',
                                'columns' => '50'
                            )
                        )
                    ),
				)
			)
		) );
	}

	function stmt_to_get_settings() {
        self::$themeOptions = get_option( 'stmt_to_settings', array() );
		return self::$themeOptions;
	}

	private static function set_typography_fonts() {
        $to = self::$themeOptions;

        if(isset( $to['default_header_font_family'] ) && !empty( $to['default_header_font_family'] ) ) self::$typography_fonts[] = $to['default_header_font_family'];

        foreach ( $to as $k => $val ) {
            $setting = json_decode( $val );
            if(!is_null( $setting ) && is_object( $setting ) ) {
                foreach ( $setting as $key => $value) {
                    $key = str_replace( '"', '', $key);
                    if( $key == 'font-family' ) self::$typography_fonts[] = $value;
                }
            }
        }
    }

	function stmt_to_settings_page_view()
	{
		$metabox = $this->stmt_to_settings();
		$settings = $this->stmt_to_get_settings();

		foreach( $metabox['args']['stmt_to_settings'] as $section_name => $section ) {
			foreach( $section['fields'] as $field_name => $field) {
				$default_value = (!empty( $field['value'] ) ) ? $field['value'] : '';
				$metabox['args']['stmt_to_settings'][$section_name]['fields'][$field_name]['value'] = (!empty( $settings[$field_name] ) ) ? $settings[$field_name] : $default_value;
			}
		}
		require_once(STMT_TO_DIR . '/settings/view/main.php' );
	}

	function stmt_save_settings() {
        check_ajax_referer('stmt_save_settings', 'security');
		if(empty( $_REQUEST['name'] ) ) die;
		$id = sanitize_text_field( $_REQUEST['name'] );
		$settings = array();
		$request_body = file_get_contents( 'php://input' );
		if(!empty( $request_body ) ) {
			$request_body = json_decode( $request_body, true );
			foreach( $request_body as $section_name => $section ) {
				foreach( $section['fields'] as $field_name => $field ) {
					$settings[$field_name] = $field['value'];
				}
			}
		}

		$update = update_option( $id, $settings );
        self::stmt_to_get_settings();

        do_action( 'stmt_set_custom_color' );

        do_action( 'configurations_styles' );

		wp_send_json( $update );
	}

	function get_settings() {
		$option = sanitize_text_field( $_GET['option_name'] );
		wp_send_json( get_option( $option, array() ) );
	}

}

new STMT_TO_Settings;