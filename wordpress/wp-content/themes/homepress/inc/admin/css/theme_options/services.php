<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';

//Fonts
$secondary_font = ( !empty( $to['default_header_font_family'] ) ) ? $to['default_header_font_family'] : 'Raleway, sans-serif';
?>

.elementor-services_content:hover .services-title a h3,
.archive-services__content .archive-services_content:hover .services-title a h2 {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.archive-services__content .archive-services_content .services-thumbnail .services-icon:before {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
