<div class="widgetHits form">
<?php echo $form->create('WidgetHit');?>
	<fieldset>
 		<legend><?php __('Edit WidgetHit');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('url');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('WidgetHit.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('WidgetHit.id'))); ?></li>
		<li><?php echo $html->link(__('List WidgetHits', true), array('action' => 'index'));?></li>
	</ul>
</div>
