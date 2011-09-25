/**
 * RokUtils - Utilities script for TerranTribune's RocketTheme Template (July 08)
 * 
 * @version		1.0
 * 
 * @author		Djamil Legato <djamil@rockettheme.com>
 * @copyright	Andy Miller @ Rockettheme, LLC
 */

var maxHeight=function(C){var B=document.getElements("div."+C);var A=0;B.each(function(D){A=Math.max(A,D.getSize().size.y);});B.setStyle("height",A);return A;};window.addEvent("domready",function(){if(!window.webkit&&!window.ie6){maxHeight("sameheight");maxHeight.delay(500,maxHeight,"sameheight");}var D=$$("table.blog tbody")[0];if(D){D=D.getChildren();if(D.length){var B=[];B.push(D.getFirst()[0].getFirst());var A=D.getFirst()[1];if(A){A=A.getFirst();B.push(A);}var C=tl=tr=bl=br=null;(B.length).times(function(E){C=new Element("div",{"class":"content-surround"}).inject(B[E],"before");tl=new Element("div",{"class":"content-corner-tl"}).inject(C);tr=new Element("div",{"class":"content-corner-tr"}).inject(tl);bl=new Element("div",{"class":"content-corner-bl"}).inject(tr);br=new Element("div",{"class":"content-corner-br"}).inject(bl).adopt(B[E]);});}}});if(window.webkit){window.addEvent("load",function(){maxHeight("sameheight");maxHeight.delay(500,maxHeight,"sameheight");});}