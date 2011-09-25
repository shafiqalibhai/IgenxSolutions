<?php // no direct access
defined('_JEXEC') or die('Restricted access');
if (!defined('MININEWS_JS')) {
	echo '<script type="text/javascript" src="'.JURI::base().'modules/mod_rokmininews/tmpl/rokmininews.js"></script>' . "\n";
	define('MININEWS_JS',1);
}
?>
<script type="text/javascript">
	RokMN.settings['section-<?php echo $section->id; ?>'] = <?php echo $params->get('default_articles',5); ?>;
</script>
<div class="block-1 mininews <?php echo $params->get('cssclass'); ?>" id="section-<?php echo $params->get('secid'); ?>">
	<div class="corner-tl">
		<div class="corner-tr">
			<div class="corner-bl">
				<div class="corner-br">
					<div class="mininews-headline">
						<div class="mover"><span><?php echo JText::_('Move'); ?></span></div>
						<div class="counter"><span><?php echo JText::_('Display'); ?> <a href="#" class="mininews-stories-0">0</a> | <a href="#" class="mininews-stories-5">5</a> | <a href="#" class="mininews-stories-10">10</a> | <a href="#" class="mininews-stories-15">15</a> <?php echo JText::_('Stories'); ?></span></div>
						<h2><?php echo $section->title; ?></h2>
					</div>
					<div class="mininews-inner">
						<div class="mininews-wrapper">
							<div class="mininews-titles">
								<div class="topic-names"><?php echo JText::_('Topics'); ?></div>
								<div class="top-story"><?php echo JText::_('Top Story'); ?></div>
								<div class="other-stories"><?php echo JText::_('Other Stories'); ?></div>
							</div>			

							<div class="sub-categories">
								<?php foreach ($categories as $category) :  ?>
									<div>
										<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($category->id, $section->id)); ?>"><?php echo $category->title;?></a>
									</div>
								<?php endforeach; ?>
							</div>
			
							<div class="lead-articles">
							<?php for ($i=0; $i<$num_lead; $i++) : ?>
							<div class="entry article-<?php $list[$i]->id; ?>">
				
								<h4><a href="<?php echo $list[$i]->link; ?>"><?php echo $list[$i]->title; ?></a></h4>
								<?php if ($list[$i]->thumb != false && $params->get('image',1) == 1) :?>
								<img src="<?php echo $list[$i]->thumb; ?>" alt="<?php echo $list[$i]->title; ?>" class="mininews-thumb" />	
								<?php endif; ?>
								<?php if ($list[$i]->introtext != false) :?>
								<p><?php echo ($list[$i]->introtext); ?></p>
								<?php endif; ?>
							</div>
							<?php endfor; ?>
							</div>
			
							<div class="simple-articles">
							<?php for ($i=$num_lead; $i<sizeof($list); $i++) : ?>
							<div class="entry article-<?php $list[$i]->id; ?>">
								<h4><a href="<?php echo $list[$i]->link; ?>"><?php echo $list[$i]->title; ?></a></h4>
								<?php if ($list[$i]->thumb != false && $params->get('image',1) == 1) :?>
								<img src="<?php echo $list[$i]->thumb; ?>" alt="<?php echo $list[$i]->title; ?>" class="mininews-thumb" />	
								<?php endif; ?>
								<?php if ($list[$i]->introtext != false) :?>
								<p><?php echo ($list[$i]->introtext); ?></p>
								<?php endif; ?>
							</div>
							<?php endfor; ?>
			
							<div class="clr"></div>
							</div>	
						</div>
					</div>
					<div class="mininews-bottom"></div>
				</div>
			</div>
		</div>
	</div>
</div>