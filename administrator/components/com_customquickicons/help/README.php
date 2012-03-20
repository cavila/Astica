<?php
/**
* @version $Id: readme_de.php,v 1.3 2008/09/24 09:24:24 mic $
* @version 2.1.0
* @package Custom QuickIcons
* @copyright (C) 2006/07/08 mic [ http://www.joomx.com ]
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$QI_VERSION = CustomQuickIcons::_QI_version(); ?>

<div style="text-align:left;">
	<div style="text-align:left; width:50%; float:left;">
		<ul>
			<li><?php echo JTEXT::_( 'RM_VERSION' ) . ' ' . $QI_VERSION['version'] . '&nbsp;-&nbsp;' . $QI_VERSION['date']; ?></li>
			<li><?php echo JTEXT::_( 'RM_BY' ); ?> <a href="http://www.joomx.com" title="www.joomx.com - Professional Joomla!-Solutions and more ..." target="_blank">www.JoomX.com</a></li>
			<li><?php echo JTEXT::_( 'RM_COPYR' ); ?> (C) 2006 - <?php echo date( 'Y'); ?> by mic</li>
			<li><?php echo JTEXT::_( 'RM_LICENSE' ); ?></li>
			<li><?php echo JTEXT::_( 'RM_BASED' ); ?> Halil K&ouml;kl&uuml;</li>
			<li><a href="http://www.joomaax.com" target="_blank" title="Tutorials">Tutorials</a></li>
		</ul>
	</div>
	<div style="text-align:left; width:50%; float:left;">
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
	<div style="clear:both;"><hr /></div>

	<div style="background-color:#eff9ff; margin:3px; padding:3px; border-top: 2px solid #7FEAFF; border-bottom: 2px solid #7FEAFF;">
		<div style="margin-left:10px;">
			<?php echo sprintf( JTEXT::_( 'SUPP1' ), $lists['result'], $lists['reshalf'] ); ?>
		</div>
		<div style="text-align:center; vertical-align:middle;">
			<?php echo $supportlink; ?>
		</div>
	</div>
	<div style="clear:both;"><hr /></div>
	<div>
		<?php echo JTEXT::_( 'INST_TXT1' ); ?>
	</div>
	<div style="clear:both;"></div>

	<div class="jx_tip">
		<?php echo JTEXT::_( 'Rate this extension' ); ?> <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,463/Itemid,35/" target="_blank">Joomla! Extensions Directory.</a>
	</div>
	<div style="clear:both;"></div>

	<?php
	if( !file_exists( JPATH_ADMINISTRATOR .DS. 'modules' .DS. 'mod_customquickicons' .DS. 'mod_customquickicons.php' ) ) { ?>
	    <div class="jx_warning"><span class="jx_warningHeader"><?php echo JTEXT::_( 'RM_NO_MOD' ); ?></div>
	    <?php
	}else{ ?>
		<div style="clear:both;"><hr /></div>
		<?php
	} ?>
	<div class="jx_warning"><?php echo JTEXT::_( 'RM_DELETE' ); ?></div>
	<div style="clear:both;"><hr /></div>
	<div>
		<?php echo JTEXT::_( 'RM_TRANS_BY' ); ?>:
		<ul>
			<li>Englisch / English - Brian Teeman</li>
			<li><?php echo JTEXT::_( 'RM_TRANS_HU' ); ?>: Joszef Tamas Herczeg <a href="http://www.joomlandia.eu" target="_blank">Joomlandia.eu</a></li>
			<li>Russisch / Russian - Dmitriy Malyhin <a href="http://journal.malyhin.info" target="_blank">Malyhin</a></li>
			<li>Spanisch / Spanish - Enrique Becerra <a href="http://www.itexa.com.ar" target="_blank">Itexa</a></li>
			<li>Schwedisch / Swedish - Anders Carlen <a href="http://www.carlencommunications.se" target="_blank">Carlen Communications</a></li>
		</ul>
		<?php
		$link = '<a href="http://joomlacode.org/gf/project/joomx/" title="'
		. JTEXT::_( 'INST_ALT_FORUM' ) . '" target="_blank">'
		. JTEXT::_( 'INST_ALT_FORUM' ) . '</a>';
		echo sprintf( JTEXT::_( 'RM_NEW_TRANS' ), $link ); ?>
	</div>
	<div style="clear:both;"><hr /></div>
	<div>
		Weitere Hilfe / Additional help in bringing CQI forward to Joomla 1.5.x
		<ul>
			<li>Kate Kleinschafer <a href="http://www.getrheel.co.nz" target="_blank">GetRheel</a></li>
			<li>Wes Odom</li>
			<li>Brian Teeman</li>
		</ul>
	</div>
</div>
<div style="clear:both;"><hr /></div>
<div style="text-align:center; background-color:#eff9ff; margin:3px; padding:3px; border-top: 2px solid #7FEAFF; border-bottom: 2px solid #7FEAFF;">
    <?php
	$QI_VERSION = CustomQuickIcons::_QI_version(); ?>
	<div style="clear:both"></div>
	<div style="text-align:center; color:#666666; font-size:9px; margin-top:5px;">
		CQI Version:&nbsp;<?php echo $QI_VERSION['version'] . '&nbsp;-&nbsp;' . $QI_VERSION['date']; ?>
		&nbsp;|&nbsp;
		Copyright&nbsp;&copy;&nbsp;<?php echo date( 'Y' ); ?>&nbsp;-&nbsp;CQI powered by <a href="http://www.joomaax.com" target="_blank" title="jooMaax">jooMaax.com</a>
		&nbsp;|&nbsp;
        <a href="http://joomlacode.org/gf/project/joomx/" title="Project Website" target="_blank">Project Website</a>
	</div>
</div>