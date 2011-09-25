<?php
/**
* @version		$Id: helper.php 9764 2007-12-30 07:48:11Z rhuk $
* @package		RocketTheme
* @copyright	Copyright (C) 2005 - 2008 RocketTheme, LLC. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

class modRokMiniNewsHelper
{
	
	function getSection(&$params) {
		
		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$userId		= (int) $user->get('id');
		
		$secid		= trim( $params->get('secid') );
		$aid		= $user->get('aid', 0);
		
		$contentConfig = &JComponentHelper::getParams( 'com_content' );
		$access		= !$contentConfig->get('shownoauth');
		
		$query = 'SELECT s.id, s.title, s.alias' .
			' FROM #__sections AS s' .
			' WHERE s.id > 0 ' .
			($access ? ' AND s.access <= ' .(int) $aid : '').
			' AND s.published = 1 AND s.id = ' . $secid;
			
		$db->setQuery($query);
		$section = $db->loadObject();

		return ($section);

	}
	
	function getCategories(&$params) {
		
		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$userId		= (int) $user->get('id');
		
		$secid		= trim( $params->get('secid') );
		$aid		= $user->get('aid', 0);
		
		$contentConfig = &JComponentHelper::getParams( 'com_content' );
		$access		= !$contentConfig->get('shownoauth');
		
		$query = 'SELECT c.id, c.title, c.alias' .
			' FROM #__categories AS c' .
			' WHERE c.id > 0 ' .
			($access ? ' AND c.access <= ' .(int) $aid : '').
			' AND c.published = 1 AND c.section = ' . $secid;
			
		$db->setQuery($query);
		$categories = $db->loadObjectList();

		return ($categories);

	}
	
	function getList(&$params)
	{
		global $mainframe;

		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$userId		= (int) $user->get('id');

		$count		= 15; //hardcode a max of 15 as that is the max available to display
		$catid		= trim( $params->get('catid') );
		$secid		= trim( $params->get('secid') );
		$show_front	= $params->get('show_front', 1);
		$aid		= $user->get('aid', 0);
		
		$text_length = intval($params->get( 'preview_count', 200) );

		$contentConfig = &JComponentHelper::getParams( 'com_content' );
		$access		= !$contentConfig->get('shownoauth');

		$nullDate	= $db->getNullDate();

		$date =& JFactory::getDate();
		$now = $date->toMySQL();

		$where		= 'a.state = 1'
			. ' AND ( a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).' )'
			. ' AND ( a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).' )'
			;

		// User Filter
		switch ($params->get( 'user_id' ))
		{
			case 'by_me':
				$where .= ' AND (created_by = ' . (int) $userId . ' OR modified_by = ' . (int) $userId . ')';
				break;
			case 'not_me':
				$where .= ' AND (created_by <> ' . (int) $userId . ' AND modified_by <> ' . (int) $userId . ')';
				break;
		}

		// Ordering
		switch ($params->get( 'ordering' ))
		{
			case 'm_dsc':
				$ordering		= 'a.modified DESC, a.created DESC';
				break;
			case 'c_dsc':
			default:
				$ordering		= 'a.created DESC';
				break;
		}

		if ($catid)
		{
			$ids = explode( ',', $catid );
			JArrayHelper::toInteger( $ids );
			$catCondition = ' AND (cc.id=' . implode( ' OR cc.id=', $ids ) . ')';
		}
		if ($secid)
		{
			$ids = explode( ',', $secid );
			JArrayHelper::toInteger( $ids );
			$secCondition = ' AND (s.id=' . implode( ' OR s.id=', $ids ) . ')';
		}

		// Content Items only
		$query = 'SELECT a.*, ' .
			' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'.
			' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug'.
			' FROM #__content AS a' .
			($show_front == '0' ? ' LEFT JOIN #__content_frontpage AS f ON f.content_id = a.id' : '') .
			' INNER JOIN #__categories AS cc ON cc.id = a.catid' .
			' INNER JOIN #__sections AS s ON s.id = a.sectionid' .
			' WHERE '. $where .' AND s.id > 0' .
			($access ? ' AND a.access <= ' .(int) $aid. ' AND cc.access <= ' .(int) $aid. ' AND s.access <= ' .(int) $aid : '').
			($catid ? $catCondition : '').
			($secid ? $secCondition : '').
			($show_front == '0' ? ' AND f.content_id IS NULL ' : '').
			' AND s.published = 1' .
			' AND cc.published = 1' .
			' ORDER BY '. $ordering;
		$db->setQuery($query, 0, $count);
		$rows = $db->loadObjectList();

		$i		= 0;
		$lists	= array();
		foreach ( $rows as $row )
		{
			$lists[$i]->id = $row->id;
			$lists[$i]->thumb = $i > 1 ? false : modRokMiniNewsHelper::getThumb($row->introtext);
			$lists[$i]->created = $row->created;
			$lists[$i]->modified = $row->modified;
			$lists[$i]->link = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catslug, $row->sectionid));
			$lists[$i]->title = htmlspecialchars( $row->title );
			$lists[$i]->introtext = $i > 4 ? false : modRokMiniNewsHelper::prepareContent( $row->introtext, $text_length);
			$i++;
		}

		return $lists;
	}
	
	function getThumb($text, $size=70, $reflections=false) {
		
		preg_match( "'src=(?:\"|\')?(?<imgSrc>[^>]*[^/].(?:jpg|bmp|gif|png))(?:\"|\')?'", $text, $matches );
		
		if (isset($matches[1])) {
			$image_path = $matches[1];
			
			//remove any protocol/site info from the image path
			$uri = $_SERVER['REQUEST_URI'];
			if (strpos($image_path,$uri) !== false ) {
				$image_path = substr($image_path,strpos($image_path, $uri)+strlen($uri));
			}
			
			//if after removing the uri, still has protocol then the image
			//is remote and we don't support thumbs for external images
			if (strpos($image_path,'http://') !== false ||
				strpos($image_path,'https://') !== false) {
				return false;
			}
			
			// create a thumb filename
			$file_div = strrpos($image_path,'.');
			$thumb_ext = substr($image_path, $file_div);
			$thumb_prev = substr($image_path, 0, $file_div);
			$thumb_path = $thumb_prev . "_thumb" . $thumb_ext;
			
			// check to see if this file exists, if so we don't need to create it
			if (!file_exists($thumb_path)) {
				// file doens't exist, so create it and save it
				include_once('thumbnail.inc.php');
				$thumb = new Thumbnail($image_path);
				$thumb->resize($size);
				if ($reflections) {
					$thumb->createReflection(30,30,60,false);
				}
				if (!is_writable(dirname($thumb_path))) {
					$thumb->destruct();
					return false;
				}
				$thumb->save($thumb_path);
				$thumb->destruct();
			}
			return ($thumb_path);
		} else {
			return false;
		}
	}
	
	function prepareContent( $text, $length=200 ) {
		// strips tags won't remove the actual jscript
		$text = preg_replace( "'<script[^>]*>.*?</script>'si", "", $text );

		
		
		$text = preg_replace( '/{.+?}/', '', $text);
		// replace line breaking tags with whitespace
		$text = strip_tags(preg_replace( "'<(br[^/>]*?/|hr[^/>]*?/|/(div|h[1-6]|li|p|td))>'si", ' ', $text ));
		// cut off text at word boundary if required
		if (strlen($text) > $length) {
			$text = substr($text, 0, strpos($text, ' ', $length)) . "..." ;
		} 
		return $text;
	}
}
