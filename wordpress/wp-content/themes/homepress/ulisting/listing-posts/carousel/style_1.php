<?php

wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'ulisting/ulisting_posts_carousel/style_1' );

$view = $settings['listing_posts_view'];
$nav_style = !empty($settings['ulisting_posts_nav_style']) ? $settings['ulisting_posts_nav_style'] : 'inner_nav';
$style = $settings['listing_posts_styles'];
$asstd = $settings['listing_posts_sort_by'];
$category = $settings['listing_category_list'];
$per_page = $settings['listing_posts_per_page'];

$location = get_term_by('slug', $settings['listing_location_list'], 'listing-region');

if ($location) {
    $model = new \uListing\Classes\StmListingRegion();
    $model->loadData($location);
    $thumbnail = $model->getThumbnail();
}
/* Get posts by categories */
if( $asstd == 'category' && $category !== 'select' && $type_id !== 'select' ){
    echo '<div class="ulisting_posts_box ' . esc_attr($view) . ' ' . esc_attr($nav_style) . '" data-stage="'. $carousel_settings['carousel_stage'] .'" data-desktop="'. $carousel_settings['items_count_desktop'] .'" data-landscape="'. $carousel_settings['items_count_landscape'] .'" data-tablet="'. $carousel_settings['items_count_tablet'] .'" data-mobile_landscape="'. $carousel_settings['items_count_mobile_landscape'] .'" data-mobile="'. $carousel_settings['items_count_mobile'] .'" data-nav="'. $carousel_settings['carousel_nav'] .'" data-dots="'. $carousel_settings['carousel_dots'] .'" data-loop="'. $carousel_settings['carousel_loop'] .'">';
    echo do_shortcode( "[ulisting-category category='".$category."' limit='$per_page' listing_type_id='$type_id']" );
    echo '</div>';
}

/* Get posts by featured */
if( $asstd == 'featured' && $type_id !== 'select' ) {
    echo '<div class="ulisting_posts_box ' .$view. '" data-stage="'. $carousel_settings['carousel_stage'] .'" data-desktop="'. $carousel_settings['items_count_desktop'] .'" data-landscape="'. $carousel_settings['items_count_landscape'] .'" data-tablet="'. $carousel_settings['items_count_tablet'] .'" data-mobile_landscape="'. $carousel_settings['items_count_mobile_landscape'] .'" data-mobile="'. $carousel_settings['items_count_mobile'] .'" data-nav="'. $carousel_settings['carousel_nav'] .'" data-dots="'. $carousel_settings['carousel_dots'] .'" data-loop="'. $carousel_settings['carousel_loop'] .'">';
    echo do_shortcode("[ulisting-feature listing_type_id='$type_id' limit='$per_page']");
    echo '</div>';
}

/* Get posts by location */
if( $asstd == 'location' && $type_id !== 'select' && !empty( $location ) ) { ?>
    <div class="location_box">
        <div class="location_image">
            <?php if( !empty( $thumbnail ) ) : ?>
                <?php
                $size = the_post_thumbnail( 'homepress-image-ulisting-locations' );
                echo wp_get_attachment_image( $thumbnail['id'], $size );
                ?>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri()."/assets/images/placeholder.gif"; ?>" width="540" height="255" alt="<?php echo esc_attr( $location->name ); ?>" />
            <?php endif; ?>
        </div>
        <div class="location_info">
            <div class="location_name">
                <?php echo esc_attr( $location->name ); ?>
            </div>
            <div class="location_count">
                <?php echo esc_attr( $location->count ); ?> <?php esc_html_e( 'Properties', 'homepress' ); ?>
            </div>
        </div>
        <a href="<?php echo esc_url( $listingType->getPageUrl() . '?region=' .$location->term_id ); ?>" class="location_link"></a>
    </div>
<?php }


if( $asstd == 'popular' && $type_id !== 'select' ) {
    echo '<div class="ulisting_posts_box ' .$view. '" data-stage="'. $carousel_settings['carousel_stage'] .'" data-desktop="'. $carousel_settings['items_count_desktop'] .'" data-landscape="'. $carousel_settings['items_count_landscape'] .'" data-tablet="'. $carousel_settings['items_count_tablet'] .'" data-mobile_landscape="'. $carousel_settings['items_count_mobile_landscape'] .'" data-mobile="'. $carousel_settings['items_count_mobile'] .'" data-nav="'. $carousel_settings['carousel_nav'] .'" data-dots="'. $carousel_settings['carousel_dots'] .'" data-loop="'. $carousel_settings['carousel_loop'] .'">';
    echo do_shortcode("[ulisting-popular listing_type_id='$type_id' limit='$per_page']");
    echo '</div>';
}

/* Get posts by latest */
if( $asstd == 'latest' && $type_id !== 'select' ) {
    echo '<div class="ulisting_posts_box ' .$view. '" data-stage="'. $carousel_settings['carousel_stage'] .'" data-desktop="'. $carousel_settings['items_count_desktop'] .'" data-landscape="'. $carousel_settings['items_count_landscape'] .'" data-tablet="'. $carousel_settings['items_count_tablet'] .'" data-mobile_landscape="'. $carousel_settings['items_count_mobile_landscape'] .'" data-mobile="'. $carousel_settings['items_count_mobile'] .'" data-nav="'. $carousel_settings['carousel_nav'] .'" data-dots="'. $carousel_settings['carousel_dots'] .'" data-loop="'. $carousel_settings['carousel_loop'] .'">';
    echo do_shortcode("[ulisting-latest listing_type_id='$type_id' limit='$per_page']");
    echo '</div>';
}