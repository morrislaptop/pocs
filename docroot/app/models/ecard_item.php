<?php
class EcardItem extends AppModel {

	var $name = 'EcardItem';
	var $hasOne = array(
		'Image' => array(
		    'className' => 'Media.Attachment',
		    'foreignKey' => 'foreign_key',
		    'conditions' => array('Image.model' => 'EcardItem', 'Image.group' => 'image'),
		    'dependent' => true,
		),
	);
	var $validate = array(
		'name' => array('notEmpty')
	);

	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->Image->validate['file']['extension']['rule'][2][] = 'flv';
		$this->Image->validate['file']['extension']['rule'][2][] = 'f4v';
		$this->Image->validate['file']['mimeType']['rule'][2][] = 'text/plain';
	}
}
?>