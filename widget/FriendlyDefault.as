package  {
	
	import flash.text.TextField;
	import flash.events.*;
	
	public class FriendlyDefault {
		
		// Constants:
		// Public Properties:
		// Private Properties:
		private var _tf:TextField;
		private var _default_str:String;
	
		// Initialization:
		public function FriendlyDefault(tf:TextField) { 
			_tf = tf;
			install();
		}
	
		// Public Methods:
		public function install() {
			_default_str = _tf.text;
			_tf.addEventListener(FocusEvent.FOCUS_IN, onFocusIn);
			_tf.addEventListener(FocusEvent.FOCUS_OUT, onFocusOut);
		}
		
		// Protected Methods:
		protected function onFocusIn(fe:FocusEvent) {
			if ( _tf.text == _default_str ) {
				_tf.text = "";
			}
		}
		protected function onFocusOut(fe:FocusEvent) {
			if ( _tf.text == "" ) {
				_tf.text = _default_str;
			}
		}
	}
	
}