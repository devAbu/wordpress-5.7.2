<?php

    $prev_next = homepress_get_option( 'post_single_prev_next' );
    $comments = homepress_get_option( 'post_single_comments' );

    if( comments_open() || get_comments_number() || comments_open() and !empty( $comments ) ) { ?>

    <div class="single-post-comments <?php if( empty( $prev_next ) ) { ?>no-border-line<?php } ?>">
        <?php comments_template(); ?>
    </div>

<?php } ?>