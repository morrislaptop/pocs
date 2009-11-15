<div class="signatures index">
<h2><?php __('Signatures');?></h2>
<?php echo $advindex->create('Signature'); ?>
<table cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<th class="headerLeft"><?php echo $paginator->sort('id'); ?></th>
		<th><?php echo $paginator->sort('in_australia'); ?></th>
		<th><?php echo $paginator->sort('postcode'); ?></th>
		<th><?php echo $paginator->sort('first_name'); ?></th>
		<th><?php echo $paginator->sort('last_name'); ?></th>
		<th><?php echo $paginator->sort('email'); ?></th>
		<th><?php echo $paginator->sort('optin'); ?></th>
		<th><?php echo $paginator->sort('created'); ?></th>
		<th><?php echo $paginator->sort('modified'); ?></th>
		<th class="headerRight actions"><?php __('Actions'); ?></th>
	</tr>
	<tr class="filter">
		<td><?php echo $advindex->filter('id'); ?></td>
		<td><?php echo $advindex->filter('in_australia'); ?></td>
		<td><?php echo $advindex->filter('postcode'); ?></td>
		<td><?php echo $advindex->filter('first_name'); ?></td>
		<td><?php echo $advindex->filter('last_name'); ?></td>
		<td><?php echo $advindex->filter('email'); ?></td>
		<td><?php echo $advindex->filter('optin'); ?></td>
		<td><?php echo $advindex->filter('created'); ?></td>
		<td><?php echo $advindex->filter('modified'); ?></td>
		<td><?php echo $advindex->search(); ?></td>
	</tr>
</thead>
<tbody>
<?php
$i = 0;
foreach ($signatures as $signature):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	$id = $signature['Signature']['id'];
?>
	<tr<?php echo $class;?> id="<?php echo $id; ?>">
		<td>
			<?php echo $signature['Signature']['id']; ?>
		</td>
		<td>
			<?php echo $signature['Signature']['in_australia']; ?>
		</td>
		<td>
			<?php echo $signature['Signature']['postcode']; ?>
		</td>
		<td>
			<?php echo $signature['Signature']['first_name']; ?>
		</td>
		<td>
			<?php echo $signature['Signature']['last_name']; ?>
		</td>
		<td>
			<?php echo $signature['Signature']['email']; ?>
		</td>
		<td>
			<?php echo $signature['Signature']['optin']; ?>
		</td>
		<td>
			<?php echo $signature['Signature']['created']; ?>
		</td>
		<td>
			<?php echo $signature['Signature']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $signature['Signature']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $signature['Signature']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $signature['Signature']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $signature['Signature']['id'])); ?>
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
		<li><?php echo $html->link(__('New Signature', true), array('action'=>'add')); ?></li>
	</ul>
</div>