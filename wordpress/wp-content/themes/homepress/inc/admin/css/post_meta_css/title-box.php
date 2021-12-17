<?php
$id = get_the_ID();
$breadcrumbs_style_1_color = get_post_meta( $id, 'title_box_style_1_breadcrumbs_color', true );
$breadcrumbs_style_1_action_color = get_post_meta( $id, 'title_box_style_1_breadcrumbs_action_color', true );
$breadcrumbs_style_1_bg_color = get_post_meta( $id, 'title_box_style_1_breadcrumbs_bg_color', true );
$breadcrumbs_style_1_border_color = get_post_meta( $id, 'title_box_style_1_border_color', true );

$text_style_2_color = get_post_meta( $id, 'title_box_style_2_color', true );
$background_style_2_color = get_post_meta( $id, 'title_box_style_2_bg_color', true );
$breadcrumbs_style_2_color = get_post_meta( $id, 'title_box_style_2_breadcrumbs_color', true );
$breadcrumbs_style_2_color_action = get_post_meta( $id, 'title_box_style_2_breadcrumbs_action_color', true );
$background_style_2_image = get_post_meta( $id, 'title_box_style_2_bg_image', true );
if( !empty( $background_style_2_image ) ) {
    $background_style_2_image = homepress_get_image_url( $background_style_2_image );
}

?>
<?php if( !empty( $breadcrumbs_style_1_bg_color ) ) { ?>
.title-box_style_1 .breadcrumbs-wrap {
    background-color: <?php echo esc_attr( $breadcrumbs_style_1_bg_color ); ?> !important;
}
<?php } ?>
<?php if( !empty( $breadcrumbs_style_1_border_color ) ) { ?>
.title-box_style_1 .breadcrumbs-wrap .breadcrumbs {
    border-top-color: <?php echo esc_attr( $breadcrumbs_style_1_border_color ); ?> !important;
}
<?php } ?>
<?php if( !empty( $breadcrumbs_style_1_color ) ) { ?>
.title-box_style_1 .breadcrumbs-wrap .breadcrumbs,
.title-box_style_1 .breadcrumbs-wrap .breadcrumbs a {
    color: <?php echo esc_attr( $breadcrumbs_style_1_color ); ?> !important;
}
<?php } ?>
<?php if( !empty( $breadcrumbs_style_1_action_color ) ) { ?>
.title-box_style_1 .breadcrumbs-wrap .breadcrumbs a:hover {
    color: <?php echo esc_attr( $breadcrumbs_style_1_action_color ); ?> !important;
}
<?php } ?>
<?php if( !empty( $text_style_2_color ) ) { ?>
.title-box_style_2 {
    color: <?php echo esc_attr( $text_style_2_color ); ?> !important;
}
.title-box_style_2 .title-box-title h1 {
    color: <?php echo esc_attr( $text_style_2_color ); ?> !important;
}
<?php } ?>
<?php if( !empty( $breadcrumbs_style_2_color ) ) { ?>
.title-box_style_2 .breadcrumbs,
.title-box_style_2 .breadcrumbs a {
    color: <?php echo esc_attr( $breadcrumbs_style_2_color ); ?> !important;
}
<?php } ?>
<?php if( !empty( $breadcrumbs_style_2_color_action ) ) { ?>
.title-box_style_2 .breadcrumbs a:hover {
    color: <?php echo esc_attr( $breadcrumbs_style_2_color_action ); ?> !important;
}
<?php } ?>
<?php if( !empty( $background_style_2_color ) ) { ?>
.title-box_style_2 {
    background-color: <?php echo esc_attr( $background_style_2_color ); ?> !important;
}
<?php } ?>
<?php if( !empty( $background_style_2_image ) ) { ?>
.title-box_style_2 {
    background-image: url("<?php echo esc_attr( $background_style_2_image ); ?>") !important;
}
<?php } ?>
