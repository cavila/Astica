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
include_once (dirname(__FILE__).DS.'/ja_templatetools.php');

$tmpTools = new JA_Tools($this);
$tmpTools->setColorThemes(array('default','cyan', 'green'));
//Main navigation
$japarams = new JParameter('');
$japarams->set( 'menu_images_align', 'left' );
$japarams->set( 'menutype', 'mainmenu' );
$japarams->set( 'menupath', $tmpTools->templateurl() .'/ja_menus');
$menu = '';
switch ($tmpTools->getParam(JA_TOOL_MENU)) {
	case 3:
		$menu = "Transmenu";
		include_once( dirname(__FILE__).DS.'ja_menus/'.$menu.'.class.php' );
		break;
	case 2:
		$menu = "CSSmenu";
		include_once( dirname(__FILE__).DS.'ja_menus/'.$menu.'.class.php' );
		break;
	case 4:	
		$menu = "Moomenu";
		include_once( dirname(__FILE__).DS.'ja_menus/'.$menu.'.class.php' );
		break;
	case 5:	
		$menu = "DLmenu";
		include_once( dirname(__FILE__).DS.'ja_menus/'.$menu.'.class.php' );
		break;
	case 1:	
	default:
		$menu = "Splitmenu";
		include_once( dirname(__FILE__).DS.'ja_menus/'.$menu.'.class.php' );
		break;
}
$menuclass = "JA_$menu";
$jamenu = new $menuclass ($japarams);
$hasSubnav = false;
if ($jamenu->hasSubMenu (1) && $jamenu->showSeparatedSub ) 
	$hasSubnav = true;
//End for main navigation
$ja_right = $this->countModules( 'right' );
$ja_left = $this->countModules( 'left' ) || ($hasSubnav && $tmpTools->getParam(JA_TOOL_MENU)==1);

if ( $ja_left && $ja_right ) {
	$divid = '';
	} elseif ( $ja_left ) {
	$divid = '-fr';
	} elseif ( $ja_right ) {
	$divid = '-fl';
	} else {
	$divid = '-f';
}

$msie='/msie\s(5\.[5-9]|[6]\.[0-9]*).*(win)/i';
$supported_browsers = !isset($_SERVER['HTTP_USER_AGENT']) ||
	!preg_match($msie,$_SERVER['HTTP_USER_AGENT']) ||
	preg_match('/opera/i',$_SERVER['HTTP_USER_AGENT']);

?>
