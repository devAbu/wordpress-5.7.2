<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';

//Fonts
$secondary_font = ( !empty( $to['default_header_font_family'] ) ) ? $to['default_header_font_family'] : 'Raleway, sans-serif';
?>

.attribute_style.attribute_style_5 ul li::before {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.attribute_style .attribute-icon {
    color: <?php echo esc_attr( $third_color ); ?>;
}
.attribute_style.attribute_style_4 .attribute-icon {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.site-content .ulisting-tabs li a,
.ulisting-tabs li a {
    background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.site-content .ulisting-tabs li a:before,
.ulisting-tabs li a:before {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.site-content .ulisting-tabs li a.active,
.ulisting-tabs li a.active {
    color: <?php echo esc_attr( $primary_color ); ?>;
}

.wishlist-page-link {
    border-color: <?php echo esc_attr( $secondary_color ); ?>;
   color: <?php echo esc_attr( $primary_color ); ?>;
}
.wishlist-page-link .wishlist-total {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}