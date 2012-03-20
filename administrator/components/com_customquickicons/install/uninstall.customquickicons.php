<?php
/**
* @version $Id: uninstall.customquickicons.php,v 1.5 2008/09/22 11:15:15 mic $
* @package CQI - Custom Quick Icons 2.1.0
* @author michael (mic) pagler
* @copyright (C) 2006/7/8 mic [ http://ww.joomx.com ]
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// load the component language file
$language =& JFactory::getLanguage();
$language->load( 'com_customquickicons' );

$database	=& JFactory::getDBO();
$dir		= JPATH_ADMINISTRATOR .DS. 'modules' .DS;
$msg		= '';

// delete module files
JFile::delete( $dir . 'mod_customquickicons' .DS. 'mod_customquickicons.php' );
Jfile::delete( $dir . 'mod_customquickicons' .DS. 'mod_customquickicons.xml' );
JFolder::delete( $dir . 'mod_customquickicons' );

// delete db.entry
$query = 'DELETE FROM #__modules'
. ' WHERE module = \'mod_customquickicons\''
;
$database->setQuery( $query );
$database->query();

// set original module active (if not deleted)
$query = 'SELECT id'
. ' FROM #__modules'
. ' WHERE module = \'mod_quickicon\''
;
$database->setQuery( $query );
$id = $database->loadResult();

if( $id ) {
	$query = 'UPDATE #__modules'
	. ' SET published = \'1\''
	. ' WHERE id = ' . $id
	. ' LIMIT 1'
	;
	$database->setQuery( $query );
	if( $database->query() ) {
		$msg .= JTEXT::_( 'Original module activated' );
	}
}

/*
// remove table
$query = 'DROP TABLE IF EXISTS `#__custom_quickicons`' ;
$database->setQuery( $query );
$database->query();
*/

$out = '<div style="margin:5px; padding 5px;"><div>'
. $msg
. '<br />'
. JTEXT::_( 'CQI successfully uninstalled' )
. '</div></div>' . "\n";

echo $out;
?>