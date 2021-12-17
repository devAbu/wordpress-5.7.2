<?php
//Get the ID for metaboxes fields
$id = get_the_ID();
if ( is_home() ) {
    $id = ( !empty ( get_option( 'page_for_posts' ) ) ) ? get_option( 'page_for_posts' ) : $id;
}
if ( is_tax() ) {
    $id = get_queried_object()->term_id;
}

//Breadcrumbs settings
$breadcrumbs = get_post_meta( $id, 'title_box_breadcrumbs', 'global' );
if ( empty( $breadcrumbs ) || $breadcrumbs == 'global' ) {
    $breadcrumbs = homepress_get_option( 'title_box_breadcrumbs' );
}

?>

<?php if ( !empty( $breadcrumbs ) && $breadcrumbs !== 'hide' && function_exists('bcn_display' ) ) { ?>
<div class="title-box_style_1">

    <div class="breadcrumbs-wrap">

        <div class="container">

            <?php if( function_exists('bcn_display' ) ) { ?>
                <div class="breadcrumbs">

                    <?php bcn_display(); ?>

                </div>
            <?php } ?>

        </div>

    </div>

</div>
<?php } ?>