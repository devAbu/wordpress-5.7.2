<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';

//Fonts
$secondary_font = ( !empty( $to['default_header_font_family'] ) ) ? $to['default_header_font_family'] : 'Raleway, sans-serif';
?>

.site-content .account-page .account-page-navigation ul li a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.site-content .account-page .account-page-navigation ul li a:hover,
.site-content .account-page .account-page-navigation ul li a.active {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.site-content .account-page .account-page-navigation ul li a.active:after {
    background-color: <?php echo esc_attr( $primary_color ); ?>;
}

.ulisting-account-panel-wrap .ulisting-account-panel .ulisting-account-panel-avatar {
    border-color: <?php echo esc_attr( $secondary_color ); ?>;
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.ulisting-account-panel .ulisting-account-panel-main a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}

.profile-avatar_style_1 .profile-info .profile-info-icons {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.form-phone-box .form-phone strong,
.form-phone-box .form-phone a,
.profile_phone .property_show_phone,
.profile_phone a {
    border-color: <?php echo esc_attr( $primary_color ); ?>;
}

.listing-button_box .delete-listing-button a:hover,
.listing-button_box .edit-listing-button a:hover,
.listing-button_box .promote-listing-button button:hover,
.listing-button_box .promote-listing-button.active button {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.user_info_tabs .user_info_tab-title:hover,
.user_info_tabs.user_info_tab-1 .user_info_tab-title.user_info_tab-1,
.user_info_tabs.user_info_tab-2 .user_info_tab-title.user_info_tab-2,
.user_info_tabs.user_info_tab-3 .user_info_tab-title.user_info_tab-3,
.user_info_tabs.user_info_tab-4 .user_info_tab-title.user_info_tab-4 {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}

.user-personal-info-middle .info .user_phone_box_icon,
.user-personal-info-middle .info .user_field_icon {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.ulisting_compare_total_panel .compare-total {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.ulisting_compare_total_panel a {
    color: <?php echo esc_attr( $primary_color ); ?>;
    border-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.compare_box .container .compare_title:before {
    background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.compare_box .container .compare_title a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.compare_box .container .compare_title a:hover {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.compare_box .container .compare_thumbnail:before {
    background-color: <?php echo esc_attr( $primary_color ); ?>;
}

.save_search_box_row_wrap {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.save_search_box .save_search_view_results {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}
.save_search_box .save_search_view_results:hover {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.links_switch_box .nav-link .count-link:before {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.links_switch_box .nav-link .title-link {
    border-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.links_switch_box .nav-link.active {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}

a.ulisting-save-search {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
a.ulisting-save-search:hover {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.ulisting_wishlist_total_panel .ulisting-account-panel-dropdown-menu a,
.ulisting_wishlist_total_panel .ulisting-account-panel-dropdown-menu a span {
    color: <?php echo esc_attr( $primary_color ); ?> !important;
}
.ulisting_wishlist_total_panel .ulisting-account-panel-dropdown-menu a span:before {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

#toast-container>.toast-success {
    background-color: <?php echo esc_attr( $third_color ); ?> !important;
}

.login-page-box:before {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.login-page-box .homepress-button:hover {
    background-color: <?php echo esc_attr( $third_color ); ?>;
    border-color: <?php echo esc_attr( $third_color ); ?>;
}

.login-page-box .homepress-checkbox label input:checked~.checkbox-frame {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}

.ulisting-search-item-buttons .btn.btn-info {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.ulisting-search-item-buttons .btn.btn-info:hover {
    background-color: <?php echo esc_attr( $third_color ); ?>;
    border-color: <?php echo esc_attr( $third_color ); ?>;
}

.user_info_tabs .ulisting_user_listings .form-check-inline label.active:before,
.site-content .account-page .ulisting-user-listings .form-check-inline label.active:before {
    box-shadow: 0px 0px 0px 2px <?php echo esc_attr( $third_color ); ?>;
    background: <?php echo esc_attr( $third_color ); ?>;
}

@media (max-width: 991px) {
    .account-payment_history table tbody tr td:first-child, .account-payment_history table tbody tr th:first-child,
    .account-payment_history table tbody tr td:first-child, .account-payment_history table tbody tr td:first-child {
        background-color: <?php echo esc_attr( $secondary_color ); ?>;
    }
}