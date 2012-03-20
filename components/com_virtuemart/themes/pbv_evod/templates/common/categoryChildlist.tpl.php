<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
mm_showMyFileName(__FILE__);

if(array_key_exists('flypage', $_GET)) {
	$catBrowse = substr($_GET["flypage"],-5,1);
} else {
	$catBrowse = 1;
	}

if (!isset($catBrowse)) {
	$catBrowse = 0;
	}
	
$modBox = $this->get_cfg('shopIndexColor');
$catCount = $this->get_cfg('categoryCount');
$catDesign = $this->get_cfg('categoryDesign');
$catVar = 0;

if( empty( $categories )) {
	return; // Do nothing, if there are no child categories!
}
if ($catBrowse != 3 && $catBrowse != 4 && isset($_GET["flypage"]) && $modBox == 6 ) {
	echo '<div class="browse_top">';
	echo '<div class="browse_top-left"></div>';
	echo '<div class="browse_top-right"></div>';
	echo '<div class="browse_top-center"><h1 class="browse_header">'.$VM_LANG->_('PHPSHOP_MORE_CATEGORIES').'</h1></div></div>';
	echo '<div class="browse_cat_container"><div class="browse_content">';
	$catBrowse = 1;
	}
foreach( $categories as $category ) {
	
	$imagePath = IMAGEPATH.'product/';
	list($details_width, $width) = $this->vmGetImageSize($imagePath, $category["category_thumb_image"]);
	
	if ($catDesign == 0) {
	?>	
	<div class="vmNavListProduct" style="width:<?php echo 100 / $catCount - 3; ?>%">
		<a title="<?php echo $category["category_name"] ?>" href="<?php $sess->purl(URL."index.php?option=com_virtuemart&amp;page=shop.browse&amp;category_id=".$category["category_id"]) ?>"> 
		<?php
		if ( $category["category_thumb_image"] ) {
			echo ps_product::image_tag( $category["category_thumb_image"], "alt=\"".$category["category_name"]."\"", 0, "category");
			echo "</a>";
		}
		?>
		<a class="vmCatProductText" title="<?php echo $category["category_name"] ?>" href="<?php $sess->purl(URL."index.php?option=com_virtuemart&amp;page=shop.browse&amp;category_id=".$category["category_id"]) ?>">
		<?php
		echo $category["category_name"];
		echo $category['number_of_products'];
		?>
		</a>
	</div>	
	<?php } else if($catDesign == 1){ 
		if (! $category["category_thumb_image"] ) { $marginVar = 0; } else {$marginVar = 10; }?>
	<div class="vmNavListProduct2" style="width:<?php echo 100 / $catCount - 3; ?>%;padding-bottom:<?php echo $marginVar; ?>px;">		
		<a class="vmCatProductText2" style="margin-bottom:<?php echo $marginVar; ?>px;"; title="<?php echo $category["category_name"] ?>" href="<?php $sess->purl(URL."index.php?option=com_virtuemart&amp;page=shop.browse&amp;category_id=".$category["category_id"]) ?>">
		<?php
		echo $category["category_name"];
		echo $category['number_of_products'];
		?>
		</a>
		
		<?php
		if ( $category["category_thumb_image"] ) {
		?><center>
		<a title="<?php echo $category["category_name"] ?>" href="<?php $sess->purl(URL."index.php?option=com_virtuemart&amp;page=shop.browse&amp;category_id=".$category["category_id"]) ?>"> 
		<?php
			echo ps_product::image_tag( $category["category_thumb_image"], "alt=\"".$category["category_name"]."\"", 0, "category");
			echo "</a></center>";
		}
		?>
	</div>
	<?php 
	if ($catVar == $catCount - 1) { echo '<div style="clear:both"></div>'; $catVar = -1	; }
	$catVar = $catVar + 1;
	
	}	else if($catDesign == 2) { ?>
	<div class="vmNavListProduct3" style="width:<?php echo 100 / $catCount - 3; ?>%">		
		<a class="vmCatProductText3" title="<?php echo $category["category_name"] ?>" href="<?php $sess->purl(URL."index.php?option=com_virtuemart&amp;page=shop.browse&amp;category_id=".$category["category_id"]) ?>">
		<?php
		echo $category["category_name"];
		echo $category['number_of_products'];
		?>
		</a>
		
		<?php
		if ( $category["category_thumb_image"] ) {
		?>
		<a title="<?php echo $category["category_name"] ?>" href="<?php $sess->purl(URL."index.php?option=com_virtuemart&amp;page=shop.browse&amp;category_id=".$category["category_id"]) ?>"> 
		<?php
			echo ps_product::image_tag( $category["category_thumb_image"], "alt=\"".$category["category_name"]."\"", 0, "category");
			echo "</a>";
		}
		?>
	</div>
<?php 
	if ($catVar == $catCount - 1) { echo '<div style="clear:both"></div>'; $catVar = -1	; }
	$catVar = $catVar + 1;
	}
}
if ($catBrowse != 3 && $catBrowse != 4 && isset($_GET["flypage"]) && $modBox == 6 ) {
	echo '</div></div>';
} else { echo ''; }
?>