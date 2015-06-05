<?php
/*
Theme configuration reader.
Implments wp-theme-config library.
*/
require_once 'wp-theme-configuration/index.php';

/*
Configure the theme config API

API accepts file paths to look for config files.
*/
add_filter('config/paths', function($paths) {
	global $basset;
	$paths = apply_filters('basset/theme_config_paths', array(get_stylesheet_directory() . '/config.json'));
	$basset->config_paths = $paths; // for inspector
	return $paths;
});
?>
