<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: R8HL-photogallery.php
| Author: Nick Jones (Digitanium)   modified by R8HL Germany
| Co-Author: Robert Gaudyn (Wooya)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "maincore.php";
require_once THEMES."templates/header.php";
include LOCALE.LOCALESET."photogallery.php";

if (file_exists(INFUSIONS."R8HL_photogallery_panel/locale/".$settings['locale'].".php")){
	include INFUSIONS."R8HL_photogallery_panel/locale/".$settings['locale'].".php";
  } else {
	include INFUSIONS."R8HL_photogallery_panel/locale/English.php";
  }

		require_once INFUSIONS."R8HL_photogallery_panel/functions.php";
define("SAFEMODE", @ini_get("safe_mode") ? true : false);
add_to_title($locale['global_200'].$locale['400']);
if (isset($_GET['photo_id']) && isnum($_GET['photo_id'])){
	$result = dbquery(
		"SELECT tp.photo_title, tp.photo_description, tp.photo_filename, tp.photo_thumb2, tp.photo_datestamp, tp.photo_views,
		tp.photo_order, tp.photo_allow_comments, tp.photo_allow_ratings, ta.album_id, ta.album_title, ta.album_access,
		tu.user_id, tu.user_name, tu.user_status, SUM(tr.rating_vote) AS sum_rating, COUNT(tr.rating_item_id) AS count_votes
		FROM ".DB_PHOTOS." tp
		LEFT JOIN ".DB_PHOTO_ALBUMS." ta USING (album_id)
		LEFT JOIN ".DB_USERS." tu ON tp.photo_user=tu.user_id
		LEFT JOIN ".DB_RATINGS." tr ON tr.rating_item_id = tp.photo_id AND tr.rating_type='P'
		WHERE photo_id='".$_GET['photo_id']."' GROUP BY tp.photo_id"
	);
	$data = dbarray($result);
	if (!checkgroup($data['album_access'])) {
		redirect(FUSION_SELF);
	} else {
		define("PHOTODIR", PHOTOS.(!SAFEMODE ? "album_".$data['album_id']."/" : ""));
		include INCLUDES."comments_include.php";
		include INCLUDES."ratings_include.php";
		$result2=dbquery("UPDATE ".DB_PHOTOS." SET photo_views=(photo_views+1) WHERE photo_id='".$_GET['photo_id']."'");
		$pres = dbquery("SELECT photo_id FROM ".DB_PHOTOS." WHERE photo_order='".($data['photo_order']-1)."' AND album_id='".$data['album_id']."'");
		$nres = dbquery("SELECT photo_id FROM ".DB_PHOTOS." WHERE photo_order='".($data['photo_order']+1)."' AND album_id='".$data['album_id']."'");
		$fres = dbquery("SELECT photo_id FROM ".DB_PHOTOS." WHERE photo_order='1' AND album_id='".$data['album_id']."'");
		$lastres = dbresult(dbquery("SELECT MAX(photo_order) FROM ".DB_PHOTOS." WHERE album_id='".$data['album_id']."'"), 0);
		$lres = dbquery("SELECT photo_id FROM ".DB_PHOTOS." WHERE photo_order>='".$lastres."' AND album_id='".$data['album_id']."'");
		if (dbrows($pres)) $prev = dbarray($pres);
		if (dbrows($nres)) $next = dbarray($nres);
		if (dbrows($fres)) $first = dbarray($fres);
		if (dbrows($lres)) $last = dbarray($lres);
		
############### R8HL Germany control ###############	
$r8hl_gallery_select =  "<form style=' margin-top: -1px; margin-right: 5px;  float: right;  border: 0px solid #999; border-radius: 5px; '  name='photo_r8'  method='post'>
<input type='hidden' name='photo_r8' value='".$_COOKIE[COOKIE_PREFIX.'photogallery_r8']."' />
<select style='  border: 0px solid #999; border-radius: 5px; '   name='photo_r8' class='' onchange='this.form.submit();'>
<option style='  border: 0px solid #999; border-radius: 5px; '  value='white'".($_COOKIE[COOKIE_PREFIX.'photogallery_r8'] == "white" ? " selected='selected'" : "").">".$locale['R8PG100']."</option><option value='dark'".($_COOKIE[COOKIE_PREFIX.'photogallery_r8'] == "dark" ? " selected='selected'" : "").">".$locale['R8PG101']."</option><option value='controls-in-heading'".($_COOKIE[COOKIE_PREFIX.'photogallery_r8'] == "controls-in-heading" ? " selected='selected'" : "").">".$locale['R8PG102']."</option><option value='floating-caption'".($_COOKIE[COOKIE_PREFIX.'photogallery_r8'] == "floating-caption" ? " selected='selected'" : "").">".$locale['R8PG103']."</option><option value='in-box'".($_COOKIE[COOKIE_PREFIX.'photogallery_r8'] == "in-box" ? " selected='selected'" : "").">".$locale['R8PG104']."</option><option value='vertical-strip'".($_COOKIE[COOKIE_PREFIX.'photogallery_r8'] == "vertical-strip" ? " selected='selected'" : "").">".$locale['R8PG105']."</option><option value='horizontal-strip'".($_COOKIE[COOKIE_PREFIX.'photogallery_r8'] == "horizontal-strip" ? " selected='selected'" : "").">".$locale['R8PG106']."</option><option value='thumbstrip-above'".($_COOKIE[COOKIE_PREFIX.'photogallery_r8'] == "thumbstrip-above" ? " selected='selected'" : "").">".$locale['R8PG107']."</option></select></form>\n";
############### R8HL Germany control ###############	

echo "<div id='gallery_top'></div>\n";
		opentable($locale['450']);
		echo "<!--pre_photo-->";
		if ($settings['photo_watermark']) {
			if ($settings['photo_watermark_save']) {
				$parts = explode(".", $data['photo_filename']);
				$wm_file1 = $parts[0]."_w1.".$parts[1];
				$wm_file2 = $parts[0]."_w2.".$parts[1];
				if (!file_exists(PHOTODIR.$wm_file1)) {
					if ($data['photo_thumb2']) { $photo_thumb = "photo.php?photo_id=".$_GET['photo_id']; }
					$photo_file = "photo.php?photo_id=".$_GET['photo_id']."&amp;full";
				} else {
					if ($data['photo_thumb2']) { $photo_thumb = PHOTODIR.$wm_file1; }
					$photo_file = PHOTODIR.$wm_file2;
				}
			} else {
				if ($data['photo_thumb2']) { $photo_thumb = "photo.php?photo_id=".$_GET['photo_id']; }
				$photo_file = "photo.php?photo_id=".$_GET['photo_id']."&amp;full";
			}
			$photo_size = @getimagesize(PHOTODIR.$data['photo_filename']);
			while ($datar8 = dbarray($result)) {
		echo "<a style='display:none' class='highslide' href='".$datar8['photo_id']."' title='".$no_title."' onclick='return hs.expand(this)'>
		<img src='".PHOTOS. $datar8['photo_filename']."' alt='".$datar8['photo_description']."'/></a>";
		}
		} else {
			$photo_thumb = $data['photo_thumb2'] ? PHOTODIR.$data['photo_thumb2'] : "";
			$photo_file = PHOTODIR.$data['photo_filename'];
			$photo_size = @getimagesize($photo_file);
		}
		add_to_title($locale['global_201'].trimlink($data['photo_title'],30));
		echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
		echo "<td class='tbl2' width='80%'><a href='".FUSION_SELF."'>".$locale['400']."</a> &gt;\n";
		echo "<a href='".FUSION_SELF."?album_id=".$data['album_id']."'>".trimlink($data['album_title'],20)."</a>\n";
		echo ($data['photo_title'] ? " &gt; <strong>".trimlink($data['photo_title'],20)."</strong>" : " &gt; ".$locale['R8PG001']).$r8hl_gallery_select."\n</td>\n";
		echo "</tr>\n</table>\n";
		
		echo ($data['photo_title'] ? "<center><strong>".$data['photo_title']."</strong></center>" : "<center>".$locale['R8PG001'])."</center>";
		
	echo "	<div  class='highslide-gallery highslide-container' id='photogallery' align='center' style='margin:5px;'>\n";
		echo "<a target='' href='".$photo_file."' class='highslide-container' title='".(!empty($data['photo_title']) ? trimlink($data['photo_title'],45) : $locale['R8PG001'])."' onclick='return hs.expand(this)' >";
		echo "<img  src='".(isset($photo_thumb) && !empty($photo_thumb) ? $photo_thumb : $photo_file)."' alt='".(!empty($data['photo_title']) ? trimlink($data['photo_title'],45) : $locale['R8PG001'])."' style='border:0px' class='photogallery_photo  highslide-container'   /></a>";
echo "<div  class='highslide-heading'><div id='banane' >";
		echo ($data['photo_title'] ? stripslashes(parseubb(parsesmileys(trimlink($data['photo_title'],45))))."" : $locale['R8PG001']."")."\n";
echo "</div>\n</div>\n";
		
echo "<div   class='highslide-caption '><div id='banane' >";
	echo stripslashes(parseubb(parsesmileys($data['photo_description'], "")))."";
echo "</div>\n</div>\n";
		echo "</div>\n";
		echo "<div align='center' style='margin:5px 0px 5px 0px' class='photogallery_photo_desc'><!--photogallery_photo_desc-->\n";
		if ($data['photo_description']) {
			echo stripslashes(parseubb(parsesmileys($data['photo_description'], "")))."<br /><br />\n";
		}
		echo $locale['433'].showdate("shortdate", $data['photo_datestamp'])."<br />\n";
		echo $locale['434'].profile_link($data['user_id'], $data['user_name'], $data['user_status'])."<br />\n";
		echo $locale['454']."$photo_size[0] x $photo_size[1] ".$locale['455']."<br />\n";
		echo $locale['456'].parsebytesize($settings['photo_watermark'] ? filesize(PHOTODIR.$data['photo_filename']): filesize($photo_file))."<br />\n";
		$photo_comments = dbcount("(comment_id)", DB_COMMENTS, "comment_type='P' AND comment_item_id='".$_GET['photo_id']."'");
		echo ($data['photo_allow_comments'] ? ($photo_comments == 1 ? $locale['436b'] : $locale['436']).$photo_comments."<br />\n" : "");
		echo ($data['photo_allow_ratings'] ? $locale['437'].($data['count_votes'] > 0 ? str_repeat("<img src='".get_image("star")."' alt='*' style='vertical-align:middle' />", ceil($data['sum_rating'] / $data['count_votes'])) : $locale['438'])."<br />\n" : "");
		echo $locale['457'].$data['photo_views']."\n</div>\n";
		echo "<!--sub_photo-->";
		echo "&nbsp;".$r8hl_gallery_info;
		closetable();
		if ($data['photo_allow_comments']) { showcomments("P", DB_PHOTOS, "photo_id", $_GET['photo_id'], FUSION_SELF."?photo_id=".$_GET['photo_id']); }
		if ($data['photo_allow_ratings']) { showratings("P", $_GET['photo_id'], FUSION_SELF."?photo_id=".$_GET['photo_id']); }
	}
} elseif (isset($_GET['album_id']) && isnum($_GET['album_id'])) {
	define("PHOTODIR", PHOTOS.(!SAFEMODE ? "album_".$_GET['album_id']."/" : ""));
	$result = dbquery(
		"SELECT album_title, album_description, album_thumb, album_access FROM ".DB_PHOTO_ALBUMS." WHERE album_id='".$_GET['album_id']."'"
	);
	if (!dbrows($result)) {
		redirect(FUSION_SELF);
	} else {
		$data = dbarray($result);
		if (!checkgroup($data['album_access'])) {
			redirect(FUSION_SELF);
		} else {
			$rows = dbcount("(photo_id)", DB_PHOTOS, "album_id='".$_GET['album_id']."'");
			add_to_title($locale['global_201'].$data['album_title']);
			opentable($locale['420']);
			echo "<!--pre_album_info-->";
			echo "<table cellpadding='0' cellspacing='0' width='80%' class='center'>\n<tr>\n";
			echo "<td rowspan='2' align='center' class='tbl1 photogallery_album_thumb'><!--photogallery_album_thumb-->";
				if ($data['album_thumb'] && file_exists(PHOTOS.$data['album_thumb'])){
					echo "<img src='".PHOTOS.$data['album_thumb']."' alt='".$data['album_thumb']."' />";
				} else {
				echo "<img src='".INFUSIONS."R8HL_photogallery_panel/R8PG.gif' /><br />".$locale['402'];
				}
			echo "</td>\n";
			echo "<td valign='top' width='100%'><div class='tbl2' style='font-weight:bold;vertical-align:top'>".$locale['421'].trimlink($data['album_title'],20)."</div>\n";
			echo "<div class='tbl1 photogallery_album_desc' style='vertical-align:middle'><!--photogallery_album_desc-->".nl2br(parseubb($data['album_description']))."</div>\n</td>\n</tr>\n";
			echo "<tr>\n<td valign='bottom' width='100%'>\n<div class='tbl2' style='vertical-align:bottom'>\n";
			if ($rows) {
				$pdata = dbarray(dbquery("
					SELECT tp.photo_datestamp, tu.user_id, tu.user_name, tu.user_status FROM ".DB_PHOTOS." tp
					LEFT JOIN ".DB_USERS." tu ON tp.photo_user=tu.user_id
					WHERE album_id='".$_GET['album_id']."' ORDER BY photo_datestamp DESC LIMIT 1"
				));
				echo $locale['422']."$rows<br />\n";
				echo $locale['423'].profile_link($pdata['user_id'], $pdata['user_name'], $pdata['user_status'])."".$locale['424'].showdate("longdate", $pdata['photo_datestamp'])."\n<br />&nbsp;".$r8hl_gallery_info;
			} else {
				echo $locale['425']."\n<a style=' margin-left: 30px;' href='".BASEDIR."R8HL-photogallery.php'><b><span class='fa fa-reply' ></span>&nbsp;&nbsp;".$locale['global_090']."</b></a><br />&nbsp;".$r8hl_gallery_info;
			}
			echo "</div>\n</td>\n</tr>\n</table>";
			echo "<!--sub_album_info-->";
			closetable();
			if ($rows) {
				opentable($locale['430']);
				if (!isset($_GET['rowstart']) || !isnum($_GET['rowstart'])) { $_GET['rowstart'] = 0; }
				$result = dbquery("
					SELECT tp.photo_id, tp.photo_title, tp.photo_thumb1, tp.photo_views, tp.photo_datestamp, tp.photo_allow_comments, tp.photo_allow_ratings,
					tu.user_id, tu.user_name, tu.user_status, SUM(tr.rating_vote) AS sum_rating, COUNT(tr.rating_item_id) AS count_votes
					FROM ".DB_PHOTOS." tp
					LEFT JOIN ".DB_USERS." tu ON tp.photo_user=tu.user_id
					LEFT JOIN ".DB_RATINGS." tr ON tr.rating_item_id = tp.photo_id AND tr.rating_type='P'
					WHERE album_id='".$_GET['album_id']."' GROUP BY photo_id ORDER BY photo_order LIMIT ".$_GET['rowstart'].",".$settings['thumbs_per_page']
				);
				$counter = 0;
				echo "<table cellpadding='0' cellspacing='1' width='100%'>\n<tr>\n<td class='tbl2'>\n";
				echo "<a href='".FUSION_SELF."'>".$locale['400']."</a> &gt;\n";
				echo "<a href='".FUSION_SELF."?album_id=".$_GET['album_id']."'>".trimlink($data['album_title'],20)."</a>\n";
				echo "</td>\n</tr>\n</table>\n";
				if ($rows > $settings['thumbs_per_page']) { echo "<div align='center' style='margin-top:5px;'>\n".makepagenav($_GET['rowstart'], $settings['thumbs_per_page'], $rows, 3, FUSION_SELF."?album_id=".$_GET['album_id']."&amp;")."\n</div>\n"; }
				echo "<table cellpadding='0' cellspacing='1' width='100%'>\n<tr>\n";
				while ($data = dbarray($result)) {
					if ($counter != 0 && ($counter % $settings['thumbs_per_row'] == 0)) { echo "</tr>\n<tr>\n"; }
					echo "<td align='center' valign='top' class='tbl'>\n";
					echo $data['photo_title'] ? "<strong>".trimlink($data['photo_title'],30)."</strong>":$locale['R8PG001'];
					echo "<br /><br />\n<a href='".FUSION_SELF."?photo_id=".$data['photo_id']."#gallery_top' class='photogallery_album_photo_link'><!--photogallery_album_photo_".$data['photo_id']."-->";
					if ($data['photo_thumb1'] && file_exists(PHOTODIR.$data['photo_thumb1'])){
						echo "<img src='".PHOTODIR.$data['photo_thumb1']."' alt='".$data['photo_thumb1']."' title='".$locale['431']."' style='border:0px' class='photogallery_album_photo' />";
					} else {
						echo $locale['432'];
					}
					echo "</a><br /><br />\n<span class='small photogallery_album_photo_info'> <!--photogallery_album_photo_info-->\n";
					echo $locale['433'].showdate("shortdate", $data['photo_datestamp'])."<br />\n";
					echo $locale['434'].profile_link($data['user_id'], $data['user_name'], $data['user_status'])."<br />\n";
					$photo_comments = dbcount("(comment_id)", DB_COMMENTS, "comment_type='P' AND comment_item_id='".$data['photo_id']."'");
					echo ($data['photo_allow_comments'] ? ($photo_comments == 1 ? $locale['436b'] : $locale['436']).$photo_comments."<br />\n" : "");
					echo ($data['photo_allow_ratings'] ? $locale['437'].($data['count_votes'] > 0 ? str_repeat("<img src='".get_image("star")."' alt='*' style='vertical-align:middle' />", ceil($data['sum_rating'] / $data['count_votes'])) : $locale['438'])."<br />\n" : "");
					echo $locale['435'].$data['photo_views']."</span><br />\n";
					echo "</td>\n";
					$counter++;
				}
				echo "</tr>\n</table>\n";
				closetable();
			}
			if ($rows > $settings['thumbs_per_page']) { echo "<div align='center' style='margin-top:5px;'>\n".makepagenav($_GET['rowstart'], $settings['thumbs_per_page'], $rows, 3, FUSION_SELF."?album_id=".$_GET['album_id']."&amp;")."\n</div>\n"; }
		}
	}
} else {
	opentable($locale['400']);

	$rows = dbcount("(album_id)", DB_PHOTO_ALBUMS, groupaccess('album_access'));
	if (!isset($_GET['rowstart']) || !isnum($_GET['rowstart'])) { $_GET['rowstart'] = 0; }
	if ($rows) {
		$result = dbquery(
			"SELECT ta.album_id, ta.album_title, ta.album_thumb, ta.album_datestamp,
			tu.user_id, tu.user_name, tu.user_status
			FROM ".DB_PHOTO_ALBUMS." ta
			LEFT JOIN ".DB_USERS." tu ON ta.album_user=tu.user_id
			WHERE ".groupaccess('album_access')." ORDER BY album_order
			LIMIT ".$_GET['rowstart'].",".$settings['thumbs_per_page']
		);
		$counter = 0; $r = 0; $k = 1;
		if ($rows > $settings['thumbs_per_page']) { echo "<div align='center' style='margin-top:5px;'>\n".makepagenav($_GET['rowstart'], $settings['thumbs_per_page'], $rows, 3)."\n</div>\n"; }
		echo "<table cellpadding='0' cellspacing='1' width='100%'>\n<tr>\n";
		while ($data = dbarray($result)) {
			if ($counter != 0 && ($counter % $settings['thumbs_per_row'] == 0)) { echo "</tr>\n<tr>\n"; }
			echo "<td align='center' valign='top' class='tbl'>\n";
			echo "<strong>".trimlink($data['album_title'],20)."</strong><br /><br />\n<a href='".FUSION_SELF."?album_id=".$data['album_id']."'>";
			if ($data['album_thumb'] && file_exists(PHOTOS.$data['album_thumb'])){
				echo "<img src='".PHOTOS.$data['album_thumb']."' alt='".$data['album_thumb']."' title='".$locale['401']."' style='border:0px' />";
			} else {
				echo "<img  src='".INFUSIONS."R8HL_photogallery_panel/no preview.gif' /><br />".$locale['402'];
			}
			echo "</a><br /><br />\n<span class='small'>\n";
			echo $locale['403'].showdate("shortdate", $data['album_datestamp'])."<br />\n";
			echo $locale['404'].profile_link($data['user_id'], $data['user_name'], $data['user_status'])."<br />\n";
			echo $locale['405'].dbcount("(photo_id)", DB_PHOTOS, "album_id='".$data['album_id']."'")."</span><br />\n";
			echo "</td>\n";
			$counter++; $k++;
		}
		echo "</tr>\n</table>\n";
		echo "&nbsp;".$r8hl_gallery_info;
		closetable();
		if ($rows > $settings['thumbs_per_page']) { echo "<div align='center' style='margin-top:5px;'>\n".makepagenav($_GET['rowstart'], $settings['thumbs_per_page'], $rows, 3)."\n</div>\n"; }
	}else{
		echo "<div style='text-align:center'><br /><img src='".INFUSIONS."R8HL_photogallery_panel/R8PG.gif' /><br />".$locale['R8PG000']."<br /></div>\n";
		echo "&nbsp;".$r8hl_gallery_info;
		closetable();
	}
}

if (isset($_GET['photo_id']) && isnum($_GET['photo_id'])){
	$result88 = dbarray(dbquery(
		"SELECT tp.photo_title, tp.photo_description, tp.photo_filename, tp.photo_thumb2, tp.photo_datestamp, tp.photo_views,
		tp.photo_order, tp.photo_allow_comments, tp.photo_allow_ratings, ta.album_id, ta.album_title, ta.album_access,
		tu.user_id, tu.user_name, tu.user_status, SUM(tr.rating_vote) AS sum_rating, COUNT(tr.rating_item_id) AS count_votes
		FROM ".DB_PHOTOS." tp
		LEFT JOIN ".DB_PHOTO_ALBUMS." ta USING (album_id)
		LEFT JOIN ".DB_USERS." tu ON tp.photo_user=tu.user_id
		LEFT JOIN ".DB_RATINGS." tr ON tr.rating_item_id = tp.photo_id AND tr.rating_type='P'
		WHERE photo_id='".$_GET['photo_id']."' GROUP BY tp.photo_id"
	));
	
	$result = dbquery("SELECT *	FROM ".DB_PHOTOS." WHERE  album_id='".$result88['album_id']."' ORDER BY photo_id " );
		while ($data = dbarray($result)) {
$no_title = $data['photo_title'] ? trimlink($data['photo_title'],45)."" : $locale['R8PG001']."";
echo "<a style='display:none' class='highslide' href='".PHOTODIR.$data['photo_filename']."' title='".$no_title."' onclick='return hs.expand(this)'><img src='".PHOTODIR. $data['photo_filename']."' alt='".$no_title."' /></a>";
echo "<div class='highslide-heading'><div id='banane' >";
echo ($data['photo_title'] ? stripslashes(parseubb(parsesmileys(trimlink($data['photo_title'],45))))."" : $locale['R8PG001']."")."\n";
echo "</div>\n</div>\n";
echo "<div class='highslide-caption '><div id='banane' >";
	echo stripslashes(parseubb(parsesmileys($data['photo_description'], "")))."";
echo "</div>\n</div>\n";
}
}
require_once THEMES."templates/footer.php";
?>
