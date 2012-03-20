<?php
/**
* @version $Id: admin.customquickicons.php,v 1.9 2008/09/25 19:52:52 mic $
* @version 2.1.0
* @package Custom QuickIcons
* @author michael (mic) pagler
* @copyright (C) 2007/08 mic [ http://www.joomx.com ]
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

global $mainframe, $live_site;

// mic 20080914: check for com_config is only a quick fix
$user =& JFactory::getUser();
if( !$user->authorize( 'com_config', 'manage' ) ) {
	$mainframe->redirect( 'index.php', JText::_( 'ALERTNOTAUTH' ) );
}

require_once( JApplicationHelper::getPath( 'admin_html' ) );
require_once( JApplicationHelper::getPath( 'class' ) );

$live_site	= str_replace( '/administrator/', '', JURI::base() );
$id			= JRequest::getVar( 'id', NULL );
$cid		= JRequest::getVar( 'cid', array(0) );

if( !is_array( $cid ) ) {
	$cid = array(0);
}

switch( $task ) {
	case 'new':
		editIcon( null, $option );
		break;

	case 'edit':
		editIcon( $id, $option );
		break;

	case 'delete':
		deleteIcon( $cid, $option );
		break;

	case 'save':
		saveIcon( 1, $option );
		break;

	case 'apply':
		saveIcon( 0, $option );
		break;

	case 'copy':
		copyIcon();
		break;

	case 'publish':
		changeIcon( $cid, 1, $option );
		break;

	case 'unpublish':
		changeIcon( $cid, 0, $option );
		break;

	case 'orderUp':
		orderIcon( -1, $option );
		break;

	case 'orderDown':
		orderIcon( 1, $option );
		break;

	case 'chooseIcon':
		chooseIcon( $option );
		break;

	case 'saveorder':
		saveOrder( $cid, $option );
		break;

	case 'about':
		HTML_QuickIcons::_support();
		break;

	case 'cancelIcon':
		cancelIcon( $option );
		break;

	case 'convert':
		convert();
		break;

	case 'editCSS':
		editCSS();
		break;

	case 'saveCSS':
		saveCSS();
		break;

	default:
		show( $option );
    	break;
}

/**
 * show all items as overview
 *
 * @param unknown_type $option
 */
function show( $option ) {
	global $mainframe;

	$db	=& JFactory::getDBO();

	$listLimit	= $mainframe->getCfg( 'list_limit', 10 );

	$limit 		= intval( $mainframe->getUserStateFromRequest( 'viewlistlimit', 'limit', $listLimit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );
	$search 	= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search 	= $db->getEscaped( trim( strtolower( $search ) ) );

	$where = array();

	if ( $search ) {
		$where[] = 'LOWER( a.text ) LIKE \'%$search%\''
		. ' OR LOWER( a.target ) LIKE \'%$search%\''
		. ' OR LOWER( a.cm_path ) LIKE \'%$search%\''
		;
	}

	// check if module is installed and published at correct position
	$query = 'SELECT id, position'
	. ' FROM #__modules'
	. ' WHERE module = \'mod_customquickicons\''
	;
	$db->setQuery( $query );
	$rows = $db->loadObjectList();

	$error = false;
	if( !isset( $rows[0]->id ) ) {
		echo "<script type=\"text/javascript\">alert('" . JTEXT::_( 'ERR_NO_MOD_INSTALLED' ) . "');</script>\n";
		$error = true;
	}

	if( isset( $rows[0]->position ) && isset( $rows[0]->position ) ) {
		if( $rows[0]->position != 'icon' && $rows[0]->position != 'cpanel' ) {
			echo "<script type=\"text/javascript\">alert('" . html_entity_decode( JTEXT::_( 'ERR_MOD_INCORR_POS' ) ) . "');</script>\n";
			$error = true;
		}
	}else{
		$error = true;
	}

	// get total number of records
	$query = 'SELECT COUNT(*)'
	. ' FROM #__custom_quickicons AS a'
	. ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' )
	;
	$db->setQuery( $query );
	$total = $db->loadResult();

	jimport( 'joomla.html.pagination' );
	$pagination = new JPagination( $total, $limitstart, $limit );

	$query = 'SELECT a.*, g.name AS groupname, u.username AS uname'
	. ' FROM #__custom_quickicons AS a'
	. ' LEFT JOIN #__core_acl_aro_groups AS g ON g.id = a.gid'
	. ' LEFT JOIN #__users AS u ON u.id = a.access'
	. ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' )
	. ' ORDER BY ordering'
	;
	$db->setQuery( $query );
	$rows = $db->loadObjectList();

	HTML_QuickIcons::show( $rows, $option, $search, $pagination, $error );
}

/**
 * Function to edit existing or create new item
 *
 * @param int		$id		icon id
 * @param string	$option	internal task
 */
function editIcon( $id, $option ) {

	$db	=& JFactory::getDBO();
	$my			=& JFactory::getUser();
	$acl		=& JFactory::getACL();

	$row = new CustomQuickIcons( $db );
	$row->load( $id );

	if( $id ) {
		// record exists
		$row->checkout( $my->id );
	}else{
		// new record
		$row->ordering 	= 0;
		$row->published = 1;
	}

	$query = 'SELECT ordering AS value, text AS text'
	. ' FROM #__custom_quickicons'
	. ' ORDER BY ordering'
	;
	$lists['ordering']	= JHTML::_( 'list.specificordering', $row, $id, $query, 1 );

	// build the html select list for the components
	$query = 'SELECT CONCAT_WS( \' \', link, admin_menu_link ) AS value, name AS text, id, parent'
	. ' FROM #__components'
	. ' WHERE link != \'\''
	. ' OR admin_menu_link != \'\''
	. ' ORDER BY id, parent'
	;
	 // id special handling
	$lists['components']	= JHTML::_( 'list.specificordering', $row, $id = true, $query, 1 );
	// get list of menu entries in all menus
    $query = 'SELECT admin_menu_link AS value, CONCAT_WS( \' :: \', name, `option` ) AS text'
    . ' FROM #__components'
	. ' WHERE admin_menu_link != \'\''
	. ' AND (parent = 0 OR parent = 1)'
	. ' ORDER BY name'
	;
    $db->setQuery( $query );
    $results = $db->loadObjectList();

    // need to convert for XHTML.compliance
    foreach( $results as $res ) {
    	$targ = new stdClass();
    	$targ->value = htmlspecialchars( $res->value );
    	$targ->text = $res->text;
    	$targets[] = $targ;
    }

	$lists['targets']	= JHTML::_( 'select.genericlist', $targets, 'tar_gets',
						'class="inputbox" size="1"', 'value', 'text', NULL );
	// components (with name) for check
	$query = 'SELECT name AS value, CONCAT_WS( \' :: \', `option`, name ) AS text'
	. ' FROM #__components'
	. ' WHERE parent = \'0\''
	. ' AND `option` != \'\''
	. ' ORDER BY name'
	;
	$db->setQuery( $query );
    $ccheck = $db->loadObjectList();

	$lists['components_check']	= JHTML::_( 'select.genericlist', $ccheck, 'ccheck',
								'class="inputbox" size="1"', 'value', 'text', NULL );

	// list for usergroups
	// ensure user can't add group higher than themselves
	$user_groups = $acl->get_object_groups( 'users', $my->id, 'ARO' );
	if( is_array( $user_groups ) && count( $user_groups ) > 0 ) {
		$ex_groups = $acl->get_group_children( $user_groups[0], 'ARO', 'RECURSE' );
	}else{
		$ex_groups = array();
	}

	// add unwanted groups to be removed below
	$ex_groups[] = '29'; // Public Frontend
	$ex_groups[] = '18'; // Registered
	$ex_groups[] = '19'; // Author
	$ex_groups[] = '20'; // Editor
	$ex_groups[] = '21'; // Publisher
	$ex_groups[] = '30'; // Public Backend

	$gtree = $acl->get_group_children_tree( null, 'USERS', false );
	// remove users 'above' me and unwanted groups as defined above
	$i = 0;
	while( $i < count( $gtree ) ) {
		if( in_array( $gtree[$i]->value, $ex_groups ) ) {
			array_splice( $gtree, $i, 1 );
		}else{
			$i++;
		}
	}

	// overrule value if not set already or if a new item
	if( empty( $row->gid ) ) {
		$row->gid = '25';
	}

	$lists['gid'] = JHTML::_( 'select.genericlist', $gtree, 'gid', 'size="4"', 'value', 'text', $row->gid );

	// display
	$display = array(
		JHTML::_( 'select.option', '',	JTEXT::_( 'DISPLAY_ICON_TEXT' ) ),
		JHTML::_( 'select.option', '1', JText::_( 'DISPLAY_TEXT' ) ),
		JHTML::_( 'select.option', '2', JText::_( 'DISPLAY_ICON' ) ),
	);
	$lists['display']	= JHTML::_( 'select.genericlist', $display, 'display', 'size="1"',
						'value', 'text', $row->display );

	// custom image folder(s)
	$folders	= getImageFolders();
	$folder		= array();

	foreach( $folders as $fold ) {
		$folder[] = JHTML::_( 'select.option', $fold, $fold );
	}
	$lists['folder']	= JHTML::_( 'select.genericlist', $folder, 'folder', 'size="1"',
						'value', 'text', null );

	// get number if managed links
	$query = 'SELECT max(id)'
	. ' FROM #__custom_quickicons'
	;
	$db->setQuery( $query );
	$lists['result'] = $db->loadResult();

	$lists['reshalf'] = ceil( $lists['result'] / 2 );

	// get backend users
	$query = 'SELECT id, username'
	. ' FROM #__users'
	. ' WHERE usertype = \'Super Administrator\''
	. ' OR usertype = \'Administrator\''
	. ' OR usertype = \'Manager\''
	. ' AND block = 0'
	;
	$db->setQuery( $query );
	$result = $db->loadObjectList();

	$lists['access'] = array();
	$access = array();
	$access[] = JHTML::_( 'select.option', '', JTEXT::_( 'DETAIL_NO' ) );
	foreach( $result as $res ) {
		$access[] = JHTML::_( 'select.option', $res->id, $res->username );
	}
	$lists['access']	= JHTML::_( 'select.genericlist', $access, 'access', 'size="1"',
						'value', 'text', $row->access );

	CustomQuickIcons::addCSS();

	HTML_QuickIcons::edit( $row, $lists, $option );
}

/**
 * publishing an item
 *
 * @param array		$cid	array if item ids
 * @param integer	$action	1|0
 * @param string	$option
 */
function changeIcon( $cid, $action, $option ) {
	global $mainframe;

	$db	=& JFactory::getDBO();

	if( !is_array( $cid ) || count( $cid ) < 1 ) {
		$errMsg = $action ? JTEXT::_( 'ERR_SELECT_PBL ' ): JTEXT::_( 'ERR_SELECT_UPBL' );
		echo "<script>alert('" . $errMsg . "'); window.history.go(-1);</script>\n";
		exit();
	}

	$cids = implode( ',', $cid );

	$query = 'UPDATE #__custom_quickicons'
	. ' SET published = ' . $action
	. ' WHERE id IN ( ' . $cids . ' )'
	;
	$db->setQuery( $query );
	if( !$db->query() ) {
		JError::raiseError( 500, $db->getError() );
		return false;
	}

	$mainframe->redirect( 'index.php?option=' . $option );
}

/**
 * Save Icon
 *
 * @param bool		$redirect	where to go after savin
 * @param string	$option		internal var
 * @since v.2.0.7	deleting common path
 */
function saveIcon( $redirect, $option ) {
	global $mainframe, $live_site;

	$db =& JFactory::getDBO();
	$row = new CustomQuickIcons( $db );

	// cannot use JRequest, because all tags get filtered (prefix, postfix)
	// JRequest::get( 'post' )
	if( !$row->bind( $_POST ) ) {
		return JError::raiseWarning( 500, $row->getError() );
	}

	// do some special handling
	// delete common path, we store only the relative path
	$row->icon		= str_replace( $live_site, '' , $row->icon );
	// strip slashes
	$row->prefix	= stripslashes( $row->prefix );
	$row->postfix	= stripslashes( $row->postfix );

	if( !$row->check() ) {
		return JError::raiseWarning( 500, $row->getError() );
	}

	if( $row->target == 'index2.php?option=' || $row->target == 'index.php?option=' || !$row->target ){
		$row->published = 0;
	}

	if( !$row->store() ) {
		return JError::raiseWarning( 500, $row->getError() );
	}
	$row->checkin();
	$row->reorder();

	if( !$redirect ) {
		$mainframe->redirect( 'index.php?option=' . $option . '&task=edit&id=' . $row->id );
	}else{
		$mainframe->redirect( 'index.php?option=' . $option );
	}
}

function copyIcon() {
	global $mainframe;

	$db		=& JFactory::getDBO();
	$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
	$option	= JRequest::getCmd( 'option' );

	JArrayHelper::toInteger( $cid );

	if( count( $cid ) < 1 ) {
		$msg = JText::_( 'Select an item to move' );
		$mainframe->redirect( 'index.php?option=' . $option, $msg, 'error' );
	}

	$total = count( $cid );
	for( $i = 0; $i < $total; $i ++ ) {
		$row = new CustomQuickIcons( $db );

		$query = 'SELECT a.*'
		. ' FROM #__custom_quickicons AS a'
		. ' WHERE a.id = ' . (int) $cid[$i]
		;
		$db->setQuery( $query, 0, 1 );
		$item = $db->loadObject();

		// INSERT INTO `jos_custom_quickicons` (`id`, `text`, `target`, `icon`, `ordering`, `new_window`, `prefix`, `postfix`, `published`, `title`, `cm_check`, `cm_path`, `akey`, `display`, `access`, `gid`, `checked_out`, `checked_out_time`) VALUES
		// values loaded into array set for store
		$row->id				= NULL;
		$row->text				= '[' . JTEXT::_( 'Copy of' ) . '] ' . $item->text;
		$row->target			= $item->target;
		$row->icon				= $item->icon;
		$row->ordering			= '0';
		$row->new_window		= $item->new_window;
		$row->prefix			= $item->prefix;
		$row->postfix			= $item->postfix;
		$row->published			= $item->published;
		$row->title				= $item->title;
		$row->cm_check			= $item->cm_check;
		$row->cm_path			= $item->cm_path;
		$row->akey				= '';
		$row->display			= $item->display;
		$row->access			= '';
		$row->gid				= '25';
		$row->checked_out		= '';
		$row->checked_out_time	= '';

		if( !$row->check() ) {
			JError::raiseError( 500, $row->getError() );
			return false;
		}

		if( !$row->store() ) {
			JError::raiseError( 500, $row->getError() );
			return false;
		}

		$row->reorder();
	}

	$mainframe->redirect( 'index.php?option=' . $option );
}

/**
 * reordering if an item
 *
 * @param integer	$id		id of item
 * @param integer	$inc	number to in-/decrease
 * @param string	$option	pgm.option
 */
function orderIcon( $inc, $option ) {
	global $mainframe;

	$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );

	$db	=& JFactory::getDBO();
	$row = new CustomQuickIcons( $db );

	$row->load( (int) $cid[0] );
	$row->move( $inc );

	$msg = JTEXT::_( 'MSG_NEW_ORDER_SAVED' );

	$mainframe->redirect( 'index.php?option=' . $option, $msg );
}

/**
 * saves the ordering of an item (other routine then ordericon())
 *
 * @author Eric C.
 * @param array		$cid	array of items
 * @param string	$option
 */
function saveOrder( &$cid, $option ) {
	global $mainframe;

	$db		=& JFactory::getDBO();
	$order	= JRequest::getVar( 'order', array(0) );

	$total = count( $cid );

	for( $i = 0; $i < $total; $i++ ) {
		$query = 'UPDATE #__custom_quickicons'
		. ' SET ordering = ' . $order[$i]
		. ' WHERE id = ' . $cid[$i]
		;
		$db->setQuery( $query );
		if( !$db->query() ) {
			JError::raiseError( 500, $db->getError() );
			return false;
		}

		$row = new CustomQuickicons( $db );
		$row->load( $cid[$i] );
		$row->reorder();
	}

	$msg = JTEXT::_( 'MSG_NEW_ORDER_SAVED' );

	$mainframe->redirect( 'index.php?option=' . $option, $msg );
}

/**
 * deleting items
 *
 * @param array		$cid	array if all items
 * @param string	$option
 */
function deleteIcon( &$cid, $option ) {
	global $mainframe;

	$db	=& JFactory::getDBO();

	if( count( $cid ) ) {
		$cids = implode( ',', $cid );

		$query = 'DELETE FROM #__custom_quickicons'
		. ' WHERE id IN ( ' . $cids . ' )'
		;
		$db->setQuery( $query );
		if( !$db->query() ) {
			JError::raiseError( 500, $db->getError() );
			return false;
		}
	}

	$msg = JTEXT::_( 'MSG_SUC_DELETED' );

	$mainframe->redirect( 'index.php?option=' . $option, $msg );
}

/**
 * perfoms a cancel action: checkin the item
 *
 * @param unknown_type $option
 * @since 2.1.0
 */
function cancelIcon( $option ) {
	global $mainframe;

	$db =& JFactory::getDBO();

	//$row =& JTable::getInstance( 'custom_quickicons' );
	$row = new CustomQuickicons( $db );
	$row->bind( $_POST );
	$row->checkin();

	$mainframe->redirect( 'index.php?option=' . $option );
}

/**
 * converts an existing db.table into the new created db.table
 * @since 2.1.0
 */
function convert() {
	global $mainframe;

	$table = JRequest::getVar( 'table', '' );

	if( $table ) {
		$db =& JFactory::getDBO();

		$query = 'SELECT *'
		. ' FROM #__custom_quickicons_bu_' . $table
		;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();

		// first empty table
		$query = 'TRUNCATE #__custom_quickicons';
		$db->setQuery( $query );
		if( $db->query() ) {
			$i = 0;
			foreach( $rows as $row ) {
				$query = "INSERT INTO #__custom_quickicons VALUES ('', '" . $row->text . "', '" . $row->target . "', '" . $row->icon . "', " . $row->ordering . ", " . $row->new_window . ", '" . $row->prefix . "', '" . $row->postfix . "', " . $row->published . ", '" . $row->title . "', '" . $row->cm_check . "', '" . $row->cm_path . "', '" . $row->akey . "', '" . $row->display . "', '" . $row->access . "', '" . $row->gid . "', '', '0000-00-00 00:00:00')";
		        $db->setQuery( $query );
		        if( !$db->query() ) {
		            echo "<script>alert('" . $db->getErrorMsg() . "');</script>\n";
		            exit();
		        }
		        $i++;
			}
			$msg = JTEXT::sprintf( 'Database converted', $i );
		}else{
			$msg = '[1] ' . JTEXT::_( 'Database convert error' );
		}
	}else{
		$msg = '[2] ' . JTEXT::_( 'Database convert error' );
	}

	$mainframe->redirect( 'index.php?option=com_customquickicons', $msg );
}

/**
 * edit CQI own css class
 * @since 2.1.0
 */
function editCSS() {

	$file		= JPATH_ADMINISTRATOR .DS. 'modules' .DS. 'mod_customquickicons' .DS. 'cqi.css';
    $f			= @fopen( $file, 'rb' );
    $content	= @fread( $f, filesize( $file ));
    $content	= htmlspecialchars( $content );
    $cssVars 	= array();
    $cssVars['content'] = $content;
    $cssVars['file']	= $file;

    @chmod( $file, 0777 );
    if( !is_writable( $file )){
    	$cssVars['msg'] = JTEXT::_( 'File not writeable' );
    }
    @chmod( $file, 0644 );

	HTML_QuickIcons::editCSS( $cssVars );
}

/**
 * save CQI own css class
 * @since 2.1.0
 */
function saveCSS() {
	global $mainframe, $option;

	$file		= JPATH_ADMINISTRATOR .DS. 'modules' .DS. 'mod_customquickicons' .DS. 'cqi.css';
	$content	= JRequest::getVar( 'content', '' );

	if( $content ) {
		@chmod( $file, 0777 );
		$permission = is_writable( $file );

		if( !$permission ) {
			$msg = JTEXT::_( 'File not writeable' );
			break;
		}else{
			if( $fp = fopen( $file, 'wb' ) ) {
				@fputs( $fp, stripslashes( $content ));
				@fclose( $fp );
				@chmod( $file, 0644 );
				$msg = JTEXT::_( 'File sucessfully saved' );
			}
		}
	}else{
		$msg = JTEXT::_( 'No file to save' );
	}

	$mainframe->redirect( 'index.php?option=com_customquickicons', $msg );
}

/** helper functions **/

/**
 * Gets images from a defined folder
 *
 * @param string	$option	internal task
 * @since 2.0.7:
 * 	- get images also from user images folder (optional the folder icons can be created new)
 *  - checks for double images
 * @since 2.1.0: gets all paths including images
 */
function chooseIcon( $option ) {

	$folder	= JRequest::getVar( 'folder', '' );

	$icons		= 0;
	$imgs		= array();
	if( $folder ) {
		$folders[] = $folder;
	}else{
		// fallback
		$folders[]	= '/administrator/templates/khepri/images/header/';
	}

	foreach( $folders as $fold ) {
		if( file_exists( JPATH_SITE . $fold ) ) {
			$handle = @opendir( JPATH_SITE . $fold );
			while( $file = @readdir( $handle ) ) {
				if( _checkImage( $fold . $file ) ) {
					if( !in_array( $fold . $file, $imgs ) ) {
						$imgs[] = $fold . $file;
						$icons++;
					}
				}
			}
			closedir( $handle );
		}
	}

	HTML_QuickIcons::chooseIcon( $imgs, $option, $icons );
}

/**
 * reads a given directory recursive for (image) folders [based on the CMS structure]
 * @param string	$basePath	directory to start from
 * @param array		$imgFolders	internal holder for founded image folders
 *
 * @return array
 */
function getImageFolders( $basePath = '', &$imgFolders = '' ) {

	$folders	= array();

	if( !$basePath ) {
		$basePath = str_replace( '/administrator/', '', JPATH_SITE ) .DS;
	}

	if( empty( $imgFolders ) || !is_array( $imgFolders ) ) {
		$imgFolders = array();
	}

	// filter folders
	if( ( strpos( $basePath, 'instal' ) === false )
	&& ( strpos( $basePath, 'mod_' ) === false )
	&& ( strpos( $basePath, 'editor' ) === false ) ) {
		if( strpos( $basePath, 'image' ) !== false ) {
			$folder = str_replace( JPATH_SITE, '', $basePath );
			$folder = str_replace( DS, '/', $folder );
	    	$imgFolders[] = $folder;
		}
	}

	if( is_dir( $basePath ) ) {
	    if( $dh = opendir( $basePath ) ) {
	        while( ( $file = readdir( $dh ) ) !== false ) {
	        	if( $file != '.' && $file != '..' ) {
		            if( is_dir( $basePath . $file ) ) {
			            getImageFolders( $basePath . $file .DS, $imgFolders );
		            }
	        	}
	        }
	        closedir( $dh );
	    }
	}

	return $imgFolders;
}

/**
 * simple image checker for proportions and type
 *
 * @param string $img
 * @access private
 * @since 2.1.0
 * @return bool
 */
function _checkImage( $image ) {

	if( eregi( 'gif|jpg|jpeg|png', $image ) ) {
		if( function_exists( 'getimagesize' ) ) {
			$thisimageWH = getimagesize( JPATH_SITE . $image );
			$thisimageW  = $thisimageWH[0];
			$thisimageH  = $thisimageWH[1];

			if( $thisimageWH[0] > 64 || $thisimageWH[1] > 64 ) {
				return false;
			}
		}

		return true;
	}

	return false;
}
?>