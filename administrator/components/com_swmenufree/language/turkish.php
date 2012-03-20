<?php
/**
* swmenufree v4.0
* http://swonline.biz
* Copyright 2006 Sean White
**/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Make sure the user is authorized to view this page
$user = & JFactory::getUser();
if (!$user->authorize( 'com_modules', 'manage' )) {
	$mainframe->redirect( 'index.php', JText::_('ALERTNOTAUTH') );
}
//swMenuFree 6.0 new terms
define( '_SW_SUPERFISH_MENU', 'Superfish Menu' );
define( '_SW_OVERLAY_HACK', 'Force Overlay' );
define( '_SW_OVERLAY_HACK_TIP', 'Make submenus overlay other page elements and fix any transmenu submenu position problems.' );
define( '_SW_SPECIAL_EFFECTS_TIP', 'Apply an effect to the submenus' );
define( '_SW_SPECIAL_EFFECTS_NONE', 'None' );
define( '_SW_SPECIAL_EFFECTS_SLIDE', 'Slide' );
define( '_SW_SPECIAL_EFFECTS_FADE', 'Fade' );
define( '_SW_LEARNMORE', 'Learn More' );
define( '_SW_BUYNOW', 'Buy swMenuPro Now' );




//swMenuFree 5.0 new terms
define( '_SW_TIGRA_MENU', 'Tigra Menu' );
define( '_SW_AUTO_POSITION_TIP', 'Auto position submenus in a trans menu system if they would otherwise overlap the viewable page.' );
define( '_SW_PADDING_HACK_TIP', 'Apply a hack that will adjust padding for browsers other than IE.  Use to fix problems when IE and other browsers display menu items as different sizes' );
define( '_SW_AUTO_POSITION', 'Auto Position Sub Menus' );
define( '_SW_PADDING_HACK', 'IE6 Padding Hack' );
define( '_SW_MENU_SYSTEM_TIP', 'Click here to open a popup window with more information on the available menu systems.' );


//swMenuFree 4.5 new terms


define( '_SW_UPGRADE_VERSIONS', 'swMenuFree nin Y�kl� Olan S�r�m�' );
define( '_SW_SELECTED_LANGUAGE_HEADING', 'Aktif Dil Dosyas?' );
define( '_SW_LANGUAGE_FILES', 'Yeni Dil Dosyas? Se�iniz.' );
define( '_SW_LANGUAGE_CHANGE_BUTTON', 'Dil De?i?tir' );
define( '_SW_FILE_PERMISSIONS', 'Aktif Dosya ?zinleri' );
define( '_SW_LANGUAGE_SUCCESS', 'Yeni swMenuFree Dil Dosyas? ba?ar? ile eklenmi?tir.' );
define( '_SW_LANGUAGE_FAIL', ' Dil dosyas? y�klenemiyor. L�tfen a?a??daki dizinlerin hepsinin yaz?labilir oldu?una emin olunuz.' );


//Menu Names
define( '_SW_MENU_SYSTEM', 'Men� Sistemi' );
define( '_SW_TRANS_MENU', 'Trans Men�' );
define( '_SW_MYGOSU_MENU', 'MyGosu Men�' );
define( '_SW_TIGRA_MENU', 'Tigra Menu' );


//Page Names
define( '_SW_MANUAL_CSS_EDITOR', 'Manual CSS D�zenleyicisi' );
define( '_SW_MODULE_EDITOR', 'Men� Mod�l D�zenleyicisi' );
define( '_SW_UPGRADE_FACILITY', 'G�ncelleme  Fasilitesi' );


//Common Terms
define( '_SW_WRITABLE', 'Yaz?labilir' );
define( '_SW_UNWRITABLE', 'Yaz?lamaz' );
define( '_SW_YES', 'Evet' );
define( '_SW_NO', 'Hay?r' );
define( '_SW_HYBRID', 'hibrid' );
define( '_SW_MODULE_NAME', 'Mod�l ?smi' );

//Tool Tips
//define( '_SW_MENU_SYSTEM_TIP', 'Bir men� sistemi se�iniz.<br /><b>Trans Menu:</b>Alt men�s� g�zel bir kayma efektine sahip olan bir DHTML popout men� sistemi.<br /><b>MyGosu Menu:</b>?ablon(template) uyumu daha iyi olan bir A DHTML popout men� sistemi' );
define( '_SW_SAVE_TIP', 'B�t�n stil ve mod�l de?i?ikliklerini veritaban?na kaydetmek i�in buraya t?klay?n?z' );
define( '_SW_CANCEL_TIP', 'De?i?iklikleri iptal etmek ve men� mod�l y�neticisine d�nmek i�in buraya t?klay?n?z' );
define( '_SW_PREVIEW_TIP', 'Men� mod�l�n� farkl? bir pencerede g�rmek i�in buraya t?klay?n?z' );
define( '_SW_EXPORT_TIP', 'Aktif stil ayarlar?n? kullanarak di?ar?dan bir stil ?iti (sheet) getirmek i�in buray? t?klay?n?z' );

//Buttons text
define( '_SW_SAVE_BUTTON', 'kaydet' );
define( '_SW_CANCEL_BUTTON', 'iptal' );
define( '_SW_PREVIEW_BUTTON', '�nizleme' );
define( '_SW_EXPORT_BUTTON', 'ihra�(export)' );
define( '_SW_UPLOAD_BUTTON', 'dosya y�kle' );


//Internal program links
define( '_SW_UPGRADE_LINK', 'swMenuFree yi g�ncelle/tamir et.' );
define( '_SW_MANAGER_LINK', 'Men� mod�l �zelliklerini d�zenle' );
define( '_SW_CSS_LINK', 'D?? CSS dosyas?n? d�zenle' );
define( '_SW_EXPORT_LINK', 'D?? CSS dosyas? ihra� et' );


//Program Notices
define( '_SW_UPLOAD_FILE_NOTICE', 'L�tfen y�klemek i�in bir dosya se�iniz' );
define( '_SW_SAVE_MENU_MESSAGE', 'Ayarlar ba?ar?yla kaydedildi.' );
define( '_SW_SAVE_MENU_CSS_MESSAGE', 'Ayarlar kaydedildi ve d?? CSS dosyas? ba?ar?yla olu?turuldu' );
define( '_SW_SAVE_CSS_MESSAGE', 'D?? CSS dosyas? ba?ar?yla kaydedildi' );
define( '_SW_NO_SAVE_MENU_CSS_MESSAGE', 'D?? CSS dosyas? olu?turulmad?. modules/mod_swmenufree/styles dizininizin yaz?labilir oldu?undan emin olunuz.' );


//////////////////////////
//Upgrade page
/////////////////////////
define( '_SW_OK', 'Her?ey tamam' );
define( '_SW_MESSAGES', 'Mesajlar' );
define( '_SW_MODULE_SUCCESS', 'Mod�l ba?ar?yla g�ncellendi.' );
define( '_SW_MODULE_FAIL', 'Mod�l g�ncellenemiyor. L�tfen /modules dizininizin yaz?labilir oldu?undan emin olunuz.' );
define( '_SW_TABLE_UPGRADE', '%s Tablosu g�ncellendi' );
define( '_SW_TABLE_CREATE', '%s Tablosu olu?turuldu' );
define( '_SW_UPDATE_LINKS', 'Admin men� linkleri g�ncellendi' );

define( '_SW_MODULE_VERSION', '?uanki swMenuFree Mod�l Versiyonu' );
define( '_SW_COMPONENT_VERSION', '?uanki swMenuFree Component Versiyonu' );
define( '_SW_UPLOAD_UPGRADE', 'swMenuFree Upgrade/Release dosyas?n? y�kle' );
define( '_SW_UPLOAD_UPGRADE_BUTTON', 'Dosyay? y�kle ve kur' );

define( '_SW_COMPONENT_SUCCESS', 'swMenuFree Component ba?ar?yla g�ncellendi.' );
define( '_SW_COMPONENT_FAIL', 'G�ncellenemedi, l�tfen a?a??da listeli b�t�n dizinlerin yaz?labilir oldu?una emin olunuz.' );
define( '_SW_INVALID_FILE', 'Bu dosya ge�erli bir yeni swMenuFree upgrade/release dosyas? de?il.' );



//////////////////////////////
//Size Position & Offsets Page
/////////////////////////////
define( '_SW_POSITION_LABEL', ' Men� Pozisyonlar? ve Oryantasyon' );
define( '_SW_SIZES_LABEL', 'Men� Elemanlar?n?n Boyutlar?' );
define( '_SW_TOP_OFFSETS_LABEL', 'Top Men� Offsetleri' );
define( '_SW_SUB_OFFSETS_LABEL', 'Alt Men� Offsetleri' );
define( '_SW_ALIGNMENT_LABEL', 'Men� Hizalama' );
define( '_SW_WIDTHS_LABEL', 'Men� Eleman? Geni?li?i' );
define( '_SW_HEIGHTS_LABEL', 'Men� Eleman? Y�ksekli?i' );


define( '_SW_TOP_MENU', 'Top Men�' );
define( '_SW_SUB_MENU', 'Alt Men�' );
define( '_SW_ALIGNMENT', 'Hizalama' );
define( '_SW_POSITION', 'Pozisyon' );
define( '_SW_ORIENTATION', 'Oryantasyon' );
define( '_SW_ITEM_WIDTH', 'Eleman Geni?li?i' );
define( '_SW_ITEM_HEIGHT', 'Eleman Y�ksekli?i' );
define( '_SW_TOP_OFFSET', 'Top Offset' );
define( '_SW_LEFT_OFFSET', 'Sol Offset' );
define( '_SW_LEVEL', 'Seviye' );
define( '_SW_AUTOSIZE', '(otomatik boyutland?rma i�in 0 a ayarlay?n)' );

//////////////////////
//Fonts & Padding Page
/////////////////////
define( '_SW_FONT_FAMILY_LABEL', 'Yaz? Tipi T�rleri' );
define( '_SW_FONT_SIZE_LABEL', 'Yaz? Tipi Boyutu' );
define( '_SW_FONT_ALIGNMENT_LABEL', 'Yaz? Hizalama' );
define( '_SW_FONT_WEIGHT_LABEL', 'Yaz? Tipi Tonlama' );
define( '_SW_PADDING_LABEL', 'Padding' );


define( '_SW_TOP', 'Top' );
define( '_SW_RIGHT', 'Sa?' );
define( '_SW_BOTTOM', 'Alt' );
define( '_SW_LEFT', 'Sol' );
define( '_SW_FONT_SIZE', 'Padding Boyutu' );
define( '_SW_FONT_ALIGNMENT', 'Yaz? Hizalama' );
define( '_SW_FONT_WEIGHT', 'Yaz? Tipi Tonlama' );
define( '_SW_PADDING', 'Padding' );
define( '_SW_FONT_TIP', 'B�t�n taray?c?lar yaz? tiplerini ve boyutlar?n? farkl? g�r�nt�ler. A?a??daki liste sizin taray?c?n?z yaz? tiplerini nas?l g�r�nt�ledi?ini g�stermektedir.' );

/////////////////////////
//Borders & Effects Page
////////////////////////
define( '_SW_BORDER_WIDTHS_LABEL', 'S?n?r Geni?li?i' );
define( '_SW_BORDER_STYLES_LABEL', 'S?n?r Stilleri' );
define( '_SW_SPECIAL_EFFECTS_LABEL', '�zel Efekler' );

define( '_SW_OUTSIDE_BORDER', 'D?? S?n?r' );
define( '_SW_INSIDE_BORDER', '?� S?n?r' );
define( '_SW_NORMAL_BORDER', 'S?n?r' );
define( '_SW_WIDTH', 'Geni?lik' );
define( '_SW_HEIGHT', 'Y�kseklik' );
define( '_SW_DIVIDER', 'B�l�c�' );
define( '_SW_STYLE', 'Stil' );
define( '_SW_DELAY', 'A�?lma/Kapanma S�resi' );
define( '_SW_OPACITY', 'Saydaml?k' );

///////////////////////////
//Colors & Backgrounds Page
///////////////////////////
define( '_SW_BACKGROUND_IMAGE_LABEL', 'Arkafon Resimleri' );
define( '_SW_BACKGROUND_COLOR_LABEL', 'Arkafon Renkleri' );
define( '_SW_FONT_COLOR_LABEL', 'Yaz? tipi Renkleri' );
define( '_SW_BORDER_COLOR_LABEL', 'S?n?r Renkleri' );


define( '_SW_BACKGROUND', 'Arkafon' );
define( '_SW_OVER_BACKGROUND', '�zerine gelindi?inde Arkafon' );
define( '_SW_COLOR', 'Renk' );
define( '_SW_OVER_COLOR', '�zerine Gelindi?inde Renk' );
define( '_SW_FONT', 'Yaz? Tipi Rengi' );
define( '_SW_OVER_FONT', '�zerine gelindi?inde Yaz? Tipi Rengi' );
define( '_SW_OUTSIDE_BORDER_COLOR', 'Di? S?n?r Rengi' );
define( '_SW_INSIDE_BORDER_COLOR', '?� S?n?r Rengi' );
define( '_SW_NORMAL_BORDER_COLOR', 'S?n?r Rengi' );
define( '_SW_GET', 'al' );
define( '_SW_COLOR_TIP', 'Renk tekerle?indeki renkleri se�ip se�ti?iniz rengi kullanmak i�in renk kutusunun yanindaki %s e t?klay?n?z.');
define( '_SW_PRESENT_COLOR', '?u anki Renk' );
define( '_SW_SELECTED_COLOR', 'Se�ilen Renk' );


///////////////////////////
//Menu Module Settings Page
///////////////////////////
define( '_SW_MENU_SOURCE_LABEL', 'Men� Kayna?? Ayarlar?' );
define( '_SW_STYLE_SHEET_LABEL', 'Stil ?it(sheet) Ayarlar?' );
define( '_SW_AUTO_ITEM_LABEL', 'Otomatik Men� Elemanlar? Ayarlar?' );
define( '_SW_CACHE_LABEL', 'Cache Ayarlar?' );
define( '_SW_GENERAL_LABEL', 'Genel Mod�l Ayarlar?' );
define( '_SW_POSITION_ACCESS_LABEL', 'Pozisyon ve Eri?im' );
define( '_SW_PAGES_LABEL', 'Men� Mod�l�n� Sayfalarda G�ster' );
define( '_SW_CONDITIONS_LABEL', '?artlar' );

//Select box text
define( '_SW_CSS_DYNAMIC_SELECT', 'Stil ?itini direk sayfaya yaz' );
define( '_SW_CSS_LINK_SELECT', 'D?? stil ?itine linkle' );
define( '_SW_CSS_IMPORT_SELECT', 'D?? stil ?iti getir' );
define( '_SW_CSS_NONE_SELECT', 'Stil ?itini linkleme' );

define( '_SW_SOURCE_CONTENT_SELECT', 'Sadece Content kullan' );
define( '_SW_SOURCE_EXISTING_SELECT', 'A?a??da Bulunan Men�y� Se�' );

define( '_SW_SHOW_TABLES_SELECT', 'Tablo halinde g�ster' );
define( '_SW_SHOW_BLOGS_SELECT', 'Blog halinde g�ster' );

define( '_SW_10SECOND_SELECT', '10 Saniye' );
define( '_SW_1MINUTE_SELECT', '1 Dakika' );
define( '_SW_30MINUTE_SELECT', '30 Dakika' );
define( '_SW_1HOUR_SELECT', '1 Saat' );
define( '_SW_6HOUR_SELECT', '6 Saat' );
define( '_SW_12HOUR_SELECT', '12 Saat' );
define( '_SW_1DAY_SELECT', '1 G�n' );
define( '_SW_3DAY_SELECT', '3 G�n' );
define( '_SW_1WEEK_SELECT', '1 Hafta' );

//top tabs text
define( '_SW_MODULE_SETTINGS_TAB', 'Men� Mod�l� Ayarlar?' );
define( '_SW_SIZE_OFFSETS_TAB', 'Boyut, Posizyon ve Offsetler' );
define( '_SW_COLOR_BACKGROUNDS_TAB', 'Renkler ve Arkafonlar' );
define( '_SW_FONTS_PADDING_TAB', 'Yaz? tipleri ve Padding' );
define( '_SW_BORDERS_EFFECTS_TAB', 'S?n?rlar ve Efektler' );


//general text
define( '_SW_MENU_SOURCE', 'Men� Kayna??' );
define( '_SW_PARENT', 'Ana' );
define( '_SW_STYLE_SHEET', 'Stil ?itini (Sheet) y�kle' );
define( '_SW_CLASS_SFX', 'Mod�l Class Suffix' );
define( '_SW_HYBRID_MENU', 'Hibrid Men�' );
define( '_SW_TABLES_BLOGS', 'Tablolar/Bloglar? kullan' );
define( '_SW_CACHE_ITEMS', 'Cache Men� Elemanlar?' );
define( '_SW_CACHE_REFRESH', 'Cache Yenileme S�resi' );
define( '_SW_SHOW_NAME', 'Mod�l ?smini G�ster' );
define( '_SW_PUBLISHED', 'Yay?nland?');
define( '_SW_ACTIVE_MENU', 'Aktif Men�' );
define( '_SW_MAX_LEVELS', 'Maksimum Seviler' );
define( '_SW_PARENT_LEVEL', 'Ana Seviye' );
define( '_SW_SELECT_HACK', 'Kutu Hack ini Se�' );
define( '_SW_SUB_INDICATOR', 'Alt Men� G�stergesi' );
define( '_SW_SHOW_SHADOW', 'G�lge G�ster' );
define( '_SW_MODULE_POSITION', 'Mod�l Pozisyonu' );
define( '_SW_MODULE_ORDER', 'Mod�l S?ralamas?' );
define( '_SW_ACCESS_LEVEL', 'Eri?im Seviyesi' );
define( '_SW_TEMPLATE', '?ablon' );
define( '_SW_LANGUAGE', 'Dil' );
define( '_SW_COMPONENT', 'Component' );

//tool tips
define( '_SW_MENU_SOURCE_TIP', 'Men� mod�l�n�z�n i�in men� elemanlar?n?n kayna?? olacak ge�erli bir men� se�in.' );
define( '_SW_PARENT_TIP', 'Kaynak men�n�n bir segmentini g�rmek i�in bir parent se�in. B�t�n kaynak men� elemanlar?n? g�rmek i�in top olarak ayarlay?n.' );
define( '_SW_STYLE_SHEET_TIP', '<b>Dynamic:</b> men� mod�l�n�n �a??r?ld??? belgeye stil ?itini (style sheet) yazar.<br /><b>Link External: </b> ihra� edilmi? bir d?? stil ?itine (style sheet) linkler.<br /><b>Do Not Link:</b> kendi linkinizi ?ablonunuzun ba??ndaki di? stil ?itine (style sheet) kendiniz kopyalay?n. O zaman men� mod�l� tamamen onaylayacakt?r.' );
define( '_SW_CLASS_SFX_TIP', '?ablon Mod�ltablosu CSS �ncesi yerle?tirilecek suffix. ?ablon mod�ltablosu CSS ile olabilecek cak??malar? engellemek yada ?ablon CSS dosyas? �zerinden daha fazla stil se�enekleri i�in kullan?labilir.' );
define( '_SW_HYBRID_MENU_TIP', '?�erik kategori/b�l�mler tablolar/bloglar (Content category/sections tables/blogs) olan i�erik men� elemanlar?n?, otomatik olarak i�erik men� elemanlar?na ekler.' );
define( '_SW_TABLES_BLOGS_TIP', 'Otomatik olarak olu?turulmu? kategori/b�l�mler men� elemanlar?n? tablolar ya da bloglar olarak g�sterir.' );
define( '_SW_CACHE_ITEMS_TIP', 'Performans? ve cache men� elemanlar?n? artt?rmak i�in bir cache dosyas? kullan. �zellikle b�y�k men�ler olu?turmak i�in �ok SQL sorgulamas? gerektiren hibrid men�lerle alakal? performans konular?nda yararl?d?r. Cache bu sorgulamalar? cache aral?klar?nda sadece bir sete d�?�r�r.' );
define( '_SW_CACHE_REFRESH_TIP', 'Cache dosyas?n?n men� elemanlar?n?n yap?s?n? yenilerken ki zaman aral???.' );
define( '_SW_SHOW_NAME_TIP', 'Men� mod�l ismini g�ster.' );
define( '_SW_PUBLISHED_TIP', 'men� mod�l�n� yay?nla/yay?nlama.');
define( '_SW_ACTIVE_MENU_TIP', 'G�r�nen sayfa i�in ?uanki top men� eleman?n? aktif durumda tut' );
define( '_SW_MAX_LEVELS_TIP', 'G�sterilecek kaynak men�n�n maksimum seviyesi. B�t�n seviyeleri g�r�nt�lemek i�in 0 yap?n.' );
define( '_SW_PARENT_LEVEL_TIP', 'Mod�l�n men� kayna??n? belirli bir seviyeye kadar izleyen geli?mi? ayar. Genellikle 0 a ayarl?.' );
define( '_SW_SELECT_HACK_TIP', 'Alt men�lerin IE deki formlardaki se�im kutular?n? �rtmesi i�in men�ye hack uygula.' );
define( '_SW_SUB_INDICATOR_TIP', 'Alt men� g�stergeci olarak k���k bir ok g�ster. Alt elemanlar? olan alt men� elemanlar?n? belirtmek i�in.' );
define( '_SW_SHOW_SHADOW_TIP', 'Altmen�lerin etraf?nda g�lge g�ster.' );
define( '_SW_MODULE_POSITION_TIP', '?ablondaki men� mod�l�n�n pozisyonu.' );
define( '_SW_MODULE_ORDER_TIP', ' ?ablon pozisyonundaki men� mod�l�n�n s?ras?.' );
define( '_SW_ACCESS_LEVEL_TIP', 'Men� mod�l� i�in eri?im seviyesi.' );
define( '_SW_TEMPLATE_TIP', 'Men� mod�l� sadece se�ili ?ablonlarda g�sterilecek.' );
define( '_SW_LANGUAGE_TIP', 'Men� mod�l� sadece se�ili dillerde g�sterilecek.' );
define( '_SW_COMPONENT_TIP', 'Men� mod�l� sadece se�ili componentlerde g�sterilecek.' );
define( '_SW_PAGES_TIP', 'SAyfalar? se�: <i>(birden fazla sayfa se�mek i�in ctrl tu?una bas?p mouse?n sol tu?una bas?n.)</i>' );


//swMenuPro Info
define( '_SW_SWMENUPRO_INFO', 'swMenuPro daha sa?lam ve tam men� mod�l y�netim sistemidir. Sadece swMenuPro n?n sunabilece?i imkanlar? ve nas?l g�ncelleyece?inizi �?renmek i�in <a href="http://www.swmenupro.com" >www.swmenupro.com</a> ? t?klay?n.' );
define( '_SW_SWMENUPRO_1', 'swMenuPro 7 men� sisteminden herhangi birini kullanarak s?n?rs?z say?da men� mod�l� yapman?za olanak sa?lars.  swMenuFree sadece 1 men� mod�l�ne izin verir.' );
define( '_SW_SWMENUPRO_2', 'Herhangi bir men� eleman? i�in normal and mouseover? de?i?tir. Arkafon, s?n?rlar, padding vs olabilir. Sadece point and click aray�z�n� kullanarak.' );
define( '_SW_SWMENUPRO_3', 'Herhangi bir men� mod�l�ndeki herhangi bir men� eleman? i�in normal and mouseover images resimleri ata. Ayn? zamanda geni?likler, y�kseklikler, vspace, hspace ve hizalama.(Sadece resimlerden olu?an men�ler yap)' );
define( '_SW_SWMENUPRO_4', 'Herhangi bir men� mod�l�ndeki herhangi bir men� eleman? i�in geli?mi? davran??lar ata. Bu davran??lar  ?u durumlara g�re do?ru ya da yanl?? olabilir:. "men� eleman?n? g�ster?", "men� eleman?n?n ismini g�ster?"(Sadece resimden olu?an men�ler i�in kullan?l?r), "men� eleman? kliklenebilir?"' );
define( '_SW_SWMENUPRO_5', 'Men� mod�l y�neticisini kullanarak yeni men� mod�lleri olu?tur ve y�net.' );


?>