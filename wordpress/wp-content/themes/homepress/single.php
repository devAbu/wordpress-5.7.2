<?php

get_header();

get_template_part( 'partials/global/title_box/main' );

$post_type = get_post_type(); ?>

    <div id="content" class="site-content">
        <?php
        if( '' != locate_template( "partials/single/{$post_type}/main.php" ) ) {

            get_template_part( "partials/single/{$post_type}/main" );

        } else {

            while ( have_posts() ) : the_post();

                get_template_part( 'partials/content' );

            endwhile;
        } ?>
    </div>

<?php

get_footer();