<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); ?>


	<?php
	ob_start();
	
	if (($product_in_stock < 1 && CHECK_STOCK) || $product_available_date > time() ) { 
		// Product is not in stock or not available yet (Availability date in future) ?>
		<?php echo $VM_LANG->_('PHPSHOP_CURRENTLY_NOT_AVAILABLE') ?>
		
				
		<?php 	
	}
	// Product will be available soon!!
	if($product_available_date > time()) { ?>
			<?php 
			echo $VM_LANG->_('PHPSHOP_PRODUCT_AVAILABLE_AGAIN')
				. date("d.m.Y", $product_available_date ); 
			?>
			
			<?php 
	}
	// Yes, we have XX products in stock!
	elseif( ($product_in_stock >= 1 && CHECK_STOCK) ) {
		echo $product_in_stock;
	}

	// Delivery time!
	// Ships in 24hrs, 48hrs, ....
	if( $product_availability ) { ?>
		<span style="font-weight:normal;text-transform:lowercase;">
			&nbsp;<?php echo $VM_LANG->_('PHPSHOP_DELIVERY_TIME') ?>
		</span>
		<br /><br />
		<?php
		if( CHECK_STOCK == '1' && !$product_in_stock ) {
			$product_availability = 'not_available.gif';
		}
		if( is_file( VM_THEMEPATH."images/availability/".$product_availability)) {
			echo vmCommonHTML::imageTag( VM_THEMEURL."images/availability/".$product_availability, $product_availability );
		}
		else {
			echo $product_availability;
		}
	}
	$avail = ob_get_contents();
	ob_end_clean();
	if( !empty( $avail ) ) { 
		
		echo $avail;
	}
?>