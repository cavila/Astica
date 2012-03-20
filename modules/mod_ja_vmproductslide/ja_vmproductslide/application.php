<?php
/*------------------------------------------------------------------------
# JA SlideShow v1.0.0
# ------------------------------------------------------------------------
# Copyright (C) 2004-2006 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: J.O.O.M Solutions Co., Ltd
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class JA_VMSlider{

	var $_params = '';
	var $_db = '';
	var $show_price = 0;
	var $show_addtocart = 0;
	var $_typeproduct = 0;
	var $_numElem = 0;
	var $_listPro = array();
	
	
	function JA_VMSlider($params, $database, $typeproduct,$show_addtocart,$show_price,$numElem){
		$this->_params = $params;
		$this->_db = JFactory::getDBO();
		$this->_typeproduct = $typeproduct;
		$this->show_price = $show_price; // Display the Product Price?
		$this->show_addtocart = $show_addtocart; // Display the "Add-to-Cart" Link?
		$this->_numElem = $numElem;
	}
	
	function getTotal($catid){
		require_once(JPATH_BASE. "/administrator/components/com_virtuemart/virtuemart.cfg.php");
		
		$query = 	'SELECT COUNT(p.product_sku) FROM `#__'.VM_TABLEPREFIX.'_product` p';
		$query .= 	' INNER JOIN `#__'.VM_TABLEPREFIX.'_product_category_xref` cf ';
		$query .= 	' ON  cf.product_id = p.product_id ';
		$query .= 	' INNER JOIN `#__'.VM_TABLEPREFIX.'_category` c ';
		$query .= 	' ON  cf.category_id = c.category_id ';
		$query .= 	' WHERE p.product_parent_id=""';
		$query .= 	' AND p.product_publish="Y" ';
		$query .= 	' AND c.category_publish="Y" ';
		
		if( CHECK_STOCK && PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS != "1") {
			$query .= ' AND p.product_in_stock > 0 ';
		}
		if($catid) $query .= ' AND cf.category_id IN ('.$catid.') ';
		$query .= ($this->_typeproduct == 1 ) ? ' AND product_special ="Y" ' : '';
		//echo $query;
		$this->_db->setQuery($query);
		$this->_total = $this->_db->loadResult();
		return $this->_total;			
	}

	function loadProduct($catid){
		require_once(JPATH_BASE. "/administrator/components/com_virtuemart/virtuemart.cfg.php");

		$query = 	'SELECT DISTINCT p.product_sku FROM `#__'.VM_TABLEPREFIX.'_product` p';
		$query .= 	' INNER JOIN `#__'.VM_TABLEPREFIX.'_product_category_xref` cf ';
		$query .= 	' ON  cf.product_id = p.product_id ';
		$query .= 	' INNER JOIN `#__'.VM_TABLEPREFIX.'_category` c ';
		$query .= 	' ON  cf.category_id = c.category_id ';
		$query .= 	' WHERE p.product_parent_id=""';
		$query .= 	' AND p.product_publish="Y" ';
		$query .= 	' AND c.category_publish="Y" ';
		
		if( CHECK_STOCK && PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS != "1") {
			$query .= ' AND p.product_in_stock > 0 ';
		}
		if($catid) $query .= ' AND cf.category_id IN ('.$catid.') ';
		$query .= ($this->_typeproduct) ? (($this->_typeproduct == 1 ) ? ' AND p.product_special ="Y" ORDER BY p.product_name DESC ' : 'ORDER BY p.cdate DESC ') : 'ORDER BY p.product_name DESC ';
		
		$this->_db->setQuery($query);
		$this->_listPro = $this->_db->loadResultArray();
		return $this->_listPro;
	}
	
	function genHTML($catid){		
		require_once( JPATH_BASE.'/components/com_virtuemart/virtuemart_parser.php' );
		require_once( CLASSPATH . 'ps_product.php');
		
		$this->loadProduct($catid);
		
		$ps_product = new ps_product();		
		$i=0;
		foreach($this->_listPro as $pro){
			$temp = $ps_product->product_snapshot($pro, $this->show_price, $this->show_addtocart);
			echo "<div class=\"vm_element\">".$temp."</div>";
			$i++;
		}		
	}
}