package  {
	
	import flash.display.MovieClip;
	import caurina.transitions.Tweener;
	
	public class Pages extends MovieClip {
		
		// Constants:
		// Public Properties:
		public var page_sign_mc:MovieClip, page_sign2_mc:MovieClip, page_info_mc:MovieClip;
		
		// Private Properties:
		private var _pages:Array;
		private var _currentPage:MovieClip;
		
		// UI Elements:
		

		
		// Initialization:
		public function Pages() {
			configUI();
			
			// Begin page management
			_pages = [page_sign_mc, page_sign2_mc, page_sign_thanks_mc, page_info_mc, page_forward_mc,
					  page_forward_friends_mc, page_forward_embed_mc];
			for ( var i = 1; i < _pages.length; i++ ) {
				_pages[i].visible = false;
				_pages[i].alpha = 0;
			}
			_currentPage = _pages[0];
		}

		// Public Methods:
		public function openPage(id:String) {
			this[id].visible = true;
			Tweener.addTween(_currentPage, {alpha: 0, time: 0.5, transition: "easeOutQuart", onComplete: function() { this.visible = false; }});
			Tweener.addTween(this[id], {alpha: 1, time: 0.5, transition: "easeInQuart"});
			_currentPage = this[id];
		}
		
		// Protected Methods:
		// Private Methods:
		protected function configUI():void { }
	}
	
}