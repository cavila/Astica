<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 


$flypageWidth = $this->get_cfg('flypageWidth');
$tabType = $this->get_cfg('tabType');
$toggle = $this->get_cfg('toggleImages');
$cursorZoom = $this->get_cfg('cursorZoom');
$script = $this->get_cfg('useScript');
$imagePath = IMAGEPATH.'product/';
$resize = $this->get_cfg('resizeThumbnails');
echo $this->vmLoadjQuery();
list($details_width, $width) = $this->vmGetImageSize($imagePath, $product_thumb_image, $flypageWidth);
echo $this->vmFlypageTabs($tabType );

$widthCollapse = $width;
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

$document =& JFactory::getDocument();
$document->addStyleSheet(VM_THEMEURL.'js/cloud-zoom.css','text/css','screen');
$document->addStyleSheet(VM_THEMEURL.'css/jquery.fancybox-1.3.4.css','text/css','screen');
$document->addScript("http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js");
$document->addScript(VM_THEMEURL.'js/cloud-zoom.1.0.2.js');
$document->addScript(VM_THEMEURL.'js/jquery.fancybox-1.3.4.js');

?>
<script type="text/javascript">   jQuery.noConflict(); </script>
<script type="text/javascript">
		jQuery(function() {
				/*
				fancybox init on each cloud-zoom element
				 */
				jQuery("#vmMainPage .cloud-zoom").fancybox({
					'transitionIn'	:	'elastic',
					'transitionOut'	:	'none',
					'speedIn'		:	600,
					'speedOut'		:	200,
					'overlayShow'	:	true,
					'overlayColor'	:	'#000',
					'cyclic'		:	true,
					'titlePosition'		: 'inside',
					'overlayColor'		: '#000',
					'overlayOpacity'	: 0.8
				});
 
				/*
				because the cloud zoom plugin draws a mousetrap
				div on top of the image, the fancybox click needs
				to be changed. What we do here is to trigger the click
				the fancybox expects, when we click the mousetrap div.
				We know the mousetrap div is inserted after
				the <a> we want to click:
				 */
				jQuery("#vmMainPage .mousetrap").live('click',function(){
					jQuery(this).prev().trigger('click');
				});
			});
	</script>
<div class="v12FlyPageTop">	
	<?php
	if( $this->get_cfg( 'showPathway' )) {
		echo "<div class=\"pathway\" >$navigation_pathway</div>";
	}	
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
	<div style="clear:both;"></div>
</div>
<div class="v13FlyPageMiddle">
	<div class="vmImagesMain v13ImagesMain" style="width:400px;">
		<?php
		if (isset($vmProductVideo)) { echo $vmProductVideo; }		
		?>			
		 <a href='<?php echo IMAGEURL.'product/'.$product_full_image; ?>' class = 'cloud-zoom' id='zoom1' rel="adjustX: 10, adjustY:-4" >
            <img src="<?php echo VM_THEMEURL; ?>scripts/timthumb.php?src=<?php echo IMAGEURL; ?>product/<?php echo $product_full_image; ?>&w=400&q=90" alt='<?php echo $product_s_desc; ?>' title="<?php echo $product_name; ?>" />
        </a>
		<?php if($this->vmlistPBV7AdditionalImages( $product_id, $images)) { ?>
        <div style="background:#F7F7F7;border:1px solid #E7E7E7;width:auto;display:inline;float:left;margin:10px 0 0 0px;"><span class="vmTinyImage"><a href="<?php echo IMAGEURL.'product/'.$product_full_image; ?>" class="cloud-zoom-gallery" title="<?php echo $product_name; ?>" rel="useZoom: 'zoom1', smallImage: '<?php echo VM_THEMEURL; ?>scripts/timthumb.php?src=<?php echo IMAGEURL ?>product/<?php echo $product_full_image ?>&w=400&q=90' ">
		<img src="<?php echo VM_THEMEURL; ?>scripts/timthumb.php?src=<?php echo IMAGEURL ?>product/<?php echo $product_full_image ?>&w=85&h=65&a=c&q=65" alt = "<?php echo $product_name; ?>"/></a></span>
		<?php echo $this->vmlistPBV7AdditionalImages( $product_id, $images) ?></div><?php } ?>
	</div>	
	<div class="v13ImagesDesc" style="width:<?php echo $flypageWidth - 425 ; ?>px;float:right">
		<div id="v13ThumbImage"><h1 class="vmProductName v13ProductName" ><?php echo $product_name ?> <?php echo $edit_link ?></h1>
		<p><?php echo $product_s_desc; ?></p>		
		<p>Referencia: <?php echo $product_sku; ?></p>
		<p class="v12Small"><?php			$number = split('.', $product_price_raw['product_price']);			if(strlen($number[1]) < 2) { $resultNumber = number_format($product_price_raw['product_price'],2); }			else	{ $resultNumber = $dbNumber;	}			$number = split('.', $product_price_raw['product_base_price']);			if(strlen($number[1]) < 2) { $resultNumber1 = number_format($product_price_raw['product_price'],2); }			else	{ $resultNumber1 = $dbNumber;	}
			if($product_price_raw['product_price'] != $product_price_raw['product_base_price']) {
				echo '<span class="v10BrowseDiscount" style="font:normal 14px/18px arial,sans-serif">'.$CURRENCY_DISPLAY->symbol.$resultNumber1.'</span>&nbsp;'; }
			echo '<span class="v10BrowsePrice" style="font-size:bold 22px/30px arial,sans-serif">'.$CURRENCY_DISPLAY->symbol.$resultNumber.'</span>';
		?></p>
		<!-- <p class="v12Small"><?php echo $product_availibility; ?></p>
		<p class="v12Small"><?php echo $product_special; ?></p>
		<p class="v12Small"><?php echo $product_in_stock; ?></p> -->
		</div>
		<div style="clear:both;"></div>
		<table cellpadding=0 cellspacing=0 border=0 width="100%">
			<tr>
				<td>
				<?php echo $addtocart ?>
				</td>
			</tr>
		</table>
	</div>
	<div style="clear:both;"></div>
</div>
<?php echo $this->getProductTestimonial("from our customers", $_GET['product_id']); ?>
<div class="vmDetails v12Details" style="float:left;width:60%">
<?php
if ($this->get_cfg('showButtons') == 1) {
	echo $buttons_header.'<br style="clear:both" />';
	}
?>
</div>
<br style="clear:both">
<div class="vmFlyPageBottom">
	
	<ul id="vmtabs" class="shadetabs">
	<li class="selected"><a href="#" rel="desc">Descripcion</a></li>
	<li><a href="#" rel="reviews">Revision de Productos</a></li>
	<li><a href="#" rel="related">Productos Relacionados</a></li>
	</ul>
	<div class="vmTabContent">
	<div class="vmTabSub">
	<div class="vmTabSubInner">
	<strong>Producto:</strong> <?php echo $product_name ?>
	</div>	
	</div>	
	
	<div class="vmTabContentInner">
		<div id="desc" class="tabcontent">
			<span class="vmProductDesc"><?php echo $product_description ?></span>
			<?php if( $this->get_cfg('showManufacturerLink')) { ?>
				<?php echo $manufacturer_link ?><br />
			<?php } ?>

			<div id="vmAskSeller" style="width:229px"><?php echo $ask_seller ?></div>
			<br />
			<?php echo $product_packaging ?><br />
			
			
			<span style="font-style: italic;"><?php echo $file_list ?></span>
			<?php if( $this->get_cfg( 'showAvailability' )) {
						echo $product_availability; 
					}?><br />
		</div>

		<div id="reviews" class="tabcontent">
		<div class="vmReviews v1Reviews">
			<?php echo $product_reviews ?>
		</div>
			<?php echo $product_reviewform ?>
		
		</div>
		
		<div id="related" class="tabcontent">
		
			<?php echo $related_products ?>
		
		</div>
	  </div>
	</div>

	<script type="text/javascript">

	var countries=new ddtabcontent("vmtabs")
	countries.setpersist(true)
	countries.setselectedClassTarget("link") //"link" or "linkparent"
	countries.init()

	</script>
	
	<br style="clear:both">

	<?php echo $product_type ?>
	
	
	<?php if( $this->get_cfg('showVendorLink')) { ?>
		<?php echo $vendor_link ?><br />	
	<?php  } ?>

	
<?php 
