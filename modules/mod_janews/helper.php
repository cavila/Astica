<?php
/*------------------------------------------------------------------------
# JA Larix  for Joomla 1.5 - Version 1.4 - Licence Owner JA130602
# ------------------------------------------------------------------------
# Copyright (C) 2004-2008 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: J.O.O.M Solutions Co., Ltd
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE . '/components/com_content/helpers/route.php');

class modJaNewsHelper
{

	function replaceImage( &$row, $align, $autoresize, $maxchars, $showimage, $width = -1, $height = -1 ) {
		global $database, $_MAMBOTS, $current_charset;
	
		$regex = "/\<img\s*src\s*=\s*\"([^\"]*)\"[^\>]*\>/";
		preg_match ($regex, $row->introtext, $matches);
		$images = (count($matches)) ? $matches : array();
		$image = ($showimage && count($images)) ? modJaNewsHelper::processimage ( $images, $width, $height ) : "";

		if ($autoresize) {
			if ($image) {				
				$image = "<img src=\"$image\" alt=\"{$row->title}\" align=\"$align\" />";
			}
			$regex1 = "/\<img.*\/\>/";
			$row->introtext = trim($row->introtext);
			$row->introtext = preg_replace( $regex1, '', $row->introtext );
		} else {
			$regex = "/\<img.*\/\>/";
			preg_match ($regex, $row->introtext, $matches);
			$row->introtext = trim($row->introtext);
			$row->introtext = preg_replace ($regex, '', $row->introtext);

			$image = $showimage && count($matches)?$matches[0]:"";
			if (count($images)) {
				$image = "<img src=\"".$images[1]."\" alt=\"{$row->title}\" width=\"$width\"  heigh=\"$height\" align=\"$align\" />";
			}
		}

		$row->introtext1 = strip_tags($row->introtext);
		if ($maxchars && strlen ($row->introtext) > $maxchars) {
			$row->introtext1 = substr ($row->introtext1, 0, $maxchars) . "...";
		}
		// clean up globals
		return $image;
	}

	function processImage ( &$image, $width, $height ) {
		if(!count($image)) return;
			$img = $image[1] ;
			$img = str_replace(JURI::base(),'',$img);
			$imagesurl = (file_exists(JPATH_SITE .'/'.$img)) ? modJaNewsHelper::jaResize($img,$width,$height) :  $img ;
			return $imagesurl;
	}
	
	function jaResize($image,$max_width,$max_height){
			$path = JPATH_SITE;
			$sizeThumb = getimagesize(JPATH_SITE.'/'.$image);
			$width = $sizeThumb[0];
			$height = $sizeThumb[1];
			$x_ratio = $max_width / $width;
			$y_ratio = $max_height / $height;
			if (($width <= $max_width) && ($height <= $max_height) ) {
				$tn_width = $width;
				$tn_height = $height;
			} else if (($x_ratio * $height) < $max_height) {
				$tn_height = ceil($x_ratio * $height);
				$tn_width = $max_width;
			} else {
				$tn_width = ceil($y_ratio * $width);
				$tn_height = $max_height;
			}
			if(file_exists($path.'/images/resized/'.$image)){
				$smallImg = getimagesize(JPATH_SITE.'/images/resized/'.$image);
				if ($smallImg[0] <= $smallImg[1] && $smallImg[1] != $max_height) {
				} else if ($smallImg[1] <= $smallImg[0] && $smallImg[0] != $max_width) {
				} else {
						return "images/resized/".$image;
				}
			}
			if(!file_exists($path.'/images/resized/')) mkdir($path.'/images/resized/',0755);
			$folders = explode('/',$image);
			$tmppath = $path.'/images/resized/';
			for($i=0;$i < count($folders)-1; $i++){
				if(!file_exists($tmppath.$folders[$i])) mkdir($tmppath.$folders[$i],0755);
				$tmppath = $tmppath.$folders[$i].'/';
			}
			$resized = $path.'/images/resized/'.$image;
			// read image
			$ext = strtolower(substr(strrchr($image, '.'), 1)); // get the file extension
			switch ($ext) { 
				case 'jpg':     // jpg
					$src = imagecreatefromjpeg(JPATH_SITE.'/'.$image);
					break;
				case 'png':     // png
					$src = imagecreatefrompng(JPATH_SITE.'/'.$image);
					break;
				case 'gif':     // gif
					$src = imagecreatefromgif(JPATH_SITE.'/'.$image);
					break;
				default:
			}
			// $tn_width;
			//echo $tn_height;
			$dst = imagecreatetruecolor($tn_width,$tn_height);
			imageantialias ($dst, true);
			imagecopyresampled ($dst, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
			imagejpeg($dst, $resized, 90); // write the thumbnail to cache as well...
		return "images/resized/".$image;
	}

	function calModStyle ($cols) {
		$modules = array();
		switch ($cols) {
			case 0: return null;
			break;
			case 1: 
				$modules[0]['class'] = "";
				$modules[0]['width'] = "100%";
				$modules[0]['subwidth'] = "100%";
				break;
			case 2: 
				$modules[0]['class'] = "-left";
				$modules[0]['width'] = "49.9%";
				$modules[0]['subwidth'] = "95%";
				$modules[1]['class'] = "-right";
				$modules[1]['width'] = "49.9%";
				$modules[1]['subwidth'] = "95%";
				break;
			default: 

				$width1 = round(99.6/($cols-0.1), 2);
				$width2 = round((99.6 - $width1*($cols-2))/2, 2);

				for ($i=1; $i<$cols - 1; $i++){
					$modules[$i]['class'] = "-center";
					$modules[$i]['width'] = $width1."%";
					$modules[$i]['subwidth'] = "90%";
				}
				$modules[0]['class'] = "-left";
				$modules[0]['width'] = $width2."%";
				$modules[0]['subwidth'] = "95%";
				$modules[$cols - 1]['class'] = "-right";
				$modules[$cols - 1]['width'] = $width2."%";
				$modules[$cols - 1]['subwidth'] = "95%";
				break;
		}
		return $modules;
	}

   function unhtmlentities($string) 
   {
		 $trans_tbl = array("&lt;" => "<", "&gt;" => ">", "&amp;" => "&");
       return strtr($string, $trans_tbl);
   }
	
	function textprocess($string) {
		global $current_charset;
		if ($current_charset == "UTF-8") return $string;
		else if ($current_charset) return htmlentities($string, ENT_NOQUOTES, $current_charset);
		else return $string;
	}
}
