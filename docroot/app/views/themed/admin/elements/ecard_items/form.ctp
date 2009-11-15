<?php
	echo $form->input('id');
	echo $form->input('scope');
	echo $form->input('name');
	echo $this->element('attachment', array('plugin' => 'advmedia', 'assocAlias' => 'Image'));
?>