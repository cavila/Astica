<?php 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( dirname(__FILE__).DS.'functions.moneybookers.php');

$task = jrequest::getCmd('task');
$name = jrequest::getVar('name');

switch( $task ) {
	case 'enablepm':
		mb_enablePaymentMethod($name);
		break;
	case 'disablepm':
		mb_disablePaymentMethod( $name );
		break;
}

$available_mb_methods = array('CartaSi','Carte Bleue','Credit Cards',
							'eWallet','Giropay', 'iDeal','Lastschrift',
							'Maestro','Netpay','OBT','P24','PostePay','Sofortueberweisung');

echo '<div style="background-image: url(components/com_moneybookers/images/pay_moneybookers_larger.jpg);" class="header icon-48-module">
Moneybookers Payment Modules for VirtueMart
</div><table class="adminlist">
<thead><tr><th>ID</th>
<th>Payment Method Name</th>
<th>Enabled</th>
</tr>
</thead>
<tbody>';
$document = jfactory::getDocument();
$document->setTitle('Moneybookers Payment Modules for VirtueMart');
$db = jfactory::getDBO();
$db->setquery('SELECT * FROM #__vm_payment_method WHERE payment_method_code LIKE \'MB_%\'');
$result = $db->loadObjectList();
foreach( $available_mb_methods as $mb_method ) {
	$shortcode = mb_getShortCode( $mb_method ) ;
	$pm = new stdclass();
	$pm->payment_method_id = 'XX';
	$pm->payment_method_name = $mb_method;
	$pm->payment_enabled = 'N';
	
	foreach( $result as $res ) {
		if( $res->payment_method_code == $shortcode ) {
			$pm = $res;break;
		}
	}
	echo '<tr>';
	echo '<td>'.$pm->payment_method_id.'</td>';
	echo '<td>';
	if( $pm->payment_method_id != 'XX' ) {
		echo '<a style="font-weight: bold;" href="?option=com_virtuemart&amp;page=store.payment_method_form&amp;payment_method_id='.$pm->payment_method_id.'">';
		echo $pm->payment_method_name;
		echo '</a>';
	} else {
		echo '<span style="color:red;">'.$pm->payment_method_name.'</span>';
	}
	echo '</td>';
	echo '<td>';
	echo '<form action="'. $_SERVER['SCRIPT_NAME'].'" method="POST">';
	if( $pm->payment_method_id == 'XX' ) {
		$src= 'components/com_moneybookers/images/edit_add.png';
	} elseif( $pm->payment_enabled == 'Y' ) {
		$src= 'images/tick.png';
	} elseif( $pm->payment_enabled == 'N' ) {
		$src= 'images/publish_x.png';
	}
	echo '<input type="image" alt="img" style="border: none;" src="'.$src.'" />
	<input type="hidden" name="option" value="'.$option.'" />
	<input type="hidden" name="task" value="'.($pm->payment_enabled == 'Y' ? 'disablepm' : 'enablepm').'" />
	<input type="hidden" name="name" value="'.$mb_method.'" />
	</form>
	</td>';
	echo '</tr>';
}
echo '</tbody></table>';