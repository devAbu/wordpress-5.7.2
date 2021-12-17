<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
//global
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';

//Title box settings
$breadcrumbs_style_1_color = ( !empty( $to['title_box_style_1_breadcrumbs_color'] ) ) ? $to['title_box_style_1_breadcrumbs_color'] : $primary_color;
$breadcrumbs_style_1_color_action = ( !empty( $to['title_box_style_1_breadcrumbs_action_color'] ) ) ? $to['title_box_style_1_breadcrumbs_action_color'] : $primary_color;
$breadcrumbs_style_1_bg_color = ( !empty( $to['title_box_style_1_breadcrumbs_bg_color'] ) ) ? $to['title_box_style_1_breadcrumbs_bg_color'] : '#ffffff';
$breadcrumbs_style_1_border_color = ( !empty( $to['title_box_style_1_border_color'] ) ) ? $to['title_box_style_1_border_color'] : '#dedfdf';

$text_style_2_color = ( !empty( $to['title_box_style_2_color'] ) ) ? $to['title_box_style_2_color'] : '#ffffff';
$background_style_2_color = ( !empty( $to['title_box_style_2_bg_color'] ) ) ? $to['title_box_style_2_bg_color'] : $secondary_color;
$breadcrumbs_style_2_color = ( !empty( $to['title_box_style_2_breadcrumbs_color'] ) ) ? $to['title_box_style_2_breadcrumbs_color'] : '#ffffff';
$breadcrumbs_style_2_color_action = ( !empty( $to['title_box_style_2_breadcrumbs_action_color'] ) ) ? $to['title_box_style_2_breadcrumbs_action_color'] : '#ffffff';

$background_style_2_image = homepress_get_option( 'title_box_style_2_bg_image' );
if( !empty( $background_style_2_image ) ) {
    $background_style_2_image = homepress_get_image_url( $background_style_2_image );
}

?>

.title-box_style_1 .breadcrumbs-wrap {
    background-color: <?php echo esc_attr( $breadcrumbs_style_1_bg_color ); ?>;
}

.title-box_style_1 .breadcrumbs-wrap .breadcrumbs {
    border-top-color: <?php echo esc_attr( $breadcrumbs_style_1_border_color ); ?>;
}

.title-box_style_1 .breadcrumbs-wrap .breadcrumbs,
.title-box_style_1 .breadcrumbs-wrap .breadcrumbs a {
    color: <?php echo esc_attr( $breadcrumbs_style_1_color ); ?>;
}

.title-box_style_1 .breadcrumbs-wrap .breadcrumbs a:hover {
    color: <?php echo esc_attr( $breadcrumbs_style_1_color_action ); ?>;
}

.title-box_style_2 {
    color: <?php echo esc_attr( $text_style_2_color ); ?>;
    background-color: <?php echo esc_attr( $background_style_2_color ); ?>;
<?php if( !empty( $background_style_2_image ) ) : ?>
    background-image: url("<?php echo esc_attr( $background_style_2_image ); ?>");
<?php endif; ?>
}

.title-box_style_2:after {
    background-color: <?php echo esc_attr( $primary_color ); ?>
}

.title-box_style_2 .title-box-title h1 {
    color: <?php echo esc_attr( $text_style_2_color ); ?>;
}

.title-box_style_2 .breadcrumbs,
.title-box_style_2 .breadcrumbs a {
    color: <?php echo esc_attr( $breadcrumbs_style_2_color ); ?>;
}

.title-box_style_2 .breadcrumbs a:hover {
    color: <?php echo esc_attr( $breadcrumbs_style_2_color_action ); ?>;
}