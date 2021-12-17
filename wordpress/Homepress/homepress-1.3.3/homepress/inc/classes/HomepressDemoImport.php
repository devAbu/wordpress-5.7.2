<?php

namespace homepress\classes;

use uListing\Classes\StmListingUserRelations;

class HomepressDemoImport
{
    const SERVER_URL = 'https://homepress.stylemixthemes.com';

    public static function init()
    {
        require_once ABSPATH . 'wp-load.php';
        require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
        require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader-skin.php';
        require_once get_template_directory() . '/inc/admin/product_registration/includes/stm_upgrader_skin.php';

        StmAjaxAction::addAction('stm_theme_page_list', [self::class, 'get_theme_list']);
        StmAjaxAction::addAction('stm_theme_plugins_list', [self::class, 'get_plugins_list']);
        StmAjaxAction::addAction('stm_theme_plugins_install', [self::class, 'install_plugin']);
        StmAjaxAction::addAction('stm_theme_inventory_list', [self::class, 'get_inventory_list']);
        StmAjaxAction::addAction('stm_theme_single_page_list', [self::class, 'get_single_page_list']);
    }

    /* Get theme list */
    public static function get_theme_list()
    {
        $demo_screen_path = get_template_directory_uri() . '/inc/admin/product_registration/assets/img/home-pages';
        $result = [
            "success" => true,
            "message" => "",
            "data" => ""
        ];
        $result['data'] = [
            [
                "id" => 'studios-homepage',
                "name" => "Main Demo",
                "image" => $demo_screen_path . "/main_home_page.jpg",
            ], [
                "id" => 'home_page_default',
                "name" => "Real Estate Agency",
                "image" => $demo_screen_path . "/home_page_default.jpg",
            ], [
                "id" => 'main-demo-2',
                "name" => "Short Homepage",
                "image" => $demo_screen_path . "/main-demo-2.jpg",
            ], [
                "id" => 'home-property-slider',
                "name" => "Home Property Slider",
                "image" => $demo_screen_path . "/home-property-slider.jpg",
            ], [
                "id" => 'home-real-estate-v1',
                "name" => "Real Estate Agency v1",
                "image" => $demo_screen_path . "/home-real-estate-v1.jpg",
            ], [
                "id" => 'home-real-estate-v2',
                "name" => "Real Estate Agency v2",
                "image" => $demo_screen_path . "/home-real-estate-v2.jpg",
            ], [
                "id" => 'home-tabbed-search',
                "name" => "Property Tabbed Search",
                "image" => $demo_screen_path . "/home-tabbed-search.jpg",
            ], [
                "id" => 'home-header-dark',
                "name" => "Real Estate Listing Page Dark",
                "image" => $demo_screen_path . "/home-header-dark.jpg",
            ], [
                "id" => 'home-header-light',
                "name" => "Real Estate Listing Page Light",
                "image" => $demo_screen_path . "/home-header-light.jpg",
            ], [
                "id" => 'home-image-fullscreen',
                "name" => "Fullscreen Image Property",
                "image" => $demo_screen_path . "/home-image-fullscreen.jpg",
            ], [
                "id" => 'home-search-over-image',
                "name" => "Property Search Over Image",
                "image" => $demo_screen_path . "/home-search-over-image.jpg",
            ], [
                "id" => 'home-agent',
                "name" => "Real Estate Agent",
                "image" => $demo_screen_path . "/home-agent.jpg",
            ], [
                "id" => 'home-agent-2',
                "name" => "Real Estate Agent v2",
                "image" => $demo_screen_path . "/home-agent-2.jpg",
            ], [
                "id" => 'home-brokerage-agency',
                "name" => "Brokerage Agency",
                "image" => $demo_screen_path . "/home-brokerage-agency.jpg",
            ], [
                "id" => 'single-property-home',
                "name" => "Single Property Home",
                "image" => $demo_screen_path . "/single-property-home.jpg",
            ], [
                "id" => 'home-leads-generation',
                "name" => "Home Leads Generation",
                "image" => $demo_screen_path . "/home-leads-generation.jpg",
            ], [
                "id" => 'image-map-pro',
                "name" => "Image Map Pro",
                "image" => $demo_screen_path . "/image-map-pro.jpg",
            ]
        ];
        wp_send_json($result);
        wp_die();
    }

    /* Get plugins list */
    public static function get_plugins_list()
    {
        $demo_screen_path = get_template_directory_uri() . '/inc/admin/product_registration/assets/img/plugins';
        $result = [
            "success" => true,
            "message" => "",
            "data" => ""
        ];
        $result['data'] = [
            [
                "id" => 'homepress-demo-import',
                "name" => "HomePress Demo Import",
                "image" => $demo_screen_path . "/homepress-demo-import.png",
            ], [
                "id" => 'homepress-configurations',
                "name" => "HomePress Configurations",
                "image" => $demo_screen_path . "/homepress-configurations.png",
            ], [
                "id" => 'homepress-elementor',
                "name" => "HomePress Elementor",
                "image" => $demo_screen_path . "/homepress-elementor.png",
            ], [
                "id" => 'elementor',
                "name" => "Elementor",
                "image" => $demo_screen_path . "/elementor.png",
            ], [
                "id" => 'header-footer-elementor',
                "name" => "Header Footer Elementor",
                "image" => $demo_screen_path . "/header-footer-elementor.png",
            ], [
                "id" => 'image-map-pro-wordpress',
                "name" => "Image Map Pro WP",
                "image" => $demo_screen_path . "/homepress-configurations.png",
            ], [
                "id" => 'ulisting',
                "name" => "uListing",
                "image" => $demo_screen_path . "/ulisting.png",
            ],
            [
                "id" => 'ulisting-wishlist',
                "name" => "uListing Wishlist",
                "image" => $demo_screen_path . "/ulisting-wishlist.png",
            ],
            [
                "id" => 'ulisting-compare',
                "name" => "uListing Compare",
                "image" => $demo_screen_path . "/ulisting-compare.png",
            ],
            [
                "id" => 'revslider',
                "name" => "Revolution Slider",
                "image" => $demo_screen_path . "/revolutionslider.png",
            ],
            [
                "id" => 'mailchimp-for-wp',
                "name" => "MC4WP: Mailchimp for WordPress",
                "image" => $demo_screen_path . "/mailchimp.png",
            ],
            [
                "id" => 'contact-form-7',
                "name" => "Contact Form 7",
                "image" => $demo_screen_path . "/contact-form-7.png",
            ]
        ];
        wp_send_json($result);
        wp_die();
    }

    /* Install plugin */
    public static function install_plugin()
    {
        //Need for download and install wp plugins
        require_once ABSPATH . 'wp-admin/includes/plugin-install.php';

        $result = [
            "success" => false,
            "message" => ""
        ];

        $plugin_slug = null;
        $plugins = homepress_require_plugins(true);

        if (isset($_POST['plugin_slug']))
            $plugin_slug = sanitize_text_field($_POST['plugin_slug']);

        /*No plugin*/
        if (empty($plugin_slug) OR empty($plugins[$plugin_slug])) {
            $result['message'] = esc_html_e('Plugin not found :(', 'homepress');
            wp_send_json($result);
            exit;
        }

        $plugin_upgrader = new \Plugin_Upgrader(new \STM_Plugin_Upgrader_Skin(array('plugin' => $plugin_slug)));
        $plugin_info = $plugins[$plugin_slug];

        if (!empty($plugin_info['source'])) {
            $source = $plugin_info['source'];
        } else {
            $response = plugins_api('plugin_information', array('slug' => $plugin_slug));
            if (!is_wp_error($response) and !empty($response->download_link)) {
                $source = $response->download_link;
            }
        };

        if (!empty($source)) {
            $installed = (self::homepress_check_plugin_active($plugin_slug)) ? true : $plugin_upgrader->install($source);
            if (is_wp_error($installed)) {
                $result['message'] = $installed->get_error_message();
                wp_send_json($result);
                wp_die();
            } else {
                self::homepress_activate_plugin($plugin_slug);
                $r['installed'] = true;
                $r['activated'] = true;
                $r['plugin_slug'] = $plugin_slug;
                if ($plugin_slug === 'homepress') {
                    $r['reload'] = true;
                }
                $result['success'] = true;
            }
        }

        if ($plugin_slug == 'elementor')
            delete_transient('elementor_activation_redirect');

        if ($plugin_slug == 'ulisting')
            add_option("ulisting_demo_import_redirect", 1);

        wp_send_json($result);
        wp_die();
    }

    public static function get_inventory_list()
    {
        $demo_screen_path = get_template_directory_uri() . '/inc/admin/product_registration/assets/img/inventories';
        $result = [
            "success" => true,
            "message" => "",
            "data" => ""
        ];
        $result['data'] = [
            [
                "id" => 'ulisting_type_page_layout_0',
                "name" => "Layout 1",
                "image" => $demo_screen_path . "/ulisting_type_page_layout_0.jpg",
            ], [
                "id" => 'ulisting_type_page_layout_1',
                "name" => "Layout 2",
                "image" => $demo_screen_path . "/ulisting_type_page_layout_1.jpg",
            ], [
                "id" => 'ulisting_type_page_layout_2',
                "name" => "Layout 3",
                "image" => $demo_screen_path . "/ulisting_type_page_layout_2.jpg",
            ], [
                "id" => 'ulisting_type_page_layout_3',
                "name" => "Layout 4",
                "image" => $demo_screen_path . "/ulisting_type_page_layout_3.jpg",
            ], [
                "id" => 'ulisting_type_page_layout_4',
                "name" => "Layout 5",
                "image" => $demo_screen_path . "/ulisting_type_page_layout_4.jpg",
            ], [
                "id" => 'ulisting_type_page_layout_5',
                "name" => "Layout 6",
                "image" => $demo_screen_path . "/ulisting_type_page_layout_5.jpg",
            ], [
                "id" => 'ulisting_type_page_layout_6',
                "name" => "Layout 7",
                "image" => $demo_screen_path . "/ulisting_type_page_layout_6.jpg",
            ], [
                "id" => 'ulisting_type_page_layout_7',
                "name" => "Layout 8",
                "image" => $demo_screen_path . "/ulisting_type_page_layout_7.jpg",
            ], [
                "id" => 'ulisting_type_page_layout_8',
                "name" => "Layout 9",
                "image" => $demo_screen_path . "/ulisting_type_page_layout_8.jpg",
            ], [
                "id" => 'ulisting_type_page_layout_9',
                "name" => "Layout 10",
                "image" => $demo_screen_path . "/ulisting_type_page_layout_9.jpg",
            ]
        ];
        wp_send_json($result);
        wp_die();
    }

    public static function get_single_page_list()
    {
        $demo_screen_path = get_template_directory_uri() . '/inc/admin/product_registration/assets/img/singles';
        $result = [
            "success" => true,
            "message" => "",
            "data" => ""
        ];
        $result['data'] = [
            [
                "id" => 'layout_1',
                "name" => "Layout 1",
                "image" => $demo_screen_path . "/layout_1.jpg",
            ], [
                "id" => 'layout_2',
                "name" => "Layout 2",
                "image" => $demo_screen_path . "/layout_2.jpg",
            ], [
                "id" => 'layout_3',
                "name" => "Layout 3",
                "image" => $demo_screen_path . "/layout_3.jpg",
            ],[
                "id" => 'layout_4',
                "name" => "Layout 4",
                "image" => $demo_screen_path . "/layout_4.jpg",
            ],[
                "id" => 'layout_5',
                "name" => "Layout 5",
                "image" => $demo_screen_path . "/layout_5.jpg",
            ],[
                "id" => 'layout_6',
                "name" => "Layout 6",
                "image" => $demo_screen_path . "/layout_6.jpg",
            ],[
                "id" => 'layout_7',
                "name" => "Layout 7",
                "image" => $demo_screen_path . "/layout_7.jpg",
            ]
        ];

        self::add_user();

        wp_send_json($result);
        wp_die();
    }

    public static function homepress_activate_plugin($slug)
    {
        activate_plugin(self::homepress_get_plugin_main_path($slug));
    }

    public static function homepress_check_plugin_active($slug)
    {
        return self::homepress_active_plugin(self::homepress_get_plugin_main_path($slug));
    }

    public static function homepress_get_plugin_main_path($slug)
    {
        $plugin_data = get_plugins('/' . $slug);
        if (!empty($plugin_data)) {
            $plugin_file = array_keys($plugin_data);
            $plugin_path = $slug . '/' . $plugin_file[0];
        } else {
            $plugin_path = false;
        }
        return $plugin_path;
    }

    public static function homepress_active_plugin($plugin)
    {
        return in_array($plugin, (array)get_option('active_plugins', array())) || is_plugin_active_for_network($plugin);
    }

    public static function add_user()
    {
        if(current_user_can('manage_options')){
            $user_id = get_current_user_id();
            update_user_meta($user_id, 'facebook', '#');
            update_user_meta($user_id, 'twitter', '#');
            update_user_meta($user_id, 'instagram', '#');
            update_user_meta($user_id, 'nickname', 'SweetHome Real Estate Company');
            update_user_meta($user_id, 'phone_mobile', '(866) 123-4567');
            update_user_meta($user_id, 'phone_office', '(879) 711-2290');
            update_user_meta($user_id, 'fax', '(879) 712-2291');
            update_user_meta($user_id, 'url', 'https://stylemixthemes.com');
            update_user_meta($user_id, 'address', '10 Atlantic Ave, San Francisco, California, CA 93123, United States');
            update_user_meta($user_id, 'license', '010-0237-9457');
            update_user_meta($user_id, 'tax_number', 'HGT-92384-3434');
            update_user_meta($user_id, 'description', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
            update_user_meta($user_id, 'google_plus', '#');
            update_user_meta($user_id, 'youtube_play', '#');
            update_user_meta($user_id, 'linkedin', '#');
        }
    }
}

