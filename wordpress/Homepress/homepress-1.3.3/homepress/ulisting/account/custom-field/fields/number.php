<?php
/**
 * Account custom fields number
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/custom-field/fields/number.php
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
?>
<label> <?php echo esc_html__( $field['name'], "homepress" ); ?></label>
<input type="number"
    v-model="<?php echo esc_attr( $model ); ?>"
    class="stm-form-control"
    placeholder="<?php esc_attr_e( $field['name'], "homepress" ); ?>" />
<span v-if="errors['<?php echo esc_attr( $field['slug'] ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $field['slug'] ); ?>']}}</span>