<?php
/**
 * Builder attribute location
 *
 * Template can be modified by copying it to yourtheme/ulisting/builder/attribute/location.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 2.0.0
 */
use uListing\Classes\StmListingAttribute;
use uListing\Classes\StmListingTemplate;

$map_type     = \uListing\Classes\StmListingSettings::get_current_map_type();
$access_token = \uListing\Classes\StmListingSettings::get_map_api_key($map_type);

$is_google = $map_type === 'google';
if ( $is_google ) {
    wp_enqueue_script('stm-google-map', ULISTING_URL . '/assets/js/frontend/stm-google-map.js', array('vue'), ULISTING_VERSION);
    wp_enqueue_script('google-maps', "https://maps.googleapis.com/maps/api/js?libraries=geometry,places&key=" . get_option('google_api_key') . "&callback=googleApiLoadToggle", array(), '', true);
} else {
    wp_enqueue_script('stm-open-street-map', ULISTING_URL . '/assets/js/frontend/open-street-map.js', array('vue'), ULISTING_VERSION);
}

$location = $args['model']->getAttributeValue($element['params']['attribute_type']);
$data           = $location;
$data['id']     = $args['model']->ID;
$data['zoom']   = $element['params']['zoom'];
$data['marker'] = [
    'icon' => apply_filters('ulisting_map_marker_icon', [
        'url'           =>  $args['model'],
        'scaledSize'    => array('height' => 40, 'width' => 40)
    ])
];

?>
<div <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute($element) ?>>
    <?php if( isset( $element['params']['view_item'] ) AND $element['params']['view_item'] ) : ?>
        <p><?php echo esc_html( $location['address'] ); ?></p>
    <?php else:?>
        <?php
            wp_enqueue_script('ulisting-attribute-location', ULISTING_URL . '/assets/js/frontend/builder/attribute/location.js', array('vue'), ULISTING_VERSION);
            wp_add_inline_script('ulisting-attribute-location', "var ulisting_attribute_location_data = json_parse('". ulisting_convert_content(json_encode($data)) ."');", 'before');
        ?>
        <div class="stm-row location-box-header">
            <div class="stm-col-12 stm-col-md-5">
                <h5><?php echo esc_attr( $element['title'] );?></h5>
            </div>
            <div class="stm-col-12 stm-col-md-7 location-address">
                <span class="location-box-icon property-icon-pin-marker"></span> <?php echo esc_attr( $location['address'] ); ?>
            </div>
        </div>

        <div class="location-box-map" id="ulisting_attribute_location_<?php echo esc_attr( $args['model']->ID ); ?>" style="width: <?php echo esc_html( $element['params']['width'] ); ?>; height: <?php echo esc_html( $element['params']['height'] ); ?>">
            <?php if($is_google): ?>
                <stm-google-map
                        inline-template
                        id="listing-map_<?php echo  esc_attr($data['id'])?>"
                        :zoom="zoom"
                        :center="center"
                        :markers="markers"
                        map-type-id="terrain" >
                    <div class="stm-listing-map-custom"> <div style="width: <?php echo esc_html($element['params']['width'])?>; height: <?php echo esc_html($element['params']['height'])?>" v-bind:id="id" ></div></div>
                </stm-google-map>
            <?php else:?>
                <open-street-map
                        inline-template
                        id="listing-map_<?php echo  esc_attr($data['id'])?>"
                        :zoom="13"
                        :center="center"
                        :markers="markers"
                        map-type-id="terrain"
                        access_token="<?php echo esc_attr($access_token)?>">
                    <div class="stm-listing-map-custom"> <div style="width: <?php echo esc_html($element['params']['width'])?>; height: <?php echo esc_html($element['params']['height'])?>" v-bind:id="id" ></div></div>
                </open-street-map>
            <?php endif;?>
        </div>
    <?php endif;?>
</div>
