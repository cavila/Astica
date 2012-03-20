<?php
/**
* @version $Id: toolbar.customquickicons.html.php,v 1.4 2008/09/25 19:43:43 mic $
* @version 2.1.0
* @package Custom QuickIcons
* @copyright (C) 2006/08/08 mic [ http://www.joomx.com ]
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * @package Custom QuickIcons
 */
class QI_Toolbar {

	function _edit() {
		JToolBarHelper::save( 'save', JTEXT::_( 'SAVE' ) );
		JToolBarHelper::apply( 'apply', JTEXT::_( 'APPLY' ) );
		JToolBarHelper::cancel( 'cancelIcon', JTEXT::_( 'CANCEL' ) );
		JToolBarHelper::media_manager( '', JTEXT::_( 'MEDIAMGR' ) );
		JToolBarHelper::help( 'screen.cquickicons.config.html', true );
	}

	function _show() {
		JToolBarHelper::publishList( 'publish', JTEXT::_( 'PUBLISH' ) );
		JToolBarHelper::unpublishList( 'unpublish', JTEXT::_( 'UNPUBLISH' ) );
		JToolBarHelper::addNewX( 'new', JTEXT::_( 'NEW' ) );
		JToolBarHelper::editListX( 'edit', JTEXT::_( 'EDIT' ) );
		JToolBarHelper::custom( 'copy', 'copy.png', 'copy_f2.png', JTEXT::_( 'Copy' ) );
		JToolBarHelper::deleteList( JTEXT::_( 'Are you shure' ), 'delete', JTEXT::_( 'DELETE' ) );
		JToolBarHelper::customX( 'editCSS', 'css.png', 'css_f2.png', JTEXT::_( 'Edit CSS' ), false );
		JToolBarHelper::help( 'screen.cquickicons.mgr.html', true );
	}

	function _editCSS() {
		JToolBarHelper::save( 'saveCSS', JTEXT::_( 'SAVE' ) );
		JToolBarHelper::back();
	}

	// mic 2008.09.16: this empty bar must be here, otherwise XHTML.errors!
	function _chooseIcon(){
	}
}
?>