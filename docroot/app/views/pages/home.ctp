<?php
    $html->css('/vendors/shadowbox/shadowbox', 'stylesheet', null, false);
    $javascript->link('/vendors/shadowbox/shadowbox', false);
    #$javascript->link('http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAKejkaOwSOawamW2yyyp-3hQs52qMKUyH51MEfX6bOsXcleDVDRQ5PtxRn_Uhf28NXC4tA8tcZ47GTA', false);

    // Include Player
    $video = $this->media('Video');
	$javascript->link('/vendors/flowplayer/example/flowplayer-3.1.4.min', false);


	$javascript->codeBlock('
		$(function() {
			$("#watchBarry a").click(function() {
				$("#watchBarry").hide();
				$("#barryVid").show();
				return false;
			});

			$("#seemapDISABLED").click(function (){
			    Shadowbox.open({
			        player:     "image",
			        content:    "",
			        height:     300,
			        width:      500,
			        options:    {
			            onFinish: function(item){
			                if(GBrowserIsCompatible()){
			                    var body = document.getElementById(Shadowbox.contentId());
			                    var map = new GMap2(body);
			                    map.setCenter(new GLatLng(' . $this->number('Latitude') . ', ' . $this->number('Longitude') . '), ' . $this->number('Zoom') . ');
			                    map.setMapType(G_SATELLITE_MAP);

			                    // add some simple controls
			                    map.addControl(new GSmallMapControl());
			                    map.addControl(new GMapTypeControl());
			                }
			            }
			        }
			    });
			    return false;
			});

			//flowplayer("vidReplaceMe", "' . $html->url('/vendors/flowplayer/flowplayer-3.1.3.swf') . '");
		});

		Shadowbox.init({ players: ["html","img"] });

	', array('inline' => false));

	$this->viewVars['body'] = 'home';
?>
<div id="content">
	<div class="hook top"></div>
	<div class="hook middle">
		<div class="left">
	        <div id="watchBarry"><?php echo $html->link($html->image($this->image('Watch Barry')), '#barryVid', null, false, false); ?></div>
			<div id="barryVid" style="display: none;">
				<?php
					$clip_id = $this->text('Vimeo Clip Id');
				?>
				<object width="353" height="200"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $clip_id; ?>&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1" /><embed src="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $clip_id; ?>&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="353" height="200"></embed></object>
			</div>
		</div>
		<div class="right">
	        <h1><?php echo $this->text('Title'); ?></h1>
	        <?php echo $this->wysiwyg('Content'); ?>
	    </div>
	</div>
	<div class="hook bottom"></div>
</div>