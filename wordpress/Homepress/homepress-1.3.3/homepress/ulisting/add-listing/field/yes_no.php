<?php
/**
 * Add listing field yes_no
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/field/yes_no.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
?>
<label class="add-listing-attribute-box-title"><?php echo esc_attr( $attribute->title ); ?></label>
<label>
	<input type="radio" value="1" v-model="attributes.<?php echo esc_attr( $attribute->name ); ?>.value">
	<?php esc_html_e('Yes', 'homepress')?>
</label>

<label>
	<input type="radio" value="0" v-model="attributes.<?php echo esc_attr( $attribute->name ); ?>.value">
	<?php esc_html_e('No', 'homepress')?>
</label>

<span v-if="errors['<?php echo esc_attr( $attribute->name ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $attribute->name ); ?>']}}</span>


