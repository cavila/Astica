<?php
/*------------------------------------------------------------------------
# YT Virtuemart Mega Slider - Version 1.0
# Copyright (C) 2009-2011 The YouTech Company. All Rights Reserved.
# @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Author: The YouTech Company
# Websites: http://www.ytcvn.com
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<?php if(count($items)>0):?>

<script type="text/javascript">
$jYtc(document).ready(function($) {
	   $('#yt_megasslider_nav<?php echo $module->id;?>').cycle({
    		fx:     '<?php echo $effect;?>',
    		timeout: <?php echo $timer_speed;?>,
    		speed:  <?php echo $slideshow_speed;?>,
    		next:   '.button-next<?php echo $module->id;?>',
    		prev:   '.button-prev<?php echo $module->id;?>',
    		pause: <?php echo ($play)?1:0;?>,
    		divId: <?php echo $module->id;?>,
    		readmoreImg:'<?php echo $readmore_img;?>',
    		theme:'<?php echo $theme;?>',
    		linktarget:'<?php echo $target;?>',
    		linkcaption:<?php echo $link_caption;?>,
    		autoPlay:<?php echo $auto_play;?>,
    		startingSlide:<?php echo $start;?>,
            totalItemScroll:<?php echo $count_items;?>,
            startNormalScroll: 0,
            totalArt: <?php echo $total;?>,
            endNormalScroll: <?php echo $num_item_per_page - 1;?>,
            leftScrollNumber:45,
            <?php if($nav_style_mega == 'nav_style02'):?>
            leftScroll:<?php echo ($item_normal_width + 16);?>,
                       
            <?php endif;?>
            <?php if($nav_style_mega != 'nav_style02'):?>
            leftScroll:<?php echo ($small_thumb_width + 16);?>,
            <?php endif;?>
            num_item_per_page:<?php echo $num_item_per_page;?>
	   });

    });
</script>

<!--Intro Text-->
<?php if($intro): ?>
<div style="text-align:left; width:<?php echo $width_module_mega + 30; ?>px">
	<?php  echo $intro;?>
</div>
<br/>
<?php endif;?>
<!--End Intro Text-->

<div class="yt_megasslider" style="width: <?php echo $width_module_mega + 30;?>px; height: <?php echo $thumb_height?>">
    <?php ob_start();?>
    	<div class="yt-contentmegaslider-nav" style="width: <?php echo $width_module_mega + 30?>px; height:<?php echo $thumb_height+65?>px;">
            <div id="yt_megasslider_nav<?php echo $module->id;?>" style="width:<?php echo $width_module_mega + 30;?>px !important;height:<?php echo $thumb_height?>px !important;">
                <?php foreach($items as $key=>$item) {?>
    				<div class="megaslider-content-article" style="width:<?php echo $width_module_mega + 30;?>px">
                        <?php ob_start();?>
                        
                        <div class="<?php if($position_image_display == "left"){echo 'megaslider-main-image';}else{echo 'megaslider-main-image-right';}?>" style="width:<?php echo $thumb_width?>px; height:<?php echo $thumb_height;?>px; ">
                            <div class="<?php echo $shadownl;?>" style="width:<?php echo $thumb_width + 47;?>px;height:<?php echo $thumb_height;?>px;">&nbsp;</div>
                            <div class="<?php echo $shadownr;?>" style="width:<?php echo $thumb_width + 47;?>px;height:<?php echo $thumb_height;?>px;">&nbsp;</div>
                            <?php if($show_main_image == 1):?><?php if($link_image == 1):?><a href="<?php echo $item['link'];?>" class="<?php if($target=='pop-up'):?>modal<?php endif;?>" title="<?php echo $item['title'];?>" target = "<?php echo $target;?>" ><?php endif;?><img src="<?php echo $item['thumb']?>" title="<?php echo $item['title'];?>" alt="<?php echo $item['title']?>"/><?php if($link_image == 1):?></a><?php endif;?><?php endif;?>
    				    </div>
                        <?php $display_image = ob_get_contents(); ob_end_clean();?>
                        <?php ob_start();?>
                        <?php if($showmaincontenttheme3 == 1):?>
                        <div class="<?php if($position_image_display == "left"){echo 'content-mega-main';}else{echo 'content-mega-main-right';}?>" style="<?php if($position_image_display == "left"){echo 'left:'.($thumb_width+32).'px';}else{echo 'left:0px';}?>; width:<?php echo $width_module_mega - ($thumb_width + 45);?>px;height:<?php echo 70;?>%;top:<?php echo 15;?>%;background:<?php echo $bgmainitem;?>;">
                            <div class="content-main">
                                <div class="content-box-main">
                                    <div class="hidden-main-content">
                                        <?php if($showmaintitle == 'yes'):?><div class="item_title_main_theme3"><a href="<?php echo $item['link'];?>" class="<?php if($target=='pop-up'):?>modal<?php endif;?>" title="<?php echo $item['title'];?>" target = "<?php echo $target;?>" style="color:<?php echo $maintitlecolor;?>; font-weight:bold"><?php echo $item['sub_main_title'];?></a></div><?php endif;?>
                                        <?php if($show_price == 'yes'):?>
                                        <div class="pricevm-<?php echo $theme?>">
                                            <?php
                                                if($item["current_price"] == '' && $item["old_price"] == ''){
                                                    echo "<span class='price'>".$item["price"]."</span>";
                                                }else{
                                                    if(isset($item["current_price"])){
                                                        echo "<span class='current_price_theme3'>".$item["current_price"]."</span>";
                                                    }
                                                    if(isset($item["old_price"]) && $item["old_price"] != ''){
                                                        echo "<span class='old_price_theme3'>(<s>".$item["old_price"]."</s>)</span>";
                                                    }
                                                    
                                                }
                                                
                                            ?>
                                        </div>
                                        <?php endif;?>
                                        <?php if($showmaindesc == 'yes'):?><div class="item_content_main_theme3" style="color:<?php echo $maindesccolor;?>;"><p style="color:<?php echo $maindesccolor;?>;text-align: left;"><?php echo $item['sub_main_content']?></p></div><?php endif;?>
                                        <?php if($showreadmore == 'yes'):?>
                                            <div class="readmore-mega-slider readmore-mega-slider-<?php echo $theme;?>"><a href="<?php echo $item['link'];?>" class="<?php if($target=='pop-up'):?>modal<?php endif;?>" title="<?php echo $item['title'];?>" target = "<?php echo $target;?>" style="color:<?php echo $maindesccolor;?>;"><?php echo $readmore_mega_text?></a></div>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                        <?php $display_desc = ob_get_contents(); ob_end_clean();?>
                        <?php
                            if($position_image_display == "left"){
                                echo $display_image.$display_desc;
                            }elseif($position_image_display == "right"){
                                echo $display_desc.$display_image;
                            }
                        ?>
                    </div>
                    
    			<?php } ?>
                
            </div>
            <?php if($shownumbutton == 'show'):?>
            <div style="width:<?php echo $num_item_per_page * (45)?>px; <?php if($position_image_display == "left"){echo "left:".$left_number_button;}else{echo 'right:'.$left_number_button;}?>px;" class="buttons_number_<?php echo $theme;?>">
                <div class="cover_buttons_number_<?php echo $module->id;?> cover_buttons_number" style="width:<?php echo ($total*46)?>px;">
                    <ul class="image_button_number_<?php echo $module->id;?> image_button_number">
    					<?php foreach($items as $key=>$item){?>
    						<li style="" class="<?php echo ($key==$start)?"button_img_selected_theme5_{$module->id}":"button_img_theme5_{$module->id}";?>" value="<?php echo $key;?>"><p><?php echo ($key+1);?></p></li>
    					<?php } ?>
    				</ul>
                </div>
			</div>
            <?php endif;?>
    	</div>
    
    <?php $slide_image = ob_get_contents(); ob_end_clean();?>
    <?php ob_start();?>
        <?php if($showhidenavigation == 'show_nav'):?>
        <div class="content-box-normal-<?php echo $theme;?> content-box-normal-<?php echo $module->id;?>" style="width:<?php echo $width_module_mega + 30;?>px; height:<?php echo ($small_thumb_height + 25)?>px;">
            <div class="content-preview-<?php echo $theme;?>" style="height:<?php echo ($small_thumb_height + 25)?>px;">
                <div class="button-prev<?php echo $module->id;?> preview_<?php echo $theme;?>" style="height:<?php echo ($small_thumb_height + 25)?>px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
            </div>
            <div class="content-box-middle-<?php echo $theme;?>" style="width:<?php echo $width_module_mega - 15;?>px;height:<?php echo ($small_thumb_height + 25)?>px;">
                <div class="content_box_<?php echo $theme.$module->id;?> content_box_<?php echo $theme;?>" style="width:100%;height:<?php echo ($small_thumb_height + 25)?>px !important;" >
                    <div class="cover_buttons_<?php echo $module->id;?> cover_item_box" style="width:<?php echo ($small_thumb_width + 16) * $total?>px; display:<?php echo ($prenext_show)?'block':'none'?>">
            			<div class="<?php echo $theme;?>">
    						<div class="buttons_<?php echo $theme;?> content_box_item">
    							<ul class="image_button_<?php echo $module->id;?>" style="list-style: none;">
    								<?php foreach($items as $key=>$item) {?>
    									<li id="li_height_item_<?php echo $module->id;?>" class="<?php echo ($key==$start)?"button_img_selected_theme5_{$module->id}":"button_img_theme5_{$module->id}";?>" value="<?php echo $key;?>">
                                            <div class="yt_post_item_<?php echo $theme;?> yt_post_item_<?php echo $module->id;?>" style="display:<?php echo $show_normal_image?"block":"none";?>;height:<?php echo $small_thumb_height;?>px; float: left;">
                                    			<div class="yt_meta_img_<?php echo $theme;?>" style="width:<?php echo $small_thumb_width?>px;height:<?php echo $small_thumb_height?>px;background:white;">
                                    				<img src="<?php echo $item['small_thumb']?>" title="<?php echo $item['title'];?>" style="width:<?php echo $small_thumb_width?>px;height:<?php echo $small_thumb_height?>px;"/>
                                    			</div>
                                                <div class="normal-content-active" style="width:<?php echo $small_thumb_width?>px;height:<?php echo $small_thumb_height?>px;">
                                                    <?php if($shownormaltitle == 'yes'):?><div title="<?php echo $item['title'];?>"><a href="<?php echo $item['link'];?>" style="color: <?php echo $coloritemnav;?>;font-weight:bold;"><?php echo $item['sub_normal_title'];?></a></div><?php endif;?>
                                                    <?php if($shownormaldesc == 'yes'):?><div style="color:<?php echo $colorcontentnav;?>;"><?php echo $item['sub_normal_content']?></div><?php endif;?>
                                                </div>
                                            </div>
                                        </li>
    								<?php } ?>
    							</ul>
    						</div>
            			</div>
            		</div>
            	</div>
            </div>
            <div class="content-next-<?php echo $theme;?>" style="height:<?php echo ($small_thumb_height + 30)?>px;">
                <div class="button-next<?php echo $module->id;?> next_<?php echo $theme;?>" style="height:<?php echo ($small_thumb_height + 30)?>px;">&nbsp;</div>
            </div>
        </div>
        <?php endif;?>
    <?php $slide_navigation_01 = ob_get_contents(); ob_end_clean();?>
    
    
    <?php ob_start();?>
        <?php if($showhidenavigation == 'show_nav'):?>
        <div class="content-box-normal-<?php echo $theme;?> content-box-normal-<?php echo $module->id;?>" style="width:<?php echo $width_module_mega + 30;?>px; height:<?php echo ($small_thumb_height + 25)?>px;">
            <div class="content-box-middle-<?php echo $theme;?>" style="width:<?php echo $width_module_mega + 18;?>px;height:<?php echo ($small_thumb_height + 25)?>px;">
                <div class="content_box_<?php echo $theme.$module->id;?> content_box_<?php echo $theme;?>" style="width:<?php echo ($item_normal_width + 22) * $num_item_per_page?>px;height:<?php echo ($small_thumb_height + 25)?>px !important;overflow:hidden;" >
                    <div class="cover_buttons_<?php echo $module->id;?> cover_item_box" style="width:<?php echo ($item_normal_width + 16) * $total?>px;">
            			<div class="<?php echo $theme;?>">
    						<div class="buttons_<?php echo $theme;?> content_box_item">
    							<ul class="image_button_<?php echo $module->id;?>">
    								<?php foreach($items as $key=>$item) {?>
    									<li id="li_height_item_<?php echo $module->id;?>" class="<?php echo ($key==$start)?"button_img_selected_theme5_{$module->id}":"button_img_theme5_{$module->id}";?>" value="<?php echo $key;?>">
                                            <div class="yt_post_item_<?php echo $theme;?> yt_post_item_<?php echo $module->id;?>" style="overflow:hidden;height:<?php echo $small_thumb_height;?>px;width:<?php echo $item_normal_width;?>px; float: left;">
                                    			<?php if($shownormalimage == 'yes'):?>
                                                <div class="yt_meta_img_<?php echo $theme;?>" style="width:<?php echo $small_thumb_width?>px;height:<?php echo $small_thumb_height?>px;background:white;">
                                    				<img src="<?php echo $item['small_thumb']?>" title="<?php echo $item['title'];?>" style="width:<?php echo $small_thumb_width?>px;height:<?php echo $small_thumb_height?>px;"/>
                                    			</div>
                                                <?php endif;?>
                                                <div class="content-box-nav-style2" style="width:<?php echo $item_normal_width - ($small_thumb_width+10); ?>px;height:<?php echo $small_thumb_height+5?>px;">
                                                    <?php if($shownormaltitle == 'yes'):?><div title="<?php echo $item['title'];?>"><a href="<?php echo $item['link'];?>" style="color:<?php echo $coloritemnav;?>;font-weight:bold;"><?php echo $item['sub_normal_title']?></a></div><?php endif;?>
                                                    <?php if($shownormaldesc == 'yes'):?><div style="color:<?php echo $colorcontentnav;?>;"><?php echo $item['sub_normal_content']?></div><?php endif;?>
                                                </div>
                                            </div>
                                        </li>
    								<?php } ?>
    							</ul>
    						</div>
            			</div>
            		</div>
            	</div>
            </div>
        </div>
        <?php endif;?>
    <?php $slide_navigation_02 = ob_get_contents(); ob_end_clean();?>
     
    <div class="ytc-content ytc_background_<?php echo $theme;?>" style="width: <?php echo $width_module_mega + 29;?>px; position:relative; overflow:hidden">
        <?php
        	if($nav_style_mega == 'nav_style01' || $nav_style_mega == 'nav_style03')
        	{
                echo $slide_image.$slide_navigation_01;
        	}
        	elseif($nav_style_mega == 'nav_style02'){
                echo $slide_image.$slide_navigation_02;
        	}
        ?>
    </div>
    <?php else: echo JText::_('Has no content to show!');?>
    <?php endif;?>

</div>

<!--Start Footer Text-->
<?php if($note): ?>
<br/>
<div style="text-align:left; width:<?php echo $width_module_mega + 30; ?>px">
	<?php  echo $note;?>
</div>
<?php endif;?>
<!--End Footer Text-->