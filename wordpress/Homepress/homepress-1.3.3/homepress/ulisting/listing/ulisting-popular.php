<?php
/**
 * Listing ulisting popular
 * @see     #
 * @package Homepress/Templates
 * @version 1.6.6
 */

$listingType = null;
foreach ( $listings as $listing ){
    $item = "";
    if(!$listingType)
        $listingType =  $listing->getType();
    if( ($listing_item_card_layout = get_post_meta($listingType->ID, 'stm_listing_item_card_'.$view_type)) AND isset($listing_item_card_layout[0]) ) {
        $listing_item_card_layout = maybe_unserialize($listing_item_card_layout[0]);
        $config   = $listing_item_card_layout['config'];
        $sections = $listing_item_card_layout['sections'];
    }

    $listing = $listing->listingFeaturedStatus($listing);
    $item.= \uListing\Classes\StmListingTemplate::load_template('loop/loop', [
        'model'       => $listing,
        'view_type'   => $view_type,
        'listingType' => $listingType,
        'item_class'  => $item_class,
        'listing_item_card_layout' => $sections
    ]);
    echo '<div class="'. $config['template'] .'">'.$item.'</div>';
}