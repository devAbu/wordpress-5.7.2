<?php

use uListing\Classes\StmListingType;
use uListing\Classes\StmListingTemplate;

$id = rand( 10, 10000 ) . time();
$data = [];
$listing_type_data = [];
$listing_type_form = [];
$category_listing_type = [];
foreach ( $categories as $category ) {
    $data[ 'categories' ][ $category->term_id ] = [
        "id" => $category->term_id,
        "slug" => $category->slug,
        "url" => array(),
        "name" => $category->name,
        "types" => array(),
        "listing_types" => $category->getListingTypes(),
        "type_selected" => 0,
        "advanced_panel_show" => false,
    ];

    if( isset( $data[ 'categories' ][ $category->term_id ][ 'listing_types' ] ) AND $data[ 'categories' ][ $category->term_id ][ 'listing_types' ] ) {
        $category_listing_type = array_merge( $category_listing_type, $data[ 'categories' ][ $category->term_id ][ 'listing_types' ] );
    }

}
?>

<?php foreach ( $listingsTypes as $listingsType ): ?>
    <?php
    if( !in_array( $listingsType->ID, $category_listing_type ) )
        continue;
    $prefix = 'attribute.listing_type_' . $listingsType->ID;
    $listing_type_form[ $listingsType->ID ] = [];

    $data[ 'listung_type' ][ $listingsType->ID ] = array(
        "id" => $listingsType->ID,
        "name" => $listingsType->post_title,
        "url" => $listingsType->getPageUrl()
    );
    if( $search_fields = $listingsType->getSearchFields( StmListingType::SEARCH_FORM_CATEGORY, null, true ) ) {
        foreach ( $search_fields as $field ) {
            $field_type = key( $field );
            $field = current( $field );
            $field[ 'field_type' ] = $field_type;
            if( !isset( $field[ 'attribute_name' ] ) )
                $field[ 'attribute_name' ] = "";
            $data[ 'listung_type' ][ $listingsType->ID ][ 'fields_types' ][ $field[ 'attribute_name' ] ] = $field;

            if( $field[ 'field_type' ] == StmListingType::SEARCH_FORM_TYPE_SEARCH AND !empty( $field[ 'attribute_name' ] ) ) {
                $listing_type_data[ 'listing_type_' . $listingsType->ID ][ $field[ 'attribute_name' ] ] = '';
                $listing_type_form[ $listingsType->ID ][] = [
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
                $listing_type_form[ $listingsType->ID ][] = [
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
                $listing_type_form[ $listingsType->ID ][] = [
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
                $listing_type_form[ $listingsType->ID ][] = [
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
                $listing_type_data[ 'listing_type_' . $listingsType->ID ][ $field[ 'attribute_name' ] . "_items" ] = isset( $field[ 'items' ] ) ? $field[ 'items' ] : [];
                $listing_type_form[ $listingsType->ID ][] = [
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
                $listing_type_form[ $listingsType->ID ][] = [
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
                $listing_type_data[ 'listing_type_' . $listingsType->ID ][ $field[ 'attribute_name' ] . "_items" ] = isset( $field[ 'items' ] ) ? $field[ 'items' ] : [];
                $listing_type_form[ $listingsType->ID ][] = [
                    "label" => $field[ 'label' ],
                    "type" => $field[ 'type' ],
                    "template" => " " . StmListingTemplate::load_template( 'components/fields/' . $field[ 'type' ], array(
                            "model" => $prefix . ".{$field['attribute_name']}",
                            "order_by" => ( isset( $field[ 'order_by' ] ) ) ? "{$field['order_by']}" : '',
                            "order" => ( isset( $field[ 'order' ] ) ) ? "{$field['order']}" : '',
                            "callback_change" => "change",
                            "items" => $prefix . ".{$field['attribute_name']}_items",
                            "hide_empty" => ( isset( $field[ 'hide_empty' ] ) ) ? "{$field['hide_empty']}" : '',
                            "column" => isset($field[ 'column' ]) ? $field[ 'column' ] : 30,
                            "field" => $field,
                            "active_tab" => 'active_tab',
                        ) ) . ""
                ];
            }
        }
    }
    ?>
<?php endforeach; ?>

    <div id="stm_search_form_category_<?php echo esc_attr( $id ); ?>">
        <stm-search-form-category key="<?php echo esc_attr( $id ); ?>"
                                  :is_style_4="true"
                                  :stm_search_form_category_data="stm_search_form_category_data"
                                  :stm_search_form_category_texts="stm_search_form_category_text" inline-template>
            <div class="ulisting-search_box ulisting-search_box_<?php echo esc_attr( $params[ 'style' ] ); ?>">
                <div class="tab-content homepress_loading_preloader preloader_show">
                        <div class="preloader_text"><?php esc_html_e( 'Loading', 'homepress' ); ?></div>
                        <?php foreach ( $categories as $k => $category ) : ?>
                            <div data-v-if="active_tab == <?php echo esc_attr( $category->term_id ); ?>"
                                 class="tab-panel fade show active" <?php if( is_admin() ) {
                                echo ( 0 == $k ) ? "show active" : " hidden";
                            } ?>>
                                <div class="row">
                                    <?php if( is_admin() ) : ?>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                            <select>
                                                <option><?php esc_html_e( 'Listing type', 'homepress' ); ?></option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-lg-5 col-md-6 col-sm-12">
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
                                        <div class="col-xl-1 col-lg-2 col-md-12 col-sm-12">
                                            <div class="advanced-search-button">
                                                <span class="button-text"><?php esc_html_e( 'Advanced search', 'homepress' ); ?></span>
                                                <span class="button-icon property-icon-chevron-right"></span>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 nav nav-tabs">
                                            <?php $i = 0;
                                            foreach ( $categories as $category_ ): if( $i == 0 ) $data[ 'active_tab' ] = $category_->term_id; ?>
                                            <?php $i++; endforeach; ?>
                                            <ulisting-select2
                                                              data-v-bind_key="generateRandomId()"
                                                              data-v-bind_options='category_selected.categories'
                                                              data-v-on_input="set_active_tab"
                                                              data-v-model='category_selected.id'
                                                              theme='bootstrap4'>

                                            </ulisting-select2>
                                        </div>
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 listing-type-box">
                                            <ulisting-select2 data-v-bind_key="generateRandomId()"
                                                              data-v-bind_options='category_selected.types'
                                                              data-v-on_input="select_type"
                                                              data-v-model='category_selected.type_selected'
                                                              theme='bootstrap4'>

                                            </ulisting-select2>
                                        </div>

                                        <?php foreach ( $listing_type_form as $key => $form ) :
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
                                                $class = "col-xl-4 col-lg-4 col-md-4 col-sm-12";

                                            if( $index == 0 ) {
                                                $form_content_advanced = "";
                                                $form_content = "";

                                                $form_content = '<div data-v-on_input="searchAutoComplete(event)" data-v-on_click="searchAutoComplete(event)" data-v-if="category_selected.type_selected == ' . $key . '" class="' . $class . '">' . $item[ 'template' ] . '</div>';

                                                $form_content .= '<div data-v-if="category_selected.type_selected == ' . $key . '" class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                                                    <a data-v-bind_href="category_selected.url" class="homepress-button homepress-button-full icon-left" ><span class="search-button-icon property-icon-search"></span> ' . __( "Search", "homepress" ) . '</a>
                                                              </div>';

                                                $form_content .= '<div data-v-if="category_selected.type_selected == ' . $key . '" class="advanced-search-button col-xl-2 col-lg-2 col-md-2 col-sm-12" data-v-bind_class="{open:categories[' . $category->term_id . '].advanced_panel_show}"
                                                                     data-v-on_click="categories[' . $category->term_id . '].advanced_panel_show = !categories[' . $category->term_id . '].advanced_panel_show">
                                                                    <span class="button-text">' . __( "Advanced search", "homepress" ) . '</span> <span class="button-icon property-icon-chevron-right"></span>
                                                              </div>';

                                            } else
                                                $form_content_advanced .= '<div class="' . $class . '">' . $item[ 'template' ] . '</div>';
                                            ?>

                                        <?php endforeach ?>

                                            <?php echo html_entity_decode( $form_content ); ?>

                                            <div class="advanced-search-item-wrap"
                                                 data-v-if="category_selected.type_selected == <?php echo esc_attr( $key ); ?> && categories[<?php echo esc_attr( $category->term_id ); ?>].advanced_panel_show">
                                                <div class="advanced-search-item">
                                                    <div class="stm-row">
                                                        <?php echo html_entity_decode( $form_content_advanced ); ?>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>

            </div>
        </stm-search-form-category>
    </div>

<?php
$data[ 'data' ] = $listing_type_data;
wp_add_inline_script( 'stm-search-form-category', " new VueW3CValid({ el: '#stm_search_form_category_" . $id . "' }); new Vue({el:'#stm_search_form_category_" . $id . "',data:{stm_search_form_category_data:json_parse('" . ulisting_convert_content( json_encode( $data ) ) . "'), stm_search_form_category_text: " . json_encode( apply_filters( 'ulisting_search_form_category_text', [] ) ) . "}}) " );
?>