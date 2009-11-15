<?php
class WidgetHit extends AppModel {

	var $name = 'WidgetHit';
	var $validate = array(
		'url' => array('notempty')
	);

}
?>