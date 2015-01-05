<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model(array('estadisticas_model', 'departamentos_model'));
	}
	
	public function consulta($opcion = 1){
		$datos['pagina'] = 'estadisticas/consultar_estadisticas_view';
		$datos['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$datos['opcion_menu'] = modulo_actual('modulo_consultas_estadisticas');
		$datos['nombre_estadistica'] = listado_estadisticas($opcion);
		$datos['estadistica'] = array($opcion => 'active');
		
		switch($opcion){
			case 1:
				$datos['modalidades_capacitados'] = $this->estadisticas_model->modalidades_capacitados('');
				$datos['participantes_modalidades'] = $this->estadisticas_model->modalidades_capacitados('participantes');
				break;
			case 2:
				$datos['cantidad_usuarios_municipio'] = $this->estadisticas_model->cantidad_usuarios_municipio('01');
				$datos['usuarios_municipio'] = $this->estadisticas_model->usuarios_municipio('01');
				$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
				break;
		}
		
		$datos['datos'] = $datos;
		$this->load->view('plantilla_pagina_view', $datos);
	}
}

/* End of file estadisticas.php */
/* Location: ./application/controllers/estadisticas.php */