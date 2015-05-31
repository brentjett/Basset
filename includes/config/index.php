<?php
/*
Theme configuration reader.
Implments wp-theme-config library.
*/
require_once 'wp-theme-configuration/index.php';


// Setup the global var to hold the config object
add_action('after_setup_theme', function() {

	$basset_theme_config_paths = apply_filters('basset/config_paths', array(get_stylesheet_directory() . '/config.json'));
	$GLOBALS['basset_theme_config_paths'] = $basset_theme_config_paths;

	foreach($basset_theme_config_paths as $path) {
		basset_config($path);
	}
});
?>
