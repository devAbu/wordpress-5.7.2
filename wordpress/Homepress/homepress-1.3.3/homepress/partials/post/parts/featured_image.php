<?php if( has_post_thumbnail() ) { ?>

    <div class="post-thumbnail">
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('homepress-image-post-archive'); ?></a>
    </div>

<?php } ?>