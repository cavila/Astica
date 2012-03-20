<?php 
define( '_JEXEC', 1 );

chdir ('../..');

$temppath = dirname(__FILE__);
$temppath = str_replace('\\','/',$temppath);

$temppath = str_replace('/modules/mod_janews/ja_news', '' , $temppath);

define('JPATH_BASE', $temppath );

define( 'DS', DIRECTORY_SEPARATOR );
require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_SITE .DS.'includes'.DS.'framework.php' );
require_once (JPATH_SITE .DS. 'modules'.DS.'mod_janews'.DS.'helper.php');

$splitter = md5("JA Headline");

JDEBUG ? $_PROFILER->mark( 'afterLoad' ) : null;
/**
 * CREATE THE APPLICATION
 *
 * NOTE :
 */
$mainframe =& JFactory::getApplication('site');

/**
 * INITIALISE THE APPLICATION
 *
 * NOTE :
 */
// set the language
$mainframe->initialise();


/**
 * INITIALISE THE APPLICATION
 *
 * NOTE :
 */
JPluginHelper::importPlugin('system');


// trigger the onAfterInitialise events
JDEBUG ? $_PROFILER->mark('afterInitialise') : null;
$mainframe->triggerEvent('onAfterInitialise');

/**
 * ROUTE THE APPLICATION
 *
 * NOTE :
 */
$mainframe->route();

$Itemid = JRequest::getInt( 'Itemid');
$mainframe->authorize($Itemid);

// trigger the onAfterDisplay events
JDEBUG ? $_PROFILER->mark('afterRoute') : null;
$mainframe->triggerEvent('onAfterRoute');

/**
 * DISPATCH THE APPLICATION
 *
 * NOTE :
 */
$option = JRequest::getCmd('option');
$mainframe->dispatch($option);

// trigger the onAfterDisplay events
JDEBUG ? $_PROFILER->mark('afterDispatch') : null;
$mainframe->triggerEvent('onAfterDispatch');

/**
 * RENDER  THE APPLICATION
 *
 * NOTE :
 */
$mainframe->render();

// trigger the onAfterDisplay events
JDEBUG ? $_PROFILER->mark('afterRender') : null;
$mainframe->triggerEvent('onAfterRender');


$jc 		=& new JConfig();
$database 	=& JFactory::getDBO();
$user		=& JFactory::getUser();
$now 		=  $mainframe->get('requestTime');
$access 	=  !$mainframe->getCfg( 'shownoauth' );
$nullDate 	=  $database->getNullDate();
$total		=  JRequest::getInt( 'total');
$news		=  JRequest::getInt( 'news');

$query = "SELECT a.*, cc.title as cattitle,"
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
			. "\n ORDER BY f.ordering ASC limit ". ($news - 1) .", 1";
$database->setQuery($query);
$firstnew = $database->loadObject();

$bs 	= $mainframe->getBlogSectionCount();
$bc 	= $mainframe->getBlogCategoryCount();
$gbs 	= $mainframe->getGlobalBlogSectionCount();
$link   = ContentHelperRoute::getArticleRoute($firstnew->slug, $firstnew->catslug, $firstnew->sectionid);

//$image = modJaNewsHelper::replaceImage ($firstnew, '', 0, 0, 1);
echo "<div class=\"ja-newscontent\">\n";
//echo $image. "\n";

echo "<a href=\"$link\" class=\"ja-newstitle\" title=\"".modJaNewsHelper::textprocess($firstnew->title)."\">".modJaNewsHelper::textprocess($firstnew->title)."</a>\n";
echo modJaNewsHelper::unhtmlentities(modJaNewsHelper::textprocess($firstnew->introtext)) . "\n</div>\n";
echo "<a href=\"$link\" class=\"readon\">".modJaNewsHelper::textprocess('Read more')."</a>";
echo "</div>";
		
$query = "SELECT a.title"
		. "\n FROM #__content AS a"
		. "\n INNER JOIN #__content_frontpage AS f ON f.content_id = a.id"
		. "\n INNER JOIN #__categories AS cc ON cc.id = a.catid"
		. "\n WHERE ( a.state = 1 AND a.sectionid > 0 "
		. "\n AND ( a.publish_up = '$nullDate' OR a.publish_up <= '$now' )"
		. "\n AND ( a.publish_down = '$nullDate' OR a.publish_down >= '$now' )"
		. ( $access ? "\n AND a.access <= ".$user->get('aid', 0)." AND cc.access <= ".$user->get('aid', 0) : '' )
		. "\n AND cc.published = 1 )"
		. "\n ORDER BY f.ordering ASC limit ".(($news < $total) ? $news : 0).", 1";
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
		. "\n ORDER BY f.ordering ASC limit ". (($news > 1) ? $news - 2 : $total - 1) .", 1";
$database->setQuery($query);
$prevtitle = $database->loadResult();

echo $splitter.modJaNewsHelper::textprocess($nexttitle).$splitter.modJaNewsHelper::textprocess($prevtitle);

?>