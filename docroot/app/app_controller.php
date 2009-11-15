<?php
/* SVN FILE: $Id: app_controller.php 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 */
class AppController extends Controller {
    var $helpers = array('Html', 'Javascript', 'Form', 'Advform.Advform');
    var $components = array('Auth', 'BakedSimple.BakedSimple', 'DebugKit.Toolbar');
    var $uses = array('BakedSimple.Node');
    var $layout = 'app';

    /**
    * @var EmailComponent
    */
    var $Email;

	function beforeFilter() {

		// set the layout and theme to the current app mode.
		if ( !empty($this->params['prefix']) ) {
			$this->view = 'theme';
			$this->theme = $this->params['prefix'];
			$beforeFilterMethod = 'beforeFilter' . ucwords($this->params['prefix']);
			if ( method_exists($this, $beforeFilterMethod) ) {
				$this->$beforeFilterMethod();
			}
		}
		else {
			$this->beforeFilterDefault();
		}
	}

	function beforeRender() {
		if ( !isset($this->viewVars['bg']) ) 
		{
			$conditions = array('url' => '/emails/backgrounds');
			$eav = true;
			$contain = array();
			$bgNode = $this->Node->find('first', compact('conditions', 'eav', 'contain'));
			$bgImagesCount = $bgNode['Node']['Background Images'];
			$bgImages = array();
			for ( $i = 1; $i < $bgImagesCount; $i++ ) {
				$bgImages[] = $bgNode['Node']['Background Image ' . $i];
			}
			$bgImages = Set::extract('/value', $bgImages);
			$bgImages = array_filter($bgImages);
			$this->set('bg', $bgImages[array_rand($bgImages)]);
		}

		if ( isset($this->viewVars['node']) ) 
		{
			foreach ($this->viewVars['node']['Node'] as $key => &$val) 
			{
				if ( !is_string($val) ) {
					continue;
				}
				$imgs = preg_match_all('@<img[^>]+>@', $val, $matches);
				if ( $matches[0] ) {
					foreach ($matches[0] as $match) {
						if ( preg_match('@title=["\']([^"\']+)["\']@', $match, $captionMatch) ) {
							
							// extract style, then remove it, as we will apply it to a wrapping element.
							$styleReg = '@style=["\']([^"\']+)["\']@';
							preg_match($styleReg, $match, $styleMatch);
							
							// extract the width
							$widthReg = '@width=["\']([^"\']+)["\']@';
							preg_match($widthReg, $match, $widthMatch);
							
							$caption = '<span style="width: ' . $widthMatch[1] . 'px;" class="caption">' . $captionMatch[1] . '</span>';
							$new = '<span style="' . $styleMatch[1] . ';" class="captionWrap">' . preg_replace($styleReg, '', $match) . $caption . '</span>';
							
							$val = str_replace($match, $new, $val);
						}
					}
				}
			}
		}
	}

	function beforeFilterDefault() {
		$this->Auth->allow('*');
	}

	function beforeFilterAdmin() {
		$this->Auth->userModel = 'Admin';
		$this->Auth->loginAction = array('plugin' => null, 'controller' => 'admins', 'action' => 'login');
	}
}
?>