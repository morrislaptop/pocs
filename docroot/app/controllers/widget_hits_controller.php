<?php
class WidgetHitsController extends AppController {

	var $name = 'WidgetHits';
	var $helpers = array('Html', 'Form', 'Advindex.Advindex');
	var $components = array('Advindex.Advindex');
	
	function flash_add($url) {
		$data = array(
			'WidgetHit' => array(
				'url' => $url
			)
		);
		$this->WidgetHit->create();
		return $this->WidgetHit->save($data);
	}

	function admin_index() {
		$this->WidgetHit->recursive = 0;
		$this->set('widgetHits', $this->paginate());
		$this->_setFormData();
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid WidgetHit.', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('widgetHit', $this->WidgetHit->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->WidgetHit->create();
			if ($this->WidgetHit->save($this->data)) {
				$this->Session->setFlash(__('The WidgetHit has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The WidgetHit could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		$this->_setFormData();
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid WidgetHit', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->WidgetHit->save($this->data)) {
				$this->Session->setFlash(__('The WidgetHit has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The WidgetHit could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->WidgetHit->read(null, $id);
		}
		$this->_setFormData();
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for WidgetHit', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->WidgetHit->del($id)) {
			$this->Session->setFlash(__('WidgetHit deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'));
		}
	}

	function _setFormData() {
	}

}
?>