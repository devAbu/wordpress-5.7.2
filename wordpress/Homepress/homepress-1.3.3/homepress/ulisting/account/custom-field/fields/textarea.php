<?php
/**
 * Account custom fields textarea
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/custom-field/fields/textarea.php
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
?>
<label><?php echo  esc_html__( $field['name'], "homepress" ); ?></label>
<textarea class="stm-form-control" v-model="<?php echo esc_attr( $model ); ?>"></textarea>
<span v-if="errors['<?php echo esc_attr($field['slug'])?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $field['slug'] ); ?>']}}</span>