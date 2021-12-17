<?php if ( has_post_thumbnail() ) { ?>
    <div class="testimonials-thumbnail-wrap">
        <div class="testimonials-thumbnail">
            <?php the_post_thumbnail('165x165'); ?>
        </div>
        <span class="testimonials-icon property-icon-testimonials-quote"></span>
    </div>
<?php } ?>

<div class="testimonials-content-wrap">
    <h6 class="testimonials-title">
        <?php the_title(); ?>
    </h6>

    <div class="testimonials-position">
        <?php
        $position = get_post_meta( get_the_ID(), 'testimonials_position' );
        echo esc_attr( $position[0] );
        ?>
    </div>

    <div class="testimonials-description">
        <?php the_content(); ?>
    </div>

</div>