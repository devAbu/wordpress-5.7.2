<?php
$post_category = get_the_category();

if( $post_category ) : ?>

    <div class="post-category-list">
        <?php foreach( $post_category as $category ): ?>
            <a href="<?php echo esc_url( get_tag_link( $category ) ) ?>"
               title="<?php echo esc_attr( $category->name ); ?>" >
                <?php echo esc_attr( $category->name ); ?>
            </a>
        <?php endforeach; ?>
    </div>

<?php endif; ?>