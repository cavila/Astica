<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once(JPATH_BASE.'/modules/mod_ja_vmproductslide/ja_vmproductslide/application.php');

$xheight = $params->get('xheight',400);
$xwidth = $params->get('xwidth',400);
$typeproduct = $params->get('typeproduct',0);
$numElem = $params->get('numElem',4);
$mode = $params->get('mode',1);
$catid = $params->get('catid','');
$show_price = $params->get('show_price',1);
$show_addtocart = $params->get('show_addtocart',1);
$auto = $params->get('auto',1);
$direction = $params->get('direction','left');
$delaytime = $params->get('delaytime',5000);
$animationtime = $params->get('animationtime',1000);
if($catid){
	$catid = explode(',',$catid);
	$catid = "'".implode("','",$catid)."'";
}
$database		=& JFactory::getDBO();
$javmslide = new JA_VMSlider($params, $database, $typeproduct,$show_addtocart,$show_price,$numElem);
$total = $javmslide->getTotal($catid);
if($total){
	if($total < $numElem) $numElem = $total;
	
	$filename = JPATH_SITE.DS.'templates/'.$mainframe->getTemplate().'/css/ja.vm.css';
	$css_path = JURI::base().'templates/'.$mainframe->getTemplate().'/css/';
	if(!file_exists($filename)){
		$css_path = JURI::base().'modules/mod_ja_vmproductslide/ja_vmproductslide/';
	}
		
	JHTML::stylesheet('ja.vm.css', $css_path);
	?>

	<script type="text/javascript" src="<?php echo JURI::base(); ?>modules/mod_ja_vmproductslide/ja_vmproductslide/ja.vmproductslide.js"></script>
	<script type="text/javascript">
		var options={
		    w: <?php echo $xwidth; ?>,
		    h: <?php echo $xheight; ?>,
		    num_elem: <?php echo $numElem; ?>,
		    mode: '<?php echo $mode; ?>', //horizontal or virtical
		    direction: '<?php echo $direction; ?>', //horizontal: left or right; virtical: up or down
			total: <?php echo $total; ?>,
			url: '',
		    wrapper: 'ja-slider-center',
		    duration: <?php echo $animationtime; ?>,
		    interval: <?php echo $delaytime; ?>,
			running: false,
		    auto: <?php echo $auto; ?>
		};
		
		var jsslider = null;
	</script>
	
	<script type="text/javascript">
	//<!--[CDATA[
	function sliderInit (){
		jsslider = new JS_Slider(options);
		elems = $('ja-slider-center').getElementsByClassName ('vm_element');
		for(i=0;i<elems.length;i++){
			jsslider.update (elems[i].innerHTML, i);
		}
		jsslider.setPos(null);
		if(jsslider.options.auto){
			jsslider.nextRun();
		}
	}
	
	jaAddEvent(window, 'load', sliderInit);
	
	function setDirection(direction,ret){
		jsslider.options.direction = direction;
		if(jsslider.options.auto){
			if(ret){
				if(direction == 'right'){
					$('ja-slide-left-img').src = '<?php echo JURI::base(); ?>modules/mod_ja_vmproductslide/ja_vmproductslide/img/re-left.gif';
				}else  {
					$('ja-slide-right-img').src = '<?php echo JURI::base(); ?>modules/mod_ja_vmproductslide/ja_vmproductslide/img/re-right.gif';
				}
				jsslider.options.interval = <?php echo $delaytime; ?>;
				jsslider.options.duration = <?php echo $animationtime; ?>;
			}
			else{
				if(direction == 'right'){
					$('ja-slide-left-img').src = '<?php echo JURI::base(); ?>modules/mod_ja_vmproductslide/ja_vmproductslide/img/re-left-hover.gif';
				}else  {
					$('ja-slide-right-img').src = '<?php echo JURI::base(); ?>modules/mod_ja_vmproductslide/ja_vmproductslide/img/re-right-hover.gif';
				}
				jsslider.options.interval = 800;
				jsslider.options.duration = 500;
				jsslider.nextRun();
			}
		}
		else{
			if(ret){
				if(direction == 'right'){
					$('ja-slide-left-img').src = '<?php echo JURI::base(); ?>modules/mod_ja_vmproductslide/ja_vmproductslide/img/re-left.gif';
				}else  {
					$('ja-slide-right-img').src = '<?php echo JURI::base(); ?>modules/mod_ja_vmproductslide/ja_vmproductslide/img/re-right.gif';
				}
				jsslider.options.auto = 1;
			}
			else{
				if(direction == 'right'){
					$('ja-slide-left-img').src = '<?php echo JURI::base(); ?>modules/mod_ja_vmproductslide/ja_vmproductslide/img/re-left-hover.gif';
				}else  {
					$('ja-slide-right-img').src = '<?php echo JURI::base(); ?>modules/mod_ja_vmproductslide/ja_vmproductslide/img/re-right-hover.gif';
				}
				jsslider.options.interval = 500;
				jsslider.options.duration = 500;
				jsslider.options.auto = 1;
				jsslider.nextRun();
			}		
		}
	}
	//]]-->
	</script>

	<div id="ja-slider">
		<div id="ja-slider-left" style="height: <?php echo $xheight; ?>px; line-height: <?php echo $xheight; ?>px;"><img id="ja-slide-left-img" src="<?php echo JURI::base(); ?>/modules/mod_ja_vmproductslide/ja_vmproductslide/img/re-left.gif" alt="Left direction" onmouseover="javascript: setDirection('right',0);" onmouseout="javascript: setDirection('right',1);" title="Left direction" /></div>
		<div id="ja-slider-center">
		<?php $javmslide->genHTML($catid);?>
		</div>
		<div id="ja-slider-right" style="height: <?php echo $xheight; ?>px;"><img id="ja-slide-right-img" src="<?php echo JURI::base(); ?>/modules/mod_ja_vmproductslide/ja_vmproductslide/img/re-right.gif" alt="Right direction" onmouseover="javascript: setDirection('left',0);" onmouseout="javascript: setDirection('left',1);" title="Right direction" /></div>
	</div>
	<?php
}
else{
	echo '<div id="ja-slide-error">JA VirtueMart Error: There is not any product in this category </div>';
}
?>

