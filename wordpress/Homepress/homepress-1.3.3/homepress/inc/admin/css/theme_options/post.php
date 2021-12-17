<?php
$to = get_option( 'stmt_to_settings', array() );

//Colors
$primary_color = ( !empty( $to['primary_color'] ) ) ? $to['primary_color'] : '#303441';
$secondary_color = ( !empty( $to['secondary_color'] ) ) ? $to['secondary_color'] : '#234DD4';
$third_color = ( !empty( $to['third_color'] ) ) ? $to['third_color'] : '#43C370';

//Fonts
$secondary_font = ( !empty( $to['default_header_font_family'] ) ) ? $to['default_header_font_family'] : 'Raleway, sans-serif';
?>

.archive-post-style_1 .archive-post_content .posted-on,
.archive-post-style_1 .archive-post_content .posted-on-custom,
.archive-post-style_2 .archive-post_content .posted-on,
.archive-post-style_3 .archive-post_content .posted-on,
.archive-post-style_3 .archive-post_content .posted-on-custom,
.archive-post-style_4 .archive-post_content .posted-on-custom {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}
.archive-post-style_5 .archive-post_content .posted-on-custom {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.archive-post-style_1 .archive-post_content .post-title h2:hover,
.archive-post-style_2 .archive-post_content .post-title h2:hover,
.archive-post-style_3 .archive-post_content .post-title h2:hover,
.archive-post-style_4 .archive-post_content .post-title h2:hover,
.archive-post-style_5 .archive-post_content .post-title h2:hover,
.archive-post-style_6 .archive-post_content .post-title h2:hover {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}
.archive-post-style_1 .archive-post_content.active_sticky_post,
.archive-post-style_2 .archive-post_content .posted-on-custom {
    border-color: <?php echo esc_attr( $third_color ); ?>;
}
.archive-post-style_2 .archive-post_content .posted-on-custom span {
    color: <?php echo esc_attr( $primary_color ); ?>;
}

.archive-post-style_6 .archive-post__content .archive-post_content .posted-on a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}

.post-tags-list a {
    color: <?php echo esc_attr( $primary_color ); ?>;
}

.post-tags-list a:hover {
    border-color: <?php echo esc_attr( $third_color ); ?>;
    background-color: <?php echo esc_attr( $third_color ); ?>;
}

.wp-audio-shortcode .mejs-inner .mejs-controls .mejs-playpause-button,
.wp-audio-shortcode .mejs-inner .mejs-controls .mejs-playpause-button:after {
    background-color: <?php echo esc_attr( $third_color ); ?>;
}
.wp-audio-shortcode .mejs-inner .mejs-controls .mejs-time span,
.wp-audio-shortcode .mejs-inner .mejs-controls .mejs-volume-button.mejs-mute button:before{
    color: <?php echo esc_attr( $primary_color ); ?>;
}
.wp-audio-shortcode .mejs-inner .mejs-controls .mejs-time-rail .mejs-time-total:after,
.wp-audio-shortcode .mejs-inner .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total:after {
    background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.wp-audio-shortcode .mejs-inner .mejs-controls .mejs-time-rail .mejs-time-total .mejs-time-current,
.wp-audio-shortcode .mejs-inner .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total .mejs-horizontal-volume-current {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}

.wp-audio-shortcode .mejs-inner .mejs-controls .mejs-time-rail .mejs-time-handle {
    background-color: <?php echo esc_attr( $secondary_color ); ?> !important;
}

.post-category-list a:after,
.post-category-list a:hover:after {
    background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.archive-post-search-result .archive-post_content_info .post-title h5:hover,
.single-post-info-wrap .single-post-info>div:before {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}

.comment-form-field > div label {
    color: <?php echo esc_attr( $secondary_color ); ?>;
}