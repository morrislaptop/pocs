<div class="admins form">
<?php echo $form->create('Admin');?>
	<fieldset>
 		<legend><?php __('Add Admin');?></legend>
	    <?php echo $this->element('admins' . DS . 'form'); ?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Admins', true), array('action'=>'index'));?></li>
	</ul>
</div>
