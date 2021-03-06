<?php
/*
Template Name: Location
Stylesheets: basset-layouts
*/
get_template_part('head');
get_header();
?>

<main class="basset-container">
	<div class="layout-row">
		<div class="details-area">
			<? get_template_part('template_parts/location-photo') ?>
			<div class="location-details">
				<div class="location-name"><?=basset_get('location_name')?></div>

				<p class="location-address"><?=basset_get('location_address')?></p>

				<?php
				$phones = basset_get('location_phones');
				if (!empty($phones)) {
				?>
				<div class="location-phones">
					<? foreach($phones as $phone) {
						if ($type = $phone['type']) $type = "$type: ";
						$link = do_shortcode('[basset_phone phone_number="' . $phone['number'] . '"]' );
					?>
					<div><?=$type?><?=$link?></div>
					<? } ?>
				</div>
				<? } ?>

				<?php
				$hours = basset_get('location_hours');
				if (!empty($hours)) {
				?>
				<div class="location-hours">
					<? foreach($hours as $row) { ?>
					<div><?=$row['row']?></div>
					<? } ?>
				</div>
				<? } ?>
			</div><!-- /.location-details -->

		</div><!-- /.details-area -->

		<div class="content-area">
		<?php
		    if ( have_posts() ) :
		        while ( have_posts() ) :
		            the_post();
					if (apply_filters('basset/show_title', true)) {
		            	print "<h1>" . get_the_title() . "</h1>";
					}
					do_action('basset/location_block');
		           	the_content();
		        endwhile; // end while
		    endif; // end if
		?>
		</div><!-- /.content-area -->
	</div>
</main>

<?
get_footer();
get_template_part('foot');
?>
