package  {
	
	import flash.display.MovieClip;
	import flash.text.*;
	import flash.events.*;
	import flash.external.ExternalInterface;
	import flash.net.Responder;
	
	public class PageSign extends MovieClip {
		
		// Constants:
		// Public Properties:
		public var postcode_txt:TextField, button_mc:MovieClip;
		
		// Private Properties:
		private var _not_in_australia:Boolean = false;
		
		// UI Elements:
		

		
		// Initialization:
		public function PageSign() {
			configUI();
		}

		// Public Methods:
		public function set not_in_australia(value:Boolean):void {
			if ( _not_in_australia != value ) {
				onNotInAustraliaClick(null);
			}
		}
		public function get not_in_australia():Boolean {
			return _not_in_australia;
		}
		
		// Protected Methods:
		// Private Methods:
		protected function configUI():void {
			var friendlyDefault:FriendlyDefault = new FriendlyDefault(postcode_txt);
			
			not_in_australia_mc.addEventListener(MouseEvent.CLICK, onNotInAustraliaClick);
			not_in_australia_mc.buttonMode = true;
			
			button_mc.label = "TAKE ACTION NOW";
			var format:TextFormat = new TextFormat();
			format.size = 13;
			button_mc.label_txt.setTextFormat(format);
			button_mc.shadow_txt.setTextFormat(format);
			button_mc.label_txt.y = button_mc.shadow_txt.y = 10;
			button_mc.addEventListener(MouseEvent.CLICK, onSignClick);
		}
		
		protected function onNotInAustraliaClick(me:MouseEvent)
		{
			_not_in_australia = !_not_in_australia;
			not_in_australia_mc.gotoAndStop(_not_in_australia ? 2 : 1);
		}
		
		protected function onSignClick(me:MouseEvent) {
			var data:Object = {
				Signature: {
					postcode: postcode_txt.text,
					not_in_australia: _not_in_australia,
					flash_url: ExternalInterface.call('window.location.href.toString')
				}
			};
			if ( validate(data) ) {
				var responder:Responder = new Responder(Widget.pages.page_sign2_mc.getMps_Result, Widget.onFault);
				Widget.RS.call("SignaturesController.flash_mps", responder, data);
				button_mc.label = "sending..";
				
				var format:TextFormat = new TextFormat();
				format.size = 13;
				button_mc.label_txt.setTextFormat(format);
				button_mc.shadow_txt.setTextFormat(format);
				button_mc.label_txt.y = button_mc.shadow_txt.y = 10;
			}
		}
		
		protected function validate(data:Object) {
			if ( !data.Signature.not_in_australia && (!data.Signature.postcode || "Enter your postcode here" == data.Signature.postcode) ) {
				Widget.alert.show("Please enter your postcode");
				return false;
			}
			return true;
		}
	}
	
}