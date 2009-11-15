<?php
class EcardItemsController extends AppController {

	var $name = 'EcardItems';
	var $helpers = array('Html', 'Form', 'Advindex.Advindex', 'Media.Medium');
	var $components = array('Advindex.Advindex');

	function admin_index() {
		$this->EcardItem->recursive = 0;
		$this->set('ecardItems', $this->paginate());
		$this->_setFormData();
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid EcardItem.', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('ecardItem', $this->EcardItem->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->EcardItem->create();
			if ($this->EcardItem->saveAll($this->data)) {
				$this->Session->setFlash(__('The EcardItem has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The EcardItem could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		$this->_setFormData();
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid EcardItem', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->EcardItem->saveAll($this->data)) {
				$this->Session->setFlash(__('The EcardItem has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The EcardItem could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EcardItem->read(null, $id);
		}
		$this->_setFormData();
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for EcardItem', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EcardItem->del($id)) {
			$this->Session->setFlash(__('EcardItem deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'));
		}
	}

	function _setFormData() {
		$scopes = Configure::read('EcardItems.scopes');
		$scopes = explode(',', $scopes);
		$scopes = array_combine($scopes, $scopes);
		$this->set(compact('scopes'));
	}

}
?>