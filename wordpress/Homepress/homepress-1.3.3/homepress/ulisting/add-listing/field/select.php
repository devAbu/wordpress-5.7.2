<?php
/**
 * Add listing field select
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/field/select.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
?>
<label><?php echo esc_attr( $attribute->title ); ?></label>
<ulisting-select2 placeholder="<?php echo esc_html_e( 'Select', 'homepress' ) ?>" :key="<?php esc_attr( $attribute->id ); ?>" :options='attributes.<?php echo esc_attr( $attribute->name ); ?>.options' v-model='attributes.<?php echo esc_attr( $attribute->name ); ?>.value' theme='bootstrap4'></ulisting-select2>
<span v-if="errors['<?php echo esc_attr( $attribute->name ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $attribute->name ); ?>']}}</span>