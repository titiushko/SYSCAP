<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sesion extends CI_Controller{
	function __construct(){
		parent::__construct();

		$this->load->helper(array('url', 'html'));
	}
	
	public function index(){
		$this->load->view('sesion/sesion_view');
	}
}

/* End of file sesion.php */
/* Location: ./application/controllers/sesion.php */