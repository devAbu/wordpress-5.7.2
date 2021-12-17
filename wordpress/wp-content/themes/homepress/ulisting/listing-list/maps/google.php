<?php
/**
 * Listing list osm google
 *
 * Template can be modified by copying it to yourtheme/ulisting/listing-list/maps/google.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.3.7
 */
?>

<stm-google-map
        inline-template
        :map="map"
        @change="setMap"
        id="listing-map"
        width="100%"
        height="100%"
        :view="false"
        set_center="true"
        :zoom="13.25"
        :markers="markers"
        :cluster="true"
        :bounds="true"
        :center="center"
        :screen="false"
        :type_id="false"
        :zoom_control="false"
        :polygon_data="polygon"
        open_map_by_hover="<?php echo esc_attr($open_map_by_hover)?>"
>
    <div id="uListingMainMap" v-bind:style="{ width: width, height: height}" :class="{'fullScreen': fullscreen}"
         style="position: relative;">
        <div v-bind:style="{ width: width, height: height}" v-bind:id="id"></div>
        <div id="uListing-map-types" :class="{'stm-hasAccess': hasAccess}">
            <a @click.prevent.click="fade = !fade" href="#"
               class="stm-view"><?php echo __( 'Map type', 'homepress' ); ?></a>
            <ul v-show="fade" style="display: none;">
                <li @click="changeMapType(event,'roadmap')"
                    class="selected-map-type"><?php echo __( 'Roadmap', 'homepress' ); ?></li>
                <li @click="changeMapType(event,'satellite')"><?php echo __( 'Satellite', 'homepress' ); ?></li>
                <li @click="changeMapType(event,'hybrid')"><?php echo __( 'Hybrid', 'homepress' ); ?></li>
                <li @click="changeMapType(event,'terrain')"><?php echo __( 'Terrain', 'homepress' ); ?></li>
            </ul>
        </div>
        <div id="uListing-map-zoom" :class="{'stm-hasAccess': hasAccess}">
            <a @click.prevent="changeZoom(-1, 'minus')" href="#" class="stm-minus"></a>
            <span class="ulisting-map-zoom-separator"></span>
            <a @click.prevent="changeZoom(1, 'plus')" href="#" class="stm-plus"></a>
        </div>
        <div id="uListing-map-fullscreen" :class="{'stm-hasAccess': hasAccess}">
            <a @click.prevent="openFullScreen" href="#" :class="{'stm-compress': fullscreen}"
               class="stm-fullscreen"></a>
        </div>
        <div id="uListing-map-pagination" :class="{'stm-hasAccess': hasAccess}">
            <a @click.prevent="mapPagination(-1)" href="#"
               class="stm-prev"><?php echo __( 'Prev', 'homepress' ); ?></a>
            <a @click.prevent="mapPagination(1)" href="#"
               class="stm-next"><?php echo __( 'Next', 'homepress' ); ?></a>
        </div>
    </div>
</stm-google-map>
