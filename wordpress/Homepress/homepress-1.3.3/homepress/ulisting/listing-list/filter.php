<?php
/**
 * Filter
 *
 * Template can be modified by copying it to yourtheme/ulisting/listing/filter.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0.2
 */
use uListing\Classes\StmListingFilter;

$filter_field = "";
$element['params']['class'] .= " ulisting_element_".$element['id'];

do_action('stm_render_filter', $element['params']['template']);

$search_fields = $args['listingType']->getSearchFields(\uListing\Classes\StmListingType::SEARCH_FORM_ADVANCED);
$data = StmListingFilter::build_data($args['listingType'], $search_fields, [], true);

$filter_panel = '<div '.\uListing\Classes\Builder\UListingBuilder::generation_html_attribute($element).'>[filter_panel_inner]</div>';

$filter = '

			<stm-search-form-advanced
				ref="filter"
				class="ulisting-form"
				inline-template
				data-v-on_url-update="set_url"
				data-v-on_location-update="location_update"
				data-v-on_exists-filter="exists_filter"
				data-v-bind_show="filter.show"
				data-v-bind_url="url"
				data-v-bind_listing_type_id="listing_type_id"
				data-v-bind_search_form_type="search_form_type"
				data-v-bind_data="filter.field_data"
				data-v-bind_field_type="filter.field_type"
				data-v-bind_field_show="field_show"
				data-v-bind_search_fields="filter.search_fields">
					
					<div data-v-bind_class="{filter_close:show_filter}" class="mobile-filter-box homepress_loading_preloader preloader_show">
					 	<div class="preloader_text">'.__('Loading', 'homepress').'</div>
						<div data-v-if="show" class="container inventory-filter_attribute_box_wrap">
							[filter_field]
						</div>
						<div class="filter-reset-button">
							<a class="homepress-button-outline-full" href="'.$args['listingType']->getPageUrl().'">'.__('Reset filter', 'homepress').'</a>
						</div>
						<div data-v-on_click="show_filter = !show_filter" data-v-bind_class="{filter_close:show_filter}" class="stm_mobile_filter_switcher">
							<i class="fa fa-filter"></i> <span class="text-results">'.__('Get result', 'homepress').'</span> <span class="text-filter">'.__('Filter', 'homepress').'</span>
						</div>
			
					</div>
			</stm-search-form-advanced>';

if(isset($element['params']['template']))
	echo \uListing\Classes\StmInventoryLayout::render_filter($element['params']['template'], $filter_panel, $filter, $data['content']);
?>

