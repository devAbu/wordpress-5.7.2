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



class Services extends Widget_Base {

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
        return 'homepress-services';
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
        return __( 'Services', 'homepress-elementor' );
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
        return 'eicon-wrench';
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
        return [ 'info box', 'info' ];
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
            'man_services_content',
            [
                'label' => __( 'Content', 'homepress-elementor' ),
            ]
        );

        $this->add_control(
            'services_columns',
            [
                'label' => __( 'Number of columns', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '1' => __( 'One', 'homepress-elementor' ),
                    '2' => __( 'Two', 'homepress-elementor' ),
                    '3' => __( 'Three', 'homepress-elementor' ),
                    '4' => __( 'Four', 'homepress-elementor' ),
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'services_per_page',
            [
                'label' => __( 'Per Page', 'homepress-elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
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

        $per_page = $settings['services_per_page'];
        $column = $settings['services_columns'];

        $args = array(
            'post_type'      => 'stmt-services',
            'posts_per_page' => $per_page
        );

        $services = new \WP_Query( $args );

        if ( $services->have_posts() ) : ?>

        <div class="elementor-services">

            <div class="row">

            <?php while ( $services->have_posts() ): $services->the_post(); ?>

            <div class="services-column services-column-<?php echo esc_attr( $column ); ?>">

                <div class="elementor-services_content">

                    <?php if( has_post_thumbnail() ) { ?>
                    <div class="services-thumbnail">
                        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail('homepress-image-services-archive'); ?>
                        </a>
                    </div>
                    <?php } ?>

                    <div class="services-title">
                        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                            <h3><?php echo get_the_title(); ?></h3>
                        </a>
                    </div>

                </div>

            </div>

            <?php endwhile;

            wp_reset_postdata();

            ?>
            </div>
        </div>

        <?php else: ?>

        <?php get_template_part( 'partials/content', 'none' ); ?>

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



