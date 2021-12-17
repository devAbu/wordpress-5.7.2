<?php
/**
 * Loop photo count
 *
 * Template can be modified by copying it to yourtheme/ulisting/loop/photo-count.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0.1
 */
$element['params']['class'] .= " count-box ulisting_element_".$element['id'];
?>

<div <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute($element) ?> >
    <span class="property-icon-photo gallery-icon"></span> <?php echo current($args['model']->getImageCount($args['model']->ID)); ?>
</div>




