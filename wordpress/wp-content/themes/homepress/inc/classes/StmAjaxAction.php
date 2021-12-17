<?php

namespace homepress\classes;

class StmAjaxAction {

    /**
     * @param string   $tag             The name of the action to which the $function_to_add is hooked.
     * @param callable $function_to_add The name of the function you wish to be called.
     * @param int      $priority        Optional. Used to specify the order in which the functions
     *                                  associated with a particular action are executed. Default 10.
     *                                  Lower numbers correspond with earlier execution,
     *                                  and functions with the same priority are executed
     *                                  in the order in which they were added to the action.
     * @param int      $accepted_args   Optional. The number of arguments the function accepts. Default 1.
     * @return true Will always return true.
     */
    public static function addAction($tag, $function_to_add, $priority = 10, $accepted_args = 1) {
        add_action('wp_ajax_'.$tag, $function_to_add, $priority = 10, $accepted_args = 1);
        add_action('wp_ajax_nopriv_'.$tag, $function_to_add);
    }

	public static function init() {
		$ajax_actions = apply_filters("homepress_ajax", []);
		foreach ($ajax_actions as $ajax_action) {
			if(isset($ajax_action['is_admin']) AND !$ajax_action['is_admin'])
				StmAjaxAction::addAction($ajax_action['tag'], $ajax_action['action']);
		}

		if(is_admin()) {
			foreach ($ajax_actions as $ajax_action) {
				if(isset($ajax_action['is_admin']) AND $ajax_action['is_admin'])
					StmAjaxAction::addAction($ajax_action['tag'], $ajax_action['action']);
			}
		}
	}


}