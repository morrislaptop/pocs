<?php
class AdminsController extends AppController {

	var $name = 'Admins';
	var $components = array('Cookie');
	var $helpers = array('Advindex.Advindex');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->autoRedirect = false;
		$this->Auth->authenticate = $this;
	}

	function hashPasswords($pass) {
		return $pass;
	}

	function admin_dashboard() {

	}

	function admin_login() {
    	$this->layout = 'login';
		if ($this->Auth->user()) {
			if (!empty($this->data) && $this->data['Admin']['remember']) {
				$cookie = array();
				$cookie['username'] = $this->data['Admin']['username'];
				$cookie['password'] = $this->data['Admin']['password'];
				$this->Cookie->write($this->Auth->sessionKey, $cookie, true, '+2 weeks');
				unset($this->data['Admin']['remember']);
			}
			$this->redirect($this->Auth->redirect());
		}
		if (empty($this->data)) {
			$cookie = $this->Cookie->read($this->Auth->sessionKey);
			if (!is_null($cookie)) {
				if ($this->Auth->login($cookie)) {
					//  Clear auth message, just in case we use it.
					$this->Session->del('Message.auth');
					$this->redirect($this->Auth->redirect());
				}
			}
		}
	}

    function admin_logout() {
    	$this->Cookie->del($this->Auth->sessionKey);
        $this->redirect($this->Auth->logout());
    }

    function admin_index() {
        $this->Admin->recursive = 0;
        $this->set('admins', $this->paginate());
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Admin->create();
            if ($this->Admin->save($this->data)) {
                $this->Session->setFlash(__('The Admin has been saved', true), 'default', array('class' => 'success'));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('The Admin could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Admin', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            if ($this->Admin->save($this->data)) {
                $this->Session->setFlash(__('The Admin has been saved', true), 'default', array('class' => 'success'));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('The Admin could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Admin->read(null, $id);
        }
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Admin', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Admin->del($id)) {
            $this->Session->setFlash(__('Admin deleted', true), 'default', array('class' => 'success'));
            $this->redirect(array('action'=>'index'));
        }
    }
}
?>