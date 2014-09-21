<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas extends CI_Controller{
	function __construct(){
		parent::__construct();

		$this->load->helper(array('url', 'html'));
	}
	public function consulta($opcion = 1){
		$consultas_estadisticas = array(1 => 'Usuarios por Modalidad de Capacitaci�n',
										2 => 'Usuarios por Departamento y Rango de Fechas',
										3 => 'Total de Usuarios por Departamento y Rango de Fechas',
										4 => 'Usuarios por Departamento, Municipio y Rango de Fechas');
		$data['nombre_estadistica'] = $consultas_estadisticas[$opcion];
		$data['usuario_actual'] = "Tito Miguel";
		$data['opcion_menu'] = array('modulo_usuarios'					=>	'',
									 'modulo_centros_educativos'		=>	'',
									 'modulo_consultas_estadisticas'	=>	'active',
									 'modulo_mapa_estadistico'			=>	''
									 );
		
		$this->load->view('cabecera_pagina_view', $data);
		$this->load->view('estadisticas/consultar_estadisticas_view', $data);
		$this->load->view('pie_pagina_view');
	}
}

/* End of file estadisticas.php */
/* Location: ./application/controllers/estadisticas.php */