<?php
//Get the ID for metaboxes fields
$id = get_the_ID();

//Title settings
$title = get_post_meta( $id, 'title_box_title', 'global' );
if ( $title == 'global' ) {
    $title = homepress_get_option( 'title_box_title' );
}
$title_box_style = get_post_meta( $id, 'title_box_style', 'global' );
if ( $title_box_style == 'global' ) {
    $title_box_style = homepress_get_option( 'title_box_style' );
}

//Sidebar settings
$sidebar_id = get_post_meta( $id, 'sidebar_id', 'global' );
if ( $sidebar_id == 'global' ) {
    $sidebar_id = homepress_get_option( 'post_sidebar_id' );
    if ( $sidebar_id == 'global' ) {
        $sidebar_id = homepress_get_option( 'sidebar_id' );
    }
}
$sidebar_position = get_post_meta( $id, 'sidebar_position', 'global' );
if ( $sidebar_position == 'global' ) {
    $sidebar_position = homepress_get_option( 'post_sidebar_position' );
    if ( $sidebar_position == 'global' ) {
        $sidebar_position = homepress_get_option( 'sidebar_position' );
    }
}

//Blog settings
$category = get_post_meta( $id, 'post_single_categories', 'global' );
if ( $category === 'global' ) {
    $category = homepress_get_option( 'post_single_categories' );
}
$info = get_post_meta( $id, 'post_single_info_box', 'global' );
if ( $info === 'global' ) {
    $info = homepress_get_option( 'post_single_info_box' );
}
$share = get_post_meta( $id, 'post_single_share', 'global' );
if ( $share === 'global' ) {
    $share = homepress_get_option( 'post_single_share' );
}
$excerpt = get_post_meta( $id, 'post_single_excerpt', 'global' );
if ( $excerpt === 'global' ) {
    $excerpt = homepress_get_option( 'post_single_excerpt' );
}
$thumbnail = get_post_meta( $id, 'post_single_thumbnail', 'global' );
if ( $thumbnail === 'global' ) {
    $thumbnail = homepress_get_option( 'post_single_thumbnail' );
}
$tags = get_post_meta( $id, 'post_single_tags', 'global' );
if ( $tags === 'global' ) {
    $tags = homepress_get_option( 'post_single_tags' );
}
$author = get_post_meta( $id, 'post_single_author', 'global' );
if ( $author === 'global' ) {
    $author = homepress_get_option( 'post_single_author' );
}
$prev_next = get_post_meta( $id, 'post_single_prev_next', 'global' );
if ( $prev_next === 'global' ) {
    $prev_next = homepress_get_option( 'post_single_prev_next' );
}
$comments = get_post_meta( $id, 'post_single_comments', 'global' );
if ( $comments === 'global' ) {
    $comments = homepress_get_option( 'post_single_comments' );
}
$related_posts = get_post_meta( $id, 'post_single_related_posts', 'global' );
if ( $related_posts === 'global' ) {
    $related_posts = homepress_get_option( 'post_single_related_posts' );
}

if ( have_posts() ) : ?>

    <div class="single-post-style_1">

        <div class="container">

            <div class="row">

                <?php if ( $sidebar_position == 'left' && is_active_sidebar( $sidebar_id )  ) { ?>

                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-box single-post__sidebar">
                        <?php dynamic_sidebar( $sidebar_id ); ?>
                    </div><!-- sidebar left -->

                <?php } ?>

                <div class="<?php if ( is_active_sidebar( $sidebar_id ) ) : ?>col-lg-9<?php else: ?>col-lg-12<?php endif; ?> col-md-12 col-sm-12 col-sm single-post__content">

                    <?php while ( have_posts() ): the_post(); ?>

                        <?php

                        if( !empty( $category ) ) {
                            get_template_part( 'partials/single/post/parts/category' );
                        }

                        if( !empty( $title ) && $title_box_style == 'style_1' || !defined('ELEMENTOR_VERSION') ) {
                            get_template_part( 'partials/single/post/parts/title' );
                        }

                        if( !empty( $info ) ) {
                            get_template_part( 'partials/single/post/parts/info' );
                        }

                        if( !empty( $share ) ) {
                            get_template_part( 'partials/single/post/parts/share' );
                        }

                        if( !empty( $excerpt ) ) {
                            get_template_part( 'partials/single/post/parts/excerpt' );
                        }

                        if( !empty( $thumbnail ) || !defined( 'STM_CONFIGURATIONS_VER' ) ) {
                            get_template_part( 'partials/single/post/parts/thumbnail' );
                        }

                        get_template_part( 'partials/single/post/parts/content' );

                        if( !empty( $tags ) ) {
                            get_template_part( 'partials/single/post/parts/tags' );
                        } else {
                            get_template_part( 'partials/single/post/parts/tags' );
                        }

                        if( !empty( $share ) ) {
                            get_template_part( 'partials/single/post/parts/share' );
                        }

                        if( !empty( $author ) ) {
                            get_template_part( 'partials/single/post/parts/author' );
                        }

                        get_template_part( 'partials/single/post/parts/nextpage' );

                        ?>

                    <?php endwhile; ?>

                </div><!-- single content -->

                <?php if ( $sidebar_position == 'right' && is_active_sidebar( $sidebar_id )  ) { ?>

                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-box single-post__sidebar">
                        <?php dynamic_sidebar( $sidebar_id ); ?>
                    </div><!-- sidebar right -->

                <?php } ?>

                <?php if( !empty( $prev_next ) || !empty( $comments )  || !defined('ELEMENTOR_VERSION') ) { ?>

                    <div class="col-lg-12 col-md-12 col-sm-12 single-post__after_content">

                        <div class="after_content_wrap">
                            <?php get_template_part( 'partials/single/post/parts/after_content' ); ?>
                        </div>

                    </div><!-- after content -->

                <?php } ?>

                <?php if( !empty( $related_posts ) ) { ?>

                    <?php get_template_part( 'partials/single/post/parts/related_posts' ); ?>

                <?php } ?>

            </div><!-- row -->

        </div><!-- container -->

    </div><!-- single post -->

<?php else: ?>

    <?php get_template_part( 'partials/content', 'none' ); ?>

<?php endif;