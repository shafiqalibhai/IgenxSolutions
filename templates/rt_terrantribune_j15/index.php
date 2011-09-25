<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
define( 'YOURBASEPATH', dirname(__FILE__) );
require( YOURBASEPATH.DS."rt_styleswitcher.php");
JHTML::_( 'behavior.mootools' );

	$live_site        			= $mainframe->getCfg('live_site');
	$template_path 				= $this->baseurl . '/templates/' .  $this->template;
	$default_color 				= $this->params->get("defaultColor", "blue");
	$menu_colors 				= $this->params->get("menuColors", "blue,green,red,grey,orange,purple,brown");
	$enable_ie6warn             = ($this->params->get("enableIe6warn", 1)  == 0)?"false":"true";
	$font_family                = $this->params->get("fontFamily", "default");
	$show_fontbuttons           = ($this->params->get("showFontButtons", 1)  == 0)?"false":"true";
	$template_width 			= $this->params->get("templateWidth", "962");
	$leftcolumn_width			= $this->params->get("leftcolumnWidth", "160");
	$rightcolumn_width			= $this->params->get("rightcolumnWidth", "320");
	$splitmenu_col				= $this->params->get("splitmenuCol", "rightcol");
	$menu_name 					= $this->params->get("menuName", "mainmenu");
	$menu_type 					= $this->params->get("menuType", "splitmenu");
	$default_font 				= $this->params->get("defaultFont", "default");
	$show_breadcrumbs 			= ($this->params->get("showBreadcrumbs", 0)  == 0)?"false":"true";
	$show_logo		 			= ($this->params->get("showLogo", 1)  == 0)?"false":"true";
	$show_date		 			= ($this->params->get("showDate", 1)  == 0)?"false":"true";
	$show_copyright 			= ($this->params->get("showCopyright", 1)  == 0)?"false":"true";
	
	// moomenu options
	$moo_bgiframe     			= ($this->params->get("moo_bgiframe'","0") == 0)?"false":"true";
	$moo_delay       			= $this->params->get("moo_delay", "500");
	$moo_duration    			= $this->params->get("moo_duration", "600");
	$moo_fps          			= $this->params->get("moo_fps", "200");
	$moo_transition   			= $this->params->get("moo_transition", "Sine.easeOut");	
	
	require(YOURBASEPATH . DS . "rt_styleloader.php");
	$mainframe->set('mcolors', explode(',',$menu_colors));
	$mainframe->set('default_color', $default_color);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<jdoc:include type="head" />
		<?php
		require(YOURBASEPATH . DS . "rt_utils.php");
		require(YOURBASEPATH . DS . "rt_head_includes.php");

	?>
	</head>
	<body id="ff-<?php echo $fontfamily; ?>" class="<?php echo $fontstyle; ?> bc-<?php echo $menu_color; ?> iehandle">
		<div id="page-bg">
		<!-- Begin Wrapper -->
		<div class="wrapper">
			<?php if ($this->countModules('banner')) : ?>
				<div id="top-banner">
					<jdoc:include type="modules" name="banner" style="xhtml" />
				</div>
			<?php endif; ?>
			<div class="shadow-left">
				<div class="shadow-right">
					<div class="main-page">
						<div class="main-page2">
							<div class="main-page3">
								<div class="main-page4">
									<!-- Begin Header -->
									<div id="header">
										<?php if($show_logo == "true") : ?>
											<a href="<?php echo $this->baseurl; ?>" class="nounder"><img src="<?php echo $template_path; ?>/images/blank.gif" border="0" alt="" id="logo" /></a>
										<?php else: ?>
											<div class="logo-module">
												<jdoc:include type="modules" name="icon" style="xhtml" />
											</div>
										<?php endif; ?>
										<?php if ($show_fontbuttons == "true") : ?>
										<div class="fontbutton-text">Text Size</div>
										<div id="accessibility">
											<div id="buttons">
												<a href="<?php echo $thisurl; ?>fontstyle=f-larger" title="Increase size" class="large"><span class="button">&nbsp;</span></a>
												<a href="<?php echo $thisurl; ?>fontstyle=f-smaller" title="Decrease size" class="small"><span class="button">&nbsp;</span></a>
											</div>
										</div>
										<?php endif; ?>
										<?php if ($this->countModules('search')) : ?>
											<div id="searchmod">
												<jdoc:include type="modules" name="search" style="xhtml" />
											</div>
										<?php endif; ?>
									</div>
									<!-- End Header -->
									<!-- Begin Horizontal Menu -->
									<div id="horiz-menu" class="<?php echo $mtype; ?>">
										<?php if($mtype != "module") : ?>
											<?php echo $topnav; ?>
										<?php else: ?>
											<jdoc:include type="modules" name="toolbar" style="none" />
										<?php endif; ?>
									</div>
									<?php if($mtype == "splitmenu") : ?>
										<div id="sub-menu">
											<?php echo $subnav; ?>
										</div>
									<?php endif; ?>
									<!-- End Horizontal Menu -->
									<!-- Begin Showcase Area -->
									<?php if ($this->countModules('header') or $this->countModules('header2')) : ?>
										<div id="showcase">
											<div class="column-2">
												<div class="sameheight">
													<?php if($show_date == "true") : ?>
														<div class="date-block">
															<div class="date-line">
																<?php 
																$now = JFactory::getDate();
																echo $now->toFormat('%A'); ?>
																<span class="date-number"><?php echo $now->toFormat('%d'); ?></span>
																<?php echo $now->toFormat('%B'); ?>
															</div>
															<div class="clock">
																<object type="application/x-shockwave-flash" data="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template?>/flash/clock.swf" width="85" height="85">
																 <param name="movie" value="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template?>/flash/clock.swf" />
																 <param name="wmode" value="transparent" />
																 <p><?php echo $now->toFormat('%H:%M:%S'); ?></p>
																</object>
															</div>	
														</div>
													<?php endif; ?>
													<div class="headlines-block">
														<div class="padding">
															<jdoc:include type="modules" name="header2" style="xhtml" />
														</div>
													</div>
												</div>
											</div>
											<div class="column-1">
												<div class="sameheight">
												<jdoc:include type="modules" name="header" style="xhtml" />
												</div>
											</div>
										</div>
									<?php else: ?>
										<div class="showcase-div"></div>
									<?php endif; ?>
									<!-- End Showcase Area -->
									<!-- Begin Main Content Area -->
									<div id="main-section">
										<div class="padding">
											<div class="main-content block">
												<!-- Begin Left Column -->
												<?php if (($sidenav and $splitmenu_col=="rightcol") or $this->countModules('left') or $this->countModules('left2') or $this->countModules('left3') or $this->countModules('left4') or $this->countModules('left5')) : ?>
												<div id="left-column">
													<div class="padding">
														<div id="leftmodules" class="spacer<?php echo $leftmods_width; ?>">
															<?php if ($this->countModules('left2')) : ?>
																<div class="block">
																	<jdoc:include type="modules" name="left2" style="rounded" />
																</div>
															<?php endif; ?>
															<?php if ($this->countModules('left3')) : ?>
																<div class="block">
																	<jdoc:include type="modules" name="left3" style="rounded" />
																</div>
															<?php endif; ?>
														</div>
														<?php if($sidenav and $splitmenu_col=="leftcol") : ?>
															<div id="side-menu">
																<?php echo $sidenav; ?>
															</div>
														<?php endif; ?>
														<jdoc:include type="modules" name="left" style="rounded" />
														<div id="leftmodules2" class="spacer<?php echo $leftmods2_width; ?>">
															<?php if ($this->countModules('left4')) : ?>
																<div class="block">
																	<jdoc:include type="modules" name="left4" style="rounded" />
																</div>
															<?php endif; ?>
															<?php if ($this->countModules('left5')) : ?>
																<div class="block">
																	<jdoc:include type="modules" name="left5" style="rounded" />
																</div>
															<?php endif; ?>
														</div>
													</div>
									 			</div>
												<?php endif; ?>
												<!-- End Left Column -->
												<!-- Begin Right Column -->
												<?php if (($sidenav and $splitmenu_col=="rightcol") or $this->countModules('right') or $this->countModules('right2') or $this->countModules('right3') or $this->countModules('right4') or $this->countModules('right5')) : ?>
												<div id="right-column">
													<div class="padding">
														<div id="rightmodules" class="spacer<?php echo $rightmods_width; ?>">
															<?php if ($this->countModules('right2')) : ?>
																<div class="block">
																	<jdoc:include type="modules" name="right2" style="rounded" />
																</div>
															<?php endif; ?>
															<?php if ($this->countModules('right3')) : ?>
																<div class="block">
																	<jdoc:include type="modules" name="right3" style="rounded" />
																</div>
															<?php endif; ?>
														</div>
														<?php if($sidenav and $splitmenu_col=="rightcol") : ?>
															<div id="side-menu">
																<?php echo $sidenav; ?>
															</div>
														<?php endif; ?>
														<jdoc:include type="modules" name="right" style="rounded" />
														<div id="rightmodules2" class="spacer<?php echo $rightmods2_width; ?>">
															<?php if ($this->countModules('right4')) : ?>
																<div class="block">
																	<jdoc:include type="modules" name="right4" style="rounded" />
																</div>
															<?php endif; ?>
															<?php if ($this->countModules('right5')) : ?>
																<div class="block">
																	<jdoc:include type="modules" name="right5" style="rounded" />
																</div>
															<?php endif; ?>
														</div>
													</div>
									 			</div>
												<?php endif; ?>
												<!-- End Right Column -->
												<!-- Begin Center Column -->
												<div id="center-column">
													<div class="padding">
														<?php if ($show_breadcrumbs == "true") : ?>
															<div id="pathway">
																<jdoc:include type="module" name="breadcrumbs" style="none" />
															</div>
														<?php endif; ?>
														<?php if ($this->countModules('newsflash')) : ?>
															<div id="rokmininews">
																<jdoc:include type="modules" name="newsflash" style="xhtml" />
															</div>
														<?php endif; ?>
														<jdoc:include type="message" />
														<jdoc:include type="component" />
														<?php if ($this->countModules('user1') or $this->countModules('user2') or $this->countModules('user3')) : ?>
															<div id="mainmodules" class="spacer<?php echo $mainmod_width; ?>">
																<?php if ($this->countModules('user1')) : ?>
																	<div class="block">
																		<jdoc:include type="modules" name="user1" style="rounded" />
																	</div>
																<?php endif; ?>
																<?php if ($this->countModules('user2')) : ?>
																	<div class="block">
																		<jdoc:include type="modules" name="user2" style="rounded" />
																	</div>
																<?php endif; ?>
																<?php if ($this->countModules('user3')) : ?>
																	<div class="block">
																		<jdoc:include type="modules" name="user3" style="rounded" />
																	</div>
																<?php endif; ?>
															</div>
														<?php endif; ?>
													</div>
												</div>
												<div class="clr"></div>
												<!-- End Center Column -->
											</div>
											<!-- Begin Modules Block 1 -->
											<?php if ($this->countModules('user4') or $this->countModules('user5') or $this->countModules('user6')) : ?>
												<div class="main-content block1">
													<div id="bottommodules1" class="spacer<?php echo $bottommods1_width; ?>">
														<?php if ($this->countModules('user4')) : ?>
															<div class="block">
																<jdoc:include type="modules" name="user4" style="rounded" />
															</div>
														<?php endif; ?>
														<?php if ($this->countModules('user5')) : ?>
															<div class="block">
																<jdoc:include type="modules" name="user5" style="rounded" />
															</div>
														<?php endif; ?>
														<?php if ($this->countModules('user6')) : ?>
															<div class="block">
																<jdoc:include type="modules" name="user6" style="rounded" />
															</div>
														<?php endif; ?>
													</div>
												</div>
											<?php endif; ?>
											<!-- End Modules Block 1 -->
											<!-- Begin Modules Block 2 -->
											<?php if ($this->countModules('advert1') or $this->countModules('advert2') or $this->countModules('advert3')) : ?>
												<div class="main-content block2">
													<div class="block-surround">
														<div class="block-surround2">
															<div class="block-surround3">
																<div class="block-surround4">
																	<div id="bottommodules2" class="spacer<?php echo $bottommods2_width; ?>">
																		<?php if ($this->countModules('advert1')) : ?>
																			<div class="block">
																				<jdoc:include type="modules" name="advert1" style="rounded" />
																			</div>
																		<?php endif; ?>
																		<?php if ($this->countModules('advert2')) : ?>
																			<div class="block">
																				<jdoc:include type="modules" name="advert2" style="rounded" />
																			</div>
																		<?php endif; ?>
																		<?php if ($this->countModules('advert3')) : ?>
																			<div class="block">
																				<jdoc:include type="modules" name="advert3" style="rounded" />
																			</div>
																		<?php endif; ?>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											<?php endif; ?>
											<!-- End Modules Block 2 -->
										</div>
									</div>
									<!-- End Main Content Area -->
									<!-- Begin Bottom Menu -->
									<?php if ($this->countModules('bottom')) : ?>
										<div id="bottom-menu">
											<jdoc:include type="modules" name="bottom" style="xhtml" />
										</div>
									<?php endif; ?>
									<!-- End Bottom Menu -->
									<!-- Begin Bottom Modules -->
									<?php if ($this->countModules('user7') or $this->countModules('user8') or $this->countModules('user9')) : ?>
										<div id="bottom">
											<div id="footermodules" class="spacer<?php echo $footermods_width; ?>">
												<?php if ($this->countModules('user7')) : ?>
													<div class="block">
														<jdoc:include type="modules" name="user7" style="rounded" />
													</div>
												<?php endif; ?>
												<?php if ($this->countModules('user8')) : ?>
													<div class="block">
														<jdoc:include type="modules" name="user8" style="rounded" />
													</div>
												<?php endif; ?>
												<?php if ($this->countModules('user9')) : ?>
													<div class="block">
														<jdoc:include type="modules" name="user9" style="rounded" />
													</div>
												<?php endif; ?>
											</div>
										</div>
									<?php endif; ?>
									<!-- End Bottom Modules -->
									<!-- Begin Footer -->
									<div id="footer">
										<div class="footer-left">
											<div class="footer-right">
												<?php if ($show_copyright == "true") : ?>
													<a href="http://www.rockettheme.com/" title="RocketTheme Joomla Template Club" class="nounder"><img src="<?php echo $template_path; ?>/images/blank.gif" alt="RocketTheme Joomla Templates" id="rocket" class="png" /></a>
													<div class="copyright">&copy; 2008-2012 TerranTribune Inc. All rights reserved.</div>
												<?php else: ?>
													<div class="footer-mod">
														<jdoc:include type="modules" name="footer" style="xhtml" />
													</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
									<!-- End Footer -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="debug">
				<jdoc:include type="modules" name="debug" style="raw" />
			</div>
		</div>
		<!-- End Wrapper -->
		</div>
	</body>
</html>