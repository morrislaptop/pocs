<?php

class AppError extends ErrorHandler
{
/**
 * Output message
 *
 * @access protected
 */
	function _outputMessage($template) {
		$this->controller->layout = 'default';
		trigger_error('WTF?');
		return parent::_outputMessage($template);
	}
}
?>