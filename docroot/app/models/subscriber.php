<?php
class Subscriber extends AppModel
{
	var $name = 'Subscriber';
	var $useTable = false;
	var $actsAs = array(
		'CampaignMonitor.Subscriber' => array()
	);

	function __construct($id = false, $table = null, $ds = null) {
		$this->actsAs['CampaignMonitor.Subscriber']['ApiKey'] = Configure::read('CampaignMonitor.ApiKey');
		$this->actsAs['CampaignMonitor.Subscriber']['ListId'] = Configure::read('Subscribers.ListId');
		parent::__construct($id, $table, $ds);
	}
}
?>