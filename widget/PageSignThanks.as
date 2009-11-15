package  {
	
	import flash.display.MovieClip;
	import flash.events.*;

	public class PageSignThanks extends MovieClip {
		
		// Constants:
		// Public Properties:
		// Private Properties:
		// UI Elements:
		public var counter_mc:Counter;
		public var embed_mc:MyButton;
		public var forward_mc:MyButton;
		
		// Initialization:
		public function PageSignThanks() {
			configUI();
		}

		// Public Methods:
		public function add_Result(data:Object) {
			Widget.pages.openPage("page_sign_thanks_mc");
			counter_mc.init();
		}
		
		// Protected Methods:
		// Private Methods:
		protected function configUI():void {
			embed_mc.label = "Embed this widget »";
			embed_mc.addEventListener(MouseEvent.CLICK, onEmbedClick);
			
			forward_mc.label = "Forward to Friends »";
			forward_mc.addEventListener(MouseEvent.CLICK, onForwardClick);
		}
		
		protected function onEmbedClick(me:MouseEvent) {
			Widget.tabs.openTab("forward_mc");
			Widget.pages.openPage("page_forward_embed_mc");
		}
		
		protected function onForwardClick(me:MouseEvent) {
			Widget.tabs.openTab("forward_mc");
			Widget.pages.openPage("page_forward_friends_mc");
		}
		
	}
	
}