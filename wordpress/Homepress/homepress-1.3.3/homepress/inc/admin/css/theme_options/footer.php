<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
//global
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';
//footer
$footer_main_bg_color = ( !empty( $to['footer_main_bg_color'] ) ) ? $to['footer_main_bg_color'] : $primary_color;
$footer_main_text_color = ( !empty( $to['footer_main_text_color'] ) ) ? $to['footer_main_text_color'] : 'rgba(225,225,225, 0.5)';
$footer_main_links_color = ( !empty( $to['footer_main_links_color'] ) ) ? $to['footer_main_links_color'] : 'rgba(225,225,225, 0.5)';
$footer_main_links_action_color = ( !empty( $to['footer_main_links_action_color'] ) ) ? $to['footer_main_links_action_color'] : 'rgba(225,225,225, 1)';
//copyright
$copyright_bg_color = ( !empty( $to['copyright_bg_color'] ) ) ? $to['copyright_bg_color'] : 'transparent';
$copyright_text_color = ( !empty( $to['copyright_text_color'] ) ) ? $to['copyright_text_color'] : $footer_main_text_color;
$copyright_links_color = ( !empty( $to['copyright_links_color'] ) ) ? $to['copyright_links_color'] : $footer_main_links_color;
$copyright_links_action_color = ( !empty( $to['copyright_links_action_color'] ) ) ? $to['copyright_links_action_color'] : $footer_main_links_action_color;
$copyright_border_line_color = ( !empty( $to['copyright_border_line_color'] ) ) ? $to['copyright_border_line_color'] : $footer_main_text_color;

?>

footer.site-footer {
	background-color: <?php echo esc_attr( $footer_main_bg_color ); ?>;
	color: <?php echo esc_attr( $footer_main_text_color ); ?>;
}
footer.site-footer a {
    color: <?php echo esc_attr( $footer_main_links_color ); ?>;
}
footer.site-footer a:hover,
footer.site-footer a:focus,
footer.site-footer a:active {
    color: <?php echo esc_attr( $footer_main_links_action_color ); ?>;
}

footer.site-footer .copyright_box {
    background-color: <?php echo esc_attr( $copyright_bg_color ); ?>;
    color: <?php echo esc_attr( $copyright_text_color ); ?>;
}
footer.site-footer .copyright_box a {
    color: <?php echo esc_attr( $copyright_links_color ); ?>;
}
footer.site-footer .copyright_box a:hover,
footer.site-footer .copyright_box a:focus,
footer.site-footer .copyright_box a:active {
    color: <?php echo esc_attr( $copyright_links_action_color ); ?>;
}