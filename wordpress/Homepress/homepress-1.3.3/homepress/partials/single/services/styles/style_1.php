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
    $sidebar_id = homepress_get_option( 'services_sidebar_id' );
    if ( $sidebar_id == 'global' ) {
        $sidebar_id = homepress_get_option( 'sidebar_id' );
    }
}
$sidebar_position = get_post_meta( $id, 'sidebar_position', 'global' );
if ( $sidebar_position == 'global' ) {
    $sidebar_position = homepress_get_option( 'services_sidebar_position' );
    if ( $sidebar_position == 'global' ) {
        $sidebar_position = homepress_get_option( 'sidebar_position' );
    }
}

//Services settings
$excerpt = get_post_meta( $id, 'services_single_excerpt', 'global' );
if ( $excerpt === 'global' ) {
    $excerpt = homepress_get_option( 'services_single_excerpt' );
}
$thumbnail = get_post_meta( $id, 'services_single_thumbnail', 'global' );
if ( $thumbnail === 'global' ) {
    $thumbnail = homepress_get_option( 'services_single_thumbnail' );
}

if ( have_posts() ) : ?>

    <div class="single-services-style_1">

        <div class="container">

            <div class="row">

                <?php if ( $sidebar_position == 'left' && is_active_sidebar( $sidebar_id )  ) { ?>

                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-box single-services__sidebar">
                        <?php dynamic_sidebar( $sidebar_id ); ?>
                    </div><!-- sidebar left -->

                <?php } ?>

                <div class="<?php if ( is_active_sidebar( $sidebar_id ) ) : ?>col-lg-9<?php else: ?>col-lg-12<?php endif; ?> col-md-12 col-sm-12 col-sm single-post__content">

                    <?php while ( have_posts() ): the_post(); ?>

                        <?php

                        if( !empty( $title ) && $title_box_style == 'style_1' ) {
                            get_template_part( 'partials/single/services/parts/title' );
                        }

                        if( !empty( $excerpt ) ) {
                            get_template_part( 'partials/single/services/parts/excerpt' );
                        }

                        if( !empty( $thumbnail ) ) {
                            get_template_part( 'partials/single/services/parts/thumbnail' );
                        }

                        get_template_part( 'partials/single/services/parts/content' );

                        ?>

                    <?php endwhile; ?>

                </div><!-- single content -->

                <?php if ( $sidebar_position == 'right' && is_active_sidebar( $sidebar_id )  ) { ?>

                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-box single-services__sidebar">
                        <?php dynamic_sidebar( $sidebar_id ); ?>
                    </div><!-- sidebar right -->

                <?php } ?>

            </div><!-- row -->

        </div><!-- container -->

    </div><!-- single service -->

<?php else: ?>

    <?php get_template_part( 'partials/content', 'none' ); ?>

<?php endif;
