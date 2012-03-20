<?php
/**
* @version $Id: toolbar.customquickicons.php,v 1.4 2008/09/22 11:48:48 mic $
* @version 2.1.0
* @package Custom QuickIcons
* @copyright (C) 2006/07/08 mic [ http://www.joomx.com ]
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( JApplicationHelper::getPath( 'toolbar_html' ) );
$task = JArrayHelper::getValue( $_REQUEST, 'task', '' );

switch( $task ) {
	case 'new':
	case 'edit':
		QI_Toolbar::_edit();
		break;

	case 'chooseIcon':
		QI_Toolbar::_chooseIcon();
		break;

	case 'editCSS':
		QI_Toolbar::_editCSS();
		break;

	default:
		QI_Toolbar::_show();
		break;
}
?>