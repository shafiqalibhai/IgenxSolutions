<?php
/**
* @version		$Id: users.class.php 10094 2008-03-02 04:35:10Z instance $
* @package		Joomla
* @subpackage	Users
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.html.parameter');

/**
 * Legacy class, use JParameter instead
 * @deprecated As of version 1.5
 */
class mosUserParameters extends JParameter
{
	function __construct($text, $file = '', $type = 'component')
	{
		parent::__construct($text, $file);
	}
}