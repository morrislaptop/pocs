package  {
	
	import flash.display.MovieClip;
	import flash.events.*;
	import flash.text.*;
	
	public class Tab extends MovieClip {
		
		// Constants:
		// Public Properties:
		public var page_id:String;
		
		// Private Properties:
		private var _active:Boolean = false;
		
		// UI Elements:
		public var label_txt:TextField, tab_bg_mc:MovieClip;
		
		// Initialization:
		public function Tab(label_str:String = "", page_id:String = "") {
			if ( label_str ) {
				label_txt.text = label_str;
			}
			this.page_id = page_id;
			configUI();
		}

		// Public Methods:
		public function set active(value:Boolean) {
			var oldValue:Boolean = _active;
			_active = value;
			if ( !oldValue && value ) {
				dispatchEvent(new Event(Event.OPEN));
			}
			else if ( oldValue && !value ) {
				dispatchEvent(new Event(Event.CLOSE));
			}
		}
		public function get active():Boolean {
			return _active;
		}
		
		override public function get width():Number {
			if ( _active ) {
				return tab_bg_mc.width - 5;
			}
			else {
				return label_txt.width;
			}
		}
		
		// Protected Methods:
		protected function configUI():void {
			buttonMode = true;
			mouseChildren = false;
			addEventListener(MouseEvent.CLICK, onMouseClick);
			addEventListener(Event.OPEN, onOpen);
			addEventListener(Event.CLOSE, onClose);
			onClose();
		}
		
		protected function onMouseClick(e:MouseEvent) {
			active = true;
		}
		
		protected function onOpen(e:Event) {
			tab_bg_mc.visible = true;
			label_txt.textColor = 0xFFFFFF;
			label_txt.x = 20;
			label_txt.y = 5;
			
			var format:TextFormat = label_txt.getTextFormat();
			format.size = 13;
			label_txt.defaultTextFormat = format;
			label_txt.setTextFormat(format);
			label_txt.width = 105;
			label_txt.autoSize = TextFieldAutoSize.CENTER;
		}
		
		protected function onClose(e:Event = null) {
			tab_bg_mc.visible = false;
			label_txt.textColor = 0x2D6BBF;
			label_txt.x = 0;
			label_txt.y = 10;
			
			var format:TextFormat = label_txt.getTextFormat();
			format.size = 12;
			label_txt.defaultTextFormat = format;
			label_txt.setTextFormat(format);
			label_txt.autoSize = TextFieldAutoSize.LEFT;
		}
		
		// Private Methods:
	}
	
}