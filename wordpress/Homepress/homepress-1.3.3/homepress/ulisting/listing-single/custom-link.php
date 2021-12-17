<?php
/**
 * Builder attribute location
 *
 * Template can be modified by copying it to yourtheme/ulisting/builder/attribute/location.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0.1
 */
use uListing\Classes\StmListingAttribute;
use uListing\Classes\StmListingTemplate;

?>

<div <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute( $element ) ?>>
    <a href="<?php echo esc_attr($element['params']['url']); ?>" target="_blank" class="custom-link-module">
        <span class="title"><?php echo esc_attr($element['params']['title']); ?></span>
        <span class="link-title"><?php echo esc_attr($element['params']['title-link']); ?> <span class="property-icon-link"></span></span>
    </a>
</div>