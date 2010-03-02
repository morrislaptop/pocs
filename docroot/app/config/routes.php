<?php
/* SVN FILE: $Id: routes.php 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 * Short description for file.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
 
if ( '/act' == $_SERVER['REQUEST_URI'] ) {
    header("Location: /act-now");
    exit;
}
 
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
Router::connect('/', array('plugin' => 'baked_simple', 'controller' => 'nodes', 'action' => 'display'));
Router::connect('/admin', array('plugin' => 'baked_simple', 'controller' => 'nodes', 'action' => 'index', 'admin' => 'true', 'prefix' => 'admin'));
Router::connect('/contact-us', array('controller' => 'enquiries', 'action' => 'add'));
Router::connect('/act-now', array('controller' => 'signatures', 'action' => 'intro'));
Router::connect('/act-now/sign/*', array('controller' => 'signatures', 'action' => 'add'));
Router::connect('/act-now/thankyou', array('controller' => 'referrals', 'action' => 'add'));
Router::connect('/send-to-a-friend', array('controller' => 'referrals', 'action' => 'add'));
Router::connect('/media/:controller/:action/*', array('plugin' => 'advmedia', 'controller' => 'filter'));

if ( file_exists(CACHE . 'settings' . DS . 'routes.php') ) {
	require_once(CACHE . 'settings' . DS . 'routes.php');
}

// Connect everything to the CMS
$routes = Cache::read('routes_list');
if ( Configure::read() || $routes === false )
{
	$routes = array();

	// Controllers
    $controllers = Configure::listObjects('controller');
    foreach ($controllers as &$value) {
        $routes[] = Inflector::underscore($value);
	}

	// Plugins
    $plugins = Configure::listObjects('plugin');
    foreach ($plugins as &$value) {
        $routes[] = Inflector::underscore($value);
	}

    $routes[] = 'admin';
    $routes = implode('/|', $routes);
    Cache::write('routes_list', $routes);
}
Router::connect('(?!' . $routes . ')(.*)', array('plugin' => 'baked_simple', 'controller' => 'nodes', 'action' => 'display'));

Router::parseExtensions('json');
?>