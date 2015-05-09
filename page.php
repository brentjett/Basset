<?php
/*
Name: Default Page
Stylesheets: basset-layouts
*/
get_header();
?>

<main class="basset-container">

	<article <? post_class() ?>>
		<?php
		    if ( have_posts() ) :
		        while ( have_posts() ) :
		            the_post();
		            print "<h1>" . get_the_title() . "</h1>";
		            do_action('basset/after_page_title');

		            do_action('basset/before_page_content');
		           	the_content();
		           	do_action('basset/after_page_content');
		        endwhile; // end while
		    endif; // end if
		?>
	</article><!-- /.content-area -->
</main>

<?php get_footer() ?>
