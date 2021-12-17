<?php
/**
 * Listing inventory reset filter
 *
 * Template can be modified by copying it to yourtheme/ulisting/listing-list/reset-filter.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */

$reset_url = $args['listingType']->getPageUrl();

if(isset($_GET['layout']))
	$reset_url .= "?layout=".$_GET['layout'];

$element[ 'params' ][ 'class' ] .= " ulisting-reset-filter";
$reset_filter = __('Reset Search', 'homepress');
$reset_filter_panel = '<div '.\uListing\Classes\Builder\UListingBuilder::generation_html_attribute($element).' ><a  href="'.$reset_url.'"><span class="property-icon-reload"></span> [reset_filter_panel_inner] </a></div>';
if(isset($element['params']['template']))
	echo \uListing\Classes\StmInventoryLayout::render_reset_filter($element['params']['template'] ,$reset_filter_panel, $reset_filter);
?>




