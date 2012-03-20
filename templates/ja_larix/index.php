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


defined( 'DS') || define( 'DS', DIRECTORY_SEPARATOR );
include_once (dirname(__FILE__).DS.'/ja_vars.php');
global $jaMainmenuLastItemActive;
$jaMainmenuLastItemActive = false;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<jdoc:include type="head" />
<?php JHTML::_('behavior.mootools'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />

<link rel="stylesheet" href="<?php echo $tmpTools->baseurl(); ?>templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tmpTools->baseurl(); ?>templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl();?>/css/editor.css" type="text/css" />
<link href="<?php echo $tmpTools->templateurl();?>/css/template_css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $tmpTools->templateurl();?>/css/ja-vm.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $tmpTools->templateurl();?>/css/ja-news.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo $tmpTools->templateurl();?>/favicon.ico"/>
<script language="javascript" type="text/javascript" src="<?php echo $tmpTools->templateurl();?>/scripts/ja.script.js"></script>

<?php echo $jamenu->genMenuHead(); ?>


<!--[if lte IE 6]>
<style type="text/css">
.clearfix {height: 1%;}
</style>
<![endif]-->

<!--[if gte IE 7.0]>
<style type="text/css">
.clearfix {display: inline-block;}
</style>
<![endif]-->

<link href="<?php echo $tmpTools->templateurl();?>/css/colors/<?php echo $tmpTools->getParam(JA_TOOL_COLOR);?>.css" rel="stylesheet" type="text/css" />
<?php
//////////////////////////////////////
/// Hack for Virtuemart shop browse///
global $option, $category_id, $page;
//$category_id = $_GET['category_id'];
$category_id = JRequest::getVar('category_id', null, 'default', 'cmd');
$database = JFactory::getDBO();
if ($option == 'com_virtuemart'){
	$cols = 0;
	if (!empty($category_id)) {
		$cols = 2;
		$sql = "select products_per_row from #__vm_category where category_id=$category_id";
		$database->setQuery($sql);
		$cols = $database->loadResult();
	}
	if (!$cols) $cols = PRODUCTS_PER_ROW;
	?>
	<script language="javascript" type="text/javascript">

		function initAdjustVM () {
			adjustVMCatList ('ja-productwrap', <?php echo $cols; ?>);
		}

		jaAddEvent (window, 'load', initAdjustVM);

	</script>
	<?php
}
/// End Hack for Virtuemart shop browse///
//////////////////////////////////////////
?>
</head>

<body id="bd" class="<?php echo $tmpTools->getParam(JA_TOOL_SCREEN)." fs".$tmpTools->getParam(JA_TOOL_FONT);?>">
<a name="Top" id="Top"></a>

<ul class="accessibility">
	<li><a href="#ja-content" title="Skip to content">Skip to content</a></li>
	<li><a href="#ja-mainnav" title="Skip to main navigation">Skip to main navigation</a></li>
	<li><a href="#ja-col1" title="Skip to 1st column">Skip to 1st column</a></li>
	<li><a href="#ja-col2" title="Skip to 2nd column">Skip to 2nd column</a></li>
</ul>

<div id="ja-wrapper1">
<div id="ja-wrapper2">
<div id="ja-wrapper3" class="clearfix">

<!-- BEGIN: HEADER -->
<div id="ja-headerwrap" class="clearfix">
<div id="ja-header">
	<h1 class="logo"><a href="index.php"><?php echo $tmpTools->sitename();?></a></h1>
	
	<?php if ($this->countModules('your-cart') ) { ?>
	<div id="ja-vm-cart">
	  <jdoc:include type="modules" name="your-cart" style="xhtml" />	
	</div>
	<?php } ?>
	
</div>
</div>
<!-- END: HEADER -->

<!-- BEGIN: MAIN NAVIGATION -->
<div id="ja-mainnavwrap">
	<div id="ja-mainnav" class="clearfix">
	  <?php $jamenu->genMenu (0); ?>
	</div>
</div>
<?php if ($tmpTools->getParam(JA_TOOL_MENU) == 5) { ?>
<div id="ja-subnav" class="clearfix" style="height:16px;">
	  <?php $jamenu->genMenu (1,1); ?>
</div>
<?php } ?>

<!-- END: MAIN NAVIGATION -->

<!-- BEGIN: JA SLIDER -->
<?php if( $this->countModules('slider') ) {?>
<div id="ja-sliderwrap" class="clearfix">
   <jdoc:include type="modules" name="slider" style="raw" />
</div>
<?php } ?>
<!-- END: JA SLIDER -->

<!-- BEGIN: PATHWAY -->
<div id="ja-pathwaywrap" class="clearfix">

	<?php if ($this->countModules('user4')) { ?>
	<div id="ja-searchwrap">
	  <div id="ja-search">
	    <jdoc:include type="modules" name="user4" style="raw" />
	  </div>
	</div>
	<?php } ?>
	
	<div id="ja-pathway">
		<strong>You are here:</strong> <jdoc:include type="module" name="breadcrumbs" />
		
	  <?php if ($tmpTools->getParam(JA_TOOL_USER)) { ?>
  <div id="ja-usertools">
  	<?php $tmpTools->genToolMenu($tmpTools->getParam(JA_TOOL_USER) & 3, 'png');  /*Color tool*/ ?>
  </div>
  <?php } ?>

	</div>

</div>
<!-- BEGIN: PATHWAY -->

<div id="ja-containerwrap<?php echo $divid; ?>">
	<div id="ja-container" class="clearfix">

		<div id="ja-mainbody<?php echo $divid; ?>">
		<div id="ja-mainbody-inner" class="clearfix">
		
		<!-- BEGIN: CONTENT -->
		<div id="ja-contentwrap">
		<div id="ja-content">

	    <?php if ( $this->countModules('vm-fp') ) { ?>
      <!-- BEGIN: FEATURE PRODUCTS -->
      <div id="ja-feature">
		  <div id="ja-feature-products">
			<jdoc:include type="modules" name="vm-fp" style="raw" />
		  </div>
		  </div>
			<!-- END: FEATURE PRODUCTS -->
			<?php } ?>
			
  		<?php if ( $this->countModules('ja-news') ) { ?>
			<div id="ja-newswrap" class="clearfix">	  
				<jdoc:include type="modules" name="ja-news" style="xhtml" /> 
			</div>
			<?php } ?>
      	<jdoc:include type="component" />
			<?php if ( $this->countModules('banner') ) { ?>
			<div id="ja-banner" class="clearfix">
				<jdoc:include type="modules" name="banner" style="raw" />
			</div>
			<?php } ?>



		</div>
		</div>
		<!-- END: CONTENT -->
		
		<?php if ($ja_right) { ?>
		<!-- BEGIN: RIGHT COLUMN -->
		<div id="ja-col2">
		<div class="ja-innerpad">
			<jdoc:include type="modules" name="right" style="rounded" />
		</div>
		</div><br />
		<!-- END: RIGHT COLUMN -->
		<?php } ?>

		</div>
		</div>

		<?php if ($ja_left) { ?>
		<!-- BEGIN: LEFT COLUMN -->
		<div id="ja-col1">
		<div class="ja-innerpad">
			<?php if ($tmpTools->getParam(JA_TOOL_MENU) == 1 && $hasSubnav) {
				echo '<div id="ja-subnavcol" class="moduletable">';
				echo '<h3>'.$jamenu->getParentText(1).' Menu</h3>';
				$jamenu->genMenu (1); 
				echo '</div>';
			} ?>
			<jdoc:include type="modules" name="left" style="xhtml" />
		</div>
		</div><br />
		<!-- END: LEFT COLUMN -->
		<?php } ?>

	</div>
</div>

<!-- BEGIN: FOOTER -->
<div id="ja-footerwrap">

<span class="spacer">&nbsp;</span>

<div id="ja-footer">

  <?php if ($tmpTools->getParam(JA_TOOL_USER)) { ?>
  <div id="ja-usercolors" class="clearfix">
  	<?php $tmpTools->genToolMenu($tmpTools->getParam(JA_TOOL_USER) & 4, 'gif');  /*Color tool*/ ?>
  	<ul style="margin: 0 0 0 10px;">
  	  <li><a style="background: none; text-decoration: none;" href="#Top" title="Go to top"><img src="<?php echo $tmpTools->templateurl();?>/images/top.gif" title="Goto top" alt="Go to top" /></a></li>
  	</ul>
  </div><div class="clr"></div>
  <?php } ?>
  
	<jdoc:include type="modules" name="user3" style="raw" />
	<?php include_once(dirname(__FILE__).DS.'footer.php' ); ?>
	
</div>
</div>
<!-- END: FOOTER -->

</div>
</div>
</div>
<script language="javascript" type="text/javascript" src="<?php echo $tmpTools->templateurl();?>/scripts/vm_stuff.js"></script>
<jdoc:include type="modules" name="debug" style="raw" />
</body>

</html>
