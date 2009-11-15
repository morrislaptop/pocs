<div class="enquiries form">
<?php echo $form->create('Enquiry');?>
	<fieldset>
 		<legend><?php __('Add Enquiry');?></legend>
	<?php
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
		<li><?php echo $html->link(__('List Enquiries', true), array('action' => 'index'));?></li>
	</ul>
</div>
