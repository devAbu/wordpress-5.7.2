<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';

?>

#image_carousel_full.owl-carousel .owl-nav .owl-prev:hover,
#image_carousel_full.owl-carousel .owl-nav .owl-next:hover {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

#image_carousel_thumb.owl-carousel .owl-item.current .item:after {
    border-color: <?php echo esc_attr( $secondary_color ); ?>;
}