<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );

global $minicartType, $mod_dir, $VM_LANGS, $loginCode, $type;

?>
 
<script type="text/javascript">
  jQuery.noConflict();
</script>
<script type="text/javascript"> 
jQuery(document).ready(function(){
 
	jQuery(".btn-slide").click(function(){
		jQuery("#panel").slideToggle("150");
		jQuery(this).toggleClass("vmActive");
		jQuery("#cart_arrow").toggleClass("vmCartArrowActive");
		return false;
	});		
});
</script>

<?php
if (!$empty_cart) {
	echo '<style type="text/css">.vmPBVcart #panel { right: -77px; } #panel.vmAccount {right:-117px;}</style>';
	}

if ($minicartType == 1) {
	if($empty_cart) {
		echo '&nbsp;<div class="vmEmptyCart" style="position:relative"><img src="'.$mod_dir.'images/top_cart.png"> Cart: Empty</strong>&nbsp;&nbsp;&nbsp;<a href="index.php?page=account.index&option=com_virtuemart" class="btn-slide">'.$loginCode.'</a></div>';
		if( $type == 'login' ) {
			echo '<div class="vmFreeTrial"><style type="text/css"> .vmEmptyCart { width:205px;}</style><div style="color:#FFFFFF;margin-top:15px;float:left;">or</div>&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?option=com_virtuemart&page=shop.registration&Itemid=54"><img src="'.$mod_dir.'images/free-trial.png" /></a></div>';
		}
	} else {
	echo '&nbsp;<div class="vmPBVcart">
		<img src="'.$mod_dir.'images/top_cart.png"> '.$show_cart.' ('.$total_products.') &nbsp;&nbsp;<a href="index.php?page=account.index&option=com_virtuemart" class="btn-slide">'.$loginCode.'</a></div>';
	if( $type == 'login' ) {
		echo '<div class="vmFreeTrial"><style type="text/css"> .vmEmptyCart { width:205px;}</style><div style="color:#FFFFFF;margin-top:15px;float:left;">or</div>&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?option=com_virtuemart&page=shop.registration&Itemid=54"><img src="'.$mod_dir.'images/free-trial.png" /></a></div>';
	}
	} 
} else {
	if($empty_cart) { ?>
		
		<div style="margin: 0 auto;">
		<?php if(!$vmMinicart) { ?>
			<a href="http://www.poweredbyvirtuemart.com/" target="_blank">
			<img src="<?php echo $mm_action_url ?>components/com_virtuemart/shop_image/ps_image/menu_logo.gif" alt="VirtueMart" width="80" border="0" /></a>
			<br />
		<?php }
		echo $VM_LANG->_('PHPSHOP_EMPTY_CART') ?>
		</div>
	<?php } 
	else {
		// Loop through each row and build the table
		foreach( $minicart as $cart ) { 		

			foreach( $cart as $attr => $val ) {
				// Using this we make all the variables available in the template
				// translated example: $this->set( 'product_name', $product_name );
				$this->set( $attr, $val );
			}
			if(!$vmMinicart) { // Build Minicart
				?>
				<div style="float: left;">
				<?php echo $cart['quantity'] ?>&nbsp;x&nbsp;<a href="<?php echo $cart['url'] ?>"><?php echo $cart['product_name'] ?></a>
				</div>
				<div style="float: right;">
				<?php echo $cart['price'] ?>
				</div>
				<br style="clear: both;" />
				<?php echo $cart['attributes'];
			}
		}
	}
	if(!$vmMinicart) { ?>
		<hr style="clear: both;" />
	<?php } ?>
	<div style="float: left;" >
		<?php echo $total_products ?>
	</div>
	<div style="float: right;">
		<?php echo $total_price ?>
	</div>
	<?php if (!$empty_cart && !$vmMinicart) { ?>
		<br/><br style="clear:both" /><div align="center">
		<?php echo $show_cart ?>
		</div><br/>

	<?php } 
	echo $saved_cart;
}	?>