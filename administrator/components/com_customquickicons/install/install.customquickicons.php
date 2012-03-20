<?php
/**
* @version $Id: install.customquickicons.php,v 1.9 2008/09/25 11:48:48 mic $
* @version 2.1.0
* @package Custom QuickIcons
* @copyright (C) 2006/7/8 mic [ http://www.joomx.com ]
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* this installer is based upon a script by mic [ www.mgfi.info ] and should not be used anywhere
* without express permission from the author!
*/

defined('_JEXEC') or die('Restricted access');

// load the component language file
$language =& JFactory::getLanguage();
$language->load( 'com_customquickicons' );

$database	=& JFactory::getDBO();

$queri		= array();
$errors 	= array();
$msg		= array();
$dataSum	= '';

// backup old table if existing
$query = 'SELECT count(id)'
. ' FROM #__custom_quickicons'
;
$database->setQuery( $query );
$total = $database->loadResult();

$cqiOLD = '';
if( $total ) {
	$cqiOLD = date( 'YmdHi' );
	$query = 'RENAME TABLE #__custom_quickicons'
	. ' TO #__custom_quickicons_bu_' . $cqiOLD
	;
	$database->setQuery( $query );
    if( !$database->query() ) {
        $errors[] = array( $database->getErrorMsg(), $query );
    }else{
        $dataSum++;
        $msg[] = JTEXT::_( 'INST_MSG_BU_OLD_TABLE' );
    }
}

// create table
$query = 'CREATE TABLE IF NOT EXISTS `#__custom_quickicons` ('
. ' `id` int(11) NOT NULL auto_increment,'
. ' `text` varchar(64) NOT NULL default \'\','
. ' `target` varchar(255) NOT NULL default \'\','
. ' `icon` varchar(255) NOT NULL default \'\','
. ' `ordering` int(10) unsigned NOT NULL default \'0\','
. ' `new_window` tinyint(1) NOT NULL default \'0\','
. ' `prefix` varchar(100) NOT NULL default \'\','
. ' `postfix` varchar(100) NOT NULL default \'\','
. ' `published` tinyint(1) unsigned NOT NULL default \'0\','
. ' `title` varchar(64) NOT NULL default \'\','
. ' `cm_check` tinyint(1) NOT NULL default \'0\','
. ' `cm_path` varchar(255) NOT NULL default \'\','
. ' `akey` varchar(1) NOT NULL default \'\','
. ' `display` tinyint(1) NOT NULL default \'0\','
. ' `access` int(11) unsigned NOT NULL default \'0\','
. ' `gid` int(3) default \'25\','
. ' `checked_out` int(11) NOT NULL default \'0\','
. ' `checked_out_time` datetime NOT NULL default \'0000-00-00 00:00:00\','
. ' PRIMARY KEY (`id`)'
. ') TYPE=MyISAM;'
;
$database->setQuery( $query );
if( !$database->query() ) {
    $errors[] = array( $database->getErrorMsg(), $query );
}else{
    $dataSum++;
    $msg[] = JTEXT::_( 'INST_MSG_NEW_TABLE' );
}

if( !$errors ) {
    // now submit db.entries w lang.vars
    $cqi	= array();
	$index	= 'index.php?option=com_';
	$image	= '/administrator/templates/khepri/images/header/icon-48-';
	$cqi[] = array(
    	'text'	=> 'Joomla Website',
    	'link'	=> 'http://joomla.org',
    	'img'	=> '/administrator/components/com_customquickicons/images/browser.png',
    	'order'	=> 1,
    	'nwind'	=> 1,
    	'pre'	=> '<i><b style="color:green">',
    	'pos'	=> '</b></i>',
    	'acc'	=> '62',
    	'alt'	=> 'Joomla Website',
    	'akey'	=> ''
    );
    $cqi[] = array(
    	'text'	=> JTEXT::_( 'INST_NEW_ARTICLE' ),
    	'link'	=> $index . 'content&sectionid=0&task=new',
    	'img'	=> $image . 'article-add.png',
    	'order'	=> 2,
    	'nwind'	=> 0,
    	'pre'	=> '',
    	'pos'	=> '',
    	'acc'	=> '',
    	'alt'	=> JTEXT::_( 'INST_NEW_ARTICLE_ALT' ),
    	'akey'	=> 'N'
    );
    $cqi[] = array(
    	'text'	=> JTEXT::_( 'INST_SECTIONS' ),
    	'link'	=> $index . 'sections&scope=content',
    	'img'	=> $image . 'section.png',
    	'order'	=> 4,
    	'nwind'	=> 0,
    	'pre'	=> '',
    	'pos'	=> '',
    	'acc'	=> '',
    	'alt'	=> JTEXT::_( 'INST_SECTIONS_ALT' ),
    	'akey'	=> 'B'
    );
    $cqi[] = array(
    	'text'	=> JTEXT::_( 'INST_FRONTPAGE' ),
    	'link'	=> $index . 'frontpage',
    	'img'	=> $image . 'frontpage.png',
    	'order'	=> 5,
    	'nwind'	=> 0,
    	'pre'	=> '',
    	'pos'	=> '',
    	'acc'	=> '',
    	'alt'	=> JTEXT::_( 'INST_FRONTPAGE_ALT' ),
    	'akey'	=> 'F'
    );
    $cqi[] = array(
    	'text'	=> JTEXT::_( 'INST_ARTICLE' ),
    	'link'	=> $index . 'content',
    	'img'	=> $image . 'article.png',
    	'order'	=> 3,
    	'nwind'	=> 0,
    	'pre'	=> '',
    	'pos'	=> '',
    	'acc'	=> '',
    	'alt'	=> JTEXT::_( 'INST_ARTICLE_ALT' ),
    	'akey'	=> 'A'
    );
    $cqi[] = array(
    	'text'	=> JTEXT::_( 'INST_MEDIA' ),
    	'link'	=> $index . 'media',
    	'img'	=> $image . 'media.png',
    	'order'	=> 8,
    	'nwind'	=> 0,
    	'pre'	=> '',
    	'pos'	=> '',
    	'acc'	=> '',
    	'alt'	=> JTEXT::_( 'INST_MEDIA_ALT' ),
    	'akey'	=> 'M'
    );
    $cqi[] = array(
    	'text'	=> JTEXT::_( 'INST_CATEGORIES' ),
    	'link'	=> $index . 'categories&section=com_content',
    	'img'	=> $image . 'category.png',
    	'order'	=> 6,
    	'nwind'	=> 0,
    	'pre'	=> '',
    	'pos'	=> '',
    	'acc'	=> '',
    	'alt'	=> JTEXT::_( 'INST_CATEGORIES_ALT' ),
    	'akey'	=> 'K'
    );
    $cqi[] = array(
    	'text'	=> JTEXT::_( 'INST_MENUS' ),
    	'link'	=> $index . 'menus',
    	'img'	=> $image . 'menumgr.png',
    	'order'	=> 7,
    	'nwind'	=> 0,
    	'pre'	=> '',
    	'pos'	=> '',
    	'acc'	=> '',
    	'alt'	=> JTEXT::_( 'INST_MENUS' ),
    	'akey'	=> 'R'
    );
    $cqi[] = array(
    	'text'	=> JTEXT::_( 'INST_LANGUAGE' ),
    	'link'	=> $index . 'languages&client=0',
    	'img'	=> $image . 'language.png',
    	'order'	=> 9,
    	'nwind'	=> 0,
    	'pre'	=> '',
    	'pos'	=> '',
    	'acc'	=> '',
    	'alt'	=> JTEXT::_( 'INST_LANGUAGE_ALT' ),
    	'akey'	=> 'L'
    );
    $cqi[] = array(
    	'text'	=> JTEXT::_( 'INST_USER' ),
    	'link'	=> $index . 'users',
    	'img'	=> $image . 'user.png',
    	'order'	=> 10,
    	'nwind'	=> 0,
    	'pre'	=> '',
    	'pos'	=> '',
    	'acc'	=> '',
    	'alt'	=> JTEXT::_( 'INST_USER_ALT' ),
    	'akey'	=> 'U'
    );
    $cqi[] = array(
    	'text'	=> JTEXT::_( 'INST_CONFIG' ),
    	'link'	=> $index . 'config',
    	'img'	=> $image . 'config.png',
    	'order'	=> 11,
    	'nwind'	=> 0,
    	'pre'	=> '',
    	'pos'	=> '',
    	'acc'	=> '',
    	'alt'	=> JTEXT::_( 'INST_CONFIG_ALT' ),
    	'akey'	=> 'C'
    );

    foreach( $cqi as $cq ) {
    	$query = "INSERT INTO #__custom_quickicons VALUES ('', '" . $cq['text'] . "', '" . $cq['link'] . "', '" . $cq['img'] . "', " . $cq['order'] . ", " . $cq['nwind'] . ", '" . $cq['pre'] . "', '" . $cq['pos'] . "', 1, '" . $cq['alt'] . "', '', '', '" . $cq['akey'] . "', '', '" . $cq['acc'] . "', '25', '', '0000-00-00 00:00:00')";
        $database->setQuery( $query );
        if( !$database->query() ) {
            $errors[] = array( $database->getErrorMsg(), $query );
        }else{
            $dataSum++;
        }
    }
}

if( !$errors ) {
    /**
     * copy and install module
     * 1. check if directory exists (normally should)
     * 2. check perms
     * 3. copy
     * 4. register module
     * 5. delete install files/dir
     * 6. set standard module inactive
     */
    $modSuccess = false;
    $installdir	= JPATH_ADMINISTRATOR .DS. 'components' .DS. 'com_customquickicons' .DS. 'modules' .DS;
    $targetdir	= JPATH_ADMINISTRATOR .DS. 'modules' .DS. 'mod_customquickicons' .DS;
    $toCopy		= '';
    $fileCopy	= array(
    	array(
	    	'txt'			=> 'mod_customquickicons.php',
	    	'installFrom'	=> $installdir . 'mod_customquickicons.php',
	    	'installTo'		=> $targetdir . 'mod_customquickicons.php',
	    	'errText'		=> 'INST_ERR_COPY_MOD_FILE',
	    	'succText'		=> 'INST_MSG_MOD_FILE'
	    ),
	    array(
	    	'txt'			=> 'mod_customquickicons.xml',
	    	'installFrom'	=> $installdir . 'mod_customquickicons.xm_',
	    	'installTo'		=> $targetdir . 'mod_customquickicons.xml',
	    	'errText'		=> 'INST_ERR_COPY_MOD_FILE',
	    	'succText'		=> 'INST_MSG_MOD_FILE'
	    ),
	    array(
	    	'txt'			=> 'cqi.css',
	    	'installFrom'	=> $installdir . 'cqi.css',
	    	'installTo'		=> $targetdir . 'cqi.css',
	    	'errText'		=> 'INST_ERR_COPY_MOD_FILE',
	    	'succText'		=> 'INST_MSG_MOD_FILE'
	    )
	);

    if( !JFolder::exists( $targetdir ) ) {
    	//create directory
    	if( !JFolder::create( $targetdir, 0755 ) ) {
    		$errors[] = array( JTEXT::_( 'INST_ERR_TARGET_DIR' ), 'administrator' .DS. 'modules' );
    	}
    }
}

if( !$errors ) {
    // step 3
	foreach( $fileCopy as $fc ) {
		if( !JFile::copy( $fc['installFrom'] , $fc['installTo'] ) ) {
	    	$errors[] = array( JTEXT::_( $fc['errText'] ), $fc['txt'] );
	    }else{
	    	$msg[] = sprintf( JTEXT::_( $fc['succText'] ), $fc['txt'] );
	    	$modSuccess = true;
	    }
	}
}

if( !$errors ) {
	// languages - this is a special case, because copying is not handled through the CMS.installer itself
    $targetdir	= JPATH_ADMINISTRATOR .DS. 'language' .DS;
    $lngSuccess	= false;
    $fileCopy	= array(
	    array(
	    	'txt'			=> 'de-DE.mod_customquickicons.ini',
	    	'installFrom'	=> $installdir . 'de-DE.mod_customquickicons.ini',
	    	'installTo'		=> $targetdir . 'de-DE' .DS. 'de-DE.mod_customquickicons.ini',
	    	'errText'		=> 'Error copy language file',
	    	'succText'		=> 'Copy language file'
	    ),
	    array(
	    	'txt'			=> 'en-GB.mod_customquickicons.ini',
	    	'installFrom'	=> $installdir . 'en-GB.mod_customquickicons.ini',
	    	'installTo'		=> $targetdir . 'en-GB' .DS. 'en-GB.mod_customquickicons.ini',
	    	'errText'		=> 'Error copy language file',
	    	'succText'		=> 'Copy language file'
	    )
	);

	foreach( $fileCopy as $fc ) {
		if( JFile::copy( $fc['installFrom'] , $fc['installTo'] ) ) {
	    	$msg[] = sprintf( JTEXT::_( $fc['succText'] ), $fc['txt'] );
	    	$lngSuccess = true;
	    }
	}
}

if( $modSuccess && $lngSuccess ) {
    // step 4
    // register the module and set active
	$query = "INSERT INTO #__modules VALUES ('', 'CQI - CustomQuickIcons', '', 2, 'icon', 0, '0000-00-00 00:00:00', 1, 'mod_customquickicons', 0, 0, 1, '', 0, 1, '')";
	$database->setQuery( $query );
	if( !$database->query() ){
	    $errors[] = array( $database->getErrorMsg(), $query );
	}else{
		$dataSum++;
		$msg[] = JTEXT::_( 'INST_MSG_MOD_REGGED' );
	}
}else{
	$msg[] = JTEXT::_( 'Module not installed' );
}

if( !$errors ) {
	// disable standard module quick_icon (only if install was successful!)
	if( $modSuccess ) {
		$query = "SELECT id FROM #__modules WHERE module = 'mod_quickicon'";
		$database->setQuery( $query );
		$id = $database->loadResult();

		$query = 'UPDATE #__modules SET `published` = \'0\' WHERE id=' . $id . ' LIMIT 1;';
		$database->setQuery( $query );
		$database->query();
	}

	// copy individual tip.png
	$img 	= JPATH_ADMINISTRATOR .DS. 'components' .DS. 'com_customquickicons' .DS. 'images' .DS. 'tip.png';
	$target = JPATH_SITE .DS. 'includes' .DS. 'js' . DS. 'ThemeOffice' .DS. 'tip.png';
	JFile::copy( $img, $target );
}

// step 5 - delete files and dir install (we do not need it anymore)
$delFiles = JFolder::files( $installdir );
foreach( $delFiles as $delFile ) {
	if( !JFile::delete( $installdir . $delFile ) ) {
		$errors[] = array( JTEXT::_( 'INST_ERR_DEL_FILE' ), $delFile);
	}
}
JFolder::delete( $installdir );

// finally delete unwanted dir at user side
JFolder::delete( JPATH_SITE .DS. 'components' .DS. 'com_customquickicons' ); ?>

<style type="text/css" media="screen">
    <!--
    .table {
        width       : 95%;
        border      : 1px solid #666666;
        text-align  : left;
        font-size   : 0.95em;
        margin		: 5px auto 5px auto;
    }
    .text {
        color       : #666666;
        width       : 700px;
        text-align  : left;
        margin-left : 3px;
    }
    .code {
        width       : 700px;
        white-space : pre;
        margin      : 5px;
        text-align  : left;
        border      : 1px solid #FF0000;
    }
    .bold {
        font-weight : bold;
    }
    .ads {
        white-space : pre;
        border      : 1px solid #7EA9C2; /* 336699 */
        padding     : 10px;
        margin      : auto;
        width       : 750px;
        background  : #F9FDFF;
        text-align  : center;
    }
    .hint {
        background  : #F3F9FF; // FFDDDD;
        border      : 1px solid #006699; // FF0000;
        margin      : 10px;
        padding     : 10px;
    }
    .info {
		margin			: 3px;
		padding			: 3px;
		border-top		: 2px solid #409F3B;
		border-bottom	: 2px solid #409F3B;
		background-color: #F0FFEF;
		font-weight		: bold;
	}
    -->
</style>

<div class="table">
	<div class="text">
        <?php
        if( $errors ){
            echo '<strong style="color:red;">' . JTEXT::_( 'INST_ERROR' ) . '</strong>';
            echo '<ul>';
            foreach( $errors as $error ){
                echo '<li>' . $error[0] . '</li>';
            }
            echo '</ul>';
        }

        echo '<strong style="color:green;">' . JTEXT::_( 'INST_SUCCESS' ) . '</strong>';
        echo ' - ' . $dataSum . ' ' . JTEXT::_( 'INST_DB_ENTRIES' );
        if( $msg ) {
        	echo '<ul>';
            foreach( $msg as $mgs ){
                echo '<li>' . $mgs . '</li>';
            }
            echo '</ul>';
        } ?>
    </div>
    <div class="text">
    	<ul>
    		<li>
    			<a href="http://joomlacode.org/gf/project/joomx/" title="<?php echo JTEXT::_( 'INST_ALT_WEBSITE' ); ?>" target="_blank"><?php echo JTEXT::_( 'INST_ALT_WEBSITE' ); ?></a>
    		</li>
    		<li>
    			<a href="http://joomlacode.org/gf/project/joomx/" title="<?php echo JTEXT::_( 'INST_ALT_ACT_VERSION' ); ?>" target="_blank"><?php echo JTEXT::_( 'INST_ALT_ACT_VERSION' ); ?></a>
    		</li>
    		<li>
    			<a href="http://joomlacode.org/gf/project/joomx/" title="<?php echo JTEXT::_( 'INST_ALT_BUGTRACKER' ); ?>" target="_blank"><?php echo JTEXT::_( 'INST_ALT_BUGTRACKER' ); ?></a>
    		</li>
    		<li>
    			<a href="http://joomlacode.org/gf/project/joomx/" title="<?php echo JTEXT::_( 'INST_ALT_FORUM' ); ?>" target="_blank"><?php echo JTEXT::_( 'INST_ALT_FORUM' ); ?></a>
    		</li>
    		<li>
    			<a href="mailto:info@joomx.com" title="<?php echo JTEXT::_( 'INST_ALT_EMAIL' ); ?>"><?php echo JTEXT::_( 'INST_ALT_EMAIL' ); ?></a>
    		</li>
    	</ul>
    </div>
    <div class="text">
        <?php echo JTEXT::_( 'INST_TXT1' ); ?>
    </div>
    <div style="clear:both;"></div>
    <?php
    if( $cqiOLD ) { ?>
        <div class="info">
        	<?php echo JTEXT::_( 'Convert old table' ); ?>
        	<div style="text-align:center; margin:5px;">
        		<a href="index2.php?option=com_customquickicons&amp;task=convert&amp;table=<?php echo $cqiOLD; ?>" class="button"><?php echo JTEXT::_( 'Take over data' ); ?></a>
        	</div>
        </div>
        <div style="clear:both;"></div>
        <?php
    } ?>
	<div class="hint">
		<?php
    	if( !$errors ) {
    		echo JTEXT::_( 'INST_TXT2' );
    	} ?>
    	&nbsp;&nbsp;
        Another professional tool from <a href="http://www.joomx.com" target="_blank" title="www.joomx.com">JoomX - Joomla Professionals @ Work</a>
	</div>
</div>