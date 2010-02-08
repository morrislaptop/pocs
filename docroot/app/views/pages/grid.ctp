<?php
	echo $javascript->codeblock('
		$(document).ready(function(){
			//Caption Sliding (Partially Hidden to Visible)
			$(\'.boxgrid.caption\').hover(function(){
				$(".cover", this).stop().animate({top:\'89px\'},{queue:false,duration:160});
			}, function() {
				$(".cover", this).stop().animate({top:\'120px\'},{queue:false,duration:160});
			});
		});
	', true);

	$this->viewVars['body'] = 'grid';
	$gridCount = $this->number('Grid Count');
?>
<div id="content">
	<?php
		for ( $i = 1; $i <= $gridCount; $i++ )
		{
			$image = $html->image($this->image('Grid ' . $i . ' Image', 'Grid'));
			$caption = $this->wysiwyg('Grid ' . $i . ' Content', 'Grid');

			if ( !$image ) {
				continue;
			}
			?>
			<div class="boxgrid caption">
				<?php echo $image; ?>
				<div class="cover boxcaption">
					<?php echo $caption; ?>
				</div>
			</div>
			<?php
		}
	?>
</div>
<br />
<div id="subcontent">
	<div class="hook png">
		<?php echo $snippets['How Can I Help']; ?>
	</div>
</div>