package  {
	
	import flash.display.MovieClip;
	import flash.text.TextField;
	import caurina.transitions.Tweener;
	import flash.events.*;
	
	public class PersonalMessage extends MovieClip {
		
		// Constants:
		// Public Properties:
		// Private Properties:
		private var myY:Number;
		
		// UI Elements:
		public var done_mc:MyButton;
		public var message_txt:TextField;
		
		// Initialization:
		public function PersonalMessage() {
			configUI();
		}

		// Public Methods:
		public function open() {
			Tweener.addTween(this, { y: myY, time: 0.5, transition: "easeOutQuad" });
		}
		
		// Protected Methods:
		// Private Methods:
		protected function configUI():void {
			myY = y;
			y = height;
			
			new FriendlyDefault(message_txt);
			
			done_mc.label = "Done »";
			done_mc.addEventListener(MouseEvent.CLICK, onDoneClick);
		}
		
		protected function onDoneClick(me:MouseEvent) {
			Tweener.addTween(this, { y: height, time: 0.5, transition: "easeInQuad" });
		}
	}
	
}