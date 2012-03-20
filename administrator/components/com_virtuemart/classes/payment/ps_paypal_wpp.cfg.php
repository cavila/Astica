<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Restricted access' );

define('PP_WPP_CHECK_CARD_CODE', 'YES');

define ('PP_WPP_SANDBOX', '0');
define ('PP_WPP_USERNAME', '');
define ('PP_WPP_PASSWORD', '');
define ('PP_WPP_SIGNATURE', '');
define ('PP_WPP_SUCCESS_STATUS', 'C');
define ('PP_WPP_PENDING_STATUS', 'P');
define ('PP_WPP_FAILED_STATUS', 'X');
define ('PP_WPP_USE_PROXY', '0');
define ('PP_WPP_PROXY_HOST', '127.0.0.1');
define ('PP_WPP_PROXY_PORT', '808');
define ('PP_WPP_EXPRESS_ON', '1');

define('PP_WPP_ERRORS', '0');

define('PP_WPP_VERSION', '55.0');

define('PP_WPP_EX_SANDBOX_URL', 'https://beta-sandbox.paypal.com/webscr&cmd=_express-checkout&token=');
define('PP_WPP_EX_LIVE_URL', 'https://www.paypal.com/webscr&cmd=_express-checkout&token=');
define('PP_WPP_PAYMENT_ACTION', 'Sale');
define('PP_WPP_REQCONFIRMSHIPPING', '1');
?>