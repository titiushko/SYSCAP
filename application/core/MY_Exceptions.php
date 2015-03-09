<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions{
	public function __construct(){
		parent::__construct();
	}
	
	function show_404($page = '', $log_error = TRUE, $username = '', $complete_role = '', $role = ''){
		$heading = "404 Page Not Found";
		$message = "The page you requested was not found.";
		if ($log_error){
			log_message('error', '404 Page Not Found --> '.$page);
		}
		echo $this->show_error($heading, $message, 'error_404', 404, $page, $username, $complete_role, $role);
		exit;
	}
	
	function show_error($heading, $message, $template = 'error_general', $status_code = 500, $page = '', $username = '', $complete_role = '', $role = ''){
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