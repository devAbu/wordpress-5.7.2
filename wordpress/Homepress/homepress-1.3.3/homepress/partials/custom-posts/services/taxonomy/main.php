<?php
//Services archive style
$services_archive_style = homepress_get_option('services_archive_style' );

//Title settings
$title_box_style = homepress_get_option( 'title_box_style' );
$title = homepress_get_option( 'title_box_title' );

//Sidebar settings
$sidebar_id = homepress_get_option( 'services_sidebar_id' );
if ( $sidebar_id == 'global' ) {
    $sidebar_id = homepress_get_option( 'sidebar_id' );
}
$sidebar_position = homepress_get_option( 'services_sidebar_position' );
if ( $sidebar_position == 'global' ) {
    $sidebar_position = homepress_get_option( 'sidebar_position' );
}

//Get posts by taxonomy id
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
if ( is_tax() ) {
    $taxonomy_id = get_queried_object()->term_id;
}

$args = array(
    'post_type' => 'stmt-services',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'paged' => $paged,
    'tax_query' => array(
        array(
            'taxonomy' => 'stmt-services-taxonomy',
            'field'    => 'id',
            'terms'    => $taxonomy_id,
        ),
    ),
);

$services = new WP_Query( $args );

if ( $services->have_posts() ) : ?>

    <div class="archive-services-<?php echo esc_attr( $services_archive_style ); ?>">

        <div class="container">

            <div class="row">

                <?php if ( $sidebar_position == 'left' && is_active_sidebar( $sidebar_id )  ) { ?>

                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-box archive-services__sidebar">
                        <?php dynamic_sidebar( $sidebar_id ); ?>
                    </div><!-- sidebar left -->

                <?php } ?>

                <div class="<?php if ( is_active_sidebar( $sidebar_id ) ) : ?>col-lg-9<?php else: ?>col-lg-12<?php endif; ?> col-md-12 col-sm-12 col-sm archive-services__content">

                    <?php if ( !empty( $title ) && $title_box_style == 'style_1' ) { ?>

                        <h1 class="site-title"><?php single_term_title(); ?></h1>

                    <?php } ?>

                    <div class="row">

                        <?php while ( $services->have_posts() ): $services->the_post(); ?>

                            <div class="col-lg-4 col-md-4 col-sm-6">

                                <?php get_template_part("partials/custom-posts/services/styles/{$services_archive_style}"); ?>

                            </div>

                        <?php endwhile;

                        wp_reset_postdata();

                        ?>

                    </div>

                    <?php

                    get_template_part('partials/global/pagination' );

                    ?>

                </div><!-- archive content -->

                <?php if ( $sidebar_position == 'right' && is_active_sidebar( $sidebar_id )  ) { ?>

                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-box archive-services__sidebar">
                        <?php dynamic_sidebar( $sidebar_id ); ?>
                    </div><!-- sidebar right -->

                <?php } ?>

            </div><!-- row -->

        </div><!-- container -->

    </div><!-- archive services -->


<?php else: ?>

    <?php get_template_part( 'partials/content', 'none' ); ?>

<?php endif;