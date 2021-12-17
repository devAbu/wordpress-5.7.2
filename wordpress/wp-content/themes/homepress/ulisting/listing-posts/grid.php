<?php
//Sort attr
$style = $settings['listing_posts_styles'];
$asstd = $settings['listing_posts_sort_by'];
$category = $settings['listing_category_list'];
$view = $settings['listing_posts_item_columns'];
$per_page = $settings['listing_posts_per_page'];

$location = get_term_by('slug', $settings['listing_location_list'], 'listing-region');

if ($location) {
    $model = new \uListing\Classes\StmListingRegion();
    $model->loadData($location);
    $thumbnail = $model->getThumbnail();
}

/* Get posts by categories */
if( $asstd == 'category' && $category !== 'select' && $type_id !== 'select' ){
    echo '<div class="ulisting_posts_box ' .$view. '"><div class="row">';
    echo do_shortcode( "[ulisting-category category='".$category."' limit='$per_page' listing_type_id='$type_id']" );
    echo '</div></div>';
}

/* Get posts by featured */
if( $asstd == 'featured' && $type_id !== 'select' ) {
    echo '<div class="ulisting_posts_box ' .$view. '"><div class="row">';
    echo do_shortcode("[ulisting-feature listing_type_id='$type_id' limit='$per_page']");
    echo '</div></div>';
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
<?php } ?>

<?php

$extra_style = '';

/* Get posts by popular */
if( $style == 'style_2' && $per_page == '3' || $per_page == '6' ) {
    $extra_style = 'three_across';
}
if( $style == 'style_2' && $per_page == '2' || $per_page == '4' ) {
    $extra_style = 'two_across';
}
if( $style == 'style_2' && $per_page == '1' ) {
    $extra_style = 'one_across';
}

if( $asstd == 'popular' && $listingType !== 'select' ) {
    echo '<div class="ulisting_posts_box ulisting_posts_popular_' .$style. ' ' .$extra_style. ' ' .$view. '"><div class="row">';
    echo do_shortcode("[ulisting-popular listing_type_id='$type_id' limit='$per_page']");
    echo '</div></div>';
}

/* Get posts by latest */
if( $asstd == 'latest' && $listingType !== 'select' ) {
    echo '<div class="ulisting_posts_box ' .$view. '"><div class="row">';
    echo do_shortcode("[ulisting-latest listing_type_id='$type_id' limit='$per_page']");
    echo '</div></div>';
}