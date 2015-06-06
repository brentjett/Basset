<?php
/*
Name: Blog (Index)
Stylesheets: basset-layouts
*/
get_template_part('head');
get_header();
?>
<main class="basset-container narrow">
	<?
	if (apply_filters('basset/show_title', true)) print "<h1 class='template-title'>" . single_post_title(false, false) . "</h1>";
	?>

	<? if (have_posts()) { ?>
		<? while (have_posts()) : the_post(); ?>
		<article <? post_class() ?>>

			<a href="<? the_permalink()?>" class="post-thumb-link"><?php the_post_thumbnail(); ?></a>

			<h2><a href="<? the_permalink()?>" title="Permanent Link to <?php the_title_attribute(); ?>"><? the_title() ?></a></h2>

			<div class="post-content">
				<small><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?></small>
				<? the_excerpt() ?>
				<p class="postmetadata">Posted in <?php the_category(', '); ?></p>
				<a href="<? the_permalink() ?>"><?_e('Read More &rarr;', 'basset')?> &raquo;</a>
			</div>

		</article>
		<? endwhile; ?>

		<?php // Previous/next page navigation.
		the_posts_pagination(array(
			'prev_text' => __( 'Previous page', 'basset' ),
			'next_text' => __( 'Next page', 'basset' ),
			'mid_size' => 3
		));
		 ?>
	<? } else { ?>
	<div>
		<div class="pad">
			<?_e('Sorry! No Posts Found :(', 'basset') ?>
		</div>
	</div>
	<? } ?>
</main>
<?php
get_footer();
get_template_part('foot');
?>
