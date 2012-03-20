<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Restricted access' );

class ps_paypal_wpp {
	
    var $payment_code = "PP_WPP";

	/**
    * Show all configuration parameters for this payment method
    * @returns boolean False when the Payment method has no configration
    */
	function show_configuration() {

		global $VM_LANG, $sess;
		$db =& new ps_DB;
		$payment_method_id = vmGet( $_REQUEST, 'payment_method_id', null );
		/** Read current Configuration ***/
		require_once(CLASSPATH ."payment/".__CLASS__.".cfg.php");
		require_once(CLASSPATH ."payment/".__CLASS__.".cfg2.php");
		require_once(CLASSPATH ."payment/nvp_include/languages/lang.".PP_WPP_LANGUAGE.".php");
		require_once(CLASSPATH ."payment/nvp_include/languages/lang.".PP_WPP_LANGUAGE.".admin.php");
		
		if($dir = opendir(CLASSPATH ."payment/nvp_include/languages"))
		{
			$n = 0;
			$filexs = Array();
			while(false !== ($file = readdir($dir)))
			{
				if(strpos($file, 'lang') !== false)
				{
					$filex = explode('.', $file);
					if(count($filex) > 2)
					{
						$filexs[$n] = $filex[1];
						$n++;
					}
				}
			}
			
			closedir($dir);
		}
		
		if($dir = opendir(CLASSPATH ."payment/nvp_include/certificate"))
		{
			$certs = Array();
			$n = 0;
			while(false !== ($cert = readdir($dir)))
			{
				$fn = strlen($cert);
				
				if($fn > 1)
				{
					if(strpos($cert, '..') === false)
					{
						$certs[$n] = $cert;
						$n++;
					}
				}
			}
		}

?>
	<table>
		<tr>
			<td><strong><?php echo PP_WPP_TEXT_ENABLE_SANDBOX; ?></strong></td>
			<td><select name="PP_WPP_SANDBOX" class="inputbox" >
                	<option <?php if (PP_WPP_SANDBOX == '1') {echo "selected=\"selected\"";} ?> value="1"><?php echo PP_WPP_TEXT_YES ?></option>
                	<option <?php if (PP_WPP_SANDBOX != '1') {echo "selected=\"selected\"";} ?> value="0"><?php echo PP_WPP_TEXT_NO ?></option>
                </select>
            </td>
            <td><?php echo PP_WPP_TEXT_ENABLE_SANDBOX_EXPLAIN; ?>
            </td>
        </tr>
		<tr><td><strong><?php echo PP_WPP_ERRORS_TEXT; ?></strong></td>
            <td><select name="PP_WPP_ERRORS" class="inputbox" >
                	<option <?php if (PP_WPP_ERRORS == '1') echo "selected=\"selected\""; ?> value="1">
					<?php echo PP_WPP_TEXT_YES; ?></option>
                	<option <?php if (PP_WPP_ERRORS != '1') echo "selected=\"selected\""; ?> value="0">
					<?php echo PP_WPP_TEXT_NO; ?></option>
                </select>
            </td>
            <td><?php echo PP_WPP_ERRORS_TEXT_EXPLAIN?></td>
        </tr>
		<tr><td><strong><?php echo PP_WPP_TEXT_EXPRESS_ENABLE; ?></strong></td>
            <td><select name="PP_WPP_EXPRESS_ON" class="inputbox" >
                	<option <?php if (PP_WPP_EXPRESS_ON == '1') echo "selected=\"selected\""; ?> value="1">
					<?php echo PP_WPP_TEXT_YES; ?></option>
                	<option <?php if (PP_WPP_EXPRESS_ON != '1') echo "selected=\"selected\""; ?> value="0">
					<?php echo PP_WPP_TEXT_NO; ?></option>
                </select>
            </td>
            <td><?php echo PP_WPP_TEXT_EXPRESS_ENABLE_EXPLAIN;?></td>
        </tr>
		<tr><td><strong><?php echo PP_WPP_TEXT_DIRECT_PAYMENT_ON;?></strong></td>
			<td><select name="PP_WPP_DIRECT_PAYMENT_ON" class="inputbox">
					<option <?php if (PP_WPP_DIRECT_PAYMENT_ON == '1') echo "selected=\"selected\""; ?> value="1">
					<?php echo PP_WPP_TEXT_YES; ?></option>
					<option <?php if (PP_WPP_DIRECT_PAYMENT_ON != '1') echo "selected=\"selected\""; ?> value="0">
					<?php echo PP_WPP_TEXT_NO; ?></option>
				</select>
			</td>
			<td><?php echo PP_WPP_TEXT_DIRECT_PAYMENT_EXPLAIN;?></td>
		</tr>
		<tr><td><strong><?php echo PP_WPP_CVV_TEXT; ?></strong></td>
            <td><select name="PP_WPP_CHECK_CARD_CODE" class="inputbox" >
                	<option <?php if (PP_WPP_CHECK_CARD_CODE == 'YES') echo "selected=\"selected\""; ?> value="YES"><?php echo PP_WPP_TEXT_YES?></option>
                	<option <?php if (PP_WPP_CHECK_CARD_CODE == 'NO') echo "selected=\"selected\""; ?> value="NO">
					<?php echo PP_WPP_TEXT_NO;?></option>
                </select>
            </td>
            <td><?php echo PP_WPP_CVV_TEXT_EXPLAIN; ?></td>
        </tr>
		<tr><td><strong><?php echo PP_WPP_TEXT_USE_SHIPPING; ?></strong></td>
			<td><select name="PP_WPP_USE_SHIPPING" class="inputbox">
					<option <?php if(PP_WPP_USE_SHIPPING == '1') echo "selected=\"selected\""; ?> value="1">
					<?php echo PP_WPP_TEXT_YES; ?></option>
					<option <?php if(PP_WPP_USE_SHIPPING != '1') echo "selected=\"selected\""; ?> value="0">
					<?php echo PP_WPP_TEXT_NO; ?></option>
				</select>
			</td>
			<td><?php echo PP_WPP_TEXT_USE_SHIPPING_EXPLAIN; ?></td>
		</tr>
		<tr><td><strong><?php echo PP_WPP_TEXT_REQCONFIRMSHIPPING; ?></strong></td>
            <td><select name="PP_WPP_REQCONFIRMSHIPPING" class="inputbox" >
                	<option <?php if (PP_WPP_REQCONFIRMSHIPPING == '1') echo "selected=\"selected\""; ?> value="1">
					<?php echo PP_WPP_TEXT_YES; ?></option>
                	<option <?php if (PP_WPP_REQCONFIRMSHIPPING != '1') echo "selected=\"selected\""; ?> value="0">
					<?php echo PP_WPP_TEXT_NO; ?></option>
                </select>
            </td>
            <td><?php echo PP_WPP_TEXT_REQCONFIRMSHIPPING_EXPLAIN; ?></td>
        </tr>
		<tr>
			<td><strong><?php echo PP_WPP_TEXT_CURRENCY; ?></strong></td>
			<td>
				<select name="PP_WPP_CURRENCY" class="inputbox" >
					<option <?php if (PP_WPP_CURRENCY == "USD") echo "selected=\"selected\""; ?> value="USD">USD</option>
					<option <?php if (PP_WPP_CURRENCY == "CAD") echo "selected=\"selected\""; ?> value="CAD">CAD</option>
				</select>
			</td>
			<td><?php echo PP_WPP_TEXT_CURRENCY_EXPLAIN; ?></td>
		</tr>
		<tr>
			<td><strong><?php echo PP_WPP_TEXT_LANGUAGE; ?></td>
			<td>
				<select name="PP_WPP_LANGUAGE" class="inputbox" >
					<?php
						foreach($filexs as $item)
						{
							$option = '<option value="'.$item.'"';
							if($item == PP_WPP_LANGUAGE)
							{
								$option .= ' selected="selected"';
							}
							$option .= '>'.$item.'</option>';
							
							echo $option;
						}
					?>
				</select>
			</td>
			<td><?php echo PP_WPP_TEXT_LANGUAGE_EXPLAIN; ?></td>
		</tr>
		<tr>
            <td><strong><?php echo PP_WPP_TEXT_USERNAME; ?></strong></td>
            <td>
                <input type="text" name="PP_WPP_USERNAME" class="inputbox" value="<?php echo PP_WPP_USERNAME; ?>" size="40" />
            </td>
            <td><?php echo PP_WPP_TEXT_USERNAME_EXPLAIN; ?>
            </td>
        </tr>
        <tr>
            <td><strong><?php echo PP_WPP_TEXT_PASSWORD; ?></strong></td>
            <td>
                <input type="text" name="PP_WPP_PASSWORD" class="inputbox" value="<?php echo PP_WPP_PASSWORD; ?>" size="40" />
            </td>
            <td><?php echo PP_WPP_TEXT_PASSWORD_EXPLAIN; ?>
            </td>
        </tr>
		<tr><td><strong><?php echo PP_WPP_TEXT_USE_CERTIFICATE; ?></strong></td>
            <td><select name="PP_WPP_USE_CERTIFICATE" class="inputbox" >
                	<option <?php if (PP_WPP_USE_CERTIFICATE == '1') echo "selected=\"selected\""; ?> value="1"><?php echo PP_WPP_TEXT_YES?></option>
                	<option <?php if (PP_WPP_USE_CERTIFICATE == '0') echo "selected=\"selected\""; ?> value="0">
					<?php echo PP_WPP_TEXT_NO;?></option>
                </select>
            </td>
            <td><?php echo PP_WPP_TEXT_USE_CERTIFICATE_EXPLAIN; ?></td>
        </tr>
		<tr>
			<td><strong><?php echo PP_WPP_TEXT_SET_CERTIFICATE; ?></td>
			<td>
				<select name="PP_WPP_CERTIFICATE" class="inputbox" >
					<?php
						foreach($certs as $item)
						{
							$option = '<option value="'.$item.'"';
							if($item == PP_WPP_CERTIFICATE)
							{
								$option .= ' selected="selected"';
							}
							$option .= '>'.$item.'</option>';
							
							echo $option;
						}
					?>
				</select>
			</td>
			<td><?php echo PP_WPP_TEXT_SET_CERTIFICATE_EXPLAIN; ?></td>
		</tr>
        <tr>
            <td><strong><?php echo PP_WPP_TEXT_SIGNATURE ?></strong></td>
            <td>
                <input type="text" name="PP_WPP_SIGNATURE" class="inputbox" value="<?php echo PP_WPP_SIGNATURE; ?>" size="40" />
            </td>
            <td><?php echo PP_WPP_TEXT_SIGNATURE_EXPLAIN; ?>
            </td>
        </tr>
		<tr>
            <td><strong><?php echo PP_WPP_TEXT_USE_PROXY; ?></strong></td>
            <td>
                <select name="PP_WPP_USE_PROXY" class="inputbox">
                	<option <?php if (PP_WPP_USE_PROXY == '1') echo "selected=\"selected\""; ?> value="1">
					<?php echo PP_WPP_TEXT_YES ;?></option>
					<option <?php if (PP_WPP_USE_PROXY != '1') echo "selected=\"selected\""; ?> value="0">
					<?php echo PP_WPP_TEXT_NO; ?></option>
                </select>
            </td>
            <td><?php echo PP_WPP_TEXT_USE_PROXY_EXPLAIN; ?></td>
        </tr>
        </tr>
		<tr><td><strong><?php echo PP_WPP_TEXT_PROXY_HOST; ?></strong></td>
            <td><input type="text" name="PP_WPP_PROXY_HOST" class="inputbox" value="<?php  echo PP_WPP_PROXY_HOST; ?>" /></td>
            <td><?php echo PP_WPP_TEXT_PROXY_HOST_EXPLAIN; ?></td>
        </tr> 
		<tr><td><strong><?php echo PP_WPP_TEXT_PROXY_PORT; ?></strong></td>
            <td><input type="text" name="PP_WPP_PROXY_PORT" class="inputbox" value="<?php  echo PP_WPP_PROXY_PORT; ?>" /></td>
            <td><?php echo PP_WPP_TEXT_PROXY_PORT_EXPLAIN; ?></td>
        </tr> 
        <tr><td><strong><?php echo PP_WPP_TEXT_STATUS_SUCCESS; ?></strong></td>
            <td><select name="PP_WPP_SUCCESS_STATUS" class="inputbox" >
                <?php
                    $q = "SELECT order_status_name,order_status_code FROM #__{vm}_order_status ORDER BY list_order";
                    $db->query($q);
                    $order_status_code = Array();
                    $order_status_name = Array();
                    
                    while ($db->next_record()) {
                      $order_status_code[] = $db->f("order_status_code");
                      $order_status_name[] =  $db->f("order_status_name");
                    }
                    for ($i = 0; $i < sizeof($order_status_code); $i++) {
                      echo "<option value=\"" . $order_status_code[$i];
                      if (PP_WPP_SUCCESS_STATUS == $order_status_code[$i]) 
                         echo "\" selected=\"selected\">";
                      else
                         echo "\">";
                      echo $order_status_name[$i] . "</option>\n";
                    }?>
                    </select>
            </td>
            <td><?php echo PP_WPP_TEXT_STATUS_SUCCESS_EXPLAIN; ?></td>
        </tr>
        <tr><td><strong><?php echo PP_WPP_TEXT_STATUS_PENDING; ?></strong></td>
            <td>
                <select name="PP_WPP_PENDING_STATUS" class="inputbox" >
                <?php
                    for ($i = 0; $i < sizeof($order_status_code); $i++) {
                      echo "<option value=\"" . $order_status_code[$i];
                      if (PP_WPP_PENDING_STATUS == $order_status_code[$i]) 
                         echo "\" selected=\"selected\">";
                      else
                         echo "\">";
                      echo $order_status_name[$i] . "</option>\n";
                    } ?>
                    </select>
            </td>
            <td><?php echo PP_WPP_TEXT_STATUS_PENDING_EXPLAIN; ?></td>
        </tr>
        <tr><td><strong><?php echo PP_WPP_TEXT_STATUS_FAILED; ?></strong></td>
            <td>
                <select name="PP_WPP_FAILED_STATUS" class="inputbox" >
                <?php
                    for ($i = 0; $i < sizeof($order_status_code); $i++) {
                      echo "<option value=\"" . $order_status_code[$i];
                      if (PP_WPP_FAILED_STATUS == $order_status_code[$i]) 
                         echo "\" selected=\"selected\">";
                      else
                         echo "\">";
                      echo $order_status_name[$i] . "</option>\n";
                    } ?>
                    </select>
            </td>
            <td><?php echo PP_WPP_TEXT_STATUS_FAILED_EXPLAIN; ?></td>
		</tr>
      </table>
<?php
      return true;
	}
	
	function has_configuration() {
		return true;
	}
   
// Check to see if the config file is writeable
   function configfile_writeable() {
      if(is_writeable( CLASSPATH."payment/".__CLASS__.".cfg.php" ) && is_writeable( CLASSPATH."payment/".__CLASS__.".cfg2.php" ))
	  {
		return true;
	  }
	  else
	  {
		return false;
	  }
   }
   
// Check to see if the config file is readable
   function configfile_readable() {
      if(is_readable( CLASSPATH."payment/".__CLASS__.".cfg.php" ) && is_readable( CLASSPATH."payment/".__CLASS__.".cfg2.php" ))
	  {
		return true;
	  }
	  else
	  {
		return false;
	  }
   }   

	/**
	* Writes the configuration file for this payment method
	* @param array An array of objects
	* @returns boolean True when writing was successful
	*/
	function write_configuration( &$d ) {
		require_once(CLASSPATH ."payment/".__CLASS__.".cfg.php");
		require_once(CLASSPATH ."payment/".__CLASS__.".cfg2.php");
		require_once(CLASSPATH ."payment/nvp_include/languages/lang.".PP_WPP_LANGUAGE.".php");
		require_once(CLASSPATH ."payment/nvp_include/languages/lang.".PP_WPP_LANGUAGE.".admin.php");
		
		if(PP_WPP_FIRST_USE == '0')
		{
			$my_config_array = array("PP_WPP_SANDBOX" => $d['PP_WPP_SANDBOX'],
									 "PP_WPP_USERNAME" => trim($d['PP_WPP_USERNAME']),
									 "PP_WPP_PASSWORD" => trim($d['PP_WPP_PASSWORD']),
									 "PP_WPP_SIGNATURE" => trim($d['PP_WPP_SIGNATURE']),
									 "PP_WPP_CHECK_CARD_CODE" => $d['PP_WPP_CHECK_CARD_CODE'],
									 "PP_WPP_SUCCESS_STATUS" => $d['PP_WPP_SUCCESS_STATUS'],
									 "PP_WPP_PENDING_STATUS" => $d['PP_WPP_PENDING_STATUS'],
									 "PP_WPP_FAILED_STATUS" => $d['PP_WPP_FAILED_STATUS'],
									 "PP_WPP_USE_PROXY" => $d['PP_WPP_USE_PROXY'],
									 "PP_WPP_PROXY_HOST" => $d['PP_WPP_PROXY_HOST'],
									 "PP_WPP_PROXY_PORT" => $d['PP_WPP_PROXY_PORT'],
									 "PP_WPP_EXPRESS_ON" => $d['PP_WPP_EXPRESS_ON'],
									 "PP_WPP_REQCONFIRMSHIPPING" => $d['PP_WPP_REQCONFIRMSHIPPING'],
									 "PP_WPP_ERRORS" => $d['PP_WPP_ERRORS']
								);
			$config = "<?php\n";
			$config .= "if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Restricted access' ); \n";
			$config .= "define ('PP_WPP_VERSION', '55.0');
						define('PP_WPP_EX_SANDBOX_URL', 'https://beta-sandbox.paypal.com/webscr&cmd=_express-checkout&token=');
						define('PP_WPP_EX_LIVE_URL', 'https://www.paypal.com/webscr&cmd=_express-checkout&token=');
						define('PP_WPP_PAYMENT_ACTION', 'Sale');";
			
			foreach( $my_config_array as $key => $value ) {
				$config .= "define ('$key', '$value');\n";
			}
		  
			$config .= "?>";
	  
			if ($fp = fopen(CLASSPATH ."payment/".__CLASS__.".cfg.php", "w")) {
				fputs($fp, $config, strlen($config));
				fclose ($fp);
			}

			$config2 = "<?php\n";
			$config2 .= "if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Restricted access' ); \n";
			$config2 .= "define('PP_WPP_DIRECT_PAYMENT_ON', '".$d['PP_WPP_DIRECT_PAYMENT_ON']."');\n";
			$config2 .= "define('PP_WPP_CURRENCY', '".$d['PP_WPP_CURRENCY']."');";
			$config2 .=	"define('PP_WPP_LANGUAGE', '".$d['PP_WPP_LANGUAGE']."');";
			$config2 .= "define('PP_WPP_USE_CERTIFICATE', '".$d['PP_WPP_USE_CERTIFICATE']."');";
			
			if(isset($d['PP_WPP_CERTIFICATE']))
			{
				$config2 .= "define('PP_WPP_CERTIFICATE', '".$d['PP_WPP_CERTIFICATE']."');";
			}
			else
			{
				$config2 .= "define('PP_WPP_CERTIFICATE', '');";
			}
			
			$config2 .= "define('PP_WPP_FIRST_USE', '0');\n";
			$config2 .= "define('PP_WPP_USE_SHIPPING', '".$d['PP_WPP_USE_SHIPPING']."');";
			$config2 .= "?>";
			
			if ($fp = fopen(CLASSPATH ."payment/".__CLASS__.".cfg2.php", "w")) {
				fputs($fp, $config2, strlen($config2));
				fclose($fp);
				
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			$config2 = "<?php\n";
			$config2 .= "if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Restricted access' ); \n";
			$config2 .= "define('PP_WPP_DIRECT_PAYMENT_ON', '1');\n";
			$config2 .= "define('PP_WPP_CURRENCY', 'USD');\n";
			$config2 .=	"define('PP_WPP_LANGUAGE', 'english');\n";
			$config2 .= "define('PP_WPP_USE_CERTIFICATE', '0');\n";
			$config2 .= "define('PP_WPP_CERTIFICATE', '');\n";
			$config2 .= "define('PP_WPP_FIRST_USE', '0');\n";
			$config2 .= "define('PP_WPP_USE_SHIPPING', '1');";
			$config2 .= "?>";
			
			if ($fp = fopen(CLASSPATH ."payment/".__CLASS__.".cfg2.php", "w")) {
				fputs($fp, $config2, strlen($config2));
				fclose($fp);
				
				return true;
			}
			else
			{
				return false;
			}
		}
   }
   
   function process_payment($order_number, $order_total, &$d) {
        global $vendor_mail, $vendor_currency, $VM_LANG, $vmLogger;
		$_SESSION['CURL_ERROR'] = false;
		$_SESSION['CURL_ERROR_TXT'] = "";
        $ps_vendor_id = $_SESSION["ps_vendor_id"];
        $auth = $_SESSION['auth'];

        $ps_checkout = new ps_checkout;
		require_once(CLASSPATH ."payment/".__CLASS__.".cfg.php");
		require_once(CLASSPATH ."payment/".__CLASS__.".cfg2.php");
		require_once(CLASSPATH ."payment/nvp_include/languages/lang.".PP_WPP_LANGUAGE.".php");
		require_once(CLASSPATH ."payment/nvp_include/languages/lang.".PP_WPP_LANGUAGE.".admin.php");
		require_once(CLASSPATH ."payment/nvp_include/nvp_connection.php");
        require_once(CLASSPATH ."payment/nvp_include/nvp_functions.php");
		require_once(CLASSPATH ."payment/nvp_include/nvp_errors.php");

        // Get user billing information from the database
        $dbbt = new ps_DB;
        $qt = "SELECT * FROM #__{vm}_user_info WHERE user_id=".$auth["user_id"]." AND address_type='BT'";
        $dbbt->query($qt);
        $dbbt->next_record();
        $user_info_id = $dbbt->f("user_info_id");
        if( $user_info_id != $d["ship_to_info_id"]) {
		// There is a different shipping address than the billing address, get the shipping information
            $dbst = new ps_DB;
            $qt = "SELECT * FROM #__{vm}_user_info WHERE user_info_id='".$d["ship_to_info_id"]."' AND address_type='ST'";
            $dbst->query($qt);
            $dbst->next_record();
        }
        else {
			// Shipping address is the same as the billing address
            $dbst = $dbbt;
        }
		
		$ip_address = urlencode($_SERVER['REMOTE_ADDR']);
		

		$payment_action = PP_WPP_PAYMENT_ACTION;

		$ordernum = urlencode(substr($order_number, 0, 20));
		
		$requireCVV = PP_WPP_CHECK_CARD_CODE;
		
		//initiate our error out variables.
		$count=0;
		$errorOut = FALSE;
		$errorOut2 = FALSE;
		$displayMsg = "";
		
		//Check to see if we are coming from paypal express checkout.
		//If not we do a directpaymentrequest, otherwise we try express checkout request.
		if(!isset($_SESSION['paypal_wpp_ex']))
		{
			$nvpreq = NVP_DoDirectPaymentRequest($d, $dbbt, $dbst, $ip_address, $payment_action, $ordernum, $requireCVV);
			
			if($nvpreq)
			{
				$nvpLS = $nvpreq;
				$nvpRES = hash_call("DoDirectPayment",$nvpreq);
			}
			else
			{
				$displayMsg .= $nvp_common_011;
				$d["error"] = $displayMsg;
				$vmLogger->err($displayMsg);
				return false;
			}
		}
		else
		{
			$nvpreq = NVP_DoExpressCheckout($d, $dbbt, $dbst, $ip_address, $payment_action, $ordernum);
			
			if($nvpreq)
			{
				$nvpLS = $nvpreq;
				$nvpRES = hash_call("DoExpressCheckoutPayment",$nvpreq);
				
			}
			else
			{
				//We failed to gather the proper array, most likely do to with not having certain parameters properly filled.
				$errorOut = TRUE;
				$errorOut2 = TRUE;
				$displayMsg .= $nvp_common_010;
			}
		}
		// Parse out all the data\
		
		if(isset($nvpRES))
		{
			$ack = strtoupper($nvpRES["ACK"]);
			
			//check to see if it was succesful or not. If not error out, otherwise retrieve the transaction status from paypal.
			if($ack!="SUCCESS" && $ack!="SUCCESSWITHWARNING")  
			{
				$displayMsg .= $nvp_common_012." - ".$ack." - ";
				$errorOut2 = TRUE;
			}
			else
			{		
				if(isset($nvpRES['AVSCODE'])) {$avsCode = $nvpRES['AVSCODE'];}
				if(isset($nvpRES['CVV2MATCH'])) {$cvv2Code = $nvpRES['CVV2MATCH'];}
				$transactionID = $nvpRES['TRANSACTIONID'];
				//get the transaction details array that paypal returned.
				$nvpDETAILS = NVP_TransactionDetails($transactionID);
				if($nvpDETAILS)
				{
					if(isset($nvpDETAILS['PAYMENTSTATUS']))
					{
						$status = $nvpDETAILS['PAYMENTSTATUS'];
						
						if(strtolower($status) == "completed")
						{
							$_SESSION['ps_paypal_wpp_paystatus'] = PP_WPP_SUCCESS_STATUS;
						}
						elseif(strtolower($status) == "pending")
						{
							$_SESSION['ps_paypal_wpp_paystatus'] = PP_WPP_PENDING_STATUS;
						}
						elseif(strtolower($status) == "processed")
						{
							$_SESSION['ps_paypal_wpp_paystatus'] = PP_WPP_SUCCESS_STATUS;
						}
						elseif(strtolower($status) == "failed")
						{
							$_SESSION['ps_paypal_wpp_paystatus'] = PP_WPP_FAILED_STATUS;
						}
						else
						{
							$_SESSION['ps_paypal_wpp_paystatus'] = PP_WPP_FAILED_STATUS;
						}
					}
					else
					{
						$_SESSION['ps_paypal_wpp_paystatus'] = PP_WPP_FAILED_STATUS;
					}
				}
				else
				{
					$_SESSION['ps_paypal_wpp_paystatus'] = PP_WPP_FAILED_STATUS;
				}
			}
			
			//if paypal sent back an error check for it and add it to our error buffer.
			while (isset($nvpRES["L_SHORTMESSAGE".$count])) 
			{		
				  $errorCODE    = $nvpRES["L_ERRORCODE".$count];
				  $shortMESSAGE = $nvpRES["L_SHORTMESSAGE".$count];
				  $longMESSAGE  = $nvpRES["L_LONGMESSAGE".$count]; 
				  
				if (isset($shortMESSAGE))
				{
					$displayMsg .= 'SHORTMESSAGE ='.$shortMESSAGE.' - '."\n";
					$errorOut = TRUE;
				}
				if (isset($errorCODE))
				{
					$displayMsg .= 'ERRORCODE ='.$errorCODE.' - '."\n";
					$errorOut = TRUE;
				}
				if (isset($longMESSAGE))
				{
					$displayMsg .= 'LONGMESSAGE ='.$longMESSAGE.' - '."\n";
					$errorOut = TRUE;
				}
				
				if(isset($errorCODE))
				{
					if(!isset($_SESSION['paypal_wpp_ex']))
					{
						$errorText = NVP_ErrorToText($errorCODE, 'dodirect');
						
						if($errorText)
						{
							$d["error"] = $errorText;
							$vmLogger->err($errorText);
							return false;
						}
					}
					else
					{
						$errorText = NVP_ErrorToText($errorCODE, 'doexpress');
						
						if($errorText)
						{
							$d["error"] = $errorText;
							$vmLogger->err($errorText);
							return false;
						}
					}
				}
				
				$count++;
			}
			
			//Check the AVS code for faulty address issues.
			if(isset($avsCode))
			{
				if (($avsCode == "P") || ($avsCode == "W") || ($avsCode == "X") || ($avsCode == "Y") || ($avsCode == "Z"))
				{
					$displayMsg .= $nvp_order_processed;
				}
				else
				{
					$displayMsg .= $nvp_address_error;
					$errorOut = TRUE;
				}
			}
			
			//Check the CVV code to make sure paypal could properly use it. If not we error out.
			if($requireCVV == '1')
			{
				if (isset($cvv2Code))
				{
					if(strtoupper($cvv2Code) == "N")
					{
						$displayMsg .= $nvp_error_invalid_CVV;
						$errorOut = TRUE;
					}
				}
			}
		}
		
		//Check to see if we display errors or not. 
		//If not set to 1 we only display errors in the debug file and not on screen
		if(PP_WPP_ERRORS == '1')
		{
			//If we have an error we add it to the log. We return false since we had an error.
			if ($errorOut || $errorOut2) {
		        $d["error"] = $displayMsg;
		        $d["order_payment_log"] = $displayMsg;
		        // Catch Transaction ID
				if(isset($transactionID))
				{
					$d["order_payment_trans_id"] = $transactionID;
		        }
				$html = "<br/><span class=\"message\">".$VM_LANG->_('PHPSHOP_PAYMENT_INTERNAL_ERROR')." Paypal Pro Direct Payment Error - " . $displayMsg . "</span>";
					if ($_SESSION['CURL_ERROR'] == true) { 
				        $d["error"] .= "-CURL ERROR: " . $_SESSION['CURL_ERROR_TXT'];
				        $d["order_payment_log"] .= "-CURL ERROR: " . $_SESSION['CURL_ERROR_TXT'];
				        $html .= "<br/><span class=\"message\">-CURL ERROR: " . $_SESSION['CURL_ERROR_TXT']."</span>";
					}
					
				if(isset($nvpLS)) $displayMsg .= $nvpLS;
		       
				$vmLogger->err($displayMsg);
			}
			if ($_SESSION['CURL_ERROR'] == true) { 
				echo "<br />" . $displayMsg . "PAYPAL ERROR: " . $_SESSION['CURL_ERROR_TXT'] . "<br /><br />" . $response; $d["error"] = "PAYPAL ERROR: " . $_SESSION['CURL_ERROR_TXT'];
			}
		}
		else
		{
			if ($errorOut || $errorOut2) {
				if ($_SESSION['CURL_ERROR'] == true) {
					$displayMsg .= $_SESSION['CURL_ERROR_TXT'];
				}
				
				$vmLogger->debug($displayMsg);
			}
		}
	
		if(isset($transactionID))
		{
			$d["order_payment_trans_id"] = $transactionID;
		}
		else
		{
			$vmLogger->err($nvp_error_no_transaction);
			return false;
		}
	
		//if we are down this far that means the order has completed succesfully.
		$d["order_payment_log"] = "Success: " . $order_number;
		// Catch Transaction ID
		
		$vmLogger->debug( $d['order_payment_log']);

		return true;
	} 
}

?>