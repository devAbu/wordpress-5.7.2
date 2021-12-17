<?php
$post_tags = get_the_tags();

if( $post_tags ) : ?>

    <div class="post-tags-list">
        <h6><?php esc_html_e( 'Tags:', 'homepress' ); ?></h6>
        <?php foreach( $post_tags as $tag ): ?>
            <a href="<?php echo esc_url( get_tag_link( $tag ) ) ?>"
               title="<?php echo esc_attr( $tag->name ); ?>" >
                <?php echo esc_attr( $tag->name ); ?>
            </a>
        <?php endforeach; ?>
    </div>

<?php endif; ?>
