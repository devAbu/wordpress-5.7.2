<?php
namespace homepressWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

wp_enqueue_script( 'owl-carousel' );
wp_enqueue_style( 'image_carousel_style_1', plugins_url( '../assets/image_gallery/style_1/style.css', __FILE__) );
wp_enqueue_script( 'image_carousel_style_1', plugins_url( '../assets/image_gallery/style_1/script.js', __FILE__), array('jquery') );

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */



class ImageCarousel extends Widget_Base {

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
        return 'homepress-image-carousel';
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
        return __( 'Image Carousel', 'homepress-elementor' );
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
        return 'eicon-image';
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
        return [ 'image carousel', 'carousel' ];
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
            'man_image_carousel_content',
            [
                'label' => __( 'Content', 'homepress-elementor' ),
            ]
        );

        $this->add_control(
            'carousel',
            [
                'label' => __( 'Add Images', 'homepress-elementor' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
                'show_label' => false,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'carousel_style',
            [
                'label' => __( 'View style', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => [
                    'style_1' => __( 'Style 1', 'homepress-elementor' ),
                ],
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

        if ( empty( $settings['carousel'] ) ) {
            return;
        }

    ?>

    <div id="image_carousel_full" class="owl-carousel owl-theme">
        <?php foreach ( $settings['carousel'] as $index => $attachment ) :
            $image_url_full = wp_get_attachment_image_src( $attachment[ 'id' ], 'full', $settings );
            $image_url = wp_get_attachment_image_src( $attachment[ 'id' ], 'homepress-image-carousel', $settings );
        ?>

        <div class="item">
            <a target="_blank" href="<?php echo esc_url( $image_url_full[0] ); ?>" data-elementor-lightbox-slideshow="listing-gallery-thumbnail">
                <img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php echo get_post_meta( $attachment[ 'id' ], '_wp_attachment_image_alt', true ); ?>" />
            </a>
        </div>

        <?php endforeach; ?>

    </div>

    <div id="image_carousel_thumb" class="owl-carousel owl-theme">
        <?php foreach ( $settings['carousel'] as $index => $attachment ) :
            $image_url = wp_get_attachment_image_src( $attachment[ 'id' ], 'homepress-image-carousel-thumb', $settings );
            ?>

            <div class="item">
                <img src="<?php echo esc_attr( $image_url[0] ); ?>" alt="<?php echo get_post_meta( $attachment[ 'id' ], '_wp_attachment_image_alt', true ); ?>" />
            </div>

        <?php endforeach; ?>
    </div>

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



