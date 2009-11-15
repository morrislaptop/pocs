<?php
class SignaturesController extends AppController {

	var $name = 'Signatures';
	var $helpers = array('Html', 'Form', 'Advindex.Advindex', 'Forest.Menu');
	var $components = array('Email', 'Advindex.Advindex');
	var $uses = array('Signature', 'BakedSimple.Node', 'Mp');

	/**
	* @var Signature
	*/
	var $Signature;

	function intro() {
		$bs = $this->BakedSimple->pull();
		if ( !empty($this->data) ) {
			if ( $this->data['Signature']['not_in_australia'] ) {
				$this->redirect(array('action' => 'add', 'outside'));
			}
			else if ( empty($this->data['Signature']['postcode']) ) {
				$this->Signature->invalidate('postcode', 'notEmpty');
			}
			else {
				$this->redirect(array('action' => 'add', $this->data['Signature']['postcode']));
			}
		}
		$signatureCount = $this->Signature->find('count');
		$this->set(compact('signatureCount'));
		$this->render($bs['template'], $bs['layout']);
	}

	function add($postcode)
	{
		$bs = $this->BakedSimple->pull(); // do up here because we need the letter data.

		// Main Save
		if ( !empty($this->data) ) {
			$this->Signature->create();
			$this->data['Signature']['source'] = 'web';
			if ($this->Signature->save($this->data)) {
				$this->Session->setFlash(__('The Signature has been saved', true), 'default', array('class' => 'success'));
				$this->_email($this->Signature->id, $bs['node']);
				$this->redirect(Configure::read('Signatures.success_url'));
			} else {
				$this->Session->setFlash(__('The Signature could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		else {
			$this->data['Signature']['optin'] = true;
		}

		// Get mps and the correct leter.
		$not_in_australia = 'outside' == $postcode;
		if ( $not_in_australia ) {
			$letter = $bs['node']['Node']['PM Letter'];
			$this->data['Signature']['not_in_australia'] = true;
			$this->data['Signature']['postcode'] = null;
			$mps = array();
		}
		else {
			$letter = $bs['node']['Node']['Aus Letter'];
			$this->data['Signature']['not_in_australia'] = false;
			$this->data['Signature']['postcode'] = $postcode;
			$mps = $this->_getMps($postcode);
		}

		// Substitute variables.
		$letter = $this->_processLetter($letter, $mps);

		// Set and display
		$this->_setFormData();
		$signatureCount = $this->Signature->find('count');
		$this->set(compact('signatureCount', 'mps', 'letter', 'postcode'));
		$this->render($bs['template'], $bs['layout']);
	}
	
	function flash_mps($data) {
		$bs = $this->BakedSimple->pull('/act-now/sign');
		
		if ( $data['Signature']['not_in_australia'] ) {
			$letter = $bs['node']['Node']['PM Letter'];
			$mps = array();
		}
		else {
			$letter = $bs['node']['Node']['Aus Letter'];
			$mps = $this->_getMps($data['Signature']['postcode']);
		}
		
		$letter = $this->_processLetter($letter, $mps);
		
		return compact('mps', 'letter');
	}
	
	function flash_add($data) 
	{
		$bs = $this->BakedSimple->pull('/act-now/sign');
		
		if ( !empty($data) ) 
		{
			$this->Signature->create();
			$data['Signature']['source'] = 'flash';
			$data['Signature']['personal_note'] = str_replace('Enter your personal message here..', '', $data['Signature']['personal_note']);
			if ($this->Signature->save($data)) {
				$this->_email($this->Signature->id, $bs['node']);
				return array('success' => true);
			}
			else {
				return array('success' => false, 'errors' => implode("\n", $this->Signature->validationErrors));
			}
		}
	}
	
	function _processLetter($letter, $mps) {
		$search_replace = array(
			'%Mp.name%' => $mps ? $mps[0]['Mp']['name'] : null,
			'%Signature.personal_note%' => __('Your personal note will be here', true),
			'%Signature.first_name% %Signature.last_name%' => __('Your name will appear here', true),
		);
		$letter = str_replace(array_keys($search_replace), $search_replace, $letter);
		return $letter;
	}

	function _email($id, $node)
	{
		$signature = $this->Signature->read(null, $id);

		// Send Recipient
		if ( !$signature['Mp']['id'] ) {
			$this->Email->to = Configure::read('Signatures.pm_email');
			$letter = $node['Node']['PM Letter'];
		}
		else {
			$this->Email->to = $signature['Mp']['email'];
			$letter = $node['Node']['Aus Letter'];
		}

		// Template
		$conditions = array(
			'Node.url' => '/emails/letter',
		);
		$eav = true;
		$template = $this->Node->find('first', compact('conditions', 'eav'));
		$template = $template['Node']['Content'];
		$keys = array();
		$values = array();

		$keys[] = '%letter%';
		$values[] = $letter;
		$signature['Signature']['personal_note'] = nl2br($signature['Signature']['personal_note']);

		foreach ($signature as $alias => $fields) {
			foreach ($fields as $field => $value) {
				$keys[] = '%' . $alias . '.' . $field . '%';
				$values[] = $value;
			}
		}
		$keys[] = 'href="/';
		$values[] = 'href="' . Router::url('/', true);
		$keys[] = 'src="/';
		$values[] = 'src="' . Router::url('/', true);
		$email = str_replace($keys, $values, $template);
		
		// Attach message if its from the no reply email
		if ( Configure::read('Signatures.exceptionEmail') == $signature['Signature']['email'] ) {
			$email = '<p><strong>Please do not reply to this email, the person who sent this signature has used our temporary email address noreply@protectourcoralsea.org.au as they did not have their own email.</strong></p>' . $email;
		}

		// Set data
		$this->set(compact('signature', 'letter', 'email'));

		// Rest of the stuff
		$this->Email->subject = Configure::read('Signatures.subject');
		$this->Email->from = $signature['Signature']['email'];
		$this->Email->bcc = array($signature['Signature']['email']);
		$this->Email->sendAs = 'html';
		$this->Email->template = 'content';
		if ( !Configure::read() ) {
			$this->Email->send();
		}

		// Send copy
		$to = implode(', ', am(array($this->Email->to), $this->Email->cc));
		$this->Email->subject .= ' ('. $to . ')';
		$this->Email->to = Configure::read('Signatures.copy');
		$this->Email->cc = $this->Email->bcc = array();
		$this->Email->send();
	}

	function _getMps($postcode) {
		$url = sprintf(Configure::read('Signatures.mp_service_url'), $postcode);
		$content = file_get_contents($url);
		$mps = array();
		$lines = explode("\n", trim($content));
		foreach ($lines as $line) {
			$mp = array();
			if ( strpos($line, 'No results') !== false ) {
				continue;
			}
			list($electorate, $probability, $name, $email) = explode(';', $line);

			$conditions = compact('electorate', 'postcode');
			$this->Mp->create();
			if ( !($mp = $this->Mp->find('first', compact('conditions'))) ) {
				$this->Mp->save(compact('electorate', 'postcode', 'probability', 'name', 'email'));
			}
		}

		// Get list of mps ordered by probablity.
		$conditions = compact('postcode');
		$order = 'probability DESC';
		$mps = $this->Mp->find('all', compact('conditions', 'order'));
		return $mps;
	}
	
	function flash_count() {
		$count = $this->Signature->find('count');
		return $count;
	}

	function admin_print($ids)
	{
		// Get signatures
		$ids = explode(',', $ids);
		$conditions = array(
			'Signature.id' => $ids
		);
		$signatures = $this->Signature->find('all', compact('conditions'));

		// Get letters
		$conditions = array(
			'url' => '/act-now/sign'
		);
		$eav = true;
		$contain = array();
		$node = $this->Node->find('first', compact('conditions', 'eav', 'contain'));
		$ausLetter = $node['Node']['Aus Letter'];
		$pmLetter = $node['Node']['PM Letter'];
		
		// Get the letterhead form the snippets
		$snippetObj = ClassRegistry::init('BakedSimple.Snippet');
		$letterhead = $snippetObj->field('content', array('title' => 'Letterhead'));

		// Render
		$this->layout = 'print';
		$this->set(compact('signatures', 'ausLetter', 'pmLetter', 'letterhead'));
	}

	function admin_index() {
		$this->Signature->recursive = 0;
		$this->set('signatures', $this->paginate());
		$this->_setFormData();
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Signature->create();
			if ($this->Signature->save($this->data)) {
				$this->Session->setFlash(__('The Signature has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Signature could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		$this->_setFormData();
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Signature', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Signature->save($this->data)) {
				$this->Session->setFlash(__('The Signature has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Signature could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Signature->read(null, $id);
		}
		$this->_setFormData();
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Signature', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Signature->del($id)) {
			$this->Session->setFlash(__('Signature deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'));
		}
	}

	
	function _setFormData() {
		$sources = array('web' => 'web', 'flash' => 'flash');
		$this->set(compact('sources'));
	}

}
?>