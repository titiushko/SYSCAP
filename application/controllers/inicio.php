<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$datos['pagina'] = 'inicio_view';
		$datos['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$datos['opcion_menu'] = modulo_actual('inicio');
		
		$this->load->view('plantilla_pagina_view', $datos);
	}
}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */