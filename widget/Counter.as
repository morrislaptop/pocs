package  {
	
	import flash.display.MovieClip;
	import flash.text.*;
	import flash.net.Responder;
	
	public class Counter extends MovieClip {
		
		// Constants:
		// Public Properties:
		// Private Properties:
		// UI Elements:
		public var count_txt:TextField;
		
		// Initialization:
		public function Counter() {
			configUI();
		}

		// Public Methods:
		public function init() {
			var responder:Responder = new Responder(drawCount, Widget.onFault);
			Widget.RS.call("SignaturesController.flash_count", responder);
		}
		
		// Protected Methods:
		protected function drawCount(count:Object) {
			var padded:String = count.toString();
			while (padded.length < 6) {
				padded = "0" + padded;
			}
			count_txt.text = padded;
			
			var format:TextFormat = new TextFormat();
			format.letterSpacing = 4;
			count_txt.setTextFormat(format);
		}
		
		// Private Methods:
		protected function configUI():void { }
	}
	
}