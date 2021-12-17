<div class="archive-post_content<?php if( has_post_thumbnail() ) : ?> has_thumbnail<?php endif; ?><?php if( is_sticky() ) : ?> active_sticky_post<?php endif; ?>">

    <?php if( has_post_thumbnail() ) : ?>

        <div class="thumbnail-with-date">

            <?php
                get_template_part( 'partials/post/parts/featured_image' );
                get_template_part( 'partials/post/parts/posted_on_default' );
            ?>

        </div>

    <?php else: ?>

        <?php get_template_part( 'partials/post/parts/posted_on_default' ); ?>

    <?php endif; ?>

    <?php if( has_post_thumbnail() ) : ?><div class="content_info"><?php endif; ?>

    <?php get_template_part( 'partials/post/parts/title' );
    if ( get_the_excerpt() ) { ?>
        <div class="post-excerpt">

            <?php if( strpos( $post->post_content, '<!--more-->' ) ) {
                the_content();
            }
            else {
                echo homepress_minimize_word( get_the_excerpt(), '220' );
            } ?>

        </div>
    <?php } get_template_part( 'partials/post/parts/info' );?>

    <?php if( has_post_thumbnail() ) : ?></div><?php endif; ?>

</div>