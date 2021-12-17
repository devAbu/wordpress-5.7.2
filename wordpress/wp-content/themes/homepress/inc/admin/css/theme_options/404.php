<?php
$to = get_option( 'stmt_to_settings', array() );

$background_image = homepress_get_option( '404_content_bg_img' );
if( !empty( $background_image ) ) {
    $background_image = homepress_get_image_url( $background_image );
}

?>

.error404 .site-content .page-404 .page-content {
<?php if( !empty( $background_image ) ) : ?>
    background-image: url("<?php echo esc_attr( $background_image ); ?>");
<?php endif; ?>
}