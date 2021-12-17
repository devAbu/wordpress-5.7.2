<div class="archive-post_content">

    <?php if( has_post_thumbnail() ) : ?>

        <div class="thumbnail-with-date">

            <?php

            get_template_part( 'partials/post/parts/featured_image' );

            get_template_part( 'partials/post/parts/posted_on_custom' );

            ?>

        </div>

    <?php else: ?>

        <?php get_template_part( 'partials/post/parts/posted_on_custom' ); ?>

    <?php endif; ?>

    <?php

    get_template_part( 'partials/post/parts/title' );

    get_template_part( 'partials/post/parts/excerpt' );

    ?>

</div>