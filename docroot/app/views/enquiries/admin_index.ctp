<div class="enquiries index">
<h2><?php __('Enquiries');?></h2>
<?php echo $advindex->create('Enquiry'); ?>
<table cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<th class="headerLeft"><?php echo $paginator->sort('id'); ?></th>
		<th><?php echo $paginator->sort('name'); ?></th>
		<th><?php echo $paginator->sort('enquiry'); ?></th>
		<th><?php echo $paginator->sort('optin'); ?></th>
		<th><?php echo $paginator->sort('brochure'); ?></th>
		<th><?php echo $paginator->sort('email'); ?></th>
		<th><?php echo $paginator->sort('phone'); ?></th>
		<th><?php echo $paginator->sort('contact_via'); ?></th>
		<th><?php echo $paginator->sort('category'); ?></th>
		<th><?php echo $paginator->sort('created'); ?></th>
		<th><?php echo $paginator->sort('modified'); ?></th>
		<th class="headerRight actions"><?php __('Actions'); ?></th>
	</tr>
	<tr class="filter">
		<td><?php echo $advindex->filter('id'); ?></td>
		<td><?php echo $advindex->filter('name'); ?></td>
		<td><?php echo $advindex->filter('enquiry'); ?></td>
		<td><?php echo $advindex->filter('optin'); ?></td>
		<td><?php echo $advindex->filter('brochure'); ?></td>
		<td><?php echo $advindex->filter('email'); ?></td>
		<td><?php echo $advindex->filter('phone'); ?></td>
		<td><?php echo $advindex->filter('contact_via'); ?></td>
		<td><?php echo $advindex->filter('category'); ?></td>
		<td><?php echo $advindex->filter('created'); ?></td>
		<td><?php echo $advindex->filter('modified'); ?></td>
		<td><?php echo $advindex->search(); ?></td>
	</tr>
</thead>
<tbody>
<?php
$i = 0;
foreach ($enquiries as $enquiry):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	$id = $enquiry['Enquiry']['id'];
?>
	<tr<?php echo $class;?> id="<?php echo $id; ?>">
		<td>
			<?php echo $enquiry['Enquiry']['id']; ?>
		</td>
		<td>
			<?php echo $enquiry['Enquiry']['name']; ?>
		</td>
		<td>
			<?php echo $enquiry['Enquiry']['enquiry']; ?>
		</td>
		<td>
			<?php echo $enquiry['Enquiry']['optin']; ?>
		</td>
		<td>
			<?php echo $enquiry['Enquiry']['brochure']; ?>
		</td>
		<td>
			<?php echo $enquiry['Enquiry']['email']; ?>
		</td>
		<td>
			<?php echo $enquiry['Enquiry']['phone']; ?>
		</td>
		<td>
			<?php echo $enquiry['Enquiry']['contact_via']; ?>
		</td>
		<td>
			<?php echo $enquiry['Enquiry']['category']; ?>
		</td>
		<td>
			<?php echo $enquiry['Enquiry']['created']; ?>
		</td>
		<td>
			<?php echo $enquiry['Enquiry']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $enquiry['Enquiry']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $enquiry['Enquiry']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $enquiry['Enquiry']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $enquiry['Enquiry']['id'])); ?>
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
		<li><?php echo $html->link(__('New Enquiry', true), array('action'=>'add')); ?></li>
	</ul>
</div>