<?php
/**
 * Widget API: STM_Services Cat_Widget class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement the Services_Cat widget.
 *
 * @since 1.0.0
 *
 * @see WP_Widget
 */
class STM_Services_Cat_Widget extends WP_Widget {

    /**
     * Sets up a new Services Cat widget instance.
     *
     * @since 3.0.0
     */
    public function __construct() {
        $widget_ops = array(
            'description' => esc_html__( 'Add a Services cat to your sidebar.', 'homepress-configurations' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'stm_services_cat', esc_html__('STM Services categories', 'homepress-configurations'), $widget_ops );
    }

    /**
     * Outputs the content for the current Services Cat widget instance.
     *
     * @since 3.0.0
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Services Cat widget instance.
     */
    public function widget( $args, $instance ) {

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        echo wp_kses_post($args['before_widget']);

        if ( !empty( $instance['title'] ) )
            echo wp_kses_post( $args['before_title'] . $instance['title'] . $args['after_title'] );

        $taxonomy = 'stmt-services-taxonomy';
        $terms = get_terms( $taxonomy );
        if ( is_tax() ) {
            $taxonomy_id = get_queried_object()->term_id;
        }

        if ( $terms && !is_wp_error( $terms ) ) : ?>
            <ul>
                <?php foreach ( $terms as $term ) { ?>
                    <li class="cat-item cat-item-<?php echo esc_attr( $term->term_id ); ?> <?php if ( is_tax() ) {if($taxonomy_id == $term->term_id) { ?>current-cat<?php } }; ?>">
                        <a href="<?php echo get_term_link( $term->slug, $taxonomy ); ?>"><?php echo esc_attr( $term->name ); ?></a>
                    </li>
                <?php } ?>
            </ul>
        <?php endif;

        echo wp_kses_post( $args['after_widget'] );
    }

    /**
     * Handles updating settings for the current Services Cat widget instance.
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
        return $instance;
    }

    /**
     * Outputs the settings form for the Services Cat widget.
     *
     * @since 3.0.0
     *
     * @param array $instance Current settings.
     * @global WP_Customize_Manager $wp_customize
     */
    public function form( $instance ) {
        global $wp_customize;
        $title = isset( $instance['title'] ) ? $instance['title'] : '';

        ?>

        <div class="nav-menu-widget-form-controls">
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'homepress-configurations' ) ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
            </p>
        </div>
        <?php
    }
}

function register_stm_services_cat_widget() {
    register_widget( 'STM_Services_Cat_Widget' );
}
add_action( 'widgets_init', 'register_stm_services_cat_widget' );
