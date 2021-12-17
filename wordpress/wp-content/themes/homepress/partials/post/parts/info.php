<?php
$author_id = get_current_user_id( );
$author_name = get_the_author_meta( 'display_name' );
$author_bio = get_the_author_meta( 'description' );
$post_category = get_the_category();

?>
<div class="post-list-info">
    <div class="post-list-author">
        <?php if (!empty( get_author_posts_url( $author_id ) ) ) : ?>
            <span><?php esc_html_e( 'Posted by: ', 'homepress' ); ?></span>
            <a href="<?php echo get_author_posts_url( $author_id ); ?>"><?php echo esc_html( $author_name ); ?></a>
        <?php endif; ?>
    </div>
    <?php if( $post_category ) : ?>
        <div class="post-list-category">
            <span><?php esc_html_e( 'Categories:', 'homepress' ); ?></span>
            <?php echo get_the_category_list( esc_html__( ', ', 'homepress' ) ); ?>
        </div>
    <?php endif; ?>
</div>