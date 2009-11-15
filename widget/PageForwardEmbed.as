package  {
	
	import flash.display.MovieClip;
	import flash.events.*;
	import flash.system.System;
	
	public class PageForwardEmbed extends MovieClip {
		
		// Constants:
		// Public Properties:
		// Private Properties:
		// UI Elements:
		public var button_mc:MyButton;
		
		// Initialization:
		public function PageForwardEmbed() {
			configUI();
		}

		// Public Methods:
		// Protected Methods:
		// Private Methods:
		protected function configUI():void {
			embed_txt.text = '<div><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="300" height="250"><param name="allowScriptAccess" value="always"><param name="movie" value="http://www.protectourcoralsea.org.au/swf/widget.swf"><param name="quality" value="high"><embed allowScriptAccess="always" src="http://www.protectourcoralsea.org.au/swf/widget.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="300" height="250"></embed></object></div>';
			embed_txt.addEventListener(FocusEvent.FOCUS_IN, onEmbedFocus);
			
			button_mc.label = "Copy code »";
			button_mc.addEventListener(MouseEvent.CLICK, onCopyClick);
		}
		
		/**
		 * @todo Doesnt work
		 */
		protected function onEmbedFocus(fe:FocusEvent) {
			embed_txt.setSelection(0, embed_txt.text.length - 1);
		}
		
		protected function onCopyClick(me:MouseEvent):void {
			System.setClipboard(embed_txt.text);
			Widget.alert.show("Now you can paste it on your site, or save for later to paste somewhere on the Internet.");
		}
	}
	
}