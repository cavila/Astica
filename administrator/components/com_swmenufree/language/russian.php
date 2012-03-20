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

//����� ������� swMenuFree 4.5


define( '_SW_UPGRADE_VERSIONS', '������� ������������� ������ swMenuFree' );
define( '_SW_SELECTED_LANGUAGE_HEADING', '������� �������� ����' );
define( '_SW_LANGUAGE_FILES', '�������� ����� �������� ����' );
define( '_SW_LANGUAGE_CHANGE_BUTTON', '������� ����' );
define( '_SW_FILE_PERMISSIONS', '������� ���������� �� ������' );
define( '_SW_LANGUAGE_SUCCESS', '����� �������� ���� swMenuFree ������� ��������.' );
define( '_SW_LANGUAGE_FAIL', '���������� ��������� �������� ����, ����������, ���������, ��� ��� ������������� ����� �������� ��� ������.' );


//����� ����
define( '_SW_MENU_SYSTEM', '������� ����' );
define( '_SW_TRANS_MENU', 'Trans Menu' );
define( '_SW_MYGOSU_MENU', 'MyGosu Menu' );
define( '_SW_TIGRA_MENU', 'Tigra Menu' );


//����� �������
define( '_SW_MANUAL_CSS_EDITOR', '������ �������� CSS' );
define( '_SW_MODULE_EDITOR', '�������� ������ ����' );
define( '_SW_UPGRADE_FACILITY', '�������� ����������' );


//����� �������
define( '_SW_WRITABLE', '��������' );
define( '_SW_UNWRITABLE', '����������' );
define( '_SW_YES', '��' );
define( '_SW_NO', '���' );
define( '_SW_HYBRID', 'hybrid' );
define( '_SW_MODULE_NAME', '��� ������' );

//���������
//define( '_SW_MENU_SYSTEM_TIP', '����� ������� ����.<br /><b>Trans Menu:</b> DHTML ���� � ������� ���-���� � �������� ����������.<br /><b>MyGosu Menu:</b> DHTML ���� ���������� ������������� � ���������.' );
define( '_SW_SAVE_TIP', '������� �����, ����� ��������� ��� ��������� ����� � ������ � ���� ������' );
define( '_SW_CANCEL_TIP', '������� �����, ����� �������� ��������� � ��������� � �������� ������ ����' );
define( '_SW_PREVIEW_TIP', '������� �����, ����� ����������� ������ ���� �� ����������� ����' );
define( '_SW_EXPORT_TIP', '������� ����� ��� �������� ������� ������ � �������������� ������� ���������� �� ������� ����' );

//����� ������
define( '_SW_SAVE_BUTTON', '���������' );
define( '_SW_CANCEL_BUTTON', '������' );
define( '_SW_PREVIEW_BUTTON', '��������' );
define( '_SW_EXPORT_BUTTON', '�������' );
define( '_SW_UPLOAD_BUTTON', '��������� ����' );


//���������� ������ ���������
define( '_SW_UPGRADE_LINK', '����������/�������������� swMenuFree.' );
define( '_SW_MANAGER_LINK', '�������������� ������� ������ ����' );
define( '_SW_CSS_LINK', '������ �������������� �������� CSS �����' );
define( '_SW_EXPORT_LINK', '������� CSS �� ������� ����' );


//����������� �����������
define( '_SW_UPLOAD_FILE_NOTICE', '����������, �������� ���� ��� ��������.' );
define( '_SW_SAVE_MENU_MESSAGE', '��������� ������� ���������' );
define( '_SW_SAVE_MENU_CSS_MESSAGE', '��������� ��������� � ������� CSS ���� ������� ������' );
define( '_SW_SAVE_CSS_MESSAGE', '������� CSS ���� ������� ��������' );
define( '_SW_NO_SAVE_MENU_CSS_MESSAGE', '������� CSS ���� �� ������.  ���������, ��� ����� modules/mod_swmenufree/styles  �������� ��� ������.' );


//////////////////////////
//�������� ����������
/////////////////////////
define( '_SW_OK', '��� � �������' );
define( '_SW_MESSAGES', '���������' );
define( '_SW_MODULE_SUCCESS', '������ ������� ��������.' );
define( '_SW_MODULE_FAIL', '��������� �������� ������.  ����������, ���������, ��� ����� /modules �������� ��� ������.' );
define( '_SW_TABLE_UPGRADE', '������� %s ���������' );
define( '_SW_TABLE_CREATE', '������� %s �������' );
define( '_SW_UPDATE_LINKS', '������ ���� ���������' );

define( '_SW_MODULE_VERSION', '������� ������ ������ swMenuFree' );
define( '_SW_COMPONENT_VERSION', '������� ������ ���������� swMenuFree' );
define( '_SW_UPLOAD_UPGRADE', '�������� ����� ����������/������� swMenuFree' );
define( '_SW_UPLOAD_UPGRADE_BUTTON', '��������� � ���������� ����' );

define( '_SW_COMPONENT_SUCCESS', '��������� swMenuFree ������� ��������.' );
define( '_SW_COMPONENT_FAIL', '���������� ����������. ����������, ���������, ��� ��� ������������� ����� �������� ��� ������.' );
define( '_SW_INVALID_FILE', '���� ���� �� �������� ���������� ������� ����������/��������� swMenuFree.' );



//////////////////////////////
//�������� �������, ������� � ��������
/////////////////////////////
define( '_SW_POSITION_LABEL', '��������� � ���������� ����' );
define( '_SW_SIZES_LABEL', '������� ��������� ����' );
define( '_SW_TOP_OFFSETS_LABEL', '�������� ���� �������� ������' );
define( '_SW_SUB_OFFSETS_LABEL', '�������� �������' );
define( '_SW_ALIGNMENT_LABEL', '������������ ����' );
define( '_SW_WIDTHS_LABEL', '������ ��������� ����' );
define( '_SW_HEIGHTS_LABEL', '������ ��������� ����' );


define( '_SW_TOP_MENU', '����' );
define( '_SW_SUB_MENU', '�������' );
define( '_SW_ALIGNMENT', '������������' );
define( '_SW_POSITION', '���������' );
define( '_SW_ORIENTATION', '����������' );
define( '_SW_ITEM_WIDTH', '- ������' );
define( '_SW_ITEM_HEIGHT', '- ������' );
define( '_SW_TOP_OFFSET', '�������� ������' );
define( '_SW_LEFT_OFFSET', '�������� �����' );
define( '_SW_LEVEL', '�������' );
define( '_SW_AUTOSIZE', '(0 = ����������)' );

//////////////////////
//�������� ������� � ��������
/////////////////////
define( '_SW_FONT_FAMILY_LABEL', '����� ������' );
define( '_SW_FONT_SIZE_LABEL', '������ ������' );
define( '_SW_FONT_ALIGNMENT_LABEL', '������������ ������' );
define( '_SW_FONT_WEIGHT_LABEL', '��������� ������' );
define( '_SW_PADDING_LABEL', '�������' );


define( '_SW_TOP', '������' );
define( '_SW_RIGHT', '������' );
define( '_SW_BOTTOM', '�����' );
define( '_SW_LEFT', '�����' );
define( '_SW_FONT_SIZE', '- ������ ������' );
define( '_SW_FONT_ALIGNMENT', '- ������������ ������' );
define( '_SW_FONT_WEIGHT', '- ��������� ������' );
define( '_SW_PADDING', '- �������' );
define( '_SW_FONT_TIP', '��� �������� ���������� ������ � ������� ��-�������. ������ ���� ����������, ��� ��������� ������ � ������� ������������ � ����� ��������.' );

/////////////////////////
//�������� ������ � ��������
////////////////////////
define( '_SW_BORDER_WIDTHS_LABEL', '������ ������' );
define( '_SW_BORDER_STYLES_LABEL', '����� ������' );
define( '_SW_SPECIAL_EFFECTS_LABEL', '����������� �������' );

define( '_SW_OUTSIDE_BORDER', '- ������� �������' );
define( '_SW_INSIDE_BORDER', '- ���������� �������' );
define( '_SW_NORMAL_BORDER', '- �������' );
define( '_SW_WIDTH', '- ������' );
define( '_SW_HEIGHT', '- ������' );
define( '_SW_DIVIDER', '- �����������' );
define( '_SW_STYLE', '- �����' );
define( '_SW_DELAY', '- �������� ��������/��������' );
define( '_SW_OPACITY', '- ������������' );

///////////////////////////
//�������� ������ � �����
///////////////////////////
define( '_SW_BACKGROUND_IMAGE_LABEL', '������� �����������' );
define( '_SW_BACKGROUND_COLOR_LABEL', '���� ����' );
define( '_SW_FONT_COLOR_LABEL', '���� ������' );
define( '_SW_BORDER_COLOR_LABEL', '���� ������' );


define( '_SW_BACKGROUND', '- ���' );
define( '_SW_OVER_BACKGROUND', '- ��� ��� ���������' );
define( '_SW_COLOR', '- ����' );
define( '_SW_OVER_COLOR', '- ���� ��� ���������' );
define( '_SW_FONT', '- ���� ������' );
define( '_SW_OVER_FONT', '- ���� ������ ��� ���������' );
define( '_SW_OUTSIDE_BORDER_COLOR', '- ���� ������� �������' );
define( '_SW_INSIDE_BORDER_COLOR', '- ���� ���������� �������' );
define( '_SW_NORMAL_BORDER_COLOR', '- ���� �������' );
define( '_SW_GET', '�����' );
define( '_SW_COLOR_TIP', '�������� ���� �� ������� � ������� ������ %s ����� ����, � �������� �� ������ ��������� ��������� ����.');
define( '_SW_PRESENT_COLOR', '������� ����' );
define( '_SW_SELECTED_COLOR', '��������� ����' );


///////////////////////////
//�������� ���������� ������ ����
///////////////////////////
define( '_SW_MENU_SOURCE_LABEL', '��������� ��������� ����' );
define( '_SW_STYLE_SHEET_LABEL', '��������� ������� ������' );
define( '_SW_AUTO_ITEM_LABEL', '�������������� ��������� ��������� ����' );
define( '_SW_CACHE_LABEL', '��������� �����������' );
define( '_SW_GENERAL_LABEL', '����� ��������� ������' );
define( '_SW_POSITION_ACCESS_LABEL', '���������� � ������' );
define( '_SW_PAGES_LABEL', '����������� ������ ���� �� ���������' );
define( '_SW_CONDITIONS_LABEL', '�������' );

//����� ������� ������
define( '_SW_CSS_DYNAMIC_SELECT', '�������� ����� �������� � ��������' );
define( '_SW_CSS_LINK_SELECT', '������ �� ������� ������� ������' );
define( '_SW_CSS_IMPORT_SELECT', '������ ������� ������� ������' );
define( '_SW_CSS_NONE_SELECT', '�� ��������� � �������� ������' );

define( '_SW_SOURCE_CONTENT_SELECT', '������������ ������ �������' );
define( '_SW_SOURCE_EXISTING_SELECT', '������� ������������ ���� ����' );

define( '_SW_SHOW_TABLES_SELECT', '���������� ��� �������' );
define( '_SW_SHOW_BLOGS_SELECT', '���������� ��� �����' );

define( '_SW_10SECOND_SELECT', '10 ������' );
define( '_SW_1MINUTE_SELECT', '1 ������' );
define( '_SW_30MINUTE_SELECT', '30 �����' );
define( '_SW_1HOUR_SELECT', '1 ���' );
define( '_SW_6HOUR_SELECT', '6 �����' );
define( '_SW_12HOUR_SELECT', '12 �����' );
define( '_SW_1DAY_SELECT', '1 ����' );
define( '_SW_3DAY_SELECT', '3 ���' );
define( '_SW_1WEEK_SELECT', '1 ������' );

//����� ������� �������
define( '_SW_MODULE_SETTINGS_TAB', '��������� ������' );
define( '_SW_SIZE_OFFSETS_TAB', '������� � ���������' );
define( '_SW_COLOR_BACKGROUNDS_TAB', '���� � ���' );
define( '_SW_FONTS_PADDING_TAB', '������ � �������' );
define( '_SW_BORDERS_EFFECTS_TAB', '������� � �������' );


//����� �����
define( '_SW_MENU_SOURCE', '�������� ����' );
define( '_SW_PARENT', '��������' );
define( '_SW_STYLE_SHEET', '�������� �������' );
define( '_SW_CLASS_SFX', '������� ������ <br/>��� ������' );
define( '_SW_HYBRID_MENU', '��������� ����' );
define( '_SW_TABLES_BLOGS', '������������� <br/>������/������' );
define( '_SW_CACHE_ITEMS', '�������� ���' );
define( '_SW_CACHE_REFRESH', '����� ����� ����' );
define( '_SW_SHOW_NAME', '�������� ��� ������' );
define( '_SW_PUBLISHED', '������������');
define( '_SW_ACTIVE_MENU', '�������� ����' );
define( '_SW_MAX_LEVELS', '�������� �������' );
define( '_SW_PARENT_LEVEL', '������������ �������' );
define( '_SW_SELECT_HACK', '��� ������� ������' );
define( '_SW_SUB_INDICATOR', '��������� �������' );
define( '_SW_SHOW_SHADOW', '���������� ����' );
define( '_SW_MODULE_POSITION', '���������� ������' );
define( '_SW_MODULE_ORDER', '������� �������' );
define( '_SW_ACCESS_LEVEL', '������� �������' );
define( '_SW_TEMPLATE', '������' );
define( '_SW_LANGUAGE', '����' );
define( '_SW_COMPONENT', '���������' );

//���������
define( '_SW_MENU_SOURCE_TIP', '�������� ���������� ���� ��� �������� ������� ���� ��� ������ ������.' );
define( '_SW_PARENT_TIP', '�������� ������������ ������� ��� ����������� �������� ��������� ����.  ���������� ���, ����� ���������� ��� �������� ��������� ����.' );
define( '_SW_STYLE_SHEET_TIP', '<b>����������:</b> ���������� ������� ������ � ��������, ��� ����������� ������ ����.<br /><b>������� ������:</b> ���������� ������� ���������������� ������� ������.<br /><b>��� ������:</b> �������� ���� ������ ������� �� ������� ������� ������ � ��� ������.  ������ ���� ����� ��������� ��������.' );
define( '_SW_CLASS_SFX_TIP', '������� ��������������� ����� ��������� moduletable CSS.  ����� ���� ����������� ��� ������������� ���������� � �������� moduletable CSS � ��� ��������������� ���������� ����� ���� CSS �������.' );
define( '_SW_HYBRID_MENU_TIP', '������������� ��������� �������� ���� �������� � ����, ���������� ���������� ��������� / ��������, � ���� ������ / ������.' );
define( '_SW_TABLES_BLOGS_TIP', '���������� ��������� ������������� ���� ���������/�������� ��� ������� ��� �����.' );
define( '_SW_CACHE_ITEMS_TIP', '����������� �������� ��� ��� ��������� �������������� � ���������� ��������� ����.  �������� ������� ��� ������ � ���������� ����, ��� ��������� ������� ���� ����� ��������� ����� SQL ��������.  ��� ��������� ����� �������� ����� ����������� ����������.' );
define( '_SW_CACHE_REFRESH_TIP', '�������� ������� ����� ����������� ��������� ��������� ���� � ���� ������.' );
define( '_SW_SHOW_NAME_TIP', '����������� ����� ������ ����.' );
define( '_SW_PUBLISHED_TIP', '���������/���������� ���������� ������ ����.');
define( '_SW_ACTIVE_MENU_TIP', '����������� �������� ������ ���� �������� ������ � �������� ��������� ��� ��������������� ��������.' );
define( '_SW_MAX_LEVELS_TIP', '������������ ����� ������������ ������� ��������� ����.  ���������� 0, ����� ���������� ��� ������.' );
define( '_SW_PARENT_LEVEL_TIP', '�������������� ��������, ������������� �������� ���� ��� �������� �� ������������ �������.  ������ ��������������� �� 0.' );
define( '_SW_SELECT_HACK_TIP', '��������� ��� � ����, ����� ��������� ���������� ������� ������ � ������ IE.' );
define( '_SW_SUB_INDICATOR_TIP', '�������� ��������� ������� � ���������� ����, ������� ����� �������� ��������.' );
define( '_SW_SHOW_SHADOW_TIP', '���������� ���� ������ �������.' );
define( '_SW_MODULE_POSITION_TIP', '������������ ������ ���� � �������.' );
define( '_SW_MODULE_ORDER_TIP', '������������ ������ ���� � ������� �������.' );
define( '_SW_ACCESS_LEVEL_TIP', '������� ������� ��� ������ ����.' );
define( '_SW_TEMPLATE_TIP', '������ ���� ����� ������������ ������ � ��������� �������.' );
define( '_SW_LANGUAGE_TIP', '������ ���� ����� ������������ ������ �� ��������� �����.' );
define( '_SW_COMPONENT_TIP', '������ ���� ����� ������������ ������ � ��������� ����������.' );
define( '_SW_PAGES_TIP', '����� ������� : <i>(����������� ctrl ��� ������ ����� ������ ���� ��� ������ ���������� �������)</i>' );


//���������� swMenuPro
define( '_SW_SWMENUPRO_INFO', 'swMenuPro �������� ����� ������ � ������ �������� ��� ���������� �������� ����.  �������� <a href="http://www.swonline.biz" >www.swonline.biz</a>, ����� ������ ��� ��������������� � ������������ ��� �����������, ������� ����� ���������� ������ swMenuPro.' );
define( '_SW_SWMENUPRO_1', 'swMenuPro ��������� ������� �������������� ���������� ������� ����, ��������� ����� �� 7 ��������� ������ ����. swMenuFree ��������� ������� ������ 1 ������ ����.' );
define( '_SW_SWMENUPRO_2', '�������� CSS ��� ������ ������ ���� � �������� ������ ������ ����,  ���� ��� ���, �������, ������� � �.�. � �������������� �������� ����������.' );
define( '_SW_SWMENUPRO_3', '���������� ����������� ��� ������ ������ ���� � �������� ������ ������ ����, � ����� ������, ������, ������������ � �������������� �������� � ������������. (�������� ���� ������ �� �����������)' );
define( '_SW_SWMENUPRO_4', '���������� ��������� ��� ������ ������ ���� � �������� ������ ������ ����.  ��� ��������� ����� ��������� �������� �� ��� ��� ��� ��������� ��������: "���������� ����� ����?", "���������� ��� ������ ����?" (������������ ��� �������� ���� ������ �� �����������), "���������� �� ����� ����?"' );
define( '_SW_SWMENUPRO_5', '���������� � �������� ����� ������� ���� � �������������� ����������� ���������.' );


?>
