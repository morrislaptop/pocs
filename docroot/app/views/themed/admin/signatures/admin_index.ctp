<div class="signatures index">
<h2><?php __('Signatures');?></h2>
<p>
	<?php echo $advindex->export('Export as CSV'); ?> |
	<?php echo $html->link('Import from CSV', '#', array('onclick' => "\$('#SignatureImportForm').toggle();")); ?> |
	<?php
		$ids = Set::extract('/Signature/id', $signatures);
		$ids = implode(',', $ids);
		echo $html->link('Print These Petitions', array('action' => 'print', $ids), array('target' => '_blank'));
	?>
</p>
<?php echo $this->element('import_form', array('plugin' => 'advindex', 'model' => 'Signature')); ?>
<?php echo $advindex->create('Signature'); ?>
<table cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<th class="headerLeft"><?php echo $paginator->sort('id'); ?></th>
		<th><?php echo $paginator->sort('not_in_australia'); ?></th>
		<th><?php echo $paginator->sort('postcode'); ?></th>
		<th><?php echo $paginator->sort('MP'); ?></th>
		<th><?php echo $paginator->sort('first_name'); ?></th>
		<th><?php echo $paginator->sort('last_name'); ?></th>
		<th><?php echo $paginator->sort('email'); ?></th>
		<th><?php echo $paginator->sort('optin'); ?></th>
		<th><?php echo $paginator->sort('source'); ?></th>
		<th><?php echo $paginator->sort('flash_url'); ?></th>
		<th><?php echo $paginator->sort('created'); ?></th>
		<th class="headerRight actions"><?php __('Actions'); ?></th>
	</tr>
	<tr class="filter">
		<td><?php echo $advindex->filter('id'); ?></td>
		<td><?php echo $advindex->filter('not_in_australia'); ?></td>
		<td><?php echo $advindex->filter('postcode'); ?></td>
		<td><?php echo $advindex->filter('MP'); ?></td>
		<td><?php echo $advindex->filter('first_name'); ?></td>
		<td><?php echo $advindex->filter('last_name'); ?></td>
		<td><?php echo $advindex->filter('email'); ?></td>
		<td><?php echo $advindex->filter('optin'); ?></td>
		<td><?php echo $advindex->filter('source'); ?></td>
		<td><?php echo $advindex->filter('flash_url'); ?></td>
		<td><?php echo $advindex->filter('created'); ?></td>
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
			<?php echo $signature['Signature']['not_in_australia']; ?>
		</td>
		<td>
			<?php echo $signature['Signature']['postcode']; ?>
		</td>
		<td>
			<?php echo $signature['Mp']['name']; ?>
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
			<?php echo $signature['Signature']['source']; ?>
		</td>
		<td>
			<?php echo $signature['Signature']['flash_url']; ?>
		</td>
		<td>
			<?php echo $signature['Signature']['created']; ?>
		</td>
		<td class="actions">
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