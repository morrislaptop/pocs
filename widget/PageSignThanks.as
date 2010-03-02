package  {
	
	import flash.display.MovieClip;
	import flash.events.*;
	import flash.text.*;
	import flash.net.*;

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
			if ( data.success ) {
				Widget.pages.openPage("page_sign_thanks_mc");
				counter_mc.init();
			}
			else {
				Widget.alert.show(data.errors);
				Widget.pages.page_sign2_mc.send_mc.label = "TAKE ACTION NOW";
				var format = new TextFormat();
				format.size = 13;
				Widget.pages.page_sign2_mc.send_mc.label_txt.setTextFormat(format);
				Widget.pages.page_sign2_mc.send_mc.shadow_txt.setTextFormat(format);
				Widget.pages.page_sign2_mc.send_mc.label_txt.y = Widget.pages.page_sign2_mc.send_mc.shadow_txt.y = 10;
			}
		}
		
		// Protected Methods:
		// Private Methods:
		protected function configUI():void {
			embed_mc.label = "Embed this widget »";
			embed_mc.addEventListener(MouseEvent.CLICK, onEmbedClick);
			
			forward_mc.label = "Forward to Friends »";
			forward_mc.addEventListener(MouseEvent.CLICK, onForwardClick);
			
			twitter_mc.buttonMode = true;
			twitter_mc.addEventListener(MouseEvent.CLICK, onTwitterClick);
			
			facebook_mc.buttonMode = true;
			facebook_mc.addEventListener(MouseEvent.CLICK, onFacebookClick);
		}
		
		protected function onTwitterClick(me:MouseEvent) {
			var url:String = "http://twitter.com/home?status=I just contacted my federal MP to Protect our Coral Sea, you can too: http://www.protectourcoralsea.org.au/act-now";
			var r:URLRequest = new URLRequest(url);
			navigateToURL(r, "_blank");
		}
		
		protected function onFacebookClick(me:MouseEvent) {
			var url:String = "http://www.facebook.com/sharer.php?u=http%3A%2F%2Fwww.protectourcoralsea.org.au%2Fact-now&src=sp";
			var r:URLRequest = new URLRequest(url);
			navigateToURL(r, "_blank");
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