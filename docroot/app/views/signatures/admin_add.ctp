<div class="signatures form">
<?php echo $form->create('Signature');?>
	<fieldset>
 		<legend><?php __('Add Signature');?></legend>
	<?php
		echo $form->input('in_australia');
		echo $form->input('postcode');
		echo $form->input('first_name');
		echo $form->input('last_name');
		echo $form->input('email');
		echo $form->input('optin');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Signatures', true), array('action' => 'index'));?></li>
	</ul>
</div>
