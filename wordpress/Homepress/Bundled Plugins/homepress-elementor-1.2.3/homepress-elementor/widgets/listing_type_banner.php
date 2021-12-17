<?php

namespace homepressWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use uListing\Classes\StmListing;
use uListing\Classes\StmListingType;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class ListingTypeBanner extends Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name()
    {
        return 'listing_type_banner';
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
    public function get_title()
    {
        return __('Listing Type Banner', 'homepress-elementor');
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
    public function get_icon()
    {
        return 'eicon-image';
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
    public function get_categories()
    {
        return ['theme-elements'];
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
    protected function _register_controls()
    {
        $this->start_controls_section(
            'main_settings',
            [
                'label' => __('Settings', 'homepress-elementor'),
            ]
        );


        $this->add_control(
            'listing_type',
            [
                'label' => __('Select Listing Type', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT2,
                'options' => ulisting_type(),
            ]
        );

        $this->add_control(
            'listing_type_image',
            [
                'label' => __('Background', 'homepress-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );


        $this->add_control(
            'type_image_size',
            [
                'label' => __('Image size', 'homepress-elementor'),
                'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
                'label_block' => true,
                'show_label' => true,
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
    protected function render()
    {
        $settings = $this->get_settings();
        if (!empty($settings['listing_type']) && $settings['listing_type'] !== 'select' && !empty($settings['listing_type_image']['id'])) {
            $listing_type = intval($settings['listing_type']);
            $thumbnail_id = intval($settings['listing_type_image']['id']);
            $clauses = \uListing\Classes\StmListing::getClauses($listing_type);
            $total_count = \uListing\Classes\StmListingType::get_total_count(1, $clauses);
            $listing_pages = get_option('stm_listing_pages', array());
            $listings_url = !empty($listing_pages['listing_type_page'][$listing_type]) ? get_permalink($listing_pages['listing_type_page'][$listing_type]) : '#';
            $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $thumbnail_id, 'ulisting_custom', array('ulisting_custom_custom_dimension' => $settings['type_image_size'], 'ulisting_custom_size' => 'custom') );
            if (!empty($image_url)):
                ?>
                <div class="listing_type_banner">
                    <a href="<?php echo esc_url($listings_url); ?>">
                        <img src="<?php echo esc_url($image_url); ?>" />
                        <div class="listing-info">
                            <h3 class="listing-title">
                                <?php echo get_the_title($listing_type); ?>
                                <i class="property-icon-chevron-circle-right"></i>
                            </h3>
                            <div class="listing-count">
                                <?php echo esc_html($total_count . ' '); ?>
                                <?php esc_html_e('Properties', 'homepress-elementor'); ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
            endif;
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
    protected function _content_template()
    {

    }
}