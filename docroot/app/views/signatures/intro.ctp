 <?php
 	echo $html->css('forms', 'stylesheet', false, false);
 	echo $javascript->link('/vendors/uni-form/js/uni-form.jquery', false);
	$this->viewVars['body'] = 'content';
?>
<div id="content">
	<?php echo $this->element('left'); ?>
	<div class="right">
		<div class="hook top"></div>
		<div class="hook middle">
			<div class="copy">
				<?php echo $this->wysiwyg('Content'); ?>
				<?php echo $form->create('Signature', array('class' => 'uniForm border', 'url' => $this->here));?>
					<?php
						$submit = $form->submit('takeaction_submit.png', array('div' => false, 'align' => 'absmiddle'));
						$outside = '<label style="display: inline; font-weight: normal; width: auto; margin: 0 10px;">or ' . $form->checkbox('not_in_australia') . ' ' . __('I live outside of Australia', true) . '</label>';
						$opts = array(
							'label' => 'Enter Your Postcode',
							'after' => $outside . $submit,
							'div' => 'ctrlHolder',
							'error' => array(
								'notEmpty' => __('Please enter your postcode', true),
								'style' => 'color: #AF4C4C;'
							)
						);
						echo $form->input('postcode', $opts);
					?>
				<?php echo $form->end(); ?>
				<h2 style="margin: 80px; text-align: center;"><?php echo $signatureCount; ?> supporters have emailed their MP</h2>
		    </div>
		</div>
		<div class="hook bottom"></div>
	</div>
	<div class="clear"></div>
</div>