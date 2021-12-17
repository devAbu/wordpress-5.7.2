<?php
use uListing\Classes\StmListingAttribute;

$homepress_post_id = get_the_ID();
$token = homepress_get_option( 'yelp_api' );
$is_cache = homepress_get_option( 'yelp_categories_cache' );

$categories = json_decode( homepress_get_option( 'yelp_categories_list' ) );
$categories_yelp = [];
foreach ( $categories as $key => $category ) {
    array_push( $categories_yelp, $category->value );
}

$location = $args['model']->getAttributeValue( StmListingAttribute::TYPE_LOCATION );
$latitude = $location['latitude'];
$longitude = $location['longitude'];

$sort_by = homepress_get_option( 'yelp_categories_sort' );
$limit = homepress_get_option( 'yelp_categories_list_limit' );

$yelp_nearby_list = yelp_nearby( $homepress_post_id, $is_cache, $token, $categories_yelp, $latitude, $longitude, $sort_by, $limit );

?>

<div <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute( $element ); ?>>
    <div class="yelp_nearby_box">
        <div class="yelp_nearby_title_box">
            <h5><?php esc_html_e( 'What\'s Nearby?', 'homepress' ); ?></h5>
            <div class="yelp_power">
                <div class="yelp_power_desc"><?php esc_html_e( 'Powered by', 'homepress' ); ?></div>
                <div class="yelp_logo"></div>
            </div>
        </div>
        <?php foreach( $yelp_nearby_list as $key => $yelp_api_business ) : $resources_list = $yelp_api_business['resources']; ?>
        <?php if ( !empty( $resources_list) ) : ?>
        <div class="yelp_category_list">
            <div class="yelp_category_title"><span class="yelp_category_icon property-icon-<?php echo esc_attr( $yelp_api_business['category'] ); ?>"></span> <?php echo esc_attr( $yelp_api_business['category'] ); ?></div>
            <ul class="yelp_sub_cat_list">
                <?php foreach( $resources_list as $resource ) :

                    $distance = $resource['distance']*0.000621371192;
                    $distance = number_format( ( float )$distance, 2, '.', '' );

                    $rating = $resource['rating'];
                    $rating = number_format( ( float )$rating, 1, '_', '' );
                    ?>
                <li>
                    <div class="yelp_sub_cat-left-col">
                        <div class="yelp_sub_cat_title"><?php echo esc_attr( $resource['name'] ); ?></div>
                        <div class="yelp_sub_cat_distance">(<?php echo esc_attr( $distance ); ?> <?php esc_html_e( 'mi', 'homepress' ); ?>)</div>
                    </div>
                    <div class="yelp_sub_cat-right-col">
                        <div class="yelp_sub_cat_reviews_count"><?php echo esc_attr( $resource['review_count'] ); ?> <?php esc_html_e( 'reviews', 'homepress' ); ?></div>
                        <div class="yelp_sub_cat_rating rating_pos_<?php echo esc_attr( $rating ); ?>"></div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; endforeach; ?>
    </div>
</div>