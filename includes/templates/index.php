<?php

$template_stack = array();

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

add_filter('template_include', function($template) {

	$template = basset_enqueue_templates($template);

	return $template;
});

add_action('basset/render_template', function() {
	global $template_stack;
	if ($template = $template_stack[0]) {
		include $template;
		unset($template_stack[0]);
	}
});

function basset_enqueue_templates($template) {
	global $template_stack;
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

?>