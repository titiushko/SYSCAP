<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas extends CI_Controller{
	function __construct(){
		parent::__construct();

		$this->load->helper(array('url', 'html', 'funciones_helper'));
	}
	public function consulta($opcion = 1){
		$consultas_estadisticas = array(1 => 'Usuarios por Modalidad de Capacitación',
										2 => 'Usuarios por Departamento y Rango de Fechas',
										3 => 'Total de Usuarios por Departamento y Rango de Fechas',
										4 => 'Usuarios por Departamento, Municipio y Rango de Fechas',
										5 => 'Usuarios por Tipo de Capacitados y Fecha a Nivel Nacional',
										6 => 'Usuarios por Tipo de Capacitados, Departamento y Fecha',
										7 => 'Usuarios por Tipo de Capacitados, Departamento y Municipio',
										8 => 'Usuarios por Departamento, Tipo de Capacitados y Fecha',
										9 => 'Usuarios por Tipo de Capacitados y Centro Educativo',
										10 => 'Usuarios a Nivel Nacional',
										11 => 'Usuarios por Grado Digital');
		$data['nombre_estadistica'] = $consultas_estadisticas[$opcion];
		$data['pagina'] = 'estadisticas/consultar_estadisticas_view';
		$data['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$data['opcion_menu'] = modulo_actual('modulo_consultas_estadisticas');
		$estadistica = array();
		for($i = 1; $i <= 11; $i++)
			if($i == $opcion) $estadistica[$i] = 'active';
			else $estadistica[$i] = '';
		$data['estadistica'] = $estadistica;
		
		$this->load->view('plantilla_pagina_view', $data);
	}
}

/* End of file estadisticas.php */
/* Location: ./application/controllers/estadisticas.php */