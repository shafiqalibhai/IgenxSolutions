<?php header("Content-type: text/css"); ?>
<?php
$template_path = dirname( dirname( $_SERVER['SCRIPT_NAME'] ) );
?>
/** IE6 is a hunk of crap!!! due to limitations in the CSS capabilities of IE, these hacks are required **/

.block-surround .block {padding:0;}
.content-corner-tl, .content-corner-tr, .content-corner-bl, .content-corner-br {position:relative;z-index:10;}
#rokmininews div.corner-tl, #rokmininews div.corner-tr, #rokmininews div.corner-bl, #rokmininews div.corner-br {position:relative;z-index:10;}
#ff-optima h1,#ff-optima h2,#ff-optima h3,#ff-optima h4,#ff-optima h5,#ff-optima h6, #ff-lucida h1,#ff-lucida h2,#ff-lucida h3,#ff-lucida h4,#ff-lucida h5,#ff-lucida h6 {letter-spacing: -0.07em;}
body#ff-optima, body#ff-lucida {letter-spacing: -0.03em;}
body#ff-georgia, body#ff-georgia.f-default {font-size: 12px;}
#page-bg {position: relative;}
#mod_search_searchword {position: relative;z-index: 500;}
#horiz-menu {position: relative;}
.menu span {cursor:pointer;}
#sub-menu .menu span {width: 10px;}
#horiznav li, .menutop li {z-index: 100;}
#bottom {padding-top:0pt;padding-bottom:0pt;}
#bottom .block {margin:0;}
#bottom-menu {position: static;zoom: 1;}
#showcase {margin: 0 auto;}
#showcase .column-1 {background: none;}
#showcase .column-2 {background: none;margin-left: 600px;}
.date-line {margin: 35px auto 0;position: relative;right: 113px;}
span.date-number {line-height: 1.4em;}
.clock {right: 10px;top: 0;}
ul.latestnews {z-index: 100;margin: 0;}
ul.latestnews li a {zoom: 1;z-index: 101;}
#right-column {padding-right: 12px;}
#news-rotator {z-index: 200;}
#news-rotator .story {top: 180px;position: relative;z-index: 100;}
#news-rotator .story-block {height: 100%;z-index: 100;}
#news-rotator a {z-index: 200;}
span.pathway {display: block;float: left;line-height: 27px;}
span.pathway a {display: block;float: left;}
span.pathway img {vertical-align: middle;display: block;float: left;}
.main-page, .main-page2, .main-page3, .main-page4, img#logo, #horiz-menu, #header, #showcase, #showcase .column-1, #showcase .column-2, .headlines-block, .date-block, .sameheight, #left-column, #right-column, #center-column, #main-section, .main-content, #mainmodules, #bottommodules1, #bottommodules2, #footermodules, #rightmodules, #rightmodules2, #leftmodules, #leftmodules2, #left-column .module div div div, #left-column .module-title div div div, #left-column .module-notitle div div div, #right-column .module div div div, #right-column .module-title div div div, #right-column .module-notitle div div div, #mainmodules .module div div div, #mainmodules .module-title div div div, #mainmodules .module-notitle div div div, #bottommodules1 .module div div div,#bottommodules1 .module-title div div div, #bottommodules1 .module-notitle div div div, #bottommodules2 .module div div div, .block-surround, .block-surround2, .block-surround3, .block-surround4, #footermodules, #bottom, #footer, #news-rotator, table.blog div, .moduletable div, #news-rotator .image, #news-rotator .story, ul.latestnews li a:hover, #right-column .module-menu div div div, #left-column .module-menu div div div {zoom: 1;}
.mininews-bottom {height: 1px;font-size: 1px;line-height: 1px;}
#bottommodules2.spacer.w33 .block {width: 32.9%;}
.main-content.block {padding: 22px 0 12px;}
#center-column {padding-left: 12px;}
.mininews-headline .counter {float: right;margin-right: 90px;}

/* menu overrides */
#horiz-menu li.blue-sfHover a {border-top: 5px solid #0D507A;color: #0D507A;line-height: 36px;height: 36px;}
#horiz-menu li.blue-sfHover li a:hover {color: #0D507A;}
#horiz-menu li.red-sfHover a {border-top: 5px solid #D12E2E;color: #D12E2E;line-height: 36px;height: 36px;}
#horiz-menu li.red-sfHover li a:hover{color: #D12E2E;}
#horiz-menu li.purple-sfHover a {border-top: 5px solid #9E0E87;color: #9E0E87;line-height: 36px;height: 36px;}
#horiz-menu li.purple-sfHover li a:hover {color: #9E0E87;}
#horiz-menu li.green-sfHover a {border-top: 5px solid #74A824;color: #74A824;line-height: 36px;height: 36px;}
#horiz-menu li.green-sfHover li a:hover {color: #74A824;}
#horiz-menu li.orange-sfHover a  {border-top: 5px solid #CC8300;color: #CC8300;line-height: 36px;height: 36px;}
#horiz-menu li.orange-sfHover li a:hover {color: #CC8300;}
#horiz-menu li.brown-sfHover a {border-top: 5px solid #8B6846;color: #8B6846;line-height: 36px;height: 36px;}
#horiz-menu li.brown-sfHover li a:hover {color: #8B6846;}
#horiz-menu li.grey-sfHover a {border-top: 5px solid #000;color: #000;line-height: 36px;height: 36px;}
#horiz-menu li.grey-sfHover li a:hover, #horiz-menu li.grey:hover li a:hover {color: #000;}

#horiz-menu li.blue-sfHover li a
#horiz-menu li.red-sfHover li a
#horiz-menu li.purple-sfHover li a
#horiz-menu li.orange-sfHover li a
#horiz-menu li.green-sfHover li a
#horiz-menu li.brown-sfHover li a
#horiz-menu li.grey-sfHover li a {background: none;border-top:0;color:#333;}

.iehandle #horiz-menu ul li.active ul a { color:#333; }

#horiz-menu li.active-parent li a {font-weight: normal;font-size: 100%;}

#horiz-menu ul li.active-parent ul a,
.iehandle #horiz-menu li.active ul a {background: none;border-top:0;}

/* ie6 warning */
#iewarn {background: #C6D3DA url(../images/error.png) 10px 20px no-repeat;position: relative;z-index: 1;opacity: 0;margin: -150px auto 0;font-size: 110%;color: #001D29;z-index: 8000;}
#iewarn div {position: relative;border-top: 5px solid #95B8C9;border-bottom: 5px solid #95B8C9;padding: 10px 80px 10px 220px;	}
#iewarn h4 {color: #900;font-weight: bold;line-height: 120%;}
#iewarn a {color: #296AC6;font-weight: bold;}
#iewarn_close {background: url(../images/close.png) 50% 50% no-repeat;display: block;cursor: pointer;position: absolute;width: 61px;height: 21px;top: 25px;right: 12px;}
#iewarn_close.cHover {background: url(../images/close_hover.png) 50% 50% no-repeat;}
/* end ie6 warning */

/*
   NEW PURE CSS PNG FIX SOLUTION  
   use class="png" to implement 
*/

html .png,
div .png {
	azimuth: expression(
		this.pngSet?this.pngSet=true:(this.nodeName == "IMG" && this.src.toLowerCase().indexOf('.png')>-1?(this.runtimeStyle.backgroundImage = "none",
		this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + this.src + "', sizingMethod='image')",
		this.src = "<?php echo $template_path; ?>/images/blank.gif"):(this.origBg = this.origBg? this.origBg :this.currentStyle.backgroundImage.toString().replace('url("','').replace('")',''),
		this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + this.origBg + "', sizingMethod='crop')",
		this.runtimeStyle.backgroundImage = "none")),this.pngSet=true
	);
}

/* page peel overrides for demo site */
a.fliptip {display: block;z-index: 100000;position: relative;}