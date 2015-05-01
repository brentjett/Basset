<?php 
// Zone Rendering Library

// When a zone is called, find the views to fill it
function basset_zone($handle, $label = '', $args = array()) {
	do_action('basset/before_render_zone/{$handle}');
	
	//$components = get_components_for_zone($handle, $args);
	
	do_action('basset/after_render_zone/{$handle}');
}

function get_components_for_zone($handle, $args = array()) {
	// check json file and look for handle
	$components = basset_get_components();
	
	// from all the components, find the ones for this zone
	
	return array();
}

function basset_get_components() {
	$path = get_stylesheet_directory() . '/zones.json';
	
	$contents = file_get_contents($path);
	$contents = utf8_encode($contents);
	$components = json_decode($contents);
}
?>