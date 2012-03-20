<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); ?>
 <?php
	
$addtocart_style = $this->get_cfg('addtocart_style');
 
 if( $show_product_name ) : ?>
<span style="font-weight:normal;text-align:left;font:bold 13px/16px 'Trebuchet MS', helvetica;color:#3D8FF3;"><?php echo $product_name ?></span>
<?php endif; ?>
<div class="vmProductSnapshot">
<a title="<?php echo $product_name ?>" href="<?php echo $product_link ?>">
	<?php
		// Print the product image or the "no image available" image
		//echo ps_product::image_tag( $product_thumb_image, "alt=\"".$product_name."\"");
		echo '<p style="margin:0;font:normal 11px/14px arial;text-align:left;"><img src="'.VM_THEMEURL.'scripts/timthumb.php?src='.IMAGEURL.'product/'.$product_thumb_image.'&w=100&h=50&a=c&q=65" style="float:left;padding:3px;"/>';
		echo '</p><br style="clear:both;" />';
	?>
</a></div>

<?php
if( !empty($price) ) {
	echo $price;
}
if ($addtocart_style == 12 || $addtocart_style == 13 || $addtocart_style == 14 ) {
		$button_lbl = $VM_LANG->_('PHPSHOP_CART_ADD_TO');
	} else {
		$button_lbl = '';
		}

if( !empty($addtocart_link) ) {
	?>
	<form action="<?php echo  $mm_action_url ?>index.php" method="post" name="addtocart" id="addtocart">
    <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="page" value="shop.cart" />
    <input type="hidden" name="Itemid" value="<?php echo ps_session::getShopItemid(); ?>" />
    <input type="hidden" name="func" value="cartAdd" />
    <input type="hidden" name="prod_id" value="<?php echo $product_id; ?>" />
    <input type="hidden" name="product_id" value="<?php echo $product_id ?>" />
    <input type="hidden" name="quantity" value="1" />
    <input type="hidden" name="set_price[]" value="" />
    <input type="hidden" name="adjust_price[]" value="" />
    <input type="hidden" name="master_product[]" value="" />
	<input type="submit" class="addtocart_button" value="<?php echo $button_lbl ?>" title="<?php echo $button_lbl ?>" />
    </form>
	<?php
}
?>