<?php echo $html->doctype('xhtml-strict') ?>
<html lang="en">
<head>
    <?php echo $html->charset(); ?>
    <title><?php echo $title_for_layout; ?></title>
    <?php echo $javascript->link('jquery'); ?>
    <?php echo $html->css('login'); ?>
    <?php echo $scripts_for_layout; ?>
</head>
<body>
<div id="container">
    <div id="header">
    	<?php echo $html->link(Configure::read('App.siteName'), '/', array('title' => 'View site home page')) ?>
    </div>

    <div id="content">
        <?php echo $content_for_layout; ?>
        <div id="push"></div>
    </div>
</div>
<p id="footer">
	<?php echo $html->link($html->image('topia.png'), 'http://www.thetopiaproject.com', array('target' => '_blank'), false, false) ?>
</div>
</body>
</html>