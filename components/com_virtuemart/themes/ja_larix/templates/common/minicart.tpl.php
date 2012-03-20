<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );

if($empty_cart) { ?>
    
    <div style="margin: 0 auto;">
   <?php if(!$vmMinicart) {  ?>
		<br/><br style="clear:both" /><div align="left">
   		 <?php echo $show_cart ?>
    </div>        <br />
    <?php }
    echo $VM_LANG->_('PHPSHOP_EMPTY_CART') ?>
    </div>
<?php } 
else {
    // Loop through each row and build the table
   
}
 if (!$empty_cart && !$vmMinicart) { ?>
    <br/><br style="clear:both" /><div align="left">
    <?php echo $show_cart ?>
    </div><br/>

<?php } 
if(!$vmMinicart) { ?>
    <hr style="clear: both;" />
<?php } ?>
<div style="float: left;" >
<?php echo $total_products ?> &nbsp&nbsp&nbsp 
</div>
<br />
<div style="float:center ;">
<?php echo $total_price ?>
</div>
<?php 
echo $saved_cart;
?>