<?php
/**
* @version		1.0
* @package		RokBox
* @copyright	Copyright (C) 2008 RocketTheme, LLC. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * RokBox plugin
 *
 * @author		Djamil Legato <djamil@rockettheme.com>
 * @package		RokBox
 * @subpackage	System
 */
class  plgSystemRokBox extends JPlugin
{

	function plgSystemRokBox(& $subject, $config)
	{
		parent::__construct($subject, $config);
	}

	/**
	* Converting the site URL to fit to the HTTP request
	*
	*/
	function onAfterRender()
	{
		global $mainframe;

		$document	=& JFactory::getDocument();
		$doctype	= $document->getType();

		// Only render for HTML output
		if ( $doctype !== 'html' ) { return; }

		$profiler	=& $_PROFILER;

		ob_start();
		
		$theme = $this->params->get('theme', 'light');
		
		$rokboxJS = $document->baseurl."/plugins/system/rokbox/rokbox.js";
		$remoteFolder = $document->baseurl."/plugins/system/rokbox/themes";
		$localFolder = dirname($_SERVER['SCRIPT_FILENAME']) . "/plugins/system/rokbox/themes";
		if ($theme == 'custom') $theme = $this->params->get('custom-theme', 'sample');
		$config_exists = file_exists($localFolder . "/$theme/rokbox-config.js");
		
		echo "<script type=\"text/javascript\" src=\"" . $rokboxJS . "\"></script>\r\n";
		
		echo "<link href=\"" . $remoteFolder . "/$theme/rokbox-style.css\" rel=\"stylesheet\" type=\"text/css\" />\r\n";
		// Load style for ie6 or ie7 if exist
		$browser = $this->getBrowser();
		if ($browser == 7 || $browser == 6) {
			if (file_exists($localFolder . "/$theme/rokbox-style-ie$browser.php")) {
				echo "<link href=\"" . $remoteFolder . "/$theme/rokbox-style-ie$browser.php\" rel=\"stylesheet\" type=\"text/css\" />\r\n";
			}
			elseif (file_exists($localFolder . "/$theme/rokbox-style-ie$browser.css")) {
				echo "<link href=\"" . $remoteFolder . "/$theme/rokbox-style-ie$browser.css\" rel=\"stylesheet\" type=\"text/css\" />\r\n";
			}
		}
		
		if ($this->params->get('custom-legacy', 0) == 1) {
			$this->loadManualConfiguration($theme);
		} else {
			if ($config_exists) {
				echo "<script type=\"text/javascript\" src=\"" . $remoteFolder . "/$theme/rokbox-config.js\"></script>\r\n";
			} else 
				$this->loadManualConfiguration($theme);
		}
				
		$output = ob_get_clean();

		$body = JResponse::getBody();
		$body = str_replace('</head>', $output.'</head>', $body);
		JResponse::setBody($body);
	}
	
	function getBrowser() 
	{
		$agent = ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) ? strtolower( $_SERVER['HTTP_USER_AGENT'] ) : false;
		$ie_version = false;
				
		if (eregi("msie", $agent) && !eregi("opera", $agent)){
            $val = explode(" ",stristr($agent, "msie"));
            $ver = explode(".", $val[1]);
			$ie_version = $ver[0];
			$ie_version = ereg_replace("[^0-9,.,a-z,A-Z]", "", $ie_version);
		}
		
		return $ie_version;
	}
	
	function loadManualConfiguration($theme)
	{
		echo "<script type=\"text/javascript\">\r\n";
		echo "	if (typeof(RokBox) !== 'undefined') {\r\n";
		echo "		window.addEvent('domready', function() {\r\n";
		echo "			var rokbox = new RokBox({\r\n";
		echo "				'className': '".$this->params->get('classname', 'rokbox')."',\r\n";
		echo "				'theme': '".$theme."',\r\n";
		echo "				'transition': Fx.Transitions.".$this->params->get('transition', 'Quad.easeOut').",\r\n";
		echo "				'duration': ".$this->params->get('duration', 200).",\r\n";
		echo "				'chase': ".$this->params->get('chase', 40).",\r\n";
		echo "				'frame-border': ".$this->params->get('frame-border', 0).",\r\n";
		echo "				'content-padding': ".$this->params->get('content-padding', 0).",\r\n";
		echo "				'arrows-height': ".$this->params->get('arrows-height', 50).",\r\n";
		echo "				'effect': '".$this->params->get('effect', 'quicksilver')."',\r\n";
		echo "				'captions': ".$this->params->get('captions', 1).",\r\n";
		echo "				'captionsDelay': ".$this->params->get('captionsDelay', 800).",\r\n";
		echo "				'scrolling': ".$this->params->get('scrolling', 0).",\r\n";
		echo "				'keyEvents': ".$this->params->get('keyEvents', 1).",\r\n";
		echo "				'overlay': {\r\n";
		echo "					'background': '".$this->params->get('overlay_background', '#000000')."',\r\n";
		echo "					'opacity': ".$this->params->get('overlay_opacity', '0.85').",\r\n";
		echo "					'duration': ".$this->params->get('overlay_duration', '200').",\r\n";
		echo "					'transition': Fx.Transitions.".$this->params->get('overlay_transition', 'Quad.easeInOut')."\r\n";
		echo "				},\r\n";
		echo "				'defaultSize': {\r\n";
		echo "					'width': ".$this->params->get('width', '640').",\r\n";
		echo "					'height': ".$this->params->get('height', '460')."\r\n";
		echo "				},\r\n";
		echo "				'autoplay': '".$this->params->get('autoplay', 'true')."',\r\n";
		echo "				'controller': '".$this->params->get('controller', 'true')."',\r\n";
		echo "				'bgcolor': '".$this->params->get('bgcolor', '#f3f3f3')."',\r\n";
		echo "				'youtubeAutoplay': ".$this->params->get('ytautoplay', 1).",\r\n";
		echo "				'vimeoColor': '".$this->params->get('vimeoColor', '00adef')."',\r\n";
		echo "				'vimeoPortrait': ".$this->params->get('vimeoPortrait', 0).",\r\n";
		echo "				'vimeoTitle': ".$this->params->get('vimeoTitle', 0).",\r\n";
		echo "				'vimeoFullScreen': ".$this->params->get('vimeoFullScreen', 1).",\r\n";
		echo "				'vimeoByline': ".$this->params->get('vimeoByline', 0)."\r\n";
		echo "			});\r\n";
		echo "		});\r\n";
		echo "	};\r\n";
		echo "</script>\r\n";
	}
}