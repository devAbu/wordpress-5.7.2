<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';

//Fonts
$secondary_font = ( !empty( $to['default_header_font_family'] ) ) ? $to['default_header_font_family'] : 'Raleway, sans-serif';
?>

.listing-single-info-style_1 .container .listing-type-list span {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}

.single-listing-form_style_1 .contact-form-field .field-icon {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.single-listing-form_style_1 .form-phone .form-phone-icon.verified_user {
    color: <?php echo esc_attr( $third_color ); ?>;
}

.mortgage_calc_box {
    background-color: <?php echo esc_attr( $primary_color ); ?>;
}

.elementor_calc #mortgage_calc .calc-close-button {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.elementor_calc #mortgage_calc .calc-close-button:hover {
    background-color: <?php echo esc_attr( $primary_color ); ?>;
}

.mortgage_calc_box:before {
    border-bottom-color: <?php echo esc_attr( $primary_color ); ?> !important;
}

.mortgage_calc_box .calc-results {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.yelp_nearby_box .yelp_category_list .yelp_category_icon {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.site-content #listing-page-statistics ul.nav li a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.site-content #listing-page-statistics ul.nav li a:hover {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.site-content #listing-page-statistics ul.nav li a.active {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.site-content #listing-page-statistics ul.nav li a:before {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.inventory-accordion .accordion-box .accordion-box_header {
    border-top-color: <?php echo esc_attr( $primary_color ); ?>;
}
.inventory-accordion .accordion-box .accordion-box_header:hover {
    border-top-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.inventory-accordion .accordion-box .accordion-box_header:hover .accordion-box_title {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.inventory-accordion .accordion-box_header .mb-0:before {
    border-bottom-color: <?php echo esc_attr( $primary_color ); ?>;
}
.inventory-accordion .accordion-box_header:hover .mb-0:before {
    border-bottom-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.inventory-accordion .accordion-box_header .mb-0.collapsed:after {
    border-top-color: <?php echo esc_attr( $primary_color ); ?>;
}
.inventory-accordion .accordion-box_header:hover .mb-0.collapsed:after {
    border-top-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.profile-avatar_style_3 .profile-avatar-info .user-info.verified_user .verified-profile-icon {
    color: <?php echo esc_attr( $third_color ); ?>;
}

@media (max-width: 767px) {
    .mobile-black-color {
        color: <?php echo esc_attr( $primary_color ); ?> !important;
    }
}