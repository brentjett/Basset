<?php 

require_once 'cta/index.php';
//require_once 'messages/index.php';


/* Include styling in editor */
add_action('admin_init', function() {
	//add_editor_style(...);
});
add_action('wp_enqueue_scripts', function() {
	//wp_enqueue_style('basset-cta', get_template_directory_uri() . '/includes/components/cta/cta.less');
});



// Add [basset_phone] shortcode
add_action('init', function() {
	
	$phone_shortcode_details = array(
		'label' => 'Primary Phone Number',
		'listItemImage' => 'dashicons-phone',
		'attrs' => array(
			array(
				'label' => 'Phone Number',
				'attr'  => 'phone_number',
				'type'  => 'text',
				'placeholder' => get_field('primary_phone_number', 'option'),
				'description' => 'Leave blank to use default number (See Settings -> Business Information)'
			),
			array(
				'label' => 'Disable Link',
				'attr' => 'disable_link',
				'type' => 'checkbox',
				'description' => 'You can choose to wrap the number in a span rather than an anchor tag.'
			),
			array(
				'label' => 'Number Only?',
				'attr' => 'number_only',
				'type' => 'checkbox',
				'description' => 'Only return the phone number without any HTML formatting'
			)
		)
	);
	// TEMPORARILY DISABLED - Shortcode UI Plugin treats all shortcodes like block elements
	//shortcode_ui_register_for_shortcode('basset_phone', $phone_shortcode_details);
	
	function basset_print_phone_shortcode($args, $content = "", $tag = 'basset_phone') {
		$default_phone = get_field('primary_phone_number', 'option');
		
		$args = wp_parse_args($args, array(
			'phone_number' => apply_filters('basset/primary_phone', $default_phone),
			'disable_link' => false,
			'number_only' => false
		));
		$phone = $args['phone_number'];
		if ($args['number_only']) {
			return $phone;
		} else {
			if ($args['disable_link']) {
				$classes = apply_filters('basset/phone_link_classes', array('phonenumber'));
				$class_string = implode(' ', $classes);
				$phone = "<span class='$class_string'>$phone</span>";
			} else {
				$classes = apply_filters('basset/phone_link_classes', array('phonenumber', 'phonelink'));
				$class_string = implode(' ', $classes);
				$href = preg_replace('/\D+/', '', $phone);
				$phone = "<a href='tel:$href' class='$class_string'>$phone</a>";
			}
			return $phone;
		}
	}
	add_shortcode('basset_phone', 'basset_print_phone_shortcode');
	add_action('basset/phone', 'basset_print_phone_shortcode', 10, 3);
});

// [basset_business] - Return the name of the business
// [basset_email] - Return a mailto: link for the default email address, including subject, cc, bcc, & body text
// [basset_hours] - View a list of store hours for business. Args: Heading text
// [basset_quote] = Insert a blockquote with a citation, source name, source url
// social icons - DONT USE YOAST

// [basset_quote] Shortcode
add_action('init', function() {
	
	$quote_shortcode_details = array(
		'label' => 'Customer Review',
		'listItemImage' => 'dashicons-editor-quote',
		'inner_content' => array(
			'label' => 'Block Quote'
		),
		'attrs' => array(
			array(
				'label' => 'Citation',
				'attr'  => 'cite',
				'type'  => 'text',
				'placeholder' => __('Sandy and Rosco, Atlanta,GA', 'basset'),
				'description' => __('The author or origin of the quote', 'basset'),
				'meta' => array(
                	'size' => '80'
                )
			),
			array(
				'label' => 'Source',
				'attr'  => 'source',
				'type'  => 'text',
				'placeholder' => __('Facebook Review', 'basset'),
				'description' => __('The publication or website the quote was published on', 'basset'),
				'meta' => array(
                	'size' => '80'
                )
			)
		)
	);
	shortcode_ui_register_for_shortcode('basset_quote', $quote_shortcode_details);
	
	function basset_print_quote_shortcode($args, $content = "", $tag) {
		ob_start();
		?>
		<blockquote class="basset-quote">
			<div><?=$content?></div>
			<? if ($args['cite']) { ?>
			<footer><?=$args['cite']?></footer>
			<? } ?>
		</blockquote>
		<?php
		return ob_get_clean();
	}
	add_shortcode('basset_quote', 'basset_print_quote_shortcode');
});


/*
Add support for Wordpress SEO by Yoast plugin features.
- Use Yoast Social profiles for displaying icons
*/

add_filter('basset/social_urls', function($profiles) {
	
	$profiles['facebook']['url'] = 'http://facebook.com';
	$profiles['twitter']['url'] = 'http://twitter.com';
	$profiles['youtube']['url'] = 'http://youtube.com';
	$profiles['instagram']['url'] = 'http://instagram.com';
	$profiles['pinterest']['url'] = 'http://pinterest.com';
	$profiles['email']['url'] = 'mailto:info@whatever.com';
	$profiles['rss']['url'] = '/feed';

	return $profiles;
});

// Add Social Icons as Action and Shortcode
add_action('init', function() {

	$details = array(
		'label' => 'Customer Review',
		'listItemImage' => 'dashicons-editor-quote',
		'inner_content' => array(
			'label' => 'Block Quote'
		),
		'attrs' => array(
			array(
				'label' => 'Citation',
				'attr'  => 'cite',
				'type'  => 'text',
				'placeholder' => __('Sandy and Rosco, Atlanta,GA', 'basset'),
				'description' => __('The author or origin of the quote', 'basset'),
				'meta' => array(
                	'size' => '80'
                )
			),
			array(
				'label' => 'Source',
				'attr'  => 'source',
				'type'  => 'text',
				'placeholder' => __('Facebook Review', 'basset'),
				'description' => __('The publication or website the quote was published on', 'basset'),
				'meta' => array(
                	'size' => '80'
                )
			)
		)
	);
	shortcode_ui_register_for_shortcode('basset_social_icons', $details);

	function basset_print_social_icons($args = array(), $content = '', $tag = 'basset_social_icons') {
		$services = apply_filters('basset/social_urls', array(
			'facebook' => array( 'icon' => get_template_directory_uri() . '/libraries/images/icon-facebook.svg' ),
			'twitter' => array( 'icon' => get_template_directory_uri() . '/libraries/images/icon-twitter.svg' ),
			'youtube' => array( 'icon' => get_template_directory_uri() . '/libraries/images/icon-youtube.svg' ),
			'instagram' => array( 'icon' => get_template_directory_uri() . '/libraries/images/icon-instagram.svg' ),
			'pinterest' => array( 'icon' => get_template_directory_uri() . '/libraries/images/icon-pinterest.svg' )
		));
		if (!empty($services)) {
			?>
			<div class="basset-social-icons">
				<? do_action('basset/before_print_social_icons') ?>
				<? foreach($services as $handle => $profile) { if ($url = $profile['url']) { ?>
				<a href="<?=$url?>" data-small-icon="<?=$handle?>" target='_blank'><img src="<?=$profile['icon']?>"></a>
				<? } } ?>
				<? do_action('basset/after_print_social_icons') ?>
			</div>
			<?
		}
	}
	add_shortcode('basset_social_icons', 'basset_print_social_icons');
	add_action('basset/social_icons', 'basset_print_social_icons', 10, 3);
});


/*
Footnotes
This adds a text footnotes option. Print this component using the basset/footnotes action
*/
function basset_print_footnotes() {
	if (function_exists('get_field')) {
		$footnotes = get_field('basset_footnotes', 'options');
	} else {
		$footnotes = get_option('basset_footnotes');
	}
	if ($footnotes) {
	?>
	<div class="footnotes"><?=$footnotes?></div>
	<?
	}
}
add_action('basset/footnotes', 'basset_print_footnotes');
?>