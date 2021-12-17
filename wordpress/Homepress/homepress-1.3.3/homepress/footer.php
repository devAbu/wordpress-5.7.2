    <?php
    //Get the ID for metaboxes fields
    $id = get_the_ID();
    $footer = get_post_meta( $id, 'footer-settings', 'show' );
    if ( $footer !== 'hide' ) {
        get_template_part('partials/footer/main');
    }; ?>

</div>

<?php do_action( 'demo_sidebar' ); ?>
<?php wp_footer(); ?>

</body>
</html>