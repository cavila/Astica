 <?php 
/*------------------------------------------------------------------------
 # Yt Virtuemart Mega Slider  - Version 1.0
 # Copyright (C) 2010-2011 The YouTech Company. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: The YouTech Company
 # Websites: http://www.ytcvn.com
 -------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');
require(dirname(__FILE__).DS.'libs'.DS.'libsmegaslider.php');
if(!class_exists("modVmMegaSlider")){
class modVmMegaSlider {
    var $customUrl = '';
	function getInstance($params){
		$products = modVmMegaSlider::getProducts($params); 
		return $products;
	}
	function getProducts($params){
		global $module;
		$enable_cache 		=   $params->get('cache',1);
		$cachetime			=   $params->get('cache_time',0);
		if($enable_cache==1){			
			$conf =& JFactory::getConfig();
			$cache = &JFactory::getCache($module->module);
			$cache->setLifeTime( $params->get( 'cache_time', $conf->getValue( 'config.cachetime' ) * 60 ) );
			$cache->setCaching(true);
			$cache->setCacheValidation(true);
			$products =  $cache->get( array('modVmMegaSlider', 'getListProducts'), array($params));
		}else{
			$products = modVmMegaSlider::getListProducts($params);
		}
		return 	$products;
	}
	function getListProducts($params){
		$db = &JFactory::getDBO();
		global $mosConfig_absolute_path;
		global $CURRENCY_DISPLAY, $VM_LANG, $vars;
        $showimage			=   $params->get('showimage',1);
        $showtitle			=   $params->get('showtitle',1);
        $showdescription	=   $params->get('showdescription',1);
        $totalarticles		=   $params->get('totalarticles',6);
        $target       =   $params->get('target','');
        
        $customUrl	= $params->get('customUrl','');
        $limitcharacter     =   $params->get('limitdescription',200);
        $limit_normal_description     =   $params->get('limit_normal_description ',200);
        $limitTitle	       	=   $params->get('limittitle',25);	
		$showreadmore		=   $params->get('showreadmore',1);
        $show_special_product		=   $params->get('show_special_product',1);
        $small_thumb_height = $params->get('small_thumb_height', "0");
		$small_thumb_width = $params->get('small_thumb_width', "0");
       	$arrCustomUrl = modVmMegaSlider::getArrURL($params->get('customUrl',''));
		if( file_exists(dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' )) {
			require_once( dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' );
		} else { 
			require_once( dirname(__FILE__).'/../components/com_virtuemart/virtuemart_parser.php' );
		}		
		$sortfield = $params->get("sort_order_field","created"); //echo $sortfield;die;
		$sort  = $params->get("sort_order","DESC");
        $theme = $params->get("theme","default");
        $limit = $params->get('total', 5);
        $max_items = $params->get( 'totalproducts', 5 ); //maximum number of items to display
        $featured = $params->get('featured',2);
		$category_ids = $params->get( 'vmcategory', null ); // Display products from this category only		
		$show_price = (bool)$params->get( 'show_price', 1 ); // Display the Product Price?
		require_once( CLASSPATH . 'ps_product.php');
		$ps_product = new ps_product;
		global $sess, $mm_action_url, $db;
        $auth = $_SESSION['auth'];
        
		$q  = "SELECT #__vm_product.*, #__vm_category.category_id, #__vm_product_price.product_price, #__vm_product_price.shopper_group_id FROM #__vm_product INNER JOIN  #__vm_product_category_xref ON #__vm_product.product_id=#__vm_product_category_xref.product_id INNER JOIN #__vm_category ON #__vm_category.category_id=#__vm_product_category_xref.category_id LEFT JOIN #__vm_product_price ON #__vm_product_price.product_id=#__vm_product.product_id WHERE ";
		$q .= "product_parent_id=''";
        $cat_id = '';
        if(is_array($category_ids)){
            foreach($category_ids as $tmp_id){
                $cat_id .= $tmp_id.',';
            }
			
			$cat_id = substr($cat_id,0,strlen($cat_id)-1);
        } else {
			$cat_id = $category_ids;
		}
       
       
		if( !empty( $cat_id ) ) {

			$q .= "AND #__vm_category.category_id in (". $cat_id .") ";

		}     
		if( CHECK_STOCK && PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS != "1") {

			$q .= " AND product_in_stock > 0 ";

		}

		$q .= "AND #__vm_product.product_publish='Y' ";

		
        if ($featured == '0') {

			$q .= "AND #__vm_product.product_special!='Y' \n";

		}elseif ($featured == '1') {

			$q .= "AND #__vm_product.product_special='Y' \n";

		}
        $q .= 'GROUP BY #__vm_product.product_id';
        if ($sortfield == 'random') {                

            $q .= ' ORDER BY rand()';            

        }
        elseif($sortfield == 'cdate'){
            $sortfield = 'cdate';
            $sort = 'DESC';
            $q .= " ORDER BY {$sortfield} {$sort} ";
        }
        elseif($sortfield == 'mdate'){
            $sortfield = 'mdate';
            $sort = 'DESC';
            $q .= " ORDER BY {$sortfield} {$sort} ";
        }
        elseif($sortfield == 'product_price_high'){
            $sortfield = 'product_price';
            $sort = 'DESC';
            $q .= " ORDER BY {$sortfield} {$sort} ";
        }
        elseif($sortfield == 'product_price_low'){
            $sortfield = 'product_price';
            $sort = 'ASC';
            $q .= " ORDER BY {$sortfield} {$sort} ";
        }
        elseif($sortfield == 'bestseller'){
            $sortfield = 'product_sales';
            $sort = 'DESC';
            $q .= " ORDER BY {$sortfield} {$sort} ";
        }
        elseif($sortfield == 'worstseller'){
            $sortfield = 'product_sales';
            $sort = 'ASC';
            $q .= " ORDER BY {$sortfield} {$sort} ";
        }
        elseif($sortfield == 'product_name'){
            $sortfield = 'product_name';
            $sort = 'ASC';
            $q .= " ORDER BY {$sortfield} {$sort} ";
        }
        else {                
            $q .= " ORDER BY {$sortfield} {$sort} ";    
        }
		$q .= "LIMIT 0, $limit ";         
		$db->query($q);
		$items  = array();
		if( $db->num_rows() > 0 ){ 
			while($db->next_record() ){
				$detail = array();
				$cid = $db->f("category_id");
				if($showimage==0||!$showimage){
					$detail["img"] = "";
				}else{
					$detail["img"] = "components/com_virtuemart/shop_image/product/" . $db->f("product_full_image");
				}
				if($showtitle==0||!$showtitle){
					$detail["title"] = "";
				}else{
					$detail["title"] = $db->f("product_name");					
				}
				if($showdescription==0 || !$showdescription || $limitcharacter==0){
					$detail["content"] = "";
				}else{									
					$detail["content"] = $db->f("product_s_desc");
				}
                // Filter price
                $detail["price"] =  $ps_product->show_price($db->f("product_id"), @$auth["show_price_including_tax"], 0);
               
                $pattern= "'<span[^>]*>([^<]*)</span>'si";               
                preg_match_all ($pattern, $detail["price"], $match);
                $detail["current_price"] = '';
                $detail["old_price"] = '';
                
                if (count($match[0]) > 0){
                    if (count($match[0]) == 2) {
                        $detail["current_price"] = trim(strip_tags($match[0][1]));
                        $detail["old_price"] = trim(strip_tags($match[0][0]));
                    } else {
                        $detail["current_price"] = trim(strip_tags($match[0][0]));                
                    }
                    
                }else {                    
                    $pattern= "'<a>(.*?)</a>'si";
                    preg_match ($pattern, $detail["price"], $match); 
                    if (sizeof($match) > 0 && isset($match[1]) && trim($match[1]) != '' ) {
                        $detail["current_price"] = trim($match[1]);
                    }
                }
				if ($db->f("product_parent_id")) {					
					$url = "?page=shop.product_details&category_id=$cid&flypage=".$ps_product->get_flypage($db->f("product_parent_id"));					
					$url .= "&product_id=" . $db->f("product_parent_id");				
				} else {				
					$url = "?page=shop.product_details&category_id=$cid&flypage=".$ps_product->get_flypage($db->f("product_id"));					
					$url .= "&product_id=" . $db->f("product_id");				
				}
                    $detail["product_id"] = $db->f("product_id");
                    
                    if(array_key_exists($detail["product_id"],$arrCustomUrl)){
                        if(isset($arrCustomUrl[$detail["product_id"]]) && ($arrCustomUrl[$detail["product_id"]]) != ""){
                           $product_link = trim($arrCustomUrl[$detail["product_id"]]);
                           if($target=='pop-up'){
                                $popupstrposlink = strpos(trim($product_link),"?");
                                
                                $popupstrlenlink = intval(strlen(trim($product_link))-1);

                                $popuplink = '';
                                if($popupstrposlink>0){
                                    if($popupstrposlink == $popupstrlenlink ){
                                        $popuplink = 'tmpl=component';
                                    }elseif($popupstrposlink != $popupstrlenlink){
                                        $popuplink = '&tmpl=component';
                                    }
                                }else{
                                    $popuplink = '?tmpl=component';
                                }
                                $product_link .= $popuplink;
                            } 
                        }else{
                            $product_link = $sess->url($mm_action_url. "index.php" . $url);
                            if($target=='pop-up'){
                                $popupstrposlink = strpos(trim($product_link),"?");
                                
                                $popupstrlenlink = intval(strlen(trim($product_link))-1);

                                $popuplink = '';
                                if($popupstrposlink>0){
                                    if($popupstrposlink == $popupstrlenlink ){
                                        $popuplink = 'tmpl=component';
                                    }elseif($popupstrposlink != $popupstrlenlink){
                                        $popuplink = '&tmpl=component';
                                    }
                                }else{
                                    $popuplink = '?tmpl=component';
                                }
                                $product_link .= $popuplink;
                            }
                        }
                    }else{
				        $product_link = $sess->url($mm_action_url. "index.php" . $url);
                        if($target=='pop-up'){
                            $popupstrposlink = strpos(trim($product_link),"?");
                            
                            $popupstrlenlink = intval(strlen(trim($product_link))-1);

                            $popuplink = '';
                            if($popupstrposlink>0){
                                if($popupstrposlink == $popupstrlenlink ){
                                    $popuplink = 'tmpl=component';
                                }elseif($popupstrposlink != $popupstrlenlink){
                                    $popuplink = '&tmpl=component';
                                }
                            }else{
                                $popuplink = '?tmpl=component';
                            }
                            $product_link .= $popuplink;
                        }
					}						
                    $detail["link"] = $product_link;
				if ($limitcharacter > 0) {
				} 
                else {
					$detail["content"] = strip_tags($detail["content"]);	
				}
				$detail["product_id"] = $db->f("product_id");
				$items[] = $detail;				
			}	
		}
		return $items;
	}
	function getArrURL($customUrl) {// echo $this->customUrl;die;    
            $arrUrl = array();
            $tmp = explode("\n", trim($customUrl));            
            foreach( $tmp as $strTmp){
                $pos = strpos($strTmp, ":");
                if($pos >=0){
                    $tmpKey = substr($strTmp, 0, $pos);
                    $key = trim($tmpKey);
                    $tmpLink = substr($strTmp, $pos+1, strlen($strTmp)-$pos);
                    $haveHttp =  strpos(trim($tmpLink), "http://");                    
                    if($haveHttp<0 || ($haveHttp !== false) ){
                    $link = trim($tmpLink);
                    }else{
                        $link = "http://" . trim($tmpLink);
                    }
                    $arrUrl[$key] = $link;
                }  
            }            
            return $arrUrl;
        }

	function cutStr( $str, $number){
		//If length of string less than $number
		$str = strip_tags($str);
		if(strlen($str) <= $number){
			return $str;
		}
		$str = substr($str,0,$number);
		$pos = strrpos($str,' ');
		return substr($str,0,$pos).'...';
	}
    function mb_cutsubstrws( $str_text, $number){

        if( (mb_strlen($str_text) > $number) ) {
    
            $whitespaceposition = mb_strpos($str_text," ",$number)-1;
    
            if( $whitespaceposition > 0 ) {
                $chars = count_chars(mb_substr($str_text, 0, ($whitespaceposition+1)), 1);
                //var_dump($chars);die;
                if (isset($chars[ord('<')]) > isset($chars[ord('>')]))
                    $whitespaceposition = mb_strpos($str_text,">",$whitespaceposition)-1;
                $str_text = mb_substr($str_text, 0, ($whitespaceposition+1));
            }
    
            // close unclosed html tags
            if( preg_match_all("|<([a-zA-Z]+)|",$str_text,$aBuffer) ) {
    
                if( !empty($aBuffer[1]) ) {
    
                    preg_match_all("|</([a-zA-Z]+)>|",$str_text,$aBuffer2);
    
                    if( count($aBuffer[1]) != count($aBuffer2[1]) ) {
    
                        foreach( $aBuffer[1] as $index => $tag ) {
    
                            if( empty($aBuffer2[1][$index]) || $aBuffer2[1][$index] != $tag)
                                $str_text .= '</'.$tag.'>';
                        }
                    }
                }
            }
        }
        //var_dump($str_text);die;
        return $str_text;
    }
}

}

if(!class_exists("Browser")){

class Browser

{

    private $props    = array("Version" => "0.0.0",

                                "Name" => "unknown",

                                "Agent" => "unknown") ;



    public function __Construct()

    {

        $browsers = array("firefox", "msie", "opera", "chrome", "safari",

                            "mozilla", "seamonkey",    "konqueror", "netscape",

                            "gecko", "navigator", "mosaic", "lynx", "amaya",

                            "omniweb", "avant", "camino", "flock", "aol");



        $this->Agent = strtolower($_SERVER['HTTP_USER_AGENT']);

        foreach($browsers as $browser)

        {

            if (preg_match("#($browser)[/ ]?([0-9.]*)#", $this->Agent, $match))

            {

                $this->Name = $match[1] ;

                $this->Version = $match[2] ;

                break ;

            }

        }

    }



    public function __Get($name)

    { 

        if (!array_key_exists($name, $this->props))

        {

            die("No such property or function {$name}");

        }

        return $this->props[$name] ;

    }



    public function __Set($name, $val)

    {

        if (!array_key_exists($name, $this->props))

        {

            SimpleError("No such property or function.", "Failed to set $name", $this->props);


        }

        $this->props[$name] = $val ;

    }



}

} 

?>


