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



class Post extends Widget_Base {

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
        return 'post';
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
        return __( 'Post', 'homepress-elementor' );
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
        return 'eicon-posts-grid';
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
            'post_style',
            [
                'label' => __( 'Post style', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'homepress-elementor' ),
                    'style_2' => __( 'Style 2', 'homepress-elementor' ),
                    'style_3' => __( 'Style 3', 'homepress-elementor' ),
                    'style_4' => __( 'Style 4', 'homepress-elementor' ),
                    'style_5' => __( 'Style 5', 'homepress-elementor' ),
                    'style_6' => __( 'Style 6', 'homepress-elementor' ),
                ],
                'default' => 'style_1',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'post_items',
            [
                'label' => __( 'Columns', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '4' => __( '3', 'homepress-elementor' ),
                    '1' => __( '12', 'homepress-elementor' ),
                    '6' => __( '2', 'homepress-elementor' ),
                    '3' => __( '4', 'homepress-elementor' ),
                ],
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'post_items_number',
            [
                'label' => __( 'Items', 'homepress-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => '6',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'post_order_by',
            [
                'label' => __( 'Order by', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'post_date',
                'options' => [
                    'post_date' => __( 'Date', 'homepress-elementor' ),
                    'title' => __( 'Title', 'homepress-elementor' ),
                    'rand' => __( 'Random', 'homepress-elementor' ),
                ],
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'post_order',
            [
                'label' => __( 'Order', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC' => __( 'DESC', 'homepress-elementor' ),
                    'ASC' => __( 'ASC', 'homepress-elementor' ),
                ],
                'render_type' => 'template',
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

        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => $settings['post_items_number'],
            'orderby'        => $settings['post_order_by'],
            'order'          => $settings['post_order'],
        );

        $q = new \WP_Query( $args );

        if ( $q->have_posts() ) : ?>

        <div class="archive-post-<?php echo esc_attr( $settings['post_style'] ); ?>">

            <div class="row">

                <?php while ($q->have_posts()) : $q->the_post(); ?>

                <div class="col-lg-<?php echo esc_attr( $settings['post_items'] ); ?> col-md-6 col-sm-12 archive-post__content">

                    <?php get_template_part( "partials/post/styles/{$settings['post_style']}" ); ?>

                </div>

                <?php

                endwhile;

            endif;

            ?>

            </div>

        </div>

        <?php
            wp_reset_postdata();
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