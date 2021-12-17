<?php
//Get the ID for metaboxes fields
$id = get_the_ID();

//Title settings
$title_box_style = get_post_meta( $id, 'title_box_style', 'global' );

if ( empty($title_box_style) || $title_box_style == 'global' ) {
    $title_box_style = homepress_get_option( 'title_box_style' );
}

get_template_part( 'partials/global/title_box/' . $title_box_style );