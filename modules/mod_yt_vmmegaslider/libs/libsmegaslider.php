<?php
/*------------------------------------------------------------------------
# YT Virtuemart Mega Slider - Version 1.0
# Copyright (C) 2009-2011 The YouTech Company. All Rights Reserved.
# @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Author: The YouTech Company
# Websites: http://www.ytcvn.com
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );

if(!class_exists("YtMegaSlider")){

class YtMegaSlider {

	public $id = '';
	public $items = array();
    public $customUrl = array();
	public $arrCustomUrl = array();
    public $limit = 5;
	public $auto = '0';
	public $speed = '200';
	public $pause = '1';
	public $element_number = '1';
	public $btnNext = '';
	public $btnPre = '';
	public $thumb_width = '40';
	public $thumb_height = '40';
    public $small_thumb_width = '0';
	public $small_thumb_height = '0';
	public $theme = 'default';
	public $web_url = '';
	public $no_image_message = '';
	public $thumb_padding = '4';
	public $jquery_enable = '1';
	public $start = 0;
	public $scroll = '1';
	public $vertical = 0;
	public $target = 'pop-up';
	/*Enable*/
	public $enable_navigation = '1';
	public $enable_summary = '1';
	public $enable_title = '1';
	public $enable_image = '1';
	public $enable_description = '1';
	public $showreadmore = 0;
	public $note = '';
	public $cropresizeimage = 0;
	public $max_title = 0;
	public $max_description = 0;
    public $max_normal_description = 0;
	public $resize_folder = '';
	public $url_to_resize = '';
	public $url_to_module = '';
    
    
	function YtMegaSlider() {

	}
	function process() {
		$items = array();
		/*Check elements*/
		if (sizeof($this->items) < $this->element_number ) {

			 $this->element_number = sizeof($this->items);
		}
		foreach ($this->items as $key => $item) {

			if (!isset($item['sub_normal_title'])) {
				$item['sub_normal_title'] = $this->cutStr($item['title'], $this->max_normal_title);
			}
            if (!isset($item['sub_main_title'])) {
				$item['sub_main_title'] = $this->cutStr($item['title'], $this->max_main_title);
			}

            //var_dump($item);die;

			if (!isset($item['sub_main_content'])) {
                if($this->cutStr_style == 'keeping'){
			         $item['sub_main_content'] = $this->mb_cutsubstrws($item['content'], $this->max_main_description);
			     }else{
			         $item['sub_main_content'] = $this->cutStr($item['content'], $this->max_main_description);
			     }
			}
			if (!isset($item['sub_normal_content'])) {
				$item['sub_normal_content'] = $this->cutStr($item['content'], $this->max_normal_description);
			}
			if (!isset($item['thumb'])){
				$item['thumb'] = $this->processImage($item['img'], $this->thumb_width, $this->thumb_height, $item['product_id']);
			}
            if (!isset($item['small_thumb'])){
				$item['small_thumb'] = $this->processImage($item['img'], $this->small_thumb_width, $this->small_thumb_height, $item['product_id']);
			}
			$this->items[$key] = $item;
		}
        //var_dump($this->items);die;
	}
    
    function getArrURL() {
            $arrUrl = array();
            $tmp = explode("\n", trim($this->customUrl));
            foreach( $tmp as $strTmp){
                $pos = strpos($strTmp, ":");
                if($pos >=0){
                    $tmpKey = substr($strTmp, 0, $pos);
                    $key = trim($tmpKey);
                    $tmpLink = substr($strTmp, $pos+1, strlen($strTmp)-$pos);
                    $haveHttp =  strpos(trim($tmpLink), "http://");
                    if($haveHttp <0 || $haveHttp == false){
                        $link = "http://" . trim($tmpLink);
                    } else {
                        $link = trim($tmpLink);
                    }
                    $arrUrl[$key] = $link;
                }
            }
            return $arrUrl;
        }
        
        function processImage($img, $width, $height, $id){
    	   $imagSource = JPATH_SITE.DS. str_replace( '/', DS,  $img );
    		if(file_exists($imagSource) && is_file($imagSource)){
        		if ($this->cropresizeimage == 0){
        			return $this->resizeImage($img, $width, $height, $id);
        		} else {
        			return $this->cropImage($img, $width, $height, $id);
        		}
    
            } else{
    
                return '';
    	   }
    	}

    function resizeImage($imagePath, $width, $height, $id) {
		global $module;
		include_once("includes/simpleimage.php");
		$folderPath = $this->resize_folder;
		 if(!JFolder::exists($folderPath)){
		 		JFolder::create($folderPath);
		 }
         
        $wi = (strpos("px",$width))?substr($width,0,strlen($width)-2):$width;
        $he = (strpos("px",$height))?substr($height,0,strlen($height)-2):$height;
        
        $nameImg = "resized_".$this->theme.'_'. $id .'_'.$wi."x".$he."_".str_replace('/','',strrchr($imagePath,"/"));

		 if(!JFile::exists($folderPath.DS.$nameImg)){
			 $image = new SimpleImage();
	  		 $image->load($imagePath);
	  		 $image->resize($width,$height);
	   		 $image->save($folderPath.DS.$nameImg);
		 }else{
		 		 list($info_width, $info_height) = @getimagesize($folderPath.DS.$nameImg);
		 		 if($width!=$info_width||$height!=$info_height){
		 		 	 $image = new SimpleImage();
	  				 $image->load($imagePath);
	  				 $image->resize($width,$height);
	   				 $image->save($folderPath.DS.$nameImg);
		 		 }
		 }
   		 return $this->url_to_resize . $nameImg;
	}

	function cropImage($imagePath, $width, $height, $id) {
		global $module;
		include_once("includes/simpleimage.php");
		 $folderPath = $this->resize_folder;

		 if(!JFolder::exists($folderPath)){
		 		JFolder::create($folderPath);
		 }

		 $nameImg = "crop_".$this->theme.'_'. $id .'_'. $width. '__'. $height. str_replace('/','',strrchr($imagePath,"/"));
		 if(!JFile::exists($folderPath.DS.$nameImg)){

			 $image = new SimpleImage();

	  		 $image->load($imagePath);

	  		 $image->crop($width,$height);

	   		 $image->save($folderPath.DS.$nameImg);
		 }else{

		 		 list($info_width, $info_height) = @getimagesize($folderPath.DS.$nameImg);
//echo $info_width. '----'. $info_height. ';';
		 		 if($width!=$info_width||$height!=$info_height){
		 		 	 $image = new SimpleImage();
	  				 $image->load($imagePath);
	  				 $image->crop($width,$height);
	   				 $image->save($folderPath.DS.$nameImg);
         
		 		 }
		 }
   		 return $this->url_to_resize . $nameImg;
	}

	/*Cut string*/

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


?>