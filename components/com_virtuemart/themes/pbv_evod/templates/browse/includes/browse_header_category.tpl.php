<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
mm_showMyFileName(__FILE__);

$modBox = $this->get_cfg('shopIndexColor');
if ($modBox == 1) {
	echo "<h3 class=\"vmCatBrowse\">".$browsepage_lbl;
	if( $this->get_cfg( 'showFeedIcon', 1 ) && (VM_FEED_ENABLED == 1) ) { ?>
		<a href="index.php?option=<?php echo VM_COMPONENT_NAME ?>&amp;page=shop.feed&amp;category_id=<?php echo $category_id ?>" title="<?php echo $VM_LANG->_('VM_FEED_SUBSCRIBE_TOCATEGORY_TITLE') ?>">
		<img src="<?php echo VM_THEMEURL ?>images/feed-icon-14x14.png" align="middle" height="14" width="14" alt="Category RSS Feed" border="0"/></a>
		<?php 
	}
	echo '</h3><div class="vmNavList">';
} else if ($modBox == 6) {
	echo '<div class="browse_top">';
	echo '<div class="browse_top-left"></div>';
	echo '<div class="browse_top-right"></div>';
	echo '<div class="browse_top-center"><h1 class="browse_header">'.$browsepage_lbl;
	if( $this->get_cfg( 'showFeedIcon', 1 ) && (VM_FEED_ENABLED == 1) ) { ?>
		<a href="index.php?option=<?php echo VM_COMPONENT_NAME ?>&amp;page=shop.feed&amp;category_id=<?php echo $category_id ?>" title="<?php echo $VM_LANG->_('VM_FEED_SUBSCRIBE_TOCATEGORY_TITLE') ?>">
		<img src="<?php echo VM_THEMEURL ?>images/feed-icon-14x14.png" align="middle" height="14" width="14" alt="Category RSS Feed" border="0"/></a>
		<?php 
	}	
	echo '</h1></div></div>';
} else {
	echo '<link rel="stylesheet" href="'.VM_THEMEURL.'css/pbv-mod_box.css" type="text/css" />';
	echo '<div class="moduletable_mod_box-'.$modBox.'">';
	echo "<h3>".$browsepage_lbl;
	if( $this->get_cfg( 'showFeedIcon', 1 ) && (VM_FEED_ENABLED == 1) ) { ?>
		<a href="index.php?option=<?php echo VM_COMPONENT_NAME ?>&amp;page=shop.feed&amp;category_id=<?php echo $category_id ?>" title="<?php echo $VM_LANG->_('VM_FEED_SUBSCRIBE_TOCATEGORY_TITLE') ?>">
		<img src="<?php echo VM_THEMEURL ?>images/feed-icon-14x14.png" align="middle" height="14" width="14" alt="Category RSS Feed" border="0"/></a>
		<?php 
	}	echo '</h3>';
}
if ($modBox == 6 && ($navigation_childlist != NULL || $desc != NULL) ) {
	echo '<div class="browse_cat_container"><div class="browse_content">';
	echo $navigation_childlist.'<br style="clear:both;">'.$desc;
	echo '</div></div>';
} else {
echo $navigation_childlist;
}
if( trim(str_replace( "<br />", "" , $desc)) != ""  && $modBox != 6) { ?>

	<div style="width:100%;float:left;">
		<?php echo $desc; ?>
	</div>
	<br class="clr" /><br />
	<?php
 }
if ($modBox != 6) {
	echo '</div>';
	}
 
 ?>
