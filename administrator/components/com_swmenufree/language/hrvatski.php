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
define( '_SW_MENU_SYSTEM', 'Izborni�ki sustav' );
define( '_SW_TRANS_MENU', 'Trans izbornik' );
define( '_SW_MYGOSU_MENU', 'MyGosu izbornik' );
define( '_SW_TIGRA_MENU', 'Tigra Menu' );


//Page Names
define( '_SW_MANUAL_CSS_EDITOR', 'Ru�ni CSS ure�iva�' );
define( '_SW_MODULE_EDITOR', 'Ure�iva� Izborni�kih Modula' );
define( '_SW_UPGRADE_FACILITY', 'Funkcija nadogranje' );


//Common Terms
define( '_SW_WRITABLE', 'Zapisivanje mogu�e' );
define( '_SW_UNWRITABLE', 'Zapisivanje NIJE mogu�e' );
define( '_SW_YES', 'Da' );
define( '_SW_NO', 'Ne' );
define( '_SW_HYBRID', 'hibrid' );
define( '_SW_MODULE_NAME', 'Ime modula' );

//Tool Tips
//define( '_SW_MENU_SYSTEM_TIP', 'Izaberite Izborni�ki sustav.<br /><b>Trans izbornik:</b>DHTML popout izborni�ki sustav sa lijepim klize�im efektom podizbornika.<br /><b>MyGosu izbornik:</b>DHTML popout izborni�ki sustav sa boljom kompatibilno��u sa predlo�cima.' );
define( '_SW_SAVE_TIP', 'Kliknite ovdje da biste spremili stilove i promjene u modulima u bazu podataka' );
define( '_SW_CANCEL_TIP', 'Kliknite ovdje da biste odustali od promjena i vratili se u Ure�iva� izborni�kih modula' );
define( '_SW_PREVIEW_TIP', 'Kliknite ovdje da biste pregledali izborni�ki modul u pop-up prozoru' );
define( '_SW_EXPORT_TIP', 'Kliknite ovdje da biste izvezli vanjsku CSS stil datoteku koriste�i trenutne postavke stilova' );

//Buttons text
define( '_SW_SAVE_BUTTON', 'spremi' );
define( '_SW_CANCEL_BUTTON', 'odustani' );
define( '_SW_PREVIEW_BUTTON', 'pregledaj' );
define( '_SW_EXPORT_BUTTON', 'izvezi' );
define( '_SW_UPLOAD_BUTTON', 'Upload datoteke' );


//Internal program links
define( '_SW_UPGRADE_LINK', 'Nadogradnja/popravak swMenuFree.' );
define( '_SW_MANAGER_LINK', 'Ure�ivanje svojstvava izborni�kog modula' );
define( '_SW_CSS_LINK', 'Ru�no uredi vanjsku CSS datoteku' );
define( '_SW_EXPORT_LINK', 'Izvezi vanjsku CSS datoteku' );


//Program Notices
define( '_SW_UPLOAD_FILE_NOTICE', 'Odaberite datoteku za upload.' );
define( '_SW_SAVE_MENU_MESSAGE', 'Postavke su uspje�no spremljene!' );
define( '_SW_SAVE_MENU_CSS_MESSAGE', 'Postavke su spremljene i vanjska CSS datoteka je uspje�no izra�ena' );
define( '_SW_SAVE_CSS_MESSAGE', 'Vanjska CSS datoteka uspje�no spremljena' );
define( '_SW_NO_SAVE_MENU_CSS_MESSAGE', 'Vanjska CSS datoteka nije izra�ena.  Provjerite je li mogu�e zapisivati u mapu modules/mod_swmenufree/styles.' );


//////////////////////////
//Upgrade page
/////////////////////////
define( '_SW_OK', 'Sve je u redu' );
define( '_SW_MESSAGES', 'Poruka' );
define( '_SW_MODULE_SUCCESS', 'Modul je uspje�no nadogra�en.' );
define( '_SW_MODULE_FAIL', 'Nije mogu�e nadograditi modul.  Provjerite da li je mogu�e zapisivati u /modules mapu.' );
define( '_SW_TABLE_UPGRADE', 'Nadogra�eno %s tablica' );
define( '_SW_TABLE_CREATE', 'Izra�eno %s tablica' );
define( '_SW_UPDATE_LINKS', 'Nadogra�eni linkovi u administratorskom izborniku' );

define( '_SW_MODULE_VERSION', 'Trenutna verzija swMenuFree modula' );
define( '_SW_COMPONENT_VERSION', 'Trenutna verzija swMenuFree komponente' );
define( '_SW_UPLOAD_UPGRADE', 'Upload swMenuFree datoteku nadogradnje/izdanja' );
define( '_SW_UPLOAD_UPGRADE_BUTTON', 'Upload &amp; instalacijske datoteke' );

define( '_SW_COMPONENT_SUCCESS', 'swMenuFree komponenta uspje�no nadogra�ema.' );
define( '_SW_COMPONENT_FAIL', 'Nadogradnja nije mogu�a, provjerite da li je mogu�e zapisivanje u sve mape nabrojene ispod.' );
define( '_SW_INVALID_FILE', '�ini se da ovo nije ispravna swMenuFree datoteka nadogradnje/izdanja.' );



//////////////////////////////
//Size Position & Offsets Page
/////////////////////////////
define( '_SW_POSITION_LABEL', 'Pozicija i orijentacija izbornika' );
define( '_SW_SIZES_LABEL', 'Veli�ine izborni�kih stavki' );
define( '_SW_TOP_OFFSETS_LABEL', 'Offset glavnog izbornika' );
define( '_SW_SUB_OFFSETS_LABEL', 'Offset podizbornika' );
define( '_SW_ALIGNMENT_LABEL', 'Poravnanje izbornika' );
define( '_SW_WIDTHS_LABEL', '�irine izborni�kih stavki' );
define( '_SW_HEIGHTS_LABEL', 'Visine izborni�kih stavki' );


define( '_SW_TOP_MENU', 'Glavni izbornik' );
define( '_SW_SUB_MENU', 'Podizbornik' );
define( '_SW_ALIGNMENT', 'Poravnanje' );
define( '_SW_POSITION', 'Pozicija' );
define( '_SW_ORIENTATION', 'Orijentacija' );
define( '_SW_ITEM_WIDTH', '�irina stavke' );
define( '_SW_ITEM_HEIGHT', 'Visina stavke' );
define( '_SW_TOP_OFFSET', 'Gornji Offset' );
define( '_SW_LEFT_OFFSET', 'Lijevi Offset' );
define( '_SW_LEVEL', 'Nivo' );
define( '_SW_AUTOSIZE', '(postavite na 0 za automatsku veli�inu)' );

//////////////////////
//Fonts & Padding Page
/////////////////////
define( '_SW_FONT_FAMILY_LABEL', 'Rod fonta' );
define( '_SW_FONT_SIZE_LABEL', 'Veli�ina fonta' );
define( '_SW_FONT_ALIGNMENT_LABEL', 'Poravnanje teksta' );
define( '_SW_FONT_WEIGHT_LABEL', 'Debljina fonta' );
define( '_SW_PADDING_LABEL', 'Razmak' );


define( '_SW_TOP', 'Vrh' );
define( '_SW_RIGHT', 'Desno' );
define( '_SW_BOTTOM', 'Dno' );
define( '_SW_LEFT', 'Lijevo' );
define( '_SW_FONT_SIZE', 'Veli�ina fonta' );
define( '_SW_FONT_ALIGNMENT', 'Poravnanje teksta' );
define( '_SW_FONT_WEIGHT', 'Debljina fonta' );
define( '_SW_PADDING', 'Razmak' );
define( '_SW_FONT_TIP', 'Svi web preglednici iscrtavaju fontove i veli�ine druga�ije. Dolje se nalazi popis kako je Va� web preglednik iscrtao upisane fontove i veli�ine.' );

/////////////////////////
//Borders & Effects Page
////////////////////////
define( '_SW_BORDER_WIDTHS_LABEL', '�irine rubova' );
define( '_SW_BORDER_STYLES_LABEL', 'Stilovi rubova' );
define( '_SW_SPECIAL_EFFECTS_LABEL', 'Specijalni efekti' );

define( '_SW_OUTSIDE_BORDER', 'Vanjski rub' );
define( '_SW_INSIDE_BORDER', 'Unutarnji rub' );
define( '_SW_NORMAL_BORDER', 'Rub' );
define( '_SW_WIDTH', '�irina' );
define( '_SW_HEIGHT', 'Visina' );
define( '_SW_DIVIDER', 'Razdjelnik' );
define( '_SW_STYLE', 'Stil' );
define( '_SW_DELAY', 'Otvori/zatvori vrem.odmak' );
define( '_SW_OPACITY', 'Prozirnost' );

///////////////////////////
//Colors & Backgrounds Page
///////////////////////////
define( '_SW_BACKGROUND_IMAGE_LABEL', 'Pozadinske slike' );
define( '_SW_BACKGROUND_COLOR_LABEL', 'Pozadinske boje' );
define( '_SW_FONT_COLOR_LABEL', 'Boje fontova' );
define( '_SW_BORDER_COLOR_LABEL', 'Boje ruba' );


define( '_SW_BACKGROUND', 'Pozadina' );
define( '_SW_OVER_BACKGROUND', 'Iznad pozadine' );
define( '_SW_COLOR', '- boja' );
define( '_SW_OVER_COLOR', '"Iznad"-boja' );
define( '_SW_FONT', '- boja fonta' );
define( '_SW_OVER_FONT', '"Iznad fonta"-boja' );
define( '_SW_OUTSIDE_BORDER_COLOR', '- boja vanjskog ruba' );
define( '_SW_INSIDE_BORDER_COLOR', '- boja unutarnjeg ruba' );
define( '_SW_NORMAL_BORDER_COLOR', '- boja ruba' );
define( '_SW_GET', 'Preuzmi' );
define( '_SW_COLOR_TIP', 'Odaberite boju u paletnom krugu boja a zatim kliknite na %s desno od ikone palete boja da biste primjenili odabranu boju.');
define( '_SW_PRESENT_COLOR', 'Trenutna boja' );
define( '_SW_SELECTED_COLOR', 'Odabrana boja' );


///////////////////////////
//Menu Module Settings Page
///////////////////////////
define( '_SW_MENU_SOURCE_LABEL', 'Postavke izvora izbornika' );
define( '_SW_STYLE_SHEET_LABEL', 'Postavke stilske datoteke' );
define( '_SW_AUTO_ITEM_LABEL', 'Postavke auto-izbornik stavki' );
define( '_SW_CACHE_LABEL', 'Postavke cachea' );
define( '_SW_GENERAL_LABEL', 'Op�e modulske postavke' );
define( '_SW_POSITION_ACCESS_LABEL', 'Smje�taj &amp; pristup' );
define( '_SW_PAGES_LABEL', 'Prikazati izborni�ki modul na slijede�im xstranicama' );
define( '_SW_CONDITIONS_LABEL', 'Uvijeti' );

//Select box text
define( '_SW_CSS_DYNAMIC_SELECT', 'Zapisati stilove direktno u stranicu' );
define( '_SW_CSS_LINK_SELECT', 'Veza na vanjsku stilsku datoteku' );
define( '_SW_CSS_IMPORT_SELECT', 'Uvoz vanjske stilske datoteke' );
define( '_SW_CSS_NONE_SELECT', 'Ne povezivati stilske datoteke' );

define( '_SW_SOURCE_CONTENT_SELECT', 'Koristiti samo slijede�i sadr�aj' );
define( '_SW_SOURCE_EXISTING_SELECT', 'Odaberite dolje naveden postoje�i izbornik' );

define( '_SW_SHOW_TABLES_SELECT', 'Prikazati kao tablice' );
define( '_SW_SHOW_BLOGS_SELECT', 'Prikazati kao blogove' );

define( '_SW_10SECOND_SELECT', '10 sekundi' );
define( '_SW_1MINUTE_SELECT', '1 minuta' );
define( '_SW_30MINUTE_SELECT', '30 minuta' );
define( '_SW_1HOUR_SELECT', '1 sat' );
define( '_SW_6HOUR_SELECT', '6 sati' );
define( '_SW_12HOUR_SELECT', '12 sati' );
define( '_SW_1DAY_SELECT', '1 dan' );
define( '_SW_3DAY_SELECT', '3 dana' );
define( '_SW_1WEEK_SELECT', '1 tjedan' );

//top tabs text
define( '_SW_MODULE_SETTINGS_TAB', 'Postavke izborni�kog modula' );
define( '_SW_SIZE_OFFSETS_TAB', 'Veli�ine, Pozicije &amp; Offseti' );
define( '_SW_COLOR_BACKGROUNDS_TAB', 'Boje &amp; Pozadine' );
define( '_SW_FONTS_PADDING_TAB', 'Fontovi &amp; Razmaci' );
define( '_SW_BORDERS_EFFECTS_TAB', 'Rubovi &amp; Efekti' );


//general text
define( '_SW_MENU_SOURCE', 'Izvor izbornika' );
define( '_SW_PARENT', 'Roditelj' );
define( '_SW_STYLE_SHEET', 'U�itaj stilsku datoteku' );
define( '_SW_CLASS_SFX', 'Sufiks CSS klase modula' );
define( '_SW_HYBRID_MENU', 'Hibridni izbornik' );
define( '_SW_TABLES_BLOGS', 'Koristiti tabele/blogove' );
define( '_SW_CACHE_ITEMS', 'Cache izborni�kih stavki' );
define( '_SW_CACHE_REFRESH', 'Vrijeme osvje�avanja Cachea' );
define( '_SW_SHOW_NAME', 'Prikaz imena modula' );
define( '_SW_PUBLISHED', 'Objavljeno');
define( '_SW_ACTIVE_MENU', 'Aktivni izbornik' );
define( '_SW_MAX_LEVELS', 'Maksimalno nivoa' );
define( '_SW_PARENT_LEVEL', 'Roditeljski nivo' );
define( '_SW_SELECT_HACK', 'Select Box Hack' );
define( '_SW_SUB_INDICATOR', 'Podizborni�ki indikator' );
define( '_SW_SHOW_SHADOW', 'Prikaz sjene' );
define( '_SW_MODULE_POSITION', 'Pozicija modula' );
define( '_SW_MODULE_ORDER', 'Redoslijed modula' );
define( '_SW_ACCESS_LEVEL', 'Pristupni nivo' );
define( '_SW_TEMPLATE', 'Predlo�ak' );
define( '_SW_LANGUAGE', 'Jezik' );
define( '_SW_COMPONENT', 'Komponenta' );

//tool tips
define( '_SW_MENU_SOURCE_TIP', 'Odaberite ispravni izbornik koji �e biti izvor stavki za Va� izborni�ki modul.' );
define( '_SW_PARENT_TIP', 'Odaberite roditelja za prikaz dijela izvornog izbornika. Postavite na TOP da biste prikazali sve stavke iz izvornog izbornika.' );
define( '_SW_STYLE_SHEET_TIP', '<b>Dinami�ki:</b> zapisuje stilske postavke u datoteku smje�tenu u direktorij iz kog se poziva modul.<br /><b>Vanjska veza: </b>povezuje na vanjsku stilsku datoteku koja je izvezena.<br /><b>Ne povezati:</b> ru�no �ete zalijepiti Va�u vlastitu vezn na vanjsku datoteku stilova u zaglavlje Va�eg predlo�ka. Izborni�ki moduli �e tada biti ispravno iscrtani.' );
define( '_SW_CLASS_SFX_TIP', 'Sufiks koji se smje�ta iza moduletable CSS-a.  Mo�e se koristiti da bi se izbjegli konflikti sa moduletable CSS-om predlo�ka i za vi�e opcija kod stiliziranja kroz CSS datoteku predlo�ka.' );
define( '_SW_HYBRID_MENU_TIP', 'Automatsko dodavanje stavki izbornika ka izborni�kim stavkama koje povezuju na sadr�ajne kategorijske/sekcijske tablice/blogove.' );
define( '_SW_TABLES_BLOGS_TIP', 'Prikazati automatski kreirane kategorijske/sekcijske izborni�ke stavke kao tablice ili blogove.' );
define( '_SW_CACHE_ITEMS_TIP', 'Koristiti cache datoteku za pove�anje performansi i cache izborni�kih stavki.  Posebno korisno kod problema sa performansama kod hibridni izbornika, gdje veliki izbornici zahtjevaju i mnogo SQL upita koje treba generirati.  Cache to smanjuje na samo jedan upit izme�u cache intervala.' );
define( '_SW_CACHE_REFRESH_TIP', 'Vremenski interval izme�u osvje�avanja cache strukture izborni�kih stavaka.' );
define( '_SW_SHOW_NAME_TIP', 'Prika�i ime izborni�kog modula.' );
define( '_SW_PUBLISHED_TIP', 'Objaviti ili ne objaviti izborni�ki modul.');
define( '_SW_ACTIVE_MENU_TIP', 'Ostaviti trenutnu stavku glavnog izbornika aktivnom dok se pregledava stranica.' );
define( '_SW_MAX_LEVELS_TIP', 'Maksimalni broj nivoa izvornog izbornika koji �e se prikazati.  Postaviti na 0 da bi se prikazali svi nivoi.' );
define( '_SW_PARENT_LEVEL_TIP', 'Napredna postavka koja prati izvorni izbornik natrag do odre�enog nivoa.  Obi�no se postavlja na 0.' );
define( '_SW_SELECT_HACK_TIP', 'Primjeniti hack u izbornik koji �e omogu�iti da podizbornici budu prikazani iznad select box elemenata na formama u IE.' );
define( '_SW_SUB_INDICATOR_TIP', 'Prikazati malu strelicu u podizborniku kao indikator da podizbornik ima djecu-stavke.' );
define( '_SW_SHOW_SHADOW_TIP', 'Prikazati sjenu oko podizbornika.' );
define( '_SW_MODULE_POSITION_TIP', 'Pozicija izborni�kog modula u predlo�ku.' );
define( '_SW_MODULE_ORDER_TIP', 'Poredak modula u poziciji predlo�ka.' );
define( '_SW_ACCESS_LEVEL_TIP', 'Pristupni nivo za izborni�ki modul.' );
define( '_SW_TEMPLATE_TIP', 'Izborni�ki modul �e biti prikazan samo na odabranom predlo�ku.' );
define( '_SW_LANGUAGE_TIP', 'Izborni�ki modul �e biti prikazan samo kod odabranog jezika.' );
define( '_SW_COMPONENT_TIP', 'Izborni�ki modul �e biti prikazan samo kod odabrane komponente.' );
define( '_SW_PAGES_TIP', 'Odaberite stranice: <i>(dr�ite CTRL tipku dok klikate lijevom tipkom mi�a da biste odabrali vi�e stranica.)</i>' );


//swMenuPro Info
define( '_SW_SWMENUPRO_INFO', 'swMenuPro je robusnija i kompletnija solucija za ure�ivanje izborni�kih modula.  Posjetite <a href="http://www.swonline.biz" >www.swonline.biz</a> da biste
        saznali kako da biste nadogradili i u�ivali punu snagu i navigacijske mogu�nosti koje Vam mo�e pru�iti swMenuPro.' );
define( '_SW_SWMENUPRO_1', 'swMenuPro dozvoljava neograni�eno izborni�kih modula koriste�i bilo koji od 7 dostupnih izborni�kih sustava.  swMenuFree dozvoljava samo 1 izborni�ki modul.' );
define( '_SW_SWMENUPRO_2', 'Izmjenite normalni i mouseover CSS za bilo koju izborni�ku stavku unutar bilo kojeg izborni�kog modula.  To mogu biti pozadine, rubovi, razmaci itd... koriste�i jednostavno "odaberi i klikni" su�elje.' );
define( '_SW_SWMENUPRO_3', 'Dodjelite normalne i mouseover slike izborni�kim stavkama unutar bilo kog izborni�kog modula, kao i �irine, visine, vspace, hspace i poravnanje.(Izradite izbornike sa�injene samo od slika)' );
define( '_SW_SWMENUPRO_4', 'Dodjelite napredne reakcije (behaviours) za bilo koju stavku u bilo kom izborniku.  Te reakcije mogu biti "da" ili "ne" za slijede�e uvijete: "prikazati izborni�ku stavku?", "prikazati ime izborni�ke stavke?"(Koristi se za izradu izbornika sa�injenih samo od slika), "je li na stavku mogu�e kliknuti?"' );
define( '_SW_SWMENUPRO_5', 'Ure�ujte i izra�ujte nove izborni�ke module koriste�i ugra�eni manager izborni�kih modula.' );


?>