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

class HomepressButton extends Widget_Base {

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
        return 'homepress_button';
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
        return __( 'Homepress button', 'homepress-elementor' );
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
        return 'eicon-button';
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
            'ulisting_compare',
            [
                'label' => __( 'Settings', 'homepress-elementor' ),
            ]
        );

        $this->add_control(
            'homepress-button-text',
            [
                'label' => __( 'Text', 'homepress-elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'Click here', 'homepress-elementor' ),
                'placeholder' => __( 'Click here', 'homepress-elementor' ),
            ]
        );

        $this->add_control(
            'homepress-button-link',
            [
                'label' => __( 'Link', 'homepress-elementor' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'homepress-elementor' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'homepress-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
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
                'prefix_class' => 'elementor%s-align-',
                'default' => '',
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label' => __( 'Icon', 'homepress-elementor' ),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'fa4compatibility' => 'icon',
            ]
        );

        $this->add_control(
            'icon_align',
            [
                'label' => __( 'Icon Position', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => __( 'Before', 'homepress-elementor' ),
                    'right' => __( 'After', 'homepress-elementor' ),
                ],
                'condition' => [
                    'icon!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon_indent',
            [
                'label' => __( 'Icon Spacing', 'homepress-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'condition' => [
                    'icon!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Icon size', 'homepress-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'condition' => [
                    'icon!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'button_icon_color',
            [
                'label' => __( 'Icon Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button .elementor-button-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} a.elementor-button:hover .elementor-button-icon' => 'color: inherit;',
                    '{{WRAPPER}} a.elementor-button:active .elementor-button-icon' => 'color: inherit;',
                    '{{WRAPPER}} a.elementor-button:focus .elementor-button-icon' => 'color: inherit;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Button', 'homepress-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
                'label' => __( 'Description Typography', 'homepress-elementor' ),
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'homepress-elementor' ),
            ]
        );
        $this->add_responsive_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'background_color',
            [
                'label' => __( 'Background Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();


        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'homepress-elementor' ),
            ]
        );

        $this->add_responsive_control(
            'hover_color',
            [
                'label' => __( 'Text Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_background_hover_color',
            [
                'label' => __( 'Background Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .elementor-button',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'homepress-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-button',
            ]
        );

        $this->add_responsive_control(
            'text_padding',
            [
                'label' => __( 'Padding', 'homepress-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'button_position',
            [
                'label' => __( 'Position', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __( 'Default', 'homepress-elementor' ),
                    'absolute' => __( 'Absolute', 'homepress-elementor' ),
                    'fixed' => __( 'Fixed', 'homepress-elementor' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'position: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_position_top',
            [
                'label' => __( 'Top', 'homepress-elementor' ) . ' (px)',
                'type' => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'top: {{VALUE}}px',
                ]
            ]
        );
        $this->add_responsive_control(
            'button_position_right',
            [
                'label' => __( 'Right', 'homepress-elementor' ) . ' (px)',
                'type' => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'right: {{VALUE}}px',
                ]
            ]
        );
        $this->add_responsive_control(
            'button_position_bottom',
            [
                'label' => __( 'Bottom', 'homepress-elementor' ) . ' (px)',
                'type' => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'bottom: {{VALUE}}px',
                ]
            ]
        );
        $this->add_responsive_control(
            'button_position_left',
            [
                'label' => __( 'Left', 'homepress-elementor' ) . ' (px)',
                'type' => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'left: {{VALUE}}px',
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
        $settings = $this->get_settings(); ?>

        <a href="<?php echo esc_attr( $settings['homepress-button-link']['url'] ); ?>" class="elementor-button elementor-size-sm">
            <span class="elementor-button-content-wrapper">
                <span class="elementor-button-icon elementor-align-icon-<?php echo esc_attr( $settings['icon_align'] ); ?>">
                    <i class="<?php echo esc_attr( $settings['selected_icon']['value'] ); ?>" aria-hidden="true"></i>
                </span>
                <span class="elementor-button-text"><?php echo esc_attr( $settings['homepress-button-text'] ); ?></span>
            </span>
        </a>
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