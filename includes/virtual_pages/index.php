<?php
/*
Virtual Pages

These pages are generated automatically, but are not actual posts in the database. These are primarily for displaying page styling.
*/

add_action('after_setup_theme', function() {

    add_rewrite_rule(
        'styleguide/?',
        'index.php?post_type=style&virtual_page=styleguide',
        'top'
    );

});

add_action('wp_enqueue_scripts', function() {
    if (is_styleguide()) {
        wp_enqueue_style('basset-styleguides', get_template_directory_uri() . '/libraries/styleguides/styleguides.less');
        wp_enqueue_script('basset-styleguides', get_template_directory_uri() . '/libraries/styleguides/styleguides.js', array('jquery'));
    }
});

add_action('wp_print_scripts', function() {
    global $wp_scripts, $wp_styles;

    if (is_styleguide()) {
        $GLOBALS['basset_registered_styles'] = $wp_styles->registered;
        $GLOBALS['basset_enqueued_styles'] = $wp_styles->queue;
    }
});

add_filter( 'query_vars', function($vars) {
    $vars[] = "virtual_page";
    return $vars;
});

add_filter('the_posts', function($posts) {
    global $wp, $wp_query;

    if (is_styleguide()) {

        $title = 'Style Guide';
        ob_start();
        require get_template_directory() . '/styleguide/main.php';
        $content = ob_get_clean();

        $p = new stdClass;

    	$p->ID = -1;
    	$p->post_author = 1;
    	$p->post_date = current_time('mysql');
    	$p->post_date_gmt =  current_time('mysql', $gmt = 1);
    	$p->post_content = $content;
    	$p->post_title = $title;
    	$p->post_excerpt = '';
    	$p->post_status = 'publish';
    	$p->ping_status = 'closed';
    	$p->post_password = '';
    	$p->post_name = 'styleguide'; // slug
    	$p->to_ping = '';
    	$p->pinged = '';
    	$p->modified = $p->post_date;
    	$p->modified_gmt = $p->post_date_gmt;
    	$p->post_content_filtered = '';
    	$p->post_parent = 0;
    	$p->guid = get_home_url('/' . $p->post_name); // use url instead?
    	$p->menu_order = 0;
    	$p->post_type = 'page';
    	$p->post_mime_type = '';
    	$p->comment_status = 'closed';
    	$p->comment_count = 0;
    	$p->filter = 'raw';
    	$p->ancestors = array(); // 3.6

        // reset wp_query properties to simulate a found page
    	$wp_query->is_page = TRUE;
    	$wp_query->is_singular = TRUE;
    	$wp_query->is_home = FALSE;
    	$wp_query->is_archive = FALSE;
    	$wp_query->is_category = FALSE;

    	unset($wp_query->query['error']);
    	$wp->query = array();
    	$wp_query->query_vars['error'] = '';
    	$wp_query->is_404 = FALSE;

    	$wp_query->current_post = $p->ID;
    	$wp_query->found_posts = 1;
    	$wp_query->post_count = 1;
    	$wp_query->comment_count = 0;
    	// -1 for current_comment displays comment if not logged in!
    	$wp_query->current_comment = null;

    	$wp_query->post = $p;
    	$wp_query->posts = array($p);
    	$wp_query->queried_object = $p;
    	$wp_query->queried_object_id = $p->ID;

        $posts = array($p);

    }
    return $posts;
});

// Remove Edit Menu Item on static pages
add_action( 'admin_bar_menu', function($wp_admin_bar) {
    if (is_styleguide()) {
        $wp_admin_bar->remove_node( 'edit' );
    }
}, 999 );

add_action('basset/styleguide/utility_bar', function() {
    global $basset_enqueued_styles;
    ?>
    <div id="basset-styleguide-utility-bar">
        <div>Enqueued Stylesheets</div>
        <?
        if (!empty(basset_enqueued_styles)) {
            foreach($basset_enqueued_styles as $style) {
                print "<div><input value='$style' type='checkbox' checked> $style</div>";
            }
        }
        ?>
    </div>
    <?php
});

add_action('wp_footer', function() {
    if (is_styleguide()) {
        do_action('basset/styleguide/utility_bar');
    }
});

function is_styleguide() {
    if (get_query_var('virtual_page') == 'styleguide') {
        return true;
    }
}
?>
