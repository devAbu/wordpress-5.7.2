<?php

namespace homepressDemoImport\classes;

use homepress\classes\StmAjaxAction;
use uListing\Classes\Builder\UListingBuilder;
use uListing\Classes\StmInventoryLayout;
use uListing\Classes\StmListingType;

class PluginImport {

    public static function init() {
        add_filter("homepress_ajax", [self::class, "add_ajax"]);
    }

    public static function add_ajax($data){

        $data[] = [
            "is_admin" => true,
            "tag" => "ulisting_demo_import_inventory_pages",
            "action" => [self::class, "import_inventory_pages"]
        ];

        $data[] = [
            "is_admin" => true,
            "tag" => "ulisting_demo_import_listing_attribute",
            "action" => [self::class, "import_listing_attribute"]
        ];

        $data[] = [
            "is_admin" => true,
            "tag" => "ulisting_demo_import_listing_type",
            "action" => [self::class, "import_listing_type"]
        ];

        $data[] = [
            "is_admin" => true,
            "tag" => "ulisting_demo_import_listing_categories",
            "action" => [self::class, "import_listing_categories"]
        ];

        $data[] = [
            "is_admin" => true,
            "tag" => "ulisting_demo_import_listing_regions",
            "action" => [self::class, "import_listing_regions"]
        ];

        $data[] = [
            "is_admin" => true,
            "tag" => "ulisting_demo_import_listing",
            "action" => [self::class, "import_listing"]
        ];

        $data[] = [
            "is_admin" => true,
            "tag" => "ulisting_demo_import_listing_type_inventory_page",
            "action" => [self::class, "import_listing_type_inventory_page"]
        ];

        $data[] = [
            "is_admin" => true,
            "tag" => "ulisting_demo_import_listing_type_single_page",
            "action" => [self::class, "import_listing_type_single_page"]
        ];

        $data[] = [
            "is_admin" => true,
            "tag" => "ulisting_demo_import_listing_type_item_grid",
            "action" => [self::class, "import_listing_type_item_grid"]
        ];

        $data[] = [
            "is_admin" => true,
            "tag" => "ulisting_demo_import_listing_type_item_list",
            "action" => [self::class, "import_listing_type_item_list"]
        ];

        $data[] = [
            "is_admin" => true,
            "tag" => "ulisting_demo_import_listing_type_item_map",
            "action" => [self::class, "import_listing_type_item_map"]
        ];

        $data[] = [
            "is_admin" => true,
            "tag" => "ulisting_demo_import_setting_pages",
            "action" => [self::class, "import_setting_pages"]
        ];

        $data[] = [
            "is_admin" => true,
            "tag" => "ulisting_demo_import_currency_settings",
            "action" => [self::class, "import_currency_settings"]
        ];

        return $data;
    }

    /**
     * @return bool|false|array|\uListing\Classes\Vendor\StmBaseModel
     */
    public static function get_lisitng_types(){
        $lisitng_types = [];
        $file   = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/data/export_listing_type_data.txt';
        $contents = file_get_contents($file);
        $items = json_decode($contents, true);
        foreach ($items as $item){
            if(isset($item["meta"]['ulisting_import_id']) AND isset($item["meta"]['ulisting_import_id'][0])){
                $args = array(
                    'meta_query'        => array(
                        array(
                            'key'       => "ulisting_import_id",
                            'value'     => $item["meta"]['ulisting_import_id'][0],
                            'compare'   => 'LIKE'
                        )
                    ),
                    'post_type'         => 'listing_type',
                    'posts_per_page'    => '1'
                );
                $posts = get_posts( $args );
                if(isset($posts[0]) AND isset($posts[0]->ID)){
                    $lisitng_types[] = StmListingType::find_one($posts[0]->ID);
                }
            }
        }
        return $lisitng_types;
    }

    public static function import_inventory_pages(){
        $result = [
            "success" => false,
            "message" => "",
        ];
        $file = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/data/export_inventory_layout.txt';
        $stm_import = new \uListing\Classes\StmImport();
        if ($stm_import->inventory_layout_import_from_file($file))
            $result['success'] = true;

        $layouts = StmInventoryLayout::getLayoutList();

        if ( !empty($layouts) && is_array( $layouts ) ) {
            foreach ($layouts as $layout) {
                $image = HOMEPRESS_DEMO_IMPORT_URL . '/assets/images/inventory/' . $layout['id'] . '.png';
                update_option($layout['key'], sanitize_text_field($image));
            }
        }

        wp_send_json($result);
        wp_die();
    }

    public static function import_listing_attribute(){
        $result = [
            "success" => false,
            "message" => "",
        ];
        $file = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/data/export_attribute_data.txt';
        $stm_import = new \uListing\Classes\StmImport();
        if ($stm_import->attribute_import_from_file($file))
            $result['success'] = true;
        wp_send_json($result);
        wp_die();
    }

    public static function import_listing_type(){
        $result = [
            "success" => false,
            "message" => "",
        ];
        $file =  HOMEPRESS_DEMO_IMPORT_PATH . '/includes/data/export_listing_type_data.txt';
        $stm_import = new \uListing\Classes\StmImport();
        if($stm_import->listing_type_import_from_file($file))
            $result['success'] = true;
        wp_send_json($result);
        wp_die();
    }

    public static function import_listing_categories(){
        $result = [
            "success" => false,
            "message" => "",
        ];
        $file = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/data/export_listing_categories_data.txt';
        $stm_import = new \uListing\Classes\StmImport();
        if($stm_import->listing_category_import_from_file($file))
            $result['success'] = true;
        wp_send_json($result);
        wp_die();
    }

    public static function import_listing_regions(){
        $result = [
            "success" => false,
            "message" => "",
        ];
        $file = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/data/export_listing_regions_data.txt';
        $stm_import = new \uListing\Classes\StmImport();
        if($stm_import->listing_region_import_from_file($file))
            $result['success'] = true;
        wp_send_json($result);
        wp_die();
    }

    public static function import_listing(){
        $result = [
            "success" => false,
            "message" => "",
        ];
        $file = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/data/export_listing_data.txt';
        $stm_import = new \uListing\Classes\StmImport();
        if($stm_import->listing_import_from_file($file))
            $result['success'] = true;
        wp_send_json($result);
        wp_die();
    }

    public static function import_listing_type_inventory_page(){
        $result = [
            "success" => false,
            "message" => "",
        ];
        $file = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/data/export_listing_type_builder_data.txt';
        if (isset($_POST['inventory_id'])){
            foreach (self::get_lisitng_types() as $lisitng_type) {
                update_post_meta($lisitng_type->ID, 'listing_type_layout', $_POST['inventory_id']);
            }
            $result['success'] = true;
        }
        wp_send_json($result);
        wp_die();
    }

    public static function import_listing_type_single_page() {
        $result = [
            "success" => false,
            "message" => "",
        ];

        $file   = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/data/export_listing_type_data.txt';

        if ( ! file_exists( $file ) ) {
            $result['message'] = "File not found :( ";
            wp_send_json( $result );
            wp_die();
        }
        $count = 0;

        if ( isset( $_POST['single_layout'] )) {
            foreach (self::get_lisitng_types() as $lisitng_type) {
                $post_meta = get_post_meta($lisitng_type->ID);
                foreach ($post_meta as $key => $value){
                    if (strpos($key, 'ulisting_single_page_layout_') !== false) {
                        $layout = json_decode($value[0], true);
                        if ( isset($layout['name']) AND $_POST['single_layout']  == $layout['name'] ) {
                            update_post_meta($lisitng_type->ID, "stm_listing_single_layout", $key);
                        }

                        $image = HOMEPRESS_DEMO_IMPORT_URL . '/assets/images/single-page/' . $key . '.png';
                        update_option($key. '_image', sanitize_text_field($image));
                    }
                }
                $count++;
            }
            $result['success'] = true;
        }
        wp_send_json( $result );
        wp_die();
    }

    public static function import_listing_type_item_grid(){
        $result = [
            "success" => false,
            "message" => "",
        ];

        $file = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/data/export_listing_type_builder_data.txt';

        if ( ! file_exists( $file ) ) {
            $result['message'] = "File not found :( ";
            wp_send_json( $result );
            wp_die();
        }

        if ( isset( $_POST['grid_id'] ) AND $lisitng_type = self::get_lisitng_type() ) {
            $contents = file_get_contents($file);
            $data= json_decode($contents, true);
            $grids = (isset($data['stm_listing_item_card_grid'])) ? $data['stm_listing_item_card_grid'] : [];
            foreach ($grids as $grid){
                if(isset($grid['config']) AND isset($grid['config']['template']) AND $grid['config']['template'] == $_POST['grid_id'] ){
                    $style = UListingBuilder::generation_style($grid['sections']);
                    UListingBuilder::generation_css("ulisting_item_card_".$lisitng_type->ID."_grid", $style);
                    update_post_meta($lisitng_type->ID, "stm_listing_item_card_grid", maybe_serialize($grid));
                    $result['success'] = true;
                }
            }
        }
        wp_send_json($result);
        wp_die();
    }

    public static function import_listing_type_item_list(){
        $result = [
            "success" => false,
            "message" => "",
        ];

        $file = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/data/export_listing_type_builder_data.txt';

        if ( ! file_exists( $file ) ) {
            $result['message'] = "File not found :( ";
            wp_send_json( $result );
            wp_die();
        }

        if ( isset( $_POST['list_id'] ) AND $lisitng_type = self::get_lisitng_type() ) {
            $contents = file_get_contents($file);
            $data= json_decode($contents, true);
            $lists = (isset($data['stm_listing_item_card_list'])) ? $data['stm_listing_item_card_list'] : [];
            foreach ($lists as $list){
                if(isset($list['config']) AND isset($list['config']['template']) AND $list['config']['template'] == $_POST['list_id'] ){
                    $style = UListingBuilder::generation_style($list['sections']);
                    UListingBuilder::generation_css("ulisting_item_card_".$lisitng_type->ID."_list", $style);
                    update_post_meta($lisitng_type->ID, "stm_listing_item_card_list", maybe_serialize($list));
                    $result['success'] = true;
                }
            }
        }
        wp_send_json($result);
        wp_die();
    }

    public static function import_listing_type_item_map(){
        $result = [
            "success" => false,
            "message" => "",
        ];

        $file = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/data/export_listing_type_builder_data.txt';

        if ( ! file_exists( $file ) ) {
            $result['message'] = "File not found :( ";
            wp_send_json( $result );
            wp_die();
        }

        if ( isset( $_POST['map_id'] ) AND $lisitng_type = self::get_lisitng_type() ) {
            $contents = file_get_contents($file);
            $data= json_decode($contents, true);
            $maps = (isset($data['stm_listing_item_card_map'])) ? $data['stm_listing_item_card_map'] : [];
            foreach ($maps as $map){
                if(isset($map['config']) AND isset($map['config']['template']) AND $map['config']['template'] == $_POST['map_id'] ){
                    $style = UListingBuilder::generation_style($map['sections']);
                    UListingBuilder::generation_css("ulisting_item_card_".$lisitng_type->ID."_map", $style);
                    update_post_meta($lisitng_type->ID, "stm_listing_item_card_map", maybe_serialize($map));
                    $result['success'] = true;
                }
            }
        }
        wp_send_json($result);
        wp_die();
    }

    public static function import_currency_settings()
    {
        $result = [
            "success" => true,
            "message" => "",
        ];

        $file = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/data/export_currency_settings.txt';
        $stm_import = new \uListing\Classes\StmImport();
        if($stm_import->currency_settings_import_from_file($file))
            $result['success'] = true;
        wp_send_json($result);
        wp_die();
    }

    public static function import_setting_pages(){
        $result = [
            "success" => false,
            "message" => "",
        ];
        $file = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/data/export_settings_pages.txt';
        $stm_import = new \uListing\Classes\StmImport();
        if($stm_import->setting_pages_import_from_file($file))
            $result['success'] = true;
        wp_send_json($result);
        wp_die();
    }
}