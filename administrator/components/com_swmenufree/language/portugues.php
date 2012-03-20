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


define( '_SW_UPGRADE_VERSIONS', 'Vers�o swMenuFree instalada actualmente' );
define( '_SW_SELECTED_LANGUAGE_HEADING', 'Ficheiro de Idioma instalado' );
define( '_SW_LANGUAGE_FILES', 'Seleccione o novo ficheiro de Idioma' );
define( '_SW_LANGUAGE_CHANGE_BUTTON', 'Altera o Idioma' );
define( '_SW_FILE_PERMISSIONS', 'Actuais permiss�es dos ficheiros' );
define( '_SW_LANGUAGE_SUCCESS', 'Foi adicionado com sucesso o novo o Ficheiro de Idioma.' );
define( '_SW_LANGUAGE_FAIL', 'N�o foi poss�vel fazer o upload do ficheiro de idioma, por favor verifique que todas as directorias listadas em baixo t�m permiss�o de escrita.' );

//Menu Names
define( '_SW_MENU_SYSTEM', 'Sistema de Menu' );
define( '_SW_TRANS_MENU', 'Trans Menu' );
define( '_SW_MYGOSU_MENU', 'MyGosu Menu' );
define( '_SW_TIGRA_MENU', 'Tigra Menu' );


//Page Names
define( '_SW_MANUAL_CSS_EDITOR', 'Editor Manual de CSS' );
define( '_SW_MODULE_EDITOR', 'Editor do m�dulo do Menu' );
define( '_SW_UPGRADE_FACILITY', 'Actualiza��o do Sistema' );


//Common Terms
define( '_SW_WRITABLE', 'Com permiss�o de escrita' );
define( '_SW_UNWRITABLE', 'Sem permiss�o de escrita' );
define( '_SW_YES', 'Sim' );
define( '_SW_NO', 'N�o' );
define( '_SW_HYBRID', 'H�brido' );
define( '_SW_MODULE_NAME', 'Nome do M�dulo' );

//Tool Tips
//define( '_SW_MENU_SYSTEM_TIP', 'Seleccione um tipo de Menu.<br /><b>Trans Menu:</b>Um sistema de Menu din�mico em DHTML, com um belo efeito de slides no submenu.<br /><b>MyGosu Menu:</b>Um sistema de Menu din�mico em DHTML com melhor compatibilidade em diferentes templates.' );
define( '_SW_SAVE_TIP', 'Clique aqui para guardar na base de dados todas as altera��es de estilo e m�dulos' );
define( '_SW_CANCEL_TIP', 'Clique aqui para cancelar as altera��es e voltar ao menu de administra��o' );
define( '_SW_PREVIEW_TIP', 'Clique aqui para visualizar o Menu numa janela pop-up' );
define( '_SW_EXPORT_TIP', 'Clique aqui para exportar uma folha de estilos externa, usando a actual configura��o de estilos' );

//Buttons text
define( '_SW_SAVE_BUTTON', 'guardar' );
define( '_SW_CANCEL_BUTTON', 'cancelar' );
define( '_SW_PREVIEW_BUTTON', 'visualizar' );
define( '_SW_EXPORT_BUTTON', 'exportar' );
define( '_SW_UPLOAD_BUTTON', 'enviar ficheiro' );


//Internal program links
define( '_SW_UPGRADE_LINK', 'Actualizar/Corrigir swMenuFree.' );
define( '_SW_MANAGER_LINK', 'Editar propriedades do m�dulo Menu' );
define( '_SW_CSS_LINK', 'Editar manualmente uma folha de estilo CSS externa' );
define( '_SW_EXPORT_LINK', 'Exportar para folha de estilo CSS externa' );


//Program Notices
define( '_SW_UPLOAD_FILE_NOTICE', 'Por favor, seleccione um ficheiro para enviar.' );
define( '_SW_SAVE_MENU_MESSAGE', 'Configura��o guardada com sucesso' );
define( '_SW_SAVE_MENU_CSS_MESSAGE', 'A configura��o foi guardada e uma folha de estilo CSS externa foi criada com sucesso' );
define( '_SW_SAVE_CSS_MESSAGE', 'Folha de estilo CSS externa guardada com sucesso' );
define( '_SW_NO_SAVE_MENU_CSS_MESSAGE', 'Folha de estilos CSS externa n�o foi criada. Certifique-se de que seu ficheiro modules/mod_swmenufree/styles tem permiss�o de escrita.' );


//////////////////////////
//Upgrade page
/////////////////////////
define( '_SW_OK', 'Est� tudo OK' );
define( '_SW_MESSAGES', 'Mensagens' );
define( '_SW_MODULE_SUCCESS', 'O m�dulo foi actualizado com sucesso.' );
define( '_SW_MODULE_FAIL', 'N�o foi poss�vel actualizar o m�dulo. Por favor, certifique-se de que a sua directoria /modules tem permiss�o de escrita.' );
define( '_SW_TABLE_UPGRADE', '%s Tabelas actualizadas' );
define( '_SW_TABLE_CREATE', '%s Tabelas criadas' );
define( '_SW_UPDATE_LINKS', 'Links do menu de administra��o foram actualizados' );

define( '_SW_MODULE_VERSION', 'Vers�o actual do m�dulo swMenuFree �' );
define( '_SW_COMPONENT_VERSION', 'Vers�o actual do componente swMenuFree �' );
define( '_SW_UPLOAD_UPGRADE', 'Enviar a vers�o mais recente do  swMenuFree' );
define( '_SW_UPLOAD_UPGRADE_BUTTON', 'Envia &amp; Instala Ficheiro' );

define( '_SW_COMPONENT_SUCCESS', 'Componente swMenuFree actualizado com sucesso.' );
define( '_SW_COMPONENT_FAIL', 'N�o foi poss�vel realizar a actualiza��o. Por favor, certifique-se de que todas as directorias listadas em baixo possuem permiss�o de escrita.' );
define( '_SW_INVALID_FILE', 'Aten��o: este ficheiro n�o � v�lido. Certamente n�o � uma actualiza��o para a vers�o mais recente do swMenuFree.' );



//////////////////////////////
//Size Position & Offsets Page
/////////////////////////////
define( '_SW_POSITION_LABEL', 'Posi��o e orienta��o do Menu' );
define( '_SW_SIZES_LABEL', 'Tamanho dos  itens do Menu' );
define( '_SW_TOP_OFFSETS_LABEL', 'Deslocamento do Menu' );
define( '_SW_SUB_OFFSETS_LABEL', 'Deslocamento do Submenu' );
define( '_SW_ALIGNMENT_LABEL', 'Alinhamento do Menu' );
define( '_SW_WIDTHS_LABEL', 'Largura dos Itens do Menu' );
define( '_SW_HEIGHTS_LABEL', 'Altura dos Itens do Menu' );


define( '_SW_TOP_MENU', 'Menu' );
define( '_SW_SUB_MENU', 'Submenu' );
define( '_SW_ALIGNMENT', 'Alinhamento' );
define( '_SW_POSITION', 'Posi��o' );
define( '_SW_ORIENTATION', 'Orienta��o' );
define( '_SW_ITEM_WIDTH', 'Largura do Item' );
define( '_SW_ITEM_HEIGHT', 'Altura do Item' );
define( '_SW_TOP_OFFSET', 'Deslocamento para cima' );
define( '_SW_LEFT_OFFSET', 'Deslocamento para a esquerda' );
define( '_SW_LEVEL', 'N�vel' );
define( '_SW_AUTOSIZE', '(Utilize 0 para ajuste autom�tico)' );

//////////////////////
//Fonts & Padding Page
/////////////////////
define( '_SW_FONT_FAMILY_LABEL', 'Fam�lia de Fontes' );
define( '_SW_FONT_SIZE_LABEL', 'Tamanho da Fonte' );
define( '_SW_FONT_ALIGNMENT_LABEL', 'Alinhamento de Texto' );
define( '_SW_FONT_WEIGHT_LABEL', 'Estilo da Fonte (negrito)' );
define( '_SW_PADDING_LABEL', 'Espa�amento' );


define( '_SW_TOP', 'Superior' );
define( '_SW_RIGHT', 'Direita' );
define( '_SW_BOTTOM', 'Inferior' );
define( '_SW_LEFT', 'Esquerda' );
define( '_SW_FONT_SIZE', 'Tamanho da Fonte' );
define( '_SW_FONT_ALIGNMENT', 'Alinhamento da Fonte' );
define( '_SW_FONT_WEIGHT', 'Estilo da Fonte (negrito)' );
define( '_SW_PADDING', 'Espa�amento' );
define( '_SW_FONT_TIP', 'Todos os browsers interpretam as fontes e os seus tamanhos de forma diferente. A lista em baixo mostra como o seu browser interpreta o tamanho e as fontes do texto apresentado.' );

/////////////////////////
//Borders & Effects Page
////////////////////////
define( '_SW_BORDER_WIDTHS_LABEL', 'Largura do limite' );
define( '_SW_BORDER_STYLES_LABEL', 'Estilo do limite' );
define( '_SW_SPECIAL_EFFECTS_LABEL', 'Efeitos especiais' );

define( '_SW_OUTSIDE_BORDER', 'Limite Exterior' );
define( '_SW_INSIDE_BORDER', 'Limite Interior' );
define( '_SW_NORMAL_BORDER', 'Limite' );
define( '_SW_WIDTH', 'Largura' );
define( '_SW_HEIGHT', 'Altura' );
define( '_SW_DIVIDER', 'Separador' );
define( '_SW_STYLE', 'Estilo' );
define( '_SW_DELAY', 'Tempo de Abertura/Encerramento' );
define( '_SW_OPACITY', 'Transpar�ncia' );

///////////////////////////
//Colors & Backgrounds Page
///////////////////////////
define( '_SW_BACKGROUND_IMAGE_LABEL', 'Imagens de fundo' );
define( '_SW_BACKGROUND_COLOR_LABEL', 'Cores de fundo' );
define( '_SW_FONT_COLOR_LABEL', 'Cores das fontes' );
define( '_SW_BORDER_COLOR_LABEL', 'Cores dos limites' );


define( '_SW_BACKGROUND', 'Fundo' );
define( '_SW_OVER_BACKGROUND', 'Fundo (Mouseover)' );
define( '_SW_COLOR', 'Cor' );
define( '_SW_OVER_COLOR', 'Cor (Mouseover)' );
define( '_SW_FONT', 'Cor da fonte' );
define( '_SW_OVER_FONT', 'Cor da fonte (Mouseover)' );
define( '_SW_OUTSIDE_BORDER_COLOR', 'Cor do limite externo' );
define( '_SW_INSIDE_BORDER_COLOR', 'Cor do limite interno' );
define( '_SW_NORMAL_BORDER_COLOR', 'Cor do limite' );
define( '_SW_GET', 'Obter' );
define( '_SW_COLOR_TIP', 'Seleccione a cor no c�rculo e clique %s na caixa pr�xima ao elemento onde voc� deseja aplicar a cor escolhida.');
define( '_SW_PRESENT_COLOR', 'Cor actual' );
define( '_SW_SELECTED_COLOR', 'Cor seleccionada' );


///////////////////////////
//Menu Module Settings Page
///////////////////////////
define( '_SW_MENU_SOURCE_LABEL', 'Propriedades do Menu' );
define( '_SW_STYLE_SHEET_LABEL', 'Propriedades da Folha de Estilos' );
define( '_SW_AUTO_ITEM_LABEL', 'Ajuste autom�tico dos itens do Menu' );
define( '_SW_CACHE_LABEL', 'Propriedades da mem�ria Cache' );
define( '_SW_GENERAL_LABEL', 'Propriedades gerais do m�dulo' );
define( '_SW_POSITION_ACCESS_LABEL', 'Posi��o &amp; Acesso' );
define( '_SW_PAGES_LABEL', 'Mostrar m�dulo do menu em p�ginas' );
define( '_SW_CONDITIONS_LABEL', 'Condi��es' );

//Select box text
define( '_SW_CSS_DYNAMIC_SELECT', 'Gravar CSS directamente na p�gina' );
define( '_SW_CSS_LINK_SELECT', 'Link para folha de estilos externa' );
define( '_SW_CSS_IMPORT_SELECT', 'Importar folha de estilos externa' );
define( '_SW_CSS_NONE_SELECT', 'N�o hiperligar a uma folha de estilos' );

define( '_SW_SOURCE_CONTENT_SELECT', 'Usar somente o conte�do' );
define( '_SW_SOURCE_EXISTING_SELECT', 'Seleccione, em baixo, um menu existente ' );

define( '_SW_SHOW_TABLES_SELECT', 'Mostrar como tabelas' );
define( '_SW_SHOW_BLOGS_SELECT', 'Mostrar como blogs' );

define( '_SW_10SECOND_SELECT', '10 Segundos' );
define( '_SW_1MINUTE_SELECT', '1 Minuto' );
define( '_SW_30MINUTE_SELECT', '30 Minutos' );
define( '_SW_1HOUR_SELECT', '1 Hora' );
define( '_SW_6HOUR_SELECT', '6 Horas' );
define( '_SW_12HOUR_SELECT', '12 Horas' );
define( '_SW_1DAY_SELECT', '1 Dia' );
define( '_SW_3DAY_SELECT', '3 Dias' );
define( '_SW_1WEEK_SELECT', '1 Semana' );

//top tabs text
define( '_SW_MODULE_SETTINGS_TAB', 'Propriedades do m�dulo Menu' );
define( '_SW_SIZE_OFFSETS_TAB', 'Tamanho, Posi��o &amp; Deslocamento' );
define( '_SW_COLOR_BACKGROUNDS_TAB', 'Cores &amp; Fundos' );
define( '_SW_FONTS_PADDING_TAB', 'Fontes &amp; Espa�amentos' );
define( '_SW_BORDERS_EFFECTS_TAB', 'Limites &amp; Efeitos' );


//general text
define( '_SW_MENU_SOURCE', 'Origem do menu' );
define( '_SW_PARENT', 'Principal' );
define( '_SW_STYLE_SHEET', 'Folha de Estilos' );
define( '_SW_CLASS_SFX', 'Sufixo Classe do M�dulo' );
define( '_SW_HYBRID_MENU', 'Menu h�brido' );
define( '_SW_TABLES_BLOGS', 'Usar Tabelas/Blogs' );
define( '_SW_CACHE_ITEMS', 'Cache para itens do menu' );
define( '_SW_CACHE_REFRESH', 'Tempo de actualiza��o da cache' );
define( '_SW_SHOW_NAME', 'Mostrar nome do m�dulo' );
define( '_SW_PUBLISHED', 'Publicado');
define( '_SW_ACTIVE_MENU', 'Menu Activo' );
define( '_SW_MAX_LEVELS', 'N� m�ximo de n�veis' );
define( '_SW_PARENT_LEVEL', 'N�vel principal' );
define( '_SW_SELECT_HACK', 'Seleccionar Box Hack' );
define( '_SW_SUB_INDICATOR', 'Indicador de Submenu' );
define( '_SW_SHOW_SHADOW', 'Mostrar sombra' );
define( '_SW_MODULE_POSITION', 'Posi��o do m�dulo' );
define( '_SW_MODULE_ORDER', 'Ordem do m�dulo' );
define( '_SW_ACCESS_LEVEL', 'N�vel de acesso' );
define( '_SW_TEMPLATE', 'Template' );
define( '_SW_LANGUAGE', 'Idioma' );
define( '_SW_COMPONENT', 'Componente' );

//tool tips
define( '_SW_MENU_SOURCE_TIP', 'Seleccione um menu v�lido para actuar como fonte para os itens do menu do seu novo m�dulo.' );
define( '_SW_PARENT_TIP', 'Seleccione um elemento principal para mostrar um segmento do menu. Seleccione TOP para mostrar todos os itens do menu principal.' );
define( '_SW_STYLE_SHEET_TIP', '<b>Din�mico:</b> escreve a folha de estilos no documento a partir do qual o m�dulo do menu � chamado.<br /><b>Link Externo: </b> liga a uma folha de estilos externa, exportada anteriormente.<br /><b>N�o ligar:</b> cole manualmente o seu pr�prio link para uma folha de estilos externa no cabe�alho do template. O m�dulo do menu ser� validado automaticamente.' );
define( '_SW_CLASS_SFX_TIP', 'Sufixo que dever� ser colocado na frente das tabelas CSS do template. Pode ser utilizado para resolver poss�veis conflitos com os templates de m�dulos das tabelas CSS, e para mais op��es sobre o ficheiro template CSS.' );
define( '_SW_HYBRID_MENU_TIP', 'Anexa automaticamente itens de conte�do ao menu, como categorias/sec��es, tabelas/blogs.' );
define( '_SW_TABLES_BLOGS_TIP', 'Mostra automaticamente as categorias/sec��es criadas como tabelas ou blogs.' );
define( '_SW_CACHE_ITEMS_TIP', 'Utiliza um ficheiro de mem�ria cache para melhorar a performance de apresenta��o dos itens do menu. Particularmente �til para o funcionamento de menus do tipo H�brido, onde menus mais extensos podem solicitar mais consultas ao SQL. O ficheiro de mem�ria cache reduzir� as consultas a apenas uma sec��o entre cada intervalo da cache.' );
define( '_SW_CACHE_REFRESH_TIP', 'Intervalo de tempo necess�rio para actualizar a estrutura de itens do menu no ficheiro de mem�ria cache.' );
define( '_SW_SHOW_NAME_TIP', 'Mostra o nome do m�dulo de menu.' );
define( '_SW_PUBLISHED_TIP', 'Publica ou n�o publica o m�dulo de menu.');
define( '_SW_ACTIVE_MENU_TIP', 'Mant�m o item do menu em estado activo quando apresenta a p�gina correspondente.' );
define( '_SW_MAX_LEVELS_TIP', 'N�mero m�ximo de n�veis para exibir no menu. Utilize 0 para mostrar todos os n�veis.' );
define( '_SW_PARENT_LEVEL_TIP', 'Defini��o avan�ada que permite seguir o rasto do menu at� um certo n�vel espec�fico. Normalmente definido 0.' );
define( '_SW_SELECT_HACK_TIP', 'Aplica um hack ao menu, para permitir que os submenus sobreponham as caixas seleccionadas em formul�rios no IE.' );
define( '_SW_SUB_INDICATOR_TIP', 'Exibe uma pequena seta para indicar itens de um submenu que possui menus secund�rios.' );
define( '_SW_SHOW_SHADOW_TIP', 'Exibe uma sombra em volta dos submenus.' );
define( '_SW_MODULE_POSITION_TIP', 'Posi��o do m�dulo do menu no template.' );
define( '_SW_MODULE_ORDER_TIP', 'Ordem do m�dulo do menu na posi��o do template.' );
define( '_SW_ACCESS_LEVEL_TIP', 'N�vel de acesso para o m�dulo de menu.' );
define( '_SW_TEMPLATE_TIP', 'O m�dulo do menu s� ser� exibido no template seleccionado.' );
define( '_SW_LANGUAGE_TIP', 'O m�dulo do menu s� ser� exibido no idioma seleccionado.' );
define( '_SW_COMPONENT_TIP', 'O m�dulo do menu s� ser� exibido no componente seleccionado.' );
define( '_SW_PAGES_TIP', 'Selec��o de P�ginas: <i>(Para seleccionar m�ltiplas p�ginas, mantenha a tecla CTRL pressionada enquanto clica com o bot�o esquerdo do rato nas op��es desejadas.)</i>' );


//swMenuPro Info
define( '_SW_SWMENUPRO_INFO', 'swMenuPro � a solu��o mais robusta e completa para a administra��o dos m�dulos dos menus.  Visite <a href="http://www.swmenupro.com" >www.swmenupro.com</a> para descobrir como actualizar e aproveitar as potencialidades e op��es de navega��o que somente o swMenuPro pode oferecer.' );
define( '_SW_SWMENUPRO_1', 'swMenuPro possibilita a cria��o de um n�mero ilimitado de m�dulos de menu utilizando qualquer dos 7 sistemas de menu dispon�veis.  swMenuFree permite apenas 1 m�dulo do menu.' );
define( '_SW_SWMENUPRO_2', 'Possibilidade de alterar as propriedades CSS de mouseover e normal em qualquer item do menu, dentro de qualquer m�dulo do menu. Possibilidade de altera��o de fundos, limites, espa�amento, etc. usando uma interface simples de apontar e clicar.' );
define( '_SW_SWMENUPRO_3', 'Atribui imagens ao mouseover e normal em qualquer item do menu dentro de qualquer m�dulo do menu, assim como largura, altura, espa�o vertical e horizontal e alinhamento.(Cria menus somente com imagens)' );
define( '_SW_SWMENUPRO_4', 'Atribui comportamentos avan�ados a qualquer item do menu, dentro de qualquer m�dulo do menu. Estes comportamentos podem ser verdadeiro ou falso, nas seguintes condi��es: "Mostra o item do menu?", "Mostra o nome do item do menu?" (Usado para criar menus s� de imagens), "O item do menu � clic�vel?"' );
define( '_SW_SWMENUPRO_5', 'Cria e controla novos m�dulos do menu usando o administrador integrado de m�dulos do menu.' );


?>