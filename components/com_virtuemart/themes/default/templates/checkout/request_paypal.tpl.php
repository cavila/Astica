<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Restricted access' );
/*
* version 1.0 of Paypal Pro Module.
* Author: Aaron Klick (Metric/Metricton)
* @Copyright (C) 2008-2009 Aaron Klick / Vantage Technic. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
//declare global variables that are used in the basket.
global $order_total, $shipping_tax, $shipping_total, $tax_total, $vmLogger;

ps_checkout::show_checkout_bar();

require_once(CLASSPATH ."payment/ps_paypal_wpp.cfg.php");
require_once(CLASSPATH ."payment/ps_paypal_wpp.cfg2.php");
require_once(CLASSPATH ."payment/nvp_include/languages/lang.".PP_WPP_LANGUAGE.".php");
require_once( CLASSPATH . "payment/nvp_include/nvp_functions.php");
require_once(CLASSPATH ."payment/nvp_include/nvp_errors.php");

//Setting this stops VM from showing the continue button until we know the user has payed.
$_SESSION['paypal_ex_request'] = TRUE;
echo $basket_html;

echo '<br />';

$ps_vendor_id = $_SESSION["ps_vendor_id"];
$auth = $_SESSION['auth'];
$ship_to_info_id = @strip_tags($_REQUEST['ship_to_info_id']);
$ship_rate = @strip_tags($_REQUEST['shipping_rate_id']);
$itemID = @strip_tags($_REQUEST['Itemid']);
$payment_method_id = @strip_tags($_REQUEST['payment_method_id']);

echo '<h4>'.$nvp_phrase_01.'</h4>';

//Check to make sure we have an order total greater than 0.00
if($order_total > 0.00)
{	
	$info = array('ship_to' => $ship_to_info_id, 'ship_rate' => $ship_rate, 'item_id' => $itemID);
	$dt['order_total'] = round($order_total,2);
	$dt['shipping_total'] = round($shipping_tax,2) + round($shipping_total,2);
	$dt['tax_total'] = round($tax_total,2);

	// Get user billing information from the database
	$dbbt = new ps_DB;
	$qt = "SELECT * FROM #__{vm}_user_info WHERE user_id=".$auth["user_id"]." AND address_type='BT'";
	$dbbt->query($qt);
	$dbbt->next_record();
	$user_info_id = $dbbt->f("user_info_id");
	if( $user_info_id != $ship_to_info_id) {
	// There is a different shipping address than the billing address, get the shipping information
		$dbst = new ps_DB;
		$qt = "SELECT * FROM #__{vm}_user_info WHERE user_info_id='".$ship_to_info_id."' AND address_type='ST'";
		$dbst->query($qt);
		$dbst->next_record();
	}
	else {
		// Shipping address is the same as the billing address
		$dbst = $dbbt;
	}
	
	$dt['email'] = $dbbt->f('user_email');
	
	//Pass our collected info to SetExpressCheckout
	$nvpRES = NVP_SetExpressCheckout($dt,$dbst,$info);
	
	//Check to make sure we actually retrieved a response from paypal.
	if($nvpRES)
	{
		$ack = strtoupper($nvpRES["ACK"]);
		
		if($ack == "SUCCESS")
		{
			//Success! Build paypal url with token.
			$token = urldecode($nvpRES["TOKEN"]);
			//check to see if we are in sandbox mode or not, and apply correct URL accordingly
			if(PP_WPP_SANDBOX == '1')
			{
				$payPalURL = PP_WPP_EX_SANDBOX_URL.$token;
			}				
			else
			{
				$payPalURL = PP_WPP_EX_LIVE_URL.$token;
			}
			
			echo '<a href="'.$payPalURL.'"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" alt="Checkout with Paypal Express" border="0" /></a>';
		}
		//We had errors so list them or show them
		else
		{
			$count=0;
			$errorMESSAGE = "";
			while (isset($nvpRES["L_SHORTMESSAGE".$count])) 
			{		
				$errorCODE  = $nvpRES["L_ERRORCODE".$count];
				$shortMESSAGE = $nvpRES["L_SHORTMESSAGE".$count];
				$longMESSAGE  = $nvpRES["L_LONGMESSAGE".$count]; 
				
				$errorMESSAGE .= "Error: ".$errorCODE." Short Message: ".$shortMESSAGE." Long Message: ".$longMESSAGE."<br />";
				
				$vmLogger->debug($errorMESSAGE);
				
				$count++;
			}
			
			if(isset($errorCODE))
			{
				$errorText = NVP_ErrorToText($errorCODE, 'setexpress');
				
				if($errorText)
				{
					echo $errorText;
					$vmLogger->err($errorText);
				}
				else
				{
					if(PP_WPP_ERRORS == '0')
					{
						echo $nvp_common_01;
						echo $nvp_common_02;
						echo $nvp_common_03;
						echo $nvp_common_04;
						echo $nvp_common_05;
						echo $nvp_common_06;
					}
					elseif(PP_WPP_ERRORS == '1')
					{
						echo $errorMESSAGE;
						$vmLogger->err($errorMessage);
					}
				}
			}
		}
	}
	else
	{
		echo $nvp_common_07;
		$vmLogger->err($nvp_common_07);
	}
}
else
{
	echo $nvp_common_09;
	$vmLogger->err($nvp_common_09);
}
?>