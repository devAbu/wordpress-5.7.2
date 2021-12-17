<?php
namespace homepressWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Base_Control;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */

class ListingWishlist extends Widget_Base {

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
        return 'listing_wishlist';
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
        return __( 'Listing Wishlist', 'homepress-elementor' );
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
        return 'eicon-heart';
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
            'listing_wishlist_style',
            [
                'label' => __( 'Listing wishlist style', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Default', 'homepress-elementor' ),
                    'style_2' => __( 'Small', 'homepress-elementor' ),
                ],
                'default' => 'style_1',
            ]
        );

        $this->add_responsive_control(
            'listing_wishlist_colors',
            [
                'label' => __( 'Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'listing_wishlist_action_colors',
            [
                'label' => __( 'Color on action', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link:active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link:focus' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'listing_wishlist_frame_colors',
            [
                'label' => __( 'Frame color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link' => 'border-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'listing_wishlist_frame_action_colors',
            [
                'label' => __( 'Frame on action color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link:active' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link:focus' => 'border-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'listing_wishlist_background_color',
            [
                'label' => __( 'Background color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'listing_wishlist_frame_action_background_color',
            [
                'label' => __( 'Background on action color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link:active' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link:focus' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'listing_wishlist_frame_count_colors',
            [
                'label' => __( 'Count color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link .wishlist-total' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'listing_wishlist_frame_count_action_colors',
            [
                'label' => __( 'Count on action color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link:hover .wishlist-total' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link:active .wishlist-total' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link:focus .wishlist-total' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'listing_wishlist_frame_count_background_colors',
            [
                'label' => __( 'Count background color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link .wishlist-total' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'listing_wishlist_frame_count_background_action_colors',
            [
                'label' => __( 'Count background on action color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link:hover .wishlist-total' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link:active .wishlist-total' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting_wishlist_total_panel a.wishlist-page-link:focus .wishlist-total' => 'background-color: {{VALUE}};',
                ]
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

        $wishlist_style = $settings['listing_wishlist_style'];

        echo '<div class="ulisting_wishlist_total_panel '. $wishlist_style .'">';
        echo do_shortcode("[ulisting-wishlist-link]");
        echo '</div>';

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