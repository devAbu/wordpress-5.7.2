<?php
/**
 * Builder attribute location
 *
 * Template can be modified by copying it to yourtheme/ulisting/builder/attribute/location.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.5.6
 */
use uListing\Classes\StmListingAttribute;
use uListing\Classes\StmListingTemplate;
$listingType = $args['model']->getType();
?>
<?php if(!empty($args['model']->getAttributeValue($element['params']['attribute'])) || uListing_maybe_convert_bool($listingType->getMeta('hide-empty-attribute') )):?>

    <div <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute( $element ); ?>>
        <?php

        \uListing\Classes\Vendor\ArrayHelper::multisort( $gallery_items, "sort" );

        $location = $args['model']->getAttributeValue( StmListingAttribute::TYPE_LOCATION );

        if( isset( $element['params']['style_template'] ) ) {
            StmListingTemplate::load_template(
                "builder/attribute/gallery/{$element['params']['style_template']}",
                [
                    'gallery_items' => $gallery_items,
                    'model' => $args['model'],
                    'element' => $element,
                    'location' => $location
                ],
                true);
        }
        ?>
    </div>

<?php endif;