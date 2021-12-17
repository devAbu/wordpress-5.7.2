<?php

if ( ! defined( 'ABSPATH' ) ) exit; //Exit if accessed directly


class STMT_TO_Taxonomies
{
	function __construct()
	{
		add_action('init', array($this, 'taxonomies_init'), -1);
	}

	function taxonomies()
	{
		return apply_filters('stmt_to_taxonomies', array(
			'stmt-services-taxonomy' => array(
				'post_type' => 'stmt-services',
				'args' => array(
					'hierarchical'      => true,
					'labels'            => array(
						'name'              => _x('Services category', 'taxonomy general name', 'homepress-configurations'),
						'singular_name'     => _x('Services category', 'taxonomy singular name', 'homepress-configurations'),
						'search_items'      => __('Search services category', 'homepress-configurations'),
						'all_items'         => __('All services category', 'homepress-configurations'),
						'parent_item'       => __('Parent services category', 'homepress-configurations'),
						'parent_item_colon' => __('Parent services category:', 'homepress-configurations'),
						'edit_item'         => __('Edit services category', 'homepress-configurations'),
						'update_item'       => __('Update services category', 'homepress-configurations'),
						'add_new_item'      => __('Add New services category', 'homepress-configurations'),
						'new_item_name'     => __('New services category Name', 'homepress-configurations'),
						'menu_name'         => __('Categories', 'homepress-configurations'),
					),
					'show_ui'           => true,
					'show_admin_column' => true,
					'query_var'         => true,
				)
			)
		));
	}

	function taxonomies_init()
	{
		$taxonomies = $this->taxonomies();
		foreach ($taxonomies as $taxonomy => $taxonomy_args) {
			register_taxonomy($taxonomy, $taxonomy_args['post_type'], $taxonomy_args['args']);
		}
	}
}

new STMT_TO_Taxonomies();