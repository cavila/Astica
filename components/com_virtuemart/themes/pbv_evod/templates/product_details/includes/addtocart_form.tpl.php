<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );

$vmCartContainer = $this->get_cfg('vmCartContainer');
$addtocart_style = $this->get_cfg('addtocart_style');
$addtocart_inline = $this->get_cfg('inlineAddtoCart');
$flypage = $_GET['flypage'];

echo '<link rel="stylesheet" type="text/css" href="'.VM_THEMEURL.'css/pbv-'.$addtocart_style.'.css" />';
mm_showMyFileName(__FILE__);
// This function lists all product children ( = Items)
// or, when not children are defined, the product_id
// SO LEAVE THIS IN HERE!
list($html,$children) = $ps_product_attribute->list_attribute( ( $product_parent_id > 0 )  ? $product_parent_id : $product_id);

if (strlen($html) > 200 || $addtocart_inline == 1 ) {
	echo '<div class="vmCartContainer v'.$vmCartContainer.'CartContainer">';
}
if ($children != "multi") { 

    if( CHECK_STOCK == '1' && !$product_in_stock ) {
     	$notify = true;
    } else {
    	$notify = false;
    }
	
	if ($flypage == 'flypage.pbv.v12.tpl' ) {
		echo '<span class="v12ProductAdd">Buy '.$product_name.'</span>';
		}
	?>
	<form action="<?php echo $mm_action_url ?>index.php" method="post" name="addtocart" id="<?php echo uniqid('addtocart_') ?>" class="addtocart_form" <?php if( $this->get_cfg( 'useAjaxCartActions', 1 ) && !$notify ) { echo 'onsubmit="handleAddToCart( this.id );return false;"';
	} ?>>
<?php
}
echo $html;
if (strlen($html) > 152 && $addtocart_inline == 0 ) {
	echo '</div>';
	}
if (USE_AS_CATALOGUE != '1' && $product_price != "" && !stristr( $product_price, $VM_LANG->_('PHPSHOP_PRODUCT_CALL') )) {
	
	echo '<div style="clear:both"></div><div class="vmAddtoCart">';	
    if ($children == "drop") { 
    	echo $ps_product_attribute->show_quantity_box($product_id,$product_id);
    } 
    if ($children == "radio") {
		echo $ps_product_attribute->show_radio_quantity_box();
    }
    if ($addtocart_style == 12 || $addtocart_style == 13 || $addtocart_style == 14 ) {
		$button_lbl = $VM_LANG->_('PHPSHOP_CART_ADD_TO');
	} else {
		$button_lbl = '';
		}
    $button_cls = 'addtocart_button';
    if( CHECK_STOCK == '1' && !$product_in_stock ) {
     	$button_lbl = $VM_LANG->_('VM_CART_NOTIFY');
     	$button_cls = 'notify_button';
		echo '<input type="submit" class="'. $button_cls .'" value="'. $button_lbl .'" style="padding-top:3px;" title="'. $button_lbl .'" />';
    } else {
    ?>
    <input type="submit" class="<?php echo $button_cls ?>" value="<?php echo $button_lbl ?>" title="<?php echo $button_lbl ?>" />
    <?php  } ?>
	</div>    
    <input type="hidden" name="flypage" value="shop.<?php echo $flypage ?>" />
	<input type="hidden" name="page" value="shop.cart" />
    <input type="hidden" name="manufacturer_id" value="<?php echo $manufacturer_id ?>" />
    <input type="hidden" name="category_id" value="<?php echo $category_id ?>" />
    <input type="hidden" name="func" value="cartAdd" />
    <input type="hidden" name="option" value="<?php echo $option ?>" />
    <input type="hidden" name="Itemid" value="<?php echo $Itemid ?>" />
    <input type="hidden" name="set_price[]" value="" />
    <input type="hidden" name="adjust_price[]" value="" />
    <input type="hidden" name="master_product[]" value="" />
    <?php
}
if ($children != "multi") { ?>
	</form>
<?php 
} 
    if($children == "radio") { ?>
    
    <script language="JavaScript" type="text/javascript">//<![CDATA[
    function alterQuantity(myForm) {
        for (i=0;i<myForm.selItem.length;i++){
            setQuantity = myForm.elements['quantity'];
            selected = myForm.elements['selItem'];
            j = selected[i].id.substr(7);
            k= document.getElementById('quantity' + j);
            if (selected[i].checked==true){
                k.value = myForm.quantity_adjust.value; }
            else {
                k.value  = 0;
            }
        }
    }
	//]]>   
	</script>
<?php }

if ($addtocart_inline == 1 ) {
	echo '</div>';
	}
?>