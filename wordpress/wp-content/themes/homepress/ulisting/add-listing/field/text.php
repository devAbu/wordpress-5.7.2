<?php
/**
 * Add listing field text
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/field/text.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
?>
<label><?php echo esc_attr( $attribute->title ); ?></label>
<input type="text" v-model="attributes.<?php echo esc_attr( $attribute->name ); ?>.value">
<span v-if="errors['<?php echo esc_attr( $attribute->name ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $attribute->name ); ?>']}}</span>