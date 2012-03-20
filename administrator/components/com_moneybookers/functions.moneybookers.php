<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

function mb_getShortCode( $name ) {
	return substr( 'MB_'.strtoupper($name), 0, 8 );
}

function mb_enablePaymentMethod( $name ) {
	global $ps_vendor_id;
	$db = jfactory::getDBO();
	$shortCode = mb_getShortCode( $name );
	$db->setQuery('SELECT payment_method_id FROM #__vm_payment_method WHERE payment_method_code=\''.$shortCode.'\'');
	$result = $db->loadResult();
	if( !is_null( $result )) {
		echo '<div style="padding:10px; color: red; font-weight: bold;">Payment Method has already been added. 
		Please go to the <a href="?page=store.payment_method_list&amp;option=com_virtuemart">VirtueMart Payment Method List</a> to
		configure the Payment Method.</div>';
		return false;
	}
	// check if the SQL code for inserting the payment_extra_info code into payment_method table is available
	$file_to_load = dirname(__FILE__).DS.'Payment Extra Info-'.$name.'.txt';
	if( !file_exists($file_to_load) ) {
		echo '<div style="color: red; font-weight: bold;">Could not find the file '.$file_to_load.'</div>';
		return false;
	}
	$db->setQuery('SELECT shopper_group_id FROM #__vm_shopper_group WHERE `default`=1');
	$sgid = $db->loadResult();
	$db->setQuery('INSERT INTO #__vm_payment_method (payment_method_name,vendor_id,payment_class,shopper_group_id,
					payment_method_code,enable_processor,payment_enabled,payment_extrainfo)
					VALUES(
						\''.$name.'\',
						1,
						\'ps_moneybookers\',
						\''.$sgid.'\',
						\''.$shortCode.'\',
						\'P\',
						\'N\',
						\''.$db->getEscaped(addslashes(file_get_contents($file_to_load))).'\'
					)');
	$result = $db->query();
	if( $result === false ) {
		echo '<div style="color: red; font-weight: bold;">Failed to add the payment method.</div>';
		return false;
	}
	echo '<div style="color: green; font-weight: bold;">Success: the Payment Method has been added.</div>';
	return true;
}

function mb_disablePaymentMethod( $name ) {
	$db = jfactory::getDBO();
	$shortCode = mb_getShortCode( $name );
	$db->setQuery('UPDATE #__vm_payment_method SET payment_enabled=\'N\' WHERE payment_method_code=\''.$shortCode.'\'');
	$result = $db->loadResult();
	if( !is_null( $result )) {
		echo '<div style="color: red; font-weight: bold;">Failed to disabled the Payment Method.</div>';
		return false;
	}
}