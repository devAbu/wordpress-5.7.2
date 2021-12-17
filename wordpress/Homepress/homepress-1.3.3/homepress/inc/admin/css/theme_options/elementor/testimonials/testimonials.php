<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';

?>

.elementor-testimonial-content:before {
    color: <?php echo esc_attr( $third_color ); ?>;
}

.testimonials-list_style_5 .testimonials-item .testimonials-content-wrap .testimonial-title-wrap .testimonials-thumbnail {
    border-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.testimonials-list_style_5 .testimonials_list_carousel.owl-carousel .owl-nav button:before,
.testimonials-list_style_5 .testimonials_list_carousel.owl-carousel .owl-nav button:hover {
background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
