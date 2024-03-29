<?php
/**
* @version		$Id: calendar.php 10094 2008-03-02 04:35:10Z instance $
* @package		Joomla.Framework
* @subpackage	Parameter
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Renders a calendar element
 *
 * @author 		Louis Landry
 * @package 	Joomla.Framework
 * @subpackage	Parameter
 * @since		1.5
 */
class JElementCalendar extends JElement
{
	/**
	* Element name
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Calendar';

	function fetchElement($name, $value, &$node, $control_name)
	{
		JHTML::_('behavior.calendar'); //load the calendar behavior

		$format	= ( $node->attributes('format') ? $node->attributes('format') : '%Y-%m-%d' );
		$class	= $node->attributes('class') ? $node->attributes('class') : 'inputbox';

		$id   = $control_name.$name;
		$name = $control_name.'['.$name.']';

		return JHTML::_('calendar', $value, $name, $id, $format, array('class' => $class));
	}
}
