<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ayuda extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		if(!isset($this->session->userdata['conexion_usuario'])){
			$this->acceso_denegado('sin_conexion');
		}
	}
	
	public function index(){
		$datos['pagina'] = 'ayuda_view';
		$this->load->view('plantilla_pagina_view', $datos);
	}
}

/* End of file ayuda.php */
/* Location: ./application/controllers/ayuda.php */