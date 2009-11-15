<div class="admins form">
<?php echo $form->create('Admin');?>
	<fieldset>
 		<legend><?php __('Edit Admin');?></legend>
	    <?php echo $this->element('admins' . DS . 'form'); ?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Admin.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Admin.id'))); ?></li>
		<li><?php echo $html->link(__('List Admins', true), array('action'=>'index'));?></li>
	</ul>
</div>
