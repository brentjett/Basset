<?php 
/*
Add .less file support to wp_enqueue_style()
*/

require_once 'wp-less.php';
/*
add_filter('less_vars', function($vars) {
	return $vars;
});
*/

/*
Compiler Hooks

less_force_compile
less_compression
less_preserve_comments - Doesn't seem to work
less_import_dirs
*/
/*
add_filter('less_import_dirs', function($dirs) {
	return $dirs;
});
*/

/*
add_filter('less_compression', function($compression) {
	// Uncompressed = classic
	// Default = uncompressed
	return $compressed;
});
*/

// Use for dev/debug
//add_filter('less_force_compile', __return_true);


//add_filter('less_save_css', function($css_path = '', $file_contents = '') { });
?>