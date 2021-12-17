<?php
use uListing\Classes\StmListingTemplate;
?>
<div class="listing-single-info-style_1">
    <div <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute($element) ?>>
        <div class="container">
<!--            <div class="listing-results-link">-->
<!--                <a href="javascript:void(0);" id="homepress_back_to_results"><span class="listing-results-link-icon">&larr;</span> --><?php //esc_html_e( 'Back to Results', 'homepress' ); ?><!--</a>-->
<!--            </div>-->
            <div class="listing-single-info">
            <?php
                StmListingTemplate::load_template( '/listing-single/item-meta/parts/type', [ 'model' => $args['model'] ], true );
                StmListingTemplate::load_template( '/listing-single/item-meta/parts/category', [ 'model' => $args['model'] ], true );
                StmListingTemplate::load_template( '/listing-single/item-meta/parts/published', [ 'model' => $args['model'] ], true );
                StmListingTemplate::load_template( '/listing-single/item-meta/parts/views', [ 'model' => $args['model'] ], true );
            ?>
            </div>
            <?php
            StmListingTemplate::load_template( '/listing-single/item-meta/parts/useful_links', [ 'model' => $args['model'] ], true );
            ?>
        </div>
    </div>
</div>