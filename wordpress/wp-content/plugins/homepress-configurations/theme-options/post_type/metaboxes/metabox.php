<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly


class STMT_Metaboxes
{

    function __construct()
    {
        add_action('add_meta_boxes', array($this, 'stmt_to_register_meta_boxes'));
        add_action('admin_enqueue_scripts', array($this, 'stmt_to_scripts'));
        add_action('save_post', array($this, 'stmt_to_save'), 10, 3);

        add_action('wp_ajax_stmt_save_title', array($this, 'stmt_save_title'));
        add_action('wp_ajax_stmt_get_image_url', 'STMT_Metaboxes::get_image_url');
        add_filter('stmt_multiselect_options_yelp_categories_list', 'STMT_Metaboxes::yelp_categories_list');
    }

    public static function yelp_categories_list()
    {
        $r = array(
            array(
                'name' => esc_html__( 'Active Life', 'homepress' ),
                'value' => 'active'
            ),array(
                'name' => esc_html__( 'Arts & Entertainment', 'homepress' ),
                'value' => 'arts'
            ),array(
                'name' => esc_html__( 'Automotive', 'homepress' ),
                'value' => 'auto'
            ),array(
                'name' => esc_html__( 'Beauty & Spas', 'homepress' ),
                'value' => 'beautysvc'
            ),array(
                'name' => esc_html__( 'Bicycles', 'homepress' ),
                'value' => 'bicycles'
            ),array(
                'name' => esc_html__( 'Education', 'homepress' ),
                'value' => 'education'
            ),array(
                'name' => esc_html__( 'Event Planning & Services', 'homepress' ),
                'value' => 'eventservices'
            ),array(
                'name' => esc_html__( 'Financial Services', 'homepress' ),
                'value' => 'financialservices'
            ),array(
                'name' => esc_html__( 'Food', 'homepress' ),
                'value' => 'food'
            ),array(
                'name' => esc_html__( 'Health & Medical', 'homepress' ),
                'value' => 'health'
            ),array(
                'name' => esc_html__( 'Home Services', 'homepress' ),
                'value' => 'homeservices'
            ),array(
                'name' => esc_html__( 'Hotels & Travel', 'homepress' ),
                'value' => 'hotelstravel'
            ),array(
                'name' => esc_html__( 'Local Flavor', 'homepress' ),
                'value' => 'localflavor'
            ),array(
                'name' => esc_html__( 'Local Services', 'homepress' ),
                'value' => 'localservices'
            ),array(
                'name' => esc_html__( 'Mass Media', 'homepress' ),
                'value' => 'massmedia'
            ),array(
                'name' => esc_html__( 'Nightlife', 'homepress' ),
                'value' => 'nightlife'
            ),array(
                'name' => esc_html__( 'Pets', 'homepress' ),
                'value' => 'pets'
            ),array(
                'name' => esc_html__( 'Professional Services', 'homepress' ),
                'value' => 'professional'
            ),array(
                'name' => esc_html__( 'Public Services & Government', 'homepress' ),
                'value' => 'publicservicesgovt'
            ),array(
                'name' => esc_html__( 'Real Estate', 'homepress' ),
                'value' => 'realestate'
            ),array(
                'name' => esc_html__( 'Religious Organizations', 'homepress' ),
                'value' => 'religiousorgs'
            ),array(
                'name' => esc_html__( 'Restaurants', 'homepress' ),
                'value' => 'restaurants'
            ),array(
                'name' => esc_html__( 'Shopping', 'homepress' ),
                'value' => 'shopping'
            ),
        );

        return $r;
    }

    function boxes()
    {
        return apply_filters('theme_options', array(
            'staff_fields_1' => array(
                'post_type' => array('stmt-staff'),
                'label' => esc_html__('Rank position', 'homepress-configurations'),
            ),
            'staff_fields_2' => array(
                'post_type' => array('stmt-staff'),
                'label' => esc_html__('Contacts', 'homepress-configurations'),
            ),
            'testimonials_fields_1' => array(
                'post_type' => array('stmt-testimonials'),
                'label' => esc_html__('Rank position', 'homepress-configurations'),
            ),
            'pages_fields' => array(
                'post_type' => array('page', 'post', 'stmt-services'),
                'label' => esc_html__('Page options', 'homepress-configurations'),
            ),
            'blog_fields' => array(
                'post_type' => array('Blog', 'post'),
                'label' => esc_html__('Blog options', 'homepress-configurations'),
            ),
            'services_fields' => array(
                'post_type' => array('stmt-services'),
                'label' => esc_html__('Services options', 'homepress-configurations'),
            ),
            'hfe_position' => array(
                'post_type' => array('elementor-hf'),
                'label' => esc_html__('Homepress additional settings for Headers only', 'homepress-configurations'),
            )
        ));
    }

    function get_users()
    {
        $users = array(
            '' => esc_html__('Choose User', 'homepress-configurations')
        );

        if (!is_admin()) return $users;

        $users_data = get_users();
        foreach ($users_data as $user) {
            $users[$user->ID] = $user->data->user_nicename;
        }

        return $users;
    }

    function fields()
    {

        //Headers
        if (defined('HFE_VER')) {
            $ehf_array = get_posts(array('post_type' => 'elementor-hf', 'posts_per_page' => -1));

            $ehf = array(
                'default' => esc_html__('Default', 'homepress-configurations'),
            );

            if ($ehf_array && !is_wp_error($ehf_array)) {
                foreach ($ehf_array as $val) {
                    $ehf[$val->ID] = $val->post_title;
                }
            }
        } else {
            $ehf = array(
                'default' => esc_html__('Please activate elementor-header-footer plugin', 'homepress-configurations'),
            );
        }

        //Sidebars
        global $wp_registered_sidebars;
        $sidebars = array(
            'global' => esc_html__('Global', 'homepress-configurations'),
            'none' => esc_html__('No sidebar', 'homepress-configurations')
        );

        foreach ($wp_registered_sidebars as $k => $val) {
            $sidebars[$val['id']] = $val['name'];
        }

        return apply_filters('theme_options', array(

            'staff_fields_1' => array(
                'section_1' => array(
                    'name' => esc_html__('Rank position', 'homepress-configurations'),
                    'fields' => array(
                        'staff_position' => array(
                            'type' => 'text',
                        ),
                    )
                ),
            ),
            'staff_fields_2' => array(
                'section_1' => array(
                    'name' => esc_html__('Contacts', 'homepress-configurations'),
                    'fields' => array(
                        'email' => array(
                            'label' => 'Email',
                            'type' => 'text',
                        ),
                        'mobile' => array(
                            'label' => 'Mobile',
                            'type' => 'text',
                        ),
                        'office' => array(
                            'label' => 'Office',
                            'type' => 'text',
                        ),
                        'fax' => array(
                            'label' => 'Fax',
                            'type' => 'text',
                        ),
                        'facebook' => array(
                            'label' => 'Facebook',
                            'type' => 'text',
                        ),
                        'twitter' => array(
                            'label' => 'Twitter',
                            'type' => 'text',
                        ),
                        'instagram' => array(
                            'label' => 'Instagram',
                            'type' => 'text',
                        ),
                        'google-plus' => array(
                            'label' => 'Google+',
                            'type' => 'text',
                        ),

                    )
                ),
            ),
            'testimonials_fields_1' => array(
                'section_1' => array(
                    'name' => esc_html__('Rank position', 'homepress-configurations'),
                    'fields' => array(
                        'testimonials_position' => array(
                            'type' => 'text',
                        ),
                    )
                ),
            ),
            'pages_fields' => array(
                'section_1' => array(
                    'name' => esc_html__('Header', 'homepress-configurations'),
                    'fields' => array(
                        'header_position' => array(
                            'type' => 'select',
                            'label' => esc_html__('Header position', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                'relative' => esc_html__('Relative', 'homepress-configurations'),
                                'absolute' => esc_html__('Absolute', 'homepress-configurations'),
                                'fixed' => esc_html__('Fixed', 'homepress-configurations')
                            ),
                            'value' => 'global',
                        ),
                        'header_id' => array(
                            'type' => 'select',
                            'label' => esc_html__('Header', 'homepress-configurations'),
                            'options' => $ehf,
                            'value' => 'default',
                        ),
                    ),
                ),
                'section_2' => array(
                    'name' => esc_html__('Title box', 'homepress-configurations'),
                    'fields' => array(
                        'title_box_style' => array(
                            'type' => 'select',
                            'label' => esc_html__('Title box style', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                'style_1' => esc_html__('Style 1', 'homepress-configurations'),
                                'style_2' => esc_html__('Style 2', 'homepress-configurations')
                            ),
                            'value' => 'global',
                        ),
                        'title_box_title' => array(
                            'type' => 'select',
                            'label' => esc_html__('Show title', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                'show' => esc_html__('Show', 'homepress-configurations'),
                                'hide' => esc_html__('Hide', 'homepress-configurations')
                            ),
                            'value' => 'global',
                            'columns' => '50'
                        ),
                        'title_box_breadcrumbs' => array(
                            'type' => 'select',
                            'label' => esc_html__('Show breadcrumbs', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                'show' => esc_html__('Show', 'homepress-configurations'),
                                'hide' => esc_html__('Hide', 'homepress-configurations')
                            ),
                            'value' => 'global',
                            'columns' => '50'
                        ),
                        'title_box_style_1_breadcrumbs_color' => array(
                            'type' => 'color',
                            'label' => esc_html__('Breadcrumbs color', 'homepress-configurations'),
                            'dependency' => array(
                                'key' => 'title_box_style',
                                'value' => 'style_1',
                            ),
                            'columns' => '50'
                        ),
                        'title_box_style_1_breadcrumbs_action_color' => array(
                            'type' => 'color',
                            'label' => esc_html__('Breadcrumbs color on action', 'homepress-configurations'),
                            'dependency' => array(
                                'key' => 'title_box_style',
                                'value' => 'style_1',
                            ),
                            'columns' => '50'
                        ),
                        'title_box_style_1_breadcrumbs_bg_color' => array(
                            'type' => 'color',
                            'label' => esc_html__('Breadcrumbs background color', 'homepress-configurations'),
                            'dependency' => array(
                                'key' => 'title_box_style',
                                'value' => 'style_1',
                            ),
                            'columns' => '50'
                        ),
                        'title_box_style_1_border_color' => array(
                            'type' => 'color',
                            'label' => esc_html__('Border color', 'homepress-configurations'),
                            'dependency' => array(
                                'key' => 'title_box_style',
                                'value' => 'style_1',
                            ),
                            'columns' => '50'
                        ),
                        'title_box_style_2_color' => array(
                            'type' => 'color',
                            'label' => esc_html__('Text color', 'homepress-configurations'),
                            'dependency' => array(
                                'key' => 'title_box_style',
                                'value' => 'style_2',
                            ),
                            'columns' => '50'
                        ),
                        'title_box_style_2_bg_color' => array(
                            'type' => 'color',
                            'label' => esc_html__('Background color', 'homepress-configurations'),
                            'dependency' => array(
                                'key' => 'title_box_style',
                                'value' => 'style_2',
                            ),
                            'columns' => '50'
                        ),
                        'title_box_style_2_bg_image' => array(
                            'type' => 'image',
                            'label' => esc_html__('Background image', 'homepress-configurations'),
                            'dependency' => array(
                                'key' => 'title_box_style',
                                'value' => 'style_2',
                            ),
                        ),
                        'title_box_style_2_breadcrumbs_color' => array(
                            'type' => 'color',
                            'label' => esc_html__('Breadcrumbs color', 'homepress-configurations'),
                            'dependency' => array(
                                'key' => 'title_box_style',
                                'value' => 'style_2',
                            ),
                            'columns' => '50'
                        ),
                        'title_box_style_2_breadcrumbs_action_color' => array(
                            'type' => 'color',
                            'label' => esc_html__('Breadcrumbs color on action', 'homepress-configurations'),
                            'dependency' => array(
                                'key' => 'title_box_style',
                                'value' => 'style_2',
                            ),
                            'columns' => '50'
                        ),
                    )
                ),
                'section_3' => array(
                    'name' => esc_html__('Sidebar', 'homepress-configurations'),
                    'fields' => array(
                        'sidebar_id' => array(
                            'type' => 'select',
                            'label' => esc_html__('Sidebar', 'homepress-configurations'),
                            'options' => $sidebars,
                            'value' => 'global',
                            'columns' => '50'
                        ),
                        'sidebar_position' => array(
                            'type' => 'select',
                            'label' => esc_html__('Sidebar Position', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                'right' => esc_html__('Right', 'homepress-configurations'),
                                'left' => esc_html__('Left', 'homepress-configurations')
                            ),
                            'value' => 'global',
                            'columns' => '50'
                        ),
                    )
                ),
                'section_4' => array(
                    'name' => esc_html__('Footer', 'homepress-configurations'),
                    'fields' => array(
                        'footer-settings' => array(
                            'type' => 'select',
                            'label' => esc_html__('Footer', 'homepress-configurations'),
                            'options' => array(
                                'show' => esc_html__('Show', 'homepress-configurations'),
                                'hide' => esc_html__('Hide', 'homepress-configurations')
                            ),
                            'value' => 'show'
                        ),
                    )
                ),
                'section_5' => array(
                    'name' => esc_html__('Page ID', 'homepress-configurations'),
                    'fields' => array(
                        'page_id' => array(
                            'type' => 'text',
                        ),
                    )
                ),
            ),
            'blog_fields' => array(
                'section_1' => array(
                    'name' => esc_html__('Blog box', 'homepress-configurations'),
                    'fields' => array(
                        'post_single_categories' => array(
                            'type' => 'select',
                            'label' => esc_html__('Show categories', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                '1' => esc_html__('Show', 'homepress-configurations'),
                                '0' => esc_html__('Hide', 'homepress-configurations')
                            ),
                            'value' => 'global',
                            'columns' => '50'
                        ),
                        'post_single_info_box' => array(
                            'type' => 'select',
                            'label' => esc_html__('Show info box', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                '1' => esc_html__('Show', 'homepress-configurations'),
                                '0' => esc_html__('Hide', 'homepress-configurations')
                            ),
                            'value' => 'global',
                            'columns' => '50'
                        ),
                        'post_single_share' => array(
                            'type' => 'select',
                            'label' => esc_html__('Show share', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                '1' => esc_html__('Show', 'homepress-configurations'),
                                '0' => esc_html__('Hide', 'homepress-configurations')
                            ),
                            'value' => 'global',
                            'columns' => '50'
                        ),
                        'post_single_excerpt' => array(
                            'type' => 'select',
                            'label' => esc_html__('Show excerpt', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                '1' => esc_html__('Show', 'homepress-configurations'),
                                '0' => esc_html__('Hide', 'homepress-configurations')
                            ),
                            'value' => 'global',
                            'columns' => '50'
                        ),
                        'post_single_thumbnail' => array(
                            'type' => 'select',
                            'label' => esc_html__('Show thumbnail', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                '1' => esc_html__('Show', 'homepress-configurations'),
                                '0' => esc_html__('Hide', 'homepress-configurations')
                            ),
                            'value' => 'global',
                            'columns' => '50'
                        ),
                        'post_single_tags' => array(
                            'type' => 'select',
                            'label' => esc_html__('Show tags', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                '1' => esc_html__('Show', 'homepress-configurations'),
                                '0' => esc_html__('Hide', 'homepress-configurations')
                            ),
                            'value' => 'global',
                            'columns' => '50'
                        ),
                        'post_single_author' => array(
                            'type' => 'select',
                            'label' => esc_html__('Show author info', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                '1' => esc_html__('Show', 'homepress-configurations'),
                                '0' => esc_html__('Hide', 'homepress-configurations')
                            ),
                            'value' => 'global',
                            'columns' => '50'
                        ),
                        'post_single_prev_next' => array(
                            'type' => 'select',
                            'label' => esc_html__('Show prev next buttons', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                '1' => esc_html__('Show', 'homepress-configurations'),
                                '0' => esc_html__('Hide', 'homepress-configurations')
                            ),
                            'value' => 'global',
                            'columns' => '50'
                        ),
                        'post_single_comments' => array(
                            'type' => 'select',
                            'label' => esc_html__('Show comments', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                '1' => esc_html__('Show', 'homepress-configurations'),
                                '0' => esc_html__('Hide', 'homepress-configurations')
                            ),
                            'value' => 'global',
                            'columns' => '50'
                        ),
                        'post_single_related_posts' => array(
                            'type' => 'select',
                            'label' => esc_html__('Related posts', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                '1' => esc_html__('Show', 'homepress-configurations'),
                                '0' => esc_html__('Hide', 'homepress-configurations')
                            ),
                            'value' => 'global',
                            'columns' => '50'
                        ),
                        'stm_post_views' => array(
                            'type' => 'text',
                            'label' => esc_html__('Views count', 'homepress-configurations')
                        ),
                    )
                ),
            ),
            'services_fields' => array(
                'section_1' => array(
                    'name' => esc_html__('Services box', 'homepress-configurations'),
                    'fields' => array(
                        'services_single_excerpt' => array(
                            'type' => 'select',
                            'label' => esc_html__('Show excerpt', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                '1' => esc_html__('Show', 'homepress-configurations'),
                                '0' => esc_html__('Hide', 'homepress-configurations')
                            ),
                            'value' => 'global',
                            'columns' => '50'
                        ),
                        'services_single_thumbnail' => array(
                            'type' => 'select',
                            'label' => esc_html__('Show thumbnail', 'homepress-configurations'),
                            'options' => array(
                                'global' => esc_html__('Global', 'homepress-configurations'),
                                '1' => esc_html__('Show', 'homepress-configurations'),
                                '0' => esc_html__('Hide', 'homepress-configurations')
                            ),
                            'value' => 'global',
                            'columns' => '50'
                        ),
                    )
                ),
            ),
            'hfe_position' => array(
                'section_1' => array(
                    'name' => esc_html__('HFE box', 'homepress-configurations'),
                    'fields' => array(
                        'hfe_header_positions' => array(
                            'type' => 'select',
                            'label' => esc_html__('Header position', 'homepress-configurations'),
                            'options' => array(
                                'relative' => esc_html__('Relative', 'homepress-configurations'),
                                'absolute' => esc_html__('Absolute', 'homepress-configurations'),
                                'fixed' => esc_html__('Fixed', 'homepress-configurations')
                            ),
                            'value' => 'relative',
                        )
                    )
                ),
            ),
        ));

    }

    function get_fields($metaboxes)
    {
        $fields = array();
        foreach ($metaboxes as $metabox_name => $metabox) {
            foreach ($metabox as $section) {
                foreach ($section['fields'] as $field_name => $field) {
                    $sanitize = (!empty($field['sanitize'])) ? $field['sanitize'] : 'stmt_to_save_field';
                    $fields[$field_name] = !empty($_POST[$field_name]) ? call_user_func(array($this, $sanitize), $_POST[$field_name], $field_name) : '';
                }
            }
        }

        return $fields;
    }

    function stmt_to_save_field($value)
    {
        return $value;
    }

    function stmt_to_save_number($value)
    {
        return intval($value);
    }

    function stmt_to_save_dates($value, $field_name)
    {
        global $post_id;

        $dates = explode(',', $value);
        if (!empty($dates) and count($dates) > 1) {
            update_post_meta($post_id, $field_name . '_start', $dates[0]);
            update_post_meta($post_id, $field_name . '_end', $dates[1]);
        }

        return $value;
    }

    function stmt_to_register_meta_boxes()
    {
        $boxes = $this->boxes();
        foreach ($boxes as $box_id => $box) {
            $box_name = $box['label'];
            add_meta_box($box_id, $box_name, array($this, 'stmt_to_display_callback'), $box['post_type'], 'normal', 'high', $this->fields());
        }
    }

    function stmt_to_display_callback($post, $metabox)
    {
        $meta = $this->convert_meta($post->ID);
        foreach ($metabox['args'] as $metabox_name => $metabox_data) {
            foreach ($metabox_data as $section_name => $section) {
                foreach ($section['fields'] as $field_name => $field) {
                    $default_value = (!empty($field['value'])) ? $field['value'] : '';
                    $value = (isset($meta[$field_name])) ? $meta[$field_name] : $default_value;
                    if (!empty($value)) {
                        switch ($field['type']) {
                            case 'dates' :
                                $value = explode(',', $value);
                                break;
                            case 'answers' :
                                $value = unserialize($value);
                                break;
                        }
                    }
                    $metabox['args'][$metabox_name][$section_name]['fields'][$field_name]['value'] = $value;
                }
            }
        }
        include STMT_TO_DIR . '/post_type/metaboxes/metabox-display.php';
    }

    function convert_meta($post_id)
    {
        $meta = get_post_meta($post_id);
        $metas = array();
        foreach ($meta as $meta_name => $meta_value) {
            $metas[$meta_name] = $meta_value[0];
        }

        return $metas;
    }

    function stmt_to_scripts($hook)
    {
        $v = time();
        $base = STMT_TO_URL . '/post_type/metaboxes/assets/';
        wp_enqueue_media();
        wp_enqueue_script('vue.js', $base . 'js/vue.min.js', array('jquery'), $v);
        wp_enqueue_script('vue-resource.js', $base . 'js/vue-resource.min.js', array('vue.js'), $v);
        wp_enqueue_script('vue2-datepicker.js', $base . 'js/vue2-datepicker.min.js', array('vue.js'), $v);
        wp_enqueue_script('vue-select.js', $base . 'js/vue-select.js', array('vue.js'), $v);
        wp_enqueue_script('vue2-editor.js', $base . 'js/vue2-editor.min.js', array('vue.js'), $v);
        wp_enqueue_script('vue-multiselect.js', $base . 'js/vue-multiselect.min.js', array('vue.js'), $v);
        wp_enqueue_script('vue2-color.js', $base . 'js/vue-color.min.js', array('vue.js'), $v);
        wp_enqueue_script('sortable.js', $base . 'js/sortable.min.js', array('vue.js'), $v);
        wp_enqueue_script('vue-draggable.js', $base . 'js/vue-draggable.min.js', array('sortable.js'), $v);
        wp_enqueue_script('stmt_to_mixins.js', $base . 'js/mixins.js', array('vue.js'), $v);
        wp_enqueue_script('stmt_to_metaboxes.js', $base . 'js/metaboxes.js', array('vue.js'), $v);

        wp_enqueue_style('vue-multiselect.css', $base . 'css/vue-multiselect.min.css', array(), $v);
        wp_enqueue_style('stmt-to-metaboxes.css', $base . 'css/main.css', array(), $v);
        //wp_enqueue_style('stmt-to-icons', STMT_TO_URL . 'assets/icons/style.css', array(), $v);
        //wp_enqueue_style('linear-icons', $base . 'css/linear-icons.css', array('stmt-to-metaboxes.css'), $v);

    }

    function stmt_to_post_types()
    {
        return apply_filters('stmt_to_post_types', array(
            'stmt-staff',
            'stmt-testimonials',
            'page',
            'post',
            'stmt-services',
            'listing',
            'elementor-hf'
        ));
    }

    function stmt_to_save($post_id, $post)
    {

        $post_type = get_post_type($post_id);

        if (!in_array($post_type, $this->stmt_to_post_types())) return;

        if (!empty($_POST) and !empty($_POST['action']) and $_POST['action'] === 'editpost') {

            $fields = $this->get_fields($this->fields());

            foreach ($fields as $field_name => $field_value) {
                update_post_meta($post_id, $field_name, $field_value);
            }
        }


    }

    function stmt_search_posts()
    {
        $r = array();

        $args = array(
            'posts_per_page' => 10,
        );

        if (!empty($_GET['s'])) {
            $args['s'] = sanitize_text_field($_GET['s']);
        }

        if (!empty($_GET['post_types'])) {
            $args['post_type'] = explode(',', sanitize_text_field($_GET['post_types']));
        }

        if (!empty($_GET['ids'])) {
            $args['post__in'] = explode(',', sanitize_text_field($_GET['ids']));
        }

        if (!empty($_GET['exclude_ids'])) {
            $args['post__not_in'] = explode(',', sanitize_text_field($_GET['exclude_ids']));
        }

        if (!empty($_GET['orderby'])) {
            $args['orderby'] = sanitize_text_field($_GET['orderby']);
        }

        $q = new WP_Query($args);
        if ($q->have_posts()) {
            while ($q->have_posts()) {
                $q->the_post();

                $response = array(
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                );

                if (in_array('stmt-questions', $args['post_type'])) {
                    $response = array_merge($response, $this->question_fields($response['id']));
                }

                $r[] = $response;
            }

            wp_reset_postdata();
        }

        $insert_sections = array();
        foreach ($args['post__in'] as $key => $post) {
            if (!is_numeric($post)) {
                $insert_sections[$key] = array('id' => $post, 'title' => $post);
            }
        }

        foreach ($insert_sections as $position => $inserted) {
            array_splice($r, $position, 0, array($inserted));
        }

        wp_send_json($r);
    }

    function get_question_fields()
    {
        return array(
            'type' => array(
                'default' => 'single_choice',
            ),
            'answers' => array(
                'default' => array(),
            ),
            'question' => array(),
            'question_explanation' => array(),
            'question_hint' => array(),
        );
    }

    function question_fields($post_id)
    {
        $fields = $this->get_question_fields();
        $meta = array();

        foreach ($fields as $field_key => $field) {
            $meta[$field_key] = get_post_meta($post_id, $field_key, true);
            $default = (isset($field['default'])) ? $field['default'] : '';
            $meta[$field_key] = (!empty($meta[$field_key])) ? $meta[$field_key] : $default;
        }

        return $meta;
    }

    function stmt_save_title()
    {
        if (empty($_GET['id']) and !empty($_GET['title'])) return false;

        $post = array(
            'ID' => intval($_GET['id']),
            'post_title' => sanitize_text_field($_GET['title']),
        );

        wp_update_post($post);

        wp_send_json($post);
    }

    public static function get_image_url()
    {
        check_ajax_referer('stmt_get_image_url', 'security');
        if (empty($_GET['image_id'])) die;
        wp_send_json(wp_get_attachment_url(intval($_GET['image_id'])));
    }
}

new STMT_Metaboxes();

function stmt_to_metaboxes_deps($field, $section_name)
{
    $dependency = '';
    if (empty($field['dependency'])) return $dependency;

    $key = $field['dependency']['key'];
    $compare = $field['dependency']['value'];

    if ($compare === 'not_empty') {
        $dependency = "v-if=data['{$section_name}']['fields']['{$key}']['value']";
    } else {
        $dependency = "v-if=\"data['{$section_name}']['fields']['{$key}']['value'] === '{$compare}'\"";
    }

    return $dependency;
}