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



class Infobox extends Widget_Base {

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
        return 'homepress-infobox';
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
        return __( 'Info box', 'homepress-elementor' );
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
        return 'eicon-info-box';
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
            'man_offices_content',
            [
                'label' => __( 'Content', 'homepress-elementor' ),
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => __( 'Title & Description', 'homepress-elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'This is the heading', 'homepress-elementor' ),
                'placeholder' => __( 'Enter your title', 'homepress-elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label' => '',
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'homepress-elementor' ),
                'placeholder' => __( 'Enter your description', 'homepress-elementor' ),
                'rows' => 10,
                'separator' => 'none',
                'show_label' => false,
            ]
        );

        $this->add_control(
            'link',
            [
                'name' => 'link',
                'label' => __( 'Link', 'homepress-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' =>'',
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __( 'Style', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __( '1', 'homepress-elementor' ),
                    '2' => __( '2', 'homepress-elementor' ),
                ],
                'render_type' => 'template',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __( 'Content', 'homepress-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label' => __( 'Alignment', 'homepress-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'homepress-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'homepress-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'homepress-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'homepress-elementor' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-info-box-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_title',
            [
                'label' => __( 'Title', 'homepress-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'title_bottom_space',
            [
                'label' => __( 'Spacing', 'homepress-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .info-box-title, .info-box-title.hidden' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .info-box-title, .info-box-title.hidden' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .info-box-title, .info-box-title.hidden',
                'label' => __( 'Title Typography', 'homepress-elementor' ),
            ]
        );

        $this->add_control(
            'heading_description',
            [
                'label' => __( 'Description', 'homepress-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .info-box-description' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .info-box-description',
                'label' => __( 'Description Typography', 'homepress-elementor' ),
            ]
        );

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

        ?>

        <div class="elementor-info-box-wrapper elementor-info-box-style_<?php echo wp_kses_post( $settings['style'] ); ?>">
            <?php if ( $settings['link'] ) { ?>
                <a href="<?php echo esc_url( $settings['link'] ); ?>">
            <?php } ?>
            <?php if( !empty( $settings['title_text'] ) ) { ?>
                <span class="info-box-title hidden"><?php echo wp_kses_post( $settings['title_text'] ); ?></span>
            <?php } ?>
            <span class="elementor-info-box-content">
                <?php if( !empty( $settings['title_text'] ) ) { ?>
                    <span class="info-box-title"><?php echo wp_kses_post( $settings['title_text'] ); ?></span>
                <?php } ?>
                <?php if( !empty( $settings['description_text'] ) ) { ?>
                    <span class="info-box-description"><?php echo wp_kses_post( $settings['description_text'] ); ?></span>
                <?php } ?>
            </span>
            <?php if ( $settings['link'] ) { ?>
                </a>
            <?php } ?>
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



