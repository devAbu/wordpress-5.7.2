<?php
/**
 * Builder basic attribute-box
 *
 * Template can be modified by copying it to yourtheme/ulisting/builder/basic/attribute-box.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.4.1
 */
use uListing\Classes\StmListingTemplate;
$style_template = isset($element['params']['style_template']) ? $element['params']['style_template'] : '';
$element['params']['class'] .= " attribute-box attribute-box-".$style_template;
?>

<div <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute( $element ); ?>>
    <?php if( isset( $element['elements'] ) ) : ?>
		<?php foreach ( $element['elements'] as  $_element ) : ?>
        <?php if (isset($_element['params']['attribute_type'])):

                $listingType = $args['model']->getType();
                $value =  $args['model']->getOptionValue($_element['params']['attribute']);

            ?>

            <div class="attribute-box-columns attribute-box-columns_<?php echo esc_attr( $element['params']['column'] ); ?>">
                <?php
                if( isset($_element['params']['style_template']) && $_element['params']['style_template'] == "0" )
                    $_element['params']['style_template'] = isset( $element['params']['style_template']) ?  $element['params']['style_template'] : '';

                StmListingTemplate::load_template(
                    'builder/attribute/'.$_element['params']['attribute_type'],
                    [
                        "args" => $args,
                        "element" => $_element,
                    ],
                    true );
                ?>
            </div>
           <?php endif;?>
		<?php endforeach;?>
	<?php endif;?>
</div>
