<div class="ecardItems form">
<?php echo $form->create('EcardItem');?>
	<fieldset>
 		<legend><?php __('Add EcardItem');?></legend>
	<?php
		echo $form->input('scope');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List EcardItems', true), array('action' => 'index'));?></li>
	</ul>
</div>
