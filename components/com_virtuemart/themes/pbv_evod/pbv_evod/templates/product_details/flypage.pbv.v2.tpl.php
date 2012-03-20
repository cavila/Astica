<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 


$flypageWidth = $this->get_cfg('flypageWidth');
$tabType = $this->get_cfg('tabType');
$script = $this->get_cfg('useScript');
$imagePath = IMAGEPATH.'product/';
$resize = $this->get_cfg('resizeThumbnails');
$descLink = $this->get_cfg('descLink');
$reviewsLink = $this->get_cfg('reviewsLink');
$buyLink = $this->get_cfg('buyLink');
echo $this->vmLoadjQuery();

if (count($files) > 0) {
	foreach($files as $value) {
		if ($value->file_extension == 'mp4') {
			$file_video = $mosConfig_live_site.$value->file_name;
			$videoWidth = 520/.75;
			$videoHeight = 330/.75;
			$vmProductVideo = $this->vmProductVideo($file_video, $videoWidth, $videoHeight);
			break;
		}
	}
}
?>
<script type="text/javascript">   jQuery.noConflict(); </script>

<div class="v14FlyPageTop">	
	<?php
	if( $this->get_cfg( 'showPathway' )) {
		echo "<div class=\"pathway\" >$navigation_pathway</div><br style=\"clear:both;\" />";
	}
	?>
	<?php
	if( $this->get_cfg( 'product_navigation', 1 )) {
		echo '<div class="vmProductNav">';
		if( !empty( $previous_product )) {
			echo '<a class="previous_page" href="'.$previous_product_url.'">'.shopMakeHtmlSafe($previous_product['product_name']).'</a>';
		}
		if( !empty( $next_product )) {		
			echo '<a class="next_page" href="'.$next_product_url.'">'.shopMakeHtmlSafe($next_product['product_name']).'</a>';
		}
		echo '</div>';
	}
	?>	
	<h1 class="vmProductName v14ProductName" style="display:block;vertical-align:bottom;" ><?php echo $product_name ?> <?php echo $edit_link ?>
	<span class="v14toplinks" >
	<a href="#descLink" ><?php echo $descLink; ?></a>
	<a href="#reviewLink" ><?php echo $reviewsLink; ?></a>
	<span class="v14buyNow"><a href="#buyLink"><?php echo $buyLink; ?></a></span></span>	
	</h1>
	<div style="clear:both;"></div>
</div>
<div class="v14FlyPageMiddle">
	<div class="vmImagesMain v1ImagesMain" style="width:<?php echo $flypageWidth - 10 ; ?>px;">
		<?php
		if (isset($vmProductVideo)) { echo $vmProductVideo; }
		?>		
		<link rel="stylesheet" href="<?php echo VM_THEMEURL; ?>css/style.aw-showcase.css" />	
		<script type="text/javascript" src="<?php echo VM_THEMEURL; ?>js/jquery.aw-showcase.js"></script>
		<script src="<?php echo VM_THEMEURL; ?>js/jquery.ae.image.resize.min.js"></script>
		<script>
			jQuery(function() {
				jQuery( ".resizeme" ).aeImageResize({ width: <?php echo $flypageWidth  ; ?> });
			});
		</script>
		<script type="text/javascript">
		jQuery(document).ready(function()
		{
			jQuery("#showcase").awShowcase(
			{
				content_width:			<?php echo $flypageWidth  ; ?>,
				content_height:			420,
				hundred_percent:		false,
				auto:					false,
				interval:				8000,
				continuous:				true,
				loading:				true,
				tooltip_width:			200,
				tooltip_icon_width:		32,
				tooltip_icon_height:	32,
				tooltip_offsetx:		18,
				tooltip_offsety:		0,
				arrows:					false,
				buttons:				true,
				btn_numbers:			false,
				keybord_keys:			true,
				mousetrace:				false, /* Trace x and y coordinates for the mouse */
				pauseonover:			true,
				transition:				'hslide', /* hslide / vslide / fade */
				transition_delay:		300,
				transition_speed:		500,
				show_caption:			'onload', /* onload / onhover / show */
				thumbnails:				true,
				thumbnails_position:	'outside-last', /* outside-last / outside-first / inside-last / inside-first */
				thumbnails_direction:	'horizontal', /* vertical / horizontal */
				thumbnails_slidex:		0, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
				dynamic_height:			true,
				speed_change:			false, /* This prevents user from swithing more then one slide at once */
				viewline:				false /*  If set to true content_width, thumbnails, transition and dynamic_height will be disabled, !BETA */
			});
		});
		</script>
		
		<div id="showcase" class="showcase">
			<?php
			list($imgWidth, $imgHeight) = $this->vmGetImageSize(IMAGEURL, $product_full_image, $flypageWidth, 1);	
			$product_thumb_link = '<img src="'.VM_THEMEURL.'scripts/timthumb.php?src='.IMAGEURL.'product/'.$product_full_image.'&w='.($flypageWidth ).'&h='.round($imgHeight).'&q=75" width="'.$imgWidth.'" height="'.round($imgHeight).'" alt="'.$product_name.'" title="'.$product_s_desc.'"/>';
			//$product_thumb_link = '<img src="'.IMAGEURL.'product/'.$product_full_image.'"  alt="'.$product_name.'" width="'.$imgWidth.'" height="'.$imgHeight.'" class="resizeme" title="'.$product_s_desc.'" />';
			$product_image = vmCommonHTML::getLightboxImageLink( IMAGEURL.'product/'.$product_full_image, $product_thumb_link, $product_name, 'product'.$product_id );
			$html = '<div class="showcase-slide">
						<div class="showcase-content" style="min-height:330px;">
						'.$product_thumb_link.'</div>
				<div class="showcase-thumbnail">
					<img src="'.VM_THEMEURL.'scripts/timthumb.php?src='.IMAGEURL.'product/'.$product_thumb_image.'&w=100&h=75&a=c&q=65" />
					<div class="showcase-thumbnail-cover"></div>
				</div>
			</div>';
			$html .= $this->vmlistPBV6AdditionalImages( $product_id, $images, $script, $flypageWidth);
			echo $html;
				?>
		</div>
		<?php echo $this->getProductTestimonial(1, "from our customers", $_GET['product_id']); ?>
				
		<div style="clear:both;"></div>
	</div>
	<div style="clear:both;"></div>
</div><a name="descLink"></a>

<div class="v14desc" style="float:left;width:100%;">
	<div style="width:302px;float:right;margin:0 0 10px 10px;">	
		<div class="v14ImagesDesc" ><a name="buyLink"></a>
			<div class="v14priceContainer">
				<p class="v14Small"><?php echo $product_price; ?></p>
			</div>
			<?php if(! $this->getDiscountDate($product_sku) == '' OR $this->getDiscountDate($product_sku) == 'Promotional Price'): ?>
				<div class="v14sidebar"">
					<p class="v14Small"><strong>Sale Ends:</strong> <span style="font-size:1.4em;padding:4px;background:#FFFFCC;"><?php echo $this->getDiscountDate($product_sku); ?></span></p>
				</div>
			<?php endif; ?>
			<div class="v14sidebar">
				<p class="v14Small"><strong>Product SKU:</strong> <?php echo $product_sku; ?></p>
			</div>
			<?php if( $this->get_cfg( 'showAvailability' )): ?>
				<?php if( strlen($product_availability) > 5 ): ?>
				<div class="v14sidebar" >
					<p class="v14Small"><strong>Availability:</strong> <?php echo $product_availability; ?></p>
				</div>
				<?php endif; ?>			
			<?php endif; ?>			
			<?php if( $product_in_stock >= 0): ?>
			<div  class="v14sidebar" >
				<p class="v14Small"><strong>Product Stock:</strong> <?php echo $product_in_stock; ?></p>
			</div>			
			<?php endif; ?>			
			<?php
			if ($this->get_cfg('showButtons') == 1) {
				echo $buttons_header.'<br style="clear:both" />';
				}
			?>
		</div>
		<div style="width:300px;float:right;margin-top:5px;">
			<table cellpadding=0 cellspacing=0 border=0 width="100%">
				<tr>
					<td>
					<?php echo $addtocart ?>
					</td>
				</tr>
			</table>
		</div>
		
		<div id="related" class="v14Related">
			<?php echo $related_products ?>
		</div>
	</div>
	<!-- <h2 class="v14ProductName"><?php echo $product_name ?></h2> -->
	<h3 class="v14ProductSDesc"><?php echo $product_s_desc ?></h3>
	<span class="vmProductDesc v1ProductDesc"><?php echo $product_description ?></span>
	<?php if( $this->get_cfg('showManufacturerLink')) { ?>
		<?php echo $manufacturer_link ?><br />
	<?php } ?>
	<a name="reviewLink"></a>
	<div id="vmAskSeller" style="width:229px"><?php echo $ask_seller ?></div>
	<?php echo $product_packaging ?><br />
	
	
	<span style="font-style: italic;"><?php echo $file_list ?></span>
	
	<div style="clear:both;"></div>

	<div id="reviews">
		<h3>Product Reviews</h3>
	<div class="vmReviews v1Reviews">
		<?php echo $product_reviews ?>
	</div>
		<?php echo $product_reviewform ?>
	</div>
	
	  
</div>
	
	<?php echo $product_type ?>	
	
	<?php if( $this->get_cfg('showVendorLink')) { ?>
		<?php echo $vendor_link ?><br />	
	<?php  } ?>
	
<?php 
if( !empty( $recent_products )) { ?>
	<div class="vmRecent v1Recent">
	<?php echo $recent_products; ?>
	</div>
<?php 
}
if( !empty( $navigation_childlist )) { ?>
	<?php echo $navigation_childlist ?><br style="clear:both"/>
<?php 
} ?>