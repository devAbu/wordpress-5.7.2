<?php
/**
 * This is custom module for inventory builder
 *
 * This template does not belong to Ulisting
 *
 * @version 0.1
 */
?>

<?php if( isset( $args[ 'model' ]->featured ) ): ?>
<div <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute($element) ?>>
    <div class="inventory_featured_label" >
        <?php esc_html_e( 'Featured', 'homepress' ); ?>
    </div>
</div>
<?php endif; ?>

