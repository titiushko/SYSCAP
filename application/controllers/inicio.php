<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$data['pagina'] = 'inicio_view';
		$data['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$data['opcion_menu'] = modulo_actual('inicio');
		
		$this->load->view('plantilla_pagina_view', $data);
	}
}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */