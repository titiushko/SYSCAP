<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Controlador que muestra la ayuda de SYSCAP
*/
class Ayuda extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		// DOC: Si no hay una conexión de usuario, entonces: no permitir acceso al controlador y mostrar el error de acceso
		if(!isset($this->session->userdata['conexion_usuario'])){
			$this->acceso_denegado('sin_conexion');
		}
	}
	
	/**
	* Método default del controlador
	*/
	public function index(){
		// DOC: Cargar la vista de ayuda de SYSCAP
		$this->load->view('plantilla_pagina_view', array('pagina' => 'ayuda_view'));
	}
}

/* End of file ayuda.php */
/* Location: ./application/controllers/ayuda.php */