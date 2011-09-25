<?php
/**
* @version		$Id: mod_rokmininews.php 9764 2007-12-30 07:48:11Z rhuk $
* @package		RocketTheme
* @copyright	Copyright (C) 2005 - 2008 RocketTheme, LLC. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

//$counter = modRokMiniNewsHelper::getCounter();
$list = modRokMiniNewsHelper::getList($params);
$section = modRokMiniNewsHelper::getSection($params);
$categories = modRokMiniNewsHelper::getCategories($params);

$num_lead = 1;  // this is now configured via js
if (sizeof($list) < $num_lead) $num_lead = sizeof($list);

require(JModuleHelper::getLayoutPath('mod_rokmininews'));