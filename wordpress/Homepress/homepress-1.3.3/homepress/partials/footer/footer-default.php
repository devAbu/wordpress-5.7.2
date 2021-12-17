<footer id="colophon" class="site-footer">

    <div class="copyright_box">

        <div class="container">

            <div class="copyright">
                <?php

                $copyright = homepress_get_option( 'copyright' );

                if ($copyright):

                    $copyright_symbol = homepress_get_option( 'copyright_symbol' );
                    $copyright_current_year = homepress_get_option( 'copyright_current_year' );

                    $copyright_symbol = ($copyright_symbol) ? esc_html__( '&copy; ', 'homepress' ) : '';
                    $copyright_current_year = ($copyright_current_year) ? date( 'Y ' ) : '';

                    ?>

                    <?php echo sanitize_text_field( $copyright_symbol ); ?>
                    <?php echo sanitize_text_field( $copyright_current_year ); ?>
                    <?php echo wp_kses_post( $copyright ); ?>

                <?php endif; ?>
            </div>

        </div>

    </div>

</footer>
