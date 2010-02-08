 <?php
 	echo $html->css('forms', 'stylesheet', false, false);
 	#echo $javascript->link('/vendors/uni-form/js/uni-form.jquery', false);
	$this->viewVars['body'] = 'content';
	echo $javascript->codeBlock('
		$(function() {
			$("#SignatureNotInAustralia").change(function() {
				if ( this.checked ) {
					$("#ausLetter").hide();
					$("#pmLetter").show();
				}
				else {
					$("#ausLetter").show();
					$("#pmLetter").hide();
				}
			});
		});
	', array('inline' => false));

	$this->wysiwyg('Aus Letter');
	$this->wysiwyg('PM Letter');
?>
<div id="content">
	<?php echo $this->element('left'); ?>
	<div class="right">
		<div class="hook top"></div>
		<div class="hook middle">
			<div class="copy">
				<?php echo $this->wysiwyg('Content'); ?>
				<div class="border">
					<?php echo $form->create('Signature', array('class' => 'uniForm', 'url' => $this->here));?>
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td width="50%" style="padding-right: 10px;">
									<h1><?php echo $this->text('Letter Title'); ?></h1>
									<?php echo $letter; ?>
									<?php echo $form->input('personal_note', array('style' => 'width: 100%;')); ?>
								</td>
								<td width="50%" style="padding-left: 10px;">
									<h1><?php echo $this->text('Form Title'); ?></h1>
									<?php
										if ( $mps )
										{
											?>
											<p><?php echo sprintf(__dd('signatures', 'Your postcode is %s', true), $postcode); ?></p>
											<p><?php __dd('signatures', 'Parts of your postcode fall in more than one electorate. Please choose your electorate from the following list'); ?></p>
											<?php
												$mpOptions = array();
												foreach ($mps as $mp) {
													$mpOptions[$mp['Mp']['id']] = 'Electorate: ' . $mp['Mp']['electorate'] . ' - ' . $mp['Mp']['name'];
												}
												$options = array(
													'options' => $mpOptions,
													'type' => 'select',
													'label' => false,
													'style' => 'width: auto;'
												);
												echo $form->input('mp_id', $options);
										}
										else
										{
											?>
											<p><?php __('Your letter will be sent to the prime minister of Australia'); ?></p>
											<?php
										}
									?>
									<br /><br />
									<fieldset class="inlineLabels">
										<?php
											$options = array(
												'div' => array('class' => 'ctrlHolder'),
												'class' => 'textInput',
												'error' => array(
													'class' => 'errorField',
													'notEmpty' => 'Please fill in this field',
													'email' => 'Please enter a valid email address',
													'phoneOrEmail' => 'Please enter a phone or an email address',
													'specialUnique' => 'This email address has already signed the petition'
												)
											);
											echo $form->input('first_name', $options);
											echo $form->input('last_name', $options);
											echo $form->input('email', $options);
										?>
										<div style="margin: 5px 0;">&nbsp;</div>
										<div class="ctrlHolder">
											<p class="label">&nbsp;</p>
											<div class="multiField" style="width: auto;">
												<label class="inlineLabel" style="width: auto;">
													<?php /*echo $form->checkbox('optin'); */?>
													<input type="hidden" name="data[Signature][optin]" id="SignatureOptin_" value="0" /><input type="checkbox" name="data[Signature][optin]" value="1" id="SignatureOptin"/>
													<?php __('Please send me the Coral Sea newsletter'); ?>
												</label>
											</div>
										</div>
									</fieldset>
									<?php echo $form->submit('/media/transfer/img/takeaction_redsubmit.png', array('div' => array('class' => 'buttonHolder'), 'class' => 'primaryAction'));?>
									<h2 style="margin: 80px; text-align: center;"><?php echo $signatureCount; ?> supporters have emailed their MP</h2>
								</td>
							</tr>
						</table>
					<?php
						echo $form->hidden('postcode');
						echo $form->hidden('not_in_australia');
						echo $form->end();
					?>
				</div>
		    </div>
		</div>
		<div class="hook bottom"></div>
	</div>
	<div class="clear"></div>
</div>