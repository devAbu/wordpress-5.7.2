<?php
/**
 * Listing list item preview type switch
 *
 * Template can be modified by copying it to yourtheme/ulisting/listing-list/item-preview-type-switch.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0.3
 */

use uListing\Classes\StmListingType;
wp_enqueue_script('stm-column-switch', ULISTING_URL . '/assets/js/frontend/stm-column-switch.js', array('vue'), ULISTING_VERSION, true);

$default_view = 'grid';
if(isset($args['listingType'])){
    $list_element = $args['listingType']->getLayoutElements($args['layout_id'], 'list');
    $default_view = (isset($list_element['params']['default_item_view']) AND !empty($list_element['params']['default_item_view'])) ? $list_element['params']['default_item_view'] : 'grid';
}

$view_type = (isset($_COOKIE['stm_listing_item_preview_type'])) ? $_COOKIE['stm_listing_item_preview_type'] : $default_view;
$data['view_type'] = $view_type;
wp_add_inline_script('stm-column-switch', " var ulisting_inventory_column_switch =  json_parse('".ulisting_convert_content(json_encode($data))."') ", 'before');

$button_switch = '<ul>
				      <li data-v-bind_class="{active:type==\'grid\'}"><div data-v-on_click="set_view_type(\'grid\')"  class="switch-icon"><i class="property-icon-list-greed"></i></i></div></li>
					  <li data-v-bind_class="{active:type==\'list\'}"><div data-v-on_click="set_view_type(\'list\')" class="switch-icon"><i class="property-icon-list-list"></i></div></li>
				  </ul>';

$column_switch_panel = '<div '.\uListing\Classes\Builder\UListingBuilder::generation_html_attribute($element).' >
							<stm-column-switch inline-template v-on:column-switch="send_request">
								<div>
									[column_switch_inner]
								</div>
							</stm-column-switch>
						</div>';
if(isset($element['params']['template']))
    echo \uListing\Classes\StmInventoryLayout::render_column_switch($element['params']['template'] ,$column_switch_panel, $button_switch);
?>


