<?php
//Get the ID for metaboxes fields
$id = get_the_ID();
$header_position = get_post_meta( $id, 'header_position', 'global' );
if ( $header_position == 'global' ) {
    $header_position = homepress_get_option( 'header_position' );
}

?>
<div class="header-box homepress-header-default header-simple header-position_<?php echo esc_attr( $header_position ); ?>">
    <header id="masthead" class="site-header">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-3 col-md-4 col-sm-6 col-10">

                    <?php get_template_part( 'partials/header/parts/_logo' ); ?>

                </div>

                <div class="col-lg-9 col-md-8 col-sm-6 col-2">

                    <?php get_template_part( 'partials/header/parts/_menu' ); ?>

                </div>

            </div>
        </div>
    </header>
</div>