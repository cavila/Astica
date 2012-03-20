<?php 
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
* This is the theme's function file.
* It allows you to declare additional functions and classes
* that may be used in your templates 
*
* @version $Id: theme.php 1427 2008-06-18 20:04:01Z soeren_nb $
* @package VirtueMart
* @subpackage themes
* @copyright Copyright (C) 2006-2008 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
global $mainframe;

// include the stylesheet for this template

if( vmIsJoomla('1.0') && mosGetParam($_REQUEST,'option') != VM_COMPONENT_NAME) {
	// This can only be a call from a module or mambot
	// In Joomla 1.0 it is not possible to add a JS or CSS into the HEAD from a module or content mambot,
	// using addcustomheadtag, that's why we just print the tags here
	echo vmCommonHTML::scriptTag(VM_THEMEURL.'theme.js');
	echo vmCommonHTML::linkTag(VM_THEMEURL.'theme.css');
	echo vmCommonHTML::linkTag(VM_THEMEURL.'browse.css');
	} else {
	$vm_mainframe->addStyleSheet( VM_THEMEURL.'theme.css' );
	$vm_mainframe->addStyleSheet( VM_THEMEURL.'browse.css' );
	$vm_mainframe->addScript( VM_THEMEURL.'theme.js' );
	}
	
class vmTheme extends vmTemplate  {
	
	function vmTheme() {
		parent::vmTemplate();
		vmCommonHTML::loadMooTools();
	}
	
	function vmLoadjQuery() {
		$html = ' <script type="text/javascript">
			if (typeof jQuery == \'undefined\') {  
				document.write("<script src=\'https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js\'><\/script>");
			}</script>';
		return $html;
	}
	
	function vmLoadjQzoom() {
		global $VM_LANGS;
		$html = '<script src="'.VM_THEMEURL.'js/jqzoom.pack.1.0.1.js" type="text/javascript"></script>
			<script src="'.VM_THEMEURL.'js/jquery.jqzoom1.0.1.js" type="text/javascript"></script>
			<link rel="stylesheet" type="text/css" href="'.VM_THEMEURL.'css/jqzoom.css" />
			<script type="text/javascript">
			jQuery(function() {
				jQuery(".jqzoom").jqzoom();
			});
			</script>';		
		return $html;
		}
	
	function vmBuildFullImageLink( $product ) {
		global $VM_LANG;
		
		$product_image = '';
		
		$img_attributes= 'alt="'.$product['product_name'].'"';
		
		/* Wrap the Image into an URL when applicable */
		if ( @$product["product_url"] ) {
			$product_image = "<a href=\"". $product["product_url"]."\" title=\"".$product['product_name']."\" target=\"_blank\">";
			$product_image .= ps_product::image_tag($product['product_thumb_image'], $img_attributes, 0);
			$product_image .= "</a>";
		}
		/* Show the Thumbnail with a Link to the full IMAGE */
		else {
			if( empty($product['product_full_image'] ) ) {
				$product_image = "<img src=\"".VM_THEMEURL.'images/'.NO_IMAGE."\" alt=\"".$product['product_name']."\" border=\"0\" />";
			}
			else {
				// file_exists doesn't work on remote files,
				// so returns false on remote files
				// This should fix the "Long Page generation bug"
				if( file_exists( IMAGEPATH.'product/'.$product['product_full_image'] )) {
		
					/* Get image width and height */
					if( $image_info = @getimagesize(IMAGEPATH.'product/'.$product['product_full_image'] ) ) {
						$width = $image_info[0] + 20;
						$height = $image_info[1] + 20;
					}
				}
				else {
					$width = 640;
					$height= 480;
				}
				if( stristr( $product['product_full_image'], "http" ) ) {
					$imageurl = $product['product_full_image'];
				}
				else {
					$imageurl = IMAGEURL.'product/'.rawurlencode( $VM_LANG->convert($product['product_full_image']));
				}
				/* Build the "See Bigger Image" Link */
				if( @$_REQUEST['output'] != "pdf" && $this->get_cfg('useLightBoxImages', 1 ) ) {
					$link = $imageurl;
					$text = ps_product::image_tag($product['product_thumb_image'], $img_attributes, 0)."<br/>".$VM_LANG->_('PHPSHOP_FLYPAGE_ENLARGE_IMAGE');

					$product_image = vmCommonHTML::getLightboxImageLink( $link, $text, $product['product_name'], 'product'.$product['product_id'] );
				}
				elseif( @$_REQUEST['output'] != "pdf" ) {
					$link = $imageurl;
					$text = ps_product::image_tag($product['product_thumb_image'], $img_attributes, 0)."<br/>".$VM_LANG->_('PHPSHOP_FLYPAGE_ENLARGE_IMAGE');
					// vmPopupLink can be found in: htmlTools.class.php
					$product_image = vmPopupLink( $link, $text, $width, $height );
				}
				else {
					$product_image = "<a href=\"$imageurl\" target=\"_blank\">"
									. ps_product::image_tag($product['product_thumb_image'], $img_attributes, 0)
									. "</a>";
				}
			}
		}
		return $product_image;
	}
	
	/**
	 * Builds a list of all additional images
	 *
	 * @param int $product_id
	 * @param array $images
	 * @return string
	 */	
	function vmlistPBV6AdditionalImages( $product_id, $images, $script, $flypage=980, $wresize=100, $hresize=75,  $title='', $limit=1000 ) {
		global $sess, $mosConfig_live_site, $VM_LANG;
		$html = '';
		$i = 0;
		foreach( $images as $image ) { 
			if ($script == 1) {
					$thumbtag = '<img src="'.VM_THEMEURL.'scripts/timthumb.php?src='.$image->file_name.'&w='.$wresize.'&h='.$hresize.'&a=c&q=75" class="browseProductImage">';
			} else {
				$thumbtag = ps_product::image_tag( $image->file_name, 'class="browseProductImage"', 1, 'product', $image->file_image_thumb_width, $image->file_image_thumb_height );
			}
			$fulladdress = $sess->url( 'index2.php?page=shop.view_images&amp;image_id='.$image->file_id.'&amp;product_id='.$product_id.'&amp;pop=1' );
			
			$html .=				
				'<div class="showcase-slide">
						<div class="showcase-content">
				<img src="'.VM_THEMEURL.'scripts/timthumb.php?src='.$mosConfig_live_site.$image->file_name.'&w='.$flypage.'&q=75" alt="'.$image->file_title.'" title="'.$image->file_title.'" />
				</div>
				<div class="showcase-thumbnail">
					'.$thumbtag.'
					<div class="showcase-thumbnail-cover"></div>
				</div>
			</div>';
			if( ++$i > $limit ) break;
		}
		return $html;
	}	
	
	function vmlistPBV7AdditionalImages( $product_id, $images, $title='', $limit=1000 ) {
		global $sess, $mosConfig_live_site, $VM_LANG;
		$html = '';
		foreach( $images as $image ) { 
			$html .= '<span class="vmTinyImage"><a href="'.$mosConfig_live_site.$image->file_name.'" class="cloud-zoom-gallery" title="'.$image->file_title.'" rel="useZoom: \'zoom1\', smallImage: \''.VM_THEMEURL.'scripts/timthumb.php?src='.$mosConfig_live_site.$image->file_name.'&w=400&q=90\' ">';
			$html .= '<img src="'.VM_THEMEURL.'scripts/timthumb.php?src='.$mosConfig_live_site.$image->file_name.'&w=85&h=65&a=c&q=65" alt = "'.$image->file_title.'"/></a></span>';
        }
		return $html;
	}	
	
	function vmlistBrowseAdditionalImages( $product_id, $thumbImageWidth=100,  $limit=1000 ) {
		global $sess, $mosConfig_live_site;
		$db =& JFactory::getDBO();
		$query = 'SELECT * FROM #__vm_product_files WHERE file_product_id = '.$product_id.' AND file_published = 1 AND file_is_image = 1 LIMIT 0, 2';
		$db->setQuery( $query );
		$testimonial = $db->loadRowList();		
		$html = '';
		//print_r($testimonial);
		foreach( $testimonial as $image ) { 
			$html .= '<img src="'.VM_THEMEURL.'scripts/timthumb.php?src='.$mosConfig_live_site.$image[2].'&w=50&h=40&a=c&q=75" />';
		}
		return $html;
	}
	/**
	 * Builds a list of all additional images
	 *
	 * @param int $product_id
	 * @param array $images
	 * @return string
	 */
	function vmlistAdditionalImages( $product_id, $images, $title='', $limit=1000 ) {
		global $sess;
		$html = '';
		$i = 0;
		foreach( $images as $image ) { 
			$thumbtag = ps_product::image_tag( $image->file_name, 'class="browseProductImage"', 1, 'product', $image->file_image_thumb_width, $image->file_image_thumb_height );
			$fulladdress = $sess->url( 'index2.php?page=shop.view_images&amp;image_id='.$image->file_id.'&amp;product_id='.$product_id.'&amp;pop=1' );
			
			if( $this->get_cfg('useLightBoxImages', 1 )) {
				$html .= vmCommonHTML::getLightboxImageLink( $image->file_url, $thumbtag, $title ? $title : $image->file_title, 'product'.$product_id );
			}
			else {
				$html .= vmPopupLink( $fulladdress, $thumbtag, 640, 550 );
			}
			$html .= ' ';
			if( ++$i > $limit ) break;
		}
		return $html;
	}
	
	/**
	 * Builds the "more images" link
	 *
	 * @param array $images
	 */
	function vmMoreImagesLink( $images ) {
		global $mosConfig_live_site, $VM_LANG, $sess;
		/* Build the JavaScript Link */
		$url = $sess->url( "index2.php?page=shop.view_images&amp;flypage=".@$_REQUEST['flypage']."&amp;product_id=".@$_REQUEST['product_id']."&amp;category_id=".@$_REQUEST['category_id']."&amp;pop=1" );
		$text = $VM_LANG->_('PHPSHOP_MORE_IMAGES').'('.count($images).')';
		$image = vmCommonHTML::imageTag( VM_THEMEURL.'images/more_images.png', $text, '', '16', '16' );
		
		return vmPopupLink( $url, $image.'<br />'.$text, 640, 550, '_blank', '', 'screenX=100,screenY=100' );
	}
	
	function vmFlypageTabs( $TAB_TYPE ) {
		global $VM_LANGS;
		$html = '
			<link rel="stylesheet" type="text/css" href="'.VM_THEMEURL.'css/tabcontent'.$TAB_TYPE.'.css" />
			<script type="text/javascript" src="'.VM_THEMEURL.'js/tabcontent.js">

			/***********************************************
			* Tab Content script v2.2- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
			* This notice MUST stay intact for legal use
			* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
			***********************************************/
			</script>';
		$html .= '<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("ul#vmtabs li a").click(function() {
						jQuery("ul#vmtabs li").removeClass("selected");
						jQuery(this).parents().addClass("selected");
						return false;
					});
				});
			</script>
			<!--[if gte IE 6]>
			<style type="text/css">

			ul#navigation li.selected a:link, ul#navigation li.selected a:visited {
				filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#d1d1d1\', endColorstr=\'#f2f2f2\'); /* IE6,IE7 */
				-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#d1d1d1\', endColorstr=\'#f2f2f2\')"; /* IE8 */
			}
			</style>
			<![endif]-->
			';
		return $html;
		}
			
	function vmGetImageSize( $path, $product_thumb_image, $flypageWidth=700, $fullPage=1 ) {
		// Dynamic Image Resize check
		$file = $path.'product/'.$product_thumb_image;
		list($width, $height, $type, $attr) = @getimagesize($file);
		/* if (file_exists($file)) {
			list($width, $height, $type, $attr) = @getimagesize($file);
		} else {
			echo 'NOT NOT';
			$parsed = array();
			$array = array();
			$url = $product_thumb_image;
			$parsed = parse_url($url);
			@parse_str($parsed[query], $array);
			list($width, $height, $type, $attr) = @getimagesize($path.$array["filename"]);
		}	*/
		if ($fullPage == 1) {
			if ($width > $flypageWidth) {
				$height = $height * ($flypageWidth / $width);
				$width = $flypageWidth;
			}
		}	
		$var = array($width, $height);
		return $var;
	}
	
	function vmCheckEmpty($variable){ 
		if($variable == NULL || $variable == '' || strlen($variable) < 1){ 
			$isempty = true; 
			echo "TRUE";
		} else { 
			$isempty = false; 
			echo "FALSE";
		} 

		return($isempty); 
	} 
	
	function resizeThumbnails($target,$width,$height, $side=0) {
		if ($width != '' && $height != '') {
			if ($side == 0) {
				$percentage = ($target / $width);
			} else {
				$percentage = ($target / $height);
			}
			//gets the new value and applies the percentage, then rounds the value
			$width = round($width * $percentage);
			$height = round($height * $percentage);
			$returnVar = array($width,$height);
			return $returnVar;	
		}
	}
	
	function getProductTestimonial($num = 1, $phrase = NULL, $product_id = 0)
	{
		global $mosConfig_live_site;
		$db =& JFactory::getDBO();
		$query = 'SELECT * FROM #__pbvtestimonial WHERE product_id = '.$product_id.' AND published = "yes"';
		$html = '';		
		jimport('joomla.application.component.helper');

		if(JComponentHelper::isEnabled('com_pbvtestimonial', true))
		{
			$db->setQuery( $query );
			$testimonial = $db->loadRowList();
			
			if(count($testimonial) < 1) {
				$query = 'SELECT * FROM #__pbvtestimonial WHERE product_id = 0 AND published = "yes"';
				$db->setQuery( $query );
				$testimonial = $db->loadRowList();
				}
			$html .= '<link rel="stylesheet" href="'.$mosConfig_live_site.'/components/com_pbvtestimonial/css/pbvtestimonial.css" type="text/css" />';
			$count = count($testimonial);
			if(!$count == 0 ) {
				$rand = rand(1, $count)-1;
				if ($num < $count) { $endVal = $num; } elseif ($count < $num) { $endVal = $count; } else { $endVal = $count; }
				
				for ($i=0; $i<$endVal; $i++) {
					$html .= '<div class="pbvTestimonialContainer">';
					if(!$phrase == NULL) {
						$html .= '<span class="pbvTestimonialPhrase">'.$phrase.'</span>';
						}
					$html .= '<div class="pbvTestimonial">"'.$testimonial[$i][5].'"</div>';
					$html .= '<div class="pbvTestimonialName">'.$testimonial[$i][1].', ';
					if (strlen($testimonial[$i][2]) > 0) {
						$html .= $testimonial[$i][2].', ';
					}
					if (strlen($testimonial[$i][3]) > 0) {
						$html .= '<span class="pbvTestimonialLink"><a href="http://'.$testimonial[$i][3].'" target="_blank">'.$testimonial[$i][3].'</a></span>';
					}
					$html .= '</div></div>';
				}
					
				return $html;
			}
		}
	}
	
	function getDiscountDate($var_product_sku) {
		$db =& JFactory::getDBO();
		$query = 'SELECT product_discount_id FROM #__vm_product WHERE product_sku = "'.$var_product_sku.'"';
		$db->setQuery( $query );
		$discount_id = $db->loadResult();
		if ($discount_id > 0) {
			$query2 = 'SELECT end_date FROM #__vm_product_discount WHERE discount_id = '.$discount_id;
			$db->setQuery( $query2 );
			$discount_end_date = $db->loadResult();
			if ($discount_end_date == 0) {
				$discount_end = "Promotional Price";
			} else {
				$discount_end = date('d/m/Y', $discount_end_date);
				}
		}
		return $discount_end;
	}
	
	function getProductid($product_sku) {
		$db =& JFactory::getDBO();
		$query = 'SELECT product_id FROM #__vm_product WHERE product_sku = "'.$product_sku.'"';
		$db->setQuery( $query );
		$product_id = $db->loadResult();
		return $product_id;
	}
	
	function vmProductVideo($file_video, $width, $height) {
		global $VM_LANGS;
		$html = '<script type="text/javascript" src="'.VM_THEMEURL.'js/flowplayer-3.2.4.min.js"></script>
		<script type="text/javascript" src="'.VM_THEMEURL.'js/flowplayer.ipad-3.2.1.js"></script>
<div style="display:inline;"><a  href="'.$file_video.'"  style="display:block;width:'.$width.'px;height:'.$height.'px"  id="ipad"> </a> 	
<!-- this will install flowplayer inside previous A- tag. -->
	<script>
		flowplayer("ipad", "'.VM_THEMEURL.'js/flowplayer-3.2.5.swf", {"clip":{"url":"'.$file_video.'",autoPlay: false, autoBuffering: true},"screen":{"height":"100pct","top":0},"plugins":{"controls":{"borderRadius":"0px","timeColor":"#ffffff","slowForward":true,"bufferGradient":"none","backgroundColor":"rgba(0, 0, 0, 0.3)","volumeSliderGradient":"none","slowBackward":false,"timeBorderRadius":20,"progressGradient":"none","time":true,"height":26,"volumeColor":"#4599ff","tooltips":{"marginBottom":5,"volume":true,"scrubber":true,"buttons":false},"fastBackward":false,"opacity":1,"timeFontSize":12,"border":"0px","bufferColor":"#a3a3a3","volumeSliderColor":"#ffffff","buttonColor":"#ffffff","mute":true,"autoHide":{"enabled":true,"hideDelay":800,"hideStyle":"slide","mouseOutDelay":800,"hideDuration":600,"fullscreenOnly":false},"backgroundGradient":"none","width":"100pct","display":"block","sliderBorder":"1px solid rgba(128, 128, 128, 0.7)","buttonOverColor":"#ffffff","fullscreen":true,"timeBgColor":"rgb(0, 0, 0, 0)","scrubberBarHeightRatio":0.2,"bottom":0,"stop":false,"sliderColor":"#000000","zIndex":1,"scrubberHeightRatio":0.6,"tooltipTextColor":"#ffffff","sliderGradient":"none","spacing":{"time":6,"volume":8,"all":2},"timeBgHeightRatio":0.8,"volumeSliderHeightRatio":0.6,"name":"controls","timeSeparator":" ","volumeBarHeightRatio":0.2,"left":"50pct","tooltipColor":"rgba(0, 0, 0, 0)","playlist":false,"durationColor":"#b8d9ff","play":true,"fastForward":true,"timeBorder":"0px solid rgba(0, 0, 0, 0.3)","progressColor":"#4599ff","volume":true,"scrubber":true,"builtIn":false,"volumeBorder":"1px solid rgba(128, 128, 128, 0.7)","margins":[2,6,2,12]}}}).ipad();
	</script></div>';
	return $html;
	}
		
	function getReviewStars($var_product_id) {
		global $VM_LANGS;
		$db =& JFactory::getDBO();
		$query = "SELECT user_rating FROM jos_vm_product_reviews WHERE product_id='".$var_product_id."'";
		$db->setQuery( $query );
		$column= $db->loadResultArray();
		$review_total = NULL;
		$review_num = 0;
		foreach ($column as $value) {
			$review_total = $review_total + $value;
			$review_num = $review_num + 1;
			}
		if ($review_num == 0) {
			$review_total = '<img src="'.VM_THEMEURL.'images/stars/00.png"> ('.$review_num.' ratings)';
		} else {
			$review_total = $review_total / $review_num;
			$review_total = '<img src="'.VM_THEMEURL.'images/stars/'.$review_total.'.png"> ('.$review_num.' ratings)';
		}
		return $review_total;
	}
	// Your code here please...
	
}
?>