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

.search-box-icon {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.ulisting-search_box_style_5 #unical-id-for-search-box:focus + label .search-box-icon {
    color: <?php echo esc_attr( $third_color ); ?>;
}
.ulisting-search_box_style_1 ul li a {
    background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.ulisting-search_box_style_1 ul li a.nav-link.active {
    color: <?php echo esc_attr( $third_color ); ?>;
}
.ulisting-search_box_style_1 .nav-tabs li:before,
.ulisting-search_box_style_1 ul li.tab_active:before {
    background-color: <?php echo esc_attr( $primary_color ); ?> !important;
}
.ulisting-search_box_style_1 .tab-content .advanced-search-item:before,
.ulisting-search_box_style_1 .tab-content:before {
    background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.ulisting-search_box_style_1 .tab-content .advanced-search-item>div .homepress-checkbox label input:checked~.checkbox-frame {
    background-color: <?php echo esc_attr( $third_color ); ?> !important;
}

.ulisting-search_box_style_2 .tab-content .row .advanced-search-item-wrap .advanced-search-item:before,
.ulisting-search_box_style_3 .tab-content .row .advanced-search-item-wrap .advanced-search-item:before,
.ulisting-search_box_style_4 .tab-content .row .advanced-search-item-wrap .advanced-search-item:before {
    background-color: <?php echo esc_attr( $primary_color ); ?>;
}

.ulisting-search_box_style_2 .nav-tabs li a.active:before {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.ulisting-search_box_style_3 .nav-tabs li a.active:before,
.ulisting-search_box_style_4 .nav-tabs li a.active:before,
.ulisting-search_box_style_5 .nav-tabs li a.active:before {
    border-color: <?php echo esc_attr( $third_color ); ?>;
}
.ulisting-search_box_style_3 .tab-content .row .advanced-search-button,
.ulisting-search_box_style_4 .tab-content .row .advanced-search-button {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.ulisting-search_box_style_3 .tab-content .row .advanced-search-button .button-text,
.ulisting-search_box_style_4 .tab-content .row .advanced-search-button .button-text {
    border-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.ulisting-search_box_style_1 .tab-content .row .advanced-search-item-wrap .advanced-search-item>div .homepress-checkbox label .checkbox-frame .fa,
.ulisting-search_box_style_2 .tab-content .row .advanced-search-item-wrap .advanced-search-item>div .homepress-checkbox label .checkbox-frame .fa,
.ulisting-search_box_style_3 .tab-content .row .advanced-search-item-wrap .advanced-search-item>div .homepress-checkbox label .checkbox-frame .fa,
.ulisting-search_box_style_4 .tab-content .row .advanced-search-item-wrap .advanced-search-item>div .homepress-checkbox label .checkbox-frame .fa {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}

.ulisting-search_box .tab-content .row input[type=text]:active,
.ulisting-search_box .tab-content .row input[type=text]:focus {
    border-color: <?php echo esc_attr( $third_color ); ?>;
}
.ulisting-search_box .tab-content .row .select2-selection.select2-selection--single:hover .select2-selection__rendered,
.ulisting-search_box .tab-content .row .select2-selection.select2-selection--single:hover .select2-selection__arrow b:before {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.ulisting-reset-filter a:hover,
.ulisting-save-search:hover {
    color: <?php echo esc_attr( $links_color ); ?>;
}

body .inventory-serach-filter .uListing-autocomplete-items .uListing-autocomplete-wrapper {
    border-top-color: <?php echo esc_attr( $third_color ); ?>;
}
body .inventory-serach-filter .uListing-autocomplete-items .uListing-autocomplete-wrapper .uListing-search-post-title {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
body .inventory-serach-filter .uListing-autocomplete-items:before {
    border-bottom-color: <?php echo esc_attr( $third_color ); ?>;
}
.uListing-search-founded {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}
body .inventory-serach-filter .uListing-autocomplete-items .uListing-autocomplete-wrapper .uListing-search-no-result {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}