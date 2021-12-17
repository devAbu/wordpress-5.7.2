<?php
/**
 * Add listing field text_area
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/field/text_area.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.3.8
 */
?>
<label class="add-listing-attribute-box-title"><?php echo esc_attr( $attribute->title ); ?></label>
<textarea rows="10" class="form-control" v-model="attributes.<?php echo esc_attr($attribute->name)?>.value"></textarea>
<span v-if="errors['<?php echo esc_attr( $attribute->name ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $attribute->name ); ?>']}}</span>

