<?php 
/*
This code allows updates to be published to wp-updates.com
*/
require_once 'wp-updates-theme.php';
new WPUpdatesThemeUpdater_1258( 'http://wp-updates.com/api/2/theme', basename( get_template_directory() ) );
?>