<?php
/*
[basset_cta] Call-To-Action shortcode.

This shortcode is available from the "Add Media" modal dialog when the Shortcake UI plugin is active.
*/

/*
// How to add variations
add_filter('basset/inline_cta/variations', function($styles) {
	return array(
		'blue' => "Blue CTA"
	);
});
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
            array(
                'label' => 'CSS',
                'attr'  => 'style',
                'type'  => 'text',
                'meta' => array(
                	'size' => '120'
                )
            ),
            array(
                'label' => 'Classes',
                'attr'  => 'class',
                'type'  => 'text',
                'meta' => array(
                	'size' => '80'
                )
            )
		)
	);
	$cta_styles = apply_filters('basset/inline_cta/variations', array());
	if (!empty($cta_styles)) {
		$options = array(
			'default' => 'Default'
		);
		foreach($cta_styles as $handle => $label) {
			$options[$handle] = $label;
		}
		$shortcode_details['attrs'][] = array(
			'label' => 'Style Variations',
			'attr'  => 'variation',
			'type'  => 'select',
			'options' => $options
		);
	}

	add_shortcode('basset_cta', 'basset_print_cta_shortcode');
	if (function_exists('shortcode_ui_register_for_shortcode')) {
		shortcode_ui_register_for_shortcode('basset_cta', $shortcode_details);
	}
});

function basset_print_cta_shortcode($args, $content = '', $tag) {
	$defaults = array(
		'link_url' => null,
		'style' => null,
		'class' => null,
		'variation' => null
	);
	$args = wp_parse_args($args, $defaults);
	ob_start();

	// Add style="" attribute
	$style = '';
	if (isset($args['style'])) {
		$style = ' style="' . $args['style'] . '"';
	}

	// Add class="" attribute
	$classes = apply_filters('basset/inline_cta/classes', array('basset-inline-cta'));
	if (isset($args['variation'])) {
		$classes[] = $args['variation'];
	}
	if (isset($args['class'])) {
		$additional = explode(' ', $args['class']);
		$classes = array_merge($classes, $additional);
	}
	$classes = 'class="' . implode(' ', $classes) . '" ';

	// If URL, render <a> tag, else <div>
	if (isset($args['link_url'])) {
		$url = $args['link_url'];
		$open_tag = "<a href='$url' ";
		$close_tag = "</a>";
	} else {
		$open_tag = "<div ";
		$close_tag = "</div>";
	}
	$content = do_shortcode($content);

	print $open_tag . $classes . $style . '>' . $content . $close_tag;

	return ob_get_clean();
}

// Add Quicktag
function basset_add_cta_quicktag() {
    if (wp_script_is('quicktags')){
?>
    <script type="text/javascript">
    QTags.addButton( 'basset_inline_cta', 'CTA', '[basset_cta]', '[/basset_cta]', 'a', 'Call-to-action', 1 );
    </script>
<?php
    }
}
add_action( 'admin_print_footer_scripts', 'basset_add_cta_quicktag' );
?>
