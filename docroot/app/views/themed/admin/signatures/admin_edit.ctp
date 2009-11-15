<div class="signatures form">
<?php echo $form->create('Signature');?>
	<fieldset>
 		<legend><?php __('Edit Signature');?></legend>
 		<?php echo $this->element('signatures' . DS . 'form'); ?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Signature.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Signature.id'))); ?></li>
		<li><?php echo $html->link(__('List Signatures', true), array('action' => 'index'));?></li>
	</ul>
</div>
