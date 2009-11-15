package  {
	
	import flash.display.MovieClip;
	import flash.text.TextField;
	import flash.events.*;
	
	public class EmbedButton extends MovieClip {
		
		// Constants:
		// Public Properties:
		// Private Properties:
		private var _outColour:uint;
		
		// UI Elements:
		public var label_txt:TextField;
		
		// Initialization:
		public function EmbedButton() {
			configUI();
		}

		// Public Methods:
		// Protected Methods:
		// Private Methods:
		protected function configUI():void { 
			buttonMode = true;
			mouseChildren = false;
			addEventListener(MouseEvent.MOUSE_OVER, onMouseOver);
			addEventListener(MouseEvent.MOUSE_OUT, onMouseOut);
			addEventListener(MouseEvent.CLICK, onMouseClick);
			_outColour = label_txt.textColor;
		}
		
		protected function onMouseOver(me:MouseEvent) {
			label_txt.textColor = 0xff8811;
		}
		protected function onMouseOut(me:MouseEvent) {
			label_txt.textColor = _outColour;
		}
		protected function onMouseClick(me:MouseEvent) {
			Widget.tabs.openTab("forward_mc");
			Widget.pages.openPage("page_forward_embed_mc");
		}
	}
	
}