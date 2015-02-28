<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions{
	public function __construct(){
		parent::__construct();
	}
	
	function show_404($page = '', $username = '', $role = '', $log_error = TRUE){
		$heading = "404 Page Not Found";
		$message = "The page you requested was not found.";
		if ($log_error){
			log_message('error', '404 Page Not Found --> '.$page);
		}
		echo $this->show_error($heading, $message, $page, $username, $role, 'error_404', 404);
		exit;
	}
	
	function show_error($heading, $message, $page = '', $username = '', $role = '', $template = 'error_general', $status_code = 500){
		set_status_header($status_code);
		$message = '<p>'.implode('</p><p>', (!is_array($message)) ? array($message) : $message).'</p>';
		if (ob_get_level() > $this->ob_level + 1){
			ob_end_flush();
		}
		ob_start();
		include(APPPATH.'errors/'.$template.'.php');
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
}

/* End of file MY_Exceptions.php */
/* Location: ./application/core/MY_Exceptions.php */