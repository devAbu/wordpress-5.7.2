<?php
/**
 * Add listing field wp_editor
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/field/wp_editor.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.3.0
 */
?>
<label class="add-listing-attribute-box-title"><?php echo esc_attr( $attribute->title ); ?></label>
<tinymce v-model="attributes.<?php echo esc_attr( $attribute->name ); ?>.value"
	:plugins="tinymcePlugins"
	:toolbar1="tinymceToolbar1"
	:toolbar2="tinymceToolbar2"
	:other="tinymceOtherOptions"
    data-name="<?php echo esc_attr($attribute->name)?>">
</tinymce>
<span v-if="errors['<?php echo esc_attr( $attribute->name ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $attribute->name ); ?>']}}</span>
