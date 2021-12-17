<?php
/**
 * Listing list osm map
 *
 * Template can be modified by copying it to yourtheme/ulisting/listing-list/maps/osm.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.3.7
 */
?>
<open-street-map
        inline-template
        id="listing-map"
        width="100%"
        :zoom_control="false"
        height="100%"
        set_center="true"
        :zoom="13.25"
        @change="setMap"
        :markers="markers"
        :cluster="true"
        :bounds="true"
        :center="center"
        access_token="<?php echo esc_attr( $access_token ); ?>"
        open_map_by_hover="<?php echo esc_attr($open_map_by_hover)?>">
    <div id="uListingMainMap" v-bind:style="{ width: width, height: height}" :class="{'fullScreen': fullscreen}"
         style="position: relative;">
        <div v-bind:style="{ width: width, height: height}" v-bind:id="id"></div>
        <div id="uListing-map-pagination" :class="{'stm-hasAccess': hasAccess}">
            <a @click.prevent="mapPagination(-1)" href="#"
               class="stm-prev"><?php echo __( 'Prev', 'homepress' ); ?></a>
            <a @click.prevent="mapPagination(1)" href="#"
               class="stm-next"><?php echo __( 'Next', 'homepress' ); ?></a>
        </div>
        <div id="uListing-map-zoom" :class="{'stm-hasAccess': hasAccess}">
            <a @click.prevent="changeZoom(1, 'plus')" href="#" class="stm-plus"></a>
            <span class="ulisting-map-zoom-separator"></span>
            <a @click.prevent="changeZoom(-1, 'minus')" href="#" class="stm-minus"></a>
        </div>
        <div id="uListing-map-fullscreen" :class="{'stm-hasAccess': hasAccess}">
            <a @click.prevent="openFullScreen" href="#" :class="{'stm-compress': fullscreen}"
               class="stm-fullscreen"></a>
        </div>
    </div>
</open-street-map>
