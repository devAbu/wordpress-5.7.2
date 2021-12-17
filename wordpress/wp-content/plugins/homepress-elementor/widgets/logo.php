<?php
namespace HomepressWidgets\Widgets;

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



class Logo extends Widget_Base {

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
		return 'homepress-logo';
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
		return __( 'Logo', 'homepress-elementor' );
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
		return 'eicon-logo';
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
			'section_content',
			[
				'label' => __( 'Content', 'homepress-elementor' ),
			]
		);

		$this->add_control(
			'text',
			[
				'name' => 'text',
				'label' => __( 'Text', 'homepress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'Homepress', 'homepress-elementor' ),
			]
		);

		$this->add_control(
			'link',
			[
				'name' => 'link',
				'label' => __( 'Link', 'homepress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' =>'/',
			]
		);

		$this->add_control(
			'image',
			[
				'name' => 'logo',
				'label' => __( 'Logo ', 'homepress-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .man_logo',
			]
		);

		$this->add_control(
			'logo_color',
			[
				'label' => __( 'Logo Color', 'homepress-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .man_logo' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control( 'logo_size',
			[
				'label' => __( 'Logo Size', 'homepress-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .man_logo_img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_display',
			[
				'label' => __( 'Display Text', 'homepress-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_block' => true,
				'default' => 'yes',
			]
		);


		$this->add_control(
			'inline',
			[
				'label' => __( 'Display Inline', 'homepress-elementor' ),
				'type' => Controls_Manager::SWITCHER,
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
		$settings = $this->get_settings_for_display();
	?>

		<?php if ( $settings['link'] ): ?>
		<a class="man_logo" href="<?php echo esc_url( $settings['link'] ); ?>">
			<?php if ( $settings['image']['url'] ): ?>
                <div class="man_logo_img"><img src="<?php echo esc_attr( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['text'] ); ?>"></div>
			<?php endif ?>
			<?php if ( $settings['text'] ): ?>
				<?php if ( $settings['text_display'] == 'yes' ): ?>
					<div class="man_logo_txt<?php if ( $settings['text_display_mobile'] !== 'yes' ){ echo ' hidden-xs';} ?><?php if ( $settings['text_display_tablet'] !== 'yes' ){ echo ' hidden-sm';} ?>"><?php echo esc_attr( $settings['text'] ); ?></div>
				<?php endif ?>
			<?php endif ?>
		</a>
		<?php else: ?>
		<div class="man_logo">
			<?php if ( $settings['image']['url'] ): ?>
                <div class="man_logo_img"><img src="<?php echo esc_attr( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['text'] ); ?>"></div>
			<?php endif ?>
			<?php if ( $settings['text'] ): ?>
                <?php if ( $settings['text_display'] == 'yes' ): ?>
                    <div class="man_logo_txt<?php if ( $settings['text_display_mobile'] !== 'yes' ){ echo ' hidden-xs';} ?><?php if ( $settings['text_display_tablet'] !== 'yes' ){ echo ' hidden-sm';} ?>"><?php echo esc_attr( $settings['text'] ); ?></div>
                <?php endif ?>
			<?php endif ?>
		</div>
		<?php endif ?>

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



