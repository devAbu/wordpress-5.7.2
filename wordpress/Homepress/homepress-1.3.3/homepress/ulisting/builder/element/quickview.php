<?php
/**
 * Builder element quick view
 *
 * Template can be modified by copying it to yourtheme/ulisting/builder/element/quickview.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.5.7
 */

$element['params']['class'] = "qview";
$element['params']['class'] .= " ".$element['params']['style_template'];
?>

<div <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute( $element ); ?> data-id="<?php echo esc_attr( $args[ 'model' ]->ID ); ?>"><i class="fa fa-eye" aria-hidden="true"></i><span class="quick-tooltip"><?php esc_html_e( 'Quick View', 'homepress' ); ?></span></div>