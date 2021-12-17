<?php
/**
 * Listing single single
 *
 * Template can be modified by copying it to yourtheme/ulisting/listing-single/single.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.1
 */
use uListing\Classes\StmListing;
use uListing\Classes\StmListingTemplate;

get_header();

get_template_part( 'partials/global/title_box/main' );

?>

<div id="content" class="site-content">
    <?php if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            $model = StmListing::load( get_post() );
            if ( $model->post_type == 'listing' ) {
                StmListingTemplate::load_template( 'listing-single/content', [ 'model' => $model ], true );
                StmListingTemplate::load_template( 'comment/listing-comment', [ 'listing' => $model ], true );

            } else {
               echo the_content();
            }
        endwhile;
    endif; ?>
</div>

<?php

get_footer();