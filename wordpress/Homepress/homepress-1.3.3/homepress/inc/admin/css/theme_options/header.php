<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';

//Fonts
$secondary_font = ( !empty( $to['default_header_font_family'] ) ) ? $to['default_header_font_family'] : 'Raleway, sans-serif';

//Background colors
$header_main_bg_color = ( !empty( $to['header_main_bg_color'] ) ) ? $to['header_main_bg_color'] : '#ffffff';

?>

header.site-header {
    background-color: <?php echo esc_attr( $header_main_bg_color ); ?>;
}
ul.stmt-theme-header_menu>li:before {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
ul.stmt-theme-header_menu>li > a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
ul.stmt-theme-header_menu>li:hover > a {
    color: #ffffff;
}

.homepress-custom-logo {
    color: <?php echo esc_attr( $primary_color ); ?>;
}

.stm_mobile_switcher span {
    background-color: <?php echo esc_attr( $primary_color ); ?>;
}

.stm_nav_menu ul.menu > li:hover > a,
.stm_nav_menu ul.menu > li > a:active,
.stm_nav_menu ul.menu > li > a:focus,
.stm_nav_menu ul.menu > li.active_sub_menu > a,
.stm_nav_menu ul.menu > li.current_page_item > a,
.stm_nav_menu ul.menu > li.current-menu-ancestor > a {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.stm_nav_menu ul.menu > li > ul:before,
.stm_nav_menu .menu>li>.sub-menu li .sub-menu:before, ul.stmt-theme-header_menu>li>.sub-menu li .sub-menu:before {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.stm_nav_menu.stm_nav_menu_style_2 ul.menu > li > ul:before,
.stm_nav_menu.stm_nav_menu_style_2 .menu>li>.sub-menu li .sub-menu:before {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}
.stm_nav_menu .menu>li>.sub-menu li a, ul.stmt-theme-header_menu>li>.sub-menu li a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.stm_nav_menu .menu>li>.sub-menu li a:hover, ul.stmt-theme-header_menu>li>.sub-menu li a:hover {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.has_stm_megamenu__boxed li.stm_megamenu .sub-menu-element-wrapper {
    background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.stm_nav_menu ul.menu >li > .sub-menu li.current_page_item a,
ul.stmt-theme-header_menu > li >.sub-menu li.current_page_item a {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.stm_nav_menu_style_2 ul.menu>li:hover > a {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.stm_nav_menu_style_2 ul.menu>li.current_page_item:before,
.stm_nav_menu_style_2 ul.menu>li.current-menu-ancestor:before {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}

.stm_nav_menu.active .stm_mobile_switcher,
.stm_nav_menu .stm_mobile_switcher.active:before {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}