<?php
/**
 * Add listing field number
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/field/number.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
?>
<label class="add-listing-attribute-box-title"><?php echo esc_attr( $attribute->title ); ?></label>
<input type="number" v-model="attributes.<?php echo esc_attr( $attribute->name ); ?>.value">
<span v-if="errors['<?php echo esc_attr( $attribute->name ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $attribute->name ); ?>']}}</span>

