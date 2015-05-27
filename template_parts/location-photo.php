<?php
global $post;
$styles = array();

// Check for featured image
$img = get_the_post_thumbnail($post->ID, array(350, 350, true), array());

$styles = apply_filters('basset/location_photo/inline_styles', $styles);
$styles = basset_get_style_attr($styles); // turn array into style="" string
?>
<div id="location-photo">
    <div <?=$styles?>><?=$img?></div>
</div>
