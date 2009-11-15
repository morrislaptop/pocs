<?php
class Referral extends AppModel {

	var $name = 'Referral';
	var $validate = array(
		'message' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty'
			),
		),
		'your_name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty'
			),
		),
		'your_email' => array(
			'email' => array(
				'rule' => 'email'
			),
		),
		'friends_email' => array(
			'notEmpty' => array(
				'rule' => 'email'
			),
		),
	);
	var $belongsTo = array(
		'EcardItem'
	);
	var $order = 'Referral.created DESC';
}
?>