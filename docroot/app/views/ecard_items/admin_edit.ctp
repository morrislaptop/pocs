<div class="ecardItems form">
<?php echo $form->create('EcardItem');?>
	<fieldset>
 		<legend><?php __('Edit EcardItem');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('scope');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('EcardItem.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('EcardItem.id'))); ?></li>
		<li><?php echo $html->link(__('List EcardItems', true), array('action' => 'index'));?></li>
	</ul>
</div>
