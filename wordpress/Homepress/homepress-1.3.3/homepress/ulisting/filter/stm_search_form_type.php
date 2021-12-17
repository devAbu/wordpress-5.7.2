<?php
/**
 * Filter search form type
 *
 * Template can be modified by copying it to yourtheme/ulisting/filter/stm_search_form_type.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.3.0
 */

use uListing\Classes\StmListingType;
use uListing\Classes\StmListingTemplate;

ulisting_field_components_enqueue_scripts_styles();
wp_enqueue_script( 'stm-search-form-type', ULISTING_URL . '/assets/js/frontend/stm-search-form-type.js', array( 'vue' ), ULISTING_VERSION, true );
$id = rand( 10, 10000 ) . time();
$listing_type_data = [];
$listing_type_component = [];
?>

<?php foreach ( $listingsTypes as $listingsType ): $prefix = 'attribute.listing_type_' . $listingsType->ID; ?>
    <?php
    if( !isset( $listing_type_component[ $listingsType->ID ] ) )
        $listing_type_component[ $listingsType->ID ] = [];

    $data[ 'listung_types' ][ $listingsType->ID ] = array(
        "id" => $listingsType->ID,
        "url" => $listingsType->getPageUrl(),
        "advanced_panel_show" => false,
    );

    if( $search_fields = $listingsType->getSearchFields( StmListingType::SEARCH_FORM_TYPE ) ) {

        foreach ( $search_fields as $field ) {
            $field_type = key( $field );
            $field = current( $field );
            $field[ 'field_type' ] = $field_type;

            if( !isset( $field[ 'attribute_name' ] ) )
                $field[ 'attribute_name' ] = "";
            $data[ 'listung_types' ][ $listingsType->ID ][ 'fields_types' ][ $field[ 'attribute_name' ] ] = $field;

            if( $field[ 'field_type' ] == StmListingType::SEARCH_FORM_TYPE_SEARCH AND !empty( $field[ 'attribute_name' ] ) ) {
                $listing_type_data[ 'listing_type_' . $listingsType->ID ][ $field[ 'attribute_name' ] ] = '';
                $listing_type_component[ $listingsType->ID ][] = [
                    "label" => $field[ 'label' ],
                    "type" => $field[ 'type' ],
                    "template" => "" . StmListingTemplate::load_template( 'components/fields/' . $field[ 'type' ],
                            array(
                                "model" => $prefix . ".{$field['attribute_name']}",
                                "placeholder" => "{$field['placeholder']}",
                                "callback_change" => "change",
                            ) ) . ""
                ];
            }

            if( $field[ 'field_type' ] == StmListingType::SEARCH_FORM_TYPE_LOCATION ) {
                $listing_type_data[ 'listing_type_' . $listingsType->ID ][ $field[ 'attribute_name' ] ] = array( "address" => "", 'lat' => 0, 'lng' => 0 );
                $listing_type_component[ $listingsType->ID ][] = [
                    "label" => $field[ 'label' ],
                    "type" => $field[ 'type' ],
                    "template" => "" . StmListingTemplate::load_template( 'components/fields/' . $field[ 'type' ],
                            array(
                                "model" => $prefix . ".{$field['attribute_name']}",
                                "placeholder" => "{$field['placeholder']}",
                                "callback_change" => "change",
                            ) ) . ""
                ];
            }

            if( $field[ 'field_type' ] == StmListingType::SEARCH_FORM_TYPE_PROXIMITY ) {
                $listing_type_data[ 'listing_type_' . $listingsType->ID ][ $field[ 'attribute_name' ] ] = (int)$field[ 'default' ];
                $listing_type_component[ $listingsType->ID ][] = [
                    "label" => $field[ 'label' ],
                    "type" => $field[ 'type' ],
                    "template" => "" . StmListingTemplate::load_template( 'components/fields/' . $field[ 'type' ],
                            array(
                                "model" => $prefix . ".{$field['attribute_name']}",
                                "callback_change" => "change",
                                "units" => "{$field['units']}",
                                "min" => "{$field['min']}",
                                "max" => "{$field['max']}",
                            ) ) . ""
                ];
            }

            if( $field[ 'field_type' ] == StmListingType::SEARCH_FORM_TYPE_RANGE AND !empty( $field[ 'attribute_name' ] ) ) {
                $listing_type_data[ 'listing_type_' . $listingsType->ID ][ $field[ 'attribute_name' ] ] = array( $field[ 'min' ], $field[ 'max' ] );
                $listing_type_component[ $listingsType->ID ][] = [
                    "label" => $field[ 'label' ],
                    "type" => $field[ 'type' ],
                    "template" => "" . StmListingTemplate::load_template( 'components/fields/' . $field[ 'type' ],
                            array(
                                "model" => $prefix . ".{$field['attribute_name']}",
                                "callback_change" => "change",
                                "suffix" => "{$field['suffix']}",
                                "prefix" => "{$field['prefix']}",
                                "min" => "{$field['min']}",
                                "max" => "{$field['max']}",
                                "field" => $field
                            ) ) . ""
                ];
            }

            if( $field[ 'field_type' ] == StmListingType::SEARCH_FORM_TYPE_DROPDOWN AND !empty( $field[ 'attribute_name' ] ) ) {
                $listing_type_data[ 'listing_type_' . $listingsType->ID ][ $field[ 'attribute_name' ] ] = '';
                $listing_type_data[ 'listing_type_' . $listingsType->ID ][ $field[ 'attribute_name' ] . "_items" ] = isset($field['items']) ? $field[ 'items' ] : [];
                $listing_type_component[ $listingsType->ID ][] = [
                    "label" => $field[ 'label' ],
                    "type" => $field[ 'type' ],
                    "template" => " " . StmListingTemplate::load_template( 'components/fields/' . $field[ 'type' ], array(
                            "model" => $prefix . ".{$field['attribute_name']}",
                            "order_by" => ( isset( $field[ 'order_by' ] ) ) ? "{$field['order_by']}" : '',
                            "order" => ( isset( $field[ 'order' ] ) ) ? "{$field['order']}" : '',
                            "callback_change" => "change",
                            "items" => $prefix . ".{$field['attribute_name']}_items",
                            "hide_empty" => ( isset( $field[ 'hide_empty' ] ) ) ? "{$field['hide_empty']}" : '',
                            "placeholder" => ( isset( $field[ 'placeholder' ] ) ) ? "{$field['placeholder']}" : '',
                            "attribute_name" => $field[ 'attribute_name' ]
                        ) ) . ""
                ];
            }

            if( $field[ 'field_type' ] == StmListingType::SEARCH_FORM_TYPE_DATE AND !empty( $field[ 'attribute_name' ] ) ) {
                $listing_type_data[ 'listing_type_' . $listingsType->ID ][ $field[ 'attribute_name' ] ] = '';
                $listing_type_component[ $listingsType->ID ][] = [
                    "label" => $field[ 'label' ],
                    "type" => $field[ 'type' ],
                    "template" => " " . StmListingTemplate::load_template( 'components/fields/' . $field[ 'type' ], array(
                            "model" => $prefix . ".{$field['attribute_name']}",
                            "callback_change" => "change",
                            "name" => ( isset( $field[ 'attribute_name' ] ) ) ? "{$field['attribute_name']}" : '',
                            "date_type" => ( isset( $field[ 'date_type' ] ) ) ? "{$field['date_type']}" : '',
                            "placeholder" => ( isset( $field[ 'placeholder' ] ) ) ? "{$field['placeholder']}" : '',
                        ) ) . ""
                ];
            }

            if( $field[ 'field_type' ] == StmListingType::SEARCH_FORM_TYPE_CHECKBOX AND !empty( $field[ 'attribute_name' ] ) ) {
                $listing_type_data[ 'listing_type_' . $listingsType->ID ][ $field[ 'attribute_name' ] ] = array();
                $listing_type_data[ 'listing_type_' . $listingsType->ID ][ $field[ 'attribute_name' ] . "_items" ] = $field[ 'items' ];
                $listing_type_component[ $listingsType->ID ][] = [
                    "label" => $field[ 'label' ],
                    "type" => $field[ 'type' ],
                    "template" => " " . StmListingTemplate::load_template( 'components/fields/' . $field[ 'type' ], array(
                            "model" => $prefix . ".{$field['attribute_name']}",
                            "order_by" => ( isset( $field[ 'order_by' ] ) ) ? "{$field['order_by']}" : '',
                            "order" => ( isset( $field[ 'order' ] ) ) ? "{$field['order']}" : '',
                            "callback_change" => "change",
                            "items" => $prefix . ".{$field['attribute_name']}_items",
                            "hide_empty" => ( isset( $field[ 'hide_empty' ] ) ) ? "{$field['hide_empty']}" : '',
                            "column" => isset($field[ 'column' ]) ? $field[ 'column' ] : '4',
                            "field" => $field
                        ) ) . ""
                ];
            }
        }
    }
    ?>
<?php endforeach; ?>

<div id="search_form_type_<?php echo esc_attr( $id ) ?>" class="ulisting-search_box ulisting-search_types ulisting-search_box_style_1">
    <stm-search-form-type key="<?php echo esc_attr( $id ) ?>" :stm_search_form_type_data="stm_search_form_type_data"
                          inline-template>
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <?php $i = 0;
                foreach ( $listingsTypes as $listingsType ): if( $i == 0 ) $data[ 'active_tab' ] = $listingsType->ID ?>
                    <li class="nav-item">
                        <a class="nav-link stm-cursor-pointer"
                           data-v-on_click="set_active_tab(<?php echo esc_attr( $listingsType->ID ) ?>)"
                           data-v-bind_class="{ active: active_tab == <?php echo esc_attr( $listingsType->ID ) ?>}"><?php echo esc_html( $listingsType->post_title ) ?></a>
                    </li>
                    <?php $i++; endforeach; ?>
            </ul>
            <div class="tab-content">
                <?php foreach ( $listingsTypes as $k => $listingsType ): ?>
                    <div data-v-if="active_tab == <?php echo esc_html( $listingsType->ID ); ?>"
                         data-v-bind_class="{'show active':active_tab == <?php echo esc_html( $listingsType->ID ); ?>}"
                         class="tab-pane fade active <?php if( is_admin() ) {
                             echo ( 0 == $k ) ? "show active" : " hidden";
                         } ?> ">
                        <?php if( is_admin() ) : ?>
                            <div class="row">
                                    <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12">
                                        <div class="inventory-serach-filter">
                                            <div class="container">
                                                <input type="text"
                                                       placeholder="<?php esc_attr_e( 'Search field', 'homepress' ); ?>"
                                                       class="inventory-text-field"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                        <a href="#" class="homepress-button homepress-button-full icon-left">
                                            <span class="button-icon property-icon-search"></span><?php esc_html_e( 'Search', 'homepress' ); ?>
                                        </a>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                        <div class="advanced-search-button">
                                            <span class="button-text"><?php esc_html_e( 'Advanced search', 'homepress' ); ?></span>
                                            <span class="button-icon property-icon-chevron-right"></span>
                                        </div>
                                    </div>
                            </div>
                            <?php else: ?>
                        <div class="row">

                            <?php foreach ( $listing_type_component as $key => $form ) :
                                $form_content_advanced = "";
                                $form_content = ""; ?>
                                <?php foreach ( $form as $index => $item ) : ?>
                                <?php

                                if( isset( $item[ 'label' ] ) AND $index != 0 ) {
                                    $item[ 'template' ] = '<div class="attr-title"><label>' . $item[ 'label' ] . '</label></div>' . $item[ 'template' ];
                                }

                                $class = "col-xl-12 col-lg-12 col-md-12 col-sm-12 advanced-search-item-col";

                                if( $item[ 'type' ] != "checkbox" )
                                    $class = "col-xl-4 col-lg-4 col-md-6 col-sm-12";

                                if( $index == 0 )
                                    $class = "col-xl-8 col-lg-8 col-md-6 col-sm-12";

                                if( $index == 0 ) {
                                    $form_content = '<div data-v-if="'. $listingsType->ID .' == ' . $key . '" class="' . $class . '">' . $item[ 'template' ] . '</div>';

                                    $form_content .= '<div data-v-if="'. $listingsType->ID .' == ' . $key . '" class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                        <a data-v-bind_href="listung_types[' . $listingsType->ID . '].url_params" class="homepress-button homepress-button-full icon-left" ><span class="button-icon property-icon-search"></span>' . __( "Search", "homepress" ) . '</a>
                                      </div>';

                                    $form_content .= '<div data-v-if="'. $listingsType->ID .' == ' . $key . '" class="col-xl-2 col-lg-2 col-md-3 col-sm-12">               
                                        <div class="advanced-search-button" 
                                            data-v-bind_class="{open:listung_types[' . $listingsType->ID . '].advanced_panel_show}"
                                            data-v-on_click="listung_types[' . $listingsType->ID . '].advanced_panel_show = !listung_types[' . $listingsType->ID . '].advanced_panel_show">
                                            <span class="button-text">' . __( "Advanced search", "homepress" ) . '</span>
                                            <span class="button-icon property-icon-chevron-right"></span>
                                        </div>
                                      </div>';
                                } else
                                    $form_content_advanced .= '<div class="' . $class . '">' . $item[ 'template' ] . '</div>';
                                ?>
                            <?php endforeach ?>

                                <?php echo html_entity_decode( $form_content ); ?>

                                <div class="advanced-search-item-wrap" data-v-if="<?php echo esc_attr( $listingsType->ID ); ?> == <?php echo esc_attr( $key ); ?> && listung_types[<?php echo esc_attr( $listingsType->ID ); ?>].advanced_panel_show">
                                    <div class="advanced-search-item">
                                        <div class="stm-row">
                                            <?php echo html_entity_decode( $form_content_advanced ); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </stm-search-form-type>
</div>

<?php
$data[ 'data' ] = $listing_type_data;
wp_add_inline_script( 'stm-search-form-type', " new VueW3CValid({ el: '#search_form_type_" . $id . "' }); new Vue({el:'#search_form_type_" . $id . "',data:{stm_search_form_type_data:json_parse('" . ulisting_convert_content( json_encode( $data ) ) . "')}}) " );
?>



