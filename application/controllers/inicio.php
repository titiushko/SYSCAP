<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		if(isset($this->session->userdata['conexion_usuario'])){
			if($this->session->userdata['nombre_corto_rol'] != 'admin'){
				$this->acceso_denegado('sin_permiso', utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')));
			}
		}
		else{
			$this->acceso_denegado('sin_conexion');
		}
	}
	
	public function index(){
		$datos['pagina'] = 'inicio_view';
		$datos['opcion_menu'] = modulo_actual('inicio');
		$this->load->view('plantilla_pagina_view', $datos);
	}
}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */