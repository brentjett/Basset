<?php 
/*
Template Name: Location
*/
get_header(); 
?>

<main class="container">
	<div class="details-area">
		<div id="location-photo" data-aspect-ratio="square">
			<div>
				
			</div>
		</div>
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
				?>
				<div><?=$type?><?=$phone['number']?></div>
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
	            print "<h1>" . get_the_title() . "</h1>";
	           	the_content();
	        endwhile; // end while
	    endif; // end if
	?>
	</div><!-- /.content-area -->
</main>

<?php get_footer() ?>