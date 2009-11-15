<?php
class Enquiry extends AppModel {

	var $name = 'Enquiry';
	var $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty'
			)
		),
		'email' => array(
			'email' => array(
				'rule' => 'email'
			)
		),
		'phone' => array(
			'phoneOrEmail' => array(
				'rule' => 'phoneOrEmail'
			)
		),
		'enquiry' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty'
			)
		),
        'category' => array(
            'inList' => array(
                'rule' => array('inList', 'SET IN CONSTRUCTOR')
            )
        ),
        'contact_via' => array(
        	'inList' => array(
                'rule' => array('inList', 'SET IN CONSTRUCTOR')
            )
        )
	);

	function __construct($id = false, $table = null, $ds = null)
	{
		parent::__construct($id, $table, $ds);

		// Set valid categories from config
		$categories = Configure::read('Enquiries.categories');
		$categories = explode(',', $categories);
		$categories = array_combine($categories, $categories);
		$this->validate['category']['inList']['rule'][1] = $categories;
		$contact_vias = Configure::read('Enquiries.contact_via');
		$contact_vias = explode(',', $contact_vias);
		$contact_vias = array_combine($contact_vias, $contact_vias);
		$this->validate['contact_via']['inList']['rule'][1] = $contact_vias;
	}

	function phoneOrEmail($data, $limit) {
		if ( empty($this->data['Enquiry']['email']) && empty($this->data['Enquiry']['phone']) ) {
			return false;
		}
		return true;
	}
}
?>