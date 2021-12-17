<?php
/**
 * Add listing field category
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/field/category.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.3.6
 */
?>
<?php if(isset($attribute->title)): ?>
    <label class="add-listing-attribute-box-title"><?php echo esc_attr( $attribute->title ); ?></label>
    <div class="stm-listing-select">
        <ulisting-select2 :clear="true" :options='attributes.<?php echo esc_attr( $attribute->name ); ?>.options' :text="'name'" v-model='attributes.<?php echo esc_attr( $attribute->name ); ?>.value' theme='bootstrap4'></ulisting-select2>
        <span v-if="errors['<?php echo esc_attr( $attribute->name ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $attribute->name ); ?>']}}</span>
    </div>
<?php endif;?>