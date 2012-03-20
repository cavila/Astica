<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 

$saleTextDisplay = $this->get_cfg('saleTextDisplay');
$saleText = $this->get_cfg('saleText');
$regText = $this->get_cfg('regText');
$savedText = $this->get_cfg('savedText');

// User is not allowed to see a price or there is no price
if( !$auth['show_prices'] || !isset($price_info["product_price_id"] )) {
	
	$link = $sess->url( $_SERVER['PHP_SELF'].'?page=shop.ask&amp;product_id='.$product_id.'&amp;subject='. urlencode( $VM_LANG->_('PHPSHOP_PRODUCT_CALL').": $product_name") );
	echo vmCommonHTML::hyperLink( $link, $VM_LANG->_('PHPSHOP_PRODUCT_CALL') );
}
?>

<div id="priceContainer">

<?php
// DISCOUNT: Show old price!
//First line makes sure that the old price and discount are not shown on category browse pages

if(!empty($discount_info["amount"])) {
	?>
	<span class="product-Old-Price">
		<strong><?php echo $regText; ?></strong> <?php echo $CURRENCY_DISPLAY->getFullValue($undiscounted_price); ?></span>
	
	<?php
}

?>
<?php
if( !empty( $price_info["product_price_id"] )) { ?>
	<span class="productPrice">
		<?php if(!empty($discount_info["amount"])) { 
			if($saleTextDisplay == 1) { echo '<strong>'.$saleText.'</strong> '; } echo $CURRENCY_DISPLAY->getFullValue($base_price); 
		}else { 
			if($saleTextDisplay == 1) { echo '<strong>'.$regText.'</strong> '; } echo $CURRENCY_DISPLAY->getFullValue($base_price); 
		} 
			echo $text_including_tax ?>
	</span>
<?php
}
echo $price_table;


// DISCOUNT: Show the amount the customer saves

if(!empty($discount_info["amount"])) {
	echo " <span class=\"product-amount-saved\">";
	echo $savedText.' ';
	if($discount_info["is_percent"]==1) {
		echo $discount_info["amount"]."%";
	}
	else {
		echo $CURRENCY_DISPLAY->getFullValue($discount_info["amount"]);
	}
	echo '</span><br style="clear:both;"/>';
}


?>
</div>