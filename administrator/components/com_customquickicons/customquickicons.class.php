<?php
/**
* @version $Id: customquickicons.class.php,v 1.6 2008/09/25 20:01:01 mic $
* @version 2.1.0
* @package Custom QuickIcons
* @author michael (mic) pagler
* @copyright (C) 2006/07/08 mic [ http://www.joomx.com ]
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// helper class for CQI
if( defined( '_JEXEC' ) ) {
	class CQIBasic extends JTable {}
}else{
	class CQIBasic extends mosDBTable {}
}

/**
 * Basic class
 * @package Custom QuickIcons
 */
class CustomQuickIcons extends CQIBasic
{
	/** @var int Primary key */
	var $id				= null;
	/** @var string */
	var $text			= null;
	/** @var string */
	var $target			= null;
	/** @var string */
	var $icon			= null;
	/** @var int */
	var $ordering		= null;
	/** @var int */
	var $new_window		= null;
	/** @var string */
	var $prefix			= null;
	/** @var string */
	var $postfix		= null;
	/** @var int */
	var $published		= null;
	/* varchar(64) - title.tag */
	var $title			= null;
	/* tinyint(1) - check com/mod before display icon */
	var $cm_check		= null;
	/* varchar(255) - path for com/mod if it is to check */
	var $cm_path		= null;
	/* varchar(1) - accessibility key */
	var $akey			= null;
	/* tinyint(1) - outpu: only icon/text/text & icon */
	var $display		= null;
	/* access int(11) - assign icon to a specific user (has priority against group!) */
	var $access			= null;
	/* gid int(3) - acl-group.id */
	var $gid			= null;
	/* last user worked on int(11) */
	var $checked_out	= null;
	/* datetime @since 2.1.0 */
	var $checked_out_time	= null;

  	function __construct( &$_db ) {
		parent::__construct( '#__custom_quickicons', 'id', $_db );
	}

	function check() {
  		$ret = true;

  	    if( empty( $this->icon ) && $this->display != '1' ) {
        	$this->_error = JTEXT::_( 'MSG_ICON' );
            $ret = false;
        }
        if( empty( $this->target ) ) {
        	$this->_error = JTEXT::_( 'MSG_TARGET' );
            $ret = false;
        }
        if( empty( $this->text ) ){
        	$this->_error = JTEXT::_( 'MSG_TEXT' );
            $ret = false;
        }

        return $ret;
    }

    function _QI_version() {
    	global $qiVersion;

    	$qiVersion = array();
    	$qiVersion['version'] 	= '2.1.0';
    	$qiVersion['date'] 		= '2008.09.25';

    	return $qiVersion;
    }

    /**
	 * Helper function to find correct cms version
	 *
	 * @return bool
	 * @author mic [ http://www.joomx.com ]
	 * @since 2008.02.24
	 * @version 1.1
	 */
	function _CheckCMSVersion() {
		if( class_exists( 'joomlaversion' ) ) {
			// J.1.0.x
			$class = 'joomlaversion';
		}elseif( class_exists( 'JVersion' ) ) {
			// J.1.5.x
			$class = 'JVersion';
			return true;
		}
		$version = new $class;

		if( $version->RELEASE >= '1.0' && $version->DEV_LEVEL >= '14' ) {
			return true;
		}else{
			return false;
		}
	}

	/**
	 * adds a css definition either into the header or direct to the html code
	 * NOTE: $live_site must be defined already (is a placeholder for $mosConfig_live_site to be compat w. J.1.5.x)
	 *
	 * @param string $css	name of css.file
	 */
	function addCSS( $css = '' ) {
		global $live_site, $option;

		if( !$css ) {
			$css = 'help';
		}

		$html = '<link href="' . $live_site
		. '/administrator/components/' . $option . '/help/'
		. $css . '.css" rel="stylesheet" type="text/css" media="all" />';

		if( CustomQuickIcons::_CheckCMSVersion() ) {
			$doc =& JFactory::getDocument();
			$doc->addStyleSheet( $live_site . '/administrator/components/' . $option . '/help/' . $css . '.css' );
		}else{
			echo $html;
		}
	}
}
?>