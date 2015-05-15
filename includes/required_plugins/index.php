<?php
/*
The TGM Activation library allows the theme to require or suggest plugins that it needs.
*/
require_once 'class-tgm-plugin-activation.php';

add_action('tgmpa_register', function() {
    $plugins = array(

        array(
            'name' => 'Shortcake (Shortcode UI)',
            'slug' => 'shortcode-ui',
            'required' => true
        )
        /*,
        array(
            'name' => 'Content Snippets',
            'slug' => 'brj-content-shortcodes',
            'required' => false,
            'external_url' => 'http://wp-updates.com/download/plugin/1297'
        )
        */
    );
    $config = array(
        'has_notices'  => true,
        'dismissable'  => true,
        'parent_slug'  => 'plugins.php', // Parent menu slug.
        'strings' => array(
            'page_title' => __( 'Install Required Plugins', 'basset' ),
			'menu_title' => __( 'Required Plugins', 'basset' ),
        )
    );
    tgmpa( $plugins, $config );
});
?>
