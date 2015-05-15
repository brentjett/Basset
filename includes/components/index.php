<?php

// Inline Call-to-Action Component
require_once 'cta/index.php';


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
	// if (function_exists('shortcode_ui_register_for_shortcode')) {
	//shortcode_ui_register_for_shortcode('basset_phone', $phone_shortcode_details);
	// }

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
				$href = basset_strip_phone($phone);
				$phone = "<a href='tel:$href' class='$class_string'>$phone</a>";
			}
			return $phone;
		}
	}
	add_shortcode('basset_phone', 'basset_print_phone_shortcode');
	add_action('basset/phone', 'basset_print_phone_shortcode', 10, 3);
});

function basset_strip_phone($phone = '') {
	return preg_replace('/\D+/', '', $phone);
}

// [basset_business] - Return the name of the business
// [basset_email] - Return a mailto: link for the default email address, including subject, cc, bcc, & body text
// [basset_hours] - View a list of store hours for business. Args: Heading text
// [basset_quote] = Insert a blockquote with a citation, source name, source url


// [basset_quote] Shortcode
add_action('init', function() {

	$quote_shortcode_details = array(
		'label' => 'Block Quote',
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
			)
		)
	);

	$variations = apply_filters('basset/quote/variations', array());
	if (!empty($variations)) {
		$options = array(
			'default' => 'Default'
		);
		foreach($variations as $handle => $label) {
			$options[$handle] = $label;
		}
		$quote_shortcode_details['attrs'][] = array(
			'label' => 'Style Variations',
			'attr'  => 'variation',
			'type'  => 'select',
			'options' => $options,
			/*'meta' => array(
				'size' => 80
			)*/
		);
	}
	if (function_exists('shortcode_ui_register_for_shortcode')) {
		shortcode_ui_register_for_shortcode('basset_quote', $quote_shortcode_details);
	}

	function basset_print_quote_shortcode($args, $content = "", $tag) {

		// Add class="" attribute
		$classes = apply_filters('basset/quote/classes', array('basset-quote'));
		if ($args['variation']) {
			$classes[] = $args['variation'];
		}
		if ($args['class']) {
			$additional = explode(' ', $args['class']);
			$classes = array_merge($classes, $additional);
		}
		$classes = 'class="' . implode(' ', $classes) . '" ';

		ob_start();
		?>
		<blockquote <?=$classes?>>
			<div class="inner">
				<div><?=$content?></div>
				<? if ($args['cite']) { ?>
				<footer><?=$args['cite']?></footer>
				<? } ?>
			</div>
		</blockquote>
		<?php
		return ob_get_clean();
	}
	add_shortcode('basset_quote', 'basset_print_quote_shortcode');
});

add_filter('basset/quote/variations', function($variations) {
	$variations['full-width-section'] = "Full Width Section";
	return $variations;
});


// Add Social Icons as Action and Shortcode
add_action('init', function() {

	$icon = apply_filters('basset/social_icons_size', array(
		'name' => 'basset_social_icon',
		'width' => 37,
		'height' => 37,
		'crop' => true
	));
	add_image_size($icon['name'], $icon['width'], $icon['height'], $icon['crop']);

	$details = array(
		'label' => 'Social Icons',
		'listItemImage' => 'dashicons-editor-quote',
		'attrs' => array()
	);
	if (function_exists('shortcode_ui_register_for_shortcode')) {
		shortcode_ui_register_for_shortcode('basset_social_icons', $details);
	}

	function basset_print_social_icons($args = array(), $content = '', $tag = 'basset_social_icons') {
		$profiles = get_field('basset_profiles', 'option');

		$services = apply_filters('basset/profile_defaults', array(
			'facebook' => array( 'icon' => get_template_directory_uri() . '/libraries/images/icon-facebook.svg' ),
			'twitter' => array( 'icon' => get_template_directory_uri() . '/libraries/images/icon-twitter.svg' ),
			'youtube' => array( 'icon' => get_template_directory_uri() . '/libraries/images/icon-youtube.svg' ),
			'instagram' => array( 'icon' => get_template_directory_uri() . '/libraries/images/icon-instagram.svg' ),
			'pinterest' => array( 'icon' => get_template_directory_uri() . '/libraries/images/icon-pinterest.svg' ),
			'rss' => array( 'icon' => get_template_directory_uri() . '/libraries/images/icon-rss.svg' ),
			'email' => array( 'icon' => get_template_directory_uri() . '/libraries/images/icon-email.svg' ),
			'phone' => array( 'icon' => get_template_directory_uri() . '/libraries/images/icon-phone.svg' ),
		));

		if (!empty($profiles)) {
			?>
			<div class="basset-social-icons">
				<? do_action('basset/before_print_social_icons') ?>
				<?
				foreach($profiles as $item) {

					// If handle
					if (!$handle = $item['handle']) {
						$handle = $item['acf_fc_layout'];
					}

					$target="target='_blank'";
					if ($handle == 'phone' || $handle == 'email') {
						$target = null;
					}

					// If there's no url, don't display item
					$url = apply_filters('basset/social_icon_url', $item['url'], $handle);
					if (!$url) continue;

					if (!$icon = $item['icon']['sizes']['basset_social_icon']) {
						$icon = $services[$handle]['icon'];
					}
					if (!$icon) continue;

					?>
					<a href="<?=$url?>" data-small-icon="<?=$handle?>" <?=$target?> title="<?=$item['message']?>"><img src="<?=$icon?>" alt="<?=$item['message']?>"></a>
					<?
				}
				?>
				<? do_action('basset/after_print_social_icons') ?>
			</div>
			<?
		}
	}
	add_shortcode('basset_social_icons', 'basset_print_social_icons');
	add_action('basset/social_icons', 'basset_print_social_icons', 10, 3);
});

add_filter('basset/social_icon_url', function($url, $handle = '') {
	if ($handle == 'email') {
		if (!$url) {
			$url = get_field('email_address', 'option');
		}
		$url = "mailto:$url";
	}
	if ($handle == 'phone') {
		if ($url) $phone_number = "phone_number='$url'";
		$number = basset_strip_phone(do_shortcode('[basset_phone number_only=true ' . $phone_number . ']'));
		if ($number) {
			$url = 'tel:' . $number;
		}
	}
	return $url;
}, 10, 2);


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

/*
Mobile Location Block
*/
add_action('init', function() {

	function basset_print_location_block($args = array(), $content = '', $tag = '') {
		ob_start();
		?>
		<div class="basset-location-block">
			<div class="details">
				<p class="location-address"><?=basset_get('location_address')?></p>

				<?php
				$phones = basset_get('location_phones');
				if (!empty($phones)) {
				?>
				<div class="location-phones">
					<? foreach($phones as $phone) {
						if ($type = $phone['type']) $type = "$type: ";
					?>
					<div><strong><?=$type?></strong><?=$phone['number']?></div>
					<? } ?>
				</div>
				<? } ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
	add_shortcode('basset_location_block', 'basset_print_location_block');
	add_action('basset/location_block', function() {
		print basset_print_location_block();
	}, 10, 3);
});


add_action('init', function() {

	function basset_print_section_shortcode($args = array(), $content = '', $tag = '') {

	}
	add_shortcode('basset_section', 'basset_print_section_shortcode');
});
?>
