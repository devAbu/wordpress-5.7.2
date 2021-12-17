<?php
wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'ulisting/single/gallery/style_1' );

foreach ($model->getAttributeValue($element['params']['attribute']) as $val) {
    $full = wp_get_attachment_image_src($val->value,'full');
    $single = wp_get_attachment_image_src($val->value,'homepress-image-ulisting-gallery_style_1');
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

$count = (is_array($gallery_items) && sizeof($gallery_items) > 9 ) ? sizeof($gallery_items) : 0;
?>
<?php  if(!empty($gallery_items)) : ?>
<div class="listing-gallery_<?php echo esc_attr( $element['id'] ); ?> listing-gallery_style_4 listing-gallery_global_carousel">
    <div class="listing-gallery-list">
        <div class="row">
            <?php $i = 1; foreach ( $gallery_items as $item ) : ?>
                <div class="item<?php if( $count AND $i > 9 ) {echo esc_attr(' hidden-items'); }?>" <?php echo esc_attr( $count AND $i == 9 ) ? "data-count='+" . ( $count - 9 ) . "'" : '' ?>>
                    <a target="_blank" href="<?php echo esc_url( $item['full'][0] ); ?>" data-elementor-lightbox-slideshow="listing-gallery-list-<?php echo esc_attr( $element['id'] ); ?>">
                        <img src="<?php echo esc_url( $item['thumbnail'][0] ); ?>" alt="<?php echo esc_attr( get_post_meta( $item['value'], '_wp_attachment_image_alt', true) ); ?>">
                    </a>
                </div>
                <?php $i++; endforeach; ?>
        </div>
    </div>
    <div class="listing-gallery-thumbnail-box">
        <div class="listing-gallery-thumbnail owl-carousel owl-theme">
            <?php foreach ( $gallery_items as $item ): ?>
                <div class="item">
                    <a target="_blank" href="<?php echo esc_url( $item['full'][0] ); ?>" data-elementor-lightbox-slideshow="listing-gallery-thumbnail-<?php echo esc_attr( $element['id'] ); ?>">
                        <img src="<?php echo esc_url( $item['single'][0] ); ?>" alt="<?php echo esc_attr( get_post_meta( $item['value'], '_wp_attachment_image_alt', true) ); ?>" />
                    </a>
                </div>
            <?php endforeach;?>
        </div>
        <div class="listing-gallery-thumbnail-count">
            <div class="count-box"><span class="property-icon-photo gallery-icon"></span> <?php echo esc_attr( sizeof($gallery_items) ); ?></div>
        </div>
    </div>
</div>
<?php endif; ?>