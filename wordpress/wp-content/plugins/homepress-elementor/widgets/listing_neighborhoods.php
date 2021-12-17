<?php
namespace homepressWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use uListing\Classes\StmListingType;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */

class ListingNeighborhoods extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'listing_neighborhoods';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Neighborhoods', 'homepress-elementor' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-google-maps';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one posts.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'theme-elements' ];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'man_offices_content',
            [
                'label' => __( 'Settings', 'homepress-elementor' ),
            ]
        );

        $this->add_control(
            'listing_type_list',
            [
                'label'   => __( 'Listing type', 'homepress-elementor' ),
                'type'    => Controls_Manager::SELECT, 'options' => ulisting_type(),
                'default' => 'select',
            ]
        );

        $this->add_control(
            'listing_location_list',
            [
                'label'   => __( 'Select location', 'homepress-elementor' ),
                'type'    => Controls_Manager::SELECT2,
                'options' => ulisting_locations(),
                'multiple' => 'true',
                'default' => '',
            ]
        );

        $this->add_control(
            'listing_location_view',
            [
                'label' => __( 'View', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'grid' => __( 'Grid', 'homepress-elementor' ),
                    'ulisting_posts_carousel owl-carousel' => __( 'Carousel', 'homepress-elementor' )
                ],
                'default' => 'grid',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'listing_location_item_columns',
            [
                'label' => __( 'Number of columns', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'one_column' => __( '1 column', 'homepress-elementor' ),
                    'two_column' => __( '2 columns', 'homepress-elementor' ),
                    'three_column' => __( '3 columns', 'homepress-elementor' ),
                    'four_column' => __( '4 columns', 'homepress-elementor' ),
                    'five_column' => __( '5 columns', 'homepress-elementor' ),
                ],
                'default' => 'four_column',
                'render_type' => 'template',
                'condition' => [
                    'listing_location_view' => [ 'grid' ],
                ],
            ]
        );

        //Carousel settings
        $slides_to_show = range( 1, 10 );
        $slides_to_show = array_combine( $slides_to_show, $slides_to_show );

        $this->add_control(
            'ulisting_posts_carousel_stage',
            [
                'name' => 'text',
                'label' => __( 'Stage padding', 'homepress-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'listing_location_view' => [ 'ulisting_posts_carousel owl-carousel' ],
                ],
                'default' => '0',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_loop',
            [
                'label' => __( 'Loop', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => __( 'Enable', 'homepress-elementor' ),
                    'false' => __( 'Disable', 'homepress-elementor' )
                ],
                'condition' => [
                    'listing_location_view' => [ 'ulisting_posts_carousel owl-carousel' ],
                ],
                'default' => 'true',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_nav',
            [
                'label' => __( 'Arrows', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => __( 'Enable', 'homepress-elementor' ),
                    'false' => __( 'Disable', 'homepress-elementor' )
                ],
                'condition' => [
                    'listing_location_view' => [ 'ulisting_posts_carousel owl-carousel' ],
                ],
                'default' => 'true',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_dots',
            [
                'label' => __( 'Dots', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => __( 'Enable', 'homepress-elementor' ),
                    'false' => __( 'Disable', 'homepress-elementor' )
                ],
                'condition' => [
                    'listing_location_view' => [ 'ulisting_posts_carousel owl-carousel' ],
                ],
                'default' => 'false',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_items_count_desktop',
            [
                'label' => __( 'Items count Extra large', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'homepress-elementor' ),
                    ] + $slides_to_show,
                'condition' => [
                    'listing_location_view' => [ 'ulisting_posts_carousel owl-carousel' ],
                ],
                'label_block' => true,
                'default' => '5',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_items_count_landscape',
            [
                'label' => __( 'Items count Large', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'homepress-elementor' ),
                    ] + $slides_to_show,
                'condition' => [
                    'listing_location_view' => [ 'ulisting_posts_carousel owl-carousel' ],
                ],
                'label_block' => true,
                'default' => '4',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_items_count_tablet',
            [
                'label' => __( 'Items count Medium', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'homepress-elementor' ),
                    ] + $slides_to_show,
                'condition' => [
                    'listing_location_view' => [ 'ulisting_posts_carousel owl-carousel' ],
                ],
                'label_block' => true,
                'default' => '3',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_items_count_mobile_landscape',
            [
                'label' => __( 'Items count Small', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'homepress-elementor' ),
                    ] + $slides_to_show,
                'condition' => [
                    'listing_location_view' => [ 'ulisting_posts_carousel owl-carousel' ],
                ],
                'label_block' => true,
                'default' => '2',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_items_count_mobile',
            [
                'label' => __( 'Items count Extra small', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'homepress-elementor' ),
                    ] + $slides_to_show,
                'condition' => [
                    'listing_location_view' => [ 'ulisting_posts_carousel owl-carousel' ],
                ],
                'label_block' => true,
                'default' => '1',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings();

        $types = $settings['listing_type_list'];
        $locations = $settings['listing_location_list'];
        $view = $settings['listing_location_view'];
        if( $view == 'grid' ){
            $view = $settings['listing_location_item_columns'];
        } elseif ( $view == 'carousel' ) {
            $view = $settings['ulisting_posts_carousel owl-carousel'];
        }

        //Carousel settings
        $items_count_desktop = $settings['ulisting_posts_carousel_items_count_desktop'];
        $items_count_landscape = $settings['ulisting_posts_carousel_items_count_landscape'];
        $items_count_tablet = $settings['ulisting_posts_carousel_items_count_tablet'];
        $items_count_mobile_landscape = $settings['ulisting_posts_carousel_items_count_mobile_landscape'];
        $items_count_mobile = $settings['ulisting_posts_carousel_items_count_mobile'];
        $carousel_nav = $settings['ulisting_posts_carousel_nav'];
        $carousel_dots = $settings['ulisting_posts_carousel_dots'];
        $carousel_loop = $settings['ulisting_posts_carousel_loop'];
        $carousel_stage = $settings['ulisting_posts_carousel_stage'];

        if( $types == 'select') {
            $args = array(
                'post_type' => 'listing_type',
            );
            $ulisting_types = new \WP_Query( $args );
            $ulisting_types = $ulisting_types->posts;

            $types = $ulisting_types[0]->ID;
        } else {
            $types = $settings['listing_type_list'];
        }

        if(! empty($locations)) {
            $locations = implode( ",", $locations);
        } else {
            $locations = get_categories( array(
                'taxonomy' => 'listing-region',
                'hide_empty'   => 0,
            ));

            $ulisting_location_list = [];

            foreach ($locations as $location) {
                $ulisting_location_list[] = $location->term_id;
            }

            $locations = join( ', ', $ulisting_location_list );

        }

        echo do_shortcode("[ulisting-region-list 
            listing_type_id='". $types ."' 
            regions='$locations' 
            view='".$view."'
            carousel_stage='".$carousel_stage."'
            items_count_desktop='".$items_count_desktop."'
            items_count_landscape='".$items_count_landscape."'
            items_count_tablet='".$items_count_tablet."'
            items_count_mobile_landscape='".$items_count_mobile_landscape."'
            items_count_mobile='".$items_count_mobile."'
            carousel_nav='".$carousel_nav."'
            carousel_dots='".$carousel_dots."'
            carousel_loop='".$carousel_loop."'
        ]");
    }

    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _content_template() {

    }
}