<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas extends CI_Controller{
	function __construct(){
		parent::__construct();

		$this->load->helper(array('url', 'html', 'funciones_helper'));
		$this->load->model('estadisticas_model');
	}
	public function consulta($opcion = 1){
		$datos['nombre_estadistica'] = listado_estadisticas($opcion);
		$datos['pagina'] = 'estadisticas/consultar_estadisticas_view';
		$datos['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$datos['opcion_menu'] = modulo_actual('modulo_consultas_estadisticas');
		
		switch($opcion){
			case 1:
				$datos['modalidades_capacitados'] = $this->estadisticas_model->modalidades_capacitados('');
				$datos['participantes_modalidades'] = $this->estadisticas_model->modalidades_capacitados('participantes');
				break;
		}
		
		$this->load->view('plantilla_pagina_view', $datos);
	}
}

/* End of file estadisticas.php */
/* Location: ./application/controllers/estadisticas.php */