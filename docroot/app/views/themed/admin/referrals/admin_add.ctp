<div class="referrals form">
<?php echo $form->create('Referral');?>
	<fieldset>
 		<legend><?php __('Add Referral');?></legend>
		<?php echo $this->element('referrals' . DS . 'form'); ?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Referrals', true), array('action' => 'index'));?></li>
	</ul>
</div>
