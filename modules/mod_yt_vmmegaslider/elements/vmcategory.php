<?php
/*------------------------------------------------------------------------
 # Yt Virtuemart Mega Slider  - Version 1.0
 # ------------------------------------------------------------------------
 # Copyright (C) 2010-2011 The YouTech Company. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: The YouTech Company
 # Websites: http://www.ytcvn.com
 -------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die ('Restricted access');


class JElementvmcategory extends JElement

{

    /**

     * @access private

     */

	var	$_name = 'vmcategory';
	function fetchElement($name, $value, &$node, $control_name) {

		$db = &JFactory::getDBO();

		$query = 'SELECT c.category_id as id, c.category_name as name , c.*, cx.category_parent_id  as parent FROM #__vm_category c INNER JOIN #__vm_category_xref cx ON cx.category_child_id = c.category_id WHERE category_publish="Y" AND vendor_id = 1';

		$db->setQuery( $query );

		$mitems = $db->loadObjectList();

		$children = array();
        
		if ( $mitems )

		{

			foreach ( $mitems as $v )

			{

				$pt = $v->parent;

				$list 	= @$children[$pt] ? $children[$pt] : array();

				array_push( $list, $v );

				$children[$pt] = $list;

			}

		}
		$list = JHTML::_('menu.treerecurse', 0, '|--', array(), $children, 9999, 0, 0 );

        $mitems = array();

		$mitems[] = JHTML::_('select.option', '0', '-- '.JText::_('All Categories'));		
						
		foreach ( $list as $item ) {		
			$mitems[] = JHTML::_('select.option',  $item->id , $item->treename );            

		}
		$output= JHTML::_('select.genericlist',  $mitems, ''.$control_name.'['.$name.'][]', 

						'class="inputbox" style="width:90%;" multiple="multiple" size="10"', 'value', 'text', $value );

		return $output;

	}

	

}

