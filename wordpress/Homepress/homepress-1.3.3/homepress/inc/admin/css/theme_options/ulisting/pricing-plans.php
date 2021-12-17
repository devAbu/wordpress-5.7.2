<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';

//Fonts
$secondary_font = ( !empty( $to['default_header_font_family'] ) ) ? $to['default_header_font_family'] : 'Raleway, sans-serif';
?>

.pricing-plan-box:before {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.pricing-plan-box:hover {
    border-color: <?php echo esc_attr( $third_color ); ?>;
}
.pricing-plan-box:hover:before {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}
.payment_box .pricing-plan-box:hover:before {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.pricing-plan-box .pricing-plan-price {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}