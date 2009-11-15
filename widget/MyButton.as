package  {
	
	import flash.display.MovieClip;
	import flash.geom.ColorTransform;
	import flash.events.*;
	import flash.text.*;
	
	public class MyButton extends MovieClip {
		
		// Constants:
		// Public Properties:
		
		
		// Private Properties:
		private var _colorTransform:ColorTransform;
		
		// UI Elements:
		public var button_bg_mc:MovieClip, label_txt:TextField, shadow_txt:TextField;

		
		// Initialization:
		public function MyButton() {
			configUI();
		}

		// Public Methods:
		public function set label(value:String):void {
			label_txt.text = shadow_txt.text = value;
		}
		
		// Protected Methods:
		// Private Methods:
		protected function configUI():void {
			size();
			
			addEventListener(MouseEvent.MOUSE_OVER, onMouseOver);
			addEventListener(MouseEvent.MOUSE_OUT, onMouseOut);
			
			_colorTransform = button_bg_mc.transform.colorTransform;
			
			buttonMode = true;
			mouseChildren = false;
		}
		
		protected function size()
		{
			var targetWidth:Number = width;
			var targetHeight:Number = height;
			scaleX = scaleY = 1;
			button_bg_mc.width = targetWidth;
			button_bg_mc.height = targetHeight;
			label_txt.width = shadow_txt.width = targetWidth - 10;
		}
		
		protected function onMouseOver(me:MouseEvent) {
			button_bg_mc.transform.colorTransform = new ColorTransform(0, 0, 0, 1, 255, 136, 17, 0);
		}
		protected function onMouseOut(me:MouseEvent) {
			button_bg_mc.transform.colorTransform = _colorTransform;
		}
	}
	
}