<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" <? language_attributes() ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <? language_attributes() ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!--><html <? language_attributes() ?>><!--<![endif]-->
<head>
	<? wp_head() ?>
</head>
<body <?body_class()?>>
<? 
do_action('neh_after_body_open');
do_action('basset/before_body_content');
?>