<?php
/**
 * Region list short code
 *
 * Template can be modified by copying it to yourtheme/ulisting/region/region-list-short-code.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0.4
 */
wp_enqueue_script( 'owl.carousel.min' );
wp_enqueue_script( 'ulisting/ulisting_posts_carousel/style_1' );


$view = $params['view'];
$carousel_stage = $params['carousel_stage'];
$items_count_desktop = $params['items_count_desktop'];
$items_count_landscape = $params['items_count_landscape'];
$items_count_tablet = $params['items_count_tablet'];
$items_count_mobile_landscape = $params['items_count_mobile_landscape'];
$items_count_mobile = $params['items_count_mobile'];
$carousel_nav = $params['carousel_nav'];
$carousel_dots = $params['carousel_dots'];
$carousel_loop = $params['carousel_loop'];
$google_api_key = get_option('google_api_key');
?>

<div>
    <div class="ulisting_posts_box <?php echo esc_attr( $view ); ?>"
         data-stage="<?php echo esc_attr( $carousel_stage ); ?>"
         data-desktop="<?php echo esc_attr( $items_count_desktop ); ?>"
         data-landscape="<?php echo esc_attr( $items_count_landscape ); ?>"
         data-tablet="<?php echo esc_attr( $items_count_tablet ); ?>"
         data-mobile_landscape="<?php echo esc_attr( $items_count_mobile_landscape ); ?>"
         data-mobile="<?php echo esc_attr( $items_count_mobile ); ?>"
         data-nav="<?php echo esc_attr( $carousel_nav ); ?>"
         data-dots="<?php echo esc_attr( $carousel_dots ); ?>"
         data-loop="<?php echo esc_attr( $carousel_loop ); ?>">

        <?php if( $view !== 'ulisting_posts_carousel owl-carousel' ){ echo '<div class="row">'; } ?>
        <?php foreach ( $models as $model ) : ?>

        <?php
	        $items_count = 0;
	        $min_price = 0;
	        $max_price = 0;

	        if(isset($data[$model->term_id]['items_count']))
		        $items_count = $data[$model->term_id]['items_count'];

	        if(isset($data[$model->term_id]['min_price']))
		        $min_price = $data[$model->term_id]['min_price'];

	        if(isset($data[$model->term_id]['max_price']))
		        $max_price = $data[$model->term_id]['max_price'];
	    ?>


        <?php $paths = get_term_meta($model->term_id, 'stm_listing_region_polygon', true);?>
        <div class="neighborhoods_box">
            <img class="neighborhoods_thumbnail" src="<?php echo esc_url( $model->get_static_map_image( [400,300] )) ; ?>" alt="<?php echo esc_attr( $model->name ); ?>" />
            <div class="neighborhoods_info">
                <h6 class="neighborhoods_title">
                    <a href="<?php echo esc_attr( $listing_type->getPageUrl()."?region=".$model->term_id ); ?>">
                        <?php echo esc_attr($model->name); ?>
                    </a>
                </h6>
                <div class="neighborhoods_listing_count">
                    <span class="property-icon-multi-family"></span>
                    <div><strong><?php esc_html_e("Listings","homepress");?></strong>: <?php echo esc_attr( $items_count ); ?></div>
                </div>
                <div class="neighborhoods_listing_price">
                    <span class="property-icon-home_for_sale"></span>
                    <div>
                        <strong><?php esc_html_e( "Price","homepress" ); ?></strong>:
                        <?php echo ulisting_currency_format( $min_price ); ?>
                        <?php if( $min_price != $max_price ) : ?>
                            - <?php echo ulisting_currency_format( $max_price ); ?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
        <?php if( $view !== 'ulisting_posts_carousel owl-carousel' ){ echo '</div>'; } ?>
    </div>
</div>

