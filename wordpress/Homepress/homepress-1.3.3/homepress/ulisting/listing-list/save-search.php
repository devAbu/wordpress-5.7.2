<?php
/**
 * Listing save-search
 *
 * Template can be modified by copying it to yourtheme/ulisting/listing-list/save-search.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */

$save_search_title = __( "Save Search", "homepress" );
if( is_user_logged_in() ) {
    $element[ 'params' ][ 'class' ] .= " ulisting-save-search homepress-button-outline";
    $listing_type_id = ( isset( $args[ 'listingType' ] ) AND isset( $args[ 'listingType' ]->ID ) ) ? $args[ 'listingType' ]->ID : null;
    $save_search_panel = '<button onclick="save_search(this, ' . get_current_user_id() . ', ' . $listing_type_id . ')" type="button" ' . \uListing\Classes\Builder\UListingBuilder::generation_html_attribute( $element ) . '> <span class="load">' . __( 'Save load...', 'homepress' ) . '</span> <span class="inner">[save_search_panel_inner]</span> </button>';

    if( isset( $element[ 'params' ][ 'template' ] ) )
        echo \uListing\Classes\StmInventoryLayout::render_save_search( $element[ 'params' ][ 'template' ], $save_search_panel, $save_search_title );
} else
    echo "<div " . \uListing\Classes\Builder\UListingBuilder::generation_html_attribute( $element ) . "><a target='_blank' href='" . \uListing\Classes\StmUser::getProfileUrl() . "' class='ulisting-save-search homepress-button-outline'>" . $save_search_title . "</a></div>";