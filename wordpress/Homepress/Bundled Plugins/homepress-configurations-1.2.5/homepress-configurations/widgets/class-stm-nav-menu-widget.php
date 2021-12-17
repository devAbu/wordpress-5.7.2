<?php
/**
 * Widget API: STM_Nav_Menu_Widget class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement the Navigation Menu widget.
 *
 * @since 3.0.0
 *
 * @see WP_Widget
 */
class STM_Nav_Menu_Widget extends WP_Widget {

    /**
     * Sets up a new Navigation Menu widget instance.
     *
     * @since 3.0.0
     */
    public function __construct() {
        $widget_ops = array(
            'description' => esc_html__( 'Add a custom menu to your sidebar.', 'homepress-configurations' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'stm_property_menu', esc_html__('STM Property Menu', 'homepress-configurations'), $widget_ops );
    }

    /**
     * Outputs the content for the current Navigation Menu widget instance.
     *
     * @since 3.0.0
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Navigation Menu widget instance.
     */
    public function widget( $args, $instance ) {
        // Get menu
        $nav_menu = !empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

        if ( ! $nav_menu ) {
            return;
        }

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        if (empty($args['before_widget'])) {
            $args['before_widget'] = '<aside class="stm_proterty_menu"><div class="stm_proterty_menu_more"><span class="proterty_menu_more">'. esc_html__( 'More', 'homepress-configurations' ) .'</span><span class="proterty_menu_hide">'. esc_html__( 'Hide', 'homepress-configurations' ) .'</span></div>';
        } else {
            $args['before_widget'] = str_replace('stm_proterty_menu', 'stm_proterty_menu', $args['before_widget']);
        }

        echo wp_kses_post($args['before_widget']);

        if ( !empty($instance['title']) )
            echo wp_kses_post($args['before_title'] . $instance['title'] . $args['after_title']);

        $nav_menu_args = array(
            'fallback_cb' => '',
            'theme_location' => 'default_navmenu',
            'menu'        => $nav_menu
        );

        /**
         * Filters the arguments for the Navigation Menu widget.
         *
         * @since 4.2.0
         * @since 4.4.0 Added the `$instance` parameter.
         *
         * @param array    $nav_menu_args {
         *     An array of arguments passed to wp_nav_menu() to retrieve a navigation menu.
         *
         *     @type callable|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
         *     @type mixed         $menu        Menu ID, slug, or name.
         * }
         * @param WP_Term  $nav_menu      Nav menu object for the current menu.
         * @param array    $args          Display arguments for the current widget.
         * @param array    $instance      Array of settings for the current widget.
         */
        wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );

        echo '</aside>';
    }

    /**
     * Handles updating settings for the current Navigation Menu widget instance.
     *
     * @since 3.0.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        if ( !empty( $new_instance['title'] ) ) {
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
        }
        if ( !empty( $new_instance['nav_menu'] ) ) {
            $instance['nav_menu'] = $new_instance['nav_menu'];
        }
        return $instance;
    }

    /**
     * Outputs the settings form for the Navigation Menu widget.
     *
     * @since 3.0.0
     *
     * @param array $instance Current settings.
     * @global WP_Customize_Manager $wp_customize
     */
    public function form( $instance ) {
        global $wp_customize;
        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

        // Get menus
        $menus = wp_get_nav_menus();

        // If no menus exists, direct the user to go and create some.
        ?>
        <p class="nav-menu-widget-no-menus-message" <?php if ( !empty( $menus ) ) { echo ' style="display:none" '; } ?>>
            <?php
            if ( $wp_customize instanceof WP_Customize_Manager ) {
                $url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
            } else {
                $url = admin_url( 'nav-menus.php' );
            }
            ?>
            <?php echo sprintf( esc_html_e( 'No menus have been created yet. <a href="%s">Create some</a>.', 'homepress-configurations' ), esc_attr( $url ) ); ?>
        </p>
        <div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'homepress-configurations' ) ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>"><?php esc_html_e( 'Select Menu:', 'homepress-configurations' ); ?></label>
                <select id="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'nav_menu' ) ); ?>">
                    <option value="0"><?php esc_html_e( '&mdash; Select &mdash;', 'homepress-configurations' ); ?></option>
                    <?php foreach ( $menus as $menu ) : ?>
                        <option value="<?php echo esc_attr( $menu->slug ); ?>" <?php selected( $nav_menu, $menu->slug ); ?>>
                            <?php echo esc_html( $menu->name ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
                <p class="edit-selected-nav-menu" style="<?php if ( ! $nav_menu ) { echo 'display: none;'; } ?>">
                    <button type="button" class="homepress-button"><?php esc_html_e( 'Edit Menu', 'homepress-configurations' ) ?></button>
                </p>
            <?php endif; ?>
        </div>
        <?php
    }
}

function register_stm_nav_menu_widget() {
    register_widget( 'STM_Nav_Menu_Widget' );
}
add_action( 'widgets_init', 'register_stm_nav_menu_widget' );
