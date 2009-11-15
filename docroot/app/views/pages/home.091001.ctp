<?php
    $html->css('/vendors/shadowbox/shadowbox', 'stylesheet', null, false);
    $javascript->link('/vendors/shadowbox/shadowbox', false);
    $javascript->link('http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAKejkaOwSOawamW2yyyp-3hQs52qMKUyH51MEfX6bOsXcleDVDRQ5PtxRn_Uhf28NXC4tA8tcZ47GTA', false);

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

			$("#seemap").click(function (){
			    Shadowbox.open({
			        player:     "html",
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

			flowplayer("vidReplaceMe", "' . $html->url('/vendors/flowplayer/flowplayer-3.1.3.swf') . '");
		});

		Shadowbox.init({ players: ["html"] });

	', array('inline' => false));

	$this->viewVars['body'] = 'home';
?>
<div id="content">
	<div class="hook top"></div>
	<div class="hook middle">
		<div class="left">
	        <div id="watchBarry"><?php echo $html->link($html->image($this->image('Watch Barry')), '#barryVid', null, false, false); ?></div>
			<div id="barryVid" style="display: none;">
				<a id="vidReplaceMe" href="<?php echo $video; ?>" style="display: block; width: 301px; height: 221px;"></a>
			</div>
		</div>
		<div class="right">
	        <h1><?php echo $this->text('Title'); ?></h1>
	        <?php echo $this->wysiwyg('Content'); ?>
	    </div>
	</div>
	<div class="hook bottom"></div>
</div>