<?php
/*
Name: Blog (Index)
Stylesheets: basset-layouts
*/
get_template_part('head');
get_header();
?>
<main class="basset-container narrow">
	<h1><?_e('Blog', 'basset')?></h1>

	<? if (have_posts()) { ?>
		<? while (have_posts()) : the_post(); ?>
		<article <? post_class() ?>>
			<a href="<? the_permalink()?>" class="post-thumb-link"><?php the_post_thumbnail(); ?></a>
			<h2><a href="<? the_permalink()?>" title="Permanent Link to <?php the_title_attribute(); ?>"><? the_title() ?></a></h2>
			<div class="pad">
				<div class="post-content">
					<small><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?></small>
					<? the_excerpt() ?>
					<p class="postmetadata">Posted in <?php the_category(', '); ?></p>
					<a href="<? the_permalink() ?>"><?_e('Read More &rarr;', 'basset')?> &raquo;</a>
				</div>
			</div>
		</article>
		<? endwhile; ?>

		<?php if ($wp_query->max_num_pages > 1) : ?>
		  <nav class="post-nav">
		    <ul class="pager">
		      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'basset')) ?></li>
		      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'basset')) ?></li>
		    </ul>
		  </nav>
		<?php endif; ?>
	<? } else { ?>
	<div>
		<div class="pad">
			<?_e('Sorry! No Posts Found :(', 'basset') ?>
		</div>
	</div>
	<? } ?>
</main>
<?
get_footer();
get_template_part('foot');
?>
