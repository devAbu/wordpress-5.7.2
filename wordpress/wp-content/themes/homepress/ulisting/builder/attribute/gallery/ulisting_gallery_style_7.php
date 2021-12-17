<?php
wp_enqueue_script( 'ulisting/single/gallery/style_6' );

foreach ($model->getAttributeValue($element['params']['attribute']) as $val) {
    $full = wp_get_attachment_image_src($val->value,'full');
    $single = wp_get_attachment_image_src($val->value,'homepress-image-ulisting-gallery_single_style_7');
    $thumbnail = wp_get_attachment_image_src($val->value,'homepress-image-ulisting-gallery_thumb_style_1');

    $gallery_items[] = [
        'value' => $val->value,
        'sort' => $val->sort,
        'full' => ($full) ? $full : [ulisting_get_placeholder_image_url()],
        'single' => ($single) ? $single :  [ulisting_get_placeholder_image_url()],
        'thumbnail' => ($thumbnail) ? $thumbnail :  [ulisting_get_placeholder_image_url()],
    ];
}

\uListing\Classes\Vendor\ArrayHelper::multisort($gallery_items, "sort");

$latitude = $location['latitude'];
$longitude = $location['longitude'];

$count = ( is_array($gallery_items) && sizeof($gallery_items) > 1 ) ? sizeof($gallery_items) : 0;

?>
<?php  if(!empty($gallery_items)) : ?>
    <div class="listing-gallery listing-gallery_<?php echo esc_attr( $element['id'] ); ?> listing-gallery_style_7">
        <div class="listing-gallery-thumbnail-box">
            <div class="listing-gallery-thumbnail">
            <?php $i = 1; foreach ( $gallery_items as $item ) : ?>
                <div class="item<?php if( $count AND $i > 1 ) {echo esc_attr(' hidden-items'); }?>" <?php echo esc_attr( $count AND $i == 1 ) ? "data-count='+" . ( $count - 1 ) . "'" : '' ?>>
                    <a target="_blank" href="<?php echo esc_url( $item['full'][0] ); ?>" data-elementor-lightbox-slideshow="listing-gallery-list-<?php echo esc_attr( $element['id'] ); ?>">
                        <img src="<?php echo esc_url( $item['single'][0] ); ?>" alt="<?php echo esc_attr( get_post_meta( $item['value'], '_wp_attachment_image_alt', true) ); ?>" />
                    </a>
                </div>
            <?php $i++; endforeach; ?>
            </div>
        </div>
        <div class="listing-gallery-auxiliary-buttons-wrap">
            <div class="listing-gallery-auxiliary-buttons">
                <div class="gallery-view active"><span class="property-icon-photo"></span></div>
                <div class="map-view" style="font-size: 16px;"><span class="property-icon-map-solid-style"></span></div>
                <div class="street-view"><span class="property-icon-panorama"></span></div>
            </div>
        </div>
        <div class="gallery-data-location" style="display: none" data-lat="<?php echo esc_attr( $latitude ); ?>" data-lng="<?php echo esc_attr( $longitude ); ?>" data-icon="<?php echo get_template_directory_uri()."/assets/images/map-marker.svg"?>"></div>
        <div id="gallery-map"></div>
    </div>
<?php endif; ?>