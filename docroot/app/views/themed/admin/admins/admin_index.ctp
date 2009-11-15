<?php
	echo $html->css('tables', false, null, false);
?>
<div class="admins index">
<h1><?php __('Admins');?></h1>
<?php echo $advindex->create('Admin'); ?>
<table cellpadding="0" cellspacing="0">
	<?php echo $this->element('thead', array('plugin' => 'advindex')); ?>
	<tbody>
		<?php
			$i = 0;
			foreach ($admins as $admin)
			{
				$class = null;
				$id = $admin['Admin']['id'];
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				?>
				<tr<?php echo $class;?>>
					<td>
						<?php echo $admin['Admin']['id']; ?>
					</td>
					<td>
						<?php echo $admin['Admin']['username']; ?>
					</td>
					<td>
						<?php echo $admin['Admin']['password']; ?>
					</td>
					<td>
						<?php echo $admin['Admin']['created']; ?>
					</td>
					<td>
						<?php echo $admin['Admin']['modified']; ?>
					</td>
					<td class="actions">
						<?php echo $html->link(__('Edit', true), array('action'=>'edit', $id)); ?>
						<?php echo $html->link(__('Delete', true), array('action'=>'delete', $id), null, sprintf(__('Are you sure you want to delete # %s?', true), $id)); ?>
					</td>
				</tr>
				<?php
			}
		?>
	</tbody>
	<?php echo $this->element('tfoot', array('plugin' => 'advindex')); ?>
</table>
<?php echo $advindex->end(); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Admin', true), array('action'=>'add')); ?></li>
	</ul>
</div>
