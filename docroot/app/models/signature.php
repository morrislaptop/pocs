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
			),
			'specialUnique' => array(
				'rule' => 'specialUnique',
				'message' => 'This email address has already signed the petition'
			)
		),
		'postcode' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty'
			)
		),
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
	
	function specialUnique($check) {
		if ( Configure::read('Signatures.exceptionEmail') == $check['email'] ) {
			return true;
		}
		return $this->isUnique($check);
	}
	
	/**
	* Override a basic count find to include that from Care2
	* 
	* @param mixed $conditions
	* @param mixed $fields
	* @param mixed $order
	* @param mixed $recursive
	* @return array
	*/
	function find($conditions = null, $fields = array(), $order = null, $recursive = null) {
		if ( 'count' === $conditions && $fields === array() ) {
			return $this->getCombinedCount();	
		}
		else {
			return parent::find($conditions, $fields, $order, $recursive);
		}
	}
	
	function getCombinedCount() {
        $conditions = "source != 'Care2' OR source IS NULL";
		$ourDbCount = parent::find('count', compact('conditions'));
		
		$cached = Cache::read('Signatures.care2count');
		if ( !$cached ) {
			$rss = simplexml_load_file(Configure::read('Signatures.care2url'));
			$guid = $rss->channel->item[0]->guid;
			$fragment = parse_url($guid, PHP_URL_FRAGMENT);
			$theirCount = intval(str_replace('signature', '', $fragment));
			Cache::write('Signatures.care2count', $theirCount); // remember for next time
			$cached = $theirCount;
		}
		
		return $ourDbCount + $cached;
	}
}
?>