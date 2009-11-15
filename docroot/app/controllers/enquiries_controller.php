<?php
class EnquiriesController extends AppController {

	var $name = 'Enquiries';
	var $components = array('Email');
	var $helpers = array('Html', 'Form', 'Forest.Menu');

	function add()
	{
		if ( !empty($this->data) )
		{
			$this->Enquiry->create();
			if ($this->Enquiry->save($this->data)) {
				$this->_email($this->Enquiry->id);
				$this->redirect(Configure::read('Enquiries.success_url'));
			}
		}

		$cms = $this->BakedSimple->pull();
		$this->_setFormData();
		$this->render($cms['template']);
	}

	function _email($id) {
		$enquiry = $this->Enquiry->read(null, $id);

		// Send
		$this->Email->to = Configure::read('Enquiries.to');
		$this->Email->subject = Configure::read('Enquiries.subject');
		$this->Email->from = $enquiry['Enquiry']['email'];
		$this->Email->sendAs = 'text';
		$this->Email->template = 'dump';
		$this->set('data', $enquiry['Enquiry']);
		$this->Email->send();

		// Send copy
		$this->Email->subject .= ' ('. $this->Email->to . ')';
		$this->Email->to = Configure::read('Enquiries.copy');
		$this->Email->send();
	}

	function admin_index() {
		$this->Enquiry->recursive = 0;
		$this->set('enquiries', $this->paginate());
		$this->_setFormData();
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Enquiry.', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('enquiry', $this->Enquiry->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Enquiry->create();
			if ($this->Enquiry->save($this->data)) {
				$this->Session->setFlash(__('The Enquiry has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Enquiry could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		$this->_setFormData();
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Enquiry', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Enquiry->save($this->data)) {
				$this->Session->setFlash(__('The Enquiry has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Enquiry could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Enquiry->read(null, $id);
		}
		$this->_setFormData();
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Enquiry', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Enquiry->del($id)) {
			$this->Session->setFlash(__('Enquiry deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'));
		}
	}

	function _setFormData()
	{
		$categories = $this->Enquiry->validate['category']['inList']['rule'][1];
		$contact_vias = $this->Enquiry->validate['contact_via']['inList']['rule'][1];
		$this->set(compact('categories', 'contact_vias'));
	}

}
?>