<div class="enquiries form">
<?php echo $form->create('Enquiry');?>
	<fieldset>
 		<legend><?php __('Edit Enquiry');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('enquiry');
		echo $form->input('optin');
		echo $form->input('brochure');
		echo $form->input('email');
		echo $form->input('phone');
		echo $form->input('contact_via');
		echo $form->input('category');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Enquiry.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Enquiry.id'))); ?></li>
		<li><?php echo $html->link(__('List Enquiries', true), array('action' => 'index'));?></li>
	</ul>
</div>
