<?php
//Post archive style
$post_archive_style = homepress_get_option('post_archive_style' );

//Get the ID for metaboxes fields
$id = get_the_ID();
if ( is_home() ) {
    $id = ( !empty( get_option( 'page_for_posts' ) ) ) ? get_option( 'page_for_posts' ) : $id;
}

//Title settings
$title_box_style = homepress_get_option( 'title_box_style' );
$title = homepress_get_option( 'title_box_title' );

//Sidebar settings
$sidebar_id = homepress_get_option( 'post_sidebar_id' );
if ( $sidebar_id == 'global' ) {
    $sidebar_id = homepress_get_option( 'sidebar_id' );
}
$sidebar_position = homepress_get_option( 'post_sidebar_position' );
if ( $sidebar_position == 'global' ) {
    $sidebar_position = homepress_get_option( 'sidebar_position' );
}

if ( have_posts() ) : ?>
<div <?php post_class(); ?>>

    <div class="archive-post-<?php echo esc_attr( $post_archive_style ); ?>">

        <div class="container">

            <div class="row">

                <?php if ( $sidebar_position == 'left' && is_active_sidebar( $sidebar_id )  ) { ?>

                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-box archive-post__sidebar">
                        <?php dynamic_sidebar( $sidebar_id ); ?>
                    </div><!-- sidebar left -->

                <?php } ?>

                <div class="<?php if ( is_active_sidebar( $sidebar_id ) ) : ?>col-lg-9<?php else: ?>col-lg-12<?php endif; ?> col-md-12 col-sm-12 col-sm archive-post__content">

                    <?php if ( !empty( $title ) && $title_box_style == 'style_1' || !defined('ELEMENTOR_VERSION') ) { ?>

                        <h1 class="site-title"><?php
                            if ( is_home() ) {
                                single_post_title();
                            } elseif ( is_archive() ) {
                                post_type_archive_title();
                            } else {
                                the_title();
                            }
                            if ( is_tax() || is_category() ) {
                                single_term_title();
                            }
                            ?></h1>

                    <?php } ?>

                    <div class="row">

                        <?php while ( have_posts() ): the_post(); ?>

                            <div class="<?php if( $post_archive_style == 'style_1') : ?>col-lg-12 col-md-12<?php else : ?>col-lg-4 col-md-6<?php endif; ?> col-sm-12">

                            <?php get_template_part( "partials/post/styles/{$post_archive_style}" ); ?>

                            </div>

                        <?php endwhile; ?>

                    </div>

                    <?php

                    get_template_part('partials/global/pagination' );

                    ?>

                </div><!-- archive content -->

                <?php if ( $sidebar_position == 'right' && is_active_sidebar( $sidebar_id ) ) { ?>

                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-box archive-post__sidebar">
                        <?php dynamic_sidebar( $sidebar_id ); ?>
                    </div><!-- sidebar right -->

                <?php } ?>

            </div><!-- row -->

        </div><!-- container -->

    </div><!-- archive post -->

<?php else: ?>

    <?php get_template_part( 'partials/content', 'none' ); ?>

<?php endif; ?>
</div>
