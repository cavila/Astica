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

define ('JA_TOOL_COLOR', 'ja_color');
define ('JA_TOOL_SCREEN', 'ja_screen');
define ('JA_TOOL_FONT', 'ja_font');
define ('JA_TOOL_MENU', 'ja_menu');
define ('JA_TOOL_USER', 'usertool');

class JA_Tools {
	var $_params_cookie = null; //Params will store in cookie for user select. Default: store all params
	var $_tpl = null;
	var $template = 'ja_teline';
	//This default value could override by setting with function setScreenSizes() and setColorThemes()
	var $_ja_screen_sizes = array ('narrow', 'wide');
	var $_ja_color_themes = array('default', 'pink', 'green', 'red');

	function JA_Tools ($template, $_params_cookie=null) {
		$this->_tpl = $template;
		$this->template = $template->template;
		if(!$_params_cookie) {
			$this->_params_cookie = $this->_tpl->params->toArray();
		} else {
			foreach ($_params_cookie as $k) {
				$this->_params_cookie[$k] = $this->_tpl->params->get($k);
			}
		}

		$this->getUserSetting();
	}

	function getUserSetting(){
		$exp = time() + 60*60*24*355;
		if (isset($_COOKIE[$this->template.'_tpl']) && $_COOKIE[$this->template.'_tpl'] == $this->template){
			foreach($this->_params_cookie as $k=>$v) {
				$kc = $this->template."_".$k;
				if (isset($_GET[$k])){
					$v = $_GET[$k];
					setcookie ($kc, $v, $exp, '/');
				}else{
					if (isset($_COOKIE[$kc])){
						$v = $_COOKIE[$kc];
					}
				}
				$this->setParam($k, $v);
			}

		}else{
			@setcookie ($this->template.'_tpl', $this->template, $exp, '/');
		}
		return $this;
	}

	function getParam ($param) {
		if (isset($this->_params_cookie[$param])) {
			return $this->_params_cookie[$param];
		}
		return $this->_tpl->params->get($param);
	}

	function setParam ($param, $value) {
		$this->_params_cookie[$param] = $value;
	}

	function getCurrentURL(){
		$cururl = JRequest::getURI();
		if(($pos = strpos($cururl, "index.php"))!== false){
			$cururl = substr($cururl,$pos);
		}
		$cururl =  JRoute::_($cururl, true, 0);
		return $cururl;
	}
	
	function genToolMenu($ja_tools, $imgext = 'gif'){
		?>
		
		<?php
		if ($ja_tools & 2){//show font tools
		?>	
			<span class="ja-usertools-font">
			 <a><img style="cursor: pointer;" title="<?php echo JText::_('Decrease font size');?>" src="<?php echo $this->templateurl();?>/images/user-decrease.<?php echo $imgext;?>" alt="<?php echo JText::_('Decrease font size');?>" id="ja-tool-decrease" onclick="switchFontSize('<?php echo $this->template."_".JA_TOOL_FONT;?>','dec'); return false;" /></a>&nbsp;
	      	<a><img style="cursor: pointer;" title="<?php echo JText::_('Default font size');?>" src="<?php echo $this->templateurl();?>/images/user-reset.<?php echo $imgext;?>" alt="<?php echo JText::_('Default font size');?>" id="ja-tool-reset" onclick="switchFontSize('<?php echo $this->template."_".JA_TOOL_FONT;?>',<?php echo $this->_tpl->params->get(JA_TOOL_FONT);?>); return false;" /></a>&nbsp;
		   <a><img style="cursor: pointer;" title="<?php echo JText::_('Increase font size');?>" src="<?php echo $this->templateurl();?>/images/user-increase.<?php echo $imgext;?>" alt="<?php echo JText::_('Increase font size');?>" id="ja-tool-increase" onclick="switchFontSize('<?php echo $this->template."_".JA_TOOL_FONT;?>','inc'); return false;" /></a>&nbsp;
			</span>
			<script type="text/javascript">var CurrentFontSize=parseInt('<?php echo $this->getParam(JA_TOOL_FONT);?>');</script>
			<?php
		}
		if ($ja_tools & 4){//show color tools
			?>
			<ul class="ja-usertools-color">
			<?php
			foreach ($this->_ja_color_themes as $ja_color_theme) {
				echo "
				<li><img style=\"cursor: pointer;\" src=\"".$this->templateurl()."/images/".$ja_color_theme.( ($this->getParam(JA_TOOL_COLOR)==$ja_color_theme) ? "-hilite" : "" ).".".$imgext."\" title=\"".$ja_color_theme." color\" alt=\"".$ja_color_theme." color\" id=\"ja-tool-".$ja_color_theme."color\" onclick=\"switchTool('".$this->template."_".JA_TOOL_COLOR."','$ja_color_theme');return false;\" /></li>
				";
			} 
			?>
				</ul>
			<?php
		}
		
	}

	function setScreenSizes ($_array_screen_sizes) {
		$this->_ja_screen_sizes = $_array_screen_sizes;
	}

	function setColorThemes ($_array_color_themes) {
		$this->_ja_color_themes = $_array_color_themes;
	}

	function getCurrentMenuIndex(){
		$Itemid = JRequest::getInt( 'Itemid');
		$database		=& JFactory::getDBO();
		$id = $Itemid;
		$menutype = 'mainmenu';
		$ordering = '0';
		while (1){
			$sql = "select parent, menutype, ordering from #__menu where id = $id limit 1";
			$database->setQuery($sql);
			$row = null;
			$row = $database->loadObject();
			if ($row) {
				$menutype = $row->menutype;
				$ordering = $row->ordering;
				if ($row->parent > 0)
				{
					$id = $row->parent;
				}else break;
			}else break;
		}

		$user	=& JFactory::getUser();
		if (isset($user))
		{
			$aid = $user->get('aid', 0);
			$sql = "SELECT count(*) FROM #__menu AS m"
			. "\nWHERE menutype='". $menutype ."' AND published='1' AND access <= '$aid' AND parent=0 and ordering < $ordering";
		} else {
			$sql = "SELECT count(*) FROM #__menu AS m"
			. "\nWHERE menutype='". $menutype ."' AND published='1' AND parent=0 and ordering < $ordering";
		}
		$database->setQuery($sql);

		return $database->loadResult();
	}
	
	function menuname() {
		$id = getCurrentMenuIndex();
		$database		=& JFactory::getDBO();
		
	
	}

	function calSpotlight ($spotlight, $totalwidth=100, $firstwidth=0) {

		/********************************************
		$spotlight = array ('position1', 'position2',...)
		*********************************************/
		$modules = array();
		$modules_s = array();
		foreach ($spotlight as $position) {
			if( $this->_tpl->countModules ($position) ){
				$modules_s[] = $position;
			}
			$modules[$position] = array('class'=>'-full');
		}

		if (!count($modules_s)) return null;

		if ($firstwidth) {
			if (count($modules_s)>1) {
				$width = round(($totalwidth-$firstwidth)/(count($modules_s)-1),1) . "%";
				$firstwidth = $firstwidth . "%";
			}else{
				$firstwidth = $totalwidth . "%";
			}
		}else{
			$width = round($totalwidth/(count($modules_s)),1) . "%";
			$firstwidth = $width;
		}

		if (count ($modules_s) > 1){
			$modules[$modules_s[0]]['class'] = "-left";
			$modules[$modules_s[0]]['width'] = $firstwidth;
			$modules[$modules_s[count ($modules_s) - 1]]['class'] = "-right";
			$modules[$modules_s[count ($modules_s) - 1]]['width'] = $width;
			for ($i=1; $i<count ($modules_s) - 1; $i++){
				$modules[$modules_s[$i]]['class'] = "-center";
				$modules[$modules_s[$i]]['width'] = $width;
			}
		}
		return $modules;
	}

	function isIE6 () {
		$msie='/msie\s(5\.[5-9]|[6]\.[0-9]*).*(win)/i';
		return isset($_SERVER['HTTP_USER_AGENT']) &&
			preg_match($msie,$_SERVER['HTTP_USER_AGENT']) &&
			!preg_match('/opera/i',$_SERVER['HTTP_USER_AGENT']);
	}

    function noBG4IE6() {
	if ($this->isIE6())
	echo ' style="background: none;"';
	}

	function baseurl(){
		return JURI::base();
	}

	function templateurl(){
		return JURI::base()."templates/".$this->template;
	}

	function getRandomImage ($img_folder) {
		$imglist=array();

		mt_srand((double)microtime()*1000);

		//use the directory class
		$imgs = dir($img_folder);

		//read all files from the  directory, checks if are images and ads them to a list (see below how to display flash banners)
		while ($file = $imgs->read()) {
			if (eregi("gif", $file) || eregi("jpg", $file) || eregi("png", $file))
				$imglist[] = $file;
		}
		closedir($imgs->handle);

		if(!count($imglist)) return '';

		//generate a random number between 0 and the number of images
		$random = mt_rand(0, count($imglist)-1);
		$image = $imglist[$random];

		return $image;
	}

	function isFrontPage(){
		return (JRequest::getCmd('option')=='com_content' && !JRequest::getInt('id'));
	}

	function sitename() {
		$config = new JConfig();
		return $config->sitename;
	}

	function genMenuHead(){
		$html = "";
		if ($this->getParam(JA_TOOL_MENU)== '1') {
				$html = '<link href="'.$this->templateurl().'/ja_menus/ja_splitmenu/ja.splitmenu.css" rel="stylesheet" type="text/css" />';
		}else if ($this->getParam(JA_TOOL_MENU)== '2') {
				$html = '<link href="'.$this->templateurl().'/ja_menus/ja_cssmenu/ja.cssmenu.css" rel="stylesheet" type="text/css" />
					<script language="javascript" type="text/javascript" src="'. $this->templateurl().'/ja_menus/ja_cssmenu/ja.cssmenu.js"></script>';
		} else if ($this->getParam(JA_TOOL_MENU) == 5) {
			$html = '<link href="'.$this->templateurl().'/ja_menus/ja_scriptdlmenu/ja.scriptdlmenu.css" rel="stylesheet" type="text/css" />
					<script language="javascript" type="text/javascript" src="'.$this->templateurl().'/ja_menus/ja_scriptdlmenu/ja-scriptdlmenu.js"></script>';
		} else if ($this->getParam(JA_TOOL_MENU) == 4) {
			$html = '<link href="'.$this->templateurl().'/ja_menus/ja_cssmenu/ja.sosdmenu.css" rel="stylesheet" type="text/css" />
						<script language="javascript" type="text/javascript" src="'.$this->templateurl().'/ja_menus/ja_cssmenu/ja.moomenu.js"></script>';
		}
		else if ($this->getParam(JA_TOOL_MENU) == 3) {
			$html = '<link href="'.$this->templateurl().'/ja_menus/ja_transmenu/ja.transmenuh.css" rel="stylesheet" type="text/css" />
						<script language="javascript" type="text/javascript" src="'.$this->templateurl().'/ja_menus/ja_transmenu/ja-transmenu.js"></script>';
		}
		if ($this->getParam(JA_TOOL_USER)){
		?>
			<script type="text/javascript">
			var currentFontSize = <?php echo $this->getParam(JA_TOOL_FONT); ?>;
			</script>
		<?php
		}
		echo $html;
	}
	
	function getOpenMenuItems($menutype = 'mainmenu'){
		global $mosConfig_shownoauth;
		$Itemid  = JRequest::getInt('Itemid');
		$database = JFactory::getDBO();
		$my = JFactory::getUser();
		if ($mosConfig_shownoauth) {
			$sql = "SELECT m.* FROM #__menu AS m"
			. "\nWHERE menutype='". $menutype ."' AND published='1'"
			. "\nORDER BY parent,ordering";
		} else {
			$sql = "SELECT m.* FROM #__menu AS m"
			. "\nWHERE menutype='". $menutype ."' AND published='1' AND access <= '$my->gid'"
			. "\nORDER BY parent,ordering";
		}
		$database->setQuery( $sql );
		$rows = $database->loadObjectList( 'id' );

		// establish the hierarchy of the menu
		$children = array();
		// first pass - collect children
		foreach ($rows as $v ) {
			$pt = $v->parent;
			$list = (isset($children[$pt]) && $children[$pt]) ? $children[$pt] : array();
			array_push( $list, $v );
			$children[$pt] = $list;
		}

		// second pass - collect 'open' menus
		$open = array( $Itemid );
		$count = 20; // maximum levels - to prevent runaway loop
		$id = $Itemid;
		while (--$count) {
			if (isset($rows[$id]) && $rows[$id]->parent > 0) {
				$id = $rows[$id]->parent;
				$open[] = $id;
			} else {
				break;
			}
		}
  		return $open;
	}
	function genColorHead(){
		$html = '';
		foreach ($this->_ja_color_themes as $ja_color_theme) {
			if ($this->getParam(JA_TOOL_COLOR) == $ja_color_theme){
				$html .= '<link href="'.$this->templateurl().'/css/color/'.$ja_color_theme.'.css" rel="stylesheet" type="text/css" title="ColorCSS_'.$ja_color_theme.'" />'."\n";
			}else{
				if ($this->getParam(JA_TOOL_MENU) & 2) //Load this css when color tool enabled
					$html .= '<link href="'.$this->templateurl().'/css/color/'.$ja_color_theme.'.css" rel="alternate stylesheet" type="text/css" title="ColorCSS_'.$ja_color_theme.'" />'."\n";
			}
		}
		return $html;
	}
}	
?>
