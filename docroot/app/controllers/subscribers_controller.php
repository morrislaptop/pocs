<?php
class SubscribersController extends AppController {

	var $name = 'Subscribers';

	function add() {
		if ( !empty($this->data) ) {
			$this->Subscriber->subscribe($this->data);
		}
	}
}
?>