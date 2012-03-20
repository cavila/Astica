<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
define( 'YOURBASEPATH', dirname(__FILE__) );
require(YOURBASEPATH .DS."/styleswitcher.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<jdoc:include type="head" />

<?php
	$headerstyle      = $this->params->get("headerstyle", "graphic");
	$headline     	  = $this->params->get("headline", "Jamba");
	$slogan			  = $this->params->get("slogan", "A Free Template From Joomlashack");
	$themecolor		  = $this->params->get("themecolor", "style1");
	require( YOURBASEPATH.DS."/themesaver.php");
	
	function getColumns ($left, $right){
	if ($left && !$right) {$style = "-left-only";}
	if ($right && !$left) $style = "-right-only";
	if (!$left && !$right) $style = "-wide";
	if ($left && $right) $style = "-both";
	return $style;
	}
	$style = getColumns($this->countModules( 'left' ),$this->countModules( 'right' ));
	
	//count modules in vertical positions u45
	$user45count = $this->countModules('user4') + $this->countModules('user5');
	if ($user45count == "1") {$user45width = "100%";}
	elseif ($user45count == "2") {$user45width = "50%";}
	
	
	//count modules in vertical positions u67
	$user67count = $this->countModules('user6') + $this->countModules('user7');
	if ($user67count == "1") {$user67width = "100%";}
	elseif ($user67count == "2") {$user67width = "50%";}

?>
<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />

<link href="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/css/template_css.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/css/nav.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/css/<?php echo $scheme;?>.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/css/j15.css" rel="stylesheet" type="text/css" media="screen" />

<!--[if IE]>
<link href="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/css/ie.css" rel="stylesheet" type="text/css" media="screen" />
<![endif]-->

</head>
<body>
<div id="header-wrap">
	<div id="header_<?php echo $headerstyle; ?>">
		<?php if ($this->countModules( 'newsflash' )) : ?>
			<div id="headermod"><jdoc:include type="modules" name="newsflash" style="xhtml" /></div>
		<?php endif; ?>
				<h1>
				<?php if ($headerstyle=='graphic') { ?>
				<a href="<?php echo JURI::base(); ?>" title="<?php echo $headline; ?>"><img src="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/images/<?php echo $scheme;?>/logo.png" title="<?php echo $headline; ?>" alt="<?php echo $slogan; ?>"/></a>
				<?php } ?>
				<?php if ($headerstyle=='text') { ?>
				<a href="<?php echo JURI::base(); ?>" title="<?php echo $headline; ?>"><?php echo $headline;?></a>
				<?php } ?>
				</h1>
				<h2><?php echo $slogan;?></h2>	
			</div>
		</div>
<div class="menubar">
	<div id="navmenu">
	<!--[if IE]>
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/js/barmenu.js"></script>
	<![endif]-->
		<jdoc:include type="modules" name="top" style="none" />
	</div>
</div>
	<div id="main-wrapper">		
		<div class="main-top<?php echo $style; ?>"></div>
			<div id="mainbody<?php echo $style; ?>">
				<?php if ($this->countModules( 'left' )) : ?>
					<div id="leftcol">
						<div class="left-inside">
							<jdoc:include type="modules" name="left" style="rounded" />
						</div>
					</div>
				<?php endif; ?>
				<?php if ($this->countModules( 'right' )) : ?>
					<div id="rightcol">
						<div class="right-inside">
							<jdoc:include type="modules" name="right" style="rounded" />
						</div>
					</div>
				<?php endif; ?>
				<div class="main<?php echo $style; ?>">
						<table border="0" cellspacing="0" cellpadding="0" width="100%">
						  <tr>
						    <td valign="top" width="100%">
								<?php if($this->countModules('user4') or $this->countModules('user5')) : ?>
										<div id="showcase">
										<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
										<tr>
										<?php if ($this->countModules( 'user4' )) : ?>
										<td style="width: <?php echo $user45width; ?>;padding:5px; vertical-align:top;">
										<jdoc:include type="modules" name="user4" style="rounded" />
										</td>
										<?php endif; ?>
										<?php if ($this->countModules( 'user5' )) : ?>
										<td style="width: <?php echo $user45width; ?>;padding:5px; vertical-align:top;">
										<jdoc:include type="modules" name="user5" style="rounded" />
										</td>
										<?php endif; ?>
										</tr>
										</table>
										</div>
									<?php endif; ?>
									
							<?php if ($this->countModules( 'banner' )) : ?>
								<div id="banner"><jdoc:include type="modules" name="banner" style="raw" /></div>
							<?php endif; ?>
							
							<?php if ($this->countModules( 'breadcrumbs' )) : ?>
							<div id="pathway"><jdoc:include type="modules" name="breadcrumbs" style="raw" /></div>
							<?php endif; ?>
							
						<jdoc:include type="message" />
						<jdoc:include type="component" />
						</td>
						  </tr>
						</table>
						
				<?php if($this->countModules('user6') or $this->countModules('user7')) : ?>
						<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
						<tr>
						<?php if ($this->countModules( 'user6' )) : ?>
						<td style="width: <?php echo $user67width; ?>;padding:5px; vertical-align:top;">
						<jdoc:include type="modules" name="user6" style="rounded" />
						</td>
						<?php endif; ?>
						<?php if ($this->countModules( 'user7' )) : ?>
						<td style="width: <?php echo $user67width; ?>;padding:5px; vertical-align:top;">
						<jdoc:include type="modules" name="user7" style="rounded" />
						</td>
						<?php endif; ?>
						</tr>
						</table>
				<?php endif; ?>
				</div>
				<div class="clear"></div><!--Updated in v1.6.1-->
				</div>
		<div class="bottom<?php echo $style; ?>"></div>
		<?php if ($this->countModules( 'footer' )) : ?>
		<div class="main-top-wide"></div>
		<div class="mainbody-wide">
			<div class="footer">
				<jdoc:include type="modules" name="footer" style="raw" />
			</div>
			<div class="clear"></div>
			</div>
		<div class="bottom-wide">&nbsp;</div>
		<?php endif; ?>
		<?php echo $jstpl; ?>
	</div>
</body>
</html>