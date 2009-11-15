<?php
	echo $html->css('forms', false, false, false);
?>
<?php
	if ($session->check('Auth.user'))
	{
		?>
		<p>You are already logged in. There's no need to do it again. <?php echo $html->link('Go to admin area', '/' . Configure::read('Routing.admin')); ?>.</p>
		<?php
	}

	$session->flash('auth');
?>
<?php echo $form->create('Admin', array('action' => 'login')); ?>
	<?php
		echo $form->input('username', array('style' => 'width: 150px;'));
		echo $form->input('password', array('style' => 'width: 150px;'));
	?>
	<div class="submit" style="text-align: left;">
		<?php echo $form->submit('Log in', array('div' => false)); ?>
		<?php echo $form->input('remember', array('type' => 'checkbox', 'label' => 'Remember me?')); ?>
	</div>
<?php echo $form->end(); ?>
<p id="gohome"><?php echo $html->link("Back to " . Configure::read('App.siteName'), '/'); ?></p>