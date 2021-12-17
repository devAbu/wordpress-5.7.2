<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';

//Fonts
$secondary_font = ( !empty( $to['default_header_font_family'] ) ) ? $to['default_header_font_family'] : 'Raleway, sans-serif';
?>

.listing-gallery_style_2 .listing-gallery-list .item a:after {
    border-color: #ffffff;
}
.listing-gallery-auxiliary-buttons > div,
.listing-gallery-auxiliary-buttons > a {
    background-color: <?php echo esc_attr( $primary_color ); ?>;
}

.listing-gallery-auxiliary-buttons > div.active,
.listing-gallery-auxiliary-buttons > div:hover,
.listing-gallery-auxiliary-buttons > a:hover {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}
