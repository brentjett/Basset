<?php

/* Moved to template inspector
add_action( 'wp_before_admin_bar_render', function() {
	global $wp_admin_bar, $template;

	if ($template) {
		$args = array(
			'id'     => 'basset_template',
			'title'  => __( 'Template: ' . basename($template), 'basset' ),
			'meta'   => array(),
		);
		$wp_admin_bar->add_menu( $args );
	}
});
*/

// Template Enqueue Concept
// Initial support for wrapper templates and enqueuing scripts and stylesheets from template comments

add_filter('template_include', function($template) {

	$template = apply_filters('basset/enqueue_template', $template);
	return $template;
});

add_filter('basset/enqueue_template', function($template) {

	$headers = get_file_data($template, array(
		'template' => 'Template Name',
		'part_name' => 'Template Part Name',
		'name' => 'Name',
		'description' => 'Description',
		'styles' => 'Stylesheets',
		'scripts' => 'Scripts'
	));

	// Enqueue pre-registered stylesheets by handle (the name given when registering)
	$styles = array();
	if ($styles = $headers['styles']) {
		$styles = explode(',', $styles);
	}

	$scripts = array();
	if ($scripts = $headers['scripts']) {
		$scripts = explode(',', $scripts);
	}

	add_action('wp_enqueue_scripts', function() use ($styles, $scripts) {
		if (!empty($styles) && is_array($styles)) {
			foreach($styles as $style) {
				wp_enqueue_style($style);
			}
		}
		if (!empty($scripts) && is_array($scripts)) {
			foreach($scripts as $script) {
				wp_enqueue_script($script);
			}
		}
	});

	return $template;
});


// Enqueue Template Parts - Check template parts for script and stylesheet dependencies
function basset_enqueue_template_part($slug, $name = '') {

	// Determine Template Names
	// This is an exact duplicate of how get_template_part setups up the template names array - general-template.php Line 164
	$templates = array();
	$name = (string) $name;
	if ( '' !== $name ) $templates[] = "{$slug}-{$name}.php";
	$templates[] = "{$slug}.php";

	// Determine the file (same way WordPress does). $load = false, $require_once = false
	$template = locate_template($templates, false, false);
	$template = apply_filters('basset/enqueue_template', $template);

	return $template;
}
// Setup to watch template parts
add_action('init', function() {

	// Watch all built-in template parts - get_header(), get_footer(), get_sidebar()
	$builtin_actions = array(
		'header' => 'get_header',
		'footer' => 'get_footer',
		'sidebar' => 'get_sidebar',
		'searchform' => 'pre_get_search_form'
	);
	foreach($builtin_actions as $part_name => $action) {
		add_action($action, function($variation_name = '') use ($part_name) {
			basset_enqueue_template_part($part_name, $variation_name);
		});
	}

	// Register to enqueue template parts called with get_template_part();
	$parts = apply_filters('basset/enqueue_template_parts', array('header', 'footer', 'sidebar'));
	if (!empty($parts)) {
		foreach($parts as $part) {
			add_action("get_template_part_{$part}", 'basset_enqueue_template_part', 10, 2);
		}
	}
});


/*
Wrapper Rendering System

$template_stack = array();
add_action('basset/render_template', function() {
	global $template_stack;
	if ($template = $template_stack[0]) {
		include $template;
		unset($template_stack[0]);
	}
});
*/

/*
function basset_enqueue_template($template) {
	//global $template_stack;
	if (file_exists($template)) {
		$headers = get_file_data($template, array(
			'template' => 'Template Name',
			'styles' => 'Styles',
			'scripts' => 'Scripts',
			'wrapper' => 'Wrapper Template'
		));

		// if there are stylessheets
		// if there are scripts


		if ($wrapper = $headers['wrapper']) {
			$template_stack[] = $template;

			// try to find the file
			$current_template_directory = dirname($template) . '/';
			if (file_exists($current_template_directory . $wrapper)) {

				$template = basset_enqueue_templates($current_template_directory . $wrapper);
				return $template;
			} else {
				// check other directories
			}
		} else {
			return $template;
		}
	}

}
*/
?>
