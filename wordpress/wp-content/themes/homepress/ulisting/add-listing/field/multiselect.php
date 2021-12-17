<?php
/**
 * Add listing field multiselect
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/field/multiselect.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
?>
<label class="add-listing-attribute-box-title"><?php echo esc_attr( $attribute->title ); ?></label>
<ulisting-select2  :key="<?php esc_attr( $attribute->id ); ?>" :options='attributes.<?php echo esc_attr( $attribute->name ); ?>.options' multiple="multiple" v-model='attributes.<?php echo esc_attr( $attribute->name ); ?>.value' theme='bootstrap4'></ulisting-select2>
<span v-if="errors['<?php echo esc_attr( $attribute->name ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $attribute->name ); ?>']}}</span>