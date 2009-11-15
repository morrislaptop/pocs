<?php
	if ( 'BakedAdminView' == get_class($this) ) {
		echo $this->wysiwyg('Content');
	}
	else {
		echo $email;
	}
?>