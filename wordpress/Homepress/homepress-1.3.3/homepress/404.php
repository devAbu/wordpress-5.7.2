<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <div id="page" class="site">
        <div id="content" class="site-content">

            <div class="page-404 not-found">

                <header class="page-header">

                    <?php get_template_part( 'partials/header/parts/_logo' ); ?>

                </header>

                <div class="page-content">

                    <div class="page-error">
                        <?php esc_html_e( '404', 'homepress' ); ?>
                    </div>

                    <h1 class="page-title">
                        <?php esc_html_e( 'The page you’re looking for doesn’t exist', 'homepress' ); ?>
                    </h1>

                    <a href="<?php echo get_home_url('/'); ?>" class="homepress-button">
                        <?php esc_html_e( 'Home page', 'homepress' ); ?>
                    </a>

                </div>
            </div>

        </div><!-- id.content -->
    </div>

    <?php wp_footer(); ?>

</body>
</html>