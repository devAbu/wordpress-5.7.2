<?php
/*Redirect to theme Welcome screen*/
global $pagenow;

if (is_admin() && 'themes.php' == $pagenow && isset($_GET['activated']) && !defined('ENVATO_HOSTED_SITE')) {
	wp_redirect(admin_url("admin.php?page=homepress"));
    do_action('configurations_styles', 'homepress_generate_styles');
}

function stm_get_creds() {

	/*If envato hosted*/
	if ( !defined('ENVATO_HOSTED_SITE') && !defined('SUBSCRIPTION_CODE') ){
		$t = get_option('envato_market', array());
		if( !empty($t['token']) ) {
			$creds['t'] = $t['token'];
		}else{
			$creds['t'] = '';
		}
		$creds['host'] = false;
	}else{
		$creds['t'] = SUBSCRIPTION_CODE;
		$creds['host'] = true;
	}

	return $creds;
}

function stm_check_auth() {

	$creds = stm_get_creds();
	$has_t = get_site_transient('stm_theme_auth');

	if( false === $has_t ) {

		$api_args = array(
			'theme' => STM_ITEM_NAME,
			't' => $creds['t'],
			'host' => $creds['host'],
		);
		$url = add_query_arg( $api_args, STM_API_URL . 'registration/');
		$response = wp_remote_get( $url, array( 'timeout' => 20 ) );

		// Check the response code.
		$response_code = wp_remote_retrieve_response_code( $response );
		$return = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( $response_code == '200' ) {
			set_site_transient('stm_theme_auth', $return['confirm_code'] );
			delete_site_transient('stm_auth_notice');
			return $return['confirm_code'];
		}else{
			set_site_transient('stm_auth_notice', $return['message'] );
			delete_site_transient('stm_theme_auth');
			return false;
		}
	}

	return $has_t;
}

function get_package( $item, $ftype ){

	$packages = array();

	$src = get_transient( 'stm_installer_package' );
	if ( false !== $src ) {
		if ( !empty($src[$item]) ) return $src[$item];
		$packages = $src;
	}

	$creds = stm_get_creds();
	$api_args = array(
		'theme' => STM_ITEM_NAME,
		't' => $creds['t'],
		'item' => $item,
		'ftype' => $ftype,
		'host' => $creds['host'],
	);

	$src = add_query_arg( $api_args, STM_API_URL . 'getpackage/');
	$packages[$item] = $src;
	set_transient( 'stm_installer_package', $packages, 300 );

	return $src;
}


function stm_set_creds() {
	if(isset($_POST['stm_registration'])) {
		if(isset($_POST['stm_registration']['token'])) {
			delete_site_transient('stm_theme_auth');
			delete_transient( 'stm_installer_package' );

			$token = array();
			$token['token'] = sanitize_text_field($_POST['stm_registration']['token']);

			update_option('envato_market', $token);

			$check_auth = stm_check_auth();
			if( !empty($check_auth) ){
				$envato_market = Envato_Market::instance();
				$envato_market->items()->set_themes(true);
			}
		}
	}
}

add_action('init', 'stm_set_creds');

function homepress_convert_memory($size)
{
	$l = substr($size, -1);
	$ret = substr($size, 0, -1);
	switch (strtoupper($l)) {
		case 'P':
			$ret *= 1024;
		case 'T':
			$ret *= 1024;
		case 'G':
			$ret *= 1024;
		case 'M':
			$ret *= 1024;
		case 'K':
			$ret *= 1024;
	}
	return $ret;
}

function homepress_theme_support_url()
{
	return esc_url('https://stylemixthemes.com/');
}

function homepress_get_admin_images_url($image) {
	return esc_url(get_template_directory_uri() . '/inc/admin/product_registration/assets/img/' . $image);
}


function homepress_get_theme_info()
{
	$theme = wp_get_theme();
	$theme_name = $theme->get('Name');
	$theme_v = $theme->get('Version');

	$theme_info = array(
		'name' => $theme_name,
		'slug' => sanitize_file_name(strtolower($theme_name)),
		'v'    => $theme_v,
	);

	return $theme_info;
}

