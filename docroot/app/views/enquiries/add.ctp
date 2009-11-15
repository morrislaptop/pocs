 <?php
 	echo $html->css('forms', 'stylesheet', false, false);
 	#echo $javascript->link('/vendors/uni-form/js/uni-form.jquery', false);
	$this->viewVars['body'] = 'content';
?>
<div id="content">
	<?php echo $this->element('left'); ?>
	<div class="right">
		<div class="hook top"></div>
		<div class="hook middle">
			<div class="copy">
				<?php echo $this->wysiwyg('Content'); ?>
				<?php echo $form->create('Enquiry', array('class' => 'uniForm', 'style' => 'width: 400px;'));?>
					<fieldset class="inlineLabels">
						<?php
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
							echo $form->input('category', $options);
							echo $form->input('name', $options);
							echo $form->input('email', $options);
							echo $form->input('phone', $options);
							echo $form->input('contact_via', $options);
							echo $form->input('enquiry', $options);
						?>
					</fieldset>
					<?php echo $form->submit('Submit', array('div' => array('class' => 'buttonHolder'), 'class' => 'primaryAction'));?>
				<?php echo $form->end(); ?>
		    </div>
		</div>
		<div class="hook bottom"></div>
	</div>
	<div class="clear"></div>
</div>