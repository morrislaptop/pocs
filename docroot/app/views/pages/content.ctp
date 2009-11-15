<?php
	$this->viewVars['body'] = 'content';
?>
<div id="content">
	<?php echo $this->element('left'); ?>
	<div class="right">
		<div class="hook top"></div>
		<div class="hook middle">
			<div class="sidebar">
	        	<?php echo $this->wysiwyg('Sidebar', 'Content', array('body_class' => 'sidebar')); ?>
			</div>
			<div class="copy">
				<?php echo $this->wysiwyg('Content', 'Content', array('body_class' => 'content')); ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="hook bottom"></div>
	</div>
	<div class="clear"></div>
</div>