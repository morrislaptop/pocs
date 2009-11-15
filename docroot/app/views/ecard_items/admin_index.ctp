<div class="ecardItems index">
<h2><?php __('EcardItems');?></h2>
<p><?php echo $advindex->export('Export as CSV'); ?> | <?php echo $html->link('Import from CSV', '#', array('onclick' => "$('#EcardItemImportForm').toggle();")); ?></p>
<?php echo $this->element('import_form', array('plugin' => 'advindex', 'model' => 'EcardItem')); ?>
<?php echo $advindex->create('EcardItem'); ?>
<table cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<th class="headerLeft"><?php echo $paginator->sort('id'); ?></th>
		<th><?php echo $paginator->sort('scope'); ?></th>
		<th><?php echo $paginator->sort('name'); ?></th>
		<th><?php echo $paginator->sort('created'); ?></th>
		<th><?php echo $paginator->sort('modified'); ?></th>
		<th class="headerRight actions"><?php __('Actions'); ?></th>
	</tr>
	<tr class="filter">
		<td><?php echo $advindex->filter('id'); ?></td>
		<td><?php echo $advindex->filter('scope'); ?></td>
		<td><?php echo $advindex->filter('name'); ?></td>
		<td><?php echo $advindex->filter('created'); ?></td>
		<td><?php echo $advindex->filter('modified'); ?></td>
		<td><?php echo $advindex->search(); ?></td>
	</tr>
</thead>
<tbody>
<?php
$i = 0;
foreach ($ecardItems as $ecardItem):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	$id = $ecardItem['EcardItem']['id'];
?>
	<tr<?php echo $class;?> id="<?php echo $id; ?>">
		<td>
			<?php echo $ecardItem['EcardItem']['id']; ?>
		</td>
		<td>
			<?php echo $ecardItem['EcardItem']['scope']; ?>
		</td>
		<td>
			<?php echo $ecardItem['EcardItem']['name']; ?>
		</td>
		<td>
			<?php echo $ecardItem['EcardItem']['created']; ?>
		</td>
		<td>
			<?php echo $ecardItem['EcardItem']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $ecardItem['EcardItem']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $ecardItem['EcardItem']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $ecardItem['EcardItem']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ecardItem['EcardItem']['id'])); ?>
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
		<li><?php echo $html->link(__('New EcardItem', true), array('action'=>'add')); ?></li>
	</ul>
</div>