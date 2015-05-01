<?php
/*
Annoucement Bar
*/

add_action('wp_enqueue_scripts', function() {
	wp_enqueue_style('message-bar', get_template_directory_uri() . '/includes/components/messages/message-bar.less');
});

add_action('customize_preview_init', function() {
	wp_enqueue_script('message-customizer', get_template_directory_uri() . '/includes/components/messages/message-customizer.js', array('customize-preview'));
});

add_filter('less_vars', function($vars, $handle) {
	
	// Scope vars to message bar stylesheet
	/*
	if ($handle == 'message-bar') {
		$vars['bar_color'] = get_theme_mod('basset_bar_bg');
	}
	*/
	return $vars;
	
}, 10, 2);

add_action('customize_register', function($wp_customize) {
	
	$wp_customize->add_setting( 'basset_bar_bg' , array('default' => '', 'transport' => 'postMessage'));
	
	$wp_customize->add_section( 'basset_message_bar' , array(
	    'title'      => __( 'Announcement Bar', 'basset' ),
	    'priority' => 50
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'basset_bar_bg', 
			array(
				'label' => 'Background Color', 
				'section' => 'basset_message_bar',
				'settings' => 'basset_bar_bg'
			)
		)
	);
	
});
?>