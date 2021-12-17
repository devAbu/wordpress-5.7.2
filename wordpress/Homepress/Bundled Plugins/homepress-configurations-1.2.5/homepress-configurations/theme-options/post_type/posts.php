<?php

if ( ! defined( 'ABSPATH' ) ) exit; //Exit if accessed directly


require_once STMT_TO_DIR . '/post_type/taxonomy_meta/metaboxes.php';
require_once STMT_TO_DIR . '/post_type/metaboxes/metabox.php';

class STMT_TO_Post_Type
{
	function __construct()
	{
		add_action('init', array($this, 'post_types_init'), 100);
	}

	function post_types()
	{
		return array(
            'stmt-services' => array(
                'single'   => 'Services',
                'plural'   => 'Services',
                'args'   => array(
                    'rewrite' => array(
                        'slug' => 'services',
                    ),
                    'public' => true,
                    'publicly_queryable' => true,
                    'show_ui' => true,
                    'exclude_from_search' => true,
                    'show_in_nav_menus' => true,
                    'has_archive' => true,
                    'menu_icon'=> 'dashicons-analytics',
                    'supports'  => array('title', 'thumbnail', 'editor', 'excerpt'),
                )
            ),
            'stmt-staff' => array(
                'single'   => 'Staff',
                'plural'   => 'Staff',
                'args'   => array(
                    'rewrite' => array(
                        'slug' => 'staff',
                    ),
                    'public' => false,
                    'publicly_queryable' => false,
                    'show_ui' => true,
                    'exclude_from_search' => true,
                    'show_in_nav_menus' => false,
                    'has_archive' => false,
                    'menu_icon'=> 'dashicons-groups',
                    'supports' => array('title', 'thumbnail'),
                )
            ),
            'stmt-testimonials' => array(
                'single'   => 'Testimonials',
                'plural'   => 'Testimonials',
                'args'   => array(
                    'rewrite' => array(
                        'slug' => 'testimonials',
                    ),
                    'public' => false,
                    'publicly_queryable' => false,
                    'show_ui' => true,
                    'exclude_from_search' => true,
                    'show_in_nav_menus' => false,
                    'has_archive' => false,
                    'menu_icon'=> 'dashicons-format-quote',
                    'supports' => array('title', 'thumbnail', 'editor'),
                )
            ),
		);
	}

	function post_types_init()
	{

		$post_types = $this->post_types();

		foreach ($post_types as $post_type => $post_type_info) {

			$add_args = (!empty($post_type_info['args'])) ? $post_type_info['args'] : array();
			$args = $this->post_type_args(
				$this->post_types_labels($post_type_info['single'],
					$post_type_info['plural']
				),
				$post_type,
				$add_args
			);

			register_post_type($post_type, $args);
		}
	}

	function post_types_labels($singular, $plural)
	{
		$admin_bar_name = (!empty($admin_bar_name)) ? $admin_bar_name : $plural;
		return array(
			'name'               => _x(sprintf('%s', $plural), 'post type general name', 'homepress-configurations'),
			'singular_name'      => _x(sprintf('%s', $singular), 'post type singular name', 'homepress-configurations'),
			'menu_name'          => _x(sprintf('%s', $plural), 'admin menu', 'homepress-configurations'),
			'name_admin_bar'     => sprintf(_x('%s', 'Admin bar ' . $singular . ' name', 'homepress-configurations'), $admin_bar_name),
			'add_new_item'       => sprintf(__('Add New %s', 'homepress-configurations'), $singular),
			'new_item'           => sprintf(__('New %s', 'homepress-configurations'), $singular),
			'edit_item'          => sprintf(__('Edit %s', 'homepress-configurations'), $singular),
			'view_item'          => sprintf(__('View %s', 'homepress-configurations'), $singular),
			'all_items'          => sprintf(_x('%s', 'Admin bar ' . $singular . ' name', 'homepress-configurations'), $admin_bar_name),
			'search_items'       => sprintf(__('Search %s', 'homepress-configurations'), $plural),
			'parent_item_colon'  => sprintf(__('Parent %s:', 'homepress-configurations'), $plural),
			'not_found'          => sprintf(__('No %s found.', 'homepress-configurations'), $plural),
			'not_found_in_trash' => sprintf(__('No %s found in Trash.', 'homepress-configurations'), $plural),
		);
	}

	function post_type_args($labels, $slug, $args = array())
	{
		$can_edit = (current_user_can('edit_posts'));
		$default_args = array(
			'labels'             => $labels,
			'public'             => $can_edit,
			'publicly_queryable' => $can_edit,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array('slug' => $slug),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array('title')
		);

		return wp_parse_args($args, $default_args);
	}

}

new STMT_TO_Post_Type();

require_once STMT_TO_DIR . '/post_type/taxonomies.php';