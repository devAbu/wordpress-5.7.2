<?php

get_header();

get_template_part( 'partials/global/title_box/main' );

//Services single style settings
$services_single_style = homepress_get_option('services_single_style' );

?>

    <div id="content" class="site-content">
        <?php get_template_part("partials/single/services/styles/{$services_single_style}"); ?>
    </div>

<?php

get_footer();