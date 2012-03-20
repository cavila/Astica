<?php
/**
* @version $Id: admin.customquickicons.html.php,v 1.9 2008/09/25 19:55:55 mic $
* @version 2.1.0
* @package Custom QuickIcons
* @copyright (C) 2006/07/08 mic [ http://www.joomx.com ]
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.html.pane');

/**
 * @package Custom QuickIcons
 */
class HTML_QuickIcons
{
	function show( &$rows, $option, $search, &$pageNav, $error ) {

		JHTML::_('behavior.tooltip');
		JToolBarHelper::title( JText::_( 'QUICKICONS' ) . ' :: ' . JTEXT::_( 'HDR_MGMNT' ) );
		$path = JPATH_ADMINISTRATOR .DS. 'modules' .DS. 'mod_customquickicons' .DS. 'mod_customquickicons.php';
        if( !file_exists( $path ) || $error ) { ?>
        	<table width="95%" style="text-align:center; color:red; font-weight:bold; font-size:14px; background-color:#FFDDDD; border:1px solid #999999; margin:2px;">
        		<tr><td><?php echo JTEXT::_( 'ERR_NO_MOD_INSTALLED' ); ?></td></tr>
        	</table>
        	<?php
        }else{ ?>
			<form action="index2.php" method="post" name="adminForm">
			<table class="adminheading">
	            <tr>
	                <th>
	                    <?php
	                    if( !defined( '_JEXEC' ) ) {
	                    	echo JTEXT::_( 'QUICKICONS' ) . ' :: ' . JTEXT::_( 'HDR_MGMNT' );
	                    } ?>
	                </th>
	                <td style="width:100%; text-align:right;"><?php echo JTEXT::_( 'SEARCH' ); ?>:</td>
	                <td>
	                    <input type="text" name="search" size="30" value="<?php echo $search;?>" class="inputbox" onChange="document.adminForm.submit();" />
	                </td>
	            </tr>
			</table>
			<table class="adminlist">
				<tr>
				    <th width="20">#</th>
	                <th width="20" class="title">
	                    <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
	                </th>
	                <th width="43%" class="title"><?php echo JTEXT::_( 'NAME' ); ?></th>
	                <th nowrap="nowrap"><?php echo JTEXT::_( 'DISPLAY' ); ?></th>
	                <th width="7%" nowrap="nowrap">
	                	<?php echo JTEXT::_( 'CMN_ACCESS' ); ?>
	                	<?php
	                    $tip = JTEXT::_( 'CMN_ACCESS_TIP' );
	                    //echo JHTML::_('tooltip', $tip );
	                    echo JHTML::tooltip( $tip, '', 'tip.png' ); ?>
	                	</th>
	                <th width="7%" nowrap="nowrap"><?php echo JTEXT::_( 'PUBLISHED' ); ?></th>
	                <th width="7%" colspan="2" nowrap="nowrap"><?php echo JTEXT::_( 'REORDER' ); ?></th>
	                <th width="2%"><?php echo JTEXT::_( 'ORDER' ); ?></th>
	                <th width="1%">
	                    <a href="javascript:saveorder(<?php echo count( $rows ) - 1; ?>)" title="<?php echo JTEXT::_( 'SAVE_ORDER' ); ?>"><img src="images/filesave.png" border="0" width="16" height="16" alt="<?php echo JTEXT::_( 'SAVE_ORDER' ); ?>" /></a>
	                </th>
	                <th>
	                    <?php
	                    $tip = JTEXT::_( 'TIP_ACCESSKEY' );
	                    //echo JHTML::_('tooltip', $tip );
	                    echo JHTML::tooltip( $tip, '', 'tip.png' ); ?>
	                </th>
	                <th width="43%" class="title"><?php echo JTEXT::_( 'TARGET' ); ?></th>
	            </tr>
	            <?php
	            $k = 0;
	            $n = count( $rows );

	            for( $i =0; $i < $n; $i++ ) {
	                $row 		= &$rows[$i];
	                $editLink   = 'index.php?option=com_customquickicons&amp;task=edit&amp;hidemainmenu=1&amp;id='. $row->id;
	                $img    	= $row->published ? 'tick.png' : 'publish_x.png';
	                $task   	= $row->published ? 'unpublish' : 'publish';
	                $alt    	= $row->published ? JTEXT::_( 'UNPUBLISH' ) : JTEXT::_( 'PUBLISH' );

	                $row->editor = '';
	                $checked = JHTML::_( 'grid.checkedout', $row, $i );

	                // check display
	                $display = '';
	                switch( $row->display ) {
	                	case '1':
	                		$display = JTEXT::_( 'DISPLAY_TEXT' );
	                		break;

	                	case '2':
	                		$display = '<span style="color:red;">' . JTEXT::_( 'DISPLAY_ICON' ) . '</span>';
	                		break;

	                	default:
	                		$display = '<span style="color:green;">' . JTEXT::_( 'DISPLAY_ICON_TEXT' ) . '</span>';
	                		break;
	                } ?>
	                <tr class="row<?php echo $k; ?>">
	                    <td><?php echo $row->id; ?></td>
	                    <td><?php echo $checked; ?></td>
	                    <td>
	                    	<span class="editlinktip hasTip" title="<?php echo JTEXT::_( 'TIT_EDIT_ENTRY' );?>::<?php echo $row->title; ?>">
	                        	<a href="<?php echo $editLink; ?>"><?php echo $row->text; ?></a>
	                        </span>
	                    </td>
	                    <td><?php echo $display; ?></td>
	                    <td align="left">
	                    	<?php
	                    	if( $row->access ) {
	                    		echo '<span style="color:#FF0000" title="' . $row->uname . '">'
	                    		. ( ( strlen( $row->uname ) > 15 ) ? substr( $row->uname, 0, 12 ) . ' ..' : $row->uname )
	                    		. '</span>';
	                    	}else{
	                    		echo $row->groupname;
	                    	} ?>
	                    </td>
	                    <td align="center">
	                        <a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')" title="<?php echo $alt; ?>">
	                            <img src="images/<?php echo $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
	                        </a>
	                    </td>
	                    <td align="center">
	                    	<?php echo $pageNav->orderUpIcon( $i, true, 'orderUp', 'ORDER_UP', true ); ?>
	                    </td>
	                    <td align="center">
	                    	<?php echo $pageNav->orderDownIcon( $i, $n, true, 'orderDown', 'ORDER_DOWN', true ); ?>
	                    </td>
	                    <td align="center" colspan="2">
	                    	<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
	                    </td>
	                    <td align="center">
	                    	<?php
	                    	echo $row->akey ? $row->akey : '<span style="color:red; font-weight:bold;">!</span>'; ?>
	                    </td>
	                    <td>
	                    	<?php
	                    	if( $row->target == 'index2.php?option=' || $row->target == 'index.php?option=' || !$row->target ){
	                    		echo '<span style="color:red; font-weight:bold;">' . JTEXT::_( 'ERR_NO_TARGET' ) . '</span>';
	                    	}else{
	                    		echo htmlentities( $row->target );
	                    	} ?>
	                    </td>
	                </tr>
	            	<?php
	                $k = 1 - $k;
	            } ?>
				<tr><th colspan="12"><?php echo $pageNav->getListFooter(); ?></th></tr>
	            </table>
	            <input type="hidden" name="option" value="<?php echo $option; ?>" />
	            <input type="hidden" name="task" value="" />
	            <input type="hidden" name="boxchecked" value="0" />
	            <input type="hidden" name="hidemainmenu" value="0" />
			</form>
			<?php
        }
		HTML_QuickIcons::_qiFOOTER();
	}

	function edit( &$row, $lists, $option ) {
		global $live_site;

		$path	= 'index.php';

		JFilterOutput::objectHTMLSafe( $row, ENT_QUOTES );
		JHTML::_( 'behavior.tooltip' );
		if( $row->id ) {
			JToolBarHelper::title( JText::_( 'DETAIL_EDIT' ) . ' :: ' .  $row->text );
		}else{
			JToolBarHelper::title( JText::_( 'DETAIL_NEW' ) );
		}
		$pane =& JPane::getInstance( 'tabs' ); ?>
		<script type="text/javascript">
            /* <![CDATA[ */
            function string_replace( string, search, replace ) {
                var new_string = '';
                var i = 0;
                var n = string.length;

                while( i <= n ) {
	                if( string.substring( i, i + search.length ) == search ) {
	                    new_string = new_string + replace;
	                    i = i + search.length;
	                }else{
	                    new_string = new_string + string.substring( i, i + 1 );
	                    i++;
	                }
                }
                return new_string;
            };

            function applyTag( tag, obj ) {
            	var pre		= document.adminForm.prefix;
                var post	= document.adminForm.postfix;
                var preTag	= '<' + tag + '>';
                var postTag = '</' + tag + '>';

                if( !obj.checked ) {
                	if( pre.value ) {
                    	pre.value	= string_replace( pre.value, preTag, '' );
                	}
                	if( post.value ) {
                    	post.value	= string_replace( post.value, postTag, '' );
                	}
                }else{
                    pre.value	= preTag + pre.value;
                    post.value	= post.value + postTag;
                }
            };

            function changeIcon( icon ) {
                if (document.all) {
                    document.all.iconImg.src = icon;
                }else{
                    document.getElementById('iconImg').src = icon;
                }
            };

            function addTarget() {
            	// taken from daniel grothe - thx!
	            var exclude = document.adminForm.target.value.split(',');
                exclude.push( document.adminForm.tar_gets.value );

                //remove duplicates;
                var tmp = new Object();
                for(var i = 0; i < exclude.length; i++) {
                    var id = exclude[i];
                    if( !isNaN(id)) {
                        continue;
                    }

                    tmp[id] = '<?php echo $path; ?>?' + id;
                }
                exclude = new Array();
                for( var k in tmp ) {
                    exclude.push( tmp[k] );
                }

                document.adminForm.target.value = exclude.pop('');
            };

            function chooseIcon() {
            	var width = screen.availWidth - 30;
            	var height = screen.availHeight - 30;
            	var val = document.getElementById('folder').value;
            	window.open( '<?php echo $path; ?>?option=<?php echo $option; ?>&task=chooseIcon&hidemainmenu=1&folder=' + val,'','width=' + width + ',height=' + height + ',location=no,menubar=no,status=no,scrollbars=yes' );
            };
            /* ]]> */
		</script>
		<form action="<?php echo $path; ?>" method="post" name="adminForm">
			<table class="adminheading">
            <tr>
                <th>
                    <?php
                    if( !defined( '_JEXEC' ) ) {
	                    if( $row->id ){
	                        echo JTEXT::_( 'DETAIL_EDIT' ); ?>
	                        &nbsp;[&nbsp;<small><?php echo $row->text; ?></small>&nbsp;]
	                        <?php
	                    }else{
	                        echo JTEXT::_( 'DETAIL_NEW' );
	                    }
                    } ?>
                </th>
            </tr>
            </table>
			<table width="100%" border="0" cellpadding="2" cellspacing="0" class="adminForm">
                <tr>
                    <td>
                    <?php
                	echo $pane->startPane( 'qicons' );
                	
                    echo $pane->startPanel( JTEXT::_( 'TABS_GENERAL' ), 'tab_general' ); ?>
                    <table width="100%" border="0" cellpadding="2" cellspacing="0" class="admintable">
                    	<tr>
                            <td class="key" width="120"><?php echo JTEXT::_( 'TARGET' ); ?></td>
                            <td>
                                <input class="inputbox" type="text" name="target" id="target" size="75" maxlength="255" value="<?php echo ( $row->target ? $row->target : $path . '?option=' ); ?>" />
                                &nbsp;
                                &nbsp;<button onclick="addTarget(); return false;">&larr;</button>&nbsp;
                                &nbsp;<?php echo $lists['targets']; ?>
                                &nbsp;
                                <?php
                                $tip = JTEXT::_( 'TIP_TARGET' );
	                            // echo JHTML::_('tooltip', $tip);
	                            echo JHTML::tooltip( $tip, '', 'tip.png' ); ?>
                            </td>
                        </tr>
                        <tr>
                        	<td class="key"><label for="new_window"><?php echo JTEXT::_( 'DETAIL_NEW_WINDOW' ); ?></label></td>
                        	<td>
                        		<input type="checkbox" name="new_window" value="1" id="new_window"<?php echo $row->new_window ? ' checked="checked"' : ''; ?> />
                        		&nbsp;
                                <?php
                                $tip = JTEXT::_( 'TIP_DETAIL_NEW_WINDOW' );
                                //echo JHTML::_('tooltip', $tip);
                                echo JHTML::tooltip( $tip, '', 'tip.png' ); ?>
                        	</td>
                        </tr>
                        <tr>
                            <td class="key">
                                <?php echo JTEXT::_( 'PUBLISHED' ); ?>
                            </td>
                            <td>
                                <input type="radio" id="published1" name="published" value="1"<?php echo $row->published ? ' checked="checked"' : ''; ?> /><label for="published1"><?php echo JTEXT::_( 'DETAIL_YES' ); ?></label>
                                &nbsp;&nbsp;
                                <input type="radio" id="published2" name="published" value="0"<?php echo $row->published ? '' : ' checked="checked"'; ?> /><label for="published2"><?php echo JTEXT::_( 'DETAIL_NO' ); ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td class="key">
                                <?php echo JTEXT::_( 'DETAIL_ORDER' ); ?>
                            </td>
                            <td>
                                <?php echo $lists['ordering']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="key"><?php echo JTEXT::_( 'CMN_ACCESS' ); ?></td>
                            <td>
                                <?php echo $lists['gid']; ?>
                            </td>
                        </tr>
                        <tr>
                        	<td class="key"><?php echo JTEXT::_( 'DETAIL_USER' ); ?></td>
                            <td>
                                <?php echo $lists['access']; ?>
                                &nbsp;
                                <?php
                                $tip = JTEXT::_( 'DETAIL_USER_TIP' );
                                // echo JHTML::_( 'tooltip', $tip );
                                echo JHTML::tooltip( $tip, '', 'tip.png' ); ?>
                            </td>
                        </tr>
                    </table>
                    <?php
                    echo $pane->endPanel();
                    echo $pane->startPanel( JTEXT::_( 'TABS_TEXT' ), 'tab_text' ); ?>
                    <table width="100%" border="0" cellpadding="2" cellspacing="0" class="admintable">
                        <tr>
                            <td class="key" width="120">
                                <?php echo JTEXT::_( 'DETAIL_PREFIX' ); ?>
                            </td>
                            <td>
                                <input class="inputbox" type="text" name="prefix" id="prefix" size="50" maxlength="100" value="<?php echo $row->prefix; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td class="key"><?php echo JTEXT::_( 'DETAIL_TEXT' ); ?></td>
                            <td>
                                <input class="inputbox" type="text" name="text" id="text" size="50" maxlength="64" value="<?php echo $row->text; ?>" />
                                &nbsp;&nbsp;
                                <input type="checkbox" name="bold" id="bold" onclick="applyTag('b',this)"<?php if ( strpos( ( $row->prefix ), '&lt;b' ) !== false ) echo ' checked="checked"'; ?> />
                                <label for="bold"><strong><?php echo JTEXT::_( 'FONT_BOLD' ); ?></strong></label>
                                <input type="checkbox" name="italic" id="italic" onclick="applyTag('i',this)"<?php if ( strpos( ( $row->prefix ), '&lt;i' ) !== false ) echo ' checked="checked"'; ?> />
                                <label for="italic"><i><?php echo JTEXT::_( 'FONT_ITALIC' ); ?></i></label>
                                <input type="checkbox" name="underlined" id="underlined" onclick="applyTag('u',this)"<?php if ( strpos( ( $row->prefix ), '&lt;u' ) !== false ) echo ' checked="checked"'; ?> />
                                <label for="underlined"><u><?php echo JTEXT::_( 'FONT_UNDERLINE' ); ?></u></label>
                                &nbsp;
                                <?php
                                $tip = JTEXT::_( 'TIP_FONT' );
                                // echo JHTML::_( 'tooltip', $tip );
                                echo JHTML::tooltip( $tip, '', 'tip.png' ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="key"><?php echo JTEXT::_( 'DETAIL_POSTFIX' ); ?></td>
                            <td>
                                <input class="inputbox" type="text" name="postfix" id="postfix" size="50" maxlength="100" value="<?php echo $row->postfix; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td class="key"><?php echo JTEXT::_( 'ACCESSKEY' ); ?></td>
                            <td>
                                <input class="inputbox" type="text" name="akey" size="1" maxlength="1" value="<?php echo $row->akey; ?>" />
                                &nbsp;
                                <?php
                                $tip = JTEXT::_( 'TIP_ACCESSKEY' );
                                // echo JHTML::_( 'tooltip', $tip );
                                echo JHTML::tooltip( $tip, '', 'tip.png' ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="key"><?php echo JTEXT::_( 'TITLE' ); ?></td>
                            <td>
                                <input class="inputbox" type="text" name="title" size="50" maxlength="64" value="<?php echo $row->title; ?>" />
                                &nbsp;
                                <?php
                                $tip = JTEXT::_( 'TIP_TITLE' );
                                // echo JHTML::_( 'tooltip', $tip );
                                echo JHTML::tooltip( $tip, '', 'tip.png' ); ?>
                            </td>
                        </tr>
                    </table>
                    <?php
	                echo $pane->endPanel();
	                echo $pane->startPanel( JTEXT::_( 'TABS_DISPLAY' ), 'tab_display' ); ?>
                    <table width="100%" border="0" cellpadding="2" cellspacing="0" class="admintable">
                        <tr>
                            <td class="key"><?php echo JTEXT::_( 'DISPLAY' ); ?></td>
                            <td><?php echo $lists['display']; ?></td>
                        </tr>
                        <tr>
                        	<td class="key"><?php echo JTEXT::_( 'IMAGE_FOLDERS' ); ?></td>
                        	<td><?php echo $lists['folder']; ?></td>
                        </tr>
                        <tr>
                            <td class="key"><?php echo JTEXT::_( 'DETAIL_ICON' ); ?></td>
                            <td>
                                <input class="inputbox" type="text" name="icon" size="120" maxlength="255" value="<?php echo $live_site . $row->icon; ?>" onblur="changeIcon(this.value)" />
                                &nbsp;&nbsp;
                                <a href="javascript:void(0);" target="_blank" title="<?php echo JTEXT::_( 'TIT_CHOOSE_ICON' ); ?>" onclick="chooseIcon(); return false;"><strong><?php echo JTEXT::_( 'DETAIL_CHOOSE_ICON' ); ?></strong></a>
                                &nbsp;
                                <?php
                                $tip = JTEXT::_( 'TIP_ICON' );
	                            // echo JHTML::_('tooltip', $tip);
	                            echo JHTML::tooltip( $tip, '', 'tip.png' ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td style="padding-top:10px">
                                <?php
                                if( empty( $row->icon )){
                                    $iconLink = 'blank.png';
                                }else{
                                    $iconLink = $row->icon;
                                } ?>
                                <img id="iconImg" src="<?php echo $live_site . $iconLink; ?>" alt="" />
                            </td>
                        </tr>
                    </table>
                    <?php
	                echo $pane->endPanel();
	                echo $pane->startPanel( JTEXT::_( 'TABS_CHECK' ), 'tab_check' ); ?>
                    <table width="100%" border="0" cellpadding="2" cellspacing="0" class="admintable">
                        <tr>
                            <td class="key" width="120">
                            	<label for="new_window"><?php echo JTEXT::_( 'CMT_CHECK' ); ?></label>
                            </td>
                            <td>
                            	<input type="checkbox" name="cm_check" value="1" id="cm_check"<?php echo $row->cm_check ? ' checked="checked"' : ''; ?>/>
                            	&nbsp;
                                <?php
                                $tip = JTEXT::_( 'TIP_CMT_CHECK' );
	                            // echo JHTML::_('tooltip', $tip);
	                            echo JHTML::tooltip( $tip, '', 'tip.png' ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="key">&nbsp;</td>
                            <td><?php echo JTEXT::_( 'CMT_NAME_TO_CHECK' ); ?></td>
                        </tr>
                        <tr>
                            <td class="key">
                            	../administrator/components/
                            </td>
                            <td>
                            	<input class="inputbox" type="text" name="cm_path" size="75" maxlength="255" value="<?php echo ( $row->cm_path ? $row->cm_path : '' ); ?>" />
                            	&nbsp;
                                <?php
                                $tip = JTEXT::_( 'TIP_CM_PATH' );
                                if( defined( '_JEXEC' ) ) {
	                                // echo JHTML::_('tooltip', $tip);
	                                echo JHTML::tooltip( $tip, '', 'tip.png' );
                                }else{
                                	echo mosToolTip( $tip );
                                } ?>
                                <br />
                                <?php echo $lists['components_check']; ?>
                                &nbsp;
                                <?php
                                $tip = JTEXT::_( 'TIP_CM_PATH_CHECK' );
	                            // echo JHTML::_('tooltip', $tip);
	                            echo JHTML::tooltip( $tip, '', 'tip.png' ); ?>
                            </td>
                        </tr>
                    </table>
                    <?php
	                echo $pane->endPanel();
					echo $pane->startPanel( JTEXT::_( 'TABS_ABOUT' ), 'tab_about' ); ?>
		            <table width="100%" border="0" cellpadding="2" cellspacing="0" class="admintable">
		            	<tr>
		            		<td colspan="2">
		            		<?php
		            		$supportlink =
		            		'<a target="popup" href="'
				            . $path . '?option=com_customquickicons&amp;task=about&amp;no_html=1"'
				            . ' onclick="window.open(\'\',\'popup\''
				            . ',\'resizable=yes,status=no,toolbar=no,location=no,scrollbars=yes,width=650,height=450\')"'
				            . ' title="' . JTEXT::_( 'SUPP_HEAD_TITLE' ) . '" style="text-decoration:none;">'
				            . '<img src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" alt="" height="26" width="92" />'
				            . '&nbsp;'
				            . '<img src="http://www.moneybookers.com/images/banners/flags.gif" alt="" border="0" height="31" width="88" />'
				            . '</a>';
				            echo '<h1 class="jx_h1">' . JTEXT::_( 'QUICKICONS' ) . '</h1>';
						    include_once( JPATH_ADMINISTRATOR
						    .DS. 'components' .DS. 'com_customquickicons'.DS. 'help' .DS. 'README.php' ); ?>
		            		</td>
		            	</tr>
		            </table>
		            <?php
		            echo $pane->endPanel();
	                echo $pane->endPane(); ?>
                </td>
            </tr>
        </table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
		<?php
		HTML_QuickIcons::_qiFOOTER();
	}

	function editCSS( $cssVars ) {
		global $option;

		JToolBarHelper::title( JText::_( 'Edit CSS' ) ); ?>
		<form action="index.php" method="post" name="adminForm" class="adminForm" id="adminForm">
			<div class="adminForm" style="width:100%; padding:2px; margin:3px;">
				<div>
					<?php echo JTEXT::_( 'File' ); ?>:&nbsp;
					<?php
					echo $cssVars['file'];
					if( isset( $cssVars['msg'] ) ) {
						echo '<span style="color:red; margin-left:20px;">' . $cssVars['msg'] . '</span>';
					} ?>
				</div>
	    		<div id="cssform">
	    			<textarea cols="100" rows="20" name="content" id="content"><?php echo $cssVars['content']; ?></textarea>
	    		</div>
    		</div>
    		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		    <input type="hidden" name="task" value="saveCSS" />
		</form>
    	<?php
    	HTML_QuickIcons::_qiFOOTER();
	}

	function quickiconButton( $image ) {
		global $live_site;

		$image	= $live_site . $image;
		$js_action = "window.opener.document.adminForm.icon.value='$image'; window.opener.changeIcon('$image');window.close()";
		?>
		<div style="float:left;">
			<div class="icon">
				<a href="javascript:void(0);" onclick="<?php echo $js_action; ?>;">
					<span>
						<img src="<?php echo $image; ?>" alt="<?php echo $image; ?>" title="<?php echo $image; ?>" border="0" />
					</span>
				</a>
			</div>
		</div>
		<?php
	}

	function chooseIcon( $imgs, $option, $icons ) {

		JToolBarHelper::title( JText::_( 'DETAIL_CHOOSE_ICON' ) ); ?>
		<div class="adminform">
			<div>
				<div style="background-color:#FFFEEF; margin:3px; padding:3px; border-top: 1px solid #FEFF9F; border-bottom: 1px solid #FEFF9F;">
					<div style="float:left; text-align:left; margin:3px;">
						<?php echo JTEXT::_( 'MSG_CHOOSE_ICON' ) . ' [ # ' . $icons . ']'; ?>
					</div>
					<div style="float:right; text-align:right; margin:3px;">
						<a href="#" onclick="window.close();"><?php echo JTEXT::_( 'CLOSE_WINDOW' ); ?></a>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div style="padding:4px;">
			<div id="cpanel">
			    <?php
			    $n = count( $imgs );
                for( $i = 0; $i < $n; $i++ ){
                    HTML_QuickIcons::quickiconButton( $imgs[$i] );
                } ?>
			</div>
		</div>
		<div style="clear:both;"></div>
		<?php
		HTML_QuickIcons::_qiFOOTER();
	}

	function _qiFOOTER() {
		$QI_VERSION = CustomQuickIcons::_QI_version(); ?>
		<div style="clear:both"></div>
		<div style="text-align:center; color:#666666; font-size:9px; margin-top:5px;">
			CQI Version:&nbsp;<?php echo $QI_VERSION['version'] . '&nbsp;-&nbsp;' . $QI_VERSION['date']; ?>
			&nbsp;|&nbsp;
			Copyright&nbsp;&copy;&nbsp;<?php echo date( 'Y' ); ?>&nbsp;-&nbsp;CQI powered by <a href="http://www.joomaax.com" target="_blank" title="jooMaax">jooMaax.com</a>
			&nbsp;|&nbsp;
            <a href="http://joomlacode.org/gf/project/joomx/" title="Project Website" target="_blank">Project Website</a>
		</div>
		<?php
	}

	function _support() {
		global $live_site; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo JTEXT::_( 'LNG' ); ?>" xml:lang="<?php echo JTEXT::_( 'LNG' ); ?>">
	<head>
		<title><?php echo JTEXT::_( 'SUPP_HEAD_TITLE' ); ?></title>
	    <link href="<?php echo $live_site; ?>/administrator/components/com_customquickicons/help/help.css"
	          rel="stylesheet"
	          type="text/css"
	          media="all" />
	    <meta name="copyright"
	          content="(C) 2006/07/08 www.joomx.com All rights reserved." />
	    <meta name="support"
	          content="http://www.joomx.com Support" />
	    <meta http-equiv="Content-Type"
	          content="text/html; charset=UTF-8" />
	</head>
	<body>
		<div id="jxbody">
		<div style="text-align:left; margin:20px; padding:20px; background-color:#F3F9FF; border:1px solid #006699;">
			<div>
				<?php echo JTEXT::_( 'SUPP2' ); ?>
			</div>
			<div style="margin:20px; border-top:1px dotted #006699;"></div>
			<div style="text-align:center;">
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
		            <input type="hidden" name="cmd" value="_s-xclick" />
					<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" name="submit" alt="<?php echo JTEXT::_( 'SUPP_BTN_TITLE' ); ?>" title="<?php echo JTEXT::_( 'SUPP_BTN_TITLE' ); ?>" />
					<img alt="" border="0" src="https://www.paypal.com/<?php echo JTEXT::_( 'BTN_LNG' ); ?>/i/scr/pixel.gif" width="1" height="1" />
					<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----" />
				</form>
				<div style="margin:20px; border-top:1px dotted #006699;"></div>
				<a href="https://www.moneybookers.com/app/?rid=3150988" target="_blank" title="MoneyBookers"><img src="http://www.moneybookers.com/images/banners/flags.gif" alt="MoneyBookers" border="0" height="31" width="88" /></a>
				<br />
				<?php echo JTEXT::_( 'SUPP_TXT_PAY_W_MB' ); ?>
				<br />
				<form action="https://www.moneybookers.com/app/payment.pl" method="post" target="_blank">
					<input name="pay_to_email" value="info@joomx.com" type="hidden" />
					<input name="status_url" value="info@joomx.com" type="hidden" />
					<input name="language" value="de" type="hidden" />
					<input name="currency" value="EUR" type="hidden" />
					<input name="detail1_description" value="<?php echo JTEXT::_( 'SUPP_INP_TXT' ); ?>" type="hidden" />
					<input name="detail1_text" value="<?php echo JTEXT::_( 'SUPP_INP_TXT' ); ?>" type="hidden" />
					<input name="amount" class="inputbox" size="6" value="10" type="text" /> EUR
					<br />
					<input value="<?php echo JTEXT::_( 'SUPP_BTN_SUBMIT' ); ?>" type="submit" />
				</form>
			</div>
		</div>
		</div>
	</body>
</html>
	<?php
	}
}
?>