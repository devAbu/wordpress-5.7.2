<?php
/**
 * Attribute style template
 */
add_filter("ulisting_attribute_style_templates", function($styles){

    $styles["ulisting_style_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_1.jpg",
        "name" => "Style 1",
        "attribute_template" => "
            <div class='attribute_style attribute_style_1'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-value'>[attribute_value]</div>
                     <div class='attribute-name'>[attribute_name]</div>
                 </div>
            </div>
        ",
    ];

    $styles["ulisting_style_2"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_2.jpg",
        "name" => "Style 2",
        "attribute_template" => "
            <div class='attribute_style attribute_style_2'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-value'>[attribute_value]</div>
                     <div class='attribute-name'>[sub_title]</div>
                 </div>
             </div>
        ",
    ];

    $styles["ulisting_style_3"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_3.jpg",
        "name" => "Style 3",
        "attribute_template" => "
            <div class='attribute_style attribute_style_3'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-value'>[attribute_value]</div>
                 </div>
             </div>
        ",
    ];

    $styles["ulisting_style_4"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_4.jpg",
        "name" => "Style 4",
        "attribute_template" => "
            <div class='attribute_style attribute_style_4'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                    <div class='attribute-name'>[attribute_name]</div>
                     <div class='attribute-value'>[attribute_value]</div>
                 </div>
             </div>
        ",
    ];

    $styles["ulisting_style_5"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_5.jpg",
        "name" => "Style 5",
        "attribute_template" => "
            <div class='attribute_style attribute_style_5'>
                <h5>[attribute_name]</h5> 
                <ul> [option_items]</ul>
            </div>
        ",
        "option_template" => "<li>[attribute_value]</li>",
    ];

    $styles["ulisting_style_6"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_6.jpg",
        "name" => "Style 6",
        "attribute_template" => "
            <div class='attribute_style attribute_style_6'>
                <div> [option_items]</div>
            </div>
        ",
        "option_template" => "<span>[attribute_value]</span>",
    ];

    $styles["ulisting_style_7"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_7.jpg",
        "name" => "Style 7",
        "attribute_template" => "
            <div class='attribute_style attribute_style_7'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-value'>[attribute_value]</div>
                     <div class='attribute-name'>[attribute_name]</div>
                 </div>
            </div>
        ",
    ];

    $styles["ulisting_style_8"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_8.jpg",
        "name" => "Style 8",
        "attribute_template" => "
            <div class='attribute_style attribute_style_8'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-value'>[attribute_value]</div>
                     <div class='attribute-name'>[sub_title]</div>
                 </div>
             </div>
        ",
    ];

    $styles["ulisting_style_9"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_9.jpg",
        "name" => "Style 9",
        "attribute_template" => "
            <div class='attribute_style attribute_style_9'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-value'>[attribute_value]</div>
                 </div>
             </div>
        ",
    ];

    $styles["ulisting_style_10"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_10.jpg",
        "name" => "Style 10",
        "attribute_template" => "
            <div class='attribute_style attribute_style_10'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                    <div class='attribute-name'>[attribute_name]</div>
                    <div class='attribute-value'>[attribute_value]</div>
                    <div class='attribute-title'>[sub_title]</div>
                 </div>
             </div>
        ",
    ];

    $styles["ulisting_style_11"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_11.jpg",
        "name" => "Style 11",
        "attribute_template" => "
            <div class='attribute_style attribute_style_11'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-name'>[attribute_name]</div>
                    <div class='attribute-value'>[attribute_value]</div>
                    <div class='attribute-title'>[sub_title]</div>
                 </div>
            </div>
        ",
    ];

    $styles["ulisting_style_12"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_12.jpg",
        "name" => "Style 12",
        "attribute_template" => "
            <div class='attribute_style attribute_style_12'>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-name'>[attribute_name]</div>
                    <div class='attribute-value'>[attribute_value]</div>
                    <div class='attribute-title'>[sub_title]</div>
                 </div>
            </div>
        ",
    ];

    return $styles;
});

/**
 * Attribute price style template
 */
add_filter("ulisting_attribute_price_style_templates", function($styles){

    $styles["ulisting_style_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/price/price_style_1.jpg",
        "name" => "Style 1",
        "attribute_template" => "[old_price] [price]",
        "price_template" => "<div class='genuine_sale'>[price][suffix]</div>",
        "old_price_template" => "<div class='genuine_price has_sale'><span class='genuine_suffix'>[old_price][suffix]</span></div>",
    ];

    $styles["ulisting_style_2"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/price/price_style_2.jpg",
        "name" => "Style 2",
        "attribute_template" => "[old_price] [price]",
        "price_template" => "<div class='genuine_sale'>[price][suffix]</div>",
        "old_price_template" => "<div class='genuine_price has_sale'><span class='genuine_suffix'>[old_price][suffix]</span></div>",
    ];

    $styles["ulisting_style_3"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/price/price_style_3.jpg",
        "name" => "Style 3",
        "attribute_template" => "<div class='price-title'>[attribute_name]:</div> [old_price] [price]",
        "price_template" => "<div class='genuine_sale'>[price][suffix]</div>",
        "old_price_template" => "<div class='genuine_price has_sale'><span class='genuine_suffix'>[old_price][suffix]</span></div>",

    ];

    $styles["ulisting_style_4"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/price/price_style_4.jpg",
        "name" => "Style 4",
        "attribute_template" => "[price] [old_price]",
        "price_template" => "<div class='genuine_sale'>[price][suffix]</div>",
        "old_price_template" => "<div class='genuine_price has_sale'><span class='genuine_suffix'>[old_price][suffix]</span></div>",

    ];

    return $styles;
});

/**
 * Attribute price style template
 */
add_filter("ulisting_quickview_style_templates", function($styles){

    $styles["style_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/quick_view/quick_view_style_1.jpg",
        "name" => "Style 1",
    ];
    $styles["style_2"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/quick_view/quick_view_style_2.jpg",
        "name" => "Style 2",
    ];
    $styles["style_3"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/quick_view/quick_view_style_3.jpg",
        "name" => "Style 3",
    ];

    return $styles;
});

add_filter("ulisting_loop_wishlist_template", function($styles){

    $styles["template_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/wishlist/wishlist_style_1.jpg",
        "name" => "Style 1",
        "template" => '<span data-wishlist_id="[id]" onclick="[click]"  class="ulisting-listing-wishlist stm-cursor-pointer [class]"> <span class="property-icon-heart-outline simple-icon"></span><span class="property-icon-heart-solid active_wishlist"></span></span> <span class="ulisting-listing-wishlist [class_load] hidden"><span class="property-icon-heart-solid simple-icon"></span></span> ',
    ];

    return $styles;
});

/**
 * Gallery style template
 */
add_filter("ulisting_attribute_gallery_style_templates", function($styles){

    $styles["ulisting_gallery_style_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/gallery/gallery_style_1.jpg",
        "name" => "Style 1",
    ];

    $styles["ulisting_gallery_style_2"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/gallery/gallery_style_2.jpg",
        "name" => "Style 2",
    ];

    $styles["ulisting_gallery_style_3"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/gallery/gallery_style_3.jpg",
        "name" => "Style 3",
    ];

    $styles["ulisting_gallery_style_4"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/gallery/gallery_style_4.jpg",
        "name" => "Style 4",
    ];

    $styles["ulisting_gallery_style_5"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/gallery/gallery_style_5.jpg",
        "name" => "Style 5",
    ];

    $styles["ulisting_gallery_style_6"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/gallery/gallery_style_6.jpg",
        "name" => "Style 6",
    ];

    $styles["ulisting_gallery_style_7"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/gallery/gallery_style_7.jpg",
        "name" => "Style 7",
    ];

    return $styles;
});

/**
 * File style template
 */
add_filter("ulisting_file_block_style_templates", function($styles){

    $styles["ulisting_style_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/file/file_style_1.jpg",
        "name" => "Style 1",
        "attribute_template" => "<a class='homepress-button' href='[attribute_value]' download>[attribute_name]</a>",
    ];

    return $styles;
});

/**
 * Yes No style template
 */
add_filter("ulisting_yes_no_block_style_templates", function($styles){
    $styles = [];

    $styles["ulisting_style_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_9.jpg",
        "name" => "Style 1",
        "attribute_template" => "
            <div class='attribute_style attribute_style_yes_no'>
                <div class='attribute-icon'>[attribute_icon]</div> 
                <div class='attribute-parts-wrap'>[attribute_name] - [attribute_value]</div>
             </div>
        ",
    ];

    return $styles;
});

/**
 * Date and Time style template
 */
add_filter("ulisting_extra_block_style_templates", function($styles){
    $styles = [];

    $styles["ulisting_style_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_9.jpg",
        "name" => "Style 1",
        "attribute_template" => "
            <div class='attribute_style attribute_style_date_time'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-value'>[attribute_value]</div>
                 </div>
             </div>
        ",
    ];

    $styles["ulisting_style_2"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_6.jpg",
        "name" => "Style 2",
        "attribute_template" => "
            <div class='attribute_style attribute_style_6'>
                <div class='attribute-value'>[attribute_value]</div>
            </div>
        ",
        "option_template" => "[attribute_value]",
    ];

    return $styles;
});

/**
 * Input style template
 */
add_filter("ulisting_input_block_style_templates", function($styles){

    $styles["ulisting_style_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_1.jpg",
        "name" => "Style 1",
        "attribute_template" => "
            <div class='attribute_style attribute_style_1'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-value'>[attribute_value]</div>
                     <div class='attribute-name'>[attribute_name]</div>
                 </div>
            </div>
        ",
    ];
    $styles["ulisting_style_2"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_2.jpg",
        "name" => "Style 2",
        "attribute_template" => "
            <div class='attribute_style attribute_style_2'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-value'>[attribute_value]</div>
                     <div class='attribute-name'>[sub_title]</div>
                 </div>
             </div>
        ",
    ];

    $styles["ulisting_style_3"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_3.jpg",
        "name" => "Style 3",
        "attribute_template" => "
            <div class='attribute_style attribute_style_3'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-value'>[attribute_value]</div>
                 </div>
             </div>
        ",
    ];

    $styles["ulisting_style_4"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_4.jpg",
        "name" => "Style 4",
        "attribute_template" => "
            <div class='attribute_style attribute_style_4'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                    <div class='attribute-name'>[attribute_name]</div>
                     <div class='attribute-value'>[attribute_value]</div>
                 </div>
             </div>
        ",
    ];

    $styles["ulisting_style_5"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_5.jpg",
        "name" => "Style 5",
        "attribute_template" => "
            <div class='attribute_style attribute_style_5'>
                <h5>[attribute_name]</h5> 
                <ul> [option_items]</ul>
            </div>
        ",
        "option_template" => "<li>[attribute_value]</li>",
    ];

    $styles["ulisting_style_6"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_6.jpg",
        "name" => "Style 6",
        "attribute_template" => "
            <div class='attribute_style attribute_style_6'>
                <div> [option_items]</div>
            </div>
        ",
        "option_template" => "<span>[attribute_value]</span>",
    ];

    $styles["ulisting_style_7"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_7.jpg",
        "name" => "Style 7",
        "attribute_template" => "
            <div class='attribute_style attribute_style_7'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-value'>[attribute_value]</div>
                     <div class='attribute-name'>[attribute_name]</div>
                 </div>
            </div>
        ",
    ];

    $styles["ulisting_style_8"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_8.jpg",
        "name" => "Style 8",
        "attribute_template" => "
            <div class='attribute_style attribute_style_8'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-value'>[attribute_value]</div>
                     <div class='attribute-name'>[sub_title]</div>
                 </div>
             </div>
        ",
    ];

    $styles["ulisting_style_9"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_9.jpg",
        "name" => "Style 9",
        "attribute_template" => "
            <div class='attribute_style attribute_style_9'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-value'>[attribute_value]</div>
                 </div>
             </div>
        ",
    ];

    $styles["ulisting_style_10"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_10.jpg",
        "name" => "Style 10",
        "attribute_template" => "
            <div class='attribute_style attribute_style_10'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                    <div class='attribute-name'>[attribute_name]</div>
                    <div class='attribute-value'>[attribute_value]</div>
                    <div class='attribute-title'>[sub_title]</div>
                 </div>
             </div>
        ",
    ];

    $styles["ulisting_style_11"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_11.jpg",
        "name" => "Style 11",
        "attribute_template" => "
            <div class='attribute_style attribute_style_11'>
                <div class='attribute-icon'>[attribute_icon]</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-name'>[attribute_name]</div>
                    <div class='attribute-value'>[attribute_value]</div>
                    <div class='attribute-title'>[sub_title]</div>
                 </div>
            </div>
        ",
    ];

    $styles["ulisting_style_12"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/attributes/attribute_style_12.jpg",
        "name" => "Style 12",
        "attribute_template" => "
            <div class='attribute_style attribute_style_12'>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-name'>[attribute_name]</div>
                    <div class='attribute-value'>[attribute_value]</div>
                    <div class='attribute-title'>[sub_title]</div>
                 </div>
            </div>
        ",
    ];

    return $styles;
});

/**
 * Inventory Map style template
 */
add_filter("ulisting_inventory_map_template", function($styles){

    $styles["template_1"] = [
        "icon" => get_template_directory_uri()."/assets/ulisting/gallery_style_1.jpg",
        "name" => "Style 1",
        "template" => "[map_panel]",
        "template_inner" => "[map]",
    ];

    $styles["template_2"] = [
        "icon" => get_template_directory_uri()."/assets/ulisting/gallery_style_1.jpg",
        "name" => "Full height",
        "template" => "<div class='map-full-height-panel'>[map_panel]</div>",
        "template_inner" => "[map]",
    ];

    return $styles;
});

/**
 * Inventory sort template
 */
add_filter("ulisting_inventory_sort_template", function($styles){

    $styles["template_1"] = [
        "icon" => get_template_directory_uri()."/assets/ulisting/gallery_style_1.jpg",
        "name" => "Style 1",
        "template" => "<div class='inventory-sort_style_1 homepress_sort_preloader preloader_show'>[sort_panel]</div>",
        "template_inner" => "[list] [select]",
    ];

    return $styles;
});

/**
 * Inventory switch template
 */
add_filter("ulisting_inventory_column_switch_template", function($styles){

    $styles["template_1"] = [
        "icon" => get_template_directory_uri()."/assets/ulisting/gallery_style_1.jpg",
        "name" => "Style 1",
        "template" => "<div class='stm-item-preview-type-switch type-switch_style_1'>[column_switch_panel]</div>",
        "template_inner" => "[button_switch]",
    ];

    return $styles;
});

/**
 * Inventory pagination template
 */
add_filter("ulisting_inventory_pagination_template", function($styles){

    $styles["template_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/pagination/pagination_style_1.jpg",
        "name" => "Style 1",
        "template" => "<div class='stm-listing-pagination_style_1'>[pagination_panel]</div>",
        "template_inner" => "[pagination]",
    ];

    $styles["template_2"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/pagination/pagination_style_2.jpg",
        "name" => "Style 2",
        "template" => "<div class='stm-listing-pagination_style_2'>[pagination_panel]</div>",
        "template_inner" => "[pagination]",
    ];

    return $styles;
});

/**
 * Inventory list template
 */
add_filter("ulisting_inventory_list_template", function($styles){

    $styles["template_1"] = [
        "icon" => get_template_directory_uri()."/assets/ulisting/gallery_style_1.jpg",
        "name" => "Style 1",
        "template" => "[list_panel]",
        "template_inner" => " <div class='stm-row'>[feature_list][listing_list]</div>[no_list]",
    ];
    return $styles;
});

/**
 * Inventory thumbnail template
 */
add_filter("ulisting_loop_thumbnail_box_template", function($styles){

    $styles["template_1"] = [
        "icon" => get_template_directory_uri()."/assets/ulisting/gallery_style_1.jpg",
        "name" => "Style 1",
        "template" => "<div class='inventory-thumbnail-box inventory-thumbnail-box_style_1' data-id='[id]'>[thumbnail_panel]</div>",
        "template_inner" => "<div class='thumbnail_box_top'>[thumbnail_top]</div> <div class='thumbnail_box_bottom'>[thumbnail_bottom]</div>",
    ];
    return $styles;
});

/**
 * Inventory category template
 */
add_filter("ulisting_loop_category_template", function($styles){

    $styles["template_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/category/category_style_1.jpg",
        "name" => "Style 1",
        "template" => "<div class='inventory_category inventory_category_style_1'>[category]</div>",
    ];
    return $styles;
});

/**
 * Inventory compare template
 */
add_filter("ulisting_loop_compare_template", function($styles, $params){

    $listing_id = (isset($params['listing_id'])) ? $params['listing_id'] : 0;
    $active = (isset($params['active'])) ? $params['active'] : "";

    $styles["template_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/compare/compare_style_1.jpg",
        "name" => "Style 1",
        "template" => "<div data-compare_id='".$listing_id."' id='ulisting_listing_compare_".$listing_id."' class='ulisting-listing-compare inventory_compare ulisting_listing_compare_". $listing_id ."' onclick='add_listing_compare_via_class(".$listing_id.")'><span class='simple-icon property-icon-home-plus'></span></div>",
    ];
    return $styles;
},10,2);

/**
 * Inventory loop grid template
 */
add_filter("ulisting_loop_grid_template", function($styles){
    $styles = [];

    $styles["inventory-loop-grid_style_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/item_preview/grid_style_1.jpg",
        "name" => "Style 1",
    ];

    $styles["inventory-loop-grid_style_2"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/item_preview/grid_style_2.jpg",
        "name" => "Style 2",
    ];

    $styles["inventory-loop-grid_style_3"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/item_preview/grid_style_3.jpg",
        "name" => "Style 3",
    ];

    $styles["inventory-loop-grid_style_4"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/item_preview/grid_style_4.jpg",
        "name" => "Style 4",
    ];

    $styles["inventory-loop-grid_style_5"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/item_preview/grid_style_5.jpg",
        "name" => "Style 5",
    ];

    return $styles;
});

/**
 * Inventory loop list template
 */
add_filter("ulisting_loop_list_template", function($styles){
    $styles = [];

    $styles["inventory-loop-list_style_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/item_preview/list_style_1.jpg",
        "name" => "Style 1",
    ];

    $styles["inventory-loop-list_style_2"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/item_preview/list_style_2.jpg",
        "name" => "Style 2",
    ];
    return $styles;
});

/**
 * Inventory map list template
 */
add_filter("ulisting_loop_map_template", function($styles){
    $styles = [];

    $styles["inventory-loop-map_style_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/map/map_style_1.jpg",
        "name" => "Style 1",
    ];

    $styles["inventory-loop-map_style_2"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/map/map_style_2.jpg",
        "name" => "Style 2",
    ];

    return $styles;
});


/**
 * Inventory filter template
 */
add_filter("ulisting_inventory_filter_template", function($styles){

    $styles["template_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/filter/filter_1.jpg",
        "name" => "Style 1",
        "template" => "<div class='inventory-filter_box_wrap'><div class='inventory-filter_box inventory-filter_style_1'>[filter_panel]</div></div>",
        "template_inner" => "[filter]",
        "template_field" => "<div class='inventory-filter_attribute_box'><div class='inventory-filter_attribute'>[field]</div></div>",
    ];

    $styles["template_2"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/filter/filter_2.jpg",
        "name" => "Style 2",
        "template" => "<div class='inventory-filter_box_wrap'><div class='inventory-filter_box inventory-filter_style_2'>[filter_panel]</div></div>",
        "template_inner" => "[filter]",
        "template_field" => "<div class='inventory-filter_attribute_box'><div class='inventory-filter_attribute'>[field]</div></div>",
    ];

    $styles["template_3"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/filter/filter_3.jpg",
        "name" => "Style 3",
        "template" => "<div class='inventory-filter_box_wrap'><div class='inventory-filter_box inventory-filter_style_3'>[filter_panel]</div></div>",
        "template_inner" => "[filter]",
        "template_field" => "<div class='inventory-filter_attribute_box'><div class='inventory-filter_attribute'>[field]</div></div>",
    ];

    $styles["template_4"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/filter/filter_4.jpg",
        "name" => "Style 4",
        "template" => "<div class='inventory-filter_box_wrap'><div class='inventory-filter_box inventory-filter_style_4'>[filter_panel]</div></div>",
        "template_inner" => "[filter]",
        "template_field" => "<div class='inventory-filter_attribute_box'><div class='inventory-filter_attribute'>[field]</div></div>",
    ];

    $styles["template_5"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/filter/filter_5.jpg",
        "name" => "Style 5",
        "template" => "<div class='inventory-filter_box_wrap'><div class='inventory-filter_box inventory-filter_style_5'><div class='inventory-filter_box-inner'><div class='filter_button' onclick='document.getElementsByClassName(\"inventory-filter_style_5\")[0].classList.toggle(\"filter-hide\");'></div><div class='inventory-filter_box-inner-info'>[filter_panel]</div></div></div></div>",
        "template_inner" => "[filter]",
        "template_field" => "<div class='inventory-filter_attribute_box'><div class='inventory-filter_attribute'>[field]</div></div>",
    ];

    $styles["template_6"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/filter/filter_6.jpg",
        "name" => "Style 6",
        "template" => "<div class='inventory-filter_box_wrap'><div class='inventory-filter_box inventory-filter_style_6'>[filter_panel]</div></div>",
        "template_inner" => "[filter]",
        "template_field" => "<div class='inventory-filter_attribute_box'><div class='inventory-filter_attribute'>[field]</div></div>",
    ];

    return $styles;
});


//Inventory filter templates
function homepress_ulisting_hook($tempate){

    if( $tempate == "template_1" ) {
        //Template style
        add_filter( "stm-field-default-before", function( $data ) {
            if(!is_array($data))
                return $data;
            $content = "<span class='drop-box-label'>   {{ get_active_options(" . $data[ 'model' ] . ", '" . $data[ "field" ][ 'attribute_name' ] . "') }}  " . $data[ 'field' ][ 'label' ] . " ";
            $content .= "<span data-v-on_click=\"field_show['" . $data[ 'field' ][ 'attribute_name' ] . "'] = !field_show['" . $data[ 'field' ][ 'attribute_name' ] . "'] \" class=\"mobile-filter-button\"><span class='property-icon-chevron-down'></span></span></span>";
            $content .= "<div data-v-if=field_show['" . $data[ 'field' ][ 'attribute_name' ] . "'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        } );

        add_filter( "stm-field-default-after", function( $data ) {
            $content = "</div></div>";
            return $content;
        } );

        //Range
        add_filter( "stm-field-range-before", function( $data ) {
            if(!is_array($data))
                return $data;
            $content = "<span class='drop-box-label'>" . $data[ 'field' ][ 'label' ] . ": ";
            $content .= $data[ 'prefix' ] . "{{" . $data[ 'model' ] . "[0]}} - " . $data[ 'prefix' ] . "{{" . $data[ 'model' ] . "[1]}}" . "<span data-v-on_click=\"field_show['" . $data[ 'field' ][ 'attribute_name' ] . "'] = !field_show['" . $data[ 'field' ][ 'attribute_name' ] . "'] \" class=\"mobile-filter-button\"><span class='property-icon-chevron-down'></span></span></span>";
            $content .= "<div data-v-if=field_show['" . $data[ 'field' ][ 'attribute_name' ] . "'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        } );
        add_filter( "stm-field-range-after", function( $data ) {
            $content = "</div></div>";
            return $content;
        } );

        //Proximity
        add_filter( "stm-field-proximity-before", function( $data ) {
            if(!is_array($data))
                return $data;

            $units = isset($data['field']['units']) ? $data['field']['units'] : 'km';
            $content = "<span class='drop-box-label'>" . $data[ 'field' ][ 'label' ] . ": ";
            $content .= $data['field']['min'] . " - {{".$data['model']. "}} " . $units  . "<span data-v-on_click=\"field_show['" . $data[ 'field' ][ 'attribute_name' ] . "'] = !field_show['" . $data[ 'field' ][ 'attribute_name' ] . "'] \" class=\"mobile-filter-button\"><span class='property-icon-chevron-down'></span></span></span>";
            $content .= "<div data-v-if=field_show['" . $data[ 'field' ][ 'attribute_name' ] . "'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        } );
        add_filter( "stm-field-proximity-after", function( $data ) {
            $content = "</div></div>";
            return $content;
        } );

    }

    if($tempate == "template_2"){
        //Template style
        add_filter("stm-field-default-before", function($data){
            if(!is_array($data))
                return $data;
            $content = "<span class='drop-box-label'>" . $data['field']['label'] . " ";
            $content .= "" . "<span data-v-on_click=\"switch_field('".$data['field']['attribute_name']."')\" class=\"mobile-filter-button\"><span class='property-icon-chevron-down'></span></span></span>";
            $content .= "<div data-v-if=!field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });

        add_filter("stm-field-default-after", function($data){
            $content ="</div></div>";
            return $content;
        });

        //Dropdown
        add_filter("stm-field-dropdown-default-before", function($data){
            $content ="<div data-v-on_click=\"switch_field(false)\" >";
            return $content;
        });

        add_filter("stm-field-dropdown-default-after", function($data){
            $content ="</div>";
            return $content;
        });

        //Range
        add_filter("stm-field-range-before", function($data){
            if(!is_array($data))
                return $data;
            $content = "<span class='drop-box-label'>" . $data['field']['label'] . ": ";
            $content .= $data['prefix']."{{".$data['model']."[0]}} - ".$data['prefix']."{{".$data['model']."[1]}}" . "<span data-v-on_click=\"switch_field('".$data['field']['attribute_name']."')\" class=\"mobile-filter-button\"><span class='property-icon-chevron-down'></span></span></span>";
            $content .= "<div data-v-if=!field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });
        add_filter("stm-field-range-after", function($data){
            $content ="</div></div>";
            return $content;
        });

        //Proximity
        add_filter("stm-field-proximity-before", function($data){
            if(!is_array($data))
                return $data;
            $units = isset($data['field']['units']) ? $data['field']['units'] : 'km';
            $content = "<span class='drop-box-label'>" . $data['field']['label'] . ": ";
            $content .= $data['field']['min'] . " - {{".$data['model']." }} " . $units . "<span data-v-on_click=\"switch_field('".$data['field']['attribute_name']."')\" class=\"mobile-filter-button\"><span class='property-icon-chevron-down'></span></span></span>";
            $content .= "<div data-v-if=!field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });

        add_filter("stm-field-proximity-after", function($data){
            $content ="</div></div>";
            return $content;
        });
    }

    if($tempate == "template_3"){
        //Template style
        add_filter("stm-field-default-before", function($data){
            if(!is_array($data))
                return $data;
            $content = "<div v-bind:class=\"{filter_enabled:!field_show['".$data['field']['attribute_name']."']}\" class='drop-box-label'><div data-v-on_click=\"field_show['".$data['field']['attribute_name']."'] = !field_show['".$data['field']['attribute_name']."'] \" class='drop-box-label-item'>" . $data['field']['label'] . "";
            $content .= "<span class='mobile-filter-button'></span></div></div>";
            $content .= "<div data-v-if=field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });
        add_filter("stm-field-default-after", function($data){
            $content ="</div></div>";
            return $content;
        });

        //Range
        add_filter("stm-field-range-before", function($data){
            if(!is_array($data))
                return $data;
            $content = "<div v-bind:class=\"{filter_enabled:!field_show['".$data['field']['attribute_name']."']}\" class='drop-box-label'><div data-v-on_click=\"field_show['".$data['field']['attribute_name']."'] = !field_show['".$data['field']['attribute_name']."'] \" class='drop-box-label-item'>" . $data['field']['label'] . "";
            $content .= "<span class='mobile-filter-button'></span></div></div>";
            $content .= "<div data-v-if=field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });
        add_filter("stm-field-range-after", function($data){
            $content ="</div></div>";
            return $content;
        });

        //Dropdown
        add_filter("stm-field-dropdown-before", function($data){
            if(!is_array($data))
                return $data;
            $content = "<div v-bind:class=\"{filter_enabled:!field_show['".$data['field']['attribute_name']."']}\" class='drop-box-label'><div data-v-on_click=\"field_show['".$data['field']['attribute_name']."'] = !field_show['".$data['field']['attribute_name']."'] \" class='drop-box-label-item'>" . $data['field']['label'] . "";
            $content .= "<span class='mobile-filter-button'></span></div></div>";
            $content .= "<div data-v-if=field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });
        add_filter("stm-field-dropdown-after", function($data){
            $content ="</div></div>";
            return $content;
        });

        //Location
        add_filter("stm-field-location-before", function($data){
            if(!is_array($data))
                return $data;
            $content = "<div v-bind:class=\"{filter_enabled:!field_show['".$data['field']['attribute_name']."']}\" class='drop-box-label'><div data-v-on_click=\"field_show['".$data['field']['attribute_name']."'] = !field_show['".$data['field']['attribute_name']."'] \" class='drop-box-label-item'>" . $data['field']['label'] . "";
            $content .= "<span class='mobile-filter-button'></span></div></div>";
            $content .= "<div data-v-if=field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });
        add_filter("stm-field-location-after", function($data){
            $content ="</div></div>";
            return $content;
        });

        //Proximity
        add_filter( "stm-field-proximity-before", function( $data ) {
            if(!is_array($data))
                return $data;
            $content = "<div v-bind:class=\"{filter_enabled:!field_show['".$data['field']['attribute_name']."']}\" class='drop-box-label'><div data-v-on_click=\"field_show['".$data['field']['attribute_name']."'] = !field_show['".$data['field']['attribute_name']."'] \" class='drop-box-label-item'>" . $data['field']['label'] . "";
            $content .= "<span class='mobile-filter-button'></span></div></div>";
            $content .= "<div data-v-if=field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });
        add_filter( "stm-field-proximity-after", function( $data ) {
            $content = "</div></div>";
            return $content;
        } );
    }

    if($tempate == "template_4"){
        //Template style
        add_filter("stm-field-default-before", function($data){
            if(!is_array($data))
                return $data;
            $content = "<div v-bind:class=\"{filter_enabled:!field_show['".$data['field']['attribute_name']."']}\" class='drop-box-label'><div data-v-on_click=\"field_show['".$data['field']['attribute_name']."'] = !field_show['".$data['field']['attribute_name']."'] \" class='drop-box-label-item'>" . $data['field']['label'] . "";
            $content .= "<span class='mobile-filter-button'><span class='property-icon-chevron-down'></span></span></div></div>";
            $content .= "<div data-v-if=field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });
        add_filter("stm-field-default-after", function($data){
            $content ="</div></div>";
            return $content;
        });

        //Range
        add_filter("stm-field-range-before", function($data){
            if(!is_array($data))
                return $data;
            $content = "<div v-bind:class=\"{filter_enabled:!field_show['".$data['field']['attribute_name']."']}\" class='drop-box-label'><div data-v-on_click=\"field_show['".$data['field']['attribute_name']."'] = !field_show['".$data['field']['attribute_name']."'] \" class='drop-box-label-item'>" . $data['field']['label'] . "";
            $content .= "<span class='mobile-filter-button'><span class='property-icon-chevron-down'></span></span></div></div>";
            $content .= "<div data-v-if=field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });
        add_filter("stm-field-range-after", function($data){
            $content ="</div></div>";
            return $content;
        });

    }

    if($tempate == "template_5"){
        //Template style
        add_filter("stm-field-default-before", function($data){
            if(!is_array($data))
                return $data;
            $content = "<div v-bind:class=\"{filter_enabled:!field_show['".$data['field']['attribute_name']."']}\" class='drop-box-label'><div data-v-on_click=\"field_show['".$data['field']['attribute_name']."'] = !field_show['".$data['field']['attribute_name']."'] \" class='drop-box-label-item'>" . $data['field']['label'] . "";
            $content .= "<span class='mobile-filter-button'></span></div></div>";
            $content .= "<div data-v-if=!field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });
        add_filter("stm-field-default-after", function($data){
            $content ="</div></div>";
            return $content;
        });

        //Range
        add_filter("stm-field-range-before", function($data){
            if(!is_array($data))
                return $data;
            $content = "<div v-bind:class=\"{filter_enabled:!field_show['".$data['field']['attribute_name']."']}\" class='drop-box-label'><div data-v-on_click=\"field_show['".$data['field']['attribute_name']."'] = !field_show['".$data['field']['attribute_name']."'] \" class='drop-box-label-item'>" . $data['field']['label'] . "";
            $content .= "<span class='mobile-filter-button'></span></div></div>";
            $content .= "<div data-v-if=!field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });
        add_filter("stm-field-range-after", function($data){
            $content ="</div></div>";
            return $content;
        });

        //Dropdown
        add_filter("stm-field-dropdown-before", function($data){
            if(!is_array($data))
                return $data;
            $content = "<div v-bind:class=\"{filter_enabled:!field_show['".$data['field']['attribute_name']."']}\" class='drop-box-label'><div data-v-on_click=\"field_show['".$data['field']['attribute_name']."'] = !field_show['".$data['field']['attribute_name']."'] \" class='drop-box-label-item'>" . $data['field']['label'] . "";
            $content .= "<span class='mobile-filter-button'></span></div></div>";
            $content .= "<div data-v-if=!field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });
        add_filter("stm-field-dropdown-after", function($data){
            $content ="</div></div>";
            return $content;
        });

        //Proximity
        add_filter("stm-field-proximity-before", function($data){
            if(!is_array($data))
                return $data;
            $content = "<div v-bind:class=\"{filter_enabled:!field_show['".$data['field']['attribute_name']."']}\" class='drop-box-label'><div data-v-on_click=\"field_show['".$data['field']['attribute_name']."'] = !field_show['".$data['field']['attribute_name']."'] \" class='drop-box-label-item'>" . $data['field']['label'] . "";
            $content .= "<span class='mobile-filter-button'></span></div></div>";
            $content .= "<div data-v-if=!field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });
        add_filter("stm-field-proximity-after", function($data){
            $content ="</div></div>";
            return $content;
        });
    }

    if($tempate == "template_6"){
        //Template style
        add_filter( "stm-field-default-before", function( $data ) {
            if(!is_array($data))
                return $data;
            $content = "<span class='drop-box-label'>   {{ get_active_options(" . $data[ 'model' ] . ", '" . $data[ "field" ][ 'attribute_name' ] . "') }}  " . $data[ 'field' ][ 'label' ] . " ";
            $content .= "<span data-v-on_click=\"field_show['" . $data[ 'field' ][ 'attribute_name' ] . "'] = !field_show['" . $data[ 'field' ][ 'attribute_name' ] . "'] \" class=\"mobile-filter-button\"><span class='property-icon-chevron-down'></span></span></span>";
            $content .= "<div data-v-if=field_show['" . $data[ 'field' ][ 'attribute_name' ] . "'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        } );

        add_filter( "stm-field-default-after", function( $data ) {
            $content = "</div></div>";
            return $content;
        } );

        //Range
        add_filter("stm-field-range-before", function($data){
            if(!is_array($data))
                return $data;
            $content = "<span class='drop-box-label'>" . $data['field']['label'] . " ";
            $content.= $data['prefix']."{{".$data['model']."[0]}} - ".$data['prefix']."{{".$data['model']."[1]}}" . "<span data-v-on_click=\"field_show['".$data['field']['attribute_name']."'] = !field_show['".$data['field']['attribute_name']."'] \" class=\"mobile-filter-button\"><span class='property-icon-chevron-down'></span></span></span>";
            $content.= "<div data-v-if=field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });
        add_filter("stm-field-range-after", function($data){
            $content ="</div></div>";
            return $content;
        });

        //Proximity
        add_filter("stm-field-proximity-before", function($data){
            if(!is_array($data))
                return $data;
            $units = isset($data['field']['units']) ? $data['field']['units'] : 'km';
            $content = "<span class='drop-box-label'>" . $data['field']['label'] . " ";
            $content.= $data['field']['min'] . " - {{".$data['model']." }} " . $units . "<span data-v-on_click=\"field_show['".$data['field']['attribute_name']."'] = !field_show['".$data['field']['attribute_name']."'] \" class=\"mobile-filter-button\"><span class='property-icon-chevron-down'></span></span></span>";
            $content.= "<div data-v-if=field_show['".$data['field']['attribute_name']."'] class='inventory-filter-attr-drop'><div class='drop-box'>";
            return $content;
        });
        add_filter("stm-field-proximity-after", function($data){
            $content ="</div></div>";
            return $content;
        });
    }

}

add_action( 'stm_render_filter', 'homepress_ulisting_hook', 10, 1 );

/**
 * Inventory title template
 */
add_filter("ulisting_inventory_title_template", function($styles){

    $styles["template_1"] = [
        "icon" => get_template_directory_uri()."/assets/ulisting/gallery_style_1.jpg",
        "name" => "H2",
        "template" => "<div class='inventory-title_style_1'>[title_panel]</div>",
        "template_inner" => "<h2>[title]</h2>",
    ];

    $styles["template_2"] = [
        "icon" => get_template_directory_uri()."/assets/ulisting/gallery_style_1.jpg",
        "name" => "Style 2",
        "template" => "<div class='inventory-title_style_1'>[title_panel]</div>",
        "template_inner" => "[title]",
    ];

    return $styles;
});

/**
 * Homepress icons set
 */
add_filter("ulisting_icons", function ($icons){
    $icons["homepress"] = [
        "name" => "Homepress",
        "icons" => [
            [
                "name" => "Beds",
                "class" => "property-icon-bed",
            ],
            [
                "name" => "Bath",
                "class" => "property-icon-bath",
            ],
            [
                "name" => "Garage",
                "class" => "property-icon-garage",
            ],
            [
                "name" => "Sqft",
                "class" => "property-icon-sqft",
            ],
            [
                "name" => "Built",
                "class" => "property-icon-built",
            ],
            [
                "name" => "Cooling",
                "class" => "property-icon-cooling",
            ],
            [
                "name" => "Heating",
                "class" => "property-icon-heating",
            ],
            [
                "name" => "Price",
                "class" => "property-icon-price-sqft",
            ],
            [
                "name" => "Status",
                "class" => "property-icon-status",
            ],
            [
                "name" => "Swimming",
                "class" => "property-icon-swimming",
            ],
            [
                "name" => "Type",
                "class" => "property-icon-type",
            ],
            [
                "name" => "Type",
                "class" => "property-icon-type",
            ],
            [
                "name" => "Keyhole",
                "class" => "property-icon-keyhole",
            ],
            [
                "name" => "Metro",
                "class" => "property-icon-metro",
            ],
            [
                "name" => "Conference hall",
                "class" => "property-icon-conference_hall",
            ],
            [
                "name" => "Security",
                "class" => "property-icon-security",
            ],
            [
                "name" => "Cctv",
                "class" => "property-icon-cctv",
            ],

        ]
    ];
    return $icons;
});

/**
 * Single inventory top_bar
 */
function single_inventory_top_bar_template(){
    $templates = [
        "template_1" => [
            "icon" => ULISTING_URL."/assets/img/attribute_template_style_1.png",
            "name" => "Style 1",
        ]
    ];
    return $templates;
}

function single_inventory_calc_template(){
    $styles = [];

    $styles["style_1"] = [
        "icon" => ULISTING_URL."/assets/img/attribute_template_style_1.png",
        "name" => "Style 1",
    ];
    $styles["style_2"] = [
        "icon" => ULISTING_URL."/assets/img/attribute_template_style_2.png",
        "name" => "Style 2",
    ];

    return $styles;
}

function single_inventory_calc_link_template(){
    $styles = [];

    $styles["style_1"] = [
        "icon" => ULISTING_URL."/assets/img/attribute_template_style_1.png",
        "name" => "Style 1",
    ];
    $styles["style_2"] = [
        "icon" => ULISTING_URL."/assets/img/attribute_template_style_2.png",
        "name" => "Style 2",
    ];

    return $styles;
}

function single_profile_form_template(){
    $styles = [];

    $styles["style_1"] = [
        "icon" => ULISTING_URL."/assets/img/attribute_template_style_1.png",
        "name" => "Style 1",
    ];
    $styles["style_2"] = [
        "icon" => ULISTING_URL."/assets/img/attribute_template_style_2.png",
        "name" => "Style 2",
    ];

    return $styles;
}

/**
 * Custom template Profile Avatar
 */
function profile_avatar_template(){
    $styles = [];

    $styles["profile_avatar_style_1"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/profile_avatar/profile_avatar_style_1.jpg",
        "name" => "Style 1",
    ];
    $styles["profile_avatar_style_2"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/profile_avatar/profile_avatar_style_2.jpg",
        "name" => "Style 2",
    ];
    $styles["profile_avatar_style_3"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/profile_avatar/profile_avatar_style_3.jpg",
        "name" => "Style 3",
    ];
    $styles["profile_avatar_style_4"] = [
        "icon" => get_template_directory_uri()."/assets/images/ulisting/builder/profile_avatar/profile_avatar_style_4.jpg",
        "name" => "Style 4",
    ];
    return $styles;
}

function single_floor_plans_template(){
    $styles = [];

    $styles["style_1"] = [
        "icon" => ULISTING_URL."/assets/img/attribute_template_style_1.png",
        "name" => "Style 1",
    ];
    $styles["style_2"] = [
        "icon" => ULISTING_URL."/assets/img/attribute_template_style_2.png",
        "name" => "Style 2",
    ];
    $styles["style_3"] = [
        "icon" => ULISTING_URL."/assets/img/attribute_template_style_3.png",
        "name" => "Style 2",
    ];

    return $styles;
}

/**
 * Custom template Profile Phone
 */
function profile_phone_template(){
    $templates = [
        "template_1" => [
            "icon" => ULISTING_URL."/assets/img/attribute_template_style_1.png",
            "name" => "Style 1",
        ]
    ];
    return $templates;
}

add_filter("ulisting_single_layout_builder_data", function($data){

    $data["config"]["accordion"] = [
        "field_group" => [
            "template" => [
                "name" => "Template",
                "fields" => [
                    [
                        "type"   => "blog",
                        "label"  => "Style template",
                        "name"   => "template",
                        "items"  => single_floor_plans_template()
                    ]
                ]
            ]
        ]
    ];
    /**
     * Custom single modules Top Bar
     */
    $data["config"]["single_inventory_top_bar"] = [
        "field_group" => [
            "template" => [
                "name" => "Template",
                "fields" => [
                    [
                        "type"   => "blog",
                        "label"  => "Style template",
                        "name"   => "template",
                        "items"  => single_inventory_top_bar_template()
                    ]
                ]

            ],
            "style" => [
                "name" => "Style",
                "fields" => [
                    [
                        "type"   => "color",
                        "label"  => "Background color",
                        "name"   => "background_color",
                    ],
                    [
                        "type"   => "color",
                        "label"  => "Text color",
                        "name"   => "color",
                    ]
                ]
            ],
            "advanced" => [
                "name" => "Advanced",
                "fields" => [
                    [
                        "type"  => "text",
                        "label" => "ID",
                        "name"  => "id",
                    ],
                    [
                        "type"  => "text",
                        "label" => "Class",
                        "name"  => "class",
                    ],
                    [
                        "type"  => "margin",
                        "label" => "Margin",
                        "name"  => "margin",
                    ],
                    [
                        "type"  => "padding",
                        "label" => "Padding",
                        "name"  => "padding",
                    ],
                ]
            ]
        ]
    ];

    $data["elements"][] = [
        "id" => 0,
        "title"        => "Top bar",
        "type"         => "element",
        "group"        => "general",
        "module"       => "element",
        "field_group"  => "single_inventory_top_bar",
        "params"       => [
            "template_path"     => "listing-single/item-meta/style_1",
            "template"          => "template_1",
            "type"              => "element",
            "id"                => "",
            "class"             => "",
            "color"             => "",
            "background_color"  => ""
        ],
    ];

    /**
     * Custom single modules Profile Avatar
     */
    $data["config"]["profile_avatar"] = [
        "field_group" => [
            "template" => [
                "name" => "Template",
                "fields" => [
                    [
                        "type"   => "blog",
                        "label"  => "Style template",
                        "name"   => "template",
                        "items"  => profile_avatar_template()
                    ]
                ]

            ],
            "style" => [
                "name" => "Style",
                "fields" => [
                    [
                        "type"   => "color",
                        "label"  => "Background color",
                        "name"   => "background_color",
                    ],
                    [
                        "type"   => "color",
                        "label"  => "Text color",
                        "name"   => "color",
                    ],
                    [
                        "type"  => "number",
                        "label" => "Font size",
                        "name"  => "font_size",
                    ]
                ]
            ],
            "advanced" => [
                "name" => "Advanced",
                "fields" => [
                    [
                        "type"  => "text",
                        "label" => "ID",
                        "name"  => "id",
                    ],
                    [
                        "type"  => "text",
                        "label" => "Class",
                        "name"  => "class",
                    ],
                    [
                        "type"  => "margin",
                        "label" => "Margin",
                        "name"  => "margin",
                    ],
                    [
                        "type"  => "padding",
                        "label" => "Padding",
                        "name"  => "padding",
                    ],
                    [
                        "type"  => "responsive-input",
                        "label" => "Count",
                        "name"  => "count",
                    ],
                ]
            ]
        ]
    ];

    $data["elements"][] = [
        "id" => 0,
        "title"        => "Profile Avatar",
        "type"         => "element",
        "group"        => "general",
        "module"       => "element",
        "field_group" => "profile_avatar",
        "params"       => [
            "template_path"     => "profile/profile_avatar/profile_avatar",
            "template"          => "template_1",
            "type"              => "element",
            "id"                => "",
            "class"             => "",
            "color"             => "",
            "background_color"  => ""
        ],
    ];

    /**
     * Custom single modules Custom Link
     */
    $data["config"]["custom_link"] = [
        "field_group" => [
            "html" => [
                "name" => "Html",
                "fields" => [
                    [
                        "type"   => "text",
                        "label"  => "Link",
                        "name"   => "url",
                    ],
                    [
                        "type"   => "text",
                        "label"  => "Title",
                        "name"   => "title",
                    ],
                    [
                        "type"   => "text",
                        "label"  => "Title Link",
                        "name"   => "title-link",
                    ],
                ]
            ],
            "style" => [
                "name" => "Style",
                "fields" => [
                    [
                        "type"   => "color",
                        "label"  => "Background color",
                        "name"   => "background_color",
                    ],
                    [
                        "type"   => "color",
                        "label"  => "Text color",
                        "name"   => "color",
                    ],
                    [
                        "type"  => "number",
                        "label" => "Font size",
                        "name"  => "font_size",
                    ]
                ]
            ],
            "advanced" => [
                "name" => "Advanced",
                "fields" => [
                    [
                        "type"  => "text",
                        "label" => "ID",
                        "name"  => "id",
                    ],
                    [
                        "type"  => "text",
                        "label" => "Class",
                        "name"  => "class",
                    ],
                    [
                        "type"  => "margin",
                        "label" => "Margin",
                        "name"  => "margin",
                    ],
                    [
                        "type"  => "padding",
                        "label" => "Padding",
                        "name"  => "padding",
                    ],
                    [
                        "type"  => "responsive-input",
                        "label" => "Count",
                        "name"  => "count",
                    ],
                ]
            ]
        ]
    ];

    $data["elements"][] = [
        "id" => 0,
        "title"        => "Custom Link",
        "type"         => "element",
        "group"        => "general",
        "module"       => "element",
        "field_group" => "custom_link",
        "params"       => [
            "template_path"     => "listing-single/custom-link",
            "template"          => "template_1",
            "type"              => "element",
            "id"                => "",
            "class"             => "",
            "color"             => "",
            "background_color"  => ""
        ],
    ];

    /**
     * Custom single modules Profile Form
     */
    $data["config"]["profile_form"] = [
        "field_group" => [
            "template" => [
                "name" => "Template",
                "fields" => [
                    [
                        "type"   => "blog",
                        "label"  => "Style template",
                        "name"   => "template",
                        "items"  => single_profile_form_template()
                    ]
                ]

            ],
            "advanced" => [
                "name" => "Advanced",
                "fields" => [
                    [
                        "type"  => "text",
                        "label" => "ID",
                        "name"  => "id",
                    ],
                    [
                        "type"  => "text",
                        "label" => "Class",
                        "name"  => "class",
                    ],

                    [
                        "type"  => "text",
                        "label" => "ShortCode",
                        "name"  => "short_code",
                    ],

                    [
                        "type"  => "margin",
                        "label" => "Margin",
                        "name"  => "margin",
                    ],
                    [
                        "type"  => "padding",
                        "label" => "Padding",
                        "name"  => "padding",
                    ],
                    [
                        "type"  => "responsive-input",
                        "label" => "Count",
                        "name"  => "count",
                    ],
                    [
                        "type"   => "responsive-position",
                        "label"  => "Position",
                        "name"   => "position",
                        "items" => [
                            "static"    => "Static",
                            "fixed"    => "Fixed",
                            "absolute" => "Absolute",
                            "relative" => "Relative",
                        ]
                    ],
                ]
            ]
        ]
    ];

    $data["elements"][] = [
        "id" => 0,
        "title"        => "Profile Form",
        "type"         => "element",
        "group"        => "general",
        "module"       => "element",
        "field_group"  => "profile_form",
        "params"       => [
            "template_path"     => "profile/profile_form/style_1",
            "template"          => "style_1",
            "type"              => "element",
            "id"                => "",
            "class"             => "",
            "color"             => "",
            "background_color"  => ""
        ],
    ];

    /**
     * Custom single modules Mortgage Calc Link
     */
    $data["config"]["mortgage_calc_link"] = [
        "field_group" => [
            "template" => [
                "name" => "Template",
                "fields" => [
                    [
                        "type"   => "blog",
                        "label"  => "Style template",
                        "name"   => "template",
                        "items"  => single_inventory_calc_link_template()
                    ]
                ]

            ],
            "style" => [
                "name" => "Style",
                "fields" => [
                    [
                        "type"   => "color",
                        "label"  => "Background color",
                        "name"   => "background_color",
                    ],
                    [
                        "type"   => "color",
                        "label"  => "Text color",
                        "name"   => "color",
                    ],
                    [
                        "type"  => "number",
                        "label" => "Font size",
                        "name"  => "font_size",
                    ]
                ]
            ],
            "advanced" => [
                "name" => "Advanced",
                "fields" => [
                    [
                        "type"  => "text",
                        "label" => "ID",
                        "name"  => "id",
                    ],
                    [
                        "type"  => "text",
                        "label" => "Class",
                        "name"  => "class",
                    ],
                    [
                        "type"  => "margin",
                        "label" => "Margin",
                        "name"  => "margin",
                    ],
                    [
                        "type"  => "padding",
                        "label" => "Padding",
                        "name"  => "padding",
                    ],
                    [
                        "type"  => "responsive-input",
                        "label" => "Count",
                        "name"  => "count",
                    ],
                ]
            ]
        ]
    ];

    $data["elements"][] = [
        "id" => 0,
        "title"        => "Mortgage Calc Link",
        "type"         => "element",
        "group"        => "general",
        "module"       => "element",
        "field_group" => "mortgage_calc_link",
        "params"       => [
            "template_path"     => "calc/calc_link",
            "template"          => "template_1",
            "type"              => "element",
            "id"                => "",
            "class"             => "",
            "color"             => "",
            "background_color"  => ""
        ],
    ];

    /**
     * Custom single modules Mortgage Calc
     */
    $data["config"]["mortgage_calc"] = [
        "field_group" => [
            "template" => [
                "name" => "Template",
                "fields" => [
                    [
                        "type"   => "blog",
                        "label"  => "Style template",
                        "name"   => "template",
                        "items"  => single_inventory_calc_template()
                    ]
                ]

            ],
            "advanced" => [
                "name" => "Advanced",
                "fields" => [
                    [
                        "type"  => "text",
                        "label" => "ID",
                        "name"  => "id",
                    ],
                    [
                        "type"  => "text",
                        "label" => "Class",
                        "name"  => "class",
                    ],
                    [
                        "type"  => "margin",
                        "label" => "Margin",
                        "name"  => "margin",
                    ],
                    [
                        "type"  => "padding",
                        "label" => "Padding",
                        "name"  => "padding",
                    ],
                    [
                        "type"  => "responsive-input",
                        "label" => "Count",
                        "name"  => "count",
                    ],
                ]
            ]
        ]
    ];

    $data["elements"][] = [
        "id" => 0,
        "title"        => "Mortgage Calc",
        "type"         => "element",
        "group"        => "general",
        "module"       => "element",
        "field_group" => "mortgage_calc",
        "params"       => [
            "template_path"     => "calc/calc",
            "template"          => "template_1",
            "type"              => "element",
            "id"                => "",
            "class"             => "",
            "color"             => "",
            "background_color"  => ""
        ],
    ];

    /**
     * Custom single modules Yelp Reviews
     */
    $data["config"]["yelp_nearby"] = [
        "field_group" => [
            "style" => [
                "name" => "Style",
                "fields" => [
                    [
                        "type"   => "color",
                        "label"  => "Background color",
                        "name"   => "background_color",
                    ],
                    [
                        "type"   => "color",
                        "label"  => "Text color",
                        "name"   => "color",
                    ]
                ]
            ],
            "advanced" => [
                "name" => "Advanced",
                "fields" => [
                    [
                        "type"  => "text",
                        "label" => "ID",
                        "name"  => "id",
                    ],
                    [
                        "type"  => "text",
                        "label" => "Class",
                        "name"  => "class",
                    ],
                    [
                        "type"  => "margin",
                        "label" => "Margin",
                        "name"  => "margin",
                    ],
                    [
                        "type"  => "padding",
                        "label" => "Padding",
                        "name"  => "padding",
                    ],
                    [
                        "type"  => "responsive-input",
                        "label" => "Count",
                        "name"  => "count",
                    ],
                ]
            ]
        ]
    ];

    $data["elements"][] = [
        "id" => 0,
        "title"        => "Yelp Nearby",
        "type"         => "element",
        "group"        => "general",
        "module"       => "element",
        "field_group" => "yelp_nearby",
        "params"       => [
            "template_path"     => "yelp/yelp_nearby",
            "template"          => "template_1",
            "type"              => "element",
            "id"                => "",
            "class"             => "",
            "color"             => "",
            "background_color"  => ""
        ],
    ];

    /**
     * Custom single modules Yelp Reviews
     */
    $data["config"]["help_link"] = [
        "field_group" => [
            "style" => [
                "name" => "Style",
                "fields" => [
                    [
                        "type"   => "color",
                        "label"  => "Background color",
                        "name"   => "background_color",
                    ],
                    [
                        "type"   => "color",
                        "label"  => "Text color",
                        "name"   => "color",
                    ]
                ]
            ],
            "advanced" => [
                "name" => "Advanced",
                "fields" => [
                    [
                        "type"  => "text",
                        "label" => "ID",
                        "name"  => "id",
                    ],
                    [
                        "type"  => "text",
                        "label" => "Class",
                        "name"  => "class",
                    ],
                    [
                        "type"  => "margin",
                        "label" => "Margin",
                        "name"  => "margin",
                    ],
                    [
                        "type"  => "padding",
                        "label" => "Padding",
                        "name"  => "padding",
                    ],
                    [
                        "type"  => "responsive-input",
                        "label" => "Count",
                        "name"  => "count",
                    ],
                ]
            ]
        ]
    ];

    $data["elements"][] = [
        "id" => 0,
        "title"        => "Yelp Nearby",
        "type"         => "element",
        "group"        => "general",
        "module"       => "element",
        "field_group" => "yelp_nearby",
        "params"       => [
            "template_path"     => "yelp/yelp_nearby",
            "template"          => "template_1",
            "type"              => "element",
            "id"                => "",
            "class"             => "",
            "color"             => "",
            "background_color"  => ""
        ],
    ];

    return $data;

});

add_filter("ulisting_item_layout_data", function($data){
    /**
     * Custom item modules Profile Avatar
     */
    $data["config"]["profile_avatar"] = [
        "field_group" => [
            "template" => [
                "name" => "Template",
                "fields" => [
                    [
                        "type"   => "blog",
                        "label"  => "Style template",
                        "name"   => "template",
                        "items"  => profile_avatar_template()
                    ]
                ]

            ],
            "style" => [
                "name" => "Style",
                "fields" => [
                    [
                        "type"   => "color",
                        "label"  => "Background color",
                        "name"   => "background_color",
                    ],
                    [
                        "type"   => "color",
                        "label"  => "Text color",
                        "name"   => "color",
                    ],
                    [
                        "type"  => "number",
                        "label" => "Font size",
                        "name"  => "font_size",
                    ]
                ]
            ],
            "advanced" => [
                "name" => "Advanced",
                "fields" => [
                    [
                        "type"  => "text",
                        "label" => "ID",
                        "name"  => "id",
                    ],
                    [
                        "type"  => "text",
                        "label" => "Class",
                        "name"  => "class",
                    ],
                    [
                        "type"  => "margin",
                        "label" => "Margin",
                        "name"  => "margin",
                    ],
                    [
                        "type"  => "padding",
                        "label" => "Padding",
                        "name"  => "padding",
                    ],
                    [
                        "type"  => "responsive-input",
                        "label" => "Count",
                        "name"  => "count",
                    ],
                ]
            ]
        ]
    ];

    $data["elements"][] = [
        "id" => 0,
        "title"        => "Profile Avatar",
        "type"         => "element",
        "group"        => "general",
        "module"       => "element",
        "field_group" => "profile_avatar",
        "params"       => [
            "template_path"     => "profile/profile_avatar/profile_avatar",
            "template"          => "template_1",
            "type"              => "element",
            "id"                => "",
            "class"             => "",
            "color"             => "",
            "background_color"  => ""
        ],
    ];

    /**
     * Custom item modules Profile Phone
     */
    $data["config"]["profile_phone"] = [
        "field_group" => [
            "template" => [
                "name" => "Template",
                "fields" => [
                    [
                        "type"   => "blog",
                        "label"  => "Style template",
                        "name"   => "template",
                        "items"  => profile_phone_template()
                    ]
                ]

            ],
            "style" => [
                "name" => "Style",
                "fields" => [
                    [
                        "type"   => "color",
                        "label"  => "Background color",
                        "name"   => "background_color",
                    ],
                    [
                        "type"   => "color",
                        "label"  => "Text color",
                        "name"   => "color",
                    ],
                    [
                        "type"  => "number",
                        "label" => "Font size",
                        "name"  => "font_size",
                    ]
                ]
            ],
            "advanced" => [
                "name" => "Advanced",
                "fields" => [
                    [
                        "type"  => "text",
                        "label" => "ID",
                        "name"  => "id",
                    ],
                    [
                        "type"  => "text",
                        "label" => "Class",
                        "name"  => "class",
                    ],
                    [
                        "type"  => "margin",
                        "label" => "Margin",
                        "name"  => "margin",
                    ],
                    [
                        "type"  => "padding",
                        "label" => "Padding",
                        "name"  => "padding",
                    ],
                    [
                        "type"  => "responsive-input",
                        "label" => "Count",
                        "name"  => "count",
                    ],
                ]
            ]
        ]
    ];

    $data["elements"][] = [
        "id" => 0,
        "title"        => "Profile Phone",
        "type"         => "element",
        "group"        => "general",
        "module"       => "element",
        "field_group" => "profile_phone",
        "params"       => [
            "template_path"     => "profile/profile_phone/style_1",
            "template"          => "template_1",
            "type"              => "element",
            "id"                => "",
            "class"             => "",
            "color"             => "",
            "background_color"  => ""
        ],
    ];

    /**
     * Listing featured
     */
    $data["config"]["listing_featured"] = [
        "field_group" => [
            "style" => [
                "name" => "Style",
                "fields" => [
                    [
                        "type"   => "color",
                        "label"  => "Background color",
                        "name"   => "background_color",
                    ],
                    [
                        "type"   => "color",
                        "label"  => "Text color",
                        "name"   => "color",
                    ],
                    [
                        "type"  => "number",
                        "label" => "Font size",
                        "name"  => "font_size",
                    ]
                ]
            ],
            "advanced" => [
                "name" => "Advanced",
                "fields" => [
                    [
                        "type"  => "text",
                        "label" => "ID",
                        "name"  => "id",
                    ],
                    [
                        "type"  => "text",
                        "label" => "Class",
                        "name"  => "class",
                    ],
                    [
                        "type"  => "margin",
                        "label" => "Margin",
                        "name"  => "margin",
                    ],
                    [
                        "type"  => "padding",
                        "label" => "Padding",
                        "name"  => "padding",
                    ],
                    [
                        "type"  => "responsive-input",
                        "label" => "Count",
                        "name"  => "count",
                    ],
                ]
            ]
        ]
    ];

    $data["elements"][] = [
        "id" => 0,
        "title"        => "Featured",
        "type"         => "element",
        "group"        => "general",
        "module"       => "element",
        "field_group" => "listing_featured",
        "params"       => [
            "template_path"     => "listing/label_featured",
            "type"              => "element",
            "id"                => "",
            "class"             => "",
            "color"             => "",
            "background_color"  => ""
        ],
    ];

    return $data;

});


//Inventory google map marker
add_filter("ulisting_map_marker_icon", function($icon){

    $icon['url'] = get_template_directory_uri()."/assets/images/map-marker.svg";

    $icon['scaledSize'] = [
        "width" => 40,
        "height" => 40,
    ];

    return $icon;
});


/**
 * My account navigation
 */
add_filter("ulisting_account_endpoint", function($endpoints){

    $pages = get_option("stm_listing_pages");
    if(isset($pages['account_endpoint']))
        $account_endpoint_val = $pages['account_endpoint'];

    $endpoints[] =  [
        "title"    => __( 'Edit account', "homepress"),
        "var"      => "edit-account",
        "value"    => (isset($account_endpoint_val["edit-account"])) ? $account_endpoint_val["edit-account"] : "edit-account",
        "template" => "account/edit-account",
        "menu" => [
            "account-edit",
        ]
    ];

    $endpoints[3] =  [
        "title" => __( 'My Invoices', "homepress"),
        "var"   => "payment-history",
        "value" => (isset($account_endpoint_val["payment-history"])) ? $account_endpoint_val["payment-history"] : "payment-history",
        "template" => "account/payment-history",
        "template_path" => ULISTING_PATH_LIB_STRIPE."/templates/",
        "menu" => [
            "account-navigation",
        ]
    ];

    $endpoints[5] = [
        "title" => __( 'My searches', "homepress"),
        "var"   => "saved-searches",
        "value" => (isset($account_endpoint_val["saved-searches"])) ? $account_endpoint_val["saved-searches"] : "saved-searches",
        "template" => ULISTING_PATH_LIB_STRIPE."/templates/",
        "menu" => [
            "account-navigation",
        ]
    ];

//    $endpoints[5] =  [
//        "title" => __( 'My card', "homepress"),
//        "var"   => "my-card",
//        "value" => (isset($account_endpoint_val["my-card"])) ? $account_endpoint_val["my-card"] : "my-card",
//        "template" => "stripe/my-card",
//        "template_path" => ULISTING_PATH_LIB_STRIPE."/templates/",
//        "menu" => [
//            "account-navigation",
//        ]
//    ];

    return $endpoints;
});

/**
 * My account user custom fields
 */
add_filter("ulisting_user_meta_data", function($data){
    $nickname = get_user_meta($data['user']->ID, "nickname");
    $data['data']['nickname'] = [
        'name' => "Nickname",
        'value' => (isset($nickname[0])) ? $nickname[0] : ""
    ];

    $phone_mobile = get_user_meta($data['user']->ID, "phone_mobile");
    $data['data']['phone_mobile'] = [
        'name' => "Mobile Phone",
        'value' => (isset($phone_mobile[0])) ? $phone_mobile[0] : ""
    ];

    $phone_office = get_user_meta($data['user']->ID, "phone_office");
    $data['data']['phone_office'] = [
        'name' => "Office Phone",
        'value' => (isset($phone_office[0])) ? $phone_office[0] : ""
    ];

    $fax = get_user_meta($data['user']->ID, "fax");
    $data['data']['fax'] = [
        'name' => "Fax",
        'value' => (isset($fax[0])) ? $fax[0] : ""
    ];

    $url = get_user_meta($data['user']->ID, "url");
    $data['data']['url'] = [
        'name' => "Url",
        'value' => (isset($url[0])) ? $url[0] : ""
    ];

    $address = get_user_meta($data['user']->ID, "address");
    $data['data']['address'] = [
        'name' => "Address",
        'value' => (isset($address[0])) ? $address[0] : ""
    ];

    $latitude = get_user_meta($data['user']->ID, "latitude");
    $data['data']['latitude'] = [
        'name' => "latitude",
        'value' => (isset($latitude[0])) ? $latitude[0] : ""
    ];

    $longitude = get_user_meta($data['user']->ID, "longitude");
    $data['data']['longitude'] = [
        'name' => "Longitude",
        'value' => (isset($longitude[0])) ? $longitude[0] : ""
    ];

    $license = get_user_meta($data['user']->ID, "license");
    $data['data']['license'] = [
        'name' => "License",
        'value' => (isset($license[0])) ? $license[0] : ""
    ];

    $tax_number = get_user_meta($data['user']->ID, "tax_number");
    $data['data']['tax_number'] = [
        'name' => "Tax number",
        'value' => (isset($tax_number[0])) ? $tax_number[0] : ""
    ];

    $description = get_user_meta($data['user']->ID, "description");
    $data['data']['description'] = [
        'name' => "Description",
        'value' => (isset($description[0])) ? $description[0] : ""
    ];

    $google_plus = get_user_meta($data['user']->ID, "google_plus");
    $data['data']['google_plus'] = [
        'name' => "Google plus",
        'value' => (isset($google_plus[0])) ? $google_plus[0] : ""
    ];

    $youtube_play = get_user_meta($data['user']->ID, "youtube_play");
    $data['data']['youtube_play'] = [
        'name' => "Youtube play",
        'value' => (isset($youtube_play[0])) ? $youtube_play[0] : ""
    ];

    $linkedin = get_user_meta($data['user']->ID, "linkedin");
    $data['data']['linkedin'] = [
        'name' => "Linkedin",
        'value' => (isset($linkedin[0])) ? $linkedin[0] : ""
    ];

    return $data;
});