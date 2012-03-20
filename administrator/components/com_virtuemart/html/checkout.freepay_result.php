<?php 
/**
* Freepay Order Confirmation Handler
*
* @version $Id: checkout.freepay_result.php 1122 2008-01-07 14:52:31Z thepisu $
* @package VirtueMart
* @subpackage html
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
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );   

require_once(  CLASSPATH ."payment/ps_pbs.cfg.php");

$sessionid = vmGet( $_REQUEST, "sessionid" );
$accept = vmGet( $_REQUEST, "accept", "0" );
$transacknum = vmGet( $_REQUEST, "transacknum" );

$cookievals = base64_decode( $sessionid );
$orderID = substr( $cookievals, 0, 8 );
$order_id = intval( $orderID );
$virtuemartcookie = substr( $cookievals, 8, 32 );
$remote_ip_md5 = substr( $cookievals, 40, 32 );
$md5_check = substr( $cookievals, 72, 32 );

// Check Validity of the Page Load using the MD5 Check
$submitted_hashbase = $orderID . $virtuemartcookie . $remote_ip_md5;

// OK! VALID...
if( !$my->id ) {
	mosNotAuth();
	echo '<br />';
	include( PAGEPATH. 'checkout.login_form.php');
	echo '<br /><br />';
}
elseif( $md5_check === md5( $submitted_hashbase . $mosConfig_secret . ENCODE_KEY) ) {
  
      $qv = "SELECT order_id, order_number FROM #__{vm}_orders ";
      $qv .= "WHERE order_id='".$order_id."' AND user_id='".$my->id."'";
      $dbo = new ps_DB;
      $dbo->query($qv);
      if($dbo->next_record()) {
        $d['order_id'] = $dbo->f("order_id");
        
        if( empty($_REQUEST['errorcode']) && $accept == "1" ) {
            
            // UPDATE THE ORDER STATUS to 'VALID'
            $d['order_status'] = PBS_VERIFIED_STATUS;
            // Setting this to "Y" = yes is required by Danish Law
            $d['notify_customer'] = "Y";
            $d['include_comment'] = "Y";
            // Notifying the customer about the transaction key and
            // the order Status Update
            $d['order_comment'] = str_replace('{transactionnumber}',urldecode($transacknum),$VM_LANG->_('VM_CHECKOUT_PBS_APPROVED_ORDERCOMMENT'));
                
            require_once ( CLASSPATH . 'ps_order.php' );
            $ps_order= new ps_order;
            $ps_order->order_status_update($d);
            
    ?> 
            <img src="<?php echo IMAGEURL ?>ps_image/button_ok.png" align="center" alt="<?php echo $VM_LANG->_('VM_CHECKOUT_SUCCESS'); ?>" border="0" />
            <h2><?php echo $VM_LANG->_('PHPSHOP_PAYMENT_TRANSACTION_SUCCESS') ?></h2>
        <?php
        }
        elseif( $accept == "0" ) {
            // the Payment wasn't successful. Maybe the Payment couldn't
            // be verified and is pending
            // UPDATE THE ORDER STATUS to 'INVALID'
            $d['order_status'] = PBS_INVALID_STATUS;
            // Setting this to "Y" = yes is required by Danish Law
            $d['notify_customer'] = "Y";
            $d['include_comment'] = "Y";
            // Notifying the customer about the transaction key and
            // the order Status Update
            $d['order_comment'] = str_replace('{transactionnumber}',urldecode($transacknum),$VM_LANG->_('VM_CHECKOUT_PBS_NOTAPPROVED_ORDERCOMMENT'));
            require_once ( CLASSPATH . 'ps_order.php' );
            $ps_order= new ps_order;
            $ps_order->order_status_update($d);
            
    ?> 
            <img src="<?php echo IMAGEURL ?>ps_image/button_cancel.png" align="center" alt="<?php echo $VM_LANG->_('VM_CHECKOUT_FAILURE'); ?>" border="0" />
            <h2><?php echo $VM_LANG->_('PHPSHOP_PAYMENT_ERROR') ?></h2>
        <?php
            switch (urldecode($_REQUEST['reason'])) {

                case 1: echo $VM_LANG->_('VM_CHECKOUT_FP_ERROR_1'); break;
                case 2: echo $VM_LANG->_('VM_CHECKOUT_FP_ERROR_2'); break;
                case 3: echo $VM_LANG->_('VM_CHECKOUT_FP_ERROR_3'); break;
                case 4: echo $VM_LANG->_('VM_CHECKOUT_FP_ERROR_4'); break;
                case 5: echo $VM_LANG->_('VM_CHECKOUT_FP_ERROR_5'); break;
                case 6: echo $VM_LANG->_('VM_CHECKOUT_FP_ERROR_6'); break;
                case 7: echo $VM_LANG->_('VM_CHECKOUT_FP_ERROR_7'); break;
                case 8: echo $VM_LANG->_('VM_CHECKOUT_FP_ERROR_8'); break;
                case 9: echo $VM_LANG->_('VM_CHECKOUT_FP_ERROR_9'); break;
                case 10: echo $VM_LANG->_('VM_CHECKOUT_FP_ERROR_10'); break;
                default: echo $VM_LANG->_('VM_CHECKOUT_FP_ERROR_DEFAULT');
            }
        }
        ?>
        <br />
        <p><a href="<?php @$sess->purl( SECUREURL."index.php?option=com_virtuemart&page=account.order_details&order_id=$order_id" ) ?>">
           <?php echo $VM_LANG->_('PHPSHOP_ORDER_LINK') ?></a>
        </p>
        <?php
      }
      else {
        ?>
        <img src="<?php echo IMAGEURL ?>ps_image/button_cancel.png" align="center" alt="<?php echo $VM_LANG->_('VM_CHECKOUT_FAILURE'); ?>" border="0" />
        <span class="message"><?php echo $VM_LANG->_('PHPSHOP_PAYMENT_ERROR') . ' (' . $VM_LANG->_('VM_CHECKOUT_ORDERNOTFOUND') . ')'; ?></span><?php
      }
  }
else{
        ?>
        <img src="<?php echo IMAGEURL ?>ps_image/button_cancel.png" align="center" alt="<?php echo $VM_LANG->_('VM_CHECKOUT_FAILURE'); ?>" border="0" />
        <span class="message"><?php echo $VM_LANG->_('PHPSHOP_PAYMENT_ERROR') . ' (' . $VM_LANG->_('VM_CHECKOUT_MD5_FAILED') . ')'; ?></span><?php
  }
  ?>
