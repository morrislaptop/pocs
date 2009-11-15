<?php
class Signature extends AppModel
{
	var $name = 'Signature';
	var $actsAs = array(
		'CampaignMonitor.Subscriber' => array()
	);
	var $validate = array(
		'first_name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty'
			)
		),
		'email' => array(
			'email' => array(
				'rule' => 'email'
			)
		),
		'postcode' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty'
			)
		)
	);
	var $belongsTo = array(
		'Mp'
	);
	var $order = 'Signature.created DESC';

	function beforeValidate($options) {
		if ( !empty($this->data['Signature']['not_in_australia']) ) {
			unset($this->validate['postcode']);
		}
		return true;
	}

	function __construct($id = false, $table = null, $ds = null) {
		$this->actsAs['CampaignMonitor.Subscriber']['ApiKey'] = Configure::read('CampaignMonitor.ApiKey');
		$this->actsAs['CampaignMonitor.Subscriber']['ListId'] = Configure::read('Signatures.ListId');
		$this->actsAs['CampaignMonitor.Subscriber']['name'] = 'first_name';
		$this->actsAs['CampaignMonitor.Subscriber']['CustomFields'] = array('last_name', 'postcode', 'not_in_australia');
		parent::__construct($id, $table, $ds);
	}
}
?>