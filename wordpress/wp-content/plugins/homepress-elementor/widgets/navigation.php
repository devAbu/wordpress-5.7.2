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



class Navigation extends Widget_Base {

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
		return 'navigation';
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
		return __( 'Nav Menu', 'homepress-elementor' );
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
		return 'eicon-menu-bar';
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
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'homepress-elementor' ];
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
			'section_content',
			[
				'label' => __( 'Navigation', 'homepress-elementor' ),
			]
		);

		$this->add_control(
			'stm_nav_menu',
			[
				'label'   => __( 'Select Menu', 'homepress-elementor' ),
				'type'    => Controls_Manager::SELECT, 'options' => stm_nav_menu(),
				'default' => '',
			]
		);

        $this->add_control(
            'stm_nav_menu_depth',
            [
                'label' => __( 'Depth number', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __( 'One', 'homepress-elementor' ),
                    '2' => __( 'Two', 'homepress-elementor' ),
                    '3' => __( 'Three', 'homepress-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'stm_nav_menu_style',
            [
                'label' => __( 'Styles', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'homepress-elementor' ),
                    'style_2' => __( 'Style 2', 'homepress-elementor' )
                ],
                'default' => 'style_1',
                'render_type' => 'template',
            ]
        );

        $this->add_responsive_control(
            'menu_align',
            [
                'label' => __( 'Alignment', 'homepress-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', 'homepress-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'homepress-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'homepress-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stm_nav_menu' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_position',
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
                    '{{WRAPPER}} .stm_nav_menu:not(.active)' => 'position: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_position_top',
            [
                'label' => __( 'Top', 'homepress-elementor' ) . ' (px)',
                'type' => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} .stm_nav_menu:not(.active)' => 'top: {{VALUE}}px',
                ]
            ]
        );
        $this->add_responsive_control(
            'menu_position_right',
            [
                'label' => __( 'Right', 'homepress-elementor' ) . ' (px)',
                'type' => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} .stm_nav_menu:not(.active)' => 'right: {{VALUE}}px',
                ]
            ]
        );
        $this->add_responsive_control(
            'menu_position_bottom',
            [
                'label' => __( 'Bottom', 'homepress-elementor' ) . ' (px)',
                'type' => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} .stm_nav_menu:not(.active)' => 'bottom: {{VALUE}}px',
                ]
            ]
        );
        $this->add_responsive_control(
            'menu_position_left',
            [
                'label' => __( 'Left', 'homepress-elementor' ) . ' (px)',
                'type' => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} .stm_nav_menu:not(.active)' => 'left: {{VALUE}}px',
                ]
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_menu_links_depth_1',
			[
				'label' => __( 'Links Depth 1', 'homepress-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_responsive_control(
            'section_menu_links_color_depth_1',
            [
                'label' => __( 'Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} ul.menu > li > a' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'section_menu_links_color_hover_depth_1',
            [
                'label' => __( 'Color on action', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} ul.menu > li > a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ul.menu > li > a:active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ul.menu > li > a:focus' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ul.menu > li:hover > a' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'section_menu_links_color_active_depth_1',
            [
                'label' => __( 'Color on active', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} ul.menu > li.current-menu-item > a' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .stm_nav_menu .menu li.current-menu-item:after, .stm_nav_menu .menu li.current_page_item:after' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .stm_nav_menu .menu li.active_sub_menu > a' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} ul.menu > li.current-menu-ancestor > a' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .stm_nav_menu .menu li.current-menu-ancestor:after, .stm_nav_menu .menu li.current-menu-ancestor:after' => 'color: {{VALUE}} !important;',
                ]
            ]
        );
        $this->add_responsive_control(
            'section_menu_links_bg_color_depth_1',
            [
                'label' => __( 'Link Background', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .stm_nav_menu .menu > li > a' => 'background-color: {{VALUE}} !important;'
                ]
            ]
        );
        $this->add_responsive_control(
            'section_menu_links_bg_color_hover_depth_1',
            [
                'label' => __( 'Link Background on Action', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .stm_nav_menu .menu > li:hover > a' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .stm_nav_menu .menu > li:active > a' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .stm_nav_menu .menu > li:focus > a' => 'background-color: {{VALUE}} !important;',
                ]
            ]
        );
        $this->add_responsive_control(
            'section_menu_links_bg_color_active_depth_1',
            [
                'label' => __( 'Selected Link Background', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .stm_nav_menu .menu > li.current-menu-ancestor > a, .stm_nav_menu .menu > li.current-menu-ancestor > a' => 'background-color: {{VALUE}} !important;',
                ]
            ]
        );
        $this->add_responsive_control(
            'section_menu_links_color_active_line',
            [
                'label' => __( 'Selected Link Line', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} ul.menu > li.current-menu-ancestor:before' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .stm_nav_menu .menu > li.current-menu-ancestor:before, .stm_nav_menu .menu > li.current-menu-ancestor:before' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'stm_nav_menu_style' => [ 'style_2' ]
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'section_menu_links_typography_depth_1',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} ul.menu > li > a',
                'label' => __( 'Typography', 'homepress-elementor' ),
            ]
        );

        $this->add_responsive_control(
            'section_menu_links_margin_depth_1',
            [
                'label'      => __( 'Link Margin', 'homepress-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} ul.menu > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_menu_links_padding_depth_1',
            [
                'label'      => __( 'Link Padding', 'homepress-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} ul.menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Horizontal Align', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __( 'Default', 'homepress-elementor' ),
                    'flex-start' => __( 'Start', 'homepress-elementor' ),
                    'center' => __( 'Center', 'homepress-elementor' ),
                    'flex-end' => __( 'End', 'homepress-elementor' )
                ],
                'selectors' => [
                    '{{WRAPPER}} .stm_nav_menu' => 'justify-content: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'max-width',
            [
                'label' => __( 'Max width', 'homepress-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '432'
            ]
        );

        $this->add_control(
            'stm_nav_menu_smooth_scroll',
            [
                'label' => __( 'Smooth scroll', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'no' => __( 'No', 'homepress-elementor' ),
                    'yes' => __( 'Yes', 'homepress-elementor' ),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_menu_links_depth_2',
            [
                'label' => __( 'Links Depth 2', 'homepress-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'stm_nav_menu_depth' => [ '2', '3' ],
                ],
            ]
        );
        $this->add_control(
            'section_menu_links_color_depth_2',
            [
                'label' => __( 'Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} ul.menu > li > .sub-menu > li > a' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'section_menu_links_color_hover_depth_2',
            [
                'label' => __( 'Color on action', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} ul.menu > li > .sub-menu > li > a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ul.menu > li > .sub-menu > li > a:active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ul.menu > li > .sub-menu > li > a:focus' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'section_menu_links_color_active_depth_2',
            [
                'label' => __( 'Color on active', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} ul.menu > li ul.menu > li.current-menu-item > a' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'section_menu_links_typography_depth_2',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  ul.menu > li > .sub-menu > li > a',
                'label' => __( 'Typography', 'homepress-elementor' ),
            ]
        );

        $this->add_control(
            'section_menu_links_margin_depth_2',
            [
                'label'      => __( 'Link Margin', 'homepress-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} ul.menu > li > .sub-menu > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_menu_links_padding_depth_2',
            [
                'label'      => __( 'Link Padding', 'homepress-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} ul.menu > li > .sub-menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_menu_links_depth_3',
            [
                'label' => __( 'Links Depth 3', 'homepress-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'stm_nav_menu_depth' => [ '3' ],
                ],
            ]
        );
        $this->add_control(
            'section_menu_links_color_depth_3',
            [
                'label' => __( 'Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} ul.menu > li > .sub-menu > li > .sub-menu > li > a' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'section_menu_links_color_hover_depth_3',
            [
                'label' => __( 'Color on action', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} ul.menu > li > .sub-menu > li > .sub-menu > li > a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ul.menu > li > .sub-menu > li > .sub-menu > li > a:active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ul.menu > li > .sub-menu > li > .sub-menu > li > a:focus' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'section_menu_links_typography_depth_3',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  ul.menu > li > .sub-menu > li > .sub-menu > li > a',
                'label' => __( 'Typography', 'homepress-elementor' ),
            ]
        );

        $this->add_control(
            'section_menu_links_margin_depth_3',
            [
                'label'      => __( 'Link Margin', 'homepress-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} ul.menu > li > .sub-menu > li > .sub-menu > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_menu_links_padding_depth_3',
            [
                'label'      => __( 'Link Padding', 'homepress-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} ul.menu > li > .sub-menu > li > .sub-menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_menu_switcher',
            [
                'label' => __( 'Mobile button', 'homepress-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'section_menu_switcher_color',
            [
                'label' => __( 'Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .stm_mobile_switcher span' => 'background-color: {{VALUE}};'
                ]
            ]
        );
        $this->add_control(
            'section_menu_switcher_color_on_action',
            [
                'label' => __( 'Color on action', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .stm_mobile_switcher.active span' => 'background-color: {{VALUE}};'
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

        $settings = $this->get_settings();
        $maxWidth = $settings['max-width'];
        $depth = $settings['stm_nav_menu_depth'];
        $style = $settings['stm_nav_menu_style'];
        $smooth_scroll = $settings['stm_nav_menu_smooth_scroll'];

		//Get menu
		$stm_nav_menu = ! empty( $settings['stm_nav_menu'] ) ? wp_get_nav_menu_object( $settings['stm_nav_menu'] ) : false;

		if ( ! $stm_nav_menu ) {
			return;
		}

		$nav_menu_args = array(
			'fallback_cb'    => false,
			'container'      => false,
			'menu_class'     => 'menu',
			'theme_location' => 'default_navmenu',
			'link_after'     => '<span class="dropdown_nav_arrow property-icon-chevron-down"></span>',
			'menu'           => $stm_nav_menu,
			'echo'           => true,
			'depth'          => $depth,
			'walker'         => '',
		);

		?>
        <div class="stm_nav_menu <?php if( $smooth_scroll == 'yes' ) : ?>nav_smooth_scroll<?php endif;?> stm_nav_menu_<?php echo esc_attr( $style ); ?>" style="max-width: <?php echo esc_attr( $maxWidth ); ?>px">
            <?php
            wp_nav_menu(
                apply_filters(
                    'widget_nav_menu_args',
                    $nav_menu_args,
                    $stm_nav_menu
                )
            );
            ?>

            <div class="stm_mobile_switcher">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="stm_nav_menu_overlay"></div>
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



