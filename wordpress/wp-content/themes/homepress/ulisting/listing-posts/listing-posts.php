<?php

use uListing\Classes\StmListingTemplate;

$carousel_settings = [];
if ($view !== 'grid') {
    $carousel_settings = [
        'carousel_nav' => $settings['ulisting_posts_carousel_nav'],
        'carousel_dots' => $settings['ulisting_posts_carousel_dots'],
        'carousel_loop' => $settings['ulisting_posts_carousel_loop'],
        'carousel_stage' => $settings['ulisting_posts_carousel_stage'],
        'items_count_tablet' => $settings['ulisting_posts_carousel_items_count_tablet'],
        'items_count_mobile' => $settings['ulisting_posts_carousel_items_count_mobile'],
        'items_count_desktop' => $settings['ulisting_posts_carousel_items_count_desktop'],
        'items_count_landscape' => $settings['ulisting_posts_carousel_items_count_landscape'],
        'items_count_mobile_landscape' => $settings['ulisting_posts_carousel_items_count_mobile_landscape'],

        'item_count_attributes' => isset($settings['ulisting_posts_attributes_' . $type_id]) ? $settings['ulisting_posts_attributes_' . $type_id] : [],
    ];

    $view = 'carousel/' . $settings['ulisting_posts_carousel_styles'];
}

echo StmListingTemplate::load_template(
    'listing-posts/' . $view,
    array(
        'type_id' => $type_id,
        'settings' => $settings,
        'listingType' => $listingType,
        'carousel_settings' => $carousel_settings,
    )
);