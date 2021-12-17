<?php
/**
 * Account custom fields text
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/custom-field/fields/text.php
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
?>
<label><?php echo esc_html__( $field['name'], "homepress" ); ?></label>
<input type="text"
    v-model="<?php echo esc_attr( $model ); ?>"
    class="stm-form-control"
    placeholder="<?php esc_attr_e( $field['name'], "homepress" ); ?>" />
<span v-if="errors['<?php echo esc_attr( $field['slug'] ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $field['slug'] ); ?>']}}</span>