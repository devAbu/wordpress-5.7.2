<?php
/**
 * Account custom fields select
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/custom-field/fields/select.php
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
?>
<label> <?php echo  esc_html__( $field['name'], "homepress" ); ?></label>
<ulisting-select2 :options="custom_fields_items['<?php echo esc_attr( $field['slug'] ); ?>']"
         v-model="<?php echo esc_attr( $model ); ?>"
         :placeholder="'<?php echo esc_attr( $field['name'] ); ?>'"
         theme="bootstrap4">
</ulisting-select2>
<span v-if="errors['<?php echo esc_attr( $field['slug'] ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $field['slug'] ); ?>']}}</span>