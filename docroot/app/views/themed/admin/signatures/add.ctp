<div class="signatures form">
<?php echo $form->create('Signature');?>
	<fieldset>
 		<legend><?php __('Add Signature');?></legend>
		<?php echo $this->element('signatures' . DS . 'form'); ?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Signatures', true), array('action' => 'index'));?></li>
	</ul>
</div>
