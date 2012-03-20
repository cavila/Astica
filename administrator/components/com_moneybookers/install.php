<?php
/**
 * @package		Moneybookers Admin Component
 * @copyright	Copyright (C) 2010 soeren. All rights reserved.
 * @license		GNU/GPL
 * This module is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
defined('_JEXEC') or die ('Restricted access');
/**
 * Installer function
 * @return
 */
function com_install()
{
   

    jimport('joomla.filesystem.folder');
    jimport('joomla.filesystem.file');

    $src_path = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_moneybookers';
    $dst_path = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_virtuemart';
/*
    // Remove existing files
    @JFile::delete($path.DS.'classes'.DS.'payment'.DS.'ps_moneybookers.php');
    @JFile::delete($path.DS.'classes'.DS.'payment'.DS.'ps_moneybookers.cfg.php');
    @JFile::delete($path.DS.'html'.DS.'checkout.resultmb.php');
    @JFile::delete($path.DS.'notifymb.php');
  */  
    jfile::move( $src_path.DS.'notifymb.php', $dst_path.DS.'notifymb.php' );
    jfile::move( $src_path.DS.'html'.DS.'checkout.resultmb.php', $dst_path.DS.'html'.DS.'checkout.resultmb.php' );
    jfile::move( $src_path.DS.'classes'.DS.'payment'.DS.'ps_moneybookers.php', $dst_path.DS.'classes'.DS.'payment'.DS.'ps_moneybookers.php' );
    jfile::move( $src_path.DS.'classes'.DS.'payment'.DS.'ps_moneybookers.cfg.php', $dst_path.DS.'classes'.DS.'payment'.DS.'ps_moneybookers.cfg.php' );

	echo '<h3>The Moneybookers Component has been installed.</h3>
	Now please proceed with the following steps:
	<ol><li>Go to the <a href="?option=com_moneybookers">Moneybookers Component</a> and 
	load all the Moneybookers Payment Modules you need into VirtueMart.</li>
	<li>Configure the Moneybookers Payment Modules you loaded in <a href="?option=com_virtuemart&amp;page=store.payment_method_list">VirtueMart</a>.</li>
	</ol>';
	
}
/**
 * Uninstall function
 * @return
 */
function com_uninstall()
{

}
