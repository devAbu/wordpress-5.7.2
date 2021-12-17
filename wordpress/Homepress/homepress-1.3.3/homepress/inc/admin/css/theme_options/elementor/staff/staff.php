<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';

?>

.elementor-widget-homepress-staff .staff-title {
    color: <?php echo esc_attr( $primary_color ); ?>;
}

.elementor-widget-homepress-staff .style_2 .staff-item:hover .staff-thumbnail img {
    border-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.elementor-widget-homepress-staff .style_2 .owl-nav button:before,
.elementor-widget-homepress-staff .style_2 .owl-nav button:hover {
background-color: <?php echo esc_attr( $secondary_color ); ?> !important;
}

.elementor-widget-homepress-staff .staff-socials a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}