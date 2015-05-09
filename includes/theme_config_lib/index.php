<?php
/*
Theme Configuration Reader Library
Author: Brent Jett
*/

require_once 'theme_supports.php';

// Setup the global var to hold the config object
add_action('after_setup_theme', function() {

	$basset_theme_config_paths = apply_filters('basset/config_paths', array(get_stylesheet_directory() . '/config.json'));
	$GLOBALS['basset_theme_config_paths'] = $basset_theme_config_paths;

	foreach($basset_theme_config_paths as $path) {
		basset_config($path);
	}
});

function basset_config($file) {

	$config = '';

	if (file_exists($file)) {
		$contents = file_get_contents($file);
		if ($data = json_decode($contents)) {
			// Kick off config tasks
			do_action('basset/theme_config', $data, $file);
		} else {
			return new WP_Error( 'broke', __( "Couldn't Decode as JSON", "basset" ) );
		}
	} else {
		return new WP_Error( 'no-file', __( "File Doesn't Exist", "basset" ) );
	}

	return $config;
}

// Setup config tasks
add_action('basset/theme_config', function($config, $file) {

	do_action('basset/theme_config/theme_supports', $config, $file);
	// add image sizes
	do_action('basset/theme_config/nav_menus', $config, $file);
	// register sidebars
	// register custom post types
	// register custom taxonomies

	add_action('wp_enqueue_scripts', function() use ($config, $file) {
		do_action('basset/theme_config/stylesheets', $config, $file);
	}, 10, 2);

	add_action('wp_head', function() use($config, $file) {
		do_action('basset/theme_config/meta_tags', $config, $file);
	}, 10, 2);

}, 0, 2);


// Original config file
function basset_get_theme_config() {
	global $basset_theme_config;

	if (empty($basset_theme_config)) {
		if (file_exists($basset_theme_config_path)) {
			$contents = file_get_contents($basset_theme_config_path);
			$basset_theme_config = apply_filters('basset/theme_config/init', json_decode($contents));
		}
	}
	return $basset_theme_config;
}




// Enqueue Front-Side Scripts & Stylesheets
add_action('basset/theme_config/stylesheets', function($config, $file) {

	// Enqueue Scripts
	if (!empty($config->scripts)) {
		foreach($config->scripts as $handle => $meta) {
			basset_enqueue('script', $handle, $meta);
		}
	}

	// Enqueue Stylesheets
	if (!empty($config->styles)) {
		foreach($config->styles as $handle => $meta) {
			basset_enqueue('style', $handle, $meta);
		}
	}
}, 10, 2);

// Add Meta Tags To <head>
add_action('basset/theme_config/meta_tags', function($config, $file) {
	if (!empty($config->meta_tags)) {

		print "\n<!-- Basset Enqueued Meta Tags -->\n";
		foreach($config->meta_tags as $name => $data) {

			$charset = $http_equiv = $content = null;

			if ($name) {
				$name = "name='$name' ";
			}
			if (is_string($data)) {
				$content = "content='$data' ";
			}
			if (is_object($data) && !empty($data)) {
				if (!empty($data->content)) {
					$content = "content='$data->content' ";
				}
				if (!empty($data->charset)) {
					$charset = "charset='$data->charset' ";
				}
				if (!empty($data->{'http-equiv'})) {
					$http_equiv = "http-equiv='" . $data->{'http-equiv'} . "' ";
				}
			}
			print "<meta " . $name . $charset . $http_equiv . $content . ">\n";
		}

		print "<!-- End Basset Enqueued Meta Tags -->\n\n";
	}
}, 10, 2);

function basset_enqueue($type, $handle, $data = null) {
	if ($type == 'script') {
		if (empty($data)) {
			wp_enqueue_script($handle);
		} else {
			$in_footer = null;
			wp_enqueue_script($handle, get_stylesheet_directory_uri() . '/' . $data->path);
		}
	}

	if ($type == 'style') {
		if (empty($data)) {
			wp_enqueue_style($handle);
		} else {
			wp_enqueue_style($handle, get_stylesheet_directory_uri() . '/' . $data->path);
		}
	}
}

// Setup Nav Menu Locations
add_action('basset/theme_config/nav_menus', function($config, $file) {

	if (!empty($config->nav_menus)) {
		foreach($config->nav_menus as $handle => $label) {
			register_nav_menu($handle, $label);
		}
	}
}, 10, 2);




// Setup Customizer Fields
add_action('customize_register', function($wp_customize) {

	$config = basset_get_theme_config();

	// loop over customizer config and setup fields.

});

?>
