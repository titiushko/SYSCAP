<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Muestra la página de inicio de SYSCAP
*/
class Inicio extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		// DOC: Si hay una conexión de usuario, entonces: permitir acceso al controlador, si no: no permitir acceso al controlador y mostrar el error de acceso
		if(isset($this->session->userdata['conexion_usuario'])){
			// DOC: Si la conexión de usuario no es administrador, entonces: mostrar el error de acceso
			if($this->session->userdata['nombre_corto_rol'] != 'admin'){
				$this->acceso_denegado('sin_permiso', utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')));
			}
		}
		else{
			$this->acceso_denegado('sin_conexion');
		}
	}
	
	/**
	* Método default del controlador
	*/
	public function index(){
		// DOC: Cargar la vista de inicio de SYSCAP
		$this->load->view('plantilla_pagina_view', array('pagina' => 'inicio_view', 'opcion_menu' => modulo_actual('inicio')));
	}
}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */