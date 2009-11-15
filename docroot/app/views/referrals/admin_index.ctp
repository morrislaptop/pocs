<div class="referrals index">
<h2><?php __('Referrals');?></h2>
<p><?php echo $advindex->export('Export as CSV'); ?> | <?php echo $html->link('Import from CSV', '#', array('onclick' => "$('#ReferralImportForm').toggle();")); ?></p>
<?php echo $this->element('import_form', array('plugin' => 'advindex', 'model' => 'Referral')); ?>
<?php echo $advindex->create('Referral'); ?>
<table cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<th class="headerLeft"><?php echo $paginator->sort('id'); ?></th>
		<th><?php echo $paginator->sort('your_name'); ?></th>
		<th><?php echo $paginator->sort('your_email'); ?></th>
		<th><?php echo $paginator->sort('friends_name'); ?></th>
		<th><?php echo $paginator->sort('friends_email'); ?></th>
		<th><?php echo $paginator->sort('source'); ?></th>
		<th><?php echo $paginator->sort('flash_url'); ?></th>
		<th><?php echo $paginator->sort('created'); ?></th>
		<th class="headerRight actions"><?php __('Actions'); ?></th>
	</tr>
	<tr class="filter">
		<td><?php echo $advindex->filter('id'); ?></td>
		<td><?php echo $advindex->filter('your_name'); ?></td>
		<td><?php echo $advindex->filter('your_email'); ?></td>
		<td><?php echo $advindex->filter('friends_name'); ?></td>
		<td><?php echo $advindex->filter('friends_email'); ?></td>
		<td><?php echo $advindex->filter('source'); ?></td>
		<td><?php echo $advindex->filter('flash_url'); ?></td>
		<td><?php echo $advindex->filter('created'); ?></td>
		<td><?php echo $advindex->search(); ?></td>
	</tr>
</thead>
<tbody>
<?php
$i = 0;
foreach ($referrals as $referral):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	$id = $referral['Referral']['id'];
?>
	<tr<?php echo $class;?> id="<?php echo $id; ?>">
		<td>
			<?php echo $referral['Referral']['id']; ?>
		</td>
		<td>
			<?php echo $referral['Referral']['your_name']; ?>
		</td>
		<td>
			<?php echo $referral['Referral']['your_email']; ?>
		</td>
		<td>
			<?php echo $referral['Referral']['friends_name']; ?>
		</td>
		<td>
			<?php echo $referral['Referral']['friends_email']; ?>
		</td>
		<td>
			<?php echo $referral['Referral']['source']; ?>
		</td>
		<td>
			<?php echo $referral['Referral']['flash_url']; ?>
		</td>
		<td>
			<?php echo $referral['Referral']['created']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $referral['Referral']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $referral['Referral']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $referral['Referral']['id'])); ?>
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
		<li><?php echo $html->link(__('New Referral', true), array('action'=>'add')); ?></li>
	</ul>
</div>