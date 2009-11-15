<?php
	$backgroundImages = $this->number('Background Images');
	for ( $i = 1; $i <= $backgroundImages; $i++ ) {
		$this->image('Background Image '. $i);
	}
?>