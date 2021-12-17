<?php

get_header();

get_template_part( 'partials/global/title_box/main' );

?>

    <div id="content" class="site-content">
        <?php
        $post_type = get_post_type();

        get_template_part( "partials/{$post_type}/main" );
        ?>
    </div>

<?php

get_footer();