<div class="widgetHits index">
<h2><?php __('WidgetHits');?></h2>
<p><?php echo $advindex->export('Export as CSV'); ?> | <?php echo $html->link('Import from CSV', '#', array('onclick' => "$('#WidgetHitImportForm').toggle();")); ?></p>
<?php echo $this->element('import_form', array('plugin' => 'advindex', 'model' => 'WidgetHit')); ?>
<?php echo $advindex->create('WidgetHit'); ?>
<table cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<th class="headerLeft"><?php echo $paginator->sort('id'); ?></th>
		<th><?php echo $paginator->sort('url'); ?></th>
		<th><?php echo $paginator->sort('created'); ?></th>
		<th class="headerRight actions"><?php __('Actions'); ?></th>
	</tr>
	<tr class="filter">
		<td><?php echo $advindex->filter('id'); ?></td>
		<td><?php echo $advindex->filter('url'); ?></td>
		<td><?php echo $advindex->filter('created'); ?></td>
		<td><?php echo $advindex->search(); ?></td>
	</tr>
</thead>
<tbody>
<?php
$i = 0;
foreach ($widgetHits as $widgetHit):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	$id = $widgetHit['WidgetHit']['id'];
?>
	<tr<?php echo $class;?> id="<?php echo $id; ?>">
		<td>
			<?php echo $widgetHit['WidgetHit']['id']; ?>
		</td>
		<td>
			<?php echo $widgetHit['WidgetHit']['url']; ?>
		</td>
		<td>
			<?php echo $widgetHit['WidgetHit']['created']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $widgetHit['WidgetHit']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $widgetHit['WidgetHit']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $widgetHit['WidgetHit']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $widgetHit['WidgetHit']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
	<?php echo $this->element('tfoot', array('plugin' => 'advindex')); ?>
</tfoot>
</table>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New WidgetHit', true), array('action'=>'add')); ?></li>
	</ul>
</div>