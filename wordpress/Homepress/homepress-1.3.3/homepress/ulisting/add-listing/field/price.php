<?php
/**
 * Add listing field price
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/field/price.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
?>
<div class="add-listing-attribute-price-wrap">
    <div class="add-listing-attribute-price-genuine">
        <label><?php echo esc_attr( $attribute->title ); ?></label>
        <input type="number" v-model="attributes.<?php echo esc_attr( $attribute->name ); ?>.value.genuine">
    </div>
    <div class="add-listing-attribute-price-sale">
        <label><?php echo 'Sale '.$attribute->title?></label>
        <input type="number" v-model="attributes.<?php echo esc_attr( $attribute->name ); ?>.value.sale">
    </div>
</div>
<span v-if="errors['<?php echo esc_attr( $attribute->name ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $attribute->name ); ?>']}}</span>