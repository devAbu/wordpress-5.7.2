<div class="testimonials-content-wrap">

    <div class="testimonial-title-wrap">
        <?php if ( has_post_thumbnail() ) { ?>
            <div class="testimonials-thumbnail">
                <?php the_post_thumbnail('thumbnail'); ?>
            </div>
        <?php } ?>
        <div class="testimonial-title">
            <h6>
                <?php the_title(); ?>
            </h6>
            <div class="testimonials-position">
                <?php
                $position = get_post_meta( get_the_ID(), 'testimonials_position' );
                echo esc_attr( $position[0] );
                ?>
            </div>
        </div>
    </div>

    <div class="testimonials-description">
        <?php the_content(); ?>
    </div>

</div>