<?php 
/*------------------------------------------------------------------------
# JA Larix  for Joomla 1.5 - Version 1.4 - Licence Owner JA130602
# ------------------------------------------------------------------------
# Copyright (C) 2004-2008 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: J.O.O.M Solutions Co., Ltd
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once (JPATH_SITE .DS.'modules'.DS.'mod_janews'.DS.'helper.php');


$jc 		=& new JConfig();
$database 	=& JFactory::getDBO();
$user		=& JFactory::getUser();
$mainObject =& JFactory::getApplication('site');
$registry 	=& JFactory::getConfig();
$livesite 	=  $registry->getValue('config.live_site');
$document	=& JFactory::getDocument();

$showintro 				= 	$params->get( 'showintro', 0 );
$showimage 				= 	$params->get( 'showimage', 0 );
$autoroll 				= 	($params->get( 'autoroll', 1 )) ? 1 : 0;
$catid 					= 	trim( $params->get( 'catid' ));
$headlinelang 			= 	trim( $params->get( 'headlinelang' ));
$headlineheight 		= 	intval ($params->get( 'headlineheight' ));
$showheadline 			= 	intval (trim( $params->get( 'showheadline', 0 )));
$linksitem 				= 	intval (trim( $params->get( 'linkitems', 0 ) ));
$maxchars 				= 	intval (trim( $params->get( 'maxchars', 200 ) ));
$width 					= 	intval (trim( $params->get( 'width', 100 ) ));
$height 				= 	intval (trim( $params->get( 'height', 100 ) ));
$cols					= 	intval (trim( $params->get( 'cols', 2 ) ));
$numberofheadlinenews 	= 	intval (trim( $params->get( 'numberofheadlinenews', 10 ) ));
$delaytime 				= 	intval (trim( $params->get( 'delaytime', 5 ) ));
$autoresize 			= 	intval (trim( $params->get( 'autoresize', 0) ));
$align 					= $params->get( 'align' , 'left');

$now 					= date( 'Y-m-d H:i', time() );
$nullDate 				= $database->getNullDate();

$contentConfig 			= &JComponentHelper::getParams( 'com_content' );
$access					= !$contentConfig->get('shownoauth');

JHTML::stylesheet('ja-news.css','modules/mod_janews/ja_news/');

if ($catid) $catids = split(",", $catid);
else {
	$query = "SELECT id FROM #__categories WHERE published = 1;";
	$database->setQuery($query);
	$c = $database->loadObjectList();
	$catids = array();
	foreach($c as $_c) $catids[] = $_c->id;
}

if ($showheadline) {
	$query = "SELECT COUNT(*)"
			. "\n FROM #__content AS a"
			. "\n INNER JOIN #__content_frontpage AS f ON f.content_id = a.id"
			. "\n INNER JOIN #__categories AS cc ON cc.id = a.catid"
			. "\n WHERE ( a.state = 1 AND a.sectionid > 0 "
			. "\n AND ( a.publish_up = '$nullDate' OR a.publish_up <= '$now' )"
			. "\n AND ( a.publish_down = '$nullDate' OR a.publish_down >= '$now' )"
			. ( $access ? "\n AND a.access <= ".$user->get('aid', 0)." AND cc.access <= ".$user->get('aid', 0) : '' )
			. "\n AND cc.published = 1 )";
	$database->setQuery($query);
	$c = $database->loadResult();
	
	$numberofheadlinenews = ($numberofheadlinenews < $c) ? $numberofheadlinenews : $c;

	$query = "SELECT a.*,"
			. "\n CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug,"
			. "\n CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(':', cc.id, cc.alias) ELSE cc.id END as catslug"
			. "\n FROM #__content AS a"
			. "\n INNER JOIN #__content_frontpage AS f ON f.content_id = a.id"
			. "\n INNER JOIN #__categories AS cc ON cc.id = a.catid"
			. "\n WHERE ( a.state = 1 AND a.sectionid > 0 "
			. "\n AND ( a.publish_up = '$nullDate' OR a.publish_up <= '$now' )"
			. "\n AND ( a.publish_down = '$nullDate' OR a.publish_down >= '$now' )"
			. ( $access ? "\n AND a.access <= ".$user->get('aid', 0)." AND cc.access <= ".$user->get('aid', 0) : '' )
			. "\n AND cc.published = 1 )"
			. "\n ORDER BY f.ordering ASC limit 1";
	$database->setQuery($query);
	$firstnew = $database->loadObject();
	
	if ($firstnew) {
		$headlineid = $firstnew->id;
		echo "<div class=\"ja-newshlwrap\">";
		echo "<div class=\"ja-newsblock clearfix\" style=\"width: 100%;". ($headlineheight ? " height: {$headlineheight}px; overflow: hidden;" : "") ."\">";
		
		$bs 	= $mainObject->getBlogSectionCount();
		$bc 	= $mainObject->getBlogCategoryCount();
		$gbs 	= $mainObject->getGlobalBlogSectionCount();
		$link   = ContentHelperRoute::getArticleRoute($firstnew->slug, $firstnew->catslug, $firstnew->sectionid);
		echo "<div class=\"ja-newsitem\" style=\"width: 100%;\">\n";
		echo "<div class=\"ja-newsitem-inner\" style=\"width: 100%;\">\n";
		if ($numberofheadlinenews > 1) {
			if (isset($_COOKIE['JAHL-AUTOROLL'])) $autoroll = ($_COOKIE['JAHL-AUTOROLL']) ? 1 : 0;
			setcookie("JAHL-AUTOROLL", $autoroll, 0, "/");
			?>
			<script type="text/javascript">
				var jahl = new Object
				jahl.livesite = '<?php echo $livesite; ?>';
				jahl.autoroll = <?php echo ($autoroll) ? "true" : "false" ?>;
				jahl.delaytime = <?php echo $delaytime; ?>;
				jahl.total = <?php echo $numberofheadlinenews; ?>;
				jahl.current = 1;
			</script>
			<?php
			//JHTML::script('janews.js', $path = 'modules/mod_janews/ja_news/');

			echo "<script type=\"text/javascript\" src=\"modules/mod_janews/ja_news/janews.js\"></script>\n";
		}
		echo "<div class=\"ja-newscat\"><span id=\"jahl-headlineanchor\">{$headlinelang}</span>";
		if ($numberofheadlinenews > 1) {
			$query = "SELECT a.title"
					. "\n FROM #__content AS a"
					. "\n INNER JOIN #__content_frontpage AS f ON f.content_id = a.id"
					. "\n INNER JOIN #__categories AS cc ON cc.id = a.catid"
					. "\n WHERE ( a.state = 1 AND a.sectionid > 0 "
					. "\n AND ( a.publish_up = '$nullDate' OR a.publish_up <= '$now' )"
					. "\n AND ( a.publish_down = '$nullDate' OR a.publish_down >= '$now' )"
					. ( $access ? "\n AND a.access <= ".$user->get('aid', 0)." AND cc.access <= ".$user->get('aid', 0) : '' )
					. "\n AND cc.published = 1 )"
					. "\n ORDER BY f.ordering ASC limit 1, 1";
			$database->setQuery($query);
			$nexttitle = $database->loadResult();
			
			$query = "SELECT a.title"
					. "\n FROM #__content AS a"
					. "\n INNER JOIN #__content_frontpage AS f ON f.content_id = a.id"
					. "\n INNER JOIN #__categories AS cc ON cc.id = a.catid"
					. "\n WHERE ( a.state = 1 AND a.sectionid > 0 "
					. "\n AND ( a.publish_up = '$nullDate' OR a.publish_up <= '$now' )"
					. "\n AND ( a.publish_down = '$nullDate' OR a.publish_down >= '$now' )"
					. ( $access ? "\n AND a.access <= ".$user->get('aid', 0)." AND cc.access <= ".$user->get('aid', 0) : '' )
					. "\n AND cc.published = 1 )"
					. "\n ORDER BY f.ordering ASC limit ". ($numberofheadlinenews - 1) .", 1";
			$database->setQuery($query);
			$prevtitle = $database->loadResult();
		
			echo "<div class=\"jahl-newscontrol\">";
			echo "<img id=\"loading-indicator\" style=\"display: none;\" src=\"modules/mod_janews/ja_news/loading.gif\" alt=\"Loading\" border=\"0\" />\n";
			echo "<ul>";
			echo "<li>".($autoroll ? "<img title=\"Pause\" style=\"cursor: pointer;\" id=\"jahl-switcher\" onclick=\"jahl.switchRoll(); return false;\" src=\"modules/mod_janews/ja_news/pause.png\" alt=\"Pause\" border=\"0\" />" : "<img title=\"Play\" style=\"cursor: pointer;\" id=\"jahl-switcher\" onclick=\"jahl.switchRoll(); return false;\" src=\"modules/mod_janews/ja_news/play.png\" alt=\"Play\" border=\"0\" />")."</li>\n";
			echo "<li><img title=\"Previous: ".trim(htmlentities($prevtitle))."\" style=\"cursor: pointer;\" onclick=\"jahl.showNews(((jahl.current==1)?jahl.total : jahl.current - 1), jahl.total); return false;\" id=\"jahl-prev\" src=\"modules/mod_janews/ja_news/prev.png\" alt=\"Previous\" border=\"0\" /></li>\n";
			echo "<li><img title=\"Next: ".trim(htmlentities($nexttitle))."\" style=\"cursor: pointer;\" onclick=\"jahl.showNews(((jahl.current==jahl.total)?1 : jahl.current + 1), jahl.total); return false;\" id=\"jahl-next\" src=\"modules/mod_janews/ja_news/next.png\" alt=\"Next\" border=\"0\" /></li>\n";
			echo "</ul>";
			echo "<span id=\"jahl-indicator\">1/{$numberofheadlinenews}</span>\n";
			echo "</div>";
		}
		echo  "</div>\n";
		echo "<div id=\"jahl-newsitem\">\n";

		//$image = modJaNewsHelper::replaceImage ($firstnew, $align, 0, 0, 1 );
		echo "<div class=\"ja-newscontent\">\n";
		//echo $image. "\n";
		echo "<a href=\"$link\" class=\"ja-newstitle\" title=\"".trim(htmlentities($firstnew->title))."\">{$firstnew->title}</a>\n";
		echo "{$firstnew->introtext}\n</div>\n";
		echo "<a href=\"$link\" class=\"readon\">Read more</a>";
		echo "</div>\n</div>\n</div></div></div>\n";
		echo "<span class=\"article_seperator\">&nbsp;</span>";
	}
}

if ($cols > 0) {
	echo "<div class=\"ja-newscatwrap\">";  
	$modwidth = round(100 / $cols, 2) ;
	$l = 0;
	$modStyle = modJaNewsHelper::calModStyle ($cols);
	$isrowopen = false;
	for ($k=0;$k<count($catids);++$k){
		$query = "SELECT a.*, cc.title as cattitle, cc.description as catdesc,"
				. "\n CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug,"
				. "\n CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(':', cc.id, cc.alias) ELSE cc.id END as catslug"
				. "\n FROM #__content AS a"
				. "\n LEFT JOIN #__content_frontpage AS f ON f.content_id = a.id"
				. "\n INNER JOIN #__categories AS cc ON cc.id = a.catid"
				. "\n WHERE ( a.state = 1 AND a.sectionid > 0 "
				. "\n AND ( a.publish_up = '$nullDate' OR a.publish_up <= '$now' )"
				. "\n AND ( a.publish_down = '$nullDate' OR a.publish_down >= '$now' )"
				. ( $access ? "\n AND a.access <= ".$user->get('aid', 0)." AND cc.access <= ".$user->get('aid', 0) : '' )
				. ( $catids ? "\n AND ( a.catid = {$catids[$k]} )" : "" )
				. ( isset($headlineid) ? "\n AND a.id <> $headlineid" : "" )
				. "\n AND cc.published = 1 )"
				. "\n ORDER BY a.created DESC limit " . ($linksitem+1);
		$database->setQuery( $query );
		$temp = $database->loadObjectList();

		$rows = array();
		if (count($temp)) {
			foreach ($temp as $row ) {
				$rows[] = $row;
			}
		}
		unset($temp);
		if (count($rows)) {
			$bs 	= $mainObject->getBlogSectionCount();
			$bc 	= $mainObject->getBlogCategoryCount();
			$gbs 	= $mainObject->getGlobalBlogSectionCount();

			// Output
			if ($l == 0){
				//Begin a row
				echo "<div class=\"ja-newsblock clearfix\">\n";
				$isrowopen = true;
			}

			//get Itemid of category
			$link   = ContentHelperRoute::getArticleRoute($rows[0]->slug, $rows[0]->catslug, $rows[0]->sectionid);
		
			echo "<div class=\"ja-newsitem{$modStyle[$l]['class']}\" style=\"width: {$modStyle[$l]['width']};\"><div class=\"ja-newsitem-inner\" style=\"width:{$modStyle[$l]['subwidth']};\">\n";
			echo "<a href=\"$link\" class=\"ja-newscat\" title=\"".trim(htmlentities($rows[0]->catdesc))."\"><span>{$rows[0]->cattitle}</span></a>\n";

			$hasul = true;

			for ( $i=0; $i<count($rows); $i++ ) {
				$row = $rows[$i];
				$link   = ContentHelperRoute::getArticleRoute($row->slug, $row->catslug, $row->sectionid);
				$image = modJaNewsHelper::replaceImage ($row, $align, $autoresize, $maxchars, $showimage, $width, $height );

				if ($i == 0){
					//Show the latest news
						echo "<div class=\"ja-newscontent\">\n";
						echo $image. "\n";
						echo "<a href=\"$link\" class=\"ja-newstitle\" title=\"".($showintro ? $row->title : $row->introtext1)."\">{$row->title}</a>\n";
  					if ($showintro){
  						if ($maxchars)
                echo "{$row->introtext1}\n";
              else  
                echo "{$row->introtext}\n";
  					}	
            echo "</div>\n";
						if (count ($rows) > 1) echo "<ul class=\"ja-newslinks\">\n"; else $hasul = false;
				}else{
					?>
					<li>
					<a title="<?php echo $row->introtext1; ?>" href="<?php echo $link; ?>">
					<?php echo $row->title; ?></a>
					</li>
					<?php
				}
			}
			if ($hasul) echo "</ul>\n";
			echo "</div></div>\n";
			$l++;
		}
		if ($isrowopen && ($l == $cols || $k == (count ($catids)-1))){
			//End a row
			echo "</div>\n";
			echo "<span class=\"article_seperator\">&nbsp;</span>";
			$l = 0;
			$isrowopen = false;
		}
	}
	echo "</div>";
}



?>