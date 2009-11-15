<?php
class ReferralsController extends AppController {

	var $name = 'Referrals';
	var $helpers = array('Html', 'Form', 'Advindex.Advindex', 'Forest.Menu', 'Media.Medium');
	var $components = array('Advindex.Advindex', 'Email');
	var $uses = array('Referral', 'EcardItem', 'BakedSimple.Node');

	function add() {

		$bs = $this->BakedSimple->pull();

		// Get the default barry message.
		// We can't set this->data to prepopulate as there a two forms on this page which belong to the referral model
		$defaultBarryMessage = $this->_getDefaultMessage();

		if (!empty($this->data))
		{
			$this->Referral->create();
			$this->data['Referral']['source'] = 'web';
			if ($this->Referral->save($this->data)) {
				$this->Session->setFlash(__('The Referral has been saved', true), 'default', array('class' => 'success'));
				$this->_email($this->Referral->id);
				$this->redirect($bs['node']['Node']['Thankyou URL']);
			} else {
				$this->Session->setFlash(__('The Referral could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}


		$conditions = array(
			'scope' => 'Images'
		);
		$order = 'RAND()';
		$limit = 3;
		$ecardImages = $this->EcardItem->find('all', compact('conditions', 'order', 'limit'));
		$conditions['scope'] = 'Videos';
		$ecardVideos = $this->EcardItem->find('all', compact('conditions', 'order', 'limit'));

		$this->set(compact('ecardImages', 'ecardVideos', 'defaultBarryMessage'));
		$this->_setFormData();
	}
	
	function _getDefaultMessage()
	{
		$conditions = array(
			'url' => '/emails/barry-default-message'
		);
		$contain = array();
		$eav = true;
		$defaultBarryMessage = $this->Node->find('first', compact('conditions', 'eav', 'contain'));
		$defaultBarryMessage = $defaultBarryMessage['Node']['Content'];
		return $defaultBarryMessage;
	}
	
	function flash_add($data)
	{
		if ( !empty($data) )
		{
			// Infer the senders name from their email (will get it past validation as well)
			$data['Referral']['your_name'] = ucwords(substr($data['Referral']['your_email'], 0, strpos($data['Referral']['your_email'], '@')));
			$data['Referral']['source'] = 'flash';
			$data['Referral']['type'] = 'video';
			$data['Referral']['ecard_item_id'] = 18;
			$data['Referral']['message'] = $this->_getDefaultMessage();
			
			foreach ($data['Referral']['friends'] as $friend)
			{
				$this->Referral->create();
				$data2 = $data; // copy all the original data
				unset($data2['Referral']['friends']); // but not the friends array
				
				// Set friend data
				$data2['Referral']['friends_email'] = $friend;
				$data2['Referral']['friends_name'] = ucwords(substr($friend, 0, strpos($friend, '@')));
				
				// Save
				if ( $this->Referral->save($data2) ) {
					$this->_email(($this->Referral->id));
				}
			}
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Referral.', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		$bs = $this->BakedSimple->pull();
		$this->Referral->contain(array('EcardItem' => 'Image'));
		$this->set('referral', $this->Referral->read(null, $id));
	}

	function _email($id)
	{
		// Get Data
		$referral = $this->Referral->read(null, $id);

		// Template.
		$conditions = array(
			'Node.url' => '/emails/referral',
		);
		$eav = true;
		$template = $this->Node->find('first', compact('conditions', 'eav'));
		$keys = array();
		$values = array();
		foreach ($referral as $alias => $fields) {
			foreach ($fields as $field => $value) {
				$keys[] = '%' . $alias . '.' . $field . '%';
				$values[] = $value;
			}
		}
		$keys[] = 'href="/';
		$values[] = 'href="' . Router::url('/', true);
		$keys[] = 'src="/';
		$values[] = 'src="' . Router::url('/', true);
		$email = str_replace($keys, $values, $template['Node']['Content']);

		// Set data
		$this->set(compact('referral', 'email'));

		// Rest of the stuff
		$this->Email->to = $referral['Referral']['friends_email'];
		$this->Email->subject = Configure::read('Referrals.' . $referral['Referral']['type'] . '.subject');
		$this->Email->from = $referral['Referral']['your_email'];
		$this->Email->template = 'content';
		$this->Email->sendAs = 'html';
		if ( !Configure::read() ) {
			$this->Email->send();
		}

		// Send copy
		$to = implode(', ', am(array($this->Email->to), $this->Email->cc));
		$this->Email->subject .= ' ('. $to . ')';
		$this->Email->to = Configure::read('Referrals.copy');
		$this->Email->cc = $this->Email->bcc = array();
		$this->Email->send();
	}

	function admin_index() {
		$this->Referral->recursive = 0;
		$this->set('referrals', $this->paginate());
		$this->_setFormData();
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Referral->create();
			if ($this->Referral->save($this->data)) {
				$this->Session->setFlash(__('The Referral has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Referral could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		$this->_setFormData();
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Referral', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Referral->save($this->data)) {
				$this->Session->setFlash(__('The Referral has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Referral could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Referral->read(null, $id);
		}
		$this->_setFormData();
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Referral', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Referral->del($id)) {
			$this->Session->setFlash(__('Referral deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'));
		}
	}

	function _setFormData() {
		$sources = array('web' => 'web', 'flash' => 'flash');
		$this->set(compact('sources'));
	}

}
?>