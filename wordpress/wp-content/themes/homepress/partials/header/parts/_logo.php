<?php
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );

    if ( has_custom_logo() ) {
        echo '<img src="' . esc_url( $image[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
    } else { ?>
        <a href="<?php echo esc_url( site_url( '/' ) ); ?>" class="homepress-custom-logo">
            <img width="44" height="44" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo_default.svg') ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
            <?php echo get_bloginfo( 'name' ); ?>
        </a>
<?php } ?>