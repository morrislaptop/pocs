package  {
	
	import flash.display.MovieClip;
	import flash.text.TextField;
	import flash.events.*;
	
	public class Alert extends MovieClip {
		
		// Constants:
		// Public Properties:
		// Private Properties:
		// UI Elements:
		public var alert_bg_mc:MovieClip;
		public var label_txt:TextField;
		public var ok_mc:MovieClip;
		
		// Initialization:
		public function Alert() {
			configUI();
		}

		// Public Methods:
		public function show(msg:String):void {
			label_txt.text = msg;
			visible = true;
		}
		
		// Protected Methods:
		// Private Methods:
		protected function configUI():void { 
			visible = false;
			ok_mc.addEventListener(MouseEvent.CLICK, onOkClick);
			ok_mc.buttonMode = true;
		}
		
		protected function onOkClick(me:MouseEvent) {
			visible = false;
		}
	}
	
}