<?php 
/*
[basset_cta] Call-To-Action shortcode.

This shortcode is available from the "Add Media" modal dialog when the Shortcake UI plugin is active.
*/
add_action('init', function() {

	$shortcode_details = array(
		'label' => 'Inline Call-to-Action',
		'listItemImage' => 'dashicons-editor-insertmore',
		'inner_content' => array(
			'label' => 'Content'
		),
		'attrs' => array(
			array(
                'label' => 'Link',
                'attr'  => 'link_url',
                'type'  => 'url',
                'meta' => array(
                	'size' => '80'
                )
            ),
		)
	);
	add_shortcode('basset_cta', 'basset_print_cta_shortcode');
	shortcode_ui_register_for_shortcode('basset_cta', $shortcode_details);
});

function basset_print_cta_shortcode($args, $content = '', $tag) {
	$defaults = array(
		'url' => false
	);
	$args = wp_parse_args($args, $defaults);
	ob_start();
	$content = do_shortcode($content);
	?>
	<div class="basset-inline-cta"><?=$content?></div>
	<?php
	return ob_get_clean();
}
?>