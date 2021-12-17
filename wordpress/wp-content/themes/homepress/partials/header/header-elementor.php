<?php
//Get the ID for metaboxes fields
$id = get_the_ID();

//Header settings
if ( !empty( $id ) ) {
    $header_id = 'default';
    $header_position = 'global';
    $header_id = get_post_meta( $id, 'header_id', true );
    $header_position = get_post_meta( $id, 'header_position', true );

    if ( !is_tax() ) {
        $page_name = get_post_meta( $id, 'page_id', true );
    }
}

if ( empty( $header_position ) || $header_position == 'global' ) {
    $header_position = homepress_get_option( 'header_position' );
}
?>

<div class="header-box header-position_<?php echo esc_attr( $header_position ); ?> <?php if ( !empty( $page_name ) ) { echo esc_attr( $page_name ); } ?> ">
<?php

    if ( empty( $header_id ) ) {

        if (basename(get_page_template()) === 'idx_ihomefinder.php') {
            echo do_shortcode("[hfe_template id='" . homepress_get_option('virtual_page_header') ."']");
        } elseif ( function_exists( 'hfe_render_header' ) ) {
            hfe_render_header();
        }

    } else {

        if ( $header_id !== 'default' ) {

            echo do_shortcode( "[hfe_template id='$header_id']" );

        } else {

            if ( function_exists( 'hfe_render_header' ) ) {
                hfe_render_header();
            }

        }
    }


?>
</div>
