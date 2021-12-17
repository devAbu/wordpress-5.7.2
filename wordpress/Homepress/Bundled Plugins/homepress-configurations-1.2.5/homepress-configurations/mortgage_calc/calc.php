<?php
use uListing\Classes\StmListingTemplate;

function homepress_mortgage_calc($params) {
    return StmListingTemplate::load_template( 'calc/mortgage_calc', ['params' => $params] );
}

add_shortcode( 'mortgage_calc', 'homepress_mortgage_calc' );