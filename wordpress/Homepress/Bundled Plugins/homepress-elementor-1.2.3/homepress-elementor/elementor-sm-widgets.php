<?php
/**
 * Plugin Name: Homepress Elementor
 * Description: Homepress Elementor Custom Widgets.
 * Plugin URI:  https://themeforest.net/user/stylemixthemes
 * Version:     1.2.3
 * Author:      StylemixThemes
 * Author URI:  https://themeforest.net/user/stylemixthemes
 * Text Domain: homepress-elementor
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'ELEMENTOR_SM_WIDGETS__FILE__', __FILE__ );
define( 'ELEMENTOR_SM_WIDGETS__DIR__', dirname(__FILE__));
define( 'ELEMENTOR_SM_WIDGETS__PLUGINURL__', plugins_url( '/', ELEMENTOR_SM_WIDGETS__FILE__ ) );

/**
 * Load Sm Widgets
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */
function sm_widgets_load() {
    // Load localization file
    load_plugin_textdomain( 'homepress-elementor' );

    // Notice if the Elementor is not active
    if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', 'sm_widgets_fail_load' );
        return;
    }

    // Check required version
    $elementor_version_required = '2.6.7';
    if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
        add_action( 'admin_notices', 'sm_widgets_fail_load_out_of_date' );
        return;
    }

    // Require the main plugin file
    require( __DIR__ . '/plugin.php' );
}
add_action( 'plugins_loaded', 'sm_widgets_load' );

function sm_widgets_fail_load()
{
    ?>
    <div class="notice notice-error">
        <p><?php esc_html_e( 'STM Widgets is not working because Elementor is disabled.', 'homepress-elementor' ) ?></p>
    </div>
    <?php
}

function sm_widgets_fail_load_out_of_date() {
    if ( ! current_user_can( 'update_plugins' ) ) {
        return;
    }

    $file_path = 'elementor/elementor.php';

    $upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
    $message = '<p>' . __( 'Elementor SM Widgets is not working because you are using an old version of Elementor.', 'homepress-elementor' ) . '</p>';
    $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'homepress-elementor' ) ) . '</p>';

    echo '<div class="error">' . $message . '</div>';
}

/**
 * Customize widgets
 *
 * Customize Elementor widgets.
 *
 * @custom_icons
 * @stretch_column
 * @column_responsive_controls
 * @button_icon_size
 * @accordion_active_bg
 * @menu
 */

//Custom icons
function homepress_elementor_add_custom_icons( $controls_registry ) {
    // Get existing icons
    $icons = $controls_registry->get_control( 'icon' )->get_settings( 'options' );
    // Append new icons
    $new_icons = array_merge(
        array(
            'property-icon-financing' => 'financing',
            'property-icon-furniture' => 'furniture',
            'property-icon-management' => 'management',
            'property-icon-service_certificate' => 'service certificate',
            'property-icon-service_reload' => 'service reload',
            'property-icon-add_listing_solid' => 'add listing solid',
            'property-icon-phone' => 'phone',
            'property-icon-clock' => 'clock',
            'property-icon-key' => 'key',
            'property-icon-add_listing' => 'add listing',
            'property-icon-home_for_available' => 'for available',
            'property-icon-home_for_rent' => 'for rent',
            'property-icon-home_for_sale' => 'for sale',
            'property-icon-about-blog' => 'about blog',
            'property-icon-about-contact-us' => 'about contact us',
            'property-icon-about-services' => 'about services',
            'property-icon-contact-address' => 'contact address',
            'property-icon-contact-email' => 'contact email',
            'property-icon-contact-phone' => 'contact phone',
            'property-icon-home-sale' => 'home sale',
            'property-icon-home-rent' => 'home rent',
            'property-icon-home-search' => 'home search',
            'property-icon-banner-human' => 'banner human',
            'property-icon-home-calc' => 'home calc',
            'property-icon-home-agents' => 'home agents',
            'property-icon-home-agent' => 'home agent',
            'property-icon-home-notebook' => 'home notebook',
            'property-icon-user-1' => 'user-1',
            'property-icon-user-2' => 'user-2',
        ),
        $icons
    );
    // Then we set a new list of icons as the options of the icon control
    $controls_registry->get_control( 'icon' )->set_settings( 'options', $new_icons );
}
add_action( 'elementor/controls/controls_registered', 'homepress_elementor_add_custom_icons', 10, 1 );

//Custom icons new
function homepress_elementor_add_custom_icons_new( $tabs = array() ) {

    $new_icons[ 'homepress-icons' ] = [
        'name'          => 'homepress-icons',
        'label'         => 'Homepress Icons',
        'url'           => '',
        'enqueue'       => '',
        'prefix'        => '',
        'displayPrefix' => '',
        'labelIcon'     => 'property-icon-home_for_available',
        'ver'           => '1.0.1',
        'fetchJson'     => ELEMENTOR_SM_WIDGETS__PLUGINURL__ . 'assets/icons/icons.json',
    ];

    return array_merge( $tabs, $new_icons );
}
add_action( 'elementor/icons_manager/additional_tabs', 'homepress_elementor_add_custom_icons_new', 9999999, 1 );

//Column stretch column
function function_stretch_column( $element ) {

    $element->add_control(
        'stretch_column',
        [
            'label' => __( 'Display Flex:', 'homepress-elementor' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'none',
            'options' => [
                'none' => __( 'None', 'homepress-elementor' ),
                'right' => __( 'To Right', 'homepress-elementor' ),
                'left' => __( 'To Left', 'homepress-elementor' ),
            ],
            'prefix_class' => 'stretch-to-',
            'description' => 'Block will be fully flexed to the selected side',
        ]
    );

}
add_action( 'elementor/element/column/section_advanced/before_section_end', 'function_stretch_column', 10, 2 );

//Button icon size
function function_button_icons_size( $element ) {
    $element->add_control( 'icon_size',
        [
            'label' => __( 'Icon Size', 'homepress-elementor' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 6,
                    'max' => 300,
                ],
            ],
            'condition' => [
                'icon!' => '',
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
}
add_action( 'elementor/element/button/section_style/before_section_end', 'function_button_icons_size', 10, 2 );

//Accordion active bg
function function_accordion_active_bg( $element ) {
    $element->add_control( 'active_bg',
        [
            'label' => __( 'Active Background', 'homepress-elementor' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}};',
            ],
        ]
    );
}
add_action( 'elementor/element/accordion/section_toggle_style_title/before_section_end', 'function_accordion_active_bg', 10, 2 );

//Menu
function stm_nav_menu() {
    $menus = wp_get_nav_menus();
    $items = array();
    $i     = 0;
    foreach ( $menus as $menu ) {
        if ( $i == 0 ) {
            $default = $menu->slug;
            $i ++;
        }
        $items[ $menu->slug ] = $menu->name;
    }
    return $items;
}

/*Ulisting hooks to use*/

use uListing\Classes\StmListingAttribute;
use uListing\Classes\StmListingType;
use uListing\Classes\UlistingUserRole;
use uListing\Classes\StmListing;
use uListing\Classes\StmListingTemplate;

//Users role
function user_role() {
    $user_role_list = array(esc_html__('all', 'homepress') => 'All');
    $userRole = new UlistingUserRole();
    foreach ($userRole->roles as $key => $role) {
        $user_role_list[ $key ] = $role['name'];
    }
    return $user_role_list;
}

function uListing__type(){
    $listing_type_list = [];

    $args = array(
        'post_type' => 'listing_type',
        'posts_per_page' => -1,
    );
    $ulisting_types = new \WP_Query( $args );
    $ulisting_types = $ulisting_types->posts;

    foreach ($ulisting_types as $ulisting_type) {
        $listing_type_list[ $ulisting_type->ID ] = $ulisting_type->post_title;
    }

    return $listing_type_list;
}

//Get Ulisting type
function ulisting_type() {

    $listing_type_list = array(esc_html__('select', 'homepress') => 'Select');

    $args = array(
        'post_type' => 'listing_type',
        'posts_per_page' => -1,
    );
    $ulisting_types = new \WP_Query( $args );
    $ulisting_types = $ulisting_types->posts;

    foreach ($ulisting_types as $ulisting_type) {
        $listing_type_list[ $ulisting_type->ID ] = $ulisting_type->post_title;
    }

    return $listing_type_list;
}

//Get Ulisting categories
function ulisting_categories() {
    $ulisting_categories_list = array(esc_html__('select', 'homepress') => 'Select');

    $categories = get_categories( array(
        'taxonomy' => 'listing-category',
        'hide_empty'   => 0,
    ));

    foreach ($categories as $key => $category) {
        $ulisting_categories_list[ $category->slug ] = $category->name;

    }
    return $ulisting_categories_list;
}

//Get Ulisting type attributes
function ulisting_attributes($id)
{
    $attrs = [];
    $all = StmListingAttribute::all();
    $listingType = $listingType = StmListingType::find_one(intval($id));
    $availableAttributes = $listingType->getMeta('listing_type_attribute', true);

    $all = is_array($all) ? $all : [];
    $availableAttributes = is_array($availableAttributes) ? $availableAttributes : [];

    if (count($availableAttributes) > 0 && count($all) > 0) {
        foreach ($availableAttributes as $available_key => $available_value) {
            foreach ($all as $_key => $_value) {
                if ($_value->id == $available_key) {
                    $attrs[$_value->id] = $_value->name;
                }
            }
        }
    }

    return $attrs;
}

//Get Ulisting location
function ulisting_location() {
    $ulisting_location_list = array(esc_html__('select', 'homepress') => 'Select');

    $locations = get_categories( array(
        'taxonomy' => 'listing-region',
        'hide_empty'   => 0,
    ));

    foreach ($locations as $key => $location) {
        $ulisting_location_list[ $location->slug ] = $location->name;
    }
    return $ulisting_location_list;
}
function ulisting_locations() {

    $ulisting_location_list = [];

    $locations = get_categories( array(
        'taxonomy' => 'listing-region',
        'hide_empty'   => 0,
    ));

    foreach ($locations as $key => $location) {
        $ulisting_location_list[ $location->term_id ] = $location->name;
    }
    return $ulisting_location_list;
}

//Get Ulisting single post
function ulisting_single() {

    $ulisting_single_list = array(esc_html__('select', 'homepress') => 'Select');

    $args = array(
        'post_type' => 'listing',
        'posts_per_page' => -1,
    );
    $ulisting_singles = new \WP_Query( $args );
    $ulisting_singles = $ulisting_singles->posts;

    foreach ($ulisting_singles as $ulisting_single) {
        $ulisting_single_list[ $ulisting_single->ID ] = $ulisting_single->post_title;
    }

    return $ulisting_single_list;
}

//Get Ulisting popular
function ulisting_popular($params) {
    $listing_type = null;
    if(isset($params["listing_type_id"])){
        $listing_type = \uListing\Classes\StmListingType::find_one($params["listing_type_id"]);
        if( !($listing_type = \uListing\Classes\StmListingType::find_one($params["listing_type_id"])) ) {
            $args = array(
                'meta_query'        => array(
                    array(
                        'key'       => "ulisting_import_id",
                        'value'     => $params["listing_type_id"]
                    )
                ),
                'post_status'       => 'any',
                'post_type'         => 'listing_type',
                'posts_per_page'    => '1'
            );
            $posts = get_posts( $args );
            if(isset($posts[0]) AND isset($posts[0]->ID) AND $listing_type = \uListing\Classes\StmListingType::find_one($posts[0]->ID)){
                $listing_type = $listing_type->ID;
            }
        }else
            $listing_type = $listing_type->ID;
    }
    $view_type  =  "grid";
    $item_class = "ulisting-popular-item";
    $limit      = $params["limit"];
    $listings = StmListing::get_listing([
        'listing_type' => $listing_type,
        'meta' => [
            [
               'key' => 'stm_post_views',
                'sort' => 1,
                'order_type' => "DESC"
            ]
        ],
    ],
        $limit,
        1
    );
    return StmListingTemplate::load_template(
        'listing/ulisting-popular',
        [
            "listings"   => $listings['models'],
            "view_type"  => $view_type,
            "item_class" => $item_class,
        ]
    );
}
add_shortcode( 'ulisting-popular', 'ulisting_popular' );

//Get Ulisting latest
function ulisting_latest($params) {
    global $wpdb;
    $listing_type = null;

    if(isset($params["listing_type_id"])){
        $listing_type = \uListing\Classes\StmListingType::find_one($params["listing_type_id"]);
        if( !($listing_type = \uListing\Classes\StmListingType::find_one($params["listing_type_id"])) ) {
            $args = array(
                'meta_query'        => array(
                    array(
                        'key'       => "ulisting_import_id",
                        'value'     => $params["listing_type_id"]
                    )
                ),
                'post_status'       => 'any',
                'post_type'         => 'listing_type',
                'posts_per_page'    => '1'
            );
            $posts = get_posts( $args );
            if(isset($posts[0]) AND isset($posts[0]->ID) AND $listing_type = \uListing\Classes\StmListingType::find_one($posts[0]->ID)){
                $listing_type = $listing_type->ID;
            }
        }else
            $listing_type = $listing_type->ID;
    }

    $view_type  =  "grid";
    $item_class = "ulisting-latest-item";
    $limit      = $params['limit'];
    $listings = StmListing::get_listing([
        'listing_type' => $listing_type,
        "sort" => $wpdb->prefix ."posts.post_date",
        "order_type" => "DESC"
    ],
        $limit,
        1
    );
    return StmListingTemplate::load_template(
        'listing/ulisting-latest',
        [
            "listings"   => $listings['models'],
            "view_type"  => $view_type,
            "item_class" => $item_class,
        ]
    );
}
add_shortcode( 'ulisting-latest', 'ulisting_latest' );

// EDITOR // Before the editor scripts enqueuing.
add_action( 'elementor/editor/before_enqueue_scripts', 'theme_before_editor' );

function theme_before_editor() {
    wp_enqueue_style( 'homepress-icons', plugins_url('assets/icons/homepress-icons.css', __FILE__), array(), '1.0');
}

add_action( 'elementor/frontend/after_register_styles', 'theme_after_frontend' );
function theme_after_frontend() {
    wp_register_script( 'owl-carousel', plugins_url( 'assets/js/owl-carousel.js', __FILE__), array('jquery'), '2.3.4' );
}

//Customize elementor counter widget
add_action( 'elementor/element/counter/section_counter/before_section_end', function( $element, $args ) {

    // add a control
    $element->add_control(
        'hide_prefix',
        [
            'label' => __( 'Hide Number Prefix', 'homepress-elementor' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
        ]
    );
    $element->add_control(
        'hide_suffix',
        [
            'label' => __( 'Hide Number Suffix', 'homepress-elementor' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
        ]
    );

    $element->add_responsive_control(
        'text_align',
        [
            'label' => __( 'Alignment', 'homepress-elementor' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __( 'Left', 'homepress-elementor' ),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __( 'Center', 'homepress-elementor' ),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __( 'Right', 'homepress-elementor' ),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter-number-wrapper' => 'text-align: {{VALUE}};',
                '{{WRAPPER}} .elementor-counter-title' => 'text-align: {{VALUE}};',
            ],
        ]
    );

}, 10, 2);

//Customize elementor iconbox widget
add_action( 'elementor/element/icon-box/section_icon/before_section_end', function( $element, $args ) {

    // add a control
    $element->add_control(
        'whole_link',
        [
            'label' => __( 'Link to the whole block', 'homepress-elementor' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
        ]
    );

}, 10, 2);

function before_render_content($counter)
{
    if ('counter' === $counter->get_name()) {
        $settings = $counter->get_settings();

        if ($settings['hide_prefix']) {
            $counter->add_render_attribute('_wrapper', array(
                'class' => 'hide_prefix'
            ));
        }

        if ($settings['hide_suffix']) {
            $counter->add_render_attribute('_wrapper', array(
                'class' => 'hide_suffix'
            ));
        }
    }

    if ('icon-box' === $counter->get_name()) {
        $settings = $counter->get_settings();
        if ($settings['whole_link']) {
            $counter->add_render_attribute('_wrapper', array(
                'class' => 'whole_link'
            ));
        }
    }
}
add_action('elementor/widget/before_render_content', 'before_render_content', 101);