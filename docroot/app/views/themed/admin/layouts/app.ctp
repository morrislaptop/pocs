<?php echo $html->doctype('xhtml-strict') ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <?php echo $html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<?php echo $javascript->link('http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js'); ?>
	<?php echo $html->css('screen'); ?>
	<?php echo $html->css('forms'); ?>
	<?php echo $html->css('tables'); ?>
	<?php
		if ( Configure::read() ) {
			echo $html->css('debug');
		}
	?>
	<?php echo $javascript->codeBlock('var baseUrl = "' . $html->webroot('/') . '";'); ?>
    <?php echo $scripts_for_layout; ?>
</head>
<body>
<div id="container">
    <div id="header">
        <?php echo $html->link(Configure::read('App.siteName'), '/', array('title' => 'View site home page')) ?>
    </div>

    <div id="sidebar">
    	<?php
    		$nav = array(
    			'CMS' => array(
    				'Content' => array('plugin' => 'baked_simple', 'controller' => 'nodes'),
		            'Sitemap' => array('plugin' => 'baked_simple', 'controller' => 'nodes', 'action' => 'sitemap'),
		            'Snippets' => array('plugin' => 'baked_simple', 'controller' => 'snippets'),
    			),
    			'Protect Our Coral Sea' => array(
                    'Signatures' => array('controller' => 'signatures'),
    				'Upload Signatures' => array('controller' => 'signatures', 'action' => 'upload'),
    				'Reports' => array('plugin' => 'reports', 'controller' => 'report_sqls'),
    				'eCard Items' => array('controller' => 'ecard_items'),
    				'Referrals' => array('controller' => 'referrals'),
    				'Widget Hits' => array('controller' => 'widget_hits')
    			),
    			'Admin' => array(
	                'Settings' => array('plugin' => 'settings', 'controller' => 'configs'),
	                'Translations' => array('plugin' => 'settings', 'controller' => 'translations'),
	                'Routes' => array('plugin' => 'settings', 'controller' => 'routes'),
	                'Admin Users' => array('controller' => 'admins'),
	                'Logout' => array('controller' => 'admins', 'action' => 'logout'),
    			)
    		);

    		foreach ($nav as $section => $menu)
    		{
				?>
				<h4><?php echo $section; ?></h4>
				<ul class="navigation">
					<?php
						foreach ($menu as $label => $url)
						{
							if ( is_array($url) ) {
								$default = array(
									'plugin' => null,
									'action' => 'index'
								);
								$url = array_merge($default, $url);
							}

							$classes = array(Inflector::slug(low($label), '-'));

							if ( is_string($url) && $this->here == Router::url($url) ) {
								$classes[] = 'current';
							}
							else if ( is_array($url) )
							{
								if ( !empty($this->params['prefix']) ) {
									$this->params['action'] = str_replace($this->params['prefix'] . '_', '', $this->params['action']);
								}
								$indexActions = array('index', 'add', 'edit');
								$isIndexAction = in_array($this->params['action'], $indexActions) && in_array($url['action'], $indexActions);
								if ( $this->params['controller'] == $url['controller'] && ($isIndexAction || $url['action'] == $this->params['action']) ) {
									$classes[] = 'current';
								}
							}
							?>
							<li class="<?php echo implode(' ', $classes); ?>"><?php echo $html->link($label, $url); ?></li>
							<?php
						}
					?>
				</ul>
				<?php
    		}
    	?>

    </div>

    <div id="content">
    	<?php $session->flash(); ?>
        <?php echo $content_for_layout ?>
        <span class="cleaner"></span>
    </div>
    <div id="push"></div>
</div>

<p id="footer">
    <?php echo $html->link($html->image('topia.png'), 'http://www.thetopiaproject.com', array('target' => '_blank'), false, false) ?>
</p>

</body>
</html>