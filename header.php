<?php get_template_part('head') ?>

<? // Insert Header Nav 
wp_nav_menu(
	array(
		'container' => 'nav', 
		'container_class' => 'horizontal-nav collapse-nav',
		'theme_location' => 'header',
		'fallback_cb' => 'basset_nav_menu_fallback'
	)
); 
?>