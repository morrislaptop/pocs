<?php
	$this->viewVars['body'] = 'referral';
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
						echo $html->div('ecardVideo', '', array('id' => 'ecardVideo'));
						echo $javascript->codeBlock('
							var flashvars = {};
							flashvars.file = "' . $html->url('/media/' . $referral['EcardItem']['Image']['dirname'] . '/' . $referral['EcardItem']['Image']['basename']) . '"
							var params = {};
							var attributes = {};
							swfobject.embedSWF("' . $html->url('/vendors/mediaplayer/player.swf') . '", "ecardVideo", "300", "220", "9.0.0", false, flashvars, params, attributes);
						', array('inline' => false));
	        		}
	        	?>
	        </div>
	    </div>
	    <div class="clear"></div>
	</div>
	<div class="hook bottom"></div>
</div>