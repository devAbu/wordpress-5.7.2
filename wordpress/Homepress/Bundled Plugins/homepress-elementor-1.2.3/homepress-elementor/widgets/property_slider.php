<?php

namespace homepressWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use uListing\Classes\StmListingType;
use uListing\Classes\StmListingAttribute;
use uListing\Classes\StmListing;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class PropertySlider extends Widget_Base
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
        return 'property_slider';
    }

    protected function get_listings()
    {
        $r = array();
        $q = new \WP_Query(array(
            'post_type' => 'listing',
            'posts_per_page' => -1
        ));
        foreach ($q->posts as $post) {
            $r[$post->ID] = $post->post_title;
        }
        return $r;
    }

    protected function get_property_attributes()
    {
        $attributes = StmListingAttribute::all();
        $r = array();
        foreach ($attributes as $attribute) {
            if ($attribute->type === 'text' || $attribute->type === 'select') {
                $r[$attribute->name] = $attribute->title;
            }
        }
        return $r;
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
        return __('Property Slider', 'homepress-elementor');
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
        return 'eicon-slider-push';
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
            'ulisting_attributes',
            [
                'label' => __('Attributes', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT2,
                'options' => self::get_property_attributes(),
                'multiple' => 'true',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'property',
            [
                'label' => __('Property', 'homepress-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'placeholder' => __('Select Property', 'homepress-elementor'),
                'options' => self::get_listings()
            ]
        );

        $repeater->add_control(
            'property_background',
            [
                'label' => __('Slide Background', 'homepress-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'placeholder' => __('Select Property', 'homepress-elementor'),
            ]
        );

        $this->add_control(
            'properties',
            [
                'label' => __('Properties', 'homepress-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ property }}}',
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
        wp_enqueue_script('ulisting/property_slider/style_1');
        $settings = $this->get_settings();
        $attributes = $settings['ulisting_attributes'];
        $properties = $settings['properties'];
        $slides = array();
        foreach ($properties as $property) {
            if (empty($property['property_background']['id'])) continue;
            $listing_atts = array();
            $property_id = $property['property'];
            $img_url = ulisting_get_thumbnail($property['property_background']['id'], [1920, 800]);
            $img_url = !empty($img_url[0]) ? $img_url[0] : '';
            $listing = StmListing::find_one($property_id);
            if (!empty($listing)) {
                $listing_options = $listing->getOptions();
                $slide_data = array(
                    'title' => $listing->post_title,
                    'img' => $img_url,
                    'id' => $property_id,
                );
                foreach ($listing_options as $option) {

                    if ($option->attribute === 'price') {
                        $slide_data['price'] = $option->value;
                    }
                    foreach ($attributes as $attribute) {
                        if ($option->attribute === $attribute) {
                            $listing_atts[] = array(
                                'title' => $option->attribute_title,
                                'value' => $option->value
                            );
                        }
                    }
                    $slide_data['atts'] = $listing_atts;

                }
                $slides[] = $slide_data;
            }
        }
        $i = 1;
        $count = count($slides);
        if (!empty($slides)):
            ?>
            <div class="homepress_property_slider owl-carousel">
            <?php foreach ($slides as $slide): ?>
            <div class="homepress_property_slide">
                <?php if (!empty($slide['img'])): ?>
                    <div class="slide-image-wrap">
                        <img src="<?php echo esc_url($slide['img']); ?>"/>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="slide-content">
                        <div class="slide-count">
                            <span class="current-slide"><?php echo esc_html($i); ?></span>
                            <span class="count-separator"></span>
                            <span class="slides-count"><?php echo esc_html($count); ?></span>
                        </div>
                        <h1 class="slide-title">
                            <?php echo esc_html($slide['title']); ?>
                        </h1>
                        <?php if (!empty($slide['atts'])): ?>
                            <div class="slide-atts">
                                <?php foreach ($slide['atts'] as $att): ?>
                                    <span><?php echo esc_html($att['value'] . ' ' . $att['title']); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="slide-price">
                            <?php echo esc_html(ulisting_currency_format($slide['price'])); ?>
                        </div>
                        <a href="<?php echo get_permalink($slide['id']) ?>" class="homepress-button icon-left">
                            <i class="lnr lnr-chevron-right-circle"></i>
                            <?php esc_html_e('View Details', 'homepress-elementor'); ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php $i++; ?>
        <?php endforeach; ?>
        <?php endif; ?>
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
    protected function _content_template()
    {

    }
}