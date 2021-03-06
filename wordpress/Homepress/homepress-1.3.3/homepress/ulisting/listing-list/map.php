<?php
/**
 * Listing list map
 *
 * Template can be modified by copying it to yourtheme/ulisting/listing-list/map.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.3.7
 */

$type = uListing\Classes\StmListingSettings::get_current_map_type();

$is_google = $type === 'google';
$access_token_arr = uListing\Classes\StmListingSettings::get_current_map_api_key();
$access_token = isset($access_token_arr[$type]) ? $access_token_arr[$type] : '';

$open_map_by_hover = uListing\Classes\StmListingSettings::getMapHover();

$element['params']['class'] .= " ulisting_element_".$element['id'];
$element['params']['class'] .= " stm-listing-map-custom stm-listing-map-custom_".$element['id'];
$map_panel = '<div '.\uListing\Classes\Builder\UListingBuilder::generation_html_attribute($element).'>[map_panel_inner] </div>';
$map = '<div class="ulisting-listing-map-loader"><div class="ulisting-angrytext"><i class="property-icon-map-marker-alt"></i></div> </div>
            <stm-listing-map inline-template 
                :markers="markers" 
                v-on:exists-map="exists_map"
                :polygon="polygon">
       ';


if($is_google){
    $map .= uListing\Classes\StmListingTemplate::load_template('listing-list/maps/google', ['open_map_by_hover' => $open_map_by_hover]);
}else{
    $map .= uListing\Classes\StmListingTemplate::load_template('listing-list/maps/osm', ['access_token' => $access_token, 'type' => $type, 'open_map_by_hover' => $open_map_by_hover ]);
}

$map .= '</stm-listing-map>';
if(isset($element['params']['template']))
    echo \uListing\Classes\StmInventoryLayout::render_map($element['params']['template'], $map_panel, $map);










