<?php

class STM_WP_Widget_Post_Gallery extends WP_Widget
{

    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'stm_wp_widget_post_gallery',
            'description' => esc_html__('STM Posts Gallery widget', 'homepress-configurations')
        );
        $control_ops = array('width' => 400, 'height' => 350);
        parent::__construct('stm_wp_widget_post_gallery', esc_html__('STM Posts Gallery', 'homepress-configurations'), $widget_ops, $control_ops);
    }

    public function widget($args, $instance)
    {
        wp_enqueue_style('lightgallery');
        wp_enqueue_script('lightgallery.js');


        $args['before_widget'] = str_replace('class="', 'class="gallery', $args['before_widget']);



        /** This filter is documented in wp-includes/default-widgets.php */
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $num = (empty($instance['num'])) ? '6' : $instance['num'];
        $image_size = (empty($instance['size'])) ? '70x70' : $instance['size'];
        $post_type = (empty($instance['post_type'])) ? '' : $instance['post_type'];

        $post_status = ($post_type !== 'attachment') ? 'publish' : 'inherit';

        $q_args = array(
            'post_type' => sanitize_title($post_type),
            'posts_per_page' => intval($num),
            'post_status'    => $post_status,
            'meta_query' => array(
                array(
                    'key' => '_thumbnail_id',
                    'compare' => 'EXISTS'
                ),
            )
        );
        echo html_entity_decode($args['before_widget']);
        if (!empty($title)) {
            echo html_entity_decode($args['before_title'] . $title . $args['after_title']);
        }

        $q = new WP_Query($q_args);

        if ($q->have_posts()): ?>
            <div class="stm_widget_media stm_lightgallery">
                <?php while ($q->have_posts()): $q->the_post();
                    $id = get_the_ID();
                    $img_id = ($post_type !== 'attachment') ? get_post_thumbnail_id($id) : $id;
                    $image = get_the_post_thumbnail(get_the_ID(), $image_size);
                    $image_url = wp_get_attachment_image_url( get_the_ID(), 'full' );

                    ?>
                    <a href="<?php echo esc_url($image_url); ?>"
                       class="stm_widget_media__single stm_lightgallery__selector"
                       data-sub-html='<a class="wtc" href="<?php the_permalink() ?>"><?php the_title(); ?></a>'
                       title="<?php the_title(); ?>">
                        <?php echo html_entity_decode($image); ?>
                    </a>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata();
        endif;

        ?>

        <?php
        echo html_entity_decode($args['after_widget']);
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['post_type'] = $new_instance['post_type'];
        $instance['num'] = $new_instance['num'];
        $instance['size'] = $new_instance['size'];

        return $instance;
    }

    public function form($instance)
    {
        $title = (!empty($instance['title'])) ? $instance['title'] : '';
        $num = (!empty($instance['num'])) ? $instance['num'] : '';
        $size = (!empty($instance['size'])) ? $instance['size'] : '';
        $post_type = (!empty($instance['post_type'])) ? $instance['post_type'] : '';
        $post_types = get_post_types();

        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_html_e('Title:', 'homepress-configurations'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('num')); ?>">
                <?php esc_html_e('Number of images:', 'homepress-configurations'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('num')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('num')); ?>"
                   type="number"
                   value="<?php echo esc_attr($num); ?>"/>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('size')); ?>">
                <?php esc_html_e('Image size:', 'homepress-configurations'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('size')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('size')); ?>"
                   type="text"
                   value="<?php echo esc_attr($size); ?>"/>
            <span><?php esc_html_e('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'homepress-configurations'); ?></span>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('post_type')); ?>">
                <?php esc_html_e('Post type:', 'homepress-configurations'); ?>
            </label>
            <select name="<?php echo esc_attr($this->get_field_name('post_type')); ?>"
                    id="<?php echo esc_attr($this->get_field_id('post_type')); ?>"
                    class="widefat">
                <?php foreach ($post_types as $post):
                    $selected = ($post == $post_type) ? 'selected' : '';
                    $post_type_info = get_post_type_object($post);
                    ?>
                    <option value="<?php echo sanitize_text_field($post); ?>" <?php echo esc_attr($selected); ?>>
                        <?php echo esc_attr($post_type_info->labels->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <?php
    }
}

function pearl_register_stm_post_gallery_widget()
{
    register_widget('STM_WP_Widget_Post_Gallery');
}

add_action('widgets_init', 'pearl_register_stm_post_gallery_widget');