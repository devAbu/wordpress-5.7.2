<?php
    if ( has_post_thumbnail() ) { ?>
    <div class="single-post-thumbnail">
        <?php the_post_thumbnail('homepress-image-post-single'); ?>
    </div>
<?php } ?>