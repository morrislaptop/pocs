<div class="widgetHits form">
<?php echo $form->create('WidgetHit');?>
	<fieldset>
 		<legend><?php __('Add WidgetHit');?></legend>
	<?php
		echo $form->input('url');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List WidgetHits', true), array('action' => 'index'));?></li>
	</ul>
</div>
