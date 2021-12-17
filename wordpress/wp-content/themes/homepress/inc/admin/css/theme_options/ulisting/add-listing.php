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

@media (max-width: 767px) {
    .add-listing-button .elementor-button-wrapper a {
        border-color: <?php echo esc_attr( $secondary_color ); ?>;
        color: <?php echo esc_attr( $primary_color ); ?>;
    }
}

.add-listing-steps .add-listing-steps-column.active-step h6:after {
    background-color: <?php echo esc_attr( $links_color ); ?>;
}
.add-listing-steps .add-listing-steps-column.active-step .add-listing-steps-number {
    background-color: <?php echo esc_attr( $links_color ); ?>;
}

.add-listing-types ul li a:hover {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.add-listing-types ul li a.none-image {
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.add-listing-form .add-listing-attribute-box>div.add-listing-attribute-gallery .stm-gallery-list .stm-row .stm-gallery-list-column .item:after {
    border-color: <?php echo esc_attr( $third_color ); ?>;
}
.add-listing-form .add-listing-attribute-box>div.add-listing-attribute-gallery .stm-file-dragdrop .main-image span i {
    color: <?php echo esc_attr( $third_color ); ?>;
}

.add-listing-steps.add-listing-step-two .add-listing-steps-column:first-child h6:hover:after {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}
.add-listing-steps.add-listing-step-two .add-listing-steps-column:first-child h6:hover .add-listing-steps-number {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}

.site-content .user-plans-box li .user-plan:before {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.site-content .user-plans-box li .user-plan.user_plan_active:before {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}
.site-content .user-plans-box li .add-user-plan-link .add-user-plus-icon {
    background-color: <?php echo esc_attr( $links_color ); ?>;
}
.site-content .user-plans-box li .add-user-plan-link:hover .add-user-plus-icon {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.site-content .user-plans-box li .user-plan.user_plan_active.user_plan_selected .active-plan-icon,
.site-content .user-plans-box li .user-plan.user_plan_selected .active-plan-icon {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}

.feature-listing-item {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}
.stm-row .inventory-featured-box {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}

.button-for-demo:hover {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.add-listing-form .add-listing-attribute-box .stm-file-dragdrop .main-image span i {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}