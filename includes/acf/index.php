<?php 

// Custom JSON Load
add_filter('acf/settings/load_json', function($paths) {

	$basset_json = get_template_directory() . '/includes/acf/basset-json';
	if (is_dir($basset_json)) {
		$paths[] = $basset_json;
	}
	return $paths;
});


// Custom Options Pages
if(function_exists('acf_add_options_sub_page')) {
	acf_add_options_sub_page(array(
	    'title' => 'Business Information',
	    'parent' => 'options-general.php'
	));
	acf_add_options_sub_page(array(
	    'title' => 'Settings',
	    'parent' => 'themes.php'
	));
}

// Update config file when settings change (Appearance -> Settings)

// Update every time each field changes - BAD IDEA, DON'T DO THIS!
$config_fields = array();
//add_filter('acf/update_value/name=my_select', function($value, $post_id, $field) {}, 10, 3);

// Priority 1-9 = before save, 11+ = after save
add_action('acf/save_post', function($post_id) {
	if ($post_id == 'options' && !empty($_POST['acf'])) {
		/*
		Array
		(
		    [field_551daeb959e99] => 1
		    [field_551da6cce95b8] => Array
		        (
		            [0] => search-form
		            [1] => comment-form
		            [2] => comment-list
		            [3] => gallery
		            [4] => caption
		            [5] => widgets
		        )
		
		    [field_551da8da0c1ec] => Array
		        (
		            [0] => status
		            [1] => quote
		            [2] => gallery
		            [3] => chat
		        )
		
		    [field_551da7ebb7583] => 0
		    [field_551dab014a7e8] => 0
		    [field_551db3f2b0dbd] => 0
		    [field_551db44df1999] => 0
		    [field_551db95221ab8] => Array
		        (
		            [0] => Array
		                (
		                    [field_551db97528c8e] => Header
		                    [field_551db95e28c8d] => header
		                )
		
		            [1] => Array
		                (
		                    [field_551db97528c8e] => Footer
		                    [field_551db95e28c8d] => footer
		                )
		
		        )
		
		    [field_551dba0af2ba6] => 
		)
		*/
	}
});
?>