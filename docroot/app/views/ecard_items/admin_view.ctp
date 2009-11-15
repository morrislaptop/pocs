<div class="ecardItems view">
<h2><?php  __('EcardItem');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ecardItem['EcardItem']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Scope'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ecardItem['EcardItem']['scope']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ecardItem['EcardItem']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ecardItem['EcardItem']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ecardItem['EcardItem']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit EcardItem', true), array('action' => 'edit', $ecardItem['EcardItem']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete EcardItem', true), array('action' => 'delete', $ecardItem['EcardItem']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ecardItem['EcardItem']['id'])); ?> </li>
		<li><?php echo $html->link(__('List EcardItems', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New EcardItem', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
