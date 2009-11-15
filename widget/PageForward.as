package  {
	
	import flash.display.MovieClip;
	import flash.events.*;

	public class PageForward extends MovieClip {
		
		// Constants:
		// Public Properties:
		// Private Properties:
		// UI Elements:
		public var embed_mc:MyButton;
		public var forward_mc:MyButton;
		
		// Initialization:
		public function PageForward() {
			configUI();
		}

		// Public Methods:
		// Protected Methods:
		// Private Methods:
		protected function configUI():void {
			embed_mc.label = "Embed this widget »";
			embed_mc.addEventListener(MouseEvent.CLICK, onEmbedClick);
			
			forward_mc.label = "Forward to Friends »";
			forward_mc.addEventListener(MouseEvent.CLICK, onForwardClick);
		}
		
		protected function onEmbedClick(me:MouseEvent) {
			Widget.pages.openPage("page_forward_embed_mc");
		}
		
		protected function onForwardClick(me:MouseEvent) {
			Widget.pages.openPage("page_forward_friends_mc");
		}
		
	}
	
}