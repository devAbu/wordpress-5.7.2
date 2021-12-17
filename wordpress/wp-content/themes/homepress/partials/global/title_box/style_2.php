<?php
//Get the ID for metaboxes fields
$id = get_the_ID();
if ( is_home() ) {
    $id = ( !empty ( get_option( 'page_for_posts' ) ) ) ? get_option( 'page_for_posts' ) : $id;
}

if ( is_tax() ) {
    $id = get_queried_object()->term_id;
}

//Title settings
$title = get_post_meta( $id, 'title_box_title', 'global' );
if ( empty( $title ) || $title == 'global' ) {
    $title = homepress_get_option( 'title_box_title' );
}

//Breadcrumbs settings
$breadcrumbs = get_post_meta( $id, 'title_box_breadcrumbs', 'global' );
if ( empty( $breadcrumbs ) || $breadcrumbs == 'global' ) {
    $breadcrumbs = homepress_get_option( 'title_box_breadcrumbs' );
}

?>

<div class="title-box_style_2">

    <?php if ( !empty( $breadcrumbs ) && $breadcrumbs !== 'hide' ) { ?>
    <div class="container">

        <?php if( function_exists('bcn_display' ) ) { ?>
        <div class="breadcrumbs <?php if ( empty( $title ) ) { ?>with-indent<?php } ?>">

            <?php bcn_display(); ?>

        </div>
        <?php } ?>

    </div>
    <?php } ?>

    <?php if ( !empty( $title ) && $title !== 'hide' ) { ?>
    <div class="title-box-title">

        <div class="container">

            <h1><?php
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

        </div>

    </div>
    <?php } ?>

</div>