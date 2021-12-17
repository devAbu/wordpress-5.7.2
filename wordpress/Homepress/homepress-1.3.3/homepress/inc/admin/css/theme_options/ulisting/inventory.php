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

.inventory-loop-grid_style_5 .inventory_content_wrap .attribute-title-box {

}
.inventory-loop-grid_style_5 .inventory_content_wrap .attribute-title-box {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.inventory-loop-grid_style_5 .thumbnail_box_top i:before,
.inventory-loop-grid_style_5 .thumbnail_box_top .simple-icon:before,
.inventory-loop-grid_style_5 .inventory_content_wrap .inventory-thumbnail-box .ulisting-listing-wishlist .active_wishlist {
    color: <?php echo esc_attr( $secondary_color ); ?> !important;
}

.stm-item-preview-type-switch ul li .switch-icon {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.stm-item-preview-type-switch ul li.active .switch-icon {
    color: <?php echo esc_attr( $primary_color ); ?>;
}

.inventory-filter_style_1 .inventory-filter_attribute_box:hover .inventory-filter_attribute:after,
.inventory-filter_style_1 .inventory-filter_attribute_box:hover .inventory-filter_attribute .drop-box-label {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.inventory-loop-list_style_1 a:hover .attribute-title-box {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.stm-listing-map-custom #marker_layer {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.stm-listing-map-custom .cluster > div {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.stm-listing-map-custom .cluster:hover > div {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}

.inventory-filter_box .stm_mobile_filter_switcher {
    color: <?php echo esc_attr( $third_color ); ?>;
    border-color: <?php echo esc_attr( $third_color ); ?>;
}

.inventory-loop-grid_style_2 .price-box-ulisting_style_2,
.inventory-loop-grid_style_3 .price-box-ulisting_style_2 {
    color: <?php echo esc_attr( $primary_color ); ?>;
}

.inventory-loop-grid_style_2:hover .attribute-icon,
.inventory-loop-grid_style_3:hover .attribute-icon {
    color: <?php echo esc_attr( $third_color ); ?>;
}

.inventory-loop-grid_style_2:hover .attribute-title-box,
.inventory-loop-grid_style_3:hover .attribute-title-box {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.inventory-filter_style_3 .inventory-filter_attribute_box_wrap .inventory-filter_attribute_box .drop-box-label {
    border-color: <?php echo esc_attr( $links_color ); ?>;
}
.inventory-filter_style_3 .inventory-filter_attribute_box_wrap .inventory-filter_attribute_box .drop-box-label.filter_enabled {
    border-color: <?php echo esc_attr( $primary_color ); ?>;
}
.inventory-filter_style_3 .inventory-filter_attribute_box_wrap .inventory-filter_attribute_box .drop-box-label.filter_enabled .mobile-filter-button:before,
.inventory-filter_style_3 .inventory-filter_attribute_box_wrap .inventory-filter_attribute_box .drop-box-label.filter_enabled .mobile-filter-button:after {
    background-color: <?php echo esc_attr( $links_color ); ?>;
}

.inventory-loop-grid_style_4 .inventory-single-page-link_inventory a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.inventory-loop-grid_style_4 .inventory-single-page-link_inventory a:hover {
    color: <?php echo esc_attr( $links_color ); ?>;
}

.price-box-ulisting_style_4 .genuine_price,
.price-box-ulisting_style_4 .genuine_sale {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.price-box-ulisting_style_4 .genuine_price.has_sale {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.inventory-loop-grid_style_4 .inventory_category_style_1 {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.profile-phone_style_1 .user-info .verified-profile-icon {
    color: <?php echo esc_attr( $third_color ); ?>;
}

.neighborhoods_box .neighborhoods_title a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.neighborhoods_box .neighborhoods_title a:hover {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.neighborhoods_box .neighborhoods_info .neighborhoods_listing_count span,
.neighborhoods_box .neighborhoods_info .neighborhoods_listing_price span {
    color: <?php echo esc_attr( $third_color ); ?>;
}

body.ulisting-inventory-page .select2-container--open .select2-dropdown {
    border-color: <?php echo esc_attr( $primary_color ); ?>;
}

.ulisting-listing-map-loader .ulisting-angrytext {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.inventory_featured_label {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}

.header-box .homepress_loading_preloader .preloader_text {
    color: <?php echo esc_attr( $primary_color ); ?>;
}

.inventory-location-filter:before {
    border-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.inventory-location-filter .inventory-location-tooltip-wrap .inventory-location-tooltip {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.inventory-location-filter .inventory-location-tooltip-wrap .inventory-location-tooltip:before {
    border-bottom-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.listing-elementor-gallery.style_2 .item .listing-gallery-attribute-icon {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.listing-elementor-gallery.style_2 .owl-nav .owl-prev:hover,
.listing-elementor-gallery.style_2 .owl-nav .owl-next:hover,
.ulisting_posts_carousel.style_2 .ulisting-listing-compare,
.ulisting_posts_carousel.style_2 .ulisting-listing-wishlist .simple-icon {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.ulisting_posts_carousel.style_2 .ulisting-listing-compare.active {
    color: <?php echo esc_attr( $third_color ); ?>;
}

#uListing-map-fullscreen a:hover,
#uListing-map-pagination a:hover,
#uListing-map-types:hover a:before {
    background-color: <?php echo esc_attr( $secondary_color ); ?> !important;
}
#uListing-map-zoom a:hover,
.page_box #uListingMainMap #uListing-map-types ul li.selected-map-type:before {
    color: <?php echo esc_attr( $secondary_color ); ?> !important;
}