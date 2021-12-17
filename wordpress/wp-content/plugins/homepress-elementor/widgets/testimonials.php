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



class Testimonials extends Widget_Base {

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
        return 'homepress-testimonials';
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
        return __( 'Testimonials List', 'homepress-elementor' );
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
        return 'eicon-testimonial';
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
                'label' => __( 'Content', 'homepress-elementor' ),
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
                    '12' => __( '1', 'homepress-elementor' ),
                    '6' => __( '2', 'homepress-elementor' ),
                    '3' => __( '4', 'homepress-elementor' ),
                ],
                'condition' => [
                    'show_testimonials_carousel' => [ '' ],
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

        $this->start_controls_section(
            'testimonials_carousel',
            [
                'label' => __( 'Carousel', 'homepress-elementor' ),
            ]
        );

        $this->add_responsive_control(
            'show_testimonials_carousel',
            ['label' => __( 'Carousel', 'homepress-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false,
                'default' => 'no',
            ]
        );

        //Carousel settings
        $slides_to_show = range( 1, 10 );
        $slides_to_show = array_combine( $slides_to_show, $slides_to_show );

        $this->add_control(
            'testimonials_carousel_stage',
            [
                'name' => 'text',
                'label' => __( 'Stage padding', 'homepress-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'show_testimonials_carousel' => [ 'yes' ],
                ],
                'default' => '0',
            ]
        );

        $this->add_control(
            'testimonials_carousel_loop',
            [
                'label' => __( 'Loop', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => __( 'Enable', 'homepress-elementor' ),
                    'false' => __( 'Disable', 'homepress-elementor' )
                ],
                'condition' => [
                    'show_testimonials_carousel' => [ 'yes' ],
                ],
                'default' => 'true',
            ]
        );

        $this->add_control(
            'testimonials_carousel_nav',
            [
                'label' => __( 'Arrows', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => __( 'Enable', 'homepress-elementor' ),
                    'false' => __( 'Disable', 'homepress-elementor' )
                ],
                'condition' => [
                    'show_testimonials_carousel' => [ 'yes' ],
                ],
                'default' => 'true',
            ]
        );

        $this->add_control(
            'testimonials_carousel_dots',
            [
                'label' => __( 'Dots', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => __( 'Enable', 'homepress-elementor' ),
                    'false' => __( 'Disable', 'homepress-elementor' )
                ],
                'condition' => [
                    'show_testimonials_carousel' => [ 'yes' ],
                ],
                'default' => 'false',
            ]
        );

        $this->add_control(
            'testimonials_carousel_items_count_desktop',
            [
                'label' => __( 'Items count Extra large', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'homepress-elementor' ),
                    ] + $slides_to_show,
                'condition' => [
                    'show_testimonials_carousel' => [ 'yes' ],
                ],
                'label_block' => true,
                'default' => '5',
            ]
        );

        $this->add_control(
            'testimonials_carousel_items_count_landscape',
            [
                'label' => __( 'Items count Large', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'homepress-elementor' ),
                    ] + $slides_to_show,
                'condition' => [
                    'show_testimonials_carousel' => [ 'yes' ],
                ],
                'label_block' => true,
                'default' => '4',
            ]
        );

        $this->add_control(
            'testimonials_carousel_items_count_tablet',
            [
                'label' => __( 'Items count Medium', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'homepress-elementor' ),
                    ] + $slides_to_show,
                'condition' => [
                    'show_testimonials_carousel' => [ 'yes' ],
                ],
                'label_block' => true,
                'default' => '3',
            ]
        );

        $this->add_control(
            'testimonials_carousel_items_count_mobile_landscape',
            [
                'label' => __( 'Items count Small', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'homepress-elementor' ),
                    ] + $slides_to_show,
                'condition' => [
                    'show_testimonials_carousel' => [ 'yes' ],
                ],
                'label_block' => true,
                'default' => '2',
            ]
        );

        $this->add_control(
            'testimonials_carousel_items_count_mobile',
            [
                'label' => __( 'Items count Extra small', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'homepress-elementor' ),
                    ] + $slides_to_show,
                'condition' => [
                    'show_testimonials_carousel' => [ 'yes' ],
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
        $view = $settings['show_testimonials_carousel'];
        $stage = $settings['testimonials_carousel_stage'];
        $loop = $settings['testimonials_carousel_loop'];
        $nav = $settings['testimonials_carousel_nav'];
        $dots = $settings['testimonials_carousel_dots'];
        $count_desktop = $settings['testimonials_carousel_items_count_desktop'];
        $count_landscape = $settings['testimonials_carousel_items_count_landscape'];
        $count_tablet = $settings['testimonials_carousel_items_count_tablet'];
        $count_mobile_landscape = $settings['testimonials_carousel_items_count_mobile_landscape'];
        $count_mobile = $settings['testimonials_carousel_items_count_mobile'];

        $args = array(
            'post_type'      => 'stmt-testimonials',
            'posts_per_page' => $settings['post_items_number'],
            'orderby'        => $settings['post_order_by'],
            'order'          => $settings['post_order'],
        );

        $testimonials_query = new \WP_Query( $args );

        if ( $testimonials_query->have_posts() ) : ?>

        <div class="testimonials-list testimonials-list_<?php echo esc_attr( $settings['post_style'] ); ?>">

            <div class="<?php if( $view != 'yes' ) {echo 'row';} ?> <?php if( $view == 'yes' ) { echo 'testimonials_list_carousel owl-carousel'; } ?>">
            <?php while ( $testimonials_query->have_posts() ): $testimonials_query->the_post(); ?>

                <div class="<?php if( $view != 'yes' ) { echo 'col-lg-' . $settings['post_items']; echo ' col-sm-12 col-md-6'; } ?> testimonials-item">

                    <?php get_template_part( "partials/custom-posts/testimonials/styles/{$settings['post_style']}" ); ?>

                </div>

                <?php

                endwhile;

            endif;

            // Restore original data.
            wp_reset_postdata();
            ?>

        </div>
        <?php if( $view == 'yes' ) {echo '</div>';} ?>

        <?php if( $view == 'yes' ) : ?>
            <script type="text/javascript">

                jQuery(document).ready(function($) {
                    $('.testimonials_list_carousel').each(function(){
                        $(this).owlCarousel({
                            animateOut: 'fadeOut',
                            animateIn: 'fadeIn',
                            smartSpeed: 100,
                            stagePadding: <?php echo esc_attr( $stage ); ?>,
                            margin: 0,
                            nav: <?php echo esc_attr( $nav ); ?>,
                            dots: <?php echo esc_attr( $dots ); ?>,
                            loop: <?php echo esc_attr( $loop ); ?>,
                            responsive: {
                                0: {
                                    items: <?php echo esc_attr( $count_mobile ); ?>
                                },
                                680: {
                                    items: <?php echo esc_attr( $count_mobile_landscape ); ?>
                                },
                                1024: {
                                    items: <?php echo esc_attr( $count_tablet ); ?>
                                },
                                1440: {
                                    items: <?php echo esc_attr( $count_landscape ); ?>
                                },
                                1920: {
                                    items: <?php echo esc_attr( $count_desktop ); ?>
                                }
                            },
                            navText: ['<span class="property-icon-chevron-left-2"></span>', '<span class="property-icon-chevron-right-2"></span>']
                        });
                    });
                });

            </script>

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