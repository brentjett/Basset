<?php
/*
Template Part Name: Head

Description: This template part is the clean opening of the dom intended for all documents. This generally should not be overridden. To modify a <header> section for a specific site, override header.php in your child theme. Be sure to include this template part at the beginning over your overridden header.php file.
*/
?>
<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" <? language_attributes() ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <? language_attributes() ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!--><html <? language_attributes() ?>><!--<![endif]-->
<head>
	<? wp_head() ?>
</head>
<body <?php body_class() ?>>
<?php
do_action('neh_after_body_open');
do_action('basset/before_body_content');
?>
