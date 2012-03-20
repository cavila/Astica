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

defined('_JEXEC') or die('Restricted access');
if (!defined ('_JA_TRANS_MENU_CLASS')) {
	define ('_JA_TRANS_MENU_CLASS', 1);
	require_once (dirname(__FILE__).DS."Base.class.php");

	class JA_Transmenu extends JA_Base{

		function beginMenu($startlevel=0, $endlevel = 10){

			$direction = "TransMenu.direction.".$this->getParam('menu_direction', 'down');
			$position = "TransMenu.reference.".$this->getParam('menu_position', 'bottomLeft');
			$top = $this->getParam('p_t', 0);
			$left = $this->getParam('p_l', 0);
			$subpad_x = $this->getParam('subpad_x', 0);
			$subpad_y = $this->getParam('subpad_y', 0);
			echo '<ul id="ja-transmenu">';
			$i = 0;
			foreach ($this->children[0] as $v) {
				echo "<li>";
			    $pos = ($i == 0 ) ? 'first' : (($i == count($this->children[0])-1) ? 'last' :'');
				parent::genMenuItem ($v, 0, $pos);
				$i++;
				echo "</li>";
			}
			echo '</ul>';
			echo '
				<script type="text/javascript" language="javascript">
				//<!--[CDATA[
				if (TransMenu.isSupported()) {
					TransMenu.updateImgPath(\'',dirname(__FILE__),'/\');
					var ms = new TransMenuSet(',$direction,', ', $left,', ',$top,', ',$position,');
					TransMenu.subpad_x = ',$subpad_x,';
					TransMenu.subpad_y = ',$subpad_y,';

				';
		}
		
		function genClass ($mitem, $level, $pos) {
            $active = in_array($mitem->id, $this->open);
            $active = ($active)?'mainlevel_active':'mainlevel';
			if($this->hasSubItems($mitem->id)) $active = 'havechild-'.$active;
			$active .= '-trans';			
			//if($pos) $active .= '-'.$pos;
			return "class=\"$active\"";
		}

		function endMenu($startlevel=0, $endlevel = 10){
			echo '
					TransMenu.renderAll();
				}
				init1=function(){TransMenu.initialize();}
				if (window.attachEvent) {
					window.attachEvent("onload", init1);
				}else{
					TransMenu.initialize();
				}
				//]]-->
				</script>
			';
		}

        function hasSubMenu($level) {
            return false;
        }

		function genMenuItems($pid, $level) {
			if (@$this->children[$pid]) {
				$i = 0;
				foreach ($this->children[$pid] as $row) {

					$this->genMenuItem( $row, $level, $i);

					// show menu with menu expanded - submenus visible
					$this->genMenuItems( $row->id, $level+1 );
					$i++;
				}
			}
		}

		function genMenuItem($row, $level = 0, $pos = '', $ret = 0) {
			$txt = '';

            // replace & with amp; for xhtml compliance
            $menu_params = $this->createParameterObject($row->params);
            $menu_secure = $menu_params->def('secure', 0);

			//echo "$row->name $row->link $level<br>";
			if ($level){
				$pmenu = "tmenu$row->parent";
				//echo "$pmenu.addItem(\"$row->name\", \"$row->link\");\n";
				$active = 0;
				if ( in_array($row->id, $this->open) ) $active = 1;

				$txt = $row->name;
				if ( $this->getParam( 'menu_images' ) ) {
					$menu_params =& new $this->createParameterOjbect( $row->params );
					$menu_image = $menu_params->def( 'menu_image', -1 );
					if ( ( $menu_image <> '-1' ) && $menu_image ) {
						$image = '<img src="'. $mosConfig_live_site .'/images/stories/'. $menu_image .'" border="0" alt="'. $row->name .'"/>';
						if ( $this->getParam( 'menu_images_align' ) ) {
							$txt = $txt .' '. $image;
						} else {
							$txt = $image .' '. $txt;
						}
					}
				}
				$txt = str_replace("\"", "\\\"", $txt);
				$row->url = str_replace("&amp;", "&", $row->url);
				echo "$pmenu.addItem(\"$txt\", \"$row->url\", $row->browserNav, $active);\n";
			}else{
				$pmenu = "ms";
			}
			$cmenu = "tmenu{$row->id}";
			$idmenu = "menu{$row->id}";
			if ($this->hasSubItems($row->id)){
				if ($level == 0){
					echo "var $cmenu = ".$pmenu.".addMenu(document.getElementById(\"$idmenu\"));\n";
				}else{
					echo "var $cmenu = ".$pmenu.".addMenu(".$pmenu.".items[".$pos."]);\n";
				}
			}else{
				if ($level == 0){
					echo '
					document.getElementById("',$idmenu,'").onmouseover = function() {
						',$pmenu,'.hideCurrent();
					}
					';
				}
			}
		}

		function genMenuHead () {
			?>
			<link href="<?php echo $this->getParam('menupath'); ?>/ja_transmenu/ja.transmenuh.css" rel="stylesheet" type="text/css" />
			<script src="<?php echo $this->getParam('menupath'); ?>/ja_transmenu/ja.transmenu.js" language="javascript" type="text/javascript" ></script>
			<?php
		}
	}
}
?>