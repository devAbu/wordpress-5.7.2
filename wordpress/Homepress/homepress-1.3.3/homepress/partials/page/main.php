<?php
//Get the ID for metaboxes fields
$id = get_the_ID();

//Title settings
$title_box_style = get_post_meta( $id, 'title_box_style', 'global' );
if( $title_box_style == 'global' ) {
    $title_box_style = homepress_get_option( 'title_box_style' );
}
$title = get_post_meta( $id, 'title_box_title', 'global' );
if( empty( $title ) || $title == 'global' ) {
    $title = homepress_get_option( 'title_box_title' );
}

//Sidebar settings
$sidebar_id = get_post_meta( $id, 'sidebar_id', 'global' );
if( $sidebar_id == 'global' ) {
    $sidebar_id = homepress_get_option( 'sidebar_id' );
}
$sidebar_position = get_post_meta( $id, 'sidebar_position', 'global' );
if( $sidebar_position == 'global' ) {
    $sidebar_position = homepress_get_option( 'sidebar_position' );
}

if( have_posts() ) : ?>

    <div class="page_box">

        <?php if( is_active_sidebar( $sidebar_id ) ) : ?>

            <div class="container">

                <div class="row">

                    <?php if( $sidebar_position == 'left' && is_active_sidebar( $sidebar_id ) ) { ?>

                        <div class="col-lg-3 col-md-12 col-sm-12 sidebar-box page__sidebar">
                            <?php dynamic_sidebar( $sidebar_id ); ?>
                        </div><!-- sidebar left -->

                    <?php } ?>

                    <div class="<?php if( is_active_sidebar( $sidebar_id ) ) : ?>col-lg-9<?php else: ?>col-lg-12<?php endif; ?> col-md-12 col-sm-12 col-sm single-post__content">

                        <?php if( !empty( $title ) && $title !== 'hide' && $title_box_style == 'style_1' ) { ?>

                            <h1 class="site-title"><?php echo esc_attr( get_the_title( $id ) ); ?></h1>

                        <?php } ?>

                        <?php while ( have_posts() ): the_post(); ?>

                            <div class="page-content">

                                <?php get_template_part( 'partials/page/parts/content' ); ?>

                            </div>

                        <?php endwhile; ?>

                    </div><!-- single content -->

                    <?php if( $sidebar_position == 'right' && is_active_sidebar( $sidebar_id ) ) { ?>

                        <div class="col-lg-3 col-md-12 col-sm-12 sidebar-box page__sidebar">
                            <?php dynamic_sidebar( $sidebar_id ); ?>
                        </div><!-- sidebar right -->

                    <?php } ?>

                </div><!-- row -->

            </div><!-- container -->

        <?php else: ?>

            <?php if( !empty( $title ) && $title !== 'hide' && $title_box_style == 'style_1' || !defined( 'ELEMENTOR_VERSION' ) ) { ?>
                <div class="container">

                    <h1 class="site-title"><?php echo esc_attr( get_the_title( $id ) ); ?></h1>

                </div>
            <?php } ?>

            <?php if( !defined( 'ELEMENTOR_VERSION' ) ) : ?><div class="container"><?php endif; ?>
            <?php while ( have_posts() ): the_post(); ?>

                <?php
                    get_template_part( 'partials/page/parts/content' );

                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'homepress' ),
                        'after' => '</div>',
                    ) );
                ?>

                <?php if (  !defined( 'ELEMENTOR_VERSION' ) ) { ?>
                    <?php if ( comments_open() ) { ?>

                        <div class="page-post-comments">
                            <?php comments_template(); ?>
                        </div>

                    <?php } ?>
                <?php } ?>

            <?php endwhile; ?>
            <?php if( !defined( 'ELEMENTOR_VERSION' ) ) : ?></div><?php endif; ?>

        <?php endif; ?>

    </div><!-- page_box -->

<?php else : ?>
    <?php if( !defined( 'ELEMENTOR_VERSION' ) ) : ?><div class="container"><?php endif; ?>
    <?php get_template_part( 'partials/content', 'none' ); ?>
    <?php if( !defined( 'ELEMENTOR_VERSION' ) ) : ?></div><?php endif; ?>
<?php endif;