<?php // no direct access
/**
* @package RokLatestNews
* @copyright Copyright (C) 2007 RocketWerx. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/
defined('_JEXEC') or die('Restricted access'); 

if (!defined('CONTENTROTATOR_JS')) {
	echo '<script type="text/javascript" src="'.JURI::base().'modules/mod_roknewsrotator/roknewsrotator-packed.js"></script>' . "\n";
	define('CONTENTROTATOR_JS',1);
}

?>
<script type="text/javascript">
	window.addEvent('domready', function() {
		var rotator = new RokNewsRotator('news-rotator', {
			delay: <?php echo $params->get('delay'); ?>,
			duration: <?php echo $params->get('duration'); ?>,
            corners: <?php echo $params->get('corners')==1?"true":"false"; ?>,
			autoplay: <?php echo $params->get('autoplay')==1?"true":"false"; ?>,
			autohide: <?php echo $params->get('autohide')==1?"true":"false"; ?>,
			controls: <?php echo $params->get('controls')==1?"true":"false"; ?>
		});
	});
</script>
<div id="news-rotator">
<?php foreach ($list as $item) :  ?>
    <div class="story-block">
        <div class="image">
            <?php if ($item->mainimage) { ?>
                <?php if ($params->get('linkimage')==1) { ?>
                    <a href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>"><img src="<?php echo $item->mainimage ?>" alt="<?php echo $item->title; ?>" /></a>
                <?php } else { ?>
                    <img src="<?php echo $item->mainimage ?>" alt="<?php echo $item->title; ?>" />
                <?php } ?>
            <?php } ?>
        </div>
        <div class="story">
            <div class="padding">
                <?php if ($params->get('linktitle')==1) { ?>
                <h1><a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a></h1>
                <?php } else { ?>
                <h1><?php echo $item->title; ?></h1>
                <?php } ?>
                <p>
                   <?php echo $item->introtext; ?> 
                   <?php if ($params->get('linktitle')!=1) { ?>
                   <a href="<?php echo $item->link; ?>" class="readon"><?php echo $params->get('readmore'); ?></a>    
                   <?php } ?>
                </p>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>