<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package homepress
 */

get_header();

get_template_part( 'partials/global/title_box/main' );

?>

<div id="content" class="site-content">
    <?php get_template_part( 'partials/content', 'search' ); ?>
</div>

<?php

get_footer();
