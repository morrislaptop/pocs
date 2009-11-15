<?php
/* SVN FILE: $Id: bootstrap.php 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 * Short description for file.
 *
 * Long description for file
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
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 *
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php is loaded
 * This is an application wide file to load any function that is not used within a class define.
 * You can also use this to include or require any files in your application.
 *
 */
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * $modelPaths = array('full path to models', 'second full path to models', 'etc...');
 * $viewPaths = array('this path to views', 'second full path to views', 'etc...');
 * $controllerPaths = array('this path to controllers', 'second full path to controllers', 'etc...');
 *
 */
Configure::write('App.siteName', 'Protect Our Coral Sea');

Configure::write('Advform.calendar', 'JqueryCalendar');
Configure::write('Advform.file', 'TinyBrowser');
Configure::write('Advform.wysiwyg', 'Tinymce');

Configure::write('Enquiries.categories', 'Help,Media Request');
Configure::write('Enquiries.contact_via', 'Email,Phone');
Configure::write('Enquiries.success_url', '/contact-us/thankyou');
Configure::write('Enquiries.to', 'info@protectourcoralsea.org.au');
Configure::write('Enquiries.copy', 'monitor@waww.com.au');
Configure::write('Enquiries.from', 'enquiries@protectourcoralsea.org.au');
Configure::write('Enquiries.subject', 'Enquiry from Protect Our Coral Sea');

Configure::write('Referrals.copy', 'monitor@waww.com.au');
Configure::write('Referrals.image.subject', 'A piece of coral');
Configure::write('Referrals.video.subject', 'A video of the ocean');
Configure::write('Referrals.success_url', '/act-now/referrals-thankyou');

Configure::write('CampaignMonitor.ApiKey', '56789d361b7e9111816bb4efc09a24cf');

Configure::write('Subscribers.ListId', '0603d8e9571c302d89ea0ec9e904df53');

Configure::write('Signatures.ListId', '11b5a541c8086f16c4c14259a4a56671');
Configure::write('Signatures.success_url', '/act-now/thankyou');
Configure::write('Signatures.copy', 'monitor@waww.com.au,info@protectourcoralsea.org.au');
Configure::write('Signatures.subject', 'Protect Our Coral Sea Petition Signature');
Configure::write('Signatures.pm_email', 'info@protectourcoralsea.org.au'); #'Griffith.eo@aph.gov.au');
Configure::write('Signatures.mp_service_url', 'http://ml.net.au/findfed/?id=32457&code=%s');
Configure::write('Signatures.exceptionEmail', 'noreply@protectourcoralsea.org.au');

Configure::write('EcardItems.scopes', 'Images,Videos');

if ( file_exists(CACHE . 'config.php') ) {
  require_once(CACHE . 'config.php');
}

require APP . 'plugins' . DS . 'media' . DS . 'config' . DS . 'core.php';
Configure::write('Media.filter.image', array());
Configure::write('Advmedia.filter.image', array(
	'xxs' => array('zoomCrop' => array(16, 16)),
	'xs'  => array('zoomCrop' => array(32, 32)),
	's'   => array('fitCrop' => array(80, 80)),
	'm'   => array('fit' => array(300, 220)),
	'l'   => array('fit' => array(450, 450)),
	'xl'  => array('fit' => array(680, 440)),
	'gallery' => array('zoomCrop' => array(239, 140))
	)
);

/**
 * Allows you to override the current domain for a single message lookup.
 * If the msg doesn't exist in the current domain, it will use the default
 * domain.
 *
 * @param string $domain Domain
 * @param string $msg String to translate
 * @param string $return true to return, false to echo
 * @return translated string if $return is false string will be echoed
 */
function __dd($domain, $msg, $return = false) {
	$d = __d($domain, $msg, true);
	if ( $d == $msg ) {
		return __($msg, $return);
	}
	if ( $return ) {
		return $d;
	}
	else {
		echo $d;
	}
}

//EOF
?>