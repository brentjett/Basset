<?php 
function custom_theme_features()  {

	// Add theme support for Automatic Feed Links
	add_theme_support( 'automatic-feed-links' );

	// Add theme support for Post Formats
	add_theme_support( 'post-formats', array( 'status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat' ) );

	// Add theme support for Featured Images
	add_theme_support( 'post-thumbnails', array( 'post', ' page', ' movie' ) );

	 // Set custom thumbnail dimensions
	set_post_thumbnail_size( 300, 350, true );

	// Add theme support for Custom Background
	$background_args = array(
		'default-color'          => 'color',
		'default-image'          => 'image',
		'default-repeat'         => 'repeat',
		'default-position-x'     => 'pos-x',
		'wp-head-callback'       => 'head_callback',
		'admin-head-callback'    => 'admin_head_callback',
		'admin-preview-callback' => 'admin_preview_callback',
	);
	add_theme_support( 'custom-background', $background_args );

	// Add theme support for Custom Header
	$header_args = array(
		'default-image'          => 'default/image',
		'width'                  => 300,
		'height'                 => 200,
		'flex-width'             => true,
		'flex-height'            => true,
		'uploads'                => true,
		'random-default'         => true,
		'header-text'            => true,
		'default-text-color'     => 'header_text_color',
		'wp-head-callback'       => 'head_callback',
		'admin-head-callback'    => 'admin_head_callback',
		'admin-preview-callback' => 'admin_preview_callback',
	);
	add_theme_support( 'custom-header', $header_args );

	// Add theme support for HTML5 Semantic Markup
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Add theme support for document Title tag
	add_theme_support( 'title-tag' );

	// Add theme support for custom CSS in the TinyMCE visual editor
	add_editor_style( 'editor-stylesheet' );

	// Add theme support for Translation
	load_theme_textdomain( 'theme_domain', get_template_directory() . '/path/to/.mo' );
}




$args = array(
		'id'            => 'default',
		'name'          => __( 'Default Sidebar', 'text_domain' ),
		'description'   => __( 'This is a sidebar boring boring', 'text_domain' ),
		'class'         => 'Sidebar-class',
		'before_title'  => '<before>',
		'after_title'   => '</after>',
		'before_widget' => '<before_widget>',
		'after_widget'  => '</after_widget>',
	);
	register_sidebar( $args );
?>