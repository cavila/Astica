<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); ?>

<div class="buttons_heading">
<?php 
$pdf_link = "index2.php?option=$option&amp;page=shop.pdf_output&amp;showpage=$page&amp;pop=1&amp;output=pdf&amp;product_id=$product_id&amp;category_id=$category_id";
?>
<?php 
if (@PSHOP_PDF_BUTTON_ENABLE == 1 ) {
	echo vmCommonHTML::PdfIcon( $pdf_link ).' Save page as PDF<br />';
	}
if (@VM_SHOW_PRINTICON == 1 ) {
	echo vmCommonHTML::PrintIcon().' Print this page<br />';
	}
if (@VM_SHOW_EMAILFRIEND == 1 ) {
	if ($product_id != NULL ) {
		echo vmCommonHTML::EmailIcon($product_id).' Email to a Friend';
		}
	}
?>
</div>