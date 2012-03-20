<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
 *
 * @version $Id: ps_affiliate.php 1095 2007-12-19 20:19:16Z soeren_nb $
 * @package VirtueMart
 * @subpackage classes
 * @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */

class ps_affiliate {
	
	/**
	 * Adds a new affiliate
	 *
	 * @param array $d
	 * @return boolean
	 */
	function add ( &$d ) {
		#    global $ps_user;
		$db = new ps_DB ( ) ;
		
		$user_info_id = vmGet($d ,  'user_info_id' );
		
		if (empty ( $user_info_id )) {
			$d [ 'error' ] = "Please provide an user info id!" ;
			return false ;
		}
		$q = "SELECT user_id FROM #__{vm}_affiliate WHERE user_id='" . $db->getEscaped($user_info_id) . "'" ;
		$db->query ( $q ) ;
		
		if ($db->next_record ()) {
			$GLOBALS [ 'vmLogger' ]->err('The given user id already is an affiliate!' ) ;
			return false ;
		} else {
			$db->buildQuery('INSERT', '#__{vm}_affiliate', array( 'user_id' => $user_info_id, 'active' => 'Y', 'rate' => 5));
			$db->query ( ) ;
			
			return True ;
		}
	
	}
	
	/**************************************************************************
	 * name: delete()
	 * created by: soeren
	 * description: deletes an affiliate
	 * parameters:
	 * returns:
	 **************************************************************************/
	function delete ( &$d ) {
		#    global $ps_user;
		$db = new ps_DB ( ) ;
		$user_info_id = vmGet($d ,  'user_info_id' );
		if (empty ( $user_info_id )) {
			$d [ 'error' ] = "Please provide an user info id!" ;
			return false ;
		}
		if (is_array ( $user_info_id )) {
			foreach ( $user_info_id as $affiliate ) {
				$q = "DELETE FROM #__{vm}_affiliate WHERE user_id ='" . (int)$affiliate . "' " ;
				$db->query ( $q ) ;
			}
		} else {
			$q = "DELETE FROM #__{vm}_affiliate WHERE user_id ='" . (int)$user_info_id . "' " ;
			$db->query ( $q ) ;
		}
		return True ;
	
	}
	
	/**
	 * Registers the visit from an affiliates site
	 * @author  SP Bridgewater
	 * @return boolean
	 */
	function visit_register () {
		global $sess, $afid, $page ;
		$timestamp = time () ;
		$db = new ps_DB ( ) ;
		$fields = array( 'visit_id' => session_id (), 
									'affiliate_id' => $afid,
									'pages' => 1,
									'entry_page' => $page,
									'exit_page' => $page,
									'sdate' => $timestamp,
									'edate' => $timestamp);
		$db->buildQuery( 'INSERT', '#__{vm}_visit', $fields );
		
		return  $db->query();
	}
	
	/**
	 * Updates the visitor record for the affiliate
	 * @author SP Bridgewater
	 * @return boolean
	 */
	function visit_update () {
		global $sess, $afid, $page ;
		$timestamp = time () ;
		$db = new ps_DB ( ) ;
		$fields = array( 'pages' => 'pages + 1',
									'edate' => $timestamp,
									'exit_page' => $page );
		$db->buildQuery( 'UPDATE', '#__{vm}_visit', $fields, 'WHERE visit_id = \''. session_id () .'\'', array( 'pages') );
		return	$db->query();
	
	}
	
	/**
	 * updates the affiliate details
	 * @author SP Bridgewater
	 * @param array $d
	 * @return boolean
	 */
	function update ( &$d ) {
		
		$db = new ps_DB();
		$fields = array('rate' => $d['rate'], 
									'active' => $d [ "active" ] == 'on' ? 'Y' : 'N'
								);
		$db->buildQuery('UPDATE', '#__{vm}_affiliate', $fields, 'WHERE affiliate_id =\'' . vmRequest::getInt('affiliate_id') . '\'');
		return $db->query();
		
	}
	
	/**
	 * registers the sale with the affiliate visit
	 * @author SP Bridgewater
	 * @param mixed $order_id
	 * @return boolean
	 */
	function register_sale ( $order_id ) {
		
		if (isset ( $_SESSION [ 'afid' ] )) {
			$afid = $_SESSION [ 'afid' ] ;
			
			$db = new ps_DB ( ) ;
			$q = "SELECT rate FROM #__{vm}_affiliate " ;
			$q .= " WHERE affiliate_id = '" . $db->getEscaped($afid) . "'" ;
			$db->query ( $q ) ;
			$db->next_record () ;
			$rate = $db->f ( "rate" );
			$fields = array('affiliate_id' => $afid, 
									'order_id' => $order_id,
									'visit_id' => session_id(),
									'rate' => $rate);
			$db->buildQuery('INSERT', '#__{vm}_affiliate_sale', $fields );
			return $db->query();
		}
		return true ;
	}
	
	/**
	 * shows a listbox of orders which can be used in a form
	 * @author spb
	 * @param unknown_type $order_status
	 * @param unknown_type $secure
	 * @param unknown_type $date
	 */
	function list_order ( $order_status = 'A' , $secure = 0 , $date = 0 ) {
		global $ps_vendor_id ;
		$auth = $_SESSION [ 'auth' ] ;
		
		$db = new ps_DB();
		$i = 0 ;
		$order_total = 0 ;
		
		//if month as not been passed then view current month
		if ($date == 0) {
			$month = date ( "n" ) ;
			$year = date ( "Y" ) ;
		
		} else {
			$month = date ( "n", $date ) ;
			$year = date ( "Y", $date ) ;
		}
		$start_date = mktime ( 0, 0, 0, $month, 1, $year ) ;
		$end_date = mktime ( 24, 0, 0, $month + 1, 0, $year ) ;
		
		//get the affiliate id from affiliate table for this user
		$q = "SELECT affiliate_id,rate FROM #__{vm}_affiliate, #__users" ;
		$q .= " WHERE #__{vm}_affiliate.user_id = #__users.user_info_id" ;
		$q .= " AND #__users.id = '" . $auth [ "user_id" ] . "'" ;
		
		$db->query ( $q ) ;
		if ($db->next_record ()) {
			$affiliate = $db->f ( "affiliate_id" ) ;
			$q = "SELECT * FROM #__{vm}_orders,#__{vm}_affiliate_sale " ;
			$q .= "WHERE vendor_id='$ps_vendor_id' " ;
			$q .= "AND #__{vm}_affiliate_sale.order_id = #__{vm}_orders.order_id " ;
			$q .= "AND affiliate_id = '$affiliate' " ;
			$q .= "AND cdate BETWEEN $start_date AND $end_date " ;
			$q .= " GROUP BY #__{vm}_orders.order_id " ;
			$q .= " ORDER BY #__{vm}_orders.cdate DESC " ;
			$db->query ( $q ) ;
			while ( $db->next_record () ) {
				$i ++ ;
				$order_total += $db->f ( "order_subtotal" ) ;
				$array[$db->f ( "order_id" )] = sprintf ( "%08d", $db->f ( "order_id" ) )
																."&nbsp;&nbsp;&nbsp;&nbsp;"
																. date ( "dMY.H:i", $db->f ( "cdate" ) ) 
																. "&nbsp;&nbsp;&nbsp;" 
																. $db->f ( "order_status" ) . "&nbsp; &nbsp;"
																. "&nbsp;&nbsp;". $db->f ( "order_subtotal" ) . "&nbsp; &nbsp;"
																. sprintf ( "%1.2f", $db->f ( "order_subtotal" ) * ($db->f ( "rate" ) / 100) ) ;
				
			}
			if ($i == 0) {
				$array[''] = '---------------------- No Orders to Display ------------------';
			}
			
			echo ps_html::selectList('order_id', '', $array );
		}
	}
	
	/**
	 * Returns an array with the details for an affiliate
	 *
	 * @param int $user_id
	 * @param int $affiliate_id
	 * @return mixed
	 */
	function get_affiliate_details ( $user_id , $affiliate_id = '0' ) {
		global $auth ;
		
		$db = new ps_DB();
		
		//get the affiliate id from affiliate table for this user
		$q = "SELECT affiliate_id,rate,company,user_email FROM `#__{vm}_affiliate`, `#__{vm}_user_info`" ;
		$q .= " WHERE #__{vm}_affiliate.user_id = #__{vm}_user_info.user_info_id" ;
		if (! $affiliate_id) {
			$q .= " AND #__{vm}_user_info.user_id = '" . $auth [ "user_id" ] . "'" ;
		} else {
			$q .= " AND #__{vm}_affiliate.affiliate_id = '" . $db->getEscaped($affiliate_id) . "'" ;
		}
		$db->query ( $q ) ;
		if ($db->next_record ()) {
			$affiliate [ "id" ] = $db->f ( "affiliate_id" ) ;
			$affiliate [ "rate" ] = $db->f ( "rate" ) ;
			$affiliate [ "company" ] = $db->f ( "company" ) ;
			$affiliate [ "email" ] = $db->f ( "user_email" ) ;
			return $affiliate ;
		} else {
			return NULL ;
		}
		
		return False ;
	}
	
	/**************************************************************************
	 ** name: get_stats
	 ** created by:
	 ** description:
	 ** parameters:
	 ** returns:
	 ***************************************************************************/
	/**
	 * Returns a striong with the Statistics for the affiliate specified by $affiliate_id
	 *
	 * @param int $date
	 * @param int $affiliate_id
	 * @return string
	 */
	function get_stats ( $date = 0 , $affiliate_id ) {
		$company_details = $this->get_affiliate_details ( 0, $affiliate_id ) ;
		$affiliate_details = $this->get_details ( time (), $affiliate_id ) ;
		if( !empty($company_details) ) {
			$stats_string = "Affiliate statistics for " . $company_details [ "company" ] . " : " . date ( "F Y" ) . "\n" ;
			$stats_string .= "---------------------------------------------------------------------\n" ;
			$stats_string .= "Your affiliate id            =" . $company_details [ "id" ] . "\n" ;
			$stats_string .= "Your current commission rate = " . $company_details [ "rate" ] . "%\n" ;
			$stats_string .= "-----------------------------------------\n" ;
			$stats_string .= "Number of referrals    = " . $affiliate_details [ "visitors" ] . "\n" ;
			$stats_string .= "Number of pages viewed = " . $affiliate_details [ "pages" ] . "\n" ;
			$stats_string .= "Number of orders made  = " . $affiliate_details [ "orders_made" ] . "\n" ;
			$stats_string .= "Total order revenue    = " . $affiliate_details [ "orders_total" ] . "\n" ;
			$stats_string .= "-----------------------------------------\n" ;
			$stats_string .= "Commission earned      = " . $affiliate_details [ "commission_total" ] . "\n" ;
			$stats_string .= "-----------------------------------------\n" ;
			$stats_string .= "Please note that commission will only be\n" ;
			$stats_string .= "paid on orders that have been completed.\n" ;
			$stats_string .= "These details are to provide a summary of\n" ;
			$stats_string .= "the commission earned when all orders have\n" ;
			$stats_string .= "been completed and shipped.\n" ;
			return $stats_string ;
		}
		else {
			return '';
		}
	}
	
	/**
	 * Notify Affiliates with their stats
	 *
	 * @param array $d
	 */
	function email ( &$d ) {
		global $email_status, $ps_vendor_id ;
		$db = new ps_DB ( ) ;
		$dbv = new ps_DB ( ) ;
		
		$qt = "SELECT * from #__{vm}_vendor WHERE vendor_id = $ps_vendor_id" ;
		$dbv->query ( $qt ) ;
		$dbv->next_record () ;
		
		$q = "SELECT * from #__{vm}_affiliate " ;
		$q .= " WHERE active ='Y' " ;
		if ($d [ "affiliate_id" ] != "*") {
			$q .= "AND affiliate_id = '" . $db->getEscaped($d [ "affiliate_id" ]) . "'" ;
		}
		
		$db->query ( $q ) ;
		while ( $db->next_record () ) {
			$i ++ ;
			if ($d [ "send_stats" ] == "stats_on") {
				$d [ "email" ] .= "\n\n\n" . $this->get_stats ( time (), $db->f ( "affiliate_id" ) ) ;
			}
			
			$affiliate = $this->get_affiliate_details ( 0, $db->f ( "affiliate_id" ) ) ;
			
			if (! mail ( $affiliate [ "email" ], $d [ "subject" ], $d [ "email" ], $dbv->f ( "contact_email" ) )) {
				$email_status = "Failed" ;
			} else {
				$j ++ ;
			}
		
		}
		
		if ($i == $j) {
			$email_status = "Emailed $i affiliates successfully - Email more ...." ;
		}
	
	}
	
	/**
	 * Prints a drop-down list with all affiliates
	 *
	 * @param unknown_type $affiliate_active
	 */
	function get_affiliate_list ( $affiliate_active = 'Y' ) {
		global $ps_vendor_id ;
		$db = new ps_DB ( ) ;
		$i = 0 ;
		
		//get the affiliate id from affiliate table for this user
		$q = "SELECT affiliate_id,first_name,last_name,name,username FROM #__{vm}_affiliate, #__users" ;
		$q .= " WHERE #__{vm}_affiliate.user_id = #__users.user_info_id" ;
		if ($affiliate_active == 'Y') {
			$q .= " AND active = 'Y' " ;
		}
		
		$db->query ( $q ) ;
		
		$array['*'] = '*';
		
		while ( $db->next_record () ) {
			$i ++ ;
			$array[$db->f ( "affiliate_id" )] = $db->f ( "first_name" ) . " " . $db->f ( "first_name" ) . " (" . $db->f ( "username" ) . ")" ;
		
		}
		if (! $i) {
			$array[''] = '---------------------- No Affiliates to Display ------------------' ;
		}
		
		echo ps_html::selectList('affiliate_id', '', $array );
	
	}
	
	/**
	 * Returns an array with the statistic details for a given affiliate
	 *
	 * @param int $date TimeStamp
	 * @param int $affiliate_id
	 * @return mixed
	 */
	function get_details ( $date , $affiliate_id = 0 ) {
		
		global $ps_vendor_id ;
		$auth = $_SESSION [ 'auth' ] ;
		$db = new ps_DB ( ) ;
		$i = 0 ;
		$affiliate_id = (int)$affiliate_id;
		//if month as not been passed then view current month
		if ($date == 0) {
			$month = date ( "n" ) ;
			$year = date ( "Y" ) ;
		
		} else {
			$month = date ( "n", $date ) ;
			$year = date ( "Y", $date ) ;
		}
		$start_date = mktime ( 0, 0, 0, $month, 1, $year ) ;
		$end_date = mktime ( 24, 0, 0, $month + 1, 0, $year ) ;
		
		//get the affiliate id from affiliate table for this user
		

		if ($affiliate_id == 0) {
			$q = "SELECT affiliate_id,rate FROM #__{vm}_affiliate, #__users" ;
			$q .= " WHERE #__{vm}_affiliate.user_id = #__users.user_info_id" ;
			$q .= " AND #__users.id = '" . $auth [ "user_id" ] . "'" ;
		
		} else {
			$q = "SELECT affiliate_id,rate FROM #__{vm}_affiliate" ;
			$q .= " WHERE affiliate_id = '" . $affiliate_id . "'" ;
		}
		
		$db->query ( $q ) ;
		
		if ($db->next_record ()) {
			$affiliate [ "id" ] = $db->f ( "affiliate_id" ) ;
			$affiliate [ "rate" ] = $db->f ( "rate" ) ;
			
			//get the orders for this month
			$q = "SELECT affiliate_id, COUNT(#__{vm}_affiliate_sale.order_id) AS orders_made," ;
			$q .= "SUM(order_subtotal) AS order_total, " ;
			$q .= "SUM(order_subtotal*(rate*0.01)) AS commission FROM #__{vm}_orders,#__{vm}_affiliate_sale" ;
			$q .= " WHERE #__{vm}_orders.order_id = #__{vm}_affiliate_sale.order_id" ;
			$q .= " AND #__{vm}_affiliate_sale.affiliate_id = '" . $affiliate [ "id" ] . "'" ;
			$q .= "AND #__{vm}_orders.cdate BETWEEN $start_date AND $end_date " ;
			$q .= " GROUP BY affiliate_id" ;
			$db->query ( $q ) ;
			
			if ($db->next_record ()) {
				if ($db->f ( "orders_made" ))
					$affiliate [ "orders_made" ] = $db->f ( "orders_made" ) ; else
					$affiliate [ "orders_made" ] = "none" ;
				
				if ($db->f ( "order_total" ))
					$affiliate [ "orders_total" ] = $db->f ( "order_total" ) ; else
					$affiliate [ "orders_total" ] = "none" ;
				
				if ($db->f ( "commission" ))
					$affiliate [ "commission_total" ] = $db->f ( "commission" ) ; else
					$affiliate [ "commission_total" ] = "none" ;
			}
			
			//query the visit table
			$q = "SELECT  count(affiliate_id) AS visitors,sum(pages) AS pages_viewed FROM #__{vm}_visit " ;
			$q .= " WHERE affiliate_id = '" . $affiliate [ "id" ] . "'" ;
			$q .= "AND sdate BETWEEN $start_date AND $end_date " ;
			$q .= " GROUP BY affiliate_id" ;
			$db->query ( $q ) ;
			
			if ($db->next_record ()) {
				if ($db->f ( "visitors" ))
					$affiliate [ "visitors" ] = $db->f ( "visitors" ) ; else
					$affiliate [ "visitors" ] = "none" ;
				if ($db->f ( "pages_viewed" ))
					$affiliate [ "pages" ] = $db->f ( "pages_viewed" ) ; else
					$affiliate [ "pages" ] = "none" ;
			
			}
			return $affiliate ;
		}
		
		return False ;
	}

}
?>