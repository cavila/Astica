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

require_once('libraries/joomla/utilities/date.php');
$date  = new JDate();
$config = new JConfig();
$_VERSION = new JVersion();
// NOTE - You may change this file to suit your site needs
?>
<small>Copyright &copy; <?php echo $date->toFormat( '2005 - %Y' ) . ' ' . $config->sitename;?>.
Designed by <a href="http://www.joomlart.com/" title="Visit Joomlart.com!" target="blank">JoomlArt.com</a></small> 
<small><?php echo $_VERSION->URL; ?></small>
