<?php
$author_name = get_the_author_meta( 'display_name' );
$posted = get_the_time( 'U' );

$post_views = get_post_meta( get_the_ID(), 'stm_post_views', true );
if( empty( $post_views ) ) {
    $post_views = 0;
}
?>

<div class="single-post-info-wrap">
    <div class="single-post-author">
        <div class="single-post-author__avatar">
            <?php echo get_avatar( get_the_author_meta( 'email' ), 32 ); ?>
        </div>
        <div class="single-post-author__info">
            <div class="single-post-author__name">
                <?php esc_html_e( 'by:', 'homepress' ); ?>
                <strong><?php echo esc_html( $author_name ); ?></strong>
            </div>
        </div>
    </div>
    <div class="single-post-info">

        <div class="single-post-info__current_time">
            <?php echo human_time_diff( $posted, current_time( 'U' ) ) . ' ago'; ?>
        </div>

        <div class="single-post-info__views">
            <?php echo esc_attr( $post_views ); ?>
            <?php if( $post_views == 1 ) : ?>
                <?php esc_html_e( 'view', 'homepress' ); ?>
            <?php else: ?>
                <?php esc_html_e( 'views', 'homepress' ); ?>
            <?php endif; ?>
        </div>

        <div class="single-post-info__comments">
            <?php comments_number( '0', '1', '%' ); ?>
        </div>
    </div>
</div>