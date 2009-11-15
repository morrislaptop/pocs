<?php
	// find the sub menu for this section.
	$children = null;
	if ( isset($breadcrumb[1]) ) {
		$id = $breadcrumb[1]['Node']['id'];
		$children = $this->findChildren($id);
	}

	if ( $children )
	{
		?>
		<div class="png">
			<div class="left">
				<div class="hook">
					<div class="sidenav">
						<?php echo $menu->generate($children, array('element' => 'menu_li', 'plugin' => 'baked_simple', 'maxDepth' => 2)); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	else {
		$this->viewVars['body'] .= ' full';
	}
?>
