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

class ListingSearch extends Widget_Base {

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
        return 'listing_search';
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
        return __( 'Listing Search', 'homepress-elementor' );
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
        return 'eicon-site-search';
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
            'listing_search_sort',
            [
                'label' => __( 'Sort by', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'category' => __( 'Category', 'homepress-elementor' ),
                    'type' => __( 'Type', 'homepress-elementor' ),
                ],
                'default' => 'category',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'listing_search_style',
            [
                'label' => __( 'Listing Search style', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'homepress-elementor' ),
                    'style_2' => __( 'Style 2', 'homepress-elementor' ),
                    'style_3' => __( 'Style 3', 'homepress-elementor' ),
                    'style_4' => __( 'Style 4', 'homepress-elementor' ),
                    'style_5' => __( 'Style 5', 'homepress-elementor' ),
                ],
                'default' => 'style_1',
                'render_type' => 'template',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'listing_search_tabs_buttons',
            [
                'label' => __( 'Tabs buttons', 'homepress-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'listing_search_tabs_button_typography',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ulisting-search_box ul.nav.nav-tabs li.nav-item a.nav-link',
                'label' => __( 'Typography', 'homepress-elementor' ),
            ]
        );
        $this->add_responsive_control(
            'listing_search_tabs_button_text_color',
            [
                'label' => __( 'Text Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting-search_box ul.nav.nav-tabs li.nav-item a.nav-link' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box.ulisting-search_box_style_3 .nav-tabs li a:before' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'listing_search_tabs_button_text_color_on_action',
            [
                'label' => __( 'Text Color on action', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting-search_box ul.nav.nav-tabs li.nav-item a.nav-link:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box ul.nav.nav-tabs li.nav-item a.nav-link:active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box ul.nav.nav-tabs li.nav-item a.nav-link:focus' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'listing_search_tabs_button_text_color_on_active',
            [
                'label' => __( 'Text Color on active', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting-search_box ul.nav.nav-tabs li.nav-item a.nav-link.active' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'listing_search_tabs_button_background_color',
            [
                'label' => __( 'Background Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting-search_box ul.nav.nav-tabs li.nav-item a.nav-link' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box.ulisting-search_box_style_2 .nav-tabs li a:before' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box.ulisting-search_box_style_3 .nav-tabs li a:before' => 'border-color: {{VALUE}}; background-color: {{VALUE}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'listing_search_tabs_button_background_color_on_action',
            [
                'label' => __( 'Background Color on action', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting-search_box ul.nav.nav-tabs li.nav-item a.nav-link:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box ul.nav.nav-tabs li.nav-item a.nav-link:active' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box ul.nav.nav-tabs li.nav-item a.nav-link:focus' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box.ulisting-search_box_style_2 .nav-tabs li a:hover:before' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box.ulisting-search_box_style_2 .nav-tabs li a:active:before' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box.ulisting-search_box_style_2 .nav-tabs li a:focus:before' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box.ulisting-search_box_style_3 .nav-tabs li a:hover:before' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box.ulisting-search_box_style_3 .nav-tabs li a:active:before' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box.ulisting-search_box_style_3 .nav-tabs li a:focus:before' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'listing_search_tabs_button_background_color_on_active',
            [
                'label' => __( 'Background Color on active', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting-search_box ul.nav.nav-tabs li.nav-item a.nav-link.active' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box.ulisting-search_box_style_2 .nav-tabs li a.nav-link.active:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box.ulisting-search_box_style_3 .nav-tabs li a.nav-link.active:before' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'listing_search_tabs_button_position',
            [
                'label' => __( 'Horizontal Align', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __( 'Default', 'homepress-elementor' ),
                    'flex-start' => __( 'Start', 'homepress-elementor' ),
                    'center' => __( 'Center', 'homepress-elementor' ),
                    'flex-end' => __( 'End', 'homepress-elementor' )
                ],
                'condition' => [
                    'listing_search_style' => [ 'style_1' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ulisting-search_box ul.nav.nav-tabs' => 'justify-content: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'listing_search_tabs_content',
            [
                'label' => __( 'Tabs Content Box', 'homepress-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'listing_search_tabs_content_color',
            [
                'label' => __( 'Text Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting-search_box div.tab-content' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box div.tab-content .row .advanced-search-button .button-text' => 'border-color: {{VALUE}}; color: {{VALUE}};',
                    '{{WRAPPER}} .ulisting-search_box div.tab-content .row .advanced-search-button .button-icon' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'listing_search_tabs_content_background_color',
            [
                'label' => __( 'Background Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting-search_box div.tab-content:before' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'listing_search_style' => [ 'style_1' ],
                ],
            ]
        );
        $this->add_responsive_control(
            'listing_search_tabs_content_drop_background_color',
            [
                'label' => __( 'Dropdown Box Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ulisting-search_box div.tab-content .row .advanced-search-item-wrap .advanced-search-item:before' => 'background-color: {{VALUE}};',
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
        $asstd = $settings['listing_search_sort'];

        if( $asstd == 'category' ) {
            echo do_shortcode("[search-form-category style='" . $settings['listing_search_style'] . "' ]");
        }

        if( $asstd == 'type' ) {
            echo do_shortcode("[search-form-type style='" . $settings['listing_search_style'] . "' ]");
        }
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