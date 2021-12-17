<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';
$links_color = ( !empty( $to['links_color'] ) ) ? $to['links_color'] : '#358EE1';

//Fonts
$secondary_font = ( !empty( $to['default_header_font_family'] ) ) ? $to['default_header_font_family'] : 'Raleway, sans-serif';

?>

.widget .widget-title{
    border-top-color: <?php echo esc_attr( $third_color ); ?>;
}

.search-form .search-submit {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.widget.widget_recent_entries ul li a,
.elementor-widget-wp-widget-recent-posts ul li a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}

.widget.widget_recent_entries ul li a:hover,
.elementor-widget-wp-widget-recent-posts ul li a:hover {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.widget.widget_recent_entries ul li a:before,
.elementor-widget-wp-widget-recent-posts ul li a:before {
    background-color: <?php echo esc_attr( $secondary_color ); ?> !important;
}

.widget.widget_meta ul li a,
.elementor-widget-wp-widget-meta ul li a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}

.widget.widget_meta ul li a:hover,
.elementor-widget-wp-widget-meta ul li a:hover,
.widget.widget_nav_menu ul li:after,
.widget.widget_categories ul li:after,
.widget.widget_stm_services_cat ul li:after,
.elementor-widget-wp-widget-categories .elementor-widget-container ul li:after,
.widget.widget_pages ul li:after,
.widget.widget_nav_menu ul li ul li:after {
    background-color: <?php echo esc_attr( $third_color ); ?>;
    border-color: <?php echo esc_attr( $third_color ); ?>;
}

.widget.widget_nav_menu ul li a,
.widget.widget_pages ul li a,
.widget.widget_categories ul li a,
.widget.widget_stm_services_cat ul li a,
.elementor-widget-wp-widget-categories .elementor-widget-container ul li a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.widget.widget_nav_menu ul li a:hover,
.widget.widget_pages ul li a:hover,
.widget.widget_categories ul li a:hover,
.widget.widget_stm_services_cat ul li a:hover,
.elementor-widget-wp-widget-categories .elementor-widget-container ul li a:hover {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.widget.widget_recent_comments ul li a,
.elementor-widget-container ul li a,
.widget.widget_archive ul li a,
.elementor-widget-wp-widget-archives ul li a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}

.widget.widget_recent_comments ul li:before,
.widget.widget_recent_comments ul li a:hover,
.elementor-widget-container ul li:before,
.elementor-widget-container ul li a:hover,
.widget.widget_archive ul li a:hover,
.elementor-widget-wp-widget-archives ul li a:hover {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.widget.widget_archive ul li:before,
.elementor-widget-wp-widget-archives ul li:before {
    color: <?php echo esc_attr( $third_color ); ?>;
}
.site-content .widget_calendar table thead {
    border-top-color: <?php echo esc_attr( $third_color ); ?>;
}
#wp-calendar tbody td#today {
    border-color: <?php echo esc_attr( $third_color ); ?>;
}
.widget.widget_calendar #wp-calendar tbody td a:hover,
.widget.widget_calendar #wp-calendar tbody th a:hover,
.elementor-widget-wp-widget-calendar #wp-calendar tbody td a:hover,
.elementor-widget-wp-widget-calendar #wp-calendar tbody th a:hover {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.widget.widget_rss a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.widget.widget_rss a:hover {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.stm_proterty_menu_more span {
    color: <?php echo esc_attr( $links_color ); ?>;
}
.stm_proterty_menu_more span.proterty_menu_hide,
.stm_proterty_menu_more span:hover {
    color: <?php echo esc_attr( $third_color ); ?>;
}

.wpml-ls-statics-shortcode_actions.homepress_vr>ul>li .wpml-ls-sub-menu {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.wpml-ls-statics-shortcode_actions.homepress_vr>ul>li .wpml-ls-sub-menu li a:hover {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}
.wpml-ls-statics-shortcode_actions.homepress_vr.light_vr>ul>li:hover > a {
    color: #ffffff;
}