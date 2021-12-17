<?php
if ( ! defined( 'ABSPATH' ) ) exit;

foreach (scandir(HOMEPRESS_DEMO_IMPORT_PATH.'/includes/classes/') as $key => $value) {
	if ( strpos($value, '.php') )
		$files_homepress_demo_import[] = 'includes/classes/'.$value;
}

$files_homepress_demo_import[] = 'includes/init.php';
$files_homepress_demo_import[] = 'includes/install.php';

foreach ( $files_homepress_demo_import as $file ) {
	if(file_exists(HOMEPRESS_DEMO_IMPORT_PATH."/{$file}")){
		require_once HOMEPRESS_DEMO_IMPORT_PATH."/{$file}";
	}
}

