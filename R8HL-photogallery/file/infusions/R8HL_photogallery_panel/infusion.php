<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2008 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: infusion.php   modified by R8HL Germany
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) { die("Access Denied"); }

$inf_title = "R8HL Photogallery";
$inf_description = "R8HL Photogallery";
$inf_version = "1.0.3";
$inf_developer = "R8HL Germany";
$inf_email = "";
$inf_weburl = "http://rolly8-hl.de";
$inf_folder = "R8HL_photogallery_panel";

$inf_insertdbrow[1] = DB_SETTINGS." SET  settings_name='r8hl_photogallery', settings_value='vertical-strip' ";
$inf_insertdbrow[2] = DB_SITE_LINKS." SET link_id='', link_name='R8HL Photogallery', link_url='R8HL-photogallery.php', link_visibility='0', link_position='1', link_window='0', link_order='10' ";
$inf_insertdbrow[3] = DB_PANELS."(
`panel_id`, `panel_name`, `panel_filename`, `panel_content`, `panel_side`, `panel_order`, `panel_type`, `panel_access`, `panel_display`, `panel_status`, `panel_url_list`, `panel_restriction`) VALUES
	('', 'R8HL photogallery', 'R8HL_photogallery_panel', '', 3, 7, 'file', 0, 1, 1, '', 1)	;";	
$inf_deldbrow[1] = DB_SETTINGS." WHERE settings_name='r8hl_photogallery'";
$inf_deldbrow[2] = DB_SITE_LINKS." WHERE link_name='R8HL Photogallery'";
$inf_deldbrow[3] = DB_PANELS." WHERE panel_filename='R8HL_photogallery_panel'";

$inf_adminpanel[1] = array(
	"title" => "R8HL Photogallery",
	"image" => "R8PG.gif",
	"panel" => "R8HL_photogallery.php",
	"rights" => "R8PG"
);

?>