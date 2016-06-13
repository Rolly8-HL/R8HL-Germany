<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: functions.php
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
if (file_exists(BASEDIR."infusions/R8HL_photogallery_panel/locale/".$settings['locale'].".php")){
	include BASEDIR."infusions/R8HL_photogallery_panel/locale/".$settings['locale'].".php";
  } else {
	include BASEDIR."infusions/R8HL_photogallery_panel/locale/English.php";
  }
	
echo "<link rel='stylesheet' type='text/css' href='".INFUSIONS."R8HL_photogallery_panel/highslide/shadowbox.css'/><link rel='stylesheet' href='".INFUSIONS."R8HL_photogallery_panel/font/font-awesome/css/font-awesome.min.css' type='text/css' />\n<script type='text/javascript' src='".INFUSIONS."R8HL_photogallery_panel/highslide/shadowbox.js'></script><script type='text/javascript'> Shadowbox.init({ autoplayMovies: true, });</script>\n";

$r8hl_gallery_info =  "<div  class='' style='border-radius: 5px;	border: 0px solid #999;float: right; text-align: right; margin-right: 0px;'>\n
<div style='float: right; text-align: right; margin-right: 0px; '><a style=' text-decoration: none; ' class='fa  fa-info-circle fa-lg' href='".INFUSIONS."R8HL_photogallery_panel/R8HL_photogallery_view.php' rel='shadowbox;width=720;height=560;' title='".$locale['R8PG108']."'>\n</a>&nbsp;<a href='http://rolly8-hl.de' target='_blank' title='&copy;  2015 mod by R8HL Germany'>&copy;</a>\n</div>\n</div>\n";
	global $data77;
if (isset($_GET['photo_id']) && isnum($_GET['photo_id'])){
	$result77 = dbquery("SELECT * FROM ".DB_PHOTOS." WHERE photo_id='".$_GET['photo_id']."' ");
	$data77 = dbarray($result77);
  }

if (isset($_POST['photo_r8'])) {
   if (file_exists(BASEDIR."infusions/R8HL_photogallery_panel/functions.php")) {
      setcookie(COOKIE_PREFIX.'photogallery_r8', $_POST['photo_r8'],time() + 31536000, "", "", "");
      redirect (FUSION_SELF."?photo_id=".$data77['photo_id']."#gallery_top");
   } else {
      redirect (FUSION_SELF."?photo_id=".$data77['photo_id']."#gallery_top");
   }
}
session_start( );
if (!isset($_COOKIE [COOKIE_PREFIX.'photogallery_r8']))
{$_COOKIE [COOKIE_PREFIX.'photogallery_r8'] = $settings['r8hl_photogallery'];}

	$sett_lang	= "
	hs.lang.creditsTitle = '".$locale['R8PG-creditsTitle']."';
	hs.lang.playText = '".$locale['R8PG-playText']."';
	hs.lang.playTitle = '".$locale['R8PG-playTitle']."';
	hs.lang.pauseText = '".$locale['R8PG-pauseText']."';
	hs.lang.pauseTitle = '".$locale['R8PG-pauseTitle']."';
	hs.lang.nextText = '".$locale['R8PG-nextText']."';
	hs.lang.nextTitle = '".$locale['R8PG-nextTitle']."';
	hs.lang.previousText = '".$locale['R8PG-previousText']."';
	hs.lang.previousTitle = '".$locale['R8PG-previousTitle']."';
	hs.lang.fullExpandTitle = '".$locale['R8PG-fullExpandTitle']."';
	hs.lang.close = '".$locale['R8PG-close']."';
	hs.lang.closeText = '".$locale['R8PG-closeText']."';
	hs.lang.closeTitle = '".$locale['R8PG-closeTitle']."';
	hs.lang.moveTitle = '".$locale['R8PG-moveTitle']."';
	hs.lang.number = '".$locale['R8PG-number']."';
	hs.lang.restoreTitle = '".$locale['R8PG-restoreTitle']."';
	";

if ($_COOKIE [COOKIE_PREFIX.'photogallery_r8']   === "white"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />";
		echo"<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>";
		echo"<script type='text/javascript'>\n
	hs.graphicsDir = '".BASEDIR."infusions/R8HL_photogallery_panel/highslide/graphics/';
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
hs.outlineType = 'rounded-white';
hs.fadeInOut = true;
	".$sett_lang.";
//hs.dimmingOpacity = 0.75;
// Add the controlbar
hs.addSlideshow({
	//slideshowGroup: 'group1',
	interval: 5000,
	repeat: false,
	useControls: true,
	fixedControls: 'fit',
	overlayOptions: {
		opacity: 0.75,
		position: 'bottom center',
		hideOnMouseOut: true
	}
});</script>
	<style type='text/css'>
.highslide-heading  {
	color: #000!important;	
}
.highslide-caption{
	color: #000!important;	
}
#banane .quote  {
	color: #FFF!important;	
	background-image: none !important;
	background-color: #000 !important;
}
</style>\n";
	} elseif ($_COOKIE [COOKIE_PREFIX.'photogallery_r8']   === "dark"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />";
		echo"<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>";
		echo"<script type='text/javascript'>\n
	hs.graphicsDir = '".BASEDIR."infusions/R8HL_photogallery_panel/highslide/graphics/';
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
hs.outlineType = 'glossy-dark';
hs.wrapperClassName = 'dark';
hs.fadeInOut = true;
	".$sett_lang.";
//hs.dimmingOpacity = 0.75;
// Add the controlbar
if (hs.addSlideshow) hs.addSlideshow({
	//slideshowGroup: 'group1',
	interval: 5000,
	repeat: false,
	useControls: true,
	fixedControls: 'fit',
	overlayOptions: {
		opacity: .6,
		position: 'bottom center',
		hideOnMouseOut: true
	}
});</script>
	<style type='text/css'>
.highslide-heading  {
	color: #FFF!important;	
}
.highslide-caption{
	color: #FFF!important;	
}
#banane .quote  {
	color: #FFF!important;	
	background-image: none !important;
	background-color: #000 !important;
	
	font-size: 11px !important;
//	color: #fff !important;
//	background-color: #222 !important;
	border-top:1px solid #09c !important;
	border-bottom:1px solid #09c !important;
	padding: 5px !important;
	border-radius: 0px!important;
	margin-top: 5px !important;
	border-right-width: 0px !important;
	border-left-width: 0px !important;
	border-right-style: none !important;
	border-left-style: none !important;
	border-right-color: #000 !important;
	border-left-color: #000 !important;
	
	
	
	
	
}
</style>\n";
	} elseif  ($_COOKIE [COOKIE_PREFIX.'photogallery_r8']    === "controls-in-heading"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />";
		echo"<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>";
		echo"<script type='text/javascript'>\n
	hs.graphicsDir = '".BASEDIR."infusions/R8HL_photogallery_panel/highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.outlineType = 'rounded-white';
	hs.wrapperClassName = 'controls-in-heading';
	hs.fadeInOut = true;
		".$sett_lang.";
	//hs.dimmingOpacity = 0.75;
	// Add the controlbar
	if (hs.addSlideshow) hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: false,
		overlayOptions: {
			opacity: 1,
			position: 'top right',
			hideOnMouseOut: false
		}
	});</script>
	<style type='text/css'>
.highslide-heading  {
	color: #000!important;	
}
.highslide-caption{
	color: #000!important;	
}
#banane .quote {
	color: #FFF!important;	
	background-image: none !important;
	background-color: #000 !important;
}
</style>\n";		
	} elseif  ($_COOKIE [COOKIE_PREFIX.'photogallery_r8']    === "floating-caption"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />";
		echo"<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>";
		echo"<script type='text/javascript'>\n
	hs.graphicsDir = '".BASEDIR."infusions/R8HL_photogallery_panel/highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.wrapperClassName = 'dark borderless floating-caption';
	hs.fadeInOut = true;
		".$sett_lang.";
	hs.dimmingOpacity = .75;
	hs.useBox = true;
//	hs.width = 700;
//	hs.height = 525;
	
	hs.width = 800;
	hs.height = 500;
	
	
	// Add the controlbar
	if (hs.addSlideshow) hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: 'fit',
		overlayOptions: {
			opacity: .6,
			position: 'bottom center',
			hideOnMouseOut: true
		}
	});</script>
<style type='text/css'>
	.highslide-heading  {
	color: #FFF!important;	
}
.highslide-caption{
	color: #FFF!important;	
}
#banane .quote {
	color: #FFF!important;	
	background-image: none !important;
	background-color: #000 !important;
}
</style>\n";
	} elseif  ($_COOKIE [COOKIE_PREFIX.'photogallery_r8']   === "in-box"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />";
		echo"<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>";
		echo"<script type='text/javascript'>\n
	hs.graphicsDir = '".BASEDIR."infusions/R8HL_photogallery_panel/highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.outlineType = 'rounded-white';
	hs.fadeInOut = true;
		".$sett_lang.";
	hs.dimmingOpacity = 0.75;
	hs.wrapperClassName = 'borderless floating-caption';
	hs.numberPosition = 'caption';
//	hs.lang.number = '%1/%2';
	// define the restraining box
	hs.useBox = true;
	hs.width = 640;
	hs.height = 360;
	// Add the controlbar
	hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: 'fit',
		overlayOptions: {
			opacity: 1,
			position: 'bottom center',
			hideOnMouseOut: true
		}
	});</script>
<style type='text/css'>
	.highslide-heading  {
	color: #000!important;	
}
.highslide-caption{
	color: #FFF!important;	
}
#banane .quote {
	color: #FFF!important;	
	background-image: none !important;
	background-color: #000 !important;
	margin-top: 8px !important;
}
</style>\n";
	} elseif  ($_COOKIE [COOKIE_PREFIX.'photogallery_r8']   === "vertical-strip"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />";
		echo"<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>";
		echo "<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/functions.js'></script>";

		echo"<script type='text/javascript'>\n
	hs.graphicsDir = '".BASEDIR."infusions/R8HL_photogallery_panel/highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.fadeInOut = true;
	".$sett_lang.";
	
	hs.dimmingOpacity = 0.8;
	
	hs.wrapperClassName = 'borderless floating-caption';
	hs.captionEval = 'this.thumb.alt';
	hs.marginLeft = 100; // make room for the thumbstrip
	hs.marginBottom = 80 // make room for the controls and the floating caption
	hs.numberPosition = 'caption';
//	hs.lang.number = '%1/%2';
//	hs.close(title=".$locale['R8PG-close'].");
	// Add the slideshow providing the controlbar and the thumbstrip
	hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		overlayOptions: {
			className: 'text-controls',
			position: 'bottom center',
			relativeTo: 'viewport',
			offsetX: 50,
			offsetY: -5
		},
		thumbstrip: {
			position: 'middle left',
			mode: 'vertical',
			relativeTo: 'viewport'
		}
	});</script>
<style type='text/css'>
	.highslide-heading  {
	display: none !important;
}
/* Center the text in the caption */
.highslide-caption {
	width: 100%;
	text-align: center;
	color: #FFF!important;
	}
/* Remove the close button from the controls since we already have one in the corner of the image */
.highslide-close {
	display: none !important;
}
/* Put the image number in front of the caption */
.highslide-number {
	display: inline;
	padding-right: 1em;
	color: #FFF!important;
}
#banane .quote {
	color: #FFF!important;	
	background-image: none !important;
	background-color: #000 !important;
}

</style>\n";
	} elseif  ($_COOKIE [COOKIE_PREFIX.'photogallery_r8']    === "horizontal-strip"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />";
		echo"<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>";
		echo"<script type='text/javascript'>\n
	hs.graphicsDir = '".BASEDIR."infusions/R8HL_photogallery_panel/highslide/graphics/';
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
hs.fadeInOut = true;
	".$sett_lang.";
hs.dimmingOpacity = 0.8;
hs.outlineType = 'rounded-white';
hs.captionEval = 'this.thumb.alt';
hs.marginBottom = 105; // make room for the thumbstrip and the controls
hs.numberPosition = 'caption';
// Add the slideshow providing the controlbar and the thumbstrip
hs.addSlideshow({
	//slideshowGroup: 'group1',
	interval: 5000,
	repeat: false,
	useControls: true,
	overlayOptions: {
		className: 'text-controls',
		position: 'bottom center',
		relativeTo: 'viewport',
		offsetY: -60
	},
	thumbstrip: {
		position: 'bottom center',
		mode: 'horizontal',
		relativeTo: 'viewport'
	}
});</script>
<style type='text/css'>
	.highslide-heading  {
	display: none !important;
}
.highslide-caption{
	color: #000!important;	
}
#banane .quote {
	color: #FFF!important;	
	background-image: none !important;
	background-color: #000 !important;
}
</style>\n";
	} elseif  ($_COOKIE [COOKIE_PREFIX.'photogallery_r8']    === "thumbstrip-above"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />";
		echo"<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>";
		echo"<script type='text/javascript'>\n
	hs.graphicsDir = '".BASEDIR."infusions/R8HL_photogallery_panel/highslide/graphics/';
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
hs.fadeInOut = true;
hs.outlineType = 'glossy-dark';
hs.wrapperClassName = 'dark';
hs.captionEval = 'this.a.title';
hs.numberPosition = 'caption';
hs.useBox = true;
hs.width = 600;
hs.height = 400;
	".$sett_lang.";
//hs.dimmingOpacity = 0.8;
// Add the slideshow providing the controlbar and the thumbstrip
hs.addSlideshow({
	//slideshowGroup: 'group1',
	interval: 5000,
	repeat: false,
	useControls: true,
	fixedControls: 'fit',
	overlayOptions: {
		position: 'bottom center',
		opacity: 0.75,
		hideOnMouseOut: true
	},
	thumbstrip: {
		position: 'above',
		mode: 'horizontal',
		relativeTo: 'expander'
	}
});
// Make all images animate to the one visible thumbnail
var miniGalleryOptions1 = {
	thumbnailId: 'thumb1'
}
</script>	<style type='text/css'>
.highslide-heading  {
display: none !important;	
}
.highslide-caption{
	color: #FFF!important;	
}
#banane .quote {
	color: #FFF!important;	
	background-image: none !important;
	background-color: #000 !important;
}
</style>\n";
	} else  {
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />";
		echo"<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>";
		echo "<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/functions.js'></script>";
		echo"<script type='text/javascript'>\n
	hs.graphicsDir = '".BASEDIR."infusions/R8HL_photogallery_panel/highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.fadeInOut = true;
	hs.dimmingOpacity = 0.8;
		".$sett_lang.";
	hs.wrapperClassName = 'borderless floating-caption';
	hs.captionEval = 'this.thumb.alt';
	hs.marginLeft = 100; // make room for the thumbstrip
	hs.marginBottom = 80 // make room for the controls and the floating caption
	hs.numberPosition = 'caption';
	hs.lang.number = '%1/%2';
	// Add the slideshow providing the controlbar and the thumbstrip
	hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		overlayOptions: {
			className: 'text-controls',
			position: 'bottom center',
			relativeTo: 'viewport',
			offsetX: 50,
			offsetY: -5
		},
		thumbstrip: {
			position: 'middle left',
			mode: 'vertical',
			relativeTo: 'viewport'
		}
	});</script>
<style type='text/css'>
	.highslide-heading  {
	display: none !important;
}
/* Center the text in the caption */
.highslide-caption {
	width: 100%;
	text-align: center;
	color: #FFF!important;
	}
/* Remove the close button from the controls since we already have one in the corner of the image */
.highslide-close {
	display: none !important;
}
/* Put the image number in front of the caption */
.highslide-number {
	display: inline;
	padding-right: 1em;
	color: #FFF!important;
}
#banane .quote {
	color: #FFF!important;	
	background-image: none !important;
	background-color: #000 !important;
}

</style>\n";
}

############### R8HL Germany photogallery_view ###############




############### R8HL Germany photogallery_view ###############




?>

