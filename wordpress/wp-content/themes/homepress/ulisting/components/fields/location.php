<?php
/**
 * Components fields location
 *
 * Template can be modified by copying it to yourtheme/ulisting/components/fields/location.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 2.0.0
 */

$map_type     = \uListing\Classes\StmListingSettings::get_current_map_type();
$access_token = \uListing\Classes\StmListingSettings::get_map_api_key($map_type);

$is_google = $map_type === 'google';
if ( $is_google ) {
    wp_enqueue_script('stm-google-map', ULISTING_URL . '/assets/js/frontend/stm-google-map.js', array('vue'), ULISTING_VERSION);
    wp_enqueue_script('google-maps',"https://maps.googleapis.com/maps/api/js?libraries=geometry,places&key=".get_option('google_api_key')."&callback=googleApiLoadToggle", array(), '', true);
}
?>
<?php if( $model ) : ?>
<div class="inventory-location-filter-wrap">
    <div class="container">
        <?php if( isset( $field[ 'label' ] ) ) {
            $field_range_before = apply_filters( "stm-field-location-before", [ 'model' => $model, 'field' => $field ] );
            echo ( !is_array( $field_range_before ) ) ? $field_range_before : "";
        } ?>

        <?php if($is_google): ?>
            <stm-field-location inline-template
                data-v-bind_map="map"
                data-v-bind_icon_url="icon_url"
                data-v-bind_key="generateRandomId()"
                data-v-bind_id="'field_location_'+generateRandomId()"
                data-v-model='<?php echo esc_attr( $model ) ?>'
                data-v-bind_callback_change='<?php echo esc_attr( $callback_change ) ?>'
                placeholder="<?php echo esc_attr( $placeholder ) ?>"
                attribute_name='location'>
                <div class="inventory-location-filter" data-v-bind_class="{'uListing-no-results-location' : !noFound }">
                    <div class="inventory-location-field stm-ulisitng-location-field-wrapper">
                        <input class="form-control" data-v-bind_id="id" data-v-on_input="watchForInput" data-v-bind_placeholder='placeholder' data-v-model='value.address' type='text'>
                        <span @click="findMyLocation" class="stm-find-my-location"></span>
                    </div>
                    <div class="inventory-location-tooltip-wrap" v-if="value.address.length === 0">
                        <div class="inventory-location-tooltip">
                            <?php esc_html_e( 'First choose location', 'homepress' ); ?>
                        </div>
                    </div>
                    <div class="inventory-location-tooltip-wrap" v-else-if="!noFound">
                        <div class="inventory-location-tooltip">
                            <?php esc_html_e( 'No location found', 'homepress' ); ?>
                        </div>
                    </div>
                </div>
            </stm-field-location>
        <?php else:?>
            <stm-field-osm-location inline-template
                data-v-bind_map="map"
                data-v-bind_icon_url="icon_url"
                data-v-bind_key="generateRandomId()"
                data-v-bind_id="'field_location_'+generateRandomId()"
                data-v-model='<?php echo esc_attr( $model ) ?>'
                data-v-bind_callback_change='<?php echo esc_attr( $callback_change ) ?>'
                placeholder="<?php echo esc_attr( $placeholder ) ?>"
                attribute_name='location'
                access_token="<?php echo esc_attr($access_token)?>">
                <div class="inventory-location-filter">
                    <div class="inventory-location-field stm-ulisitng-location-field-wrapper">
                        <input class="form-control" data-v-bind_id="id" data-v-bind_placeholder='placeholder' data-v-model='value.address' type='text'>
                        <span @click="findMyLocation" class="stm-find-my-location"></span>
                    </div>
                    <div class="inventory-location-tooltip-wrap">
                        <div class="inventory-location-tooltip">
                            <?php esc_html_e( 'First choose location', 'homepress' ); ?>
                        </div>
                    </div>
                </div>
            </stm-field-osm-location>
        <?php endif?>

        <?php if( isset( $field[ 'label' ] ) ) {
            $field_range_after = apply_filters( "stm-field-location-after", [ 'model' => $model, 'field' => $field ] );
            echo ( !is_array( $field_range_after ) ) ? $field_range_after : "";
        } ?>
    </div>
</div>
<?php endif; ?>

