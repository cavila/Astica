<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); ?>
<?php 
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
$flypage = $this->get_cfg('flypageWidth');
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>

<div class="vmBrowseContainer v4BrowseContainer">  	
	<div class="vmBrowseImage v4BrowseImage" style="float:left;width:<?php echo $width1 + 20 ;?>px" >
		<a title="<?php echo $product_name ?>" href="<?php echo $product_flypage ?>">
		<div class="panel">
			<img class="largeImage" src="<?php echo VM_THEMEURL.'scripts/timthumb.php?src='.$product_full_image; ?>&w=<?php echo $width1 ?>&q=65" />
		</div>
		<div class="thumbs">
			<img src="<?php echo VM_THEMEURL.'scripts/timthumb.php?src='.$product_full_image; ?>&w=50&h=40&a=c&q=75" alt="<?php echo $product_title; ?>" />
			<?php echo $this->vmlistBrowseAdditionalImages($this->getProductid($product_sku)); ?>		
		</div>
		</a>
	</div>		
    <div style="float:left;border:0px solid red;padding-left:10px;width:<?php echo $flypage - $width1 - 75; ?>px">
		<div class="vmBrowseProductTitle v4BrowseProductTitle">
		<?php if (strlen($form_addtocart) > 0):  ?>
			<div class="v4BrowsePriceBox">		
				<div class="vmCatPrice v4CatPrice" ><?php echo $form_addtocart ?></div>		
			</div>
		<?php endif; ?>
		<a href="<?php echo $product_flypage ?>"><?php echo $product_name ?></a><br />		
		<div style="float:left;padding:5px 0px;"><?php echo $product_price ?><br />
		<div style="display:inline;margin:5px 0 0;float:left;"><?php echo $this->getReviewStars($product_id); ?></div></div><br style="clear:both;" />			
		<div style="display:inline;float:left;"><?php echo substr($product_s_desc,0,150) ?>...</div>
		</div>
	</div>
</div>
