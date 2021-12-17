<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';

?>


.ulisting_posts_box .owl-nav .owl-next:hover,
.ulisting_feature_box .owl-nav .owl-prev:hover {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.ulisting_posts_box .owl-dots .owl-dot.active {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}