<?php
/**
 * Add listing field radio_button
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/field/radio_button.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
?>
<label class="add-listing-attribute-box-title"><?php echo esc_attr( $attribute->title ); ?></label>
<div v-for="(val, key) in attributes.<?php echo esc_attr( $attribute->name ); ?>.options">
	<label>
		<input type="radio" v-bind:value="val.id" v-model="attributes.<?php echo esc_attr( $attribute->name ); ?>.value">
		{{val.text}}
	</label>
</div>
<span v-if="errors['<?php echo esc_attr( $attribute->name ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $attribute->name ); ?>']}}</span>
