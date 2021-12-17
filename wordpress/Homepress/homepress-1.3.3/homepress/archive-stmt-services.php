<?php

get_header();

get_template_part( 'partials/global/title_box/main' );

?>

    <div id="content" class="site-content">
        <?php get_template_part( "partials/custom-posts/services/main" ); ?>
    </div>

<?php

get_footer();