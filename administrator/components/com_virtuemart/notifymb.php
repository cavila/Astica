<?php
	
if ($_POST) {
	header("HTTP/1.0 200 OK");

    global $mosConfig_absolute_path, $mosConfig_live_site, $mosConfig_lang, $database,
    $mosConfig_mailfrom, $mosConfig_fromname;
    
        /*** access Joomla's configuration file ***/
        $my_path = dirname(__FILE__);
        
        if( file_exists($my_path."/../../../configuration.php")) {
            $absolute_path = dirname( $my_path."/../../../configuration.php" );
            require_once($my_path."/../../../configuration.php");
        }
        elseif( file_exists($my_path."/../../configuration.php")){
            $absolute_path = dirname( $my_path."/../../configuration.php" );
            require_once($my_path."/../../configuration.php");
        }
        elseif( file_exists($my_path."/configuration.php")){
            $absolute_path = dirname( $my_path."/configuration.php" );
            require_once( $my_path."/configuration.php" );
        }
        else {
            die( "Joomla Configuration File not found!" );
        }
        
        $absolute_path = realpath( $absolute_path );
        
        // Set up the appropriate CMS framework
        if( class_exists( 'jconfig' ) ) {
			define( '_JEXEC', 1 );
			define( 'JPATH_BASE', $absolute_path );
			define( 'DS', DIRECTORY_SEPARATOR );
			
			// Load the framework
			require_once ( JPATH_BASE . DS . 'includes' . DS . 'defines.php' );
			require_once ( JPATH_BASE . DS . 'includes' . DS . 'framework.php' );

			// create the mainframe object
			$mainframe = & JFactory::getApplication( 'site' );
			
			// Initialize the framework
			$mainframe->initialise();
			
			// load system plugin group
			JPluginHelper::importPlugin( 'system' );
			
			// trigger the onBeforeStart events
			$mainframe->triggerEvent( 'onBeforeStart' );
			$lang =& JFactory::getLanguage();
			$mosConfig_lang = $GLOBALS['mosConfig_lang']          = strtolower( $lang->getBackwardLang() );
			// Adjust the live site path
			$mosConfig_live_site = str_replace('/administrator/components/com_virtuemart', '', JURI::base());
			$mosConfig_absolute_path = JPATH_BASE;
        } else {
        	define('_VALID_MOS', '1');
        	require_once($mosConfig_absolute_path. '/includes/joomla.php');
        	require_once($mosConfig_absolute_path. '/includes/database.php');
        	$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
        	$mainframe = new mosMainFrame($database, 'com_virtuemart', $mosConfig_absolute_path );
        }

        // load Joomla Language File
        if (file_exists( $mosConfig_absolute_path. '/language/'.$mosConfig_lang.'.php' )) {
            require_once( $mosConfig_absolute_path. '/language/'.$mosConfig_lang.'.php' );
        }
        elseif (file_exists( $mosConfig_absolute_path. '/language/english.php' )) {
            require_once( $mosConfig_absolute_path. '/language/english.php' );
}
    /*** VirtueMart part ***/        
        require_once($mosConfig_absolute_path.'/administrator/components/com_virtuemart/virtuemart.cfg.php');
        include_once( ADMINPATH.'/compat.joomla1.5.php' );
        require_once( ADMINPATH. 'global.php' );
        require_once( CLASSPATH. 'ps_main.php' );

		$sess = new ps_session();

    /* load the VirtueMart Language File */
    if (file_exists( ADMINPATH. 'languages/admin/'.$mosConfig_lang.'.php' ))
      require_once( ADMINPATH. 'languages/admin/'.$mosConfig_lang.'.php' );
    else
   require_once( ADMINPATH. 'languages/admin/english.php' );

    require_once( CLASSPATH. 'payment/ps_moneybookers.cfg.php' );

    /* Load the VirtueMart database class */
    require_once( CLASSPATH. 'ps_database.php' );

    /*** END VirtueMart part ***/

    /**
    Read in the post from worldpay.
    **/

    $workstring = 'cmd=_notify-validate'; // Notify validate
    $i = 1;
    foreach ($_POST as $ipnkey => $ipnval) {
        if (get_magic_quotes_gpc())
            // Fix issue with magic quotes
            $ipnval = stripslashes ($ipnval);
            
       if (!eregi("^[_0-9a-z-]{1,30}$",$ipnkey)  || !strcasecmp ($ipnkey, 'cmd'))  { 
            // ^ Antidote to potential variable injection and poisoning
            unset ($ipnkey); 
            unset ($ipnval); 
        } 
       // Eliminate the above
        // Remove empty keys (not values)
        if (@$ipnkey != '') { 
          //unset ($_POST); // Destroy the original ipn post array, sniff...
          $workstring.='&'.@$ipnkey.'='.urlencode(@$ipnval); 
        }
       echo "key ".$i++.": $ipnkey, value: $ipnval<br />";
    } // Notify string

    $payment_status  = trim(stripslashes($_POST['status'])); //if $payment_status == 'Y'?
    $order_id =  trim(stripslashes($_POST['order_id']));
    $merchant_id = MB_MERCH_ID;
    $transaction_id = trim(stripslashes($_POST['transaction_id']));
    $mb_amount =  trim(stripslashes($_POST['mb_amount']));
    $mb_currency = trim(stripslashes($_POST['mb_currency']));
    $md5sig = trim(stripslashes($_POST['md5sig']));
    
    
    $md5_string = $merchant_id . $transaction_id .  strtoupper(md5(MB_SECRET_WORD)) . $mb_amount . $mb_currency . $payment_status;
    $result_of_md5 = strtoupper(md5($md5_string));

    if ($result_of_md5 == $md5sig) {
    
	$d['order_id'] = $order_id;    //this identifies the order record

		if( $payment_status == 2 ){
			$d['order_status'] = MB_VERIFIED_STATUS;  //this is the new value for the database field I think X for cancelled, C for confirmed
		}
		else if( $payment_status == 0 ){
			$d['order_status'] = MB_PENDING_STATUS;  //this is the new value for the database field I think X for cancelled, C for confirmed
		}
	/**
	* BEGIN fpCOM - IT Professionals (www.fpcom.de) Fix:
	* Do not allow manipulated transactions!!!! 
	*/
	$debug_email_address = MB_EMAIL;
		
	// Check for valid moneybookers Server 
	$notify_sender = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	if (! preg_match('/\.moneybookers\.com$/', gethostbyaddr($_SERVER["REMOTE_ADDR"]))) {
				
		$mailsubject = "Moneybookers Transaction on your site: Possible fraud";
		$mailbody = "Error code 506. Possible fraud. \n
						 Error with REMOTE IP ADDRESS = ".$_SERVER['REMOTE_ADDR'].".\n
						 The remote address of the script posting to this notify script\n
						 does not match a valid Moneybookers Server IP Address\n
						 \n
						 The Order ID received was: ".$order_id."\n";
		vmMail( $mosConfig_mailfrom, $mosConfig_fromname, $debug_email_address, $mailsubject, $mailbody );
		exit();
	}
			
	$qv = "SELECT `order_id`, `order_number`, `user_id`, `order_subtotal`,
			`order_total`, `order_currency`, `order_tax`, 
			`order_shipping_tax`, `coupon_discount`, `order_discount`
		   FROM `#__{vm}_orders` 
		   WHERE `order_id`='".$order_id."'";
	$db->query($qv);
	$db->next_record();
			
	// Check if amount and currency is not manipulated 
	$amount_check = round($db->f("order_total"), 2 );
								   
	if($mb_amount != $amount_check || $mb_currency != $db->f('order_currency') ) {

			$mailsubject = "Moneybookers Error: Order Total/Currency Check failed";
		$mailbody = "During a Moneybookers transaction on your site the received amount\n 
						 didn't match the order total.\n
					 Order ID: ".$db->f('order_id').".\n
					 The amount received was: $mb_amount $mb_currency.\n
						 It should be: $amount_check ".$db->f("order_currency").".";
						
		vmMail($mosConfig_mailfrom, $mosConfig_fromname, $debug_email_address, $mailsubject, $mailbody );
		exit();
	}
		
	// Check if payment is not manipulated
	if( $pay_to_email != MB_EMAIL ) {
			$mailsubject = "Moneybookers Error: pay_to_email Check failed";
			$mailbody = "During a Moneybookers transaction on your site the received pay_to_email \n
						 didn't match with your pay_to_email. Possible fraud.\n
					 Order ID: ".$db->f('order_id').".\n
						 The pay_to_email received was: $pay_to_email \n
						 It should be: ".MB_EMAIL.".\n";
						
		vmMail($mosConfig_mailfrom, $mosConfig_fromname, $debug_email_address, $mailsubject, $mailbody );
		exit();
	}
	/**
	* END fpCOM - IT Professionals (www.fpcom.de) Fix: 
	*/
	
    require_once ( CLASSPATH. 'ps_order.php' );

    $ps_order= new ps_order;

    $ps_order->order_status_update($d);

    }
}

?>