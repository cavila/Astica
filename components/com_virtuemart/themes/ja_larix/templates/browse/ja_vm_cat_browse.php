<div class="ja-productwrap clearfix">
  <div class="ja-product">
    <h3>
      <a href="<?php echo $product_flypage ?>" title="<?php echo $product_name ?>"><span><?php echo $product_name ?></span></a>
    </h3>
    
    <div style="float:left;width:100%" class="clearfix">
      <a href="<?php echo $product_flypage ?>" title="<?php echo $product_name ?>">
	  <?php echo ps_product::image_tag( $product_thumb_image, 'class="browseProductImage" border="0" align="left" title="'.$product_name.'" alt="'.$product_name .'"' ) ?>
      </a>
      <?php echo $product_price ?>
      <p><?php echo $product_s_desc ?></p>	
    </div>
    
    <a class="prod-details" href="<?php echo $product_flypage ?>" title="<?php echo $product_name ?>">[<?php echo $product_details ?>...]</a>
    
   
    <div style="float:left; width:100%; margin-top: 3px;">
       <?php echo $product_rating ?>
    </div>
    
    <div style="float:left; width:90%; margin-top: 3px;">
      <?php echo $form_addtocart ?>
    </div>
  </div>
</div>
