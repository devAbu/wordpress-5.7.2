<?php
namespace homepressWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */



class MortgageCalc extends Widget_Base {

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
        return 'homepress-mortgage-calc';
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
        return __( 'Mortgage calculator', 'homepress-elementor' );
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
        return 'eicon-archive-posts';
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
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'calc', 'mortgage' ];
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
            'main_calc_content',
            [
                'label' => __( 'Content', 'homepress-elementor' ),
            ]
        );

        $this->add_control(
            'calc_price',
            [
                'name' => 'calc_price',
                'label' => __( 'Price', 'homepress-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' =>'',
            ]
        );
        $this->add_control(
            'calc_price_color',
            [
                'label' => __( 'Price Color', 'homepress-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .calc_price' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => __( 'Price Typography', 'homepress-elementor' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .calc_price',
            ]
        );
        $this->add_control(
            'calc_sale_price',
            [
                'name' => 'calc_sale_price',
                'label' => __( 'Sale Price', 'homepress-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' =>'',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'calc_sale_price_color',
            [
                'label' => __( 'Sale Price Color', 'homepress-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .calc_sale_price' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'sale_price_typography',
                'label' => __( 'Sale Price Typography', 'homepress-elementor' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .calc_sale_price',
            ]
        );
        $this->add_control(
            'calc_price_symbol',
            [
                'name' => 'calc_price_symbol',
                'label' => __( 'Price Symbol', 'homepress-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' =>'$',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'calc_sub_title',
            [
                'name' => 'calc_sub_title',
                'label' => __( 'Sub Title', 'homepress-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' =>'Show calculator',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'calc_sub_title_color',
            [
                'label' => __( 'Sub Title Color', 'homepress-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .calc_sub_title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .calc_sub_title span' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .calc_sub_title .show_calc_btn:after' => 'border-top-color: {{VALUE}};',
                    '{{WRAPPER}} .calc_sub_title .show_calc_btn:after' => 'border-top-color: {{VALUE}}; border-bottom-color: transparent;',
                    '{{WRAPPER}} .calc_sub_title .show_calc_btn.current:after' => 'border-bottom-color: {{VALUE}}; border-top-color: transparent;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'label' => __( 'Sub Title Typography', 'homepress-elementor' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .calc_sub_title',
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

        $price = $settings['calc_price'];
        $sale_price = $settings['calc_sale_price'];
        $sub_title = $settings['calc_sub_title'];


        if( !empty( $settings['calc_price_symbol'] ) ) {
            $price_symbol = $settings['calc_price_symbol'];
        } else {
            $price_symbol = '';
        }

        if( !empty( $sale_price ) ) {
            $calc_price = $sale_price;
        } else {
            $calc_price = $price;
        }

        ?>
        <?php if( !empty( $sale_price ) || !empty( $price ) ) : ?>
        <div class="elementor_calc">
            <?php if( !empty( $sale_price ) and !empty( $price ) ) : ?>
            <div class="calc_sale_price show_calc">
                <?php
                    echo esc_attr( $price_symbol );
                    echo number_format(($sale_price/1000), 3, ',', '');
                    echo " &ndash; ";
                ?>
            </div>
            <?php endif; ?>

            <?php if( !empty( $price ) ) : ?>
            <div class="calc_price <?php if( !empty( $sale_price ) ) : ?>calc_price_stroke<?php endif; ?> show_calc">
                <?php
                    echo esc_attr( $price_symbol );
                    echo number_format(($price/1000), 3, ',', '');
                ?>
            </div>
            <?php endif; ?>

            <div class="calc_sub_title-wrap show_calc">
                <div class="calc_sub_title">
                    <div class="show_calc_btn"></div>
                    <span><?php if( !empty( $sub_title ) ) {
                        echo esc_attr( $sub_title );
                        } else {
                            echo esc_html_e( 'Show calculator', 'homepress' );
                        }
                    ?></span>
                </div>
            </div>

            <div class="calc_box">
                <?php echo do_shortcode( "[mortgage_calc price='".$calc_price."']" ); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php

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