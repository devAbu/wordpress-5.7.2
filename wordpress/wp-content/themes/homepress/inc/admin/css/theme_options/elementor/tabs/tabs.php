<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';

?>

.elementor-widget-tabs .elementor-tabs-wrapper  .elementor-tab-title.elementor-active  {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}

@media (max-width: 767px) {
    .elementor-widget-tabs .elementor-tab-mobile-title {
        background-color: <?php echo esc_attr( $primary_color ); ?>;
        border-color: <?php echo esc_attr( $primary_color ); ?>;
    }

    .elementor-widget-tabs .elementor-tab-mobile-title.elementor-active {
        background-color: <?php echo esc_attr( $third_color ); ?>;
        border-color: <?php echo esc_attr( $third_color ); ?>;
    }
}
