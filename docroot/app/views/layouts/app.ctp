<?php
/* SVN FILE: $Id: default.ctp 7945 2008-12-19 02:16:01Z gwoo $ */
/**
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
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<meta name="verify-v1" content="y8CCtSkjV+NebNsqdXzQor1MQgKX6K29XpOeHVnZpsw=" />
	<title>
		<?php
			$title = $title_for_layout;
			if ( isset($node) ) {
				$title = $node['Node']['title'];
			}
			$title .= ' - ' . Configure::read('App.siteName');
			echo $title;
		?>
	</title>
	<?php
		echo $html->meta('icon');

		echo $html->css('style');
		echo $html->css('content');
		if ( Configure::read() ) echo $html->css('/vendors/debug');

        echo $javascript->link('http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js');
        echo $javascript->link('/vendors/jquery.form.js');

        echo $javascript->link('/vendors/cufon-yui');
        echo $javascript->link('Helvetica_Rounded_LT_Std_700.font');

        echo $javascript->codeblock('
        	$(document).ready(function(){
	            $("#SubscriberAddForm").ajaxForm({
	            	beforeSubmit: function() {
		                $("#theSend").hide();
		                $("#theLoader").show();
		            },
		            success: function() {
		            	$("#theForm").hide();
		                $("#theSuccess").show();
		            }
	            });
		    });
		    Cufon.replace("h1").replace("h2");
		');

		echo $scripts_for_layout;

		$bodyClass = null;
		if ( isset($body) ) {
			if ( is_array($body) ) {
				$bodyClass = implode(' ' , $body);
			}
			else {
				$bodyClass = $body;
			}
		}
	?>
	<!--[if lte IE 6]>
		<?php
			if ( 1 ) {
				echo $javascript->link('/vendors/pngFix/jquery.pngFix');
				echo $javascript->codeBlock('$(function() { $(".png").pngFix({ blankgif: "' . $html->url('/vendors/pngFix/blank.gif') . '"}); });');
				echo $html->css('ie6');
				echo $javascript->codeBlock('var IE6UPDATE_OPTIONS = { icons_path: "http://static.ie6update.com/hosted/ie6update/images/" }');
				echo $javascript->link('http://static.ie6update.com/hosted/ie6update/ie6update.js');
			}
		?>
	<![endif]-->
</head>
<body class="<?php echo $bodyClass; ?>">
<div id="bg"><?php echo $html->image($bg); ?></div>
<div id="container">
	<div id="nav">
		<div class="png"><?php echo $html->link($html->image('logo.png', array('id' => 'logo')), '/', null, false, false); ?></div>
		<?php echo $menu->generate($nodes[0]['children'], array('element' => 'menu_li', 'plugin' => 'baked_simple', 'maxDepth' => 1)); ?>
	</div>
	<?php echo $content_for_layout; ?>
	<div id="footer">
	    <div class="hook">
		    <div class="sendMeUpdates">
	        	<div id="theForm">
	        		<?php echo $form->create('Subscriber', array('class' => 'png', 'url' => array('plugin' => null))); ?>
            			<?php echo $html->image('sendh1.png', array('style' => 'margin-left: -8px')); ?>
            			<?php echo $advform->inputWithDefault('email', 'your email', array('label' => false, 'div' => null)); ?>
				        <?php echo $form->submit('send.png', array('style' => 'width:66px; height:34px; float:left', 'id' => 'theSend')); ?>
				        <?php echo $html->image('ajax-loader.gif', array('id' => 'theLoader', 'style' => 'display: none; margin-top: 10px;')); ?>
				    <?php echo $form->end(); ?>
				</div>
				<div id="theSuccess" style="display: none;">
			    	<p><?php __('Thanks, you are now subscribed for updates'); ?></p>
				</div>
		    </div>
		    <div class="nav">
		        <?php echo $menu->generate($nodes[1]['children'], array('element' => 'menu_li', 'plugin' => 'baked_simple', 'maxDepth' => 1)); ?>
		    </div>
		    <div class="sponsors">
	        	<?php echo $snippets['Sponsors']; ?>
		    </div>
		</div>
	</div>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-10782399-1");
pageTracker._trackPageview();
} catch(err) {}</script>
<!-- Woopra Code Start -->
<script type="text/javascript" src="http://static.woopra.com/js/woopra.js"></script>
<!-- Woopra Code End -->
<script src="http://static.getclicky.com/js" type="text/javascript"></script>
<script type="text/javascript">clicky.init(145989);</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="http://static.getclicky.com/145989ns.gif" /></p></noscript>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
</body>
</html>