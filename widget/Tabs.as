package  {
	
	import flash.display.*;
	import flash.events.*;
	
	public class Tabs extends MovieClip {
		
		// Constants:
		// Public Properties:
		// Private Properties:
		private var _tabs:Array = new Array();
		
		// UI Elements:
		

		
		// Initialization:
		public function Tabs() {
			configUI();
		}

		// Public Methods:
		public function openTab(id:String) {
			var child:Tab = getChildByName(id) as Tab;
			child.active = true;
		}
		
		// Protected Methods:
		// Private Methods:
		protected function configUI():void { 
			var tab1:Tab = new Tab("Protect our Sea", "page_sign_mc");
			tab1.name = "save_mc";
			tab1.active = true;
			tab1.addEventListener(Event.OPEN, onTabOpen);
			_tabs.push(tab1);
			addChild(tab1);
			
			var tab2:Tab = new Tab("Information", "page_info_mc");
			tab2.name = "info_mc";
			tab2.addEventListener(Event.OPEN, onTabOpen);
			_tabs.push(tab2);
			addChild(tab2);
			
			var tab3:Tab = new Tab("Forward", "page_forward_mc");
			tab3.addEventListener(Event.OPEN, onTabOpen);
			tab3.name = "forward_mc";
			_tabs.push(tab3);
			addChild(tab3);
			
			posTabs();
		}
		
		protected function onTabOpen(e:Event) {
			for ( var i = 0; i < _tabs.length; i++ ) {
				if ( _tabs[i] != e.target ) {
					_tabs[i].active = false;
				}
			}
			
			posTabs();
			Widget.pages.openPage(e.target.page_id);
		}
		
		protected function posTabs():void {
			var tabX:Number = 5;
			for ( var i = 0; i < _tabs.length; i++ ) {
				_tabs[i].x = tabX;
				tabX += _tabs[i].width + 5;
			}
		}
	}
	
}