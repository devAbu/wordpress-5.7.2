<?php
/**
 * Add listing field gallery
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/field/gallery.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.5.6
 */
?>
<label class="add-listing-attribute-box-title"><?php echo esc_attr( $attribute->title ); ?></label>
<stm-file-dragdrop inline-template :files="attributes.<?php echo esc_attr( $attribute->name ); ?>.value" :attr="'<?php echo esc_attr( $attribute->name );?>'" :feature_image="feature_image" @set-feature-image="setfeatureImage"  v-on:stm-file-dragdrop-update="attributes.<?php echo esc_attr( $attribute->name ); ?>.value = $event">
	<div>
		<div class="stm-file-dragdrop" @dragover.prevent @drop="onDrop">
			<div class="main-image" v-if="!files.length">
				<span>
					<i class="property-icon-image-add-button"></i>
					<input type="file" v-bind:style="{opasity:0}" multiple  @change="onChange" />
				</span>
			</div>

			<div class="main-image" v-if="files.length"   v-bind:style="{ backgroundImage: 'url(' + main.data + ')' }" >
				<span>
					<i class="property-icon-image-add-button"></i>
					<input type="file" v-bind:style="{opasity:0}" multiple  @change="onChange" />
				</span>
			</div>
		</div>

		<div class="stm-gallery-list">
			<draggable v-model="files" class="stm-row" :options="{group:'gallery'}" @end="end">
				<div class="stm-gallery-list-column" v-for="(val, key) in files" :key="key" >
					<div class="item"  v-bind:class="{ feature: checkfeature('<?php echo esc_attr( $attribute->name ); ?>', key, val)}">
						<span v-if="checkfeature('<?php echo esc_attr( $attribute->name ); ?>', key, val)" class="feature-info"><?php echo __('feature', 'homepress');?></span>
						<span class="image" v-bind:style="{ backgroundImage: 'url(' + val.data + ')' }" ></span>
						<div class="bottom">
							<span class="close" @click="remove(key)"><i class="property-icon-close-small"></i></span>
							<span class="featured"  @click="selectfeature('<?php echo esc_attr( $attribute->name ); ?>', key, val)">
								<i v-if="checkfeature('<?php echo esc_attr( $attribute->name ); ?>', key, val)" class="fa fa-check-circle"></i>
								<i v-if="!checkfeature('<?php echo esc_attr( $attribute->name ); ?>', key, val)" class="property-icon-star-solid"></i>
							</span>
						</div>
					</div>
				</div>
			</draggable>
		</div>
	</div>
</stm-file-dragdrop>
<span v-if="errors['<?php echo esc_attr( $attribute->name ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $attribute->name ); ?>']}}</span>