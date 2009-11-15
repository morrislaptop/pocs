package  {
	
	import flash.display.*;
	import flash.net.NetConnection;
    import flash.net.ObjectEncoding;
	import flash.external.ExternalInterface;
	
	public class Widget extends MovieClip {
		
		// Constants:
		public static var RS:NetConnection, pages:Pages, tabs:Tabs, alert:Alert;
		
		// Public Properties:
		public var counter_mc:Counter, pages_mc:Pages, tabs_mc:Tabs, alert_mc:Alert;
		
		// Private Properties:
		private var _pages:Array = new Array();
	
		// Initialization:
		public function Widget() { 
		
			// Get flashvars
			var paramObj:Object = LoaderInfo(this.root.loaderInfo).parameters;
			
			// Statics
			pages = pages_mc;
			tabs = tabs_mc;
			alert = alert_mc;
			
			// Connect
			RS = new NetConnection();
			RS.objectEncoding = ObjectEncoding.AMF0;
			var gatewayUrl:String = paramObj.gatewayUrl ? paramObj.gatewayUrl : "http://www.protectourcoralsea.com.au/cpamf/gateway";
			RS.connect(gatewayUrl);
			
			// Init stages.
			counter_mc.init();
			//pages.openPage("page_forward_friends_mc");
			track();
		}
	
		// Public Methods:
		public static function onFault(fault:Object) {
			trace("bugger, got a fault");
		}
		
		// Protected Methods:
		protected function track():void {
			var url:String = ExternalInterface.call('window.location.href.toString');
			Widget.RS.call("WidgetHitsController.flash_add", null, url);
		}
	}
	
}