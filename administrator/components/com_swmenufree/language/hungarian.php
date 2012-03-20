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


define( '_SW_UPGRADE_VERSIONS', 'Current Installed swMenuFree Versions' );
define( '_SW_SELECTED_LANGUAGE_HEADING', 'Current Language File' );
define( '_SW_LANGUAGE_FILES', 'Select New Language File' );
define( '_SW_LANGUAGE_CHANGE_BUTTON', 'Change Language' );
define( '_SW_FILE_PERMISSIONS', 'Current File Permissions' );
define( '_SW_LANGUAGE_SUCCESS', 'Succesfully Added New swMenuFree Language File.' );
define( '_SW_LANGUAGE_FAIL', 'Could not upload language file, please make sure all directories listed below are writable.' );

//Menu Names
define( '_SW_MENU_SYSTEM', 'Men�rendszer' );
define( '_SW_TRANS_MENU', 'Trans Menu' );
define( '_SW_MYGOSU_MENU', 'MyGosu Menu' );
define( '_SW_TIGRA_MENU', 'Tigra Menu' );


//Page Names
define( '_SW_MANUAL_CSS_EDITOR', 'K�zi CSS szerkeszt�' );
define( '_SW_MODULE_EDITOR', 'Men�modul szerkeszt�' );
define( '_SW_UPGRADE_FACILITY', 'Friss�t�s' );


//Common Terms
define( '_SW_WRITABLE', '�rhat�' );
define( '_SW_UNWRITABLE', 'Nem �rhat�' );
define( '_SW_YES', 'Igen' );
define( '_SW_NO', 'Nem' );
define( '_SW_HYBRID', 'hibrid' );
define( '_SW_MODULE_NAME', 'Modul neve' );

//Tool Tips
//define( '_SW_MENU_SYSTEM_TIP', 'V�lasszon men�rendszert .<br /><b>Trans Menu:</b> Dinamikus leg�rd�l� men�rendszer ig�nyes almen� nyit� effektussal<br /><b>MyGosu Menu:</b> Dinamikus leg�rd�l� men�rendszer jobb sablon kompatibilit�ssal' );
define( '_SW_SAVE_TIP', 'A st�luson �s a modulon v�gzett �sszes v�ltoztat�s elment�s�hez kattintson ide' );
define( '_SW_CANCEL_TIP', 'A v�ltoztat�sok �rv�nytelen�t�s�hez �s a men�kezel�be val� visszat�r�shez kattintson ide' );
define( '_SW_PREVIEW_TIP', 'Az el�bukkan� ablakban megjelen� el�n�zeti k�p megtekint�s�hez kattintson ide' );
define( '_SW_EXPORT_TIP', 'A jelenleg haszn�lt st�lusbe�ll�t�sok k�ls� st�luslapba t�rt�n� kiment�s�hez kattintson ide' );

//Buttons text
define( '_SW_SAVE_BUTTON', 'Ment�s' );
define( '_SW_CANCEL_BUTTON', 'M�gse' );
define( '_SW_PREVIEW_BUTTON', 'El�n�zet' );
define( '_SW_EXPORT_BUTTON', 'Export�l�s' );
define( '_SW_UPLOAD_BUTTON', 'F�jl felt�lt�se' );


//Internal program links
define( '_SW_UPGRADE_LINK', 'swMenuFree friss�t�se/helyre�ll�t�sa.' );
define( '_SW_MANAGER_LINK', 'Men�modul tulajdons�gainak szerkeszt�se' );
define( '_SW_CSS_LINK', 'K�ls� CSS f�jl k�zi szerkeszt�se' );
define( '_SW_EXPORT_LINK', 'Export�l�s k�ls� CSS f�jlba' );


//Program Notices
define( '_SW_UPLOAD_FILE_NOTICE', 'V�lassza ki a felt�lteni k�v�nt f�jlt' );
define( '_SW_SAVE_MENU_MESSAGE', 'A be�ll�t�sok ment�se siker�lt' );
define( '_SW_SAVE_MENU_CSS_MESSAGE', 'A be�ll�t�sok ment�se megt�rt�nt, �s a k�ls� CSS f�jl l�trehoz�sa siker�lt' );
define( '_SW_SAVE_CSS_MESSAGE', 'A k�ls� CSS f�jl ment�se siker�lt' );
define( '_SW_NO_SAVE_MENU_CSS_MESSAGE', 'A k�ls� CSS f�jlt nem siker�lt l�trehozni. Gy�z�dj�n meg arr�l, hogy �rhat�-e a modules/mod_swmenufree/styles mappa.' );


//////////////////////////
//Upgrade page
/////////////////////////
define( '_SW_OK', 'Minden rendben' );
define( '_SW_MESSAGES', '�zenetek' );
define( '_SW_MODULE_SUCCESS', 'A modul friss�t�se siker�lt.' );
define( '_SW_MODULE_FAIL', 'A modult nem siker�lt friss�teni. Gy�z�dj�n meg arr�l, hogy �rhat�-e a /modules mappa.' );
define( '_SW_TABLE_UPGRADE', 'A(z) %s t�bla friss�tve' );
define( '_SW_TABLE_CREATE', 'A(z) %s t�bla l�trehozva' );
define( '_SW_UPDATE_LINKS', 'Az admin men� hivatkoz�sainak friss�t�se megt�rt�nt' );

define( '_SW_MODULE_VERSION', 'Jelenlegi swMenuFree modul verzi�' );
define( '_SW_COMPONENT_VERSION', 'Jelenlegi swMenuFree komponens verzi�' );
define( '_SW_UPLOAD_UPGRADE', 'swMenuFree friss�t�s/�j verzi� felt�lt�se' );
define( '_SW_UPLOAD_UPGRADE_BUTTON', 'F�jl felt�lt�se �s telep�t�se' );

define( '_SW_COMPONENT_SUCCESS', 'Az swMenuFree komponens friss�t�se siker�lt.' );
define( '_SW_COMPONENT_FAIL', 'A friss�t�s nem siker�lt, gy�z�dj�n meg arr�l, hogy �rhat�ak-e az al�bbi list�ban szerepl� mapp�k.' );
define( '_SW_INVALID_FILE', '�rv�nytelen swMenuFree friss�t�s/�j verzi� f�jl .' );



//////////////////////////////
//Size Position & Offsets Page
/////////////////////////////
define( '_SW_POSITION_LABEL', 'Men� helye �s ir�nya' );
define( '_SW_SIZES_LABEL', 'Men�pont m�retei' );
define( '_SW_TOP_OFFSETS_LABEL', 'F�men� ir�nya' );
define( '_SW_SUB_OFFSETS_LABEL', 'Almen� ir�nya' );
define( '_SW_ALIGNMENT_LABEL', 'Men� igaz�t�s' );
define( '_SW_WIDTHS_LABEL', 'Men�pont sz�less�ge' );
define( '_SW_HEIGHTS_LABEL', 'Men�pont magass�ga' );


define( '_SW_TOP_MENU', 'F�men�' );
define( '_SW_SUB_MENU', 'Almen�' );
define( '_SW_ALIGNMENT', 'sz�vegigaz�t�s' );
define( '_SW_POSITION', 'poz�ci�ja' );
define( '_SW_ORIENTATION', 'ir�nya' );
define( '_SW_ITEM_WIDTH', 'men�pont sz�less�ge' );
define( '_SW_ITEM_HEIGHT', 'men�pont magass�ga' );
define( '_SW_TOP_OFFSET', 'eltol�s fentr�l' );
define( '_SW_LEFT_OFFSET', 'eltol�s balr�l' );
define( '_SW_LEVEL', 'Szint' );
define( '_SW_AUTOSIZE', '0 �rt�k eset�n automatikus m�retez�s' );

//////////////////////
//Fonts & Padding Page
/////////////////////
define( '_SW_FONT_FAMILY_LABEL', 'Bet�csal�d' );
define( '_SW_FONT_SIZE_LABEL', 'Bet�m�ret' );
define( '_SW_FONT_ALIGNMENT_LABEL', 'Sz�vegigaz�t�s' );
define( '_SW_FONT_WEIGHT_LABEL', 'Bet�vastags�g' );
define( '_SW_PADDING_LABEL', 'Sz�vegt�vols�g' );


define( '_SW_TOP', 'Fentr�l' );
define( '_SW_RIGHT', 'Jobbr�l' );
define( '_SW_BOTTOM', 'Alulr�l' );
define( '_SW_LEFT', 'Balr�l' );
define( '_SW_FONT_SIZE', 'bet�m�rete' );
define( '_SW_FONT_ALIGNMENT', 'sz�vegigaz�t�s' );
define( '_SW_FONT_WEIGHT', 'bet�vastags�ga' );
define( '_SW_PADDING', 'sz�vegt�vols�ga' );
define( '_SW_FONT_TIP', 'Minden b�ng�sz� elt�r� m�don jelen�ti meg az egyes bet�ket, ill. bet�m�reteket. Az al�bbi lista megmutatja, hogy az �n b�ng�sz�je hogyan jelen�ti meg a k�l�nb�z� bet�ket �s bet�m�reteket.' );

/////////////////////////
//Borders & Effects Page
////////////////////////
define( '_SW_BORDER_WIDTHS_LABEL', 'Szeg�ly vastags�ga' );
define( '_SW_BORDER_STYLES_LABEL', 'Szeg�ly st�lusa' );
define( '_SW_SPECIAL_EFFECTS_LABEL', 'K�l�nleges effektusok' );

define( '_SW_OUTSIDE_BORDER', 'k�ls� szeg�ly�nek' );
define( '_SW_INSIDE_BORDER', 'bels� szeg�ly�nek' );
define( '_SW_NORMAL_BORDER', 'szeg�ly' );
define( '_SW_WIDTH', 'sz�less�ge' );
define( '_SW_HEIGHT', 'magass�ga' );
define( '_SW_DIVIDER', 'Elv�laszt�' );
define( '_SW_STYLE', 'st�lusa' );
define( '_SW_DELAY', 'Almen� nyit�s�nak k�sleltet�se' );
define( '_SW_OPACITY', '�tl�tsz�s�ga' );

///////////////////////////
//Colors & Backgrounds Page
///////////////////////////
define( '_SW_BACKGROUND_IMAGE_LABEL', 'H�tt�rk�p' );
define( '_SW_BACKGROUND_COLOR_LABEL', 'H�tt�r sz�ne' );
define( '_SW_FONT_COLOR_LABEL', 'Bet�sz�n' );
define( '_SW_BORDER_COLOR_LABEL', 'Szeg�ly sz�ne' );


define( '_SW_BACKGROUND', 'H�tt�r' );
define( '_SW_OVER_BACKGROUND', 'kijel�lve - h�tt�rk�p ' );
define( '_SW_COLOR', 'Sz�n' );
define( '_SW_OVER_COLOR', 'kijel�lve - h�tt�rsz�n' );
define( '_SW_FONT', 'Bet�sz�n' );
define( '_SW_OVER_FONT', 'kijel�lve - bet�sz�n' );
define( '_SW_OUTSIDE_BORDER_COLOR', 'k�ls� szeg�ly�nek sz�ne' );
define( '_SW_INSIDE_BORDER_COLOR', 'bels� szeg�ly�nek sz�ne' );
define( '_SW_NORMAL_BORDER_COLOR', 'szeg�ly sz�ne' );
define( '_SW_GET', 'Be�ll�t' );
define( '_SW_COLOR_TIP', 'V�lasszon egy sz�nt a palett�r�l, majd kattintson a paletta melletti %s gombra a kiv�lasztott sz�n alkalmaz�s�hoz.');
define( '_SW_PRESENT_COLOR', 'Jelenlegi sz�n' );
define( '_SW_SELECTED_COLOR', 'Kiv�lasztott sz�n' );


///////////////////////////
//Menu Module Settings Page
///////////////////////////
define( '_SW_MENU_SOURCE_LABEL', 'Men�forr�s be�ll�t�sa' );
define( '_SW_STYLE_SHEET_LABEL', 'St�luslap be�ll�t�sa' );
define( '_SW_AUTO_ITEM_LABEL', 'Automatikus men�pontok be�ll�t�sa' );
define( '_SW_CACHE_LABEL', 'Gyors�t�t�r be�ll�t�sa' );
define( '_SW_GENERAL_LABEL', '�ltal�nos modulbe�ll�t�sok' );
define( '_SW_POSITION_ACCESS_LABEL', 'Poz�ci� �s hozz�f�r�s' );
define( '_SW_PAGES_LABEL', 'Men�modul megjelen�t�se a kiv�lasztott oldalakon' );
define( '_SW_CONDITIONS_LABEL', 'Felt�telek' );

//Select box text
define( '_SW_CSS_DYNAMIC_SELECT', 'St�lusinform�ci�k �r�sa k�zvetlen�l az oldal forr�sk�dj�ba' );
define( '_SW_CSS_LINK_SELECT', 'Hivatkoz�s k�ls� st�luslapra' );
define( '_SW_CSS_IMPORT_SELECT', 'K�ls� st�luslap import�l�sa' );
define( '_SW_CSS_NONE_SELECT', 'Nincs hivatkoz�s st�luslapra' );

define( '_SW_SOURCE_CONTENT_SELECT', 'Csak tartalmi elemek haszn�lata' );
define( '_SW_SOURCE_EXISTING_SELECT', 'V�lasszon az al�bbi men�k k�z�l' );

define( '_SW_SHOW_TABLES_SELECT', 'Megjelen�t�s t�bl�zatk�nt' );
define( '_SW_SHOW_BLOGS_SELECT', 'Megjelen�t�s blogk�nt' );

define( '_SW_10SECOND_SELECT', '10 m�sodperc' );
define( '_SW_1MINUTE_SELECT', '1 perc' );
define( '_SW_30MINUTE_SELECT', '30 perc' );
define( '_SW_1HOUR_SELECT', '1 �ra' );
define( '_SW_6HOUR_SELECT', '6 �ra' );
define( '_SW_12HOUR_SELECT', '12 �ra' );
define( '_SW_1DAY_SELECT', '1 nap' );
define( '_SW_3DAY_SELECT', '3 nap' );
define( '_SW_1WEEK_SELECT', '1 h�t' );

//top tabs text
define( '_SW_MODULE_SETTINGS_TAB', 'Men�modul be�ll�t�sa' );
define( '_SW_SIZE_OFFSETS_TAB', 'M�ret, poz�ci� �s eltol�s' );
define( '_SW_COLOR_BACKGROUNDS_TAB', 'Sz�nek �s h�tt�r' );
define( '_SW_FONTS_PADDING_TAB', 'Bet� �s sz�vegt�vols�g' );
define( '_SW_BORDERS_EFFECTS_TAB', 'Szeg�lyek �s effektusok' );


//general text
define( '_SW_MENU_SOURCE', 'Men� forr�sa' );
define( '_SW_PARENT', 'Sz�l�' );
define( '_SW_STYLE_SHEET', 'St�luslap bet�lt�se' );
define( '_SW_CLASS_SFX', 'Modul st�lusoszt�ly-ut�tag' );
define( '_SW_HYBRID_MENU', 'Hibrid men�' );
define( '_SW_TABLES_BLOGS', 'T�bl�zat/blog haszn�lata' );
define( '_SW_CACHE_ITEMS', 'Men�pontok cach-el�se' );
define( '_SW_CACHE_REFRESH', 'Gyors�t�t�r friss�t�si ideje' );
define( '_SW_SHOW_NAME', 'Moduln�v megjelen�t�se' );
define( '_SW_PUBLISHED', 'K�zz�t�ve');
define( '_SW_ACTIVE_MENU', 'Akt�v men�' );
define( '_SW_MAX_LEVELS', 'Szintek sz�ma' );
define( '_SW_PARENT_LEVEL', 'Sz�l� elem szintje' );
define( '_SW_SELECT_HACK', 'Leg�rd�l� lista hibajav�t�sa' );
define( '_SW_SUB_INDICATOR', 'Almen� ikon' );
define( '_SW_SHOW_SHADOW', '�rny�k megjelen�t�se' );
define( '_SW_MODULE_POSITION', 'Modulpoz�ci�' );
define( '_SW_MODULE_ORDER', 'Modulok sorrendje' );
define( '_SW_ACCESS_LEVEL', 'Hozz�f�r�si szint' );
define( '_SW_TEMPLATE', 'Sablon' );
define( '_SW_LANGUAGE', 'Nyelv' );
define( '_SW_COMPONENT', 'Komponens' );

//tool tips
define( '_SW_MENU_SOURCE_TIP', 'V�lasszon egy �rv�nyes/l�tez� men�t, amely forr�sk�nt szolg�l a men�modul sz�m�ra.' );
define( '_SW_PARENT_TIP', 'V�lasszon egy sz�l� elemet, amely megjelen�ti a forr�smen� egy r�sz�t. Ha mindegyik men�pontot meg akarja jelen�teni, akkor a sz�l� elemet �ll�tsa TOP-ra .' );
define( '_SW_STYLE_SHEET_TIP', '<b>Dinamikus: </b>k�zvetlen�l abba a lapba ker�lnek a st�lusinform�ci�k, amely a modult megjelen�ti.<br /><b>K�ls� hivatkoz�s: </b>egy, m�r kimentett k�ls� st�luslapra hivatkozik.<br /><b>Nincs hivatkoz�s:</b> Saj�tkez�leg illessze be a k�ls� st�luslapra mutat� hivatkoz�st, sablonj�nak fejl�c r�sz�ben. A men�modulja �gy lesz teljesen m�k�d�k�pes.' );
define( '_SW_CLASS_SFX_TIP', 'Az ut�tagot helyezze a sablonj�ban egy .moduletable st�lusoszt�ly el�. Ezzel elker�lheti a t�bbi st�lusoszt�llyal val� �tk�z�st, �s m�g t�bb param�tert tud testreszabni a sablonja seg�ts�g�vel. ' );
define( '_SW_HYBRID_MENU_TIP', 'A kateg�ria, szekci� �s blog t�pus� men�pontokhoz automatikusan hozz�f�zi azok tartalmi elemeit is.' );
define( '_SW_TABLES_BLOGS_TIP', 'Az automatikusan l�trehozott szekci�/kateg�ria elemeket t�bl�zatos vagy blog form�tumban jelen�ti meg.' );
define( '_SW_CACHE_ITEMS_TIP', 'Egy f�jlt haszn�l �tmeneti t�rol�k�nt, hogy abban t�rolja a men�pontokat, �s ez�ltal n�velje a teljes�tm�nyt. K�l�n�sen hasznos a hibrid men�n�l, ahol a nagyobb men�, t�bb SQL k�r�s lefuttat�s�t teszi sz�ks�gess�. Az �tmeneti t�rol� k�t friss�t�s k�z�tt ezt egyetlen sornyi lek�rdez�sre cs�kkenti.' );
define( '_SW_CACHE_REFRESH_TIP', 'Az �tmeneti t�rol� friss�t�s�nek gyakoris�ga.' );
define( '_SW_SHOW_NAME_TIP', 'Megjelen�ti a modul nev�t.' );
define( '_SW_PUBLISHED_TIP', 'K�zz�teszi vagy visszavonja a men�modult.');
define( '_SW_ACTIVE_MENU_TIP', 'Az aktu�lisan haszn�lt f�men�pontot k�l�n sz�nnel emeli ki, mindaddig, m�g az �ltala hivatkozott oldalon tart�zkodunk.' );
define( '_SW_MAX_LEVELS_TIP', 'A megjelen�tend� forr�smen� szintjeinek sz�ma. Az �sszes szint megjelen�t�s�hez �ll�tsa 0-ra.' );
define( '_SW_PARENT_LEVEL_TIP', 'Olyan speci�lis be�ll�t�s, amely a modul men�forr�s�t egy el�re be�ll�tott szintig k�veti vissza.  Az alap�rt�k 0.' );
define( '_SW_SELECT_HACK_TIP', 'Olyan hibajav�t�st alkalmaz a men�n, amely lehet�v� teszi az almen�k sz�m�ra, hogy IE-ben az �rlapokon szerepl� leg�rd�l� lista felett is megfelel�en m�k�djenek.' );
define( '_SW_SUB_INDICATOR_TIP', 'Megjelen�t egy kis ny�l ikont azokban az almen�pontokban, amelyeknek tov�bbi men�pontjaik vannak.' );
define( '_SW_SHOW_SHADOW_TIP', 'Megjelen�ti az �rny�kot az almen�k k�r�l.' );
define( '_SW_MODULE_POSITION_TIP', 'A men�modul poz�ci�ja a sablonban.' );
define( '_SW_MODULE_ORDER_TIP', 'A men�modul sorrendje az adott poz�ci�ban.' );
define( '_SW_ACCESS_LEVEL_TIP', 'A men�modul hozz�f�r�si szintje.' );
define( '_SW_TEMPLATE_TIP', 'A men�modul csak a kiv�lasztott sablonban jelenik meg.' );
define( '_SW_LANGUAGE_TIP', 'A men�modul csak a kiv�lasztott nyelven jelenik meg.' );
define( '_SW_COMPONENT_TIP', 'A men�modul csak a kiv�lasztott komponenssel egy�tt jelenik meg.' );
define( '_SW_PAGES_TIP', 'Oldalak kiv�laszt�sa: <i>(A CTRL gomb nyomva tart�s�val egyszerre t�bb oldalt is kijel�lhet.)</i>' );


//swMenuPro Info
define( '_SW_SWMENUPRO_INFO', 'Az swMenuPro egy er�teljesebb �s �sszetettebb men�kezel� megold�s.  L�togasson a <a href="http://www.swonline.biz"  >www.swonline.biz</a> c�mre, hogy megtudja, hogyan tud friss�teni az swMenuPro v�ltozatra, �s hogyan hasznos�thatja azt a k�pess�get �s navig�ci�s lehet�s�get, amit csak az swMenuPro tud ny�jtani.' );
define( '_SW_SWMENUPRO_1', 'Az swMenuPro korl�tlan sz�m� men�modul haszn�lat�t teszi lehet�v�, a rendelk�z�sre �ll� 7 men�rendszer k�z�l b�rmelyiket haszn�lva. Az swMenuFree csup�n egyetlen men�modul haszn�lat�t biztos�tja.' );
define( '_SW_SWMENUPRO_2', 'Haszn�ljon felv�ltva m�s �s m�s st�luslapot b�rmely norm�l �s kijel�lt �llapot� men�ponthoz, b�rmely men�modulon bel�l. Felv�ltva haszn�lhat k�l�nb�z� h�ttereket, szeg�lyeket, sz�vegt�vols�gokat stb... egy egyszer� "kijel�l�s �s kattint�s" seg�ts�g�vel.' );
define( '_SW_SWMENUPRO_3', 'Rendeljen m�s �s m�s h�tt�rk�pet b�rmely norm�l �s kijel�lt �llapot� men�ponthoz, b�rmely men�modulon bel�l, �ll�tsa be a k�p sz�less�g�t, magass�g�t, a v�zszintes �s f�gg�leges marg�it, vagy az elhelyezked�s�t.(Hozzon l�tre csak k�pekb�l �ll� men�t)' );
define( '_SW_SWMENUPRO_4', 'Rendeljen tov�bbi tulajdons�gokat b�rmely men�ponthoz, b�rmely men�modulon bel�l.  Ezek a tulajdons�gok az al�bbi felt�telekhez kapcsol�d�an l�pnek m�k�d�sbe. "L�tsz�dik a men�pont?", "L�tsz�dik a men�pont neve?"(�ltal�ban a csak k�pet haszn�l� men�kn�l), "R� lehet kattintani a men�pontra?"' );
define( '_SW_SWMENUPRO_5', 'Hozzon l�tre �j men�modulokat a be�p�tett men�modul kezel� seg�ts�g�vel.' );


?>
