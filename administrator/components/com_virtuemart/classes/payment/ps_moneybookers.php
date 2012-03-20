<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
*
* @version $Id: ps_moneybookers.php 1095 2007-12-19 20:19:16Z soeren_nb $
* @package VirtueMart
* @subpackage payment
* @copyright Copyright (C) 2010 Moneybookers - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
$lang = jfactory::getLanguage();
$languagefile = JPATH_ADMINISTRATOR .DS.'components'.DS.'com_moneybookers'.DS.'languages'.DS.$lang->getBackwardLang().'.php';
$default_lang = JPATH_ADMINISTRATOR .DS.'components'.DS.'com_moneybookers'.DS.'languages'.DS.'english.php';

if( file_exists( $languagefile ) ) {
	require_once( $languagefile );
} else {
	require_once( $default_lang );
}
/**
* This class implements the configuration panel for Moneybookers
*/
class ps_moneybookers {
	var $payment_code = 'MB';
    /**
    * Show all configuration parameters for this payment method
    * @returns boolean False when the Payment method has no configration
    */
    function show_configuration() {
        global $VM_LANG;
        $db = new ps_DB();
        
        /** Read current Configuration ***/
        include_once(CLASSPATH ."payment/".__CLASS__.".cfg.php");
    ?>
   <div class="shop_info"><a href="http://www.moneybookers.com/partners/virtuemart" target="_blank">
	<img style="border: 1px solid black;margin: 3px; padding-right: 10px;" src="components/com_moneybookers/images/mb-logo.png" alt="Moneybookers Logo" align="left" /></a>
	<?php echo MB_CFG_INTRODUCTION ?>
      </div>
    <table class="adminform">
	<tr class="row1">
        <td><strong><?php echo PHPSHOP_ADMIN_CFG_MB_EMAIL ?></strong></td>
            <td>
                <input type="text" name="MB_EMAIL" class="inputbox" value="<?php  echo MB_EMAIL ?>" />
            </td>
            <td><?php echo PHPSHOP_ADMIN_CFG_MB_EMAIL_EXPLAIN ?>
            </td>
        </tr>
	<tr>
            <td><strong><?php echo PHPSHOP_ADMIN_CFG_MB_SECRETWORD ?></strong></td>
            <td>
                <input type="text" name="MB_SECRET_WORD" class="inputbox" value="<?php echo MB_SECRET_WORD ?>" />
            </td>
            <td><?php echo PHPSHOP_ADMIN_CFG_MB_SECRETWORD_EXPLAIN ?></td>
        </tr>
	<tr>
            <td><strong><?php echo PHPSHOP_ADMIN_CFG_MB_MERCHANT_ID ?></strong></td>
            <td>
                <input type="text" name="MB_MERCH_ID" class="inputbox" value="<?php echo MB_MERCH_ID ?>" />
            </td>
            <td><?php echo PHPSHOP_ADMIN_CFG_MB_MERCHANT_ID_EXPLAIN ?></td>
        </tr>
        <tr class="row0">
            <td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_SUCCESS') ?></strong></td>
            <td>
                <select name="MB_VERIFIED_STATUS" class="inputbox" >
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
                      if (MB_VERIFIED_STATUS == $order_status_code[$i]) 
                         echo "\" selected=\"selected\">";
                      else
                         echo "\">";
                      echo $order_status_name[$i] . "</option>\n";
                    }?>
                    </select>
            </td>
            <td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_MB_STATUS_SUCCESS_EXPLAIN') ?>
            </td>
        </tr>
	
        <tr class="row1">
            <td><strong><?php echo $VM_LANG->_('VM_ADMIN_CFG_PAYPAL_STATUS_PENDING') ?></strong></td>
            <td>
                <select name="MB_PENDING_STATUS" class="inputbox" >
                <?php
                    for ($i = 0; $i < sizeof($order_status_code); $i++) {
                      echo "<option value=\"" . $order_status_code[$i];
                      if (MB_PENDING_STATUS == $order_status_code[$i]) 
                         echo "\" selected=\"selected\">";
                      else
                         echo "\">";
                      echo $order_status_name[$i] . "</option>\n";
                    } ?>
                    </select>
            </td>
            <td><?php echo $VM_LANG->_('VM_ADMIN_CFG_MB_STATUS_PENDING_EXPLAIN') ?></td>
        </tr>
        
        <tr class="row1">
            <td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_PAYPAL_STATUS_FAILED') ?></strong></td>
            <td>
                <select name="MB_INVALID_STATUS" class="inputbox" >
                <?php
                    for ($i = 0; $i < sizeof($order_status_code); $i++) {
                      echo "<option value=\"" . $order_status_code[$i];
                      if (MB_INVALID_STATUS == $order_status_code[$i]) 
                         echo "\" selected=\"selected\">";
                      else
                         echo "\">";
                      echo $order_status_name[$i] . "</option>\n";
                    } ?>
                    </select>
            </td>
            <td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_MB_STATUS_FAILED_EXPLAIN') ?>
            </td>
        </tr>
      </table>
    <?php
    }
    
    function has_configuration() {
      // return false if there's no configuration
      return true;
   }
   
  /**
	* Returns the "is_writeable" status of the configuration file
	* @param void
	* @returns boolean True when the configuration file is writeable, false when not
	*/
   function configfile_writeable() {
      return is_writeable( CLASSPATH."payment/".__CLASS__.".cfg.php" );
   }
   
  /**
	* Returns the "is_readable" status of the configuration file
	* @param void
	* @returns boolean True when the configuration file is writeable, false when not
	*/
   function configfile_readable() {
      return is_readable( CLASSPATH."payment/".__CLASS__.".cfg.php" );
   }
   
  /**
	* Writes the configuration file for this payment method
	* @param array An array of objects
	* @returns boolean True when writing was successful
	*/
   function write_configuration( &$d ) {
      
      $my_config_array = array(
                              
			      "MB_MERCH_ID" => $d['MB_MERCH_ID'],
                              "MB_EMAIL" => $d['MB_EMAIL'],
                              "MB_SECRET_WORD" => $d['MB_SECRET_WORD'],
                              "MB_VERIFIED_STATUS" => $d['MB_VERIFIED_STATUS'],
                              "MB_PENDING_STATUS" => $d['MB_PENDING_STATUS'],
                              "MB_INVALID_STATUS" => $d['MB_INVALID_STATUS']
                            );
      $config = "<?php\n";
      $config .= "if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); \n\n";
      foreach( $my_config_array as $key => $value ) {
        $config .= "define ('$key', '$value');\n";
      }
      
      $config .= "?>";
  
      if ($fp = fopen(CLASSPATH ."payment/".__CLASS__.".cfg.php", "w")) {
          fputs($fp, $config, strlen($config));
          fclose ($fp);
          return true;
     }
     else
        return false;
   }
   
  /**************************************************************************
  ** name: process_payment()
  ** returns: 
  ***************************************************************************/
   function process_payment($order_number, $order_total, &$d) {
        return true;
    }
   
}
