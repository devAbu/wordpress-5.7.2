<?php
/**
 * Add listing listing type
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/listing-type.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
use uListing\Classes\StmListingType;
use uListing\Classes\StmListingSettings;

$addListingPageUrl = StmListingSettings::getAddListingPageUrl();
$listingTypes = StmListingType::getDataList();
?>

<div class="add-listing-types">
    <h1><?php echo esc_attr( $action ); ?></h1>

    <div class="add-listing-steps add-listing-step-one">
        <div class="add-listing-steps-column active-step"><h6><span class="add-listing-steps-icon-wrap"><span class="add-listing-steps-number">1</span> <span class="add-listing-steps-text"><?php esc_html_e( 'Listing Type', 'homepress' ); ?></span></span></h6></div>
        <div class="add-listing-steps-column"><h6><span class="add-listing-steps-icon-wrap"><span class="add-listing-steps-number">2</span> <span class="add-listing-steps-text"><?php esc_html_e( 'Create Listing', 'homepress' ); ?></span></span></h6></div>
        <div class="add-listing-steps-column"><h6><span class="add-listing-steps-icon-wrap"><span class="add-listing-steps-number">3</span> <span class="add-listing-steps-text"><?php esc_html_e( 'Done', 'homepress' ); ?></span></span></h6></div>
    </div>
	<ul>
	<?php foreach ( $listingTypes as $key => $value ) : ?>
		<li>
            <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $key ), 'full' ); ?>
			<a href="<?php echo esc_url( $addListingPageUrl.'?listingType='.$key ); ?>" style="background-image: url('<?php echo esc_url( $thumb['0'] ); ?>')" <?php if( empty( $thumb ) ) { ?>class="none-image"<?php } ?>>
                <span><?php echo esc_attr( $value ); ?></span>
            </a>
		</li>
	<?php endforeach;?>
	</ul>
</div>

