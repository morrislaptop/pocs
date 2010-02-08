<div class="widgetHits view">
<h2><?php  __('WidgetHit');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $widgetHit['WidgetHit']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $widgetHit['WidgetHit']['url']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $widgetHit['WidgetHit']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit WidgetHit', true), array('action' => 'edit', $widgetHit['WidgetHit']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete WidgetHit', true), array('action' => 'delete', $widgetHit['WidgetHit']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $widgetHit['WidgetHit']['id'])); ?> </li>
		<li><?php echo $html->link(__('List WidgetHits', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New WidgetHit', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
