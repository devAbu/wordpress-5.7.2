<?php

namespace homepressWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use uListing\Classes\StmListingType;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class ListingPosts extends Widget_Base
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
        return 'listing_posts';
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
        return __('Listing Posts', 'homepress-elementor');
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
        return 'eicon-posts-group';
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
            'man_offices_content',
            [
                'label' => __('Settings', 'homepress-elementor'),
            ]
        );

        $this->add_control(
            'listing_posts_type_list',
            [
                'label' => __('Listing type', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT, 'options' => ulisting_type(),
                'default' => 'select',
            ]
        );

        $this->add_control(
            'listing_posts_sort_by',
            [
                'label' => __('Sort by', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'category' => __('Category', 'homepress-elementor'),
                    'featured' => __('Featured', 'homepress-elementor'),
                    'location' => __('Location', 'homepress-elementor'),
                    'popular' => __('Popular', 'homepress-elementor'),
                    'latest' => __('Latest', 'homepress-elementor'),
                ],
                'default' => 'category',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'listing_category_list',
            [
                'label' => __('Select category', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT, 'options' => ulisting_categories(),
                'default' => 'select',
                'condition' => [
                    'listing_posts_sort_by' => ['category'],
                ],
            ]
        );

        $this->add_control(
            'listing_location_list',
            [
                'label' => __('Select location', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT, 'options' => ulisting_location(),
                'default' => 'select',
                'condition' => [
                    'listing_posts_sort_by' => ['location'],
                ],
            ]
        );

        $this->add_control(
            'listing_posts_styles',
            [
                'label' => __('Posts style', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'homepress-elementor'),
                    'style_2' => __('Style 2', 'homepress-elementor')
                ],
                'default' => 'style_1',
                'render_type' => 'template',
                'condition' => [
                    'listing_posts_sort_by' => ['popular']
                ]
            ]
        );

        $this->add_control(
            'listing_posts_view',
            [
                'label' => __('Posts view', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'grid' => __('Grid', 'homepress-elementor'),
                    'ulisting_posts_carousel owl-carousel' => __('Carousel', 'homepress-elementor')
                ],
                'default' => 'grid',
                'render_type' => 'template',
                'condition' => [
                    'listing_posts_sort_by' => ['category', 'featured', 'popular', 'latest']
                ]
            ]
        );

        $this->add_control(
            'listing_posts_per_page',
            [
                'name' => 'text',
                'label' => __('Per page', 'homepress-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '4',
                'condition' => [
                    'listing_posts_sort_by' => ['category', 'featured', 'popular', 'latest'],
                ],
            ]
        );

        $this->add_control(
            'listing_posts_item_columns',
            [
                'label' => __('Number of columns', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'one_column' => __('1 column', 'homepress-elementor'),
                    'two_column' => __('2 columns', 'homepress-elementor'),
                    'three_column' => __('3 columns', 'homepress-elementor'),
                    'four_column' => __('4 columns', 'homepress-elementor'),
                    'five_column' => __('5 columns', 'homepress-elementor'),
                ],
                'default' => 'four_column',
                'render_type' => 'template',
                'condition' => [
                    'listing_posts_sort_by' => ['category', 'featured', 'popular', 'latest'],
                    'listing_posts_view' => ['grid'],
                    'listing_posts_styles' => ['style_1']
                ],
            ]
        );

        //Carousel settings
        $slides_to_show = range(1, 10);
        $slides_to_show = array_combine($slides_to_show, $slides_to_show);

        $this->add_control(
            'ulisting_posts_carousel_styles',
            [
                'label' => __('Carousel style', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'homepress-elementor'),
                    'style_2' => __('Style 2', 'homepress-elementor')
                ],
                'default' => 'style_1',
                'condition' => [
                    'listing_posts_view' => ['ulisting_posts_carousel owl-carousel'],
                    'listing_posts_sort_by' => ['category', 'featured', 'popular', 'latest']
                ]
            ]
        );


        $types = uListing__type();


        foreach ($types as $id => $value) {
            $this->add_control(
                'ulisting_posts_attributes_' . $id,
                [
                    'label' => __('Attributes', 'homepress-elementor'),
                    'type' => Controls_Manager::SELECT2,
                    'options' => ulisting_attributes($id),
                    'multiple' => 'true',
                    'default' => 'select',
                    'condition' => [
                        'ulisting_posts_carousel_styles' => ['style_2'],
                        'listing_posts_view' => ['ulisting_posts_carousel owl-carousel'],
                        'listing_posts_sort_by' => ['category', 'featured', 'popular', 'latest'],
                        'listing_posts_type_list' => [strval($id)]
                    ],
                ]
            );
        }

        $this->add_control(
            'ulisting_posts_carousel_stage',
            [
                'name' => 'text',
                'label' => __('Stage padding', 'homepress-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'listing_posts_view' => ['ulisting_posts_carousel owl-carousel'],
                    'listing_posts_sort_by' => ['category', 'featured', 'popular', 'latest']
                ],
                'default' => '0',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_loop',
            [
                'label' => __('Loop', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => __('Enable', 'homepress-elementor'),
                    'false' => __('Disable', 'homepress-elementor')
                ],
                'condition' => [
                    'listing_posts_view' => ['ulisting_posts_carousel owl-carousel'],
                    'listing_posts_sort_by' => ['category', 'featured', 'popular', 'latest']
                ],
                'default' => 'true',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_nav',
            [
                'label' => __('Arrows', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => __('Enable', 'homepress-elementor'),
                    'false' => __('Disable', 'homepress-elementor')
                ],
                'condition' => [
                    'listing_posts_view' => ['ulisting_posts_carousel owl-carousel'],
                    'listing_posts_sort_by' => ['category', 'featured', 'popular', 'latest']
                ],
                'default' => 'true',
            ]
        );

        $this->add_control(
            'ulisting_posts_nav_style',
            [
                'label' => __('Arrows style', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'inner_nav' => __('Inner', 'homepress-elementor'),
                    'outer_nav' => __('Outer', 'homepress-elementor')
                ],
                'condition' => [
                    'ulisting_posts_carousel_nav' => 'true',
                    'listing_posts_view' => ['ulisting_posts_carousel owl-carousel'],
                    'ulisting_posts_carousel_styles' => 'style_1',
                ],
                'default' => 'inner_nav',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_dots',
            [
                'label' => __('Dots', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => __('Enable', 'homepress-elementor'),
                    'false' => __('Disable', 'homepress-elementor')
                ],
                'condition' => [
                    'listing_posts_view' => ['ulisting_posts_carousel owl-carousel'],
                    'listing_posts_sort_by' => ['category', 'featured', 'popular', 'latest']
                ],
                'default' => 'false',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_items_count_desktop',
            [
                'label' => __('Items count Extra large', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __('Default', 'homepress-elementor'),
                    ] + $slides_to_show,
                'condition' => [
                    'listing_posts_view' => ['ulisting_posts_carousel owl-carousel'],
                    'listing_posts_sort_by' => ['category', 'featured', 'popular', 'latest']
                ],
                'label_block' => true,
                'default' => '5',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_items_count_landscape',
            [
                'label' => __('Items count Large', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __('Default', 'homepress-elementor'),
                    ] + $slides_to_show,
                'condition' => [
                    'listing_posts_view' => ['ulisting_posts_carousel owl-carousel'],
                    'listing_posts_sort_by' => ['category', 'featured', 'popular', 'latest']
                ],
                'label_block' => true,
                'default' => '4',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_items_count_tablet',
            [
                'label' => __('Items count Medium', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __('Default', 'homepress-elementor'),
                    ] + $slides_to_show,
                'condition' => [
                    'listing_posts_view' => ['ulisting_posts_carousel owl-carousel'],
                    'listing_posts_sort_by' => ['category', 'featured', 'popular', 'latest']
                ],
                'label_block' => true,
                'default' => '3',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_items_count_mobile_landscape',
            [
                'label' => __('Items count Small', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __('Default', 'homepress-elementor'),
                    ] + $slides_to_show,
                'condition' => [
                    'listing_posts_view' => ['ulisting_posts_carousel owl-carousel'],
                    'listing_posts_sort_by' => ['category', 'featured', 'popular', 'latest']
                ],
                'label_block' => true,
                'default' => '2',
            ]
        );

        $this->add_control(
            'ulisting_posts_carousel_items_count_mobile',
            [
                'label' => __('Items count Extra small', 'homepress-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __('Default', 'homepress-elementor'),
                    ] + $slides_to_show,
                'condition' => [
                    'listing_posts_view' => ['ulisting_posts_carousel owl-carousel'],
                    'listing_posts_sort_by' => ['category', 'featured', 'popular', 'latest']
                ],
                'label_block' => true,
                'default' => '1',
            ]
        );

        $this->add_control(
            'show_more_button',
            [
                'label' => __('Show more button', 'homepress-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_more_button_url',
            [
                'label' => __('Show more button', 'homepress-elementor'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'condition' => [
                    'show_more_button' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'show_more_button_text',
            [
                'label' => __('Show more button', 'homepress-elementor'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Show more', 'homepress-elementor'),
                'condition' => [
                    'show_more_button' => 'yes'
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
    protected function render()
    {
        $settings = $this->get_settings();
        $view = $settings['listing_posts_view'];
        $type_id = isset($settings['listing_posts_type_list']) ? $settings['listing_posts_type_list'] : 0;

        update_post_meta($type_id, 'listing_post_settings', ulisting__sanitize_array($settings));
        echo do_shortcode('[ulisting-posts-view type_id=" ' . $type_id . ' " view="' . $view . '"]');
        if (!empty($settings['show_more_button']) && $settings['show_more_button'] === 'yes' && !empty($settings['show_more_button_url']['url'])) {
            $button_text = !empty($settings['show_more_button_text']) ? $settings['show_more_button_text'] : esc_html__('Show more', 'homepress-elementor');
            ?>
            <div class="show_more_button">
                <a href="<?php echo esc_url($settings['show_more_button_url']['url']); ?>" class="homepress-button">
                    <?php echo esc_html($button_text); ?>
                </a>
            </div>
            <?php
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