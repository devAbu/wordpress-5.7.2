<?php
/**
 * Widget API: STM_Testimonials_Widget class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement the Testimonials widget.
 *
 * @since 1.0.0
 *
 * @see WP_Widget
 */
class STM_Testimonials_Widget extends WP_Widget {

    /**
     * Sets up a new Testimonials widget instance.
     *
     * @since 3.0.0
     */
    public function __construct() {
        $widget_ops = array(
            'description' => esc_html__( 'Add a Testimonials to your sidebar.', 'homepress-configurations' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'stm_testimonials', esc_html__('STM Testimonials', 'homepress-configurations'), $widget_ops );
    }

    /**
     * Outputs the content for the current Testimonials widget instance.
     *
     * @since 3.0.0
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Testimonials widget instance.
     */
    public function widget( $args, $instance ) {

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $post_type = (empty($instance['post_type'])) ? 'stmt-testimonials' : $instance['post_type'];

        $q_args = array(
            'post_type' => $post_type,
            'posts_per_page' => 1,
            'orderby' => 'rand'
        );

        echo wp_kses_post($args['before_widget']);

        if ( !empty( $instance['title'] ) )
            echo wp_kses_post( $args['before_title'] . $instance['title'] . $args['after_title'] );

        $q = new WP_Query( $q_args );

        if ( $q->have_posts() ): ?>
            <div class="stm_testimonials">
            <?php while ( $q->have_posts() ): $q->the_post(); ?>

                <div class="testimonials-content">
                    <?php the_content(); ?>
                    <span class="testimonials-icon property-icon-testimonials-quote"></span>
                </div>

                <div class="testimonials-user">
                <?php if ( has_post_thumbnail() ) { ?>
                    <div class="testimonials-thumbnail">
                        <?php the_post_thumbnail('homepress-image-services-archive'); ?>
                    </div>
                <?php } ?>
                    <div class="testimonials-info">
                        <div class="testimonials-title">
                            <?php the_title(); ?>
                        </div>
                        <div class="testimonials-position">
                            <?php
                                $position = get_post_meta( get_the_ID(), 'testimonials_position' );
                                echo esc_attr( $position[0] );
                            ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata();
        endif;

        echo wp_kses_post( $args['after_widget'] );
    }

    /**
     * Handles updating settings for the current Testimonials widget instance.
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
        if ( !empty( $new_instance['post_type'] ) ) {
            $instance['post_type'] = (int) $new_instance['post_type'];
        }
        return $instance;
    }

    /**
     * Outputs the settings form for the Testimonials widget.
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

function register_stm_testimonials_widget() {
    register_widget( 'STM_Testimonials_Widget' );
}
add_action( 'widgets_init', 'register_stm_testimonials_widget' );
