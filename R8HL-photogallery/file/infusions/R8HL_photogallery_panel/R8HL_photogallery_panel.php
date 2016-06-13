<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2013 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: R8HL_photogallery_panel.php
| Author: R8HL Germany
| Web: http://rolly8-hl.de
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

if (file_exists(BASEDIR."infusions/R8HL_photogallery_panel/functions.php")){
if (isset($_COOKIE [COOKIE_PREFIX.'photogallery_r8']) == "white"){
} elseif(isset($_COOKIE[COOKIE_PREFIX.'photogallery_r8']) == "dark"){
} elseif(isset($_COOKIE[COOKIE_PREFIX.'photogallery_r8']) == "controls-in-heading"){
} elseif(isset($_COOKIE[COOKIE_PREFIX.'photogallery_r8']) == "floating-caption"){
} elseif(isset($_COOKIE[COOKIE_PREFIX.'photogallery_r8']) == "in-box"){
} elseif(isset($_COOKIE[COOKIE_PREFIX.'photogallery_r8']) == "vertical-strip"){
} elseif(isset($_COOKIE[COOKIE_PREFIX.'photogallery_r8']) == "horizontal-strip"){
} elseif(isset($_COOKIE[COOKIE_PREFIX.'photogallery_r8']) == "thumbstrip-above"){
} else {setcookie(COOKIE_PREFIX.'photogallery_r8' ,$settings['r8hl_photogallery'],time() + 31536000, "", "", "");}	
}	
 ?>
