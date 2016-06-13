<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2013 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: R8HL_photogallery.php
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
require_once "../../maincore.php";
if (!checkrights("R8PG") || !defined("iAUTH") || !isset($_GET['aid']) || $_GET['aid'] != iAUTH) { redirect("../index.php"); }
include LOCALE.LOCALESET."admin/settings.php";
require_once THEMES."templates/admin_header_mce.php";

if (file_exists(INFUSIONS."R8HL_photogallery_panel/locale/".$settings['locale'].".php")){
	include INFUSIONS."R8HL_photogallery_panel/locale/".$settings['locale'].".php";
  } else {
	include INFUSIONS."R8HL_photogallery_panel/locale/English.php";
  }
   
echo "<link rel='stylesheet' type='text/css' href='".INFUSIONS."R8HL_photogallery_panel/highslide/shadowbox.css'/><link rel='stylesheet' href='".INFUSIONS."R8HL_photogallery_panel/font/font-awesome/css/font-awesome.min.css' type='text/css' />\n<script type='text/javascript' src='".INFUSIONS."R8HL_photogallery_panel/highslide/shadowbox.js'></script><script type='text/javascript'> Shadowbox.init({ autoplayMovies: true, });</script>\n";

$r8hl_gallery_info = "<div style='float: right; margin-top: -16px;'><a href='http://rolly8-hl.de' target='_blank' title='&copy;  2015 mod by R8HL Germany'>&copy;</a>\n</div>\n";

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

if ($settings['r8hl_photogallery']   === "white"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />
		<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>
		<script type='text/javascript'>\n
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
 .quote  {
	color: #FFF!important;	
	background-image: none !important;
	background-color: #000 !important;
}
</style>\n";
	} elseif ($settings['r8hl_photogallery']   === "dark"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />
		<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>
		<script type='text/javascript'>\n
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
 .quote  {
	font-size: 11px !important;
	color: #fff !important;
	background-color: #222 !important;
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
	} elseif  ($settings['r8hl_photogallery']    === "controls-in-heading"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />
		<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>
		<script type='text/javascript'>\n
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
 .quote {
	color: #FFF!important;	
	background-image: none !important;
	background-color: #000 !important;
}
</style>\n";		
	} elseif  ($settings['r8hl_photogallery']    === "floating-caption"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />
		<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>
		<script type='text/javascript'>\n
	hs.graphicsDir = '".BASEDIR."infusions/R8HL_photogallery_panel/highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.wrapperClassName = 'dark borderless floating-caption';
	hs.fadeInOut = true;
		".$sett_lang.";
	hs.dimmingOpacity = .75;
	hs.useBox = true;
	hs.width = 1000;
	hs.height = 625;
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
 .quote {
	font-size: 11px !important;
	color: #fff !important;
	background-color: #222 !important;
	border-top:1px solid #09c !important;
	border-bottom:1px solid #09c !important;
	padding: 5px !important;
	border-radius: 0px!important;
	margin-top: 5px !important;
}
</style>\n";
	} elseif  ($settings['r8hl_photogallery']   === "in-box"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />
		<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>
		<script type='text/javascript'>\n
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
	hs.width = 800;
	hs.height = 500;
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
 .quote {
	font-size: 11px !important;
	color: #fff !important;
	background-color: #222 !important;
	border-top:1px solid #09c !important;
	border-bottom:1px solid #09c !important;
	padding: 5px !important;
	border-radius: 0px!important;
	margin-top: 8px !important;
	border-right-width: 0px !important;
	border-left-width: 0px !important;
	border-right-style: none !important;
	border-left-style: none !important;
	border-right-color: #000 !important;
	border-left-color: #000 !important;
}
</style>\n";
	} elseif  ($settings['r8hl_photogallery']   === "vertical-strip"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />
		<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>
		<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/functions.js'></script>
		<script type='text/javascript'>\n
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
 .quote {
	color: #FFF!important;	
	background-image: none !important;
	background-color: #000 !important;
}
</style>\n";
	} elseif  ($settings['r8hl_photogallery']    === "horizontal-strip"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />
		<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>
		<script type='text/javascript'>\n
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
 .quote {
	color: #FFF!important;	
	background-image: none !important;
	background-color: #000 !important;
}
</style>\n";
	} elseif  ($settings['r8hl_photogallery']    === "thumbstrip-above"){
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />
		<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>
		<script type='text/javascript'>\n
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
 .quote {
	color: #FFF!important;	
	background-image: none !important;
	background-color: #000 !important;
}
</style>\n";
	} else  {
		echo"<link rel='stylesheet' href='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide.css' type='text/css' media='screen' />
		<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/highslide-with-gallery.js'></script>
		<script type='text/javascript' src='".BASEDIR."infusions/R8HL_photogallery_panel/highslide/functions.js'></script>
		<script type='text/javascript'>\n
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
 .quote {
	color: #FFF!important;	
	background-image: none !important;
	background-color: #000 !important;
}
</style>\n";
}

echo "<style type='text/css'>
.admin-message-r8 {
    font-size: 12px;
	width: 60%;
	background: url(R8PG.gif) 15px 5px  no-repeat;
	border-top: 2px solid #1380b1;
	border-bottom: 2px solid #1380b1;
	padding: 15px 0 20px 50px;
	margin-bottom: 10px;
}
.R8PG-info {
	border-radius: 5px;
	opacity: 0.7;
	height: 30px;
	width: 30px;
	float: left;
	}
.admin-table {
	border-radius: 5px !important;
	margin-bottom: 20px;
	margin-top: -40px;
	border: 1px solid #999;
	padding: 10px;
	width: 650px !important;
	color: #000 !important;
	background-color: #FFF !important;	
	}
</style>\n";

if (isset($_POST['photo_r8'])) {
	$error = 0;
	$result = dbquery("UPDATE ".DB_SETTINGS." SET settings_value='".stripinput($_POST['photo_r8'])."' WHERE settings_name='r8hl_photogallery'");
	if (!$result) { $error = 1; }
	redirect(FUSION_SELF.$aidlink."&error=".$error);
}	

if (isset($_GET['error']) && isnum($_GET['error']) && !isset($message)) {
	if ($_GET['error'] == 0) {
		$message = $locale['900'];
	} elseif ($_GET['error'] == 1) {
		$message = $locale['901'];
	} elseif ($_GET['error'] == 2) {
		$message = $locale['696'];
	}
	if (isset($message)) {
		echo "<div id='close-message'><div align='center' class='admin-message-r8'>".$message."</div></div>\n";
	}
}

$settings2 = array();
$result = dbquery("SELECT * FROM ".DB_SETTINGS);
while ($data = dbarray($result)) {$settings2[$data['settings_name']] = $data['settings_value'];}
  
$image_001 = INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/ws_Caribbean_Beach_852x480.jpg";
$image_002 = INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/ws_Wild_Ocean_Ship_Orange_Sunset_852x480.jpg";
$image_003 = INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/ws_Deep_Sleep_852x480.jpg";
$image_004 = INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/ws_Itsy_Bitsy_Spider_852x480.jpg";
$image_005 = INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/ws_Woman_Fishes_&_Jewelry_852x480.jpg";
$image_006 = INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/ws_Glowing_Space_Planet_&_Lotus_852x480.jpg";
$image_007 = INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/ws_Motocross_Racing_852x480.jpg";
$image_008 = INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/ws_Macau_Night_View_852x480.jpg";

if ($settings['r8hl_photogallery'] == "white") {$galleryname = $locale['R8PG100'];
} elseif ($settings['r8hl_photogallery'] == "dark") {$galleryname = $locale['R8PG101'];
} elseif ($settings['r8hl_photogallery'] == "controls-in-heading") {$galleryname = $locale['R8PG102'];
} elseif ($settings['r8hl_photogallery'] == "floating-caption") {$galleryname = $locale['R8PG103'];
} elseif ($settings['r8hl_photogallery'] == "in-box") {$galleryname = $locale['R8PG104'];
} elseif ($settings['r8hl_photogallery'] == "vertical-strip") {$galleryname = $locale['R8PG105'];
} elseif ($settings['r8hl_photogallery'] == "horizontal-strip") {$galleryname = $locale['R8PG106'];
} elseif ($settings['r8hl_photogallery'] == "thumbstrip-above") {$galleryname = $locale['R8PG107'];} 

############### sett_white
$sett_white = "
<div class='highslide-heading'>".$locale['R8PG110']." - caribbean-beach</div>		
<div class='highslide-caption '>".$locale['R8PG110a']." - ".$galleryname."</div>
<a style='display:none;' href='".$image_002."' title='wild-ocean-ship-orange-sunset' class='highslide' onclick='return hs.expand(this)'>
<img src='".$image_002."' alt='wild-ocean-ship-orange-sunset' /></a>
<div class='highslide-heading'>".$locale['R8PG110']." - wild-ocean-ship-orange-sunset</div>		
<div class='highslide-caption quote'>".$locale['R8PG110a']." - ".$locale['R8PG111']."</div>
<a style='display:none;' href='".$image_003."' title='deep-sleep' class='highslide' onclick='return hs.expand(this)'>
<img src='".$image_003."' alt='deep-sleep' /></a>
<div class='highslide-heading'>".$locale['R8PG110']." - deep-sleep</div>		
<div class='highslide-caption'>".$locale['R8PG110a']." - ".$galleryname."</div>
<a style='display:none;' href='".$image_004."' title='itsy-bitsy-spide' class='highslide' onclick='return hs.expand(this)'>
<img src='".$image_004."' alt='itsy-bitsy-spide' /></a>
<div class='highslide-heading'>".$locale['R8PG110']." - itsy-bitsy-spider</div>		
<div class='highslide-caption quote'>".$locale['R8PG110a']." - ".$galleryname."</div>
<a style='display:none;' href='".$image_005."' title='woman-fishes--jewelry' class='highslide' onclick='return hs.expand(this)'>
<img src='".$image_005."' alt='woman-fishes--jewelry' /></a>
<div class='highslide-heading'>".$locale['R8PG110']." - woman-fishes--jewelry</div>		
<div class='highslide-caption'>".$locale['R8PG110a']." - ".$locale['R8PG111']."</div>
<a style='display:none;' href='".$image_006."' title='glowing-space-planet--lotus' class='highslide' onclick='return hs.expand(this)'>
<img src='".$image_006."' alt='glowing-space-planet--lotus' /></a>
<div class='highslide-heading'>".$locale['R8PG110']." - glowing-space-planet--lotus</div>		
<div class='highslide-caption quote'>".$locale['R8PG110a']." - ".$galleryname."</div>
<a style='display:none;' href='".$image_007."' title='motocross-racing' class='highslide' onclick='return hs.expand(this)'>
<img src='".$image_007."' alt='motocross-racing' /></a>
<div class='highslide-heading'>".$locale['R8PG110']." - motocross-racing</div>		
<div class='highslide-caption'>".$locale['R8PG110a']." - ".$locale['R8PG111']."</div>
<a style='display:none;' href='".$image_008."' title='macau-night-view' class='highslide' onclick='return hs.expand(this)'>
<img src='".$image_008."' alt='macau-night-view' /></a>
<div class='highslide-heading'>".$locale['R8PG110']." - macau-night-view</div>		
<div class='highslide-caption quote'>".$locale['R8PG110a']." - ".$locale['R8PG111']."</div>";

opentable($locale['R8PG002']);
echo "<div id='info'></div>\n";
echo'<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="2JN9P7LQC7HRU">
<input type="image" src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.">
<img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
</form>';

echo "<table cellpadding='0' cellspacing='0' class='center admin-table'>\n<tr>\n<td>\n
<strong>".$locale['R8PG003']."</strong></td>\n</tr>\n<tr>\n<td width='100%'>\n<center>\n";
echo "<div style='width: 100%; height: 2px;  margin-top: 5px; margin-bottom: 2px; border-top-width: 1px; border-top-style: solid;	border-top-color: #CCC;' ></div>";

echo "<center><div style='width: 100%;' class='R8HL_box_admin '  >";
echo "<div style='width: 23%; float: left; font-size: 12px !important;' class='R8HL_box_admin'>";
############## white 
if ($settings['r8hl_photogallery'] == "white"){
echo "<img style='opacity: 0.5; margin-top: 20px;' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-white.jpg' /><br />
&nbsp;&nbsp;".$locale['R8PG100']."<br /><br />";
} else {
echo "<form name='photo_r8' method='post'>
<input type='hidden' name='photo_r8' value='white' />
<input style='margin-top: 20px;' type='image' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-white.jpg'   title='".$locale['R8PG100']."' /><br />&nbsp;&nbsp;".$locale['R8PG100']."<br /><br /></form>";}
############## white 
############## controls-in-heading 
if ($settings['r8hl_photogallery'] == "controls-in-heading"){
echo "<img style='opacity: 0.5;' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-controls-in-heading.jpg' title='".$locale['R8PG114']."' /><br />
&nbsp;&nbsp;".$locale['R8PG102'];
} else {
echo "<form name='photo_r8' method='post'>
<input type='hidden' name='photo_r8' value='controls-in-heading' />
<input  type='image' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-controls-in-heading.jpg' title='".$locale['R8PG102']."' /><br />&nbsp;&nbsp;".$locale['R8PG102']."</form>";}
############## controls-in-heading
echo "</div><div style='width: 23%; float: right; font-size: 12px !important;' class='R8HL_box_admin tbl'>";
############## dark 
if ($settings['r8hl_photogallery'] == "dark"){
echo "<img style='opacity: 0.5; margin-top: 20px;' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-dark.jpg' title='".$locale['R8PG114']."' /><br />
&nbsp;&nbsp;".$locale['R8PG101']."<br /><br />";
} else {
echo "<form name='photo_r8' method='post'>
<input type='hidden' name='photo_r8' value='dark' />
<input style='margin-top: 20px;' type='image' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-dark.jpg'   title='".$locale['R8PG101']."' /><br />&nbsp;&nbsp;".$locale['R8PG101']."<br /><br /></form>";}
############## dark 
############## floating-caption 
if ($settings['r8hl_photogallery'] == "floating-caption"){
echo "<img style='opacity: 0.5;' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-floating-caption.jpg' title='".$locale['R8PG114']."' /><br />
&nbsp;&nbsp;".$locale['R8PG103']."<br />";
} else {
echo "<form  name='photo_r8' method='post'>
<input type='hidden' name='photo_r8' value='floating-caption' />
<input type='image' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-floating-caption.jpg' title='".$locale['R8PG103']."' /><br />&nbsp;&nbsp;".$locale['R8PG103']."</form><br />";}
############## floating-caption 
echo "</div>";
############## preview
echo "<div style='width: 54%; font-size: 12px !important;' class='R8HL_box_admin'>";
echo "<center>".$locale['R8PG112a']."&nbsp;&nbsp;<strong>(".$galleryname.")</strong></center>";
echo "<a href='".$image_001."' class='highslide' title='".$locale['R8PG112']."' onclick='return hs.expand(this)'>
<img src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/".$settings['r8hl_photogallery'].".jpg' alt='".$locale['R8PG111']."' title='".$locale['R8PG112']."' /></a>".$sett_white."</div>";
############## preview
echo "<div style='width: 100%; height: 2px;  margin-top: 5px; margin-bottom: 2px; border-top-width: 1px; border-top-style: solid;	border-top-color: #CCC;' ></div>";
echo "</div></center><center><div style='width: 98%;' class='R8HL_box_admin' >";
echo "<div style='width: 25%; float: left; font-size: 12px !important;' class='R8HL_box_admin'>";
############## in-box 
if ($settings['r8hl_photogallery'] == "in-box"){
echo "<img style='opacity: 0.5;' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-in-box.jpg' title='".$locale['R8PG114']."' /><br />&nbsp;&nbsp;".$locale['R8PG104']."</div>";
} else {
echo "<form  name='photo_r8' method='post'>
<input type='hidden' name='photo_r8' value='in-box' />
<input type='image' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-in-box.jpg' title='".$locale['R8PG104']."' /><br />&nbsp;&nbsp;".$locale['R8PG104']."</form></div>";}
############## in-box 
echo "<div style='width: 25%; float: left; font-size: 12px !important;' class='R8HL_box_admin'>";
############## vertical-strip 
if ($settings['r8hl_photogallery'] == "vertical-strip"){
echo "<img style='opacity: 0.5;' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-vertical-strip.jpg' title='".$locale['R8PG114']."' /><br />
&nbsp;&nbsp;".$locale['R8PG105']."</div>";
} else {
echo "<form  name='photo_r8' method='post'>
<input type='hidden' name='photo_r8' value='vertical-strip' />
<input type='image' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-vertical-strip.jpg' title='".$locale['R8PG105']."' /><br />&nbsp;&nbsp;".$locale['R8PG105']."</form></div>";}
############## vertical-strip
echo "<div style='width: 25%; float: right; font-size: 12px !important;' class='R8HL_box_admin'>";
############## thumbstrip-above 
if ($settings['r8hl_photogallery'] == "thumbstrip-above"){
echo "<img style='opacity: 0.5;' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-thumbstrip-above.jpg' title='".$locale['R8PG114']."' /><br />
&nbsp;&nbsp;".$locale['R8PG107']."</div>";
} else {
echo "<form name='photo_r8' method='post'>
<input type='hidden' name='photo_r8' value='thumbstrip-above' />
<input type='image' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-thumbstrip-above.jpg' title='".$locale['R8PG107']."' /><br />&nbsp;&nbsp;".$locale['R8PG107']."</form></div>";}
############## thumbstrip-above
echo "<div style='width: 25%; float: right; font-size: 12px !important;' class='R8HL_box_admin'>";
############## horizontal-strip 
if ($settings['r8hl_photogallery'] == "horizontal-strip"){
echo "<img style='opacity: 0.5;' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-horizontal-strip.jpg' title='".$locale['R8PG114']."' /><br />
&nbsp;&nbsp;".$locale['R8PG106']."</div>";
} else {
echo "<form  name='photo_r8' method='post'>
<input type='hidden' name='photo_r8' value='horizontal-strip' />
<input type='image' src='".INFUSIONS."R8HL_photogallery_panel/highslide/imagesr8/preview-horizontal-strip.jpg' title='".$locale['R8PG106']."' /><br />&nbsp;&nbsp;".$locale['R8PG106']."</form></div>";}
############## horizontal-strip
echo $r8hl_gallery_info."</center></td>\n</tr>\n</table>\n";
closetable();

require_once THEMES."templates/footer.php";
?>