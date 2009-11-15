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

    $html->css('/vendors/shadowbox/shadowbox', 'stylesheet', null, false);
    $javascript->link('/vendors/shadowbox/shadowbox', false);
    $javascript->codeBlock('
    	Shadowbox.init();
    ', array('inline' => false));
	$pictureCount = $this->number('Gallery Items');
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
	<div class="right gallery">
		<div class="hook top"></div>
		<div class="hook middle">
			<?php
				for ( $i = 1; $i <= $pictureCount; $i++ )
				{
					$media = $this->media('Item ' . $i . ' Image', 'Gallery');
					$media = str_replace('media/', '', $media);
					$caption = $this->text('Item ' . $i . ' Caption', 'Gallery');

					if ( !$media ) {
						continue;
					}
					?>
					<div class="boxgrid caption">
						<?php
							echo $html->link($html->image('/media/filter/gallery/' . $media), '/media/filter/l/' . $media, array('rel' => 'shadowbox[gallery]'), false, false);
							if ( $caption )
							{
								?>
								<div class="cover boxcaption">
									<h3><?php echo $caption; ?></h3>
								</div>
								<?php
							}
						?>
					</div>
					<?php
				}
			?>
			<div class="clear"></div>
		</div>
		<div class="hook bottom"></div>
	</div>
	<div class="clear"></div>
</div>