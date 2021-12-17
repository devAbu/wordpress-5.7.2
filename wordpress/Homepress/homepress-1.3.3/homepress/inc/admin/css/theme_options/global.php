<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';
$links_color = ( !empty( $to['links_color'] ) ) ? $to['links_color'] : $third_color;
$links_color_action = ( !empty( $to['links_color_action'] ) ) ? $to['links_color_action'] : $third_color;

//Button
$button_text_color = ( !empty( $to['button_text_color'] ) ) ? $to['button_text_color'] : '#ffffff';
$button_text_color_action = ( !empty( $to['button_text_color_action'] ) ) ? $to['button_text_color_action'] : '#ffffff';
$button_background_color = ( !empty( $to['button_background_color'] ) ) ? $to['button_background_color'] : $third_color;
$buttons_border_radius = ( !empty( $to['buttons_border_radius'] ) ) ? $to['buttons_border_radius'] : '0';
$buttons_text_transform = ( !empty( $to['buttons_text_transform'] ) ) ? $to['buttons_text_transform'] : 'uppercase';
$buttons_font_weight = ( !empty( $to['buttons_font_weight'] ) ) ? $to['buttons_font_weight'] : '600';
$buttons_font_size = ( !empty( $to['buttons_font_size'] ) ) ? $to['buttons_font_size'] : '13';
$buttons_line_height = ( !empty( $to['buttons_line_height'] ) ) ? $to['buttons_line_height'] : '18';
$button_background_color_action = ( !empty( $to['button_background_color_action'] ) ) ? $to['button_background_color_action'] : $third_color;

//Fonts
$secondary_font = ( !empty( $to['default_header_font_family'] ) ) ? $to['default_header_font_family'] : 'Raleway, sans-serif';

//Background colors
$body_background_color = ( !empty( $to['body_background_color'] ) ) ? $to['body_background_color'] : '#ffffff';

?>

body {
    background-color: <?php echo esc_attr( $body_background_color ); ?>;
}

a {
    color: <?php echo esc_attr( $links_color ); ?>;
}
a:hover {
    color: <?php echo esc_attr( $links_color_action ); ?>;
}

.attribute-title-box {
    font-family: <?php echo esc_attr( $secondary_font ); ?>;
}

.ulisting_posts_carousel.owl-carousel.outer_nav .owl-nav button:before,
.ulisting_posts_carousel.owl-carousel.outer_nav .owl-nav button:hover {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.homepress-button,
input[type="submit"],
button[type="submit"] {
    background-color: <?php echo esc_attr( $button_background_color ); ?>;
    border-radius: <?php echo esc_attr( $buttons_border_radius ); ?>px;
    text-transform: <?php echo esc_attr( $buttons_text_transform ); ?>;
    font-weight: <?php echo esc_attr( $buttons_font_weight ); ?>;
    font-size: <?php echo esc_attr( $buttons_font_size ); ?>px;
    line-height: <?php echo esc_attr( $buttons_line_height ); ?>px;
    color: <?php echo esc_attr( $button_text_color ); ?>;
}
.homepress-button:hover {
    background-color: <?php echo esc_attr( $button_background_color_action ); ?>;
    color: <?php echo esc_attr( $button_text_color_action ); ?>;
}

.homepress-button-outline-full,
.homepress-button-outline {
    border-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.homepress-button-outline-full:hover,
.homepress-button-outline:hover {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.site-content blockquote,
.site-content q {
    border-left-color: <?php echo esc_attr( $third_color ); ?>;
}

.site-content table thead {
    border-top-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.site-content ul li:before {
    border-color: <?php echo esc_attr( $secondary_color ); ?>;
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.elementor-widget-wp-widget-categories .elementor-widget-container ul li a:before,
.widget.widget_categories ul li a:before,
.widget.widget_nav_menu ul li a:before,
.widget.widget_pages ul li a:before,
.widget.widget_stm_services_cat ul li a:before {
    border-color: <?php echo esc_attr( $secondary_color ); ?>;
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.site-content dl dt:before,
.homepress_property_slider .owl-nav button span:hover {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.pagination li .post-page-numbers current,
.pagination li a:hover {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.homepress-checkbox label input:checked~.checkbox-frame {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}

body .mx-datepicker.stm-date-picker i {
    color: <?php echo esc_attr( $third_color ); ?>;
}
input[type=submit] {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
input[type=submit]:hover {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}
body .irs span.irs-max,
body .irs span.irs-min,
body .irs--round .irs-from,
body .irs--round .irs-to,
body .irs--round .irs-bar {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
body .irs span.irs-single {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}
body .irs--round .irs-from:before,
body .irs--round .irs-to:before,
body .irs span.irs-single:before {
border-top-color: <?php echo esc_attr( $third_color ); ?>;
}
body .irs--round .irs-handle {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
body .irs--round .irs-handle:hover {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.select2 {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.select2-container--open .select2-dropdown {
    border-color: <?php echo esc_attr( $primary_color ); ?>;
}
.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}

.page-links a:hover,
.stm-listing-pagination .pagination li a:hover,
.site-content ul.page-numbers li .page-numbers:hover,
ul.page-numbers li .page-numbers:hover {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.page-links a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}

.contact-form .contact-form-field .contact-from-icon {
color: <?php echo esc_attr( $secondary_color ); ?>;
}

.wp-block-button__link {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.wp-block-button__link:hover {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}
.is-style-outline .wp-block-button__link {
    border-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.is-style-outline .wp-block-button__link:hover {
    border-color: <?php echo esc_attr( $third_color ); ?>;
    background-color: transparent;
}

.is-style-solid-color {
    border-left: 5px solid <?php echo esc_attr( $third_color ); ?> !important;
}

.comment-list li .comment-body .comment-info .comment-meta a.comment-reply-link:hover,
.comment-list li .comment-body .comment-info .comment-meta a.comment-edit-link:hover {
    color: <?php echo esc_attr( $links_color ); ?> !important;
}