<?php
	if ( 'BakedAdminView' == get_class($this) ) {
		echo $this->textarea('Content');
	}
	else {
		echo $email;
	}
?>