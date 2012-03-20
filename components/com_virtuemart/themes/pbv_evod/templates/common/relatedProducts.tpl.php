<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); ?>

<p style="font-size:16px;font-family:helvetica;font-weight:bold;"><?php echo $VM_LANG->_('PHPSHOP_RELATED_PRODUCTS_HEADING') ?></p>
 
<?php 
    while( $products->next_record() ) { ?>
      	<div class="vmProductSnapshotContainer">
      		<?php echo $ps_product->product_snapshot( $products->f('product_sku') ) ?>
      	</div>
	<?php 
    }
	?>
