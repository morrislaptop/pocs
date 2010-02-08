<?php
	$this->viewVars['body'] = 'referral';
	$javascript->link('/vendors/flowplayer/example/flowplayer-3.1.4.min', false);
?>
<div id="content">
	<div class="hook top"></div>
	<div class="hook middle">
		<div class="left">
	        <h1>Hi <?php echo $referral['Referral']['friends_email']; ?></h1>
	        <?php echo nl2br($referral['Referral']['message']); ?>
		</div>
		<div class="right">
	        <div id="theMedia">
	        	<?php
	        		if ( 'Images' == $referral['EcardItem']['scope'] ) {
						echo $html->image('/media/filter/m/' . $referral['EcardItem']['Image']['dirname'] . '/' . $referral['EcardItem']['Image']['basename']);
	        		}
	        		else {
						$javascript->link('http://ajax.googleapis.com/ajax/libs/swfobject/2/swfobject.js', false);
						$url = $html->url('/media/' . $referral['EcardItem']['Image']['dirname'] . '/' . $referral['EcardItem']['Image']['basename']);
						echo $html->link('', $url, array('id' => 'ecardVideo', 'style' => 'display: block; width: 300px; height: 220px; float: right;'));
						echo $javascript->codeBlock('
							$(function() {
								flowplayer("ecardVideo", "' . $html->url('/vendors/flowplayer/flowplayer-3.1.3.swf') . '", { clip: { autoPlay: false, autoBuffering: false }});
							});
						', array('inline' => false));
	        		}
	        	?>
	        </div>
	    </div>
	    <div class="clear"></div>
	</div>
	<div class="hook bottom"></div>
</div>
<br />
<div id="subcontent">
	<div class="hook png">
		<?php echo $snippets['How Can I Help']; ?>
	</div>
</div>