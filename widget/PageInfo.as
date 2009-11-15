package  {
	
	import flash.display.MovieClip;
	import flash.events.*;
	import flash.net.*;
	
	public class PageInfo extends MovieClip {
		
		// Constants:
		// Public Properties:
		// Private Properties:
		// UI Elements:
		public var button_mc:MyButton;
		
		// Initialization:
		public function PageInfo() {
			configUI();
		}

		// Public Methods:
		// Protected Methods:
		// Private Methods:
		protected function configUI():void {
			//button_mc.label = "For more info, click here »";
			//button_mc.addEventListener(MouseEvent.CLICK, onMoreInfoClick);
		}
		
		protected function onMoreInfoClick(me:MouseEvent) {
			navigateToURL(new URLRequest("http://www.protectourcoralsea.org.au"), "_blank");
		}
	}
	
}