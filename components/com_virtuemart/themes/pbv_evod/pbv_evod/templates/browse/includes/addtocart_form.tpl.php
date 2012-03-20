<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 

$addtocart_style = $this->get_cfg('addtocart_style');
echo '<link rel="stylesheet" type="text/css" href="'.VM_THEMEURL.'css/pbv-'.$addtocart_style.'.css" />';

if( CHECK_STOCK == '1' && !$product_in_stock ) {
	$button_lbl = $VM_LANG->_('VM_CART_NOTIFY');
	$button_cls = 'notify_button';
} else {
	if ($addtocart_style == 12 || $addtocart_style == 13 || $addtocart_style == 14 ) {
		$button_lbl = $VM_LANG->_('PHPSHOP_CART_ADD_TO');
	} else {
		$button_lbl = '';
		}
	$button_cls = 'addtocart_button';
}
?>
<div style="float:left;width:auto">
<form action="<?php echo $mm_action_url ?>index.php" method="post" name="addtocart" id="addtocart<?php echo $i ?>" class="addtocart_form" <?php if( $this->get_cfg( 'useAjaxCartActions', 1 )) { echo 'onsubmit="handleAddToCart( this.id );return false;"'; } ?>>
	<?php echo $ps_product_attribute->show_quantity_box($product_id,$product_id); ?>
	<input type="submit" class="<?php echo $button_cls ?>" value="<?php echo $button_lbl ?>" title="<?php echo $button_lbl ?>" /> 
    <input type="hidden" name="category_id" value="<?php echo  @$_REQUEST['category_id'] ?>" />
    <input type="hidden" name="product_id" value="<?php echo $product_id ?>" />
    <input type="hidden" name="prod_id[]" value="<?php echo $product_id ?>" />
    <input type="hidden" name="page" value="shop.cart" />
    <input type="hidden" name="func" value="cartadd" />
    <input type="hidden" name="Itemid" value="<?php echo $sess->getShopItemid() ?>" />
    <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="set_price[]" value="" />
    <input type="hidden" name="adjust_price[]" value="" />
    <input type="hidden" name="master_product[]" value="" />
</form></div>