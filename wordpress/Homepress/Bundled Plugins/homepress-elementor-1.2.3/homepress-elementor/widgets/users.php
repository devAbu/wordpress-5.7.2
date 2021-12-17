<?php
namespace homepressWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Base_Control;
use uListing\Classes\StmUser;
use WP_User_Query;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */



class Users extends Widget_Base {

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
        return 'users';
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
        return __( 'Users', 'homepress-elementor' );
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
        return 'eicon-bullet-list';
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
                'label' => __( 'Settings', 'homepress-elementor' ),
            ]
        );

        $this->add_control(
            'user_box_view',
            [
                'label' => __( 'View', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'grid' => __( 'Grid', 'homepress-elementor' ),
                    'list' => __( 'List', 'homepress-elementor' ),
                ],
                'default' => 'grid',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'user_box_items',
            [
                'label' => __( 'Columns', 'homepress-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '4' => __( '3', 'homepress-elementor' ),
                    '1' => __( '12', 'homepress-elementor' ),
                    '6' => __( '2', 'homepress-elementor' ),
                    '3' => __( '4', 'homepress-elementor' ),
                ],
                'condition' => [
                    'user_box_view' => [ 'grid' ],
                ],
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'user_role',
            [
                'label'   => __( 'Sort by role', 'homepress-elementor' ),
                'type'    => Controls_Manager::SELECT, 'options' => user_role(),
                'default' => 'all',
            ]
        );

        $this->add_control(
            'per_page',
            [
                'name' => 'text',
                'label' => __( 'Per page', 'homepress-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '12',
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
        $user_role = $settings['user_role'];

        $per_page = $settings['per_page'];

        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        if ( $paged == 1 ) {
            $offset = 0;
        }
        else {
            $offset = ( $paged-1 ) * $per_page;
        }
        if ($user_role != 'all') {
            $args = array(
                'role' => $user_role,
                'number' => $per_page,
                'offset' => $offset,
                'meta_key' => 'verified_user',
                'orderby' => 'verified_user',
                'order' => 'DESC'
            );
        } else {
            $args = array(
                'number' => $per_page,
                'offset' => $offset,
                'meta_key' => 'verified_user',
                'orderby' => 'verified_user',
                'order' => 'DESC'
            );
        }

        $user_query = new WP_User_Query( $args );

        ?>
        <div class="user_box-<?php echo esc_attr( $settings['user_box_view'] ); ?>">
            <div class="row">

            <?php if ( !empty( $user_query->results ) ) { ?>
                <?php foreach ( $user_query->results as $user ) : $user = $user->ID; $user = new StmUser( $user ); ?>

                <?php if( get_user_meta( $user->ID, 'verified_user', true ) ) : ?>
                    <div class="<?php if( $settings['user_box_view'] == 'grid' ) { ?>col-lg-<?php echo esc_attr( $settings['user_box_items'] ); ?> col-md-6<?php } ?> col-sm-12 col-sm">
                        <div class="users_box">

                            <?php if (!empty( $user->getAvatarUrl() ) ) : ?>
                                <a href="<?php echo get_author_posts_url( $user->ID ); ?>" class="avatar">
                                    <img src="<?php echo esc_url( $user->getAvatarUrl() ); ?>" alt="<?php echo esc_attr( $user->user_login ); ?>" />
                                </a>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri()."/assets/images/placeholder-ulisting.png" ?>" alt="<?php echo esc_attr( $user->user_login ); ?>" />
                            <?php endif; ?>
                            <div class="users_box_info">
                                <?php if( !empty( $user->nickname ) ) { ?>
                                    <h6 class="user_title"><a href="<?php echo get_author_posts_url( $user->ID ); ?>"><?php echo esc_attr( $user->nickname ); ?></a></h6>
                                <?php } ?>
                                <?php if( !empty( $user->address ) ) { ?>
                                <div class="user_address"><?php echo esc_attr( $user->address ); ?></div>
                                <?php } ?>
<!--                                --><?php //if( !empty( $user->user_email ) ) { ?>
<!--                                    <div class="user_email"><span class="property-icon-envelope user_field_icon"></span> --><?php //esc_html_e( 'Email:', 'homepress' ); ?><!-- <a href="mailto:--><?php //echo esc_attr( $user->user_email ); ?><!--">--><?php //echo esc_attr( $user->user_email ); ?><!--</a></div>-->
<!--                                --><?php //} ?>
                                <?php if( !empty( $user->phone_mobile ) || !empty( $user->phone_office ) || !empty( $user->fax ) ) { ?>
                                <div class="users_phone_box">
                                    <span class="users_phone_box_icon property-icon-phone-small"></span>
                                    <?php if( !empty( $user->phone_mobile ) ) { ?>
                                        <div class="users_phone_box_field">
                                            <span class="users_phone_box_label"><?php esc_html_e( 'Mobile:', 'homepress' ); ?></span>
                                            <span class="users_phone_box_value"><?php echo esc_attr( $user->phone_mobile ); ?></span>
                                        </div>
                                    <?php } ?>
                                    <?php if( !empty( $user->phone_office ) ) { ?>
                                        <div class="users_phone_box_field">
                                            <span class="users_phone_box_label"><?php esc_html_e( 'Office:', 'homepress' ); ?></span>
                                            <span class="users_phone_box_value"><?php echo esc_attr( $user->phone_office ); ?></span>
                                        </div>
                                    <?php } ?>
                                    <?php if( !empty( $user->fax ) ) { ?>
                                        <div class="users_phone_box_field">
                                            <span class="users_phone_box_label"><?php esc_html_e( 'Fax:', 'homepress' ); ?></span>
                                            <span class="users_phone_box_value"><?php echo esc_attr( $user->fax ); ?></span>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>

                                <ul class="users-socials-box">
                                    <?php if( !empty( $user->facebook ) ) { ?>
                                        <li><a href="<?php echo esc_attr( $user->facebook ); ?>" target="_blank" rel="nofollow"><span class="property-icon-facebook-f"></span></a></li>
                                    <?php } ?>
                                    <?php if( !empty( $user->twitter ) ) { ?>
                                        <li><a href="<?php echo esc_attr( $user->twitter ); ?>" target="_blank" rel="nofollow"><span class="property-icon-twitter"></span></a></li>
                                    <?php } ?>
                                    <?php if( !empty( $user->google_plus ) ) { ?>
                                        <li><a href="<?php echo esc_attr( $user->google_plus ); ?>" target="_blank" rel="nofollow"><span class="property-icon-google-plus-g"></span></a></li>
                                    <?php } ?>
                                    <?php if( !empty( $user->youtube_play ) ) { ?>
                                        <li><a href="<?php echo esc_attr( $user->youtube_play ); ?>" target="_blank" rel="nofollow"><span class="property-icon-youtube"></span></a></li>
                                    <?php } ?>
                                    <?php if( !empty( $user->linkedin ) ) { ?>
                                        <li><a href="<?php echo esc_attr( $user->linkedin ); ?>" target="_blank" rel="nofollow"><span class="property-icon-linkedin-in"></span></a></li>
                                    <?php } ?>
                                    <?php if( !empty( $user->instagram ) ) { ?>
                                        <li><a href="<?php echo esc_attr( $user->instagram ); ?>" target="_blank" rel="nofollow"><span class="property-icon-instagram"></span></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php endforeach; ?>
            <?php } ?>
            </div>

            <?php
                $total_user = count( $user_query->results );
                $pages = ceil( $total_user/$per_page );

                global $wp_query, $wp_rewrite;


                $pagenum_link = html_entity_decode( get_pagenum_link() );
                $query_args   = array();
                $url_parts    = explode( '?', $pagenum_link );

                if ( isset( $url_parts[1] ) ) {
                    wp_parse_str( $url_parts[1], $query_args );
                }

                $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
                $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

                $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
                $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';


                echo paginate_links(array(
                    'base'      => $pagenum_link,
                    'format'    => $format,
                    'current'   => $paged,
                    'total'     => $pages,
                    'prev_text' => __( 'Prev', 'homepress' ),
                    'next_text' => __( 'Next', 'homepress' ),
                    'type'      => 'list'
                ));
            ?>
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