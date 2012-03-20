<?php
/**
* @version $Id: mod_customquickicons.php 2008/10/01 17:10:10 mic $
* @version 2.1.0
* @package Custom QuickIcons
* @copyright (C) 2006/07/08 mic / http://www.joomx.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* based on the Joomla/Mambo mod_quickicon
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$language =& JFactory::getLanguage();
$language->load( 'mod_customquickicons' );

// get browser (needed for accesskey tip)
global $isMoz;
jimport( 'joomla.environment.browser' );
$browser = new JBrowser;
$isMoz = ( $browser->getBrowser() == 'mozilla' );

if( !defined( '_QUICKICON_MODULE' ) ) {
	// ensure that functions are declared only once
	define( '_QUICKICON_MODULE', 1 );
	function MOD_quickiconButton( $row, $parm ) {
		global $live_site, $isMoz; ?>

	    <div style="float:left;<?php echo $parm->style; ?>">
	        <div class="<?php echo $parm->css; ?>">
	            <?php echo $parm->link; ?>
	        </div>
	    </div>
	    <?php
	}
}

$db	=& JFactory::getDBO();

// check if module is installed
$query = 'SELECT id, position'
. ' FROM #__modules'
. ' WHERE module = \'mod_customquickicons\''
;
$db->setQuery( $query );
$modules = $db->loadObjectList();

$shown = array();

// check if component exists and if module is published
if( !file_exists( JPATH_ADMINISTRATOR .DS. 'components' .DS. 'com_customquickicons' .DS. 'admin.customquickicons.php' )
|| empty( $modules ) ) {
	echo JTEXT::_( 'No component found' );
}else{

    global $live_site;

    // mic: fix for J.1.5
    $live_site	= str_replace( '/administrator/', '', JURI::base() );
    $parm		= new stdClass; ?>

    <div id="cpanel">
    	<?php
        $user =& JFactory::getUser();

        $parm->isAdmin = false;
        if( $user->usertype == 'Super Administrator' ) {
        	$isAdmin = true;
        	$parm->isAdmin = true;
        }

		 $query = 'SELECT *'
        . ' FROM #__custom_quickicons'
        . ' WHERE published = 1'
        . ' ORDER BY ordering'
        ;
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if( $db->getErrorNum() ) {
            echo $db->stderr();
            return false;
        }

        // get params and define cqi-parms
        $parm->css		= $params->get( 'css', '' );
        $parm->uAccess	= $params->get( 'user_access', '' );

        if( $parm->css ) {
        	$parm->css = 'cqi';
        	$doc =& JFactory::getDocument();
			$doc->addStyleSheet( $live_site . '/administrator/modules/mod_customquickicons/cqi.css' );
        }else{
			$parm->css = 'icon';
        }

        foreach( $rows as $row ) {
        	if( !$parm->isAdmin || !$parm->uAccess ) {
	        	if( $row->access ) {
	        		if( $row->access != (int) $user->id ) {
	        			continue;
	        		}
	        	}elseif( $row->gid ) {
	        		if( $row->gid != (int) $user->gid ) {
	        			continue;
	        		}
	        	}
        	}

        	$parm->style = '';
        	if( $parm->uAccess ) {
		        if( $parm->isAdmin && $row->access ) {
			    	$parm->style = ' background-color: #FFEFEF;';
			    }
	        }
        	$parm->nWindow	= $row->new_window ? ' target="_blank"' : '';

	        $parm->title 	= ( $row->akey ? $row->title . ' [ ' . ( $isMoz ? JTEXT::_( 'Accesskey SHIFT' ) : JTEXT::_( 'Accesskey' ) )
	        				. ' + ' . $row->akey . ' ]' : ( $row->title ? $row->title : $row->text ) );
	        $parm->icon		= '<img src="' . $live_site . $row->icon . '" alt="' . $parm->title . '" border="0" />';
		    $parm->accKey	= $row->akey ? ' accesskey="' . $row->akey . '"' : '';
		    $parm->text		= '<span>' . $row->prefix . $row->text . $row->postfix . '</span>';
		    $parm->link		= '<a href="' . htmlentities( $row->target ) . '" title="' . $parm->title . '"'
		    				. $parm->accKey . $parm->nWindow
		    				. '>';

		    /* constructing the output
             * 0    icon & text
             * 1    text only
             * 2    icon only
             */
		    switch( $row->display ) {
		    	case '1':
		    		$parm->link .= $parm->text;
		    		break;

		    	case '2':
		    		$parm->link .= $parm->icon;
		    		break;

		    	default:
		    		$parm->link .= $parm->icon . $parm->text;
		    		break;
		    }

            $parm->link .= '</a>';

            $callMenu = true;
            if( $row->cm_check ) {
                if( !file_exists( JPATH_ADMINISTRATOR .DS. 'components' .DS. $row->cm_path ) ) {
                    $callMenu = false;
                }
            }

            if( $callMenu ) {
                MOD_quickiconButton( $row, $parm );
            }
        } ?>
    </div>
    <?php
    unset( $parm );
}
?>