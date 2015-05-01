<?php 
/*
Theme Configuration Reader Library
Version: 0
Author: Brent Jett
*/

if (!defined(BASSET_CONFIG_PATH)) {
	define('BASSET_CONFIG_PATH', get_stylesheet_directory() . '/config.json');
} else {
	print "Basset config path is not defined";
}

// Setup the global var to hold the config object
add_action('init', function() {
	$GLOBALS['basset_theme_config'] = '';
});



function basset_get_theme_config() {
	global $basset_theme_config;
	
	if (empty($basset_theme_config)) {
		if (file_exists(BASSET_CONFIG_PATH)) {
			$contents = file_get_contents(BASSET_CONFIG_PATH);
			$basset_theme_config = apply_filters('basset/theme_config/init', json_decode($contents));
		}
	}
	return $basset_theme_config;
}


require_once 'theme_supports.php';




// Enqueue Front-Side Scripts & Stylesheets
add_action('wp_enqueue_scripts', function() {
	$config = basset_get_theme_config();
	
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
});

// Add Meta Tags To <head>
add_action('wp_head', function() {
	$config = basset_get_theme_config();
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
}, 1);

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
add_action('after_setup_theme', function() {
	$config = basset_get_theme_config();
	if (!empty($config->nav_menus)) {
		foreach($config->nav_menus as $handle => $label) {
			register_nav_menu($handle, $label);
		}
	}
});




// Setup Customizer Fields
add_action('customize_register', function($wp_customize) {
	
	$config = basset_get_theme_config();
	
	// loop over customizer config and setup fields.
	
});

?>