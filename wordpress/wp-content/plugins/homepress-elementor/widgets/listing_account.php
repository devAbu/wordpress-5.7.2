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

class ListingAccount extends Widget_Base {

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
        return 'listing_account';
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
        return __( 'Widget account', 'homepress-elementor' );
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
        return 'eicon-lock-user';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
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
            'listing_account_style',
            [
                'label' => __( 'Listing Account style', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'homepress-elementor' ),
                    'style_2' => __( 'Style 2', 'homepress-elementor' ),
                ],
                'default' => 'style_1',
                'render_type' => 'template',
            ]
        );

        $this->add_responsive_control(
            'listing_account_colors',
            [
                'label' => __( 'Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting-account-panel-wrap .ulisting-account-panel .ulisting-account-panel-main' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-account-panel-wrap .ulisting-account-panel .ulisting-account-panel-avatar' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'listing_account_frame_color',
            [
                'label' => __( 'Frame border color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting-account-panel-wrap .ulisting-account-panel .ulisting-account-panel-avatar' => 'border-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'listing_account_frame_background_color',
            [
                'label' => __( 'Frame background color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting-account-panel-wrap .ulisting-account-panel .ulisting-account-panel-avatar' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'listing_account_icon_colors',
            [
                'label' => __( 'Icon color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting-account-panel-wrap.ulisting-account_style_2 .ulisting-account-panel .ulisting-account-panel-avatar' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'listing_account_style' => [ 'style_2' ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ulisting-account-panel-wrap .ulisting-account-panel-main',
                'label' => __( 'Description Typography', 'homepress-elementor' ),
            ]
        );

        $this->add_responsive_control(
            'hide_account_text',
            [
                'label' => __( 'Hide Text', 'homepress-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false,
                'default' => 'no',
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

        echo do_shortcode("[ulisting_account_panel style='".$settings['listing_account_style'] . ' ' . $settings['hide_account_text']."' ]");

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