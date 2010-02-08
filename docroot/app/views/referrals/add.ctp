 <?php
 	echo $html->css('forms', 'stylesheet', false, false);
 	#echo $javascript->link('/vendors/uni-form/js/uni-form.jquery', false);
	$this->viewVars['body'] = 'content';

	/**
	* @var MediumHelper
	*/
	$medium;

	/**
	* @var FormHelper
	*/
	$form;

	/**
	* @var HtmlHelper
	*/
	$html;

	// Default options for all fields.
	$options = array(
		'div' => array('class' => 'ctrlHolder'),
		'class' => 'textInput',
		'error' => array(
			'class' => 'errorField',
			'notEmpty' => 'Please fill in this field',
			'email' => 'Please enter a valid email address',
			'phoneOrEmail' => 'Please enter a phone or an email address'
		)
	);

	$javascript->link('/vendors/flowplayer/example/flowplayer-3.1.4.min', false);
	$javascript->link('/vendors/zeroclipboard/ZeroClipboard', false);
	$javascript->codeBlock('
		var clip = null;
		$(function() {
			 ZeroClipboard.setMoviePath("' . $html->url('/vendors/zeroclipboard/ZeroClipboard.swf') . '");
			clip = new ZeroClipboard.Client();
			clip.addEventListener("mouseOver", my_mouse_over);
			clip.glue("clipboard");

			$("#html").focus(function() {
				this.select();
			})

			$(".ecardImage a").click(function() {
				$(this).parent(".ecardImage").children("input").attr("checked", "checked");
			});
		});

		function my_mouse_over() {
			clip.setText($("#html").attr("value"));
		}
	', array('inline' => false));

	// Chuck in a field which our controller can use to redirect
	$this->text('Thankyou URL');
?>
<div id="content">
	<?php echo $this->element('left'); ?>
	<div class="right">
		<div class="hook top"></div>
		<div class="hook middle">
			<?php echo $this->wysiwyg('Content'); ?>
            <div class="facebookShare">
                <a href="http://www.facebook.com/sharer.php" name="fb_share" type="button_count" title="I just contacted my federal MP to Protect our Coral Sea, you can too" share_url="http://www.protectourcoralsea.org.au/act-now">Share</a>
                <script type="text/javascript">// <![CDATA[
                tweetmeme_style = 'compact';
                // ]]></script>
                <script type="text/javascript" src="http://tweetmeme.com/i/scripts/button.js"></script>
            </div>
            <div class="clear"></div>
			<div style="float: left; width: 32%; " class="border">
				<h2><?php __('Send a unique piece of the coral sea'); ?></h2>
				<?php echo $form->create('Referral', array('class' => 'uniForm')); ?>
					<fieldset>
						<p><strong><?php __('Step 1: Choose an image'); ?></strong></p>
						<?php
							$value = !isset($this->data['Referral']['ecard_item_id']) ? $ecardImages[0]['EcardItem']['id'] : $this->data['Referral']['ecard_item_id'];
							foreach ($ecardImages as $ecardItem)
							{
								?>
								<div class="ecardImage">
									<a href="#"><?php echo $html->image('/media/filter/s/' . $ecardItem['Image']['dirname'] . '/' . $ecardItem['Image']['basename']); ?></a>
									<?php echo $form->radio('ecard_item_id', array($ecardItem['EcardItem']['id'] => ''), compact('value')); ?>
									<div class="clear"></div>
								</div>
								<?php
								$checked = false;
							}
						?>
						<div class="clear"></div>
					</fieldset>
					<fieldset>
						<p><strong><?php __('Step 2: Enter a message'); ?></strong></p>
						<?php echo $form->input('message', am($options, array('label' => false))); ?>
					</fieldset>
					<fieldset>
						<p><strong><?php __('Step 3: Sending Details'); ?></strong></h3>
						<?php
							echo $form->input('your_name', $options);
							echo $form->input('your_email', $options);
							echo $form->input('friends_name', $options);
							echo $form->input('friends_email', $options);
						?>
					</fieldset>
					<?php
						echo $form->hidden('type', array('value' => 'image'));
						echo $form->submit('Submit', array('div' => array('class' => 'buttonHolder'), 'class' => 'primaryAction'));
					?>
				<?php echo $form->end(); ?>
			</div>
			<div style="float: left; width: 32%;" class="border">
				<h2><?php __('Ha Wrasse Your Friends'); ?></h2>
				<?php echo $form->create('Referral', array('class' => 'uniForm')); ?>
					<fieldset>
						<p><strong><?php __('Step 1: Enter a message'); ?></strong></p>
						<?php
							if ( !isset($this->data['Signature']['message']) ) {
								$value = $defaultBarryMessage;
							}
							else {
								$value = $this->data['Signature']['message'];
							}
							echo $form->input('message', am($options, array('label' => false, 'value' => $value)));
						?>
					</fieldset>
					<fieldset>
						<p><strong><?php __('Step 2: Sending Details'); ?></strong></p>
						<?php
							echo $form->input('your_name', $options);
							echo $form->input('your_email', $options);
							echo $form->input('friends_name', $options);
							echo $form->input('friends_email', $options);
						?>
					</fieldset>
					<fieldset>
						<p><strong><?php __('Preview'); ?></strong></p>
						<?php
							$javascript->link('http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js', false);

							foreach ($ecardVideos as $ecardItem)
							{
								?>
								<div class="ecardImage" style="padding: 7px;">
									<?php
										$id = 'ecardVideo' . $ecardItem['EcardItem']['id'];
										$style = 'display: block; width: 240px; height: 240px;';
										echo $html->link('', '/media/' . $ecardItem['Image']['dirname'] . '/' . $ecardItem['Image']['basename'], array('id' => $id, 'style' => $style));
										echo $javascript->codeBlock('
											$(function() {
												flowplayer("' . $id . '", "' . $html->url('/vendors/flowplayer/flowplayer-3.1.3.swf') . '", { clip: { autoPlay: false, autoBuffering: false }});
											})
										', array('inline' => false));
									?>
									<?php echo $form->hidden('ecard_item_id', array('value' => $ecardItem['EcardItem']['id'])); ?>
									<div class="clear"></div>
								</div>
								<?php
							}
						?>
						<div class="clear"></div>
					</fieldset>
					<?php
						echo $form->hidden('type', array('value' => 'video'));
						echo $form->submit('Submit', array('div' => array('class' => 'buttonHolder'), 'class' => 'primaryAction'));
					?>
				<?php echo $form->end(); ?>
			</div>
			<div style="float: left; width: 21%;" class="border">
				<?php echo $this->wysiwyg('Right Column'); ?>
				<h2><?php __('Support Us'); ?></h2>
				<?php
					$embed = $html->link($html->image($html->url('/img/badge.jpg', true)), $html->url('/', true), null, false, false);
					echo $html->tag('p', $embed);
					echo $html->tag('p', __('Copy and paste the following code onto your website', true));
					$clipboard = $html->link($html->image('clipboard.png', array('style' => 'vertical-align: middle;', 'title' => 'Copy to the clipboard', 'alt' => 'Copy to the clipboard')), '#', array('id' => 'clipboard'), false, false);
					echo $form->input('html', array('value' => $embed, 'label' => false, 'after' => $clipboard));
				?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="hook bottom"></div>
	</div>
	<div class="clear"></div>
</div>