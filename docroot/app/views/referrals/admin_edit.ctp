<div class="referrals form">
<?php echo $form->create('Referral');?>
	<fieldset>
 		<legend><?php __('Edit Referral');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('your_name');
		echo $form->input('your_email');
		echo $form->input('friends_email');
		echo $form->input('message');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Referral.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Referral.id'))); ?></li>
		<li><?php echo $html->link(__('List Referrals', true), array('action' => 'index'));?></li>
	</ul>
</div>
