<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';

//Fonts
$secondary_font = ( !empty( $to['default_header_font_family'] ) ) ? $to['default_header_font_family'] : 'Raleway, sans-serif';
?>

.stm_testimonials .testimonials-content .testimonials-icon {
    color: <?php echo esc_attr( $third_color ); ?>;
}

.testimonials-list_style_2 .testimonials-position {
    color: <?php echo esc_attr( $third_color ); ?>;
}
.testimonials-list .testimonials-icon {
    color: <?php echo esc_attr( $third_color ); ?>;
}

.testimonials-list_style_3 .testimonials-position,
.testimonials-list_style_3 .testimonials-thumbnail:before,
.testimonials-list_style_3 .testimonials-item .testimonials-thumbnail-wrap .testimonials-icon,
.testimonials-list_style_4 .testimonials-position {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.testimonials_list_carousel.owl-carousel .owl-nav button.owl-next,
.testimonials_list_carousel.owl-carousel .owl-nav button.owl-prev {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.testimonials_list_carousel.owl-carousel .owl-nav button.owl-next:hover,
.testimonials_list_carousel.owl-carousel .owl-nav button.owl-prev:hover {
    background-color: <?php echo esc_attr( $secondary_color ); ?> !important;
}
.testimonials_list_carousel .owl-dots .owl-dot.active {
    background-color: <?php echo esc_attr( $secondary_color ); ?> !important;
}