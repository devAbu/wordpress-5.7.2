<div class="testimonials-description">
    <?php the_content(); ?>
    <span class="testimonials-icon property-icon-testimonials-quote"></span>
</div>

    <div class="testimonials-user">
    <?php if ( has_post_thumbnail() ) { ?>
        <div class="testimonials-thumbnail">
            <?php the_post_thumbnail('110x110'); ?>
        </div>
    <?php } ?>

        <div class="testimonials-info">
            <h6 class="testimonials-title">
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



