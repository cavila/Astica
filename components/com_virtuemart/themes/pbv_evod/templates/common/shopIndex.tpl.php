<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); ?>

<?php
$modBox = $this->get_cfg('shopIndexColor');
defined( 'vmToolTipCalled') or define('vmToolTipCalled', 1);
if ($modBox != 1) {
	echo '<link rel="stylesheet" href="'.VM_THEMEURL.'css/pbv-mod_box.css" type="text/css" />';
	echo '<div class="moduletable_mod_box-'.$modBox.'">';
	echo "<h3>".$VM_LANG->_('PHPSHOP_CATEGORIES')."</h3>";
} else {
	echo "<h3 class=\"vmCatBrowse\">".$VM_LANG->_('PHPSHOP_CATEGORIES')."</h3>";
	echo '<div class="vmNavList">';
}
echo $categories;
echo "<br style=\"clear:both\">".$vendor_store_desc;
echo '</div>';
 ?>

<div class="vmRecent">
<?php echo $recent_products; ?>
</div>
<?php
// Show Featured Products
if( $this->get_cfg( 'showFeatured', 1 )) {
    /* featuredproducts(random, no_of_products,category_based) no_of_products 0 = all else numeric amount
    edit featuredproduct.tpl.php to edit layout */
    echo $ps_product->featuredProducts(true,10,false);
}
// Show Latest Products
if( $this->get_cfg( 'showlatest', 1 )) {
    /* latestproducts(random, no_of_products,month_based,category_based) no_of_products 0 = all else numeric amount
    edit latestproduct.tpl.php to edit layout */
    ps_product::latestProducts(true,10,false,false);
}
?>