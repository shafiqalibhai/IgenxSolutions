<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );

global $Itemid, $modules_list;

if ($mtype!="module") :
	// menu code
	$document	= &JFactory::getDocument();
	$renderer	= $document->loadRenderer( 'module' );
	$options	 = array( 'style' => "raw" );
	$module	 = JModuleHelper::getModule( 'mod_mainmenu' );
	$topnav = false; $subnav = false; $sidenav = false;
	if ($mtype=="splitmenu") :
		$module->params	= "menutype=$menu_name\nstartLevel=0\nendLevel=1\nclass_sfx=top";
		$topnav = $renderer->render( $module, $options );
		
		$module	 = JModuleHelper::getModule( 'mod_mainmenu' );
		$module->params	= "menutype=$menu_name\nstartLevel=1\nendLevel=2\nclass_sfx";
		$subnav = $renderer->render( $module, $options );
		
		$module	 = JModuleHelper::getModule( 'mod_mainmenu' );
		$module->params	= "menutype=$menu_name\nstartLevel=2\nendLevel=9\nclass_sfx";
		$options = array( 'style' => "submenu");
		$sidenav = $renderer->render( $module, $options );
	elseif ($mtype=="moomenu" or $mtype=="suckerfish") :
		$module->params	= "menutype=$menu_name\nshowAllChildren=1\nclass_sfx=top";
		$topnav = $renderer->render( $module, $options );
	endif;

endif;

// start color stuff
$menu = &JSite::getMenu();



// get an array of toplevel Itemids
$toplevel = array();
foreach ($menu->_items as $item) {
	if ($item->parent == 0 && $item->menutype == $menu_name && $item->published == 1) {
		$toplevel[] = $item->id;
	}
}
$toplevel = array_flip($toplevel);
// get an array of colors
$mcolors = explode(',',$menu_colors);

// get the toplevel
$id = $Itemid;

if ($id == 0) {
	$menu_color = $default_color;
} else {
	$item = null;
	while (true) {
		$item = $menu->getItem($id);
		if ($item->parent == 0 && $item->sublevel == 0) break;
		$id = $item->parent;
	}
	$pindex = $toplevel[$item->id];

	if (isset($mcolors[$pindex])) {
		$menu_color = $mcolors[$pindex];
	} else {
		$menu_color = $default_color;
	}
}

//end color stuff

// make sure subnav is empty
if (strlen($subnav) < 10) $subnav = false;
//Are we in edit mode
$editmode = false;
if (JRequest::getCmd('task') == 'edit' ) :
	$editmode = true;
endif;

$mainmod_count = ($this->countModules('user1')>0) + ($this->countModules('user2')>0) + ($this->countModules('user3')>0);
$mainmod_width = $mainmod_count > 0 ? ' w' . floor(99 / $mainmod_count) : '';
$bottommods1_count = ($this->countModules('user4')>0) + ($this->countModules('user5')>0) + ($this->countModules('user6')>0);
$bottommods1_width = $bottommods1_count > 0 ? ' w' . floor(99 / $bottommods1_count) : '';
$bottommods2_count = ($this->countModules('advert1')>0) + ($this->countModules('advert2')>0) + ($this->countModules('advert3')>0);
$bottommods2_width = $bottommods2_count > 0 ? ' w' . floor(99 / $bottommods2_count) : '';
$footermods_count = ($this->countModules('user7')>0) + ($this->countModules('user8')>0) + ($this->countModules('user9')>0);
$footermods_width = $footermods_count > 0 ? ' w' . floor(99 / $footermods_count) : '';
$rightmods_count = ($this->countModules('right2')>0) + ($this->countModules('right3')>0);
$rightmods_width = $rightmods_count > 0 ? ' w' . floor(99 / $rightmods_count) : '';
$rightmods2_count = ($this->countModules('right4')>0) + ($this->countModules('right5')>0);
$rightmods2_width = $rightmods2_count > 0 ? ' w' . floor(99 / $rightmods2_count) : '';
$leftmods_count = ($this->countModules('left2')>0) + ($this->countModules('left3')>0);
$leftmods_width = $leftmods_count > 0 ? ' w' . floor(99 / $leftmods_count) : '';
$leftmods2_count = ($this->countModules('left4')>0) + ($this->countModules('left5')>0);
$leftmods2_width = $leftmods2_count > 0 ? ' w' . floor(99 / $leftmods2_count) : '';

$leftcolumn_width = ($this->countModules('left')>0 or ($sidenav and $splitmenu_col=="leftcol")) ? $leftcolumn_width : "0";
$rightcolumn_width = ($this->countModules('right')>0 or ($sidenav and $splitmenu_col=="rightcol")) ? $rightcolumn_width : "0";
$template_width = 'margin: 0 auto; width: ' . $template_width . 'px;';

$template_path = $this->baseurl . "/templates/" . $this->template;

function rok_isIe7() {
	$agent=$_SERVER['HTTP_USER_AGENT'];
	if (stristr($agent, 'msie 7')) return true;
	return false;
}

function rok_isIe6() {
	$agent=$_SERVER['HTTP_USER_AGENT'];
	if (stristr($agent, 'msie 6')) return true;
	return false;
}

?>