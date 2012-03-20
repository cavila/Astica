<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); ?>
<?php 
$imageBox = $this->get_cfg('browseImageWidth');

// Dynamic Image Resize check
if (file_exists(IMAGEPATH.'product/'.$product_thumb_image)) {
	list($width, $height, $type, $attr) = @getimagesize(IMAGEPATH.'product/'.$product_thumb_image);
} else {
	$parsed = array();
	$array = array();
	$url = $product_thumb_image;
	$parsed = parse_url($url);
	parse_str($parsed['query'], $array);
	list($width, $height, $type, $attr) = @getimagesize(IMAGEPATH.'product/'.$array["filename"]);
}
$target = $this->get_cfg('browseImageWidth');
if ($target == null) {
	$target = $width;
	}				
if ($this->get_cfg('categoryResizeToggle') == 1) {
	list($width1, $height1) = $this->resizeThumbnails($target,$width,$height);
} else {
	$width1 = $width;
	$height1 = $height;
	}
?>
<div class="vmBrowseContainer v10BrowseContainer" style="min-width:115px;">
	<div class="vmBrowseProductTitle v10BrowseProductTitle">		
		<div class="v10BrowseImageBox" style="width:<?php echo $imageBox + 5 ; ?>px;">
			<script type="text/javascript">//<![CDATA[
			document.write('<a title="<?php echo $product_name ?>" href="<?php echo $product_flypage ?>">');
			document.write('<?php echo ps_product::image_tag( $product_thumb_image, 'class="browseProductImage" border="0" title="'.$product_name.'" width="'.$width1.'" height="'.$height1.'" alt="'.$product_name .'"' ) ?></a>' );
			//]]>
			</script>
			<noscript>
				<a href="<?php echo $product_full_image ?>" target="_blank" title="<?php echo $product_name ?>">
				<?php echo ps_product::image_tag( $product_thumb_image, 'class="browseProductImage"  width="'.$width1.'" height="'.$height1.'" border="0" title="'.$product_name.'" alt="'.$product_name .'"' ) ?>
				</a>
			</noscript>
			
		</div>
		
		<a href="<?php echo $product_flypage ?>"><?php echo $product_name ?></a><br />
		<div style="display:block;margin:5px 0 10px;float:left;font-size:0.8em;padding:0 120px 0 0;"><?php echo $this->getReviewStars($product_id); ?></div>
		<span class="v10BrowseDesc"><?php echo substr($product_s_desc,0,200); ?>...</span>
		<div class="v10BrowsePriceBox"  style="width:98%;">
			<?php if (strlen($form_addtocart) > 0):  ?>
				<div class="vmCatPrice v2CatPrice" ><?php echo $form_addtocart ?></div>				
			<?php endif; ?>
			<a href="<?php echo $product_flypage ?>">More Info</a><br />
			<?php
				$number = split('.', $product_price_raw['product_price']);
				if(strlen($number[1]) < 2) { $resultNumber = number_format($product_price_raw['product_price'],2); }
				else	{ $resultNumber = $dbNumber;	}
				$number = split('.', $product_price_raw['product_price']);
				if(strlen($number[1]) < 2) { $resultNumber1 = number_format($product_price_raw['product_price'],2); }
				else	{ $resultNumber1 = $dbNumber;	}
				if($product_price_raw['product_price'] != $product_price_raw['product_base_price']) {
					echo '<span class="v10BrowseDiscount">'.$CURRENCY_DISPLAY->symbol.substr($resultNumber1,0,-2).'<span style="font-size:10px">'.substr($resultNumber1,-2).'</span></span>&nbsp;'; }
				echo '<span class="v10BrowsePrice">'.$CURRENCY_DISPLAY->symbol.substr($resultNumber,0,-2).'<span style="font-size:12px">'.substr($resultNumber,-2).'</span></span>';
			?>
			
		</div>
		
	</div>		  
</div>
