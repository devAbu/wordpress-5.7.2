<?php
/**
 * Filter search form category
 *
 * Template can be modified by copying it to yourtheme/ulisting/filter/stm_search_form_category.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.3.0
 */

use uListing\Classes\StmListingTemplate;
if(empty($params))
    return false;
ulisting_field_components_enqueue_scripts_styles();
wp_enqueue_script('stm-search-form-category', ULISTING_URL . '/assets/js/frontend/stm-search-form-category.js', array('vue'), ULISTING_VERSION, true);
StmListingTemplate::load_template(
    'filter/search_form_category_styles/' . $params[ 'style' ],
    array(
        'listingsTypes' => $listingsTypes,
        'categories' => $categories,
        'params' => $params
    ), true );