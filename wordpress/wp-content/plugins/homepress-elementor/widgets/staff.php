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



class Staff extends Widget_Base {

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
        return 'homepress-staff';
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
        return __( 'Staff', 'homepress-elementor' );
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
        return 'eicon-person';
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
     * Get post types.
     */
    private function man_posts_type() {
        $options = array();
        $exclude = array( 'attachment', 'elementor_library' ); // excluded post types

        $args = array(
            'public' => true,
        );

        foreach ( get_post_types( $args, 'objects' ) as $post_type ) {
            // Check if post type name exists.
            if ( ! isset( $post_type->name ) ) {
                continue;
            }

            // Check if post type label exists.
            if ( ! isset( $post_type->label ) ) {
                continue;
            }

            // Check if post type is excluded.
            if ( in_array( $post_type->name, $exclude ) === true ) {
                continue;
            }

            $options[ $post_type->name ] = $post_type->label;
        }

        return $options;
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
                'label' => __( 'Settings', 'homepress-elementor' ),
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => __( 'Columns', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '4' => __( '3', 'homepress-elementor' ),
                    '12' => __( '1', 'homepress-elementor' ),
                    '6' => __( '2', 'homepress-elementor' ),
                    '3' => __( '4', 'homepress-elementor' ),
                    'five_cols' => __( '5', 'homepress-elementor' ),
                ],
                'condition' => [
                    'show_staff_carousel' => [ '', 'no' ],
                ],
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'items_number',
            [
                'label' => __( 'Items', 'homepress-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => '6',
                'condition' => [
                    'show_staff_carousel' => [ '', 'no' ],
                ],
                'render_type' => 'template',
            ]
        );

        $this->add_responsive_control(
            'show_staff_carousel',
            ['label' => __( 'Carousel', 'homepress-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'view_style',
            ['label' => __( 'Staff cart style', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => array(
                    'style_1' => esc_html__( 'Default', 'homepress-elementor' ),
                    'style_2' => esc_html__( 'Rounded', 'homepress-elementor' ),
                )
            ]
        );

        //Carousel settings
        $slides_to_show = range( 1, 10 );
        $slides_to_show = array_combine( $slides_to_show, $slides_to_show );

        $this->add_control(
            'staff_carousel_stage',
            [
                'name' => 'text',
                'label' => __( 'Stage padding', 'homepress-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'show_staff_carousel' => [ 'yes' ],
                ],
                'default' => '0',
            ]
        );

        $this->add_control(
            'staff_carousel_loop',
            [
                'label' => __( 'Loop', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => __( 'Enable', 'homepress-elementor' ),
                    'false' => __( 'Disable', 'homepress-elementor' )
                ],
                'condition' => [
                    'show_staff_carousel' => [ 'yes' ],
                ],
                'default' => 'true',
            ]
        );

        $this->add_control(
            'staff_carousel_nav',
            [
                'label' => __( 'Arrows', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => __( 'Enable', 'homepress-elementor' ),
                    'false' => __( 'Disable', 'homepress-elementor' )
                ],
                'condition' => [
                    'show_staff_carousel' => [ 'yes' ],
                ],
                'default' => 'true',
            ]
        );

        $this->add_control(
            'staff_carousel_dots',
            [
                'label' => __( 'Dots', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => __( 'Enable', 'homepress-elementor' ),
                    'false' => __( 'Disable', 'homepress-elementor' )
                ],
                'condition' => [
                    'show_staff_carousel' => [ 'yes' ],
                ],
                'default' => 'false',
            ]
        );

        $this->add_control(
            'staff_carousel_items_count_desktop',
            [
                'label' => __( 'Items count Extra large', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'homepress-elementor' ),
                    ] + $slides_to_show,
                'condition' => [
                    'show_staff_carousel' => [ 'yes' ],
                ],
                'label_block' => true,
                'default' => '5',
            ]
        );

        $this->add_control(
            'staff_carousel_items_count_landscape',
            [
                'label' => __( 'Items count Large', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'homepress-elementor' ),
                    ] + $slides_to_show,
                'condition' => [
                    'show_staff_carousel' => [ 'yes' ],
                ],
                'label_block' => true,
                'default' => '4',
            ]
        );

        $this->add_control(
            'staff_carousel_items_count_tablet',
            [
                'label' => __( 'Items count Medium', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'homepress-elementor' ),
                    ] + $slides_to_show,
                'condition' => [
                    'show_staff_carousel' => [ 'yes' ],
                ],
                'label_block' => true,
                'default' => '3',
            ]
        );

        $this->add_control(
            'staff_carousel_items_count_mobile_landscape',
            [
                'label' => __( 'Items count Small', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'homepress-elementor' ),
                    ] + $slides_to_show,
                'condition' => [
                    'show_staff_carousel' => [ 'yes' ],
                ],
                'label_block' => true,
                'default' => '2',
            ]
        );

        $this->add_control(
            'staff_carousel_items_count_mobile',
            [
                'label' => __( 'Items count Extra small', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'homepress-elementor' ),
                    ] + $slides_to_show,
                'condition' => [
                    'show_staff_carousel' => [ 'yes' ],
                ],
                'label_block' => true,
                'default' => '1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'staff_settings',
            [
                'label' => __( 'Name', 'homepress-elementor' ),
            ]
        );
        $this->add_responsive_control(
            'staff_name_color',
            [
                'label' => __( 'Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .staff-title' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'staff_name',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .staff-title',
                'label' => __( 'Typography', 'homepress-elementor' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'staff_position',
            [
                'label' => __( 'Position', 'homepress-elementor' ),
            ]
        );
        $this->add_responsive_control(
            'show_staff_position',
            [
                'label' => __( 'Show', 'homepress-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false,
                'default' => 'yes',
            ]
        );
        $this->add_responsive_control(
            'staff_position_color',
            [
                'label' => __( 'Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'show_staff_position' => [ 'yes' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .staff-position' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'staff_position',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'condition' => [
                    'show_staff_position' => [ 'yes' ],
                ],
                'selector' => '{{WRAPPER}} .staff-position',
                'label' => __( 'Typography', 'homepress-elementor' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'staff_email_box',
            [
                'label' => __( 'Email box', 'homepress-elementor' ),
            ]
        );
        $this->add_responsive_control(
            'show_email_box',
            [
                'label' => __( 'Show', 'homepress-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false,
                'default' => 'yes',
            ]
        );
        $this->add_responsive_control(
            'show_email_in_social_box',
            [
                'label' => __( 'Show in social icons', 'homepress-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false,
                'condition' => [
                    'show_email_box' => [ 'yes' ],
                ],
                'default' => 'yes',
            ]
        );
        $this->add_responsive_control(
            'staff_email_icon_color',
            [
                'label' => __( 'Icon Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#234dd4',
                'condition' => [
                    'show_email_box' => [ 'yes' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .email_icon' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_control(
            'staff_email_icon_indent',
            [
                'label' => __( 'Icon Spacing', 'homepress-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 150,
                    ],
                ],
                'condition' => [
                    'show_staff_phones' => [ 'yes' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .email_icon' => 'margin-right: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'staff_phone_box',
            [
                'label' => __( 'Phone box', 'homepress-elementor' ),
            ]
        );

        $this->add_responsive_control(
            'show_staff_phones',
            [
                'label' => __( 'Show', 'homepress-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false,
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'staff_phone_icon_color',
            [
                'label' => __( 'Icon Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#234dd4',
                'condition' => [
                    'show_staff_phones' => [ 'yes' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .phone_icon' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'phones_icon',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'condition' => [
                    'show_staff_phones' => [ 'yes' ],
                ],
                'selector' => '{{WRAPPER}} .phone_icon',
                'label' => __( 'Icon Typography', 'homepress-elementor' ),
            ]
        );
        $this->add_responsive_control(
            'staff_phones_color',
            [
                'label' => __( 'Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'show_staff_phones' => [ 'yes' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .staff-phones' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'staff_phones',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'condition' => [
                    'show_staff_phones' => [ 'yes' ],
                ],
                'selector' => '{{WRAPPER}} .staff-phones',
                'label' => __( 'Typography', 'homepress-elementor' ),
            ]
        );
        $this->add_control(
            'staff_icon_indent',
            [
                'label' => __( 'Icon Spacing', 'homepress-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 150,
                    ],
                ],
                'condition' => [
                    'show_staff_phones' => [ 'yes' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .staff-phones' => 'padding-left: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'staff_socials_box',
            [
                'label' => __( 'Socials box', 'homepress-elementor' ),
            ]
        );

        $this->add_responsive_control(
            'show_socials_box',
            [
                'label' => __( 'Show', 'homepress-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false,
                'default' => 'yes',
            ]
        );
        $this->add_responsive_control(
            'staff_social_icon_color',
            [
                'label' => __( 'Icon Color', 'homepress-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(48,52,65,0.6)',
                'condition' => [
                    'show_socials_box' => [ 'yes' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .staff-socials a' => 'color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'staff_social',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'condition' => [
                    'show_socials_box' => [ 'yes' ],
                ],
                'selector' => '{{WRAPPER}} .staff-socials a',
                'label' => __( 'Typography', 'homepress-elementor' ),
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
        $view = $settings['show_staff_carousel'];
        $stage = $settings['staff_carousel_stage'];
        $loop = $settings['staff_carousel_loop'];
        $nav = $settings['staff_carousel_nav'];
        $dots = $settings['staff_carousel_dots'];
        $count_desktop = $settings['staff_carousel_items_count_desktop'];
        $count_landscape = $settings['staff_carousel_items_count_landscape'];
        $count_tablet = $settings['staff_carousel_items_count_tablet'];
        $count_mobile_landscape = $settings['staff_carousel_items_count_mobile_landscape'];
        $count_mobile = $settings['staff_carousel_items_count_mobile'];

        $args = array(
            'post_type'      => 'stmt-staff',
            'posts_per_page' => $settings['items_number']
        );

        $classes = '';
        if($view == 'yes'){
            $classes .= 'staff_carousel owl-carousel ';
        }
        else {
            $classes .= 'row ';
        }
        if(!empty($settings['view_style'])){
            $classes .= $settings['view_style'];
        }
        $staff_query = new \WP_Query( $args );

        if ( $staff_query->have_posts() ) : ?>

        <?php if( $view == 'yes' ) {echo '<div class="row">';} ?>
        <div class="<?php if( !empty($classes) ) { echo esc_attr($classes); } ?>">

            <?php
                while ($staff_query->have_posts()) :

                $staff_query->the_post();
                $id = get_the_ID();
                $staff_position = get_post_meta($id, 'staff_position', true);
                $staff_facebook = get_post_meta($id, 'facebook', true);
                $staff_twitter = get_post_meta($id, 'twitter', true);
                $staff_instagram = get_post_meta($id, 'instagram', true);
                $staff_google_plus = get_post_meta($id, 'google-plus', true);
                $staff_email = get_post_meta($id, 'email', true);
                $staff_mobile = get_post_meta($id, 'mobile', true);
                $staff_office = get_post_meta($id, 'office', true);
                $staff_fax = get_post_meta($id, 'fax', true);

                ?>
                    <div class="<?php if( $view != 'yes' ) { echo 'col-lg-' . $settings['items']; echo ' col-sm-12 col-md-6'; } ?> staff-item">

                    <?php if( has_post_thumbnail() ) { ?>

                    <div class="staff-thumbnail">
                        <?php
                        if(!empty($settings['view_style']) && $settings['view_style'] === 'style_2'){
                            the_post_thumbnail('homepress-image-staff-760x760');
                        }
                        else {
                            the_post_thumbnail('homepress-image-ulisting-gallery_style_1');
                        }
                        ?>
                    </div>

                    <?php } ?>
                    <div class="staff-info-box">
                        <div class="staff-title">
                            <?php the_title(); ?>
                        </div>

                        <?php if ( !empty ( $staff_position ) and $settings['show_staff_position'] == 'yes' ) { ?>
                        <div class="staff-position">
                            <?php echo esc_attr( $staff_position ); ?>
                        </div>
                        <?php } ?>

                        <?php if ( !empty ( $staff_email and $settings['show_email_in_social_box'] == '' ) ) { ?>
                        <div class="staff-email">
                            <span class="email_icon property-icon-envelope"></span> <?php echo esc_html_e( 'Email:', 'homepress-elementor' ); ?>
                            <a href="mailto:<?php echo esc_attr( $staff_email ); ?>" target="_blank" rel="nofollow"><?php echo esc_attr( $staff_email ); ?></a>
                        </div>
                        <?php } ?>

                         <?php if ( !empty ( $staff_mobile ) || !empty ( $staff_office ) || !empty ( $staff_fax ) and $settings['show_staff_phones'] == 'yes' ) { ?>
                        <div class="staff-phones">
                            <span class="phone_icon property-icon-phone"></span>
                            <?php if ( !empty ( $staff_mobile ) ) { ?><p><span><?php echo esc_html_e( 'Mobile:', 'homepress-elementor' ); ?></span> <?php echo esc_attr( $staff_mobile ); ?></p><?php } ?>
                            <?php if ( !empty ( $staff_office ) ) { ?><p><span><?php echo esc_html_e( 'Office:', 'homepress-elementor' ); ?></span> <?php echo esc_attr( $staff_office ); ?></p><?php } ?>
                            <?php if ( !empty ( $staff_fax ) ) { ?><p><span><?php echo esc_html_e( 'Fax:', 'homepress-elementor' ); ?></span> <?php echo esc_attr( $staff_fax ); ?></p><?php } ?>
                        </div>
                        <?php } ?>

                        <?php if ( !empty ( $staff_facebook ) || !empty ( $staff_twitter ) || !empty ( $staff_instagram ) || !empty ( $staff_google_plus ) || !empty ( $staff_email ) and $settings['show_socials_box'] == 'yes' ) { ?>
                        <div class="staff-socials">

                            <?php if ( !empty ( $staff_facebook ) ) { ?>
                            <div class="staff-socials-item">
                                <a href="<?php echo esc_attr( $staff_facebook ); ?>" target="_blank" rel="nofollow"><span class="property-icon-facebook-f"></span></a>
                            </div>
                            <?php } ?>

                            <?php if ( !empty ( $staff_twitter ) ) { ?>
                            <div class="staff-socials-item">
                                <a href="<?php echo esc_attr( $staff_twitter ); ?>" target="_blank" rel="nofollow"><span class="property-icon-twitter"></span></span></a>
                            </div>
                            <?php } ?>

                            <?php if ( !empty ( $staff_instagram ) ) { ?>
                            <div class="staff-socials-item">
                                <a href="<?php echo esc_attr( $staff_instagram ); ?>" target="_blank" rel="nofollow"><span class="property-icon-instagram"></span></a>
                            </div>
                            <?php } ?>

                            <?php if ( !empty ( $staff_google_plus ) ) { ?>
                            <div class="staff-socials-item">
                                <a href="<?php echo esc_attr( $staff_google_plus ); ?>" target="_blank" rel="nofollow"><span class="property-icon-google-plus-g"></span></a>
                            </div>
                            <?php } ?>

                            <?php if ( !empty ( $staff_email and $settings['show_email_in_social_box'] == 'yes' ) ) { ?>
                            <div class="staff-socials-item">
                                <a href="mailto:<?php echo esc_attr( $staff_email ); ?>" target="_blank" rel="nofollow"><span class="property-icon-envelope"></span></a>
                            </div>
                            <?php } ?>

                        </div>
                        <?php } ?>
                    </div>

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
                    $('.staff_carousel').each(function(){
                        $(this).owlCarousel({
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