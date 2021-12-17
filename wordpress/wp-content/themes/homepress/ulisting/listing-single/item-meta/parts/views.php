<div class="listing-views">
<?php
    $post_views = get_post_meta( get_the_ID(), 'stm_post_views', true );
    if(empty( $post_views ) ) {
        $post_views = 0;
    }
    echo esc_attr( $post_views );
?>
</div>
