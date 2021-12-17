<?php
/**
 * Builder attribute title
 *
 * Template can be modified by copying it to yourtheme/ulisting/builder/attribute/title.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
$element['params']['class'] .= " attribute-title-box ulisting_element_".$element['id'];

?>

<?php if ( is_single() && !isset( $is_similar ) ) : ?>
    <h4 <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute($element) ?>>
        <?php echo esc_attr( $args['model']->post_title ); ?>
    </h4>
<?php else: ?>
    <div class="inventory-single-page-link_inventory">
        <a href="<?php echo esc_url( get_permalink( $args['model']->ID ) ); ?>" <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute($element) ?>>
            <?php echo esc_attr( $args['model']->post_title ); ?>
        </a>
    </div>
<?php endif; ?>


