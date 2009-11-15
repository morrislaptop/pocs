package  {
	
	import flash.display.MovieClip;
	import flash.events.*;
	import flash.text.TextField;
	import br.com.stimuli.mona.validators.EmailValidator;
	import flash.net.Responder;
	import flash.external.ExternalInterface;
	
	public class PageForwardFriends extends MovieClip {
		
		// Constants:
		// Public Properties:
		// Private Properties:
		// UI Elements:
		public var button_mc:MyButton;
		public var friends_email1_txt:TextField;
		public var friends_email2_txt:TextField;
		public var friends_email3_txt:TextField;
		public var your_email_txt:TextField;
		
		// Initialization:
		public function PageForwardFriends() {
			configUI();
		}

		// Public Methods:
		// Protected Methods:
		// Private Methods:
		protected function configUI():void { 
			new FriendlyDefault(your_email_txt);
			new FriendlyDefault(friends_email1_txt);
			new FriendlyDefault(friends_email2_txt);
			new FriendlyDefault(friends_email3_txt);
			
			button_mc.label = "Forward to Friends »";
			button_mc.addEventListener(MouseEvent.CLICK, onForwardClick);
		}
		
		protected function onForwardClick(me:MouseEvent):void {
			var data = {
				Referral: {
					your_email: your_email_txt.text,
					friends: [
						friends_email1_txt.text,
						friends_email2_txt.text,
						friends_email3_txt.text,
					],
					flash_url: ExternalInterface.call('window.location.href.toString')
				}
			};
			if ( validate(data) ) {
				var responder:Responder = new Responder(Widget.pages.page_sign_thanks_mc.add_Result, Widget.onFault);
				Widget.RS.call("ReferralsController.flash_add", responder, data);
				button_mc.label = "forwarding..";
			}
		}
		
		protected function validate(data:Object)
		{
			var msg:String = "";
			if ( !EmailValidator.isValidEmail(data.Referral.your_email) ) {
				msg += "Please enter your email address\n";
			}

			var validEmailFound:Boolean = false;
			for ( var i = 0; i < data.Referral.friends.length; i++ ) {
				if ( EmailValidator.isValidEmail(data.Referral.friends[i]) ) {
					validEmailFound = true;
					break;
				}
			}
			if ( !validEmailFound ) {
				msg += "Please enter at least one friend's email address\n";
			}
			
			if ( msg ) {
				Widget.alert.show(msg);
				return false;
			}
			return true;
		}
	}
	
}