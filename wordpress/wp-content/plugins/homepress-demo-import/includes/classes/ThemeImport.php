<?php
namespace homepressDemoImport\classes;

class ThemeImport {

	public static function init() {
		add_filter("homepress_ajax", [self::class, "add_ajax"]);
	}

	public static function add_ajax($data){

		$data[] = [
			"is_admin" => true,
			"tag" => "stm_install_home_page",
			"action" => [self::class, "install_home_page"]
		];


		$data[] = [
			"is_admin" => true,
			"tag" => "stm_install_widgets",
			"action" => [self::class, "install_widgets"]
		];
		return $data;
	}

	public static function delete_all_menu(){
		$taxonomy_name = 'nav_menu';
		$terms = get_terms( array(
			'taxonomy' => $taxonomy_name,
			'hide_empty' => false
		) );
		foreach ( $terms as $term ) {
			wp_delete_term($term->term_id, $taxonomy_name);
		}
	}

	//Content import
	public static function install_home_page(){

		$result = [
			"success" => false,
			"message" => ""
		];

		$page_id = ( isset( $_POST['page_id'] ) ) ? $_POST['page_id'] : null;

		set_time_limit( 0 );
		if (!defined( 'WP_LOAD_IMPORTERS' ) ) {
			define( 'WP_LOAD_IMPORTERS', true );
		}

		require_once HOMEPRESS_DEMO_IMPORT_PATH . '/includes/wordpress-importer/wordpress-importer.php';

		$wp_import = new \WP_Import();
		$wp_import->fetch_attachments = true;

		$ready = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/xml/demo.xml';

		if( file_exists($ready) ){
			self::delete_all_menu();
			ob_start();
			$wp_import->import($ready);
			ob_end_clean();
		}

        //Slider Import
        require_once HOMEPRESS_DEMO_IMPORT_PATH . '/includes/sliders/slider.php';

        stm_theme_import_sliders();

		//Get nav menu
		$locations = get_theme_mod('nav_menu_locations');
		$menus  = wp_get_nav_menus();

		if( isset( $menus ) AND !empty( $menus ) ) {
			foreach( $menus as $menu ) {
				if( is_object( $menu ) && $menu->name == 'Header Menu' ) {
					$locations['menu-header'] = $menu->term_id;
				}
				if( is_object( $menu ) && $menu->name == 'Footer menu' ) {
					$locations['menu-footer'] = $menu->term_id;
				}
			}
		}

		set_theme_mod('nav_menu_locations', $locations);

		//Get home page
		update_option( 'show_on_front', 'page' );

		//Get post page
		$blog_page = get_page_by_title( 'News' );
		if ( isset( $blog_page->ID ) ) {
			update_option( 'page_for_posts', $blog_page->ID );
		}

		$args = array(
			'meta_query'        => array(
				array(
					'key'       => "page_id",
					'value'     => $page_id
				)
			),
			'post_type'         => 'page',
			'posts_per_page'    => '1'
		);

		$posts = get_posts( $args );

		if( isset( $posts[0] ) AND isset( $posts[0]->ID ) ) {
			update_option( 'page_on_front', $posts[0]->ID );
			$result['success'] = true;
		}

		//Elementor settings
		update_option( 'elementor_disable_color_schemes', 'yes' );
		update_option( 'elementor_disable_typography_schemes', 'yes' );
		update_option( 'elementor_container_width', 1140 );

		do_action('homepress_theme_content_imported');

        //Generate Theme Options Style
        do_action('configurations_styles', 'homepress_generate_styles');

		wp_send_json( $result );
		wp_die();

	}

	//Widgets import
	public static function install_widgets(){
		$result = [
			"success" => false,
			"message" => ""
		];

		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		//Clear sidebars before import
		delete_option( 'sidebars_widgets' );
		delete_option( 'image-map-pro-wordpress-admin-options' );

		//Import Floor Plans
		$floor_plans = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/data/floor_plans.txt';

		if ( file_exists( $floor_plans ) ) {
			$floor_plans_option = json_decode($wp_filesystem->get_contents( $floor_plans ), true);
			update_option( 'image-map-pro-wordpress-admin-options', $floor_plans_option );
		}

		//Import Widgets
		$widgets = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/widgets/widget_data.json';

		if ( file_exists( $widgets ) ) {
			$encode_widgets_array = $wp_filesystem->get_contents( $widgets );
			self::stm_import_widgets( $encode_widgets_array );
			$result['success'] = true;
		}

		wp_send_json( $result );
		wp_die();
	}

	public static function stm_import_widgets($widget_data)
	{
		$json_data = $widget_data;
		$json_data = json_decode($json_data, true);

		$sidebar_data = $json_data[0];
		$widget_data = $json_data[1];

		$menu_object = wp_get_nav_menu_object('Widget menu');

		if (!empty($menu_object)
		    and !empty($menu_object->term_id)
		        and !empty($widget_data['nav_menu'])
		            and !empty($widget_data['nav_menu'][2])
		                and !empty($widget_data['nav_menu'][2]['nav_menu'])
		) {
			$widget_data['nav_menu'][2]['nav_menu'] = $menu_object->term_id;
		}

		foreach ($widget_data as $widget_data_title => $widget_data_value) {
			$widgets[$widget_data_title] = array();
			foreach ($widget_data_value as $widget_data_key => $widget_data_array) {
				if (is_int($widget_data_key)) {
					$widgets[$widget_data_title][$widget_data_key] = 'on';
				}
			}
		}
		unset($widgets[""]);

		foreach ($sidebar_data as $title => $sidebar) {
			$count = count($sidebar);
			for ($i = 0; $i < $count; $i++) {
				$widget = array();
				$widget['type'] = trim(substr($sidebar[$i], 0, strrpos($sidebar[$i], '-')));
				$widget['type-index'] = trim(substr($sidebar[$i], strrpos($sidebar[$i], '-') + 1));
				if (!isset($widgets[$widget['type']][$widget['type-index']])) {
					unset($sidebar_data[$title][$i]);
				}
			}
			$sidebar_data[$title] = array_values($sidebar_data[$title]);
		}

		foreach ($widgets as $widget_title => $widget_value) {
			foreach ($widget_value as $widget_key => $widget_value) {
				$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
			}
		}

		$sidebar_data = array(array_filter($sidebar_data), $widgets);

		self::stm_widget_parse_import_data($sidebar_data);
	}

	public static function stm_widget_parse_import_data($import_array)
	{
		global $wp_registered_sidebars;
		$sidebars_data = $import_array[0];
		$widget_data = $import_array[1];
		$current_sidebars = get_option('sidebars_widgets');
		$new_widgets = array();

		foreach ($sidebars_data as $import_sidebar => $import_widgets) :

			foreach ($import_widgets as $import_widget) :
				//if the sidebar exists
				if (isset($wp_registered_sidebars[$import_sidebar])) :
					$title = trim(substr($import_widget, 0, strrpos($import_widget, '-')));
					$index = trim(substr($import_widget, strrpos($import_widget, '-') + 1));
					$current_widget_data = get_option('widget_' . $title);
					$new_widget_name = self::stm_get_new_widget_name($title, $index);
					$new_index = trim(substr($new_widget_name, strrpos($new_widget_name, '-') + 1));

					if (!empty($new_widgets[$title]) && is_array($new_widgets[$title])) {
						while (array_key_exists($new_index, $new_widgets[$title])) {
							$new_index++;
						}
					}
					$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
					if (array_key_exists($title, $new_widgets)) {
						$new_widgets[$title][$new_index] = $widget_data[$title][$index];
						$multiwidget = $new_widgets[$title]['_multiwidget'];
						unset($new_widgets[$title]['_multiwidget']);
						$new_widgets[$title]['_multiwidget'] = $multiwidget;
					} else {
						$current_widget_data[$new_index] = $widget_data[$title][$index];
						$current_multiwidget = isset($current_widget_data['_multiwidget']) ? $current_widget_data['_multiwidget'] : false;
						$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
						$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
						unset($current_widget_data['_multiwidget']);
						$current_widget_data['_multiwidget'] = $multiwidget;
						$new_widgets[$title] = $current_widget_data;
					}

				endif;
			endforeach;
		endforeach;

		if (isset($new_widgets) && isset($current_sidebars)) {
			update_option('sidebars_widgets', $current_sidebars);

			foreach ($new_widgets as $title => $content) {
				update_option('widget_' . $title, $content);
			}

			return true;
		}

		return false;
	}

	public static function stm_get_new_widget_name($widget_name, $widget_index)
	{
		$current_sidebars = get_option('sidebars_widgets');
		$all_widget_array = array();
        if (!empty($current_sidebars) && is_array( $current_sidebars )) {
            foreach ($current_sidebars as $sidebar => $widgets) {
                if (!empty($widgets) && is_array($widgets) && $sidebar != 'wp_inactive_widgets') {
                    foreach ( $widgets as $widget ) {
                        $all_widget_array[] = $widget;
                    }
                }
            }
        }
		while (in_array($widget_name . '-' . $widget_index, $all_widget_array)) {
			$widget_index++;
		}
		$new_widget_name = $widget_name . '-' . $widget_index;

		return $new_widget_name;
	}

}