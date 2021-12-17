<?php
/**
 * Loop info window
 *
 * Template can be modified by copying it to yourtheme/ulisting/loop/info-window.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0.2
 */

$listing_item_card_layout = get_post_meta($listingType->ID, 'stm_listing_item_card_map');
if( isset( $listing_item_card_layout[ 0 ] ) )
    $listing_item_card_layout = maybe_unserialize( $listing_item_card_layout[ 0 ] );

$style_class = ( isset($listing_item_card_layout['config']) AND isset($listing_item_card_layout['config']['template'])) ? $listing_item_card_layout['config']['template'] : "";

$model->generation_attribute_elements("ulisting_listing_type_item_card_element_data_map", $listingType);

if(isset($listing_item_card_layout) AND isset($listing_item_card_layout["sections"])){
	echo "<div class='".$style_class."'>";
        echo \uListing\Classes\Builder\UListingBuilder::render($listing_item_card_layout["sections"], "ulisting_item_card_".$listingType->ID."_map", [
            'model' => $model,
            'listingType' => $listingType,
        ]);
    echo "</div>";
}
?>

