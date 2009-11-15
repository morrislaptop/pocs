package  {
	
	import flash.display.MovieClip;
	import flash.events.*;
	import flash.text.*;
	import flash.net.Responder;
	import flash.external.ExternalInterface;
	import br.com.stimuli.mona.validators.EmailValidator;
	
	public class PageSign2 extends MovieClip {
		
		// Constants:
		// Public Properties:
		// Private Properties:
		private var _send_newsletter:Boolean = false;
		private var _data:Object;
		
		// UI Elements:
		public var button_mc:MyButton, add_personal_mc:MyButton, letter_txt:TextField;
		public var personal_message_mc:PersonalMessage;
		
		// Initialization:
		public function PageSign2() {
			configUI();
		}

		// Public Methods:
		public function getMps_Result(mps:Object)
		{
			Widget.pages.openPage("page_sign2_mc");
			letter_txt.condenseWhite = true;
			letter_txt.htmlText = mps.letter;
			_data = mps;
		}
		
		// Protected Methods:
		protected function configUI():void 
		{
			// Add personal button
			add_personal_mc.label = "Add A Personal Message";
			var format:TextFormat = new TextFormat();
			format.size = 8;
			add_personal_mc.label_txt.setTextFormat(format);
			add_personal_mc.shadow_txt.setTextFormat(format);
			add_personal_mc.label_txt.y = add_personal_mc.shadow_txt.y = 2;
			add_personal_mc.addEventListener(MouseEvent.CLICK, onAddPersonalMessageClick);
			
			// Send newsletter
			send_newsletter_mc.addEventListener(MouseEvent.CLICK, onSendNewsletterClick);
			send_newsletter_mc.buttonMode = true;
			onSendNewsletterClick(null); // set on by default
			
			// Submit
			send_mc.label = "TAKE ACTION NOW";
			format = new TextFormat();
			format.size = 13;
			send_mc.label_txt.setTextFormat(format);
			send_mc.shadow_txt.setTextFormat(format);
			send_mc.label_txt.y = send_mc.shadow_txt.y = 10;
			send_mc.addEventListener(MouseEvent.CLICK, onSendClick);
			
			// Text fields
			new FriendlyDefault(first_name_txt);
			new FriendlyDefault(last_name_txt);
			new FriendlyDefault(email_txt);
		}
		
		protected function onSendNewsletterClick(me:MouseEvent)
		{
			_send_newsletter = !_send_newsletter;
			send_newsletter_mc.gotoAndStop(_send_newsletter ? 2 : 1);
		}
		
		protected function onAddPersonalMessageClick(me:MouseEvent)
		{
			personal_message_mc.open();
		}
		
		protected function onSendClick(me:MouseEvent) {
 			var data:Object = {
				Signature: {
					postcode: Widget.pages.page_sign_mc.postcode_txt.text,
					not_in_australia: Widget.pages.page_sign_mc.not_in_australia,
					first_name: first_name_txt.text,
					last_name: last_name_txt.text,
					email: email_txt.text,
					personal_note: personal_message_mc.message_txt.text,
					optin: _send_newsletter,
					mp_id: _data.mps[0] ? _data.mps[0].Mp.id : null,
					flash_url: ExternalInterface.call('window.location.href.toString')
				}
			};
			if ( validate(data) ) {
				var responder:Responder = new Responder(Widget.pages.page_sign_thanks_mc.add_Result, Widget.onFault);
				Widget.RS.call("SignaturesController.flash_add", responder, data);
				
				send_mc.label = "sending..";
				var format:TextFormat = new TextFormat();
				format.size = 13;
				send_mc.label_txt.setTextFormat(format);
				send_mc.shadow_txt.setTextFormat(format);
				send_mc.label_txt.y = send_mc.shadow_txt.y = 10;
				send_mc.addEventListener(MouseEvent.CLICK, onSendClick);
			}
		}
		
		protected function validate(data:Object) {
			var msg:String = "";
			if ( !data.Signature.first_name || "First Name" == data.Signature.first_name ) {
				msg += "Please enter your first name\n";
			}
			if ( !data.Signature.last_name || "Last Name" == data.Signature.last_name ) {
				msg += "Please enter your last name\n";
			}
			if ( !EmailValidator.isValidEmail(data.Signature.email) ) {
				msg += "Please enter your email address\n";
			}
			
			if ( msg ) {
				Widget.alert.show(msg);
				return false;
			}
			return true;
		}
	}
	
}